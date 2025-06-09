/* global wpforms_ai_chat_element */

/**
 * @param wpforms_ai_chat_element.pinChat
 * @param wpforms_ai_chat_element.unpinChat
 * @param wpforms_ai_chat_element.close
 */

/**
 * Dock JS module.
 *
 * @since 1.9.5
 *
 * @param {jQuery} $ jQuery object.
 *
 * @return {Object} Dock object.
 */
// eslint-disable-next-line no-unused-vars
const wpFormsAIDock = ( function( $ ) {
	/**
	 * Pin modal.
	 *
	 * @since 1.9.5
	 *
	 * @param {jQuery} $modal Modal element.
	 */
	function pinModal( $modal ) {
		localStorage.setItem( 'wpforms-ai-chat-prefers-pinned', '1' );

		$modal.find( '.wpforms-ai-modal-pin' ).attr( 'title', wpforms_ai_chat_element.unpinChat );

		const $toolbar = $( '#wpforms-builder-form .wpforms-toolbar' );

		// Get the distance from the top of the screen to the bottom border of the toolbar.
		const toolbarHeight = $toolbar.offset().top + $toolbar.outerHeight();

		$modal.addClass( 'pinned' );

		if ( $( '#wpadminbar' ).length ) {
			$modal.addClass( 'with-wpadminbar' );
		}

		$modal.insertAfter( $toolbar ).promise().done( function() {
			$modal.css( {
				top: toolbarHeight,
			} );
		} );
	}

	/**
	 * Unpin modal.
	 *
	 * @since 1.9.5
	 *
	 * @param {jQuery} $modal Modal element.
	 */
	function unPinModal( $modal ) {
		localStorage.setItem( 'wpforms-ai-chat-prefers-pinned', '0' );

		$modal.find( '.wpforms-ai-modal-pin' ).attr( 'title', wpforms_ai_chat_element.pinChat );

		$modal.removeClass( 'pinned' );
		$modal.removeClass( 'with-wpadminbar' );

		$modal.appendTo( $( 'body' ) ).promise().done( function() {
			$modal.css( {
				top: 0,
			} );
		} );

		$modal.find( '.wpforms-ai-modal-top-bar' ).removeClass( 'scrolled' );
	}

	/**
	 * Handle click on the pin button.
	 *
	 * @since 1.9.5
	 */
	function onPinIconClick() {
		if ( $( this ).hasClass( 'not-allowed' ) ) {
			return;
		}

		const $modal = $( this ).closest( '.jconfirm.jconfirm-wpforms-ai-modal' );

		if ( $modal.hasClass( 'pinned' ) ) {
			unPinModal( $modal );
		} else {
			pinModal( $modal );
		}

		// Re-apply this action also for other modals but hide them.
		const $otherModals = $( '.jconfirm.jconfirm-wpforms-ai-modal' ).not( $modal );

		$otherModals.each( function() {
			const $otherModal = $( this );

			if ( $otherModal.hasClass( 'pinned' ) ) {
				unPinModal( $otherModal );
			} else {
				pinModal( $otherModal );
			}

			$otherModal.hide();
		} );
	}

	/**
	 * Handle click on the panel toggle button.
	 *
	 * Hide pinned chats if this is not the fields panel.
	 *
	 * @since 1.9.5
	 *
	 * @param {Object} clicked Clicked a button object.
	 */
	function onPanelToggleClick( clicked ) {
		const $this = $( clicked.target ),
			dataPanel = $this.closest( 'button' ).data( 'panel' );

		if ( dataPanel === 'fields' ) {
			return;
		}

		$( '.jconfirm.jconfirm-wpforms-ai-modal.pinned' ).each( function() {
			$( this ).hide();
		} );
	}

	/**
	 * Bind events.
	 *
	 * @since 1.9.5
	 */
	function bindEvents() {
		const AIModalPin = $( '.wpforms-ai-modal-pin' );

		$( document )
			.off( 'click', '.wpforms-ai-modal-pin' )
			.on( 'click', '.wpforms-ai-modal-pin', onPinIconClick )
			// Hide pin icon for the time of response generation.
			.on( 'wpformsAIChatBeforeSendMessage', () => AIModalPin.addClass( 'not-allowed' ) )
			.on( 'wpformsAIChatBeforeError wpformsAIChatAfterTypeText', () => AIModalPin.removeClass( 'not-allowed' ) );

		$( '#wpforms-panels-toggle button' )
			.off( 'click', onPanelToggleClick )
			.on( 'click', onPanelToggleClick );
	}

	/**
	 * Get the modal element.
	 *
	 * @since 1.9.5
	 *
	 * @param {number} fieldId Field ID.
	 *
	 * @return {jQuery} Modal element.
	 */
	function getModal( fieldId ) {
		const $chatElement = $( 'wpforms-ai-chat[field-id="' + fieldId + '"]' );

		return $chatElement.closest( '.jconfirm.jconfirm-wpforms-ai-modal' ).last();
	}

	/**
	 * Prepare dock by adding pin button.
	 *
	 * @since 1.9.5
	 *
	 * @param {number} fieldId Field ID.
	 */
	function prepareDock( fieldId ) {
		const $jconfirmAIModal = getModal( fieldId ),
			dockAlreadyPrepared = $jconfirmAIModal.find( '.wpforms-ai-modal-pin' ).length;

		if ( dockAlreadyPrepared ) {
			return;
		}

		const $closeIcon = $jconfirmAIModal.find( '.jconfirm-closeIcon' );

		// Append new bar after close icon and move close icon inside this bar.
		$closeIcon.after(
			`<div class="wpforms-ai-modal-top-bar">
			<div class="wpforms-ai-modal-pin" title="${ wpforms_ai_chat_element.pinChat }"></div>
			</div>`
		).promise().done( function() {
			const $topBar = $jconfirmAIModal.find( '.wpforms-ai-modal-top-bar' );

			$closeIcon.appendTo( $topBar );
		} );

		$closeIcon.attr( 'title', wpforms_ai_chat_element.close );

		const $topBar = $jconfirmAIModal.find( '.wpforms-ai-modal-top-bar' ),
			$messageList = $jconfirmAIModal.find( '.wpforms-ai-chat-message-list' );

		$messageList.off( 'scroll' );
		$messageList.on( 'scroll', function() {
			if ( $messageList.scrollTop() > 0 ) {
				$topBar.addClass( 'scrolled' );

				return;
			}

			$topBar.removeClass( 'scrolled' );
		} );

		$jconfirmAIModal.on( 'remove', function() {
			$messageList.off( 'scroll' );
		} );
	}

	/**
	 * Maybe pin modal on open.
	 *
	 * @since 1.9.5
	 *
	 * @param {string} fieldId Field ID.
	 */
	function onOpen( fieldId ) {
		const savedState = localStorage.getItem( 'wpforms-ai-chat-prefers-pinned' ) || '0';

		if ( savedState === '0' ) {
			return;
		}

		pinModal( getModal( fieldId ) );
	}

	/**
	 * Initialize the dock.
	 *
	 * @since 1.9.5
	 *
	 * @param {number} fieldId Field ID.
	 */
	function init( fieldId ) {
		prepareDock( fieldId );
		bindEvents();
		onOpen( fieldId );
	}

	return { init };
}( jQuery ) );
