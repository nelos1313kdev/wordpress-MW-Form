/* global wpforms_edit_post_education */

// noinspection ES6ConvertVarToLetConst
/**
 * WPForms Edit Post Education function.
 *
 * @since 1.8.1
 */

// eslint-disable-next-line no-var, no-unused-vars
var WPFormsEditPostEducation = window.WPFormsEditPostEducation || ( function( document, window, $ ) {
	// The identifiers for the Redux stores.
	const coreEditSite = 'core/edit-site',
		coreEditor = 'core/editor',
		coreBlockEditor = 'core/block-editor',
		coreNotices = 'core/notices',

		// Heading block name.
		coreHeading = 'core/heading';

	/**
	 * Public functions and properties.
	 *
	 * @since 1.8.1
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Determine if the notice was shown before.
		 *
		 * @since 1.8.1
		 */
		isNoticeVisible: false,

		/**
		 * Identifier for the plugin and notice.
		 *
		 * @since 1.9.5
		 */
		pluginId: 'wpforms-edit-post-product-education-guide',

		/**
		 * Start the engine.
		 *
		 * @since 1.8.1
		 */
		init() {
			$( window ).on( 'load', function() {
				// In the case of jQuery 3.+, we need to wait for a ready event first.
				if ( typeof $.ready.then === 'function' ) {
					$.ready.then( app.load );
				} else {
					app.load();
				}
			} );
		},

		/**
		 * Page load.
		 *
		 * @since 1.8.1
		 * @since 1.9.5 Added compatibility for the Site Editor.
		 */
		load() {
			if ( ! app.isGutenbergEditor() ) {
				app.maybeShowClassicNotice();
				app.bindClassicEvents();

				return;
			}

			app.maybeShowGutenbergNotice();

			// "core/edit-site" store available only in the Site Editor.
			if ( !! wp.data.select( coreEditSite ) ) {
				app.subscribeForSiteEditor();

				return;
			}

			app.subscribeForBlockEditor();
		},

		/**
		 * This method listens for changes in the WordPress data store and performs the following actions:
		 * - Monitors the editor title and focus mode to detect changes.
		 * - Dismisses a custom notice if the focus mode is disabled and the notice is visible.
		 * - Shows a custom Gutenberg notice if the title or focus mode changes.
		 *
		 * @since 1.9.5
		 */
		subscribeForSiteEditor() {
			// Store the initial editor title and focus mode state.
			let prevTitle = app.getEditorTitle();
			let prevFocusMode = null;
			const { subscribe, select, dispatch } = wp.data;

			// Listen for changes in the WordPress data store.
			subscribe( () => {
				// Fetch the current editor mode setting.
				// If true - Site Editor canvas is opened, and you can edit something.
				// If false - you should see the sidebar with navigation and preview
				// with selected template or page.
				const { focusMode } = select( coreEditor ).getEditorSettings();

				// If focus mode is disabled and a notice is visible, remove the notice.
				// This is essential because user can switch pages / templates
				// without a page-reload.
				if ( ! focusMode && app.isNoticeVisible ) {
					app.isNoticeVisible = false;
					prevFocusMode = focusMode;

					dispatch( coreNotices ).removeNotice( app.pluginId );
				}

				const title = app.getEditorTitle();

				// If neither the title nor the focus mode has changed, do nothing.
				if ( prevTitle === title && prevFocusMode === focusMode ) {
					return;
				}

				// Update the previous title and focus mode values for the next subscription cycle.
				prevTitle = title;
				prevFocusMode = focusMode;

				// Show a custom Gutenberg notice if conditions are met.
				app.maybeShowGutenbergNotice();
			} );
		},

		/**
		 * Subscribes to changes in the WordPress block editor and monitors the editor's title.
		 * When the title changes, it triggers a process to potentially display a Gutenberg notice.
		 * The subscription is automatically stopped if the notice becomes visible.
		 *
		 * @since 1.9.5
		 */
		subscribeForBlockEditor() {
			let prevTitle = app.getEditorTitle();
			const { subscribe } = wp.data;

			// Subscribe to WordPress data changes.
			const unsubscribe = subscribe( () => {
				const title = app.getEditorTitle();

				// Check if the title has changed since the previous value.
				if ( prevTitle === title ) {
					return;
				}

				// Update the previous title to the current title.
				prevTitle = title;

				app.maybeShowGutenbergNotice();

				// If the notice is visible, stop the WordPress data subscription.
				if ( app.isNoticeVisible ) {
					unsubscribe();
				}
			} );
		},

		/**
		 * Retrieves the title of the post currently being edited. If in the Site Editor,
		 * it attempts to fetch the title from the topmost heading block. Otherwise, it
		 * retrieves the title attribute of the edited post.
		 *
		 * @since 1.9.5
		 *
		 * @return {string} The post title or an empty string if no title is found.
		 */
		getEditorTitle() {
			const { select } = wp.data;

			// Retrieve the title for Post Editor.
			if ( ! select( coreEditSite ) ) {
				return select( coreEditor ).getEditedPostAttribute( 'title' );
			}

			if ( app.isEditPostFSE() ) {
				return app.getPostTitle();
			}

			return app.getTopmostHeadingTitle();
		},

		/**
		 * Retrieves the content of the first heading block.
		 *
		 * @since 1.9.5
		 *
		 * @return {string} The topmost heading content or null if not found.
		 */
		getTopmostHeadingTitle() {
			const { select } = wp.data;

			const headings = select( coreBlockEditor ).getBlocksByName( coreHeading );

			if ( ! headings.length ) {
				return '';
			}

			const headingBlock = select( coreBlockEditor ).getBlock( headings[ 0 ] );

			return headingBlock?.attributes?.content?.text ?? '';
		},

		/**
		 * Determines if the current editing context is for a post type in the Full Site Editor (FSE).
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} True if the current context represents a post type in the FSE, otherwise false.
		 */
		isEditPostFSE() {
			const { select } = wp.data;
			const { context } = select( coreEditSite ).getPage();

			return !! context?.postType;
		},

		/**
		 * Retrieves the title of a post based on its type and ID from the current editing context.
		 *
		 * @since 1.9.5
		 *
		 * @return {string} The title of the post.
		 */
		getPostTitle() {
			const { select } = wp.data;
			const { context } = select( coreEditSite ).getPage();

			// Use `getEditedEntityRecord` instead of `getEntityRecord`
			// to fetch the live, updated data for the post being edited.
			const { title = '' } = select( 'core' ).getEditedEntityRecord(
				'postType',
				context.postType,
				context.postId
			) || {};

			return title;
		},

		/**
		 * Bind events for Classic Editor.
		 *
		 * @since 1.8.1
		 */
		bindClassicEvents() {
			const $document = $( document );

			if ( ! app.isNoticeVisible ) {
				$document.on( 'input', '#title', _.debounce( app.maybeShowClassicNotice, 1000 ) );
			}

			$document.on( 'click', '.wpforms-edit-post-education-notice-close', app.closeNotice );
		},

		/**
		 * Determine if the editor is Gutenberg.
		 *
		 * @since 1.8.1
		 *
		 * @return {boolean} True if the editor is Gutenberg.
		 */
		isGutenbergEditor() {
			return typeof wp !== 'undefined' && typeof wp.blocks !== 'undefined';
		},

		/**
		 * Create a notice for Gutenberg.
		 *
		 * @since 1.8.1
		 */
		showGutenbergNotice() {
			wp.data.dispatch( coreNotices ).createInfoNotice(
				wpforms_edit_post_education.gutenberg_notice.template,
				app.getGutenbergNoticeSettings()
			);

			// The notice component doesn't have a way to add HTML id or class to the notice.
			// Also, the notice became visible with a delay on old Gutenberg versions.
			const hasNotice = setInterval( function() {
				const noticeBody = $( '.wpforms-edit-post-education-notice-body' );
				if ( ! noticeBody.length ) {
					return;
				}

				const $notice = noticeBody.closest( '.components-notice' );
				$notice.addClass( 'wpforms-edit-post-education-notice' );
				$notice.find( '.is-secondary, .is-link' ).removeClass( 'is-secondary' ).removeClass( 'is-link' ).addClass( 'is-primary' );

				// We can't use onDismiss callback as it was introduced in WordPress 6.0 only.
				const dismissButton = $notice.find( '.components-notice__dismiss' );
				if ( dismissButton ) {
					dismissButton.on( 'click', function() {
						app.updateUserMeta();
					} );
				}

				clearInterval( hasNotice );
			}, 100 );
		},

		/**
		 * Get settings for the Gutenberg notice.
		 *
		 * @since 1.8.1
		 *
		 * @return {Object} Notice settings.
		 */
		getGutenbergNoticeSettings() {
			const noticeSettings = {
				id: app.pluginId,
				isDismissible: true,
				HTML: true,
				__unstableHTML: true,
				actions: [
					{
						className: 'wpforms-edit-post-education-notice-guide-button',
						variant: 'primary',
						label: wpforms_edit_post_education.gutenberg_notice.button,
					},
				],
			};

			if ( ! wpforms_edit_post_education.gutenberg_guide ) {
				noticeSettings.actions[ 0 ].url = wpforms_edit_post_education.gutenberg_notice.url;

				return noticeSettings;
			}

			const { Guide } = wp.components,
				{ useState } = wp.element,
				{ registerPlugin, unregisterPlugin } = wp.plugins;

			const GutenbergTutorial = function() {
				const [ isOpen, setIsOpen ] = useState( true );

				if ( ! isOpen ) {
					return null;
				}

				return (
					// eslint-disable-next-line react/react-in-jsx-scope
					<Guide
						className="edit-post-welcome-guide"
						onFinish={ () => {
							unregisterPlugin( app.pluginId );
							setIsOpen( false );
						} }
						pages={ app.getGuidePages() }
					/>
				);
			};

			noticeSettings.actions[ 0 ].onClick = () => registerPlugin( app.pluginId, { render: GutenbergTutorial } );

			return noticeSettings;
		},

		/**
		 * Get Guide pages in proper format.
		 *
		 * @since 1.8.1
		 *
		 * @return {Array} Guide Pages.
		 */
		getGuidePages() {
			const pages = [];

			wpforms_edit_post_education.gutenberg_guide.forEach( function( page ) {
				pages.push(
					{
						/* eslint-disable react/react-in-jsx-scope */
						content: (
							<>
								<h1 className="edit-post-welcome-guide__heading">{ page.title }</h1>
								<p className="edit-post-welcome-guide__text">{ page.content }</p>
							</>
						),
						image: <img className="edit-post-welcome-guide__image" src={ page.image } alt={ page.title } />,
						/* eslint-enable react/react-in-jsx-scope */
					}
				);
			} );

			return pages;
		},

		/**
		 * Show notice if the page title matches some keywords for Classic Editor.
		 *
		 * @since 1.8.1
		 */
		maybeShowClassicNotice() {
			if ( app.isNoticeVisible ) {
				return;
			}

			if ( app.isTitleMatchKeywords( $( '#title' ).val() ) ) {
				app.isNoticeVisible = true;

				$( '.wpforms-edit-post-education-notice' ).removeClass( 'wpforms-hidden' );
			}
		},

		/**
		 * Show notice if the page title matches some keywords for Gutenberg Editor.
		 *
		 * @since 1.8.1
		 */
		maybeShowGutenbergNotice() {
			if ( app.isNoticeVisible ) {
				return;
			}

			const title = app.getEditorTitle();

			if ( app.isTitleMatchKeywords( title ) ) {
				app.isNoticeVisible = true;

				app.showGutenbergNotice();
			}
		},

		/**
		 * Determine if the title matches keywords.
		 *
		 * @since 1.8.1
		 *
		 * @param {string} titleValue Page title value.
		 *
		 * @return {boolean} True if the title matches some keywords.
		 */
		isTitleMatchKeywords( titleValue ) {
			const expectedTitleRegex = new RegExp( /\b(contact|form)\b/i );

			return expectedTitleRegex.test( titleValue );
		},

		/**
		 * Close a notice.
		 *
		 * @since 1.8.1
		 */
		closeNotice() {
			$( this ).closest( '.wpforms-edit-post-education-notice' ).remove();

			app.updateUserMeta();
		},

		/**
		 * Update user meta and don't show the notice next time.
		 *
		 * @since 1.8.1
		 */
		updateUserMeta() {
			$.post(
				wpforms_edit_post_education.ajax_url,
				{
					action: 'wpforms_education_dismiss',
					nonce: wpforms_edit_post_education.education_nonce,
					section: 'edit-post-notice',
				}
			);
		},
	};

	return app;
}( document, window, jQuery ) );

WPFormsEditPostEducation.init();
