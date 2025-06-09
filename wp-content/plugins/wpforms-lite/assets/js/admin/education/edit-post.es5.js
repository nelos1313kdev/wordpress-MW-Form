(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t.return && (u = t.return(), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
/* global wpforms_edit_post_education */

// noinspection ES6ConvertVarToLetConst
/**
 * WPForms Edit Post Education function.
 *
 * @since 1.8.1
 */

// eslint-disable-next-line no-var, no-unused-vars
var WPFormsEditPostEducation = window.WPFormsEditPostEducation || function (document, window, $) {
  // The identifiers for the Redux stores.
  var coreEditSite = 'core/edit-site',
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
  var app = {
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
    init: function init() {
      $(window).on('load', function () {
        // In the case of jQuery 3.+, we need to wait for a ready event first.
        if (typeof $.ready.then === 'function') {
          $.ready.then(app.load);
        } else {
          app.load();
        }
      });
    },
    /**
     * Page load.
     *
     * @since 1.8.1
     * @since 1.9.5 Added compatibility for the Site Editor.
     */
    load: function load() {
      if (!app.isGutenbergEditor()) {
        app.maybeShowClassicNotice();
        app.bindClassicEvents();
        return;
      }
      app.maybeShowGutenbergNotice();

      // "core/edit-site" store available only in the Site Editor.
      if (!!wp.data.select(coreEditSite)) {
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
    subscribeForSiteEditor: function subscribeForSiteEditor() {
      // Store the initial editor title and focus mode state.
      var prevTitle = app.getEditorTitle();
      var prevFocusMode = null;
      var _wp$data = wp.data,
        subscribe = _wp$data.subscribe,
        select = _wp$data.select,
        dispatch = _wp$data.dispatch;

      // Listen for changes in the WordPress data store.
      subscribe(function () {
        // Fetch the current editor mode setting.
        // If true - Site Editor canvas is opened, and you can edit something.
        // If false - you should see the sidebar with navigation and preview
        // with selected template or page.
        var _select$getEditorSett = select(coreEditor).getEditorSettings(),
          focusMode = _select$getEditorSett.focusMode;

        // If focus mode is disabled and a notice is visible, remove the notice.
        // This is essential because user can switch pages / templates
        // without a page-reload.
        if (!focusMode && app.isNoticeVisible) {
          app.isNoticeVisible = false;
          prevFocusMode = focusMode;
          dispatch(coreNotices).removeNotice(app.pluginId);
        }
        var title = app.getEditorTitle();

        // If neither the title nor the focus mode has changed, do nothing.
        if (prevTitle === title && prevFocusMode === focusMode) {
          return;
        }

        // Update the previous title and focus mode values for the next subscription cycle.
        prevTitle = title;
        prevFocusMode = focusMode;

        // Show a custom Gutenberg notice if conditions are met.
        app.maybeShowGutenbergNotice();
      });
    },
    /**
     * Subscribes to changes in the WordPress block editor and monitors the editor's title.
     * When the title changes, it triggers a process to potentially display a Gutenberg notice.
     * The subscription is automatically stopped if the notice becomes visible.
     *
     * @since 1.9.5
     */
    subscribeForBlockEditor: function subscribeForBlockEditor() {
      var prevTitle = app.getEditorTitle();
      var subscribe = wp.data.subscribe;

      // Subscribe to WordPress data changes.
      var unsubscribe = subscribe(function () {
        var title = app.getEditorTitle();

        // Check if the title has changed since the previous value.
        if (prevTitle === title) {
          return;
        }

        // Update the previous title to the current title.
        prevTitle = title;
        app.maybeShowGutenbergNotice();

        // If the notice is visible, stop the WordPress data subscription.
        if (app.isNoticeVisible) {
          unsubscribe();
        }
      });
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
    getEditorTitle: function getEditorTitle() {
      var select = wp.data.select;

      // Retrieve the title for Post Editor.
      if (!select(coreEditSite)) {
        return select(coreEditor).getEditedPostAttribute('title');
      }
      if (app.isEditPostFSE()) {
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
    getTopmostHeadingTitle: function getTopmostHeadingTitle() {
      var _headingBlock$attribu, _headingBlock$attribu2;
      var select = wp.data.select;
      var headings = select(coreBlockEditor).getBlocksByName(coreHeading);
      if (!headings.length) {
        return '';
      }
      var headingBlock = select(coreBlockEditor).getBlock(headings[0]);
      return (_headingBlock$attribu = headingBlock === null || headingBlock === void 0 || (_headingBlock$attribu2 = headingBlock.attributes) === null || _headingBlock$attribu2 === void 0 || (_headingBlock$attribu2 = _headingBlock$attribu2.content) === null || _headingBlock$attribu2 === void 0 ? void 0 : _headingBlock$attribu2.text) !== null && _headingBlock$attribu !== void 0 ? _headingBlock$attribu : '';
    },
    /**
     * Determines if the current editing context is for a post type in the Full Site Editor (FSE).
     *
     * @since 1.9.5
     *
     * @return {boolean} True if the current context represents a post type in the FSE, otherwise false.
     */
    isEditPostFSE: function isEditPostFSE() {
      var select = wp.data.select;
      var _select$getPage = select(coreEditSite).getPage(),
        context = _select$getPage.context;
      return !!(context !== null && context !== void 0 && context.postType);
    },
    /**
     * Retrieves the title of a post based on its type and ID from the current editing context.
     *
     * @since 1.9.5
     *
     * @return {string} The title of the post.
     */
    getPostTitle: function getPostTitle() {
      var select = wp.data.select;
      var _select$getPage2 = select(coreEditSite).getPage(),
        context = _select$getPage2.context;

      // Use `getEditedEntityRecord` instead of `getEntityRecord`
      // to fetch the live, updated data for the post being edited.
      var _ref = select('core').getEditedEntityRecord('postType', context.postType, context.postId) || {},
        _ref$title = _ref.title,
        title = _ref$title === void 0 ? '' : _ref$title;
      return title;
    },
    /**
     * Bind events for Classic Editor.
     *
     * @since 1.8.1
     */
    bindClassicEvents: function bindClassicEvents() {
      var $document = $(document);
      if (!app.isNoticeVisible) {
        $document.on('input', '#title', _.debounce(app.maybeShowClassicNotice, 1000));
      }
      $document.on('click', '.wpforms-edit-post-education-notice-close', app.closeNotice);
    },
    /**
     * Determine if the editor is Gutenberg.
     *
     * @since 1.8.1
     *
     * @return {boolean} True if the editor is Gutenberg.
     */
    isGutenbergEditor: function isGutenbergEditor() {
      return typeof wp !== 'undefined' && typeof wp.blocks !== 'undefined';
    },
    /**
     * Create a notice for Gutenberg.
     *
     * @since 1.8.1
     */
    showGutenbergNotice: function showGutenbergNotice() {
      wp.data.dispatch(coreNotices).createInfoNotice(wpforms_edit_post_education.gutenberg_notice.template, app.getGutenbergNoticeSettings());

      // The notice component doesn't have a way to add HTML id or class to the notice.
      // Also, the notice became visible with a delay on old Gutenberg versions.
      var hasNotice = setInterval(function () {
        var noticeBody = $('.wpforms-edit-post-education-notice-body');
        if (!noticeBody.length) {
          return;
        }
        var $notice = noticeBody.closest('.components-notice');
        $notice.addClass('wpforms-edit-post-education-notice');
        $notice.find('.is-secondary, .is-link').removeClass('is-secondary').removeClass('is-link').addClass('is-primary');

        // We can't use onDismiss callback as it was introduced in WordPress 6.0 only.
        var dismissButton = $notice.find('.components-notice__dismiss');
        if (dismissButton) {
          dismissButton.on('click', function () {
            app.updateUserMeta();
          });
        }
        clearInterval(hasNotice);
      }, 100);
    },
    /**
     * Get settings for the Gutenberg notice.
     *
     * @since 1.8.1
     *
     * @return {Object} Notice settings.
     */
    getGutenbergNoticeSettings: function getGutenbergNoticeSettings() {
      var noticeSettings = {
        id: app.pluginId,
        isDismissible: true,
        HTML: true,
        __unstableHTML: true,
        actions: [{
          className: 'wpforms-edit-post-education-notice-guide-button',
          variant: 'primary',
          label: wpforms_edit_post_education.gutenberg_notice.button
        }]
      };
      if (!wpforms_edit_post_education.gutenberg_guide) {
        noticeSettings.actions[0].url = wpforms_edit_post_education.gutenberg_notice.url;
        return noticeSettings;
      }
      var Guide = wp.components.Guide,
        useState = wp.element.useState,
        _wp$plugins = wp.plugins,
        registerPlugin = _wp$plugins.registerPlugin,
        unregisterPlugin = _wp$plugins.unregisterPlugin;
      var GutenbergTutorial = function GutenbergTutorial() {
        var _useState = useState(true),
          _useState2 = _slicedToArray(_useState, 2),
          isOpen = _useState2[0],
          setIsOpen = _useState2[1];
        if (!isOpen) {
          return null;
        }
        return (
          /*#__PURE__*/
          // eslint-disable-next-line react/react-in-jsx-scope
          React.createElement(Guide, {
            className: "edit-post-welcome-guide",
            onFinish: function onFinish() {
              unregisterPlugin(app.pluginId);
              setIsOpen(false);
            },
            pages: app.getGuidePages()
          })
        );
      };
      noticeSettings.actions[0].onClick = function () {
        return registerPlugin(app.pluginId, {
          render: GutenbergTutorial
        });
      };
      return noticeSettings;
    },
    /**
     * Get Guide pages in proper format.
     *
     * @since 1.8.1
     *
     * @return {Array} Guide Pages.
     */
    getGuidePages: function getGuidePages() {
      var pages = [];
      wpforms_edit_post_education.gutenberg_guide.forEach(function (page) {
        pages.push({
          /* eslint-disable react/react-in-jsx-scope */
          content: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("h1", {
            className: "edit-post-welcome-guide__heading"
          }, page.title), /*#__PURE__*/React.createElement("p", {
            className: "edit-post-welcome-guide__text"
          }, page.content)),
          image: /*#__PURE__*/React.createElement("img", {
            className: "edit-post-welcome-guide__image",
            src: page.image,
            alt: page.title
          })
          /* eslint-enable react/react-in-jsx-scope */
        });
      });
      return pages;
    },
    /**
     * Show notice if the page title matches some keywords for Classic Editor.
     *
     * @since 1.8.1
     */
    maybeShowClassicNotice: function maybeShowClassicNotice() {
      if (app.isNoticeVisible) {
        return;
      }
      if (app.isTitleMatchKeywords($('#title').val())) {
        app.isNoticeVisible = true;
        $('.wpforms-edit-post-education-notice').removeClass('wpforms-hidden');
      }
    },
    /**
     * Show notice if the page title matches some keywords for Gutenberg Editor.
     *
     * @since 1.8.1
     */
    maybeShowGutenbergNotice: function maybeShowGutenbergNotice() {
      if (app.isNoticeVisible) {
        return;
      }
      var title = app.getEditorTitle();
      if (app.isTitleMatchKeywords(title)) {
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
    isTitleMatchKeywords: function isTitleMatchKeywords(titleValue) {
      var expectedTitleRegex = new RegExp(/\b(contact|form)\b/i);
      return expectedTitleRegex.test(titleValue);
    },
    /**
     * Close a notice.
     *
     * @since 1.8.1
     */
    closeNotice: function closeNotice() {
      $(this).closest('.wpforms-edit-post-education-notice').remove();
      app.updateUserMeta();
    },
    /**
     * Update user meta and don't show the notice next time.
     *
     * @since 1.8.1
     */
    updateUserMeta: function updateUserMeta() {
      $.post(wpforms_edit_post_education.ajax_url, {
        action: 'wpforms_education_dismiss',
        nonce: wpforms_edit_post_education.education_nonce,
        section: 'edit-post-notice'
      });
    }
  };
  return app;
}(document, window, jQuery);
WPFormsEditPostEducation.init();
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJXUEZvcm1zRWRpdFBvc3RFZHVjYXRpb24iLCJ3aW5kb3ciLCJkb2N1bWVudCIsIiQiLCJjb3JlRWRpdFNpdGUiLCJjb3JlRWRpdG9yIiwiY29yZUJsb2NrRWRpdG9yIiwiY29yZU5vdGljZXMiLCJjb3JlSGVhZGluZyIsImFwcCIsImlzTm90aWNlVmlzaWJsZSIsInBsdWdpbklkIiwiaW5pdCIsIm9uIiwicmVhZHkiLCJ0aGVuIiwibG9hZCIsImlzR3V0ZW5iZXJnRWRpdG9yIiwibWF5YmVTaG93Q2xhc3NpY05vdGljZSIsImJpbmRDbGFzc2ljRXZlbnRzIiwibWF5YmVTaG93R3V0ZW5iZXJnTm90aWNlIiwid3AiLCJkYXRhIiwic2VsZWN0Iiwic3Vic2NyaWJlRm9yU2l0ZUVkaXRvciIsInN1YnNjcmliZUZvckJsb2NrRWRpdG9yIiwicHJldlRpdGxlIiwiZ2V0RWRpdG9yVGl0bGUiLCJwcmV2Rm9jdXNNb2RlIiwiX3dwJGRhdGEiLCJzdWJzY3JpYmUiLCJkaXNwYXRjaCIsIl9zZWxlY3QkZ2V0RWRpdG9yU2V0dCIsImdldEVkaXRvclNldHRpbmdzIiwiZm9jdXNNb2RlIiwicmVtb3ZlTm90aWNlIiwidGl0bGUiLCJ1bnN1YnNjcmliZSIsImdldEVkaXRlZFBvc3RBdHRyaWJ1dGUiLCJpc0VkaXRQb3N0RlNFIiwiZ2V0UG9zdFRpdGxlIiwiZ2V0VG9wbW9zdEhlYWRpbmdUaXRsZSIsIl9oZWFkaW5nQmxvY2skYXR0cmlidSIsIl9oZWFkaW5nQmxvY2skYXR0cmlidTIiLCJoZWFkaW5ncyIsImdldEJsb2Nrc0J5TmFtZSIsImxlbmd0aCIsImhlYWRpbmdCbG9jayIsImdldEJsb2NrIiwiYXR0cmlidXRlcyIsImNvbnRlbnQiLCJ0ZXh0IiwiX3NlbGVjdCRnZXRQYWdlIiwiZ2V0UGFnZSIsImNvbnRleHQiLCJwb3N0VHlwZSIsIl9zZWxlY3QkZ2V0UGFnZTIiLCJfcmVmIiwiZ2V0RWRpdGVkRW50aXR5UmVjb3JkIiwicG9zdElkIiwiX3JlZiR0aXRsZSIsIiRkb2N1bWVudCIsIl8iLCJkZWJvdW5jZSIsImNsb3NlTm90aWNlIiwiYmxvY2tzIiwic2hvd0d1dGVuYmVyZ05vdGljZSIsImNyZWF0ZUluZm9Ob3RpY2UiLCJ3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24iLCJndXRlbmJlcmdfbm90aWNlIiwidGVtcGxhdGUiLCJnZXRHdXRlbmJlcmdOb3RpY2VTZXR0aW5ncyIsImhhc05vdGljZSIsInNldEludGVydmFsIiwibm90aWNlQm9keSIsIiRub3RpY2UiLCJjbG9zZXN0IiwiYWRkQ2xhc3MiLCJmaW5kIiwicmVtb3ZlQ2xhc3MiLCJkaXNtaXNzQnV0dG9uIiwidXBkYXRlVXNlck1ldGEiLCJjbGVhckludGVydmFsIiwibm90aWNlU2V0dGluZ3MiLCJpZCIsImlzRGlzbWlzc2libGUiLCJIVE1MIiwiX191bnN0YWJsZUhUTUwiLCJhY3Rpb25zIiwiY2xhc3NOYW1lIiwidmFyaWFudCIsImxhYmVsIiwiYnV0dG9uIiwiZ3V0ZW5iZXJnX2d1aWRlIiwidXJsIiwiR3VpZGUiLCJjb21wb25lbnRzIiwidXNlU3RhdGUiLCJlbGVtZW50IiwiX3dwJHBsdWdpbnMiLCJwbHVnaW5zIiwicmVnaXN0ZXJQbHVnaW4iLCJ1bnJlZ2lzdGVyUGx1Z2luIiwiR3V0ZW5iZXJnVHV0b3JpYWwiLCJfdXNlU3RhdGUiLCJfdXNlU3RhdGUyIiwiX3NsaWNlZFRvQXJyYXkiLCJpc09wZW4iLCJzZXRJc09wZW4iLCJSZWFjdCIsImNyZWF0ZUVsZW1lbnQiLCJvbkZpbmlzaCIsInBhZ2VzIiwiZ2V0R3VpZGVQYWdlcyIsIm9uQ2xpY2siLCJyZW5kZXIiLCJmb3JFYWNoIiwicGFnZSIsInB1c2giLCJGcmFnbWVudCIsImltYWdlIiwic3JjIiwiYWx0IiwiaXNUaXRsZU1hdGNoS2V5d29yZHMiLCJ2YWwiLCJ0aXRsZVZhbHVlIiwiZXhwZWN0ZWRUaXRsZVJlZ2V4IiwiUmVnRXhwIiwidGVzdCIsInJlbW92ZSIsInBvc3QiLCJhamF4X3VybCIsImFjdGlvbiIsIm5vbmNlIiwiZWR1Y2F0aW9uX25vbmNlIiwic2VjdGlvbiIsImpRdWVyeSJdLCJzb3VyY2VzIjpbImZha2VfNGI3MjBlYTEuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLyogZ2xvYmFsIHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbiAqL1xuXG4vLyBub2luc3BlY3Rpb24gRVM2Q29udmVydFZhclRvTGV0Q29uc3Rcbi8qKlxuICogV1BGb3JtcyBFZGl0IFBvc3QgRWR1Y2F0aW9uIGZ1bmN0aW9uLlxuICpcbiAqIEBzaW5jZSAxLjguMVxuICovXG5cbi8vIGVzbGludC1kaXNhYmxlLW5leHQtbGluZSBuby12YXIsIG5vLXVudXNlZC12YXJzXG52YXIgV1BGb3Jtc0VkaXRQb3N0RWR1Y2F0aW9uID0gd2luZG93LldQRm9ybXNFZGl0UG9zdEVkdWNhdGlvbiB8fCAoIGZ1bmN0aW9uKCBkb2N1bWVudCwgd2luZG93LCAkICkge1xuXHQvLyBUaGUgaWRlbnRpZmllcnMgZm9yIHRoZSBSZWR1eCBzdG9yZXMuXG5cdGNvbnN0IGNvcmVFZGl0U2l0ZSA9ICdjb3JlL2VkaXQtc2l0ZScsXG5cdFx0Y29yZUVkaXRvciA9ICdjb3JlL2VkaXRvcicsXG5cdFx0Y29yZUJsb2NrRWRpdG9yID0gJ2NvcmUvYmxvY2stZWRpdG9yJyxcblx0XHRjb3JlTm90aWNlcyA9ICdjb3JlL25vdGljZXMnLFxuXG5cdFx0Ly8gSGVhZGluZyBibG9jayBuYW1lLlxuXHRcdGNvcmVIZWFkaW5nID0gJ2NvcmUvaGVhZGluZyc7XG5cblx0LyoqXG5cdCAqIFB1YmxpYyBmdW5jdGlvbnMgYW5kIHByb3BlcnRpZXMuXG5cdCAqXG5cdCAqIEBzaW5jZSAxLjguMVxuXHQgKlxuXHQgKiBAdHlwZSB7T2JqZWN0fVxuXHQgKi9cblx0Y29uc3QgYXBwID0ge1xuXG5cdFx0LyoqXG5cdFx0ICogRGV0ZXJtaW5lIGlmIHRoZSBub3RpY2Ugd2FzIHNob3duIGJlZm9yZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdGlzTm90aWNlVmlzaWJsZTogZmFsc2UsXG5cblx0XHQvKipcblx0XHQgKiBJZGVudGlmaWVyIGZvciB0aGUgcGx1Z2luIGFuZCBub3RpY2UuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS45LjVcblx0XHQgKi9cblx0XHRwbHVnaW5JZDogJ3dwZm9ybXMtZWRpdC1wb3N0LXByb2R1Y3QtZWR1Y2F0aW9uLWd1aWRlJyxcblxuXHRcdC8qKlxuXHRcdCAqIFN0YXJ0IHRoZSBlbmdpbmUuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKi9cblx0XHRpbml0KCkge1xuXHRcdFx0JCggd2luZG93ICkub24oICdsb2FkJywgZnVuY3Rpb24oKSB7XG5cdFx0XHRcdC8vIEluIHRoZSBjYXNlIG9mIGpRdWVyeSAzLissIHdlIG5lZWQgdG8gd2FpdCBmb3IgYSByZWFkeSBldmVudCBmaXJzdC5cblx0XHRcdFx0aWYgKCB0eXBlb2YgJC5yZWFkeS50aGVuID09PSAnZnVuY3Rpb24nICkge1xuXHRcdFx0XHRcdCQucmVhZHkudGhlbiggYXBwLmxvYWQgKTtcblx0XHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0XHRhcHAubG9hZCgpO1xuXHRcdFx0XHR9XG5cdFx0XHR9ICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIFBhZ2UgbG9hZC5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqIEBzaW5jZSAxLjkuNSBBZGRlZCBjb21wYXRpYmlsaXR5IGZvciB0aGUgU2l0ZSBFZGl0b3IuXG5cdFx0ICovXG5cdFx0bG9hZCgpIHtcblx0XHRcdGlmICggISBhcHAuaXNHdXRlbmJlcmdFZGl0b3IoKSApIHtcblx0XHRcdFx0YXBwLm1heWJlU2hvd0NsYXNzaWNOb3RpY2UoKTtcblx0XHRcdFx0YXBwLmJpbmRDbGFzc2ljRXZlbnRzKCk7XG5cblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRhcHAubWF5YmVTaG93R3V0ZW5iZXJnTm90aWNlKCk7XG5cblx0XHRcdC8vIFwiY29yZS9lZGl0LXNpdGVcIiBzdG9yZSBhdmFpbGFibGUgb25seSBpbiB0aGUgU2l0ZSBFZGl0b3IuXG5cdFx0XHRpZiAoICEhIHdwLmRhdGEuc2VsZWN0KCBjb3JlRWRpdFNpdGUgKSApIHtcblx0XHRcdFx0YXBwLnN1YnNjcmliZUZvclNpdGVFZGl0b3IoKTtcblxuXHRcdFx0XHRyZXR1cm47XG5cdFx0XHR9XG5cblx0XHRcdGFwcC5zdWJzY3JpYmVGb3JCbG9ja0VkaXRvcigpO1xuXHRcdH0sXG5cblx0XHQvKipcblx0XHQgKiBUaGlzIG1ldGhvZCBsaXN0ZW5zIGZvciBjaGFuZ2VzIGluIHRoZSBXb3JkUHJlc3MgZGF0YSBzdG9yZSBhbmQgcGVyZm9ybXMgdGhlIGZvbGxvd2luZyBhY3Rpb25zOlxuXHRcdCAqIC0gTW9uaXRvcnMgdGhlIGVkaXRvciB0aXRsZSBhbmQgZm9jdXMgbW9kZSB0byBkZXRlY3QgY2hhbmdlcy5cblx0XHQgKiAtIERpc21pc3NlcyBhIGN1c3RvbSBub3RpY2UgaWYgdGhlIGZvY3VzIG1vZGUgaXMgZGlzYWJsZWQgYW5kIHRoZSBub3RpY2UgaXMgdmlzaWJsZS5cblx0XHQgKiAtIFNob3dzIGEgY3VzdG9tIEd1dGVuYmVyZyBub3RpY2UgaWYgdGhlIHRpdGxlIG9yIGZvY3VzIG1vZGUgY2hhbmdlcy5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjkuNVxuXHRcdCAqL1xuXHRcdHN1YnNjcmliZUZvclNpdGVFZGl0b3IoKSB7XG5cdFx0XHQvLyBTdG9yZSB0aGUgaW5pdGlhbCBlZGl0b3IgdGl0bGUgYW5kIGZvY3VzIG1vZGUgc3RhdGUuXG5cdFx0XHRsZXQgcHJldlRpdGxlID0gYXBwLmdldEVkaXRvclRpdGxlKCk7XG5cdFx0XHRsZXQgcHJldkZvY3VzTW9kZSA9IG51bGw7XG5cdFx0XHRjb25zdCB7IHN1YnNjcmliZSwgc2VsZWN0LCBkaXNwYXRjaCB9ID0gd3AuZGF0YTtcblxuXHRcdFx0Ly8gTGlzdGVuIGZvciBjaGFuZ2VzIGluIHRoZSBXb3JkUHJlc3MgZGF0YSBzdG9yZS5cblx0XHRcdHN1YnNjcmliZSggKCkgPT4ge1xuXHRcdFx0XHQvLyBGZXRjaCB0aGUgY3VycmVudCBlZGl0b3IgbW9kZSBzZXR0aW5nLlxuXHRcdFx0XHQvLyBJZiB0cnVlIC0gU2l0ZSBFZGl0b3IgY2FudmFzIGlzIG9wZW5lZCwgYW5kIHlvdSBjYW4gZWRpdCBzb21ldGhpbmcuXG5cdFx0XHRcdC8vIElmIGZhbHNlIC0geW91IHNob3VsZCBzZWUgdGhlIHNpZGViYXIgd2l0aCBuYXZpZ2F0aW9uIGFuZCBwcmV2aWV3XG5cdFx0XHRcdC8vIHdpdGggc2VsZWN0ZWQgdGVtcGxhdGUgb3IgcGFnZS5cblx0XHRcdFx0Y29uc3QgeyBmb2N1c01vZGUgfSA9IHNlbGVjdCggY29yZUVkaXRvciApLmdldEVkaXRvclNldHRpbmdzKCk7XG5cblx0XHRcdFx0Ly8gSWYgZm9jdXMgbW9kZSBpcyBkaXNhYmxlZCBhbmQgYSBub3RpY2UgaXMgdmlzaWJsZSwgcmVtb3ZlIHRoZSBub3RpY2UuXG5cdFx0XHRcdC8vIFRoaXMgaXMgZXNzZW50aWFsIGJlY2F1c2UgdXNlciBjYW4gc3dpdGNoIHBhZ2VzIC8gdGVtcGxhdGVzXG5cdFx0XHRcdC8vIHdpdGhvdXQgYSBwYWdlLXJlbG9hZC5cblx0XHRcdFx0aWYgKCAhIGZvY3VzTW9kZSAmJiBhcHAuaXNOb3RpY2VWaXNpYmxlICkge1xuXHRcdFx0XHRcdGFwcC5pc05vdGljZVZpc2libGUgPSBmYWxzZTtcblx0XHRcdFx0XHRwcmV2Rm9jdXNNb2RlID0gZm9jdXNNb2RlO1xuXG5cdFx0XHRcdFx0ZGlzcGF0Y2goIGNvcmVOb3RpY2VzICkucmVtb3ZlTm90aWNlKCBhcHAucGx1Z2luSWQgKTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdGNvbnN0IHRpdGxlID0gYXBwLmdldEVkaXRvclRpdGxlKCk7XG5cblx0XHRcdFx0Ly8gSWYgbmVpdGhlciB0aGUgdGl0bGUgbm9yIHRoZSBmb2N1cyBtb2RlIGhhcyBjaGFuZ2VkLCBkbyBub3RoaW5nLlxuXHRcdFx0XHRpZiAoIHByZXZUaXRsZSA9PT0gdGl0bGUgJiYgcHJldkZvY3VzTW9kZSA9PT0gZm9jdXNNb2RlICkge1xuXHRcdFx0XHRcdHJldHVybjtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdC8vIFVwZGF0ZSB0aGUgcHJldmlvdXMgdGl0bGUgYW5kIGZvY3VzIG1vZGUgdmFsdWVzIGZvciB0aGUgbmV4dCBzdWJzY3JpcHRpb24gY3ljbGUuXG5cdFx0XHRcdHByZXZUaXRsZSA9IHRpdGxlO1xuXHRcdFx0XHRwcmV2Rm9jdXNNb2RlID0gZm9jdXNNb2RlO1xuXG5cdFx0XHRcdC8vIFNob3cgYSBjdXN0b20gR3V0ZW5iZXJnIG5vdGljZSBpZiBjb25kaXRpb25zIGFyZSBtZXQuXG5cdFx0XHRcdGFwcC5tYXliZVNob3dHdXRlbmJlcmdOb3RpY2UoKTtcblx0XHRcdH0gKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogU3Vic2NyaWJlcyB0byBjaGFuZ2VzIGluIHRoZSBXb3JkUHJlc3MgYmxvY2sgZWRpdG9yIGFuZCBtb25pdG9ycyB0aGUgZWRpdG9yJ3MgdGl0bGUuXG5cdFx0ICogV2hlbiB0aGUgdGl0bGUgY2hhbmdlcywgaXQgdHJpZ2dlcnMgYSBwcm9jZXNzIHRvIHBvdGVudGlhbGx5IGRpc3BsYXkgYSBHdXRlbmJlcmcgbm90aWNlLlxuXHRcdCAqIFRoZSBzdWJzY3JpcHRpb24gaXMgYXV0b21hdGljYWxseSBzdG9wcGVkIGlmIHRoZSBub3RpY2UgYmVjb21lcyB2aXNpYmxlLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOS41XG5cdFx0ICovXG5cdFx0c3Vic2NyaWJlRm9yQmxvY2tFZGl0b3IoKSB7XG5cdFx0XHRsZXQgcHJldlRpdGxlID0gYXBwLmdldEVkaXRvclRpdGxlKCk7XG5cdFx0XHRjb25zdCB7IHN1YnNjcmliZSB9ID0gd3AuZGF0YTtcblxuXHRcdFx0Ly8gU3Vic2NyaWJlIHRvIFdvcmRQcmVzcyBkYXRhIGNoYW5nZXMuXG5cdFx0XHRjb25zdCB1bnN1YnNjcmliZSA9IHN1YnNjcmliZSggKCkgPT4ge1xuXHRcdFx0XHRjb25zdCB0aXRsZSA9IGFwcC5nZXRFZGl0b3JUaXRsZSgpO1xuXG5cdFx0XHRcdC8vIENoZWNrIGlmIHRoZSB0aXRsZSBoYXMgY2hhbmdlZCBzaW5jZSB0aGUgcHJldmlvdXMgdmFsdWUuXG5cdFx0XHRcdGlmICggcHJldlRpdGxlID09PSB0aXRsZSApIHtcblx0XHRcdFx0XHRyZXR1cm47XG5cdFx0XHRcdH1cblxuXHRcdFx0XHQvLyBVcGRhdGUgdGhlIHByZXZpb3VzIHRpdGxlIHRvIHRoZSBjdXJyZW50IHRpdGxlLlxuXHRcdFx0XHRwcmV2VGl0bGUgPSB0aXRsZTtcblxuXHRcdFx0XHRhcHAubWF5YmVTaG93R3V0ZW5iZXJnTm90aWNlKCk7XG5cblx0XHRcdFx0Ly8gSWYgdGhlIG5vdGljZSBpcyB2aXNpYmxlLCBzdG9wIHRoZSBXb3JkUHJlc3MgZGF0YSBzdWJzY3JpcHRpb24uXG5cdFx0XHRcdGlmICggYXBwLmlzTm90aWNlVmlzaWJsZSApIHtcblx0XHRcdFx0XHR1bnN1YnNjcmliZSgpO1xuXHRcdFx0XHR9XG5cdFx0XHR9ICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIFJldHJpZXZlcyB0aGUgdGl0bGUgb2YgdGhlIHBvc3QgY3VycmVudGx5IGJlaW5nIGVkaXRlZC4gSWYgaW4gdGhlIFNpdGUgRWRpdG9yLFxuXHRcdCAqIGl0IGF0dGVtcHRzIHRvIGZldGNoIHRoZSB0aXRsZSBmcm9tIHRoZSB0b3Btb3N0IGhlYWRpbmcgYmxvY2suIE90aGVyd2lzZSwgaXRcblx0XHQgKiByZXRyaWV2ZXMgdGhlIHRpdGxlIGF0dHJpYnV0ZSBvZiB0aGUgZWRpdGVkIHBvc3QuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS45LjVcblx0XHQgKlxuXHRcdCAqIEByZXR1cm4ge3N0cmluZ30gVGhlIHBvc3QgdGl0bGUgb3IgYW4gZW1wdHkgc3RyaW5nIGlmIG5vIHRpdGxlIGlzIGZvdW5kLlxuXHRcdCAqL1xuXHRcdGdldEVkaXRvclRpdGxlKCkge1xuXHRcdFx0Y29uc3QgeyBzZWxlY3QgfSA9IHdwLmRhdGE7XG5cblx0XHRcdC8vIFJldHJpZXZlIHRoZSB0aXRsZSBmb3IgUG9zdCBFZGl0b3IuXG5cdFx0XHRpZiAoICEgc2VsZWN0KCBjb3JlRWRpdFNpdGUgKSApIHtcblx0XHRcdFx0cmV0dXJuIHNlbGVjdCggY29yZUVkaXRvciApLmdldEVkaXRlZFBvc3RBdHRyaWJ1dGUoICd0aXRsZScgKTtcblx0XHRcdH1cblxuXHRcdFx0aWYgKCBhcHAuaXNFZGl0UG9zdEZTRSgpICkge1xuXHRcdFx0XHRyZXR1cm4gYXBwLmdldFBvc3RUaXRsZSgpO1xuXHRcdFx0fVxuXG5cdFx0XHRyZXR1cm4gYXBwLmdldFRvcG1vc3RIZWFkaW5nVGl0bGUoKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogUmV0cmlldmVzIHRoZSBjb250ZW50IG9mIHRoZSBmaXJzdCBoZWFkaW5nIGJsb2NrLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOS41XG5cdFx0ICpcblx0XHQgKiBAcmV0dXJuIHtzdHJpbmd9IFRoZSB0b3Btb3N0IGhlYWRpbmcgY29udGVudCBvciBudWxsIGlmIG5vdCBmb3VuZC5cblx0XHQgKi9cblx0XHRnZXRUb3Btb3N0SGVhZGluZ1RpdGxlKCkge1xuXHRcdFx0Y29uc3QgeyBzZWxlY3QgfSA9IHdwLmRhdGE7XG5cblx0XHRcdGNvbnN0IGhlYWRpbmdzID0gc2VsZWN0KCBjb3JlQmxvY2tFZGl0b3IgKS5nZXRCbG9ja3NCeU5hbWUoIGNvcmVIZWFkaW5nICk7XG5cblx0XHRcdGlmICggISBoZWFkaW5ncy5sZW5ndGggKSB7XG5cdFx0XHRcdHJldHVybiAnJztcblx0XHRcdH1cblxuXHRcdFx0Y29uc3QgaGVhZGluZ0Jsb2NrID0gc2VsZWN0KCBjb3JlQmxvY2tFZGl0b3IgKS5nZXRCbG9jayggaGVhZGluZ3NbIDAgXSApO1xuXG5cdFx0XHRyZXR1cm4gaGVhZGluZ0Jsb2NrPy5hdHRyaWJ1dGVzPy5jb250ZW50Py50ZXh0ID8/ICcnO1xuXHRcdH0sXG5cblx0XHQvKipcblx0XHQgKiBEZXRlcm1pbmVzIGlmIHRoZSBjdXJyZW50IGVkaXRpbmcgY29udGV4dCBpcyBmb3IgYSBwb3N0IHR5cGUgaW4gdGhlIEZ1bGwgU2l0ZSBFZGl0b3IgKEZTRSkuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS45LjVcblx0XHQgKlxuXHRcdCAqIEByZXR1cm4ge2Jvb2xlYW59IFRydWUgaWYgdGhlIGN1cnJlbnQgY29udGV4dCByZXByZXNlbnRzIGEgcG9zdCB0eXBlIGluIHRoZSBGU0UsIG90aGVyd2lzZSBmYWxzZS5cblx0XHQgKi9cblx0XHRpc0VkaXRQb3N0RlNFKCkge1xuXHRcdFx0Y29uc3QgeyBzZWxlY3QgfSA9IHdwLmRhdGE7XG5cdFx0XHRjb25zdCB7IGNvbnRleHQgfSA9IHNlbGVjdCggY29yZUVkaXRTaXRlICkuZ2V0UGFnZSgpO1xuXG5cdFx0XHRyZXR1cm4gISEgY29udGV4dD8ucG9zdFR5cGU7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIFJldHJpZXZlcyB0aGUgdGl0bGUgb2YgYSBwb3N0IGJhc2VkIG9uIGl0cyB0eXBlIGFuZCBJRCBmcm9tIHRoZSBjdXJyZW50IGVkaXRpbmcgY29udGV4dC5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjkuNVxuXHRcdCAqXG5cdFx0ICogQHJldHVybiB7c3RyaW5nfSBUaGUgdGl0bGUgb2YgdGhlIHBvc3QuXG5cdFx0ICovXG5cdFx0Z2V0UG9zdFRpdGxlKCkge1xuXHRcdFx0Y29uc3QgeyBzZWxlY3QgfSA9IHdwLmRhdGE7XG5cdFx0XHRjb25zdCB7IGNvbnRleHQgfSA9IHNlbGVjdCggY29yZUVkaXRTaXRlICkuZ2V0UGFnZSgpO1xuXG5cdFx0XHQvLyBVc2UgYGdldEVkaXRlZEVudGl0eVJlY29yZGAgaW5zdGVhZCBvZiBgZ2V0RW50aXR5UmVjb3JkYFxuXHRcdFx0Ly8gdG8gZmV0Y2ggdGhlIGxpdmUsIHVwZGF0ZWQgZGF0YSBmb3IgdGhlIHBvc3QgYmVpbmcgZWRpdGVkLlxuXHRcdFx0Y29uc3QgeyB0aXRsZSA9ICcnIH0gPSBzZWxlY3QoICdjb3JlJyApLmdldEVkaXRlZEVudGl0eVJlY29yZChcblx0XHRcdFx0J3Bvc3RUeXBlJyxcblx0XHRcdFx0Y29udGV4dC5wb3N0VHlwZSxcblx0XHRcdFx0Y29udGV4dC5wb3N0SWRcblx0XHRcdCkgfHwge307XG5cblx0XHRcdHJldHVybiB0aXRsZTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogQmluZCBldmVudHMgZm9yIENsYXNzaWMgRWRpdG9yLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xXG5cdFx0ICovXG5cdFx0YmluZENsYXNzaWNFdmVudHMoKSB7XG5cdFx0XHRjb25zdCAkZG9jdW1lbnQgPSAkKCBkb2N1bWVudCApO1xuXG5cdFx0XHRpZiAoICEgYXBwLmlzTm90aWNlVmlzaWJsZSApIHtcblx0XHRcdFx0JGRvY3VtZW50Lm9uKCAnaW5wdXQnLCAnI3RpdGxlJywgXy5kZWJvdW5jZSggYXBwLm1heWJlU2hvd0NsYXNzaWNOb3RpY2UsIDEwMDAgKSApO1xuXHRcdFx0fVxuXG5cdFx0XHQkZG9jdW1lbnQub24oICdjbGljaycsICcud3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZS1jbG9zZScsIGFwcC5jbG9zZU5vdGljZSApO1xuXHRcdH0sXG5cblx0XHQvKipcblx0XHQgKiBEZXRlcm1pbmUgaWYgdGhlIGVkaXRvciBpcyBHdXRlbmJlcmcuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKlxuXHRcdCAqIEByZXR1cm4ge2Jvb2xlYW59IFRydWUgaWYgdGhlIGVkaXRvciBpcyBHdXRlbmJlcmcuXG5cdFx0ICovXG5cdFx0aXNHdXRlbmJlcmdFZGl0b3IoKSB7XG5cdFx0XHRyZXR1cm4gdHlwZW9mIHdwICE9PSAndW5kZWZpbmVkJyAmJiB0eXBlb2Ygd3AuYmxvY2tzICE9PSAndW5kZWZpbmVkJztcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogQ3JlYXRlIGEgbm90aWNlIGZvciBHdXRlbmJlcmcuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKi9cblx0XHRzaG93R3V0ZW5iZXJnTm90aWNlKCkge1xuXHRcdFx0d3AuZGF0YS5kaXNwYXRjaCggY29yZU5vdGljZXMgKS5jcmVhdGVJbmZvTm90aWNlKFxuXHRcdFx0XHR3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24uZ3V0ZW5iZXJnX25vdGljZS50ZW1wbGF0ZSxcblx0XHRcdFx0YXBwLmdldEd1dGVuYmVyZ05vdGljZVNldHRpbmdzKClcblx0XHRcdCk7XG5cblx0XHRcdC8vIFRoZSBub3RpY2UgY29tcG9uZW50IGRvZXNuJ3QgaGF2ZSBhIHdheSB0byBhZGQgSFRNTCBpZCBvciBjbGFzcyB0byB0aGUgbm90aWNlLlxuXHRcdFx0Ly8gQWxzbywgdGhlIG5vdGljZSBiZWNhbWUgdmlzaWJsZSB3aXRoIGEgZGVsYXkgb24gb2xkIEd1dGVuYmVyZyB2ZXJzaW9ucy5cblx0XHRcdGNvbnN0IGhhc05vdGljZSA9IHNldEludGVydmFsKCBmdW5jdGlvbigpIHtcblx0XHRcdFx0Y29uc3Qgbm90aWNlQm9keSA9ICQoICcud3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZS1ib2R5JyApO1xuXHRcdFx0XHRpZiAoICEgbm90aWNlQm9keS5sZW5ndGggKSB7XG5cdFx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0XHR9XG5cblx0XHRcdFx0Y29uc3QgJG5vdGljZSA9IG5vdGljZUJvZHkuY2xvc2VzdCggJy5jb21wb25lbnRzLW5vdGljZScgKTtcblx0XHRcdFx0JG5vdGljZS5hZGRDbGFzcyggJ3dwZm9ybXMtZWRpdC1wb3N0LWVkdWNhdGlvbi1ub3RpY2UnICk7XG5cdFx0XHRcdCRub3RpY2UuZmluZCggJy5pcy1zZWNvbmRhcnksIC5pcy1saW5rJyApLnJlbW92ZUNsYXNzKCAnaXMtc2Vjb25kYXJ5JyApLnJlbW92ZUNsYXNzKCAnaXMtbGluaycgKS5hZGRDbGFzcyggJ2lzLXByaW1hcnknICk7XG5cblx0XHRcdFx0Ly8gV2UgY2FuJ3QgdXNlIG9uRGlzbWlzcyBjYWxsYmFjayBhcyBpdCB3YXMgaW50cm9kdWNlZCBpbiBXb3JkUHJlc3MgNi4wIG9ubHkuXG5cdFx0XHRcdGNvbnN0IGRpc21pc3NCdXR0b24gPSAkbm90aWNlLmZpbmQoICcuY29tcG9uZW50cy1ub3RpY2VfX2Rpc21pc3MnICk7XG5cdFx0XHRcdGlmICggZGlzbWlzc0J1dHRvbiApIHtcblx0XHRcdFx0XHRkaXNtaXNzQnV0dG9uLm9uKCAnY2xpY2snLCBmdW5jdGlvbigpIHtcblx0XHRcdFx0XHRcdGFwcC51cGRhdGVVc2VyTWV0YSgpO1xuXHRcdFx0XHRcdH0gKTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdGNsZWFySW50ZXJ2YWwoIGhhc05vdGljZSApO1xuXHRcdFx0fSwgMTAwICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIEdldCBzZXR0aW5ncyBmb3IgdGhlIEd1dGVuYmVyZyBub3RpY2UuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKlxuXHRcdCAqIEByZXR1cm4ge09iamVjdH0gTm90aWNlIHNldHRpbmdzLlxuXHRcdCAqL1xuXHRcdGdldEd1dGVuYmVyZ05vdGljZVNldHRpbmdzKCkge1xuXHRcdFx0Y29uc3Qgbm90aWNlU2V0dGluZ3MgPSB7XG5cdFx0XHRcdGlkOiBhcHAucGx1Z2luSWQsXG5cdFx0XHRcdGlzRGlzbWlzc2libGU6IHRydWUsXG5cdFx0XHRcdEhUTUw6IHRydWUsXG5cdFx0XHRcdF9fdW5zdGFibGVIVE1MOiB0cnVlLFxuXHRcdFx0XHRhY3Rpb25zOiBbXG5cdFx0XHRcdFx0e1xuXHRcdFx0XHRcdFx0Y2xhc3NOYW1lOiAnd3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZS1ndWlkZS1idXR0b24nLFxuXHRcdFx0XHRcdFx0dmFyaWFudDogJ3ByaW1hcnknLFxuXHRcdFx0XHRcdFx0bGFiZWw6IHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbi5ndXRlbmJlcmdfbm90aWNlLmJ1dHRvbixcblx0XHRcdFx0XHR9LFxuXHRcdFx0XHRdLFxuXHRcdFx0fTtcblxuXHRcdFx0aWYgKCAhIHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbi5ndXRlbmJlcmdfZ3VpZGUgKSB7XG5cdFx0XHRcdG5vdGljZVNldHRpbmdzLmFjdGlvbnNbIDAgXS51cmwgPSB3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24uZ3V0ZW5iZXJnX25vdGljZS51cmw7XG5cblx0XHRcdFx0cmV0dXJuIG5vdGljZVNldHRpbmdzO1xuXHRcdFx0fVxuXG5cdFx0XHRjb25zdCB7IEd1aWRlIH0gPSB3cC5jb21wb25lbnRzLFxuXHRcdFx0XHR7IHVzZVN0YXRlIH0gPSB3cC5lbGVtZW50LFxuXHRcdFx0XHR7IHJlZ2lzdGVyUGx1Z2luLCB1bnJlZ2lzdGVyUGx1Z2luIH0gPSB3cC5wbHVnaW5zO1xuXG5cdFx0XHRjb25zdCBHdXRlbmJlcmdUdXRvcmlhbCA9IGZ1bmN0aW9uKCkge1xuXHRcdFx0XHRjb25zdCBbIGlzT3Blbiwgc2V0SXNPcGVuIF0gPSB1c2VTdGF0ZSggdHJ1ZSApO1xuXG5cdFx0XHRcdGlmICggISBpc09wZW4gKSB7XG5cdFx0XHRcdFx0cmV0dXJuIG51bGw7XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRyZXR1cm4gKFxuXHRcdFx0XHRcdC8vIGVzbGludC1kaXNhYmxlLW5leHQtbGluZSByZWFjdC9yZWFjdC1pbi1qc3gtc2NvcGVcblx0XHRcdFx0XHQ8R3VpZGVcblx0XHRcdFx0XHRcdGNsYXNzTmFtZT1cImVkaXQtcG9zdC13ZWxjb21lLWd1aWRlXCJcblx0XHRcdFx0XHRcdG9uRmluaXNoPXsgKCkgPT4ge1xuXHRcdFx0XHRcdFx0XHR1bnJlZ2lzdGVyUGx1Z2luKCBhcHAucGx1Z2luSWQgKTtcblx0XHRcdFx0XHRcdFx0c2V0SXNPcGVuKCBmYWxzZSApO1xuXHRcdFx0XHRcdFx0fSB9XG5cdFx0XHRcdFx0XHRwYWdlcz17IGFwcC5nZXRHdWlkZVBhZ2VzKCkgfVxuXHRcdFx0XHRcdC8+XG5cdFx0XHRcdCk7XG5cdFx0XHR9O1xuXG5cdFx0XHRub3RpY2VTZXR0aW5ncy5hY3Rpb25zWyAwIF0ub25DbGljayA9ICgpID0+IHJlZ2lzdGVyUGx1Z2luKCBhcHAucGx1Z2luSWQsIHsgcmVuZGVyOiBHdXRlbmJlcmdUdXRvcmlhbCB9ICk7XG5cblx0XHRcdHJldHVybiBub3RpY2VTZXR0aW5ncztcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogR2V0IEd1aWRlIHBhZ2VzIGluIHByb3BlciBmb3JtYXQuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKlxuXHRcdCAqIEByZXR1cm4ge0FycmF5fSBHdWlkZSBQYWdlcy5cblx0XHQgKi9cblx0XHRnZXRHdWlkZVBhZ2VzKCkge1xuXHRcdFx0Y29uc3QgcGFnZXMgPSBbXTtcblxuXHRcdFx0d3Bmb3Jtc19lZGl0X3Bvc3RfZWR1Y2F0aW9uLmd1dGVuYmVyZ19ndWlkZS5mb3JFYWNoKCBmdW5jdGlvbiggcGFnZSApIHtcblx0XHRcdFx0cGFnZXMucHVzaChcblx0XHRcdFx0XHR7XG5cdFx0XHRcdFx0XHQvKiBlc2xpbnQtZGlzYWJsZSByZWFjdC9yZWFjdC1pbi1qc3gtc2NvcGUgKi9cblx0XHRcdFx0XHRcdGNvbnRlbnQ6IChcblx0XHRcdFx0XHRcdFx0PD5cblx0XHRcdFx0XHRcdFx0XHQ8aDEgY2xhc3NOYW1lPVwiZWRpdC1wb3N0LXdlbGNvbWUtZ3VpZGVfX2hlYWRpbmdcIj57IHBhZ2UudGl0bGUgfTwvaDE+XG5cdFx0XHRcdFx0XHRcdFx0PHAgY2xhc3NOYW1lPVwiZWRpdC1wb3N0LXdlbGNvbWUtZ3VpZGVfX3RleHRcIj57IHBhZ2UuY29udGVudCB9PC9wPlxuXHRcdFx0XHRcdFx0XHQ8Lz5cblx0XHRcdFx0XHRcdCksXG5cdFx0XHRcdFx0XHRpbWFnZTogPGltZyBjbGFzc05hbWU9XCJlZGl0LXBvc3Qtd2VsY29tZS1ndWlkZV9faW1hZ2VcIiBzcmM9eyBwYWdlLmltYWdlIH0gYWx0PXsgcGFnZS50aXRsZSB9IC8+LFxuXHRcdFx0XHRcdFx0LyogZXNsaW50LWVuYWJsZSByZWFjdC9yZWFjdC1pbi1qc3gtc2NvcGUgKi9cblx0XHRcdFx0XHR9XG5cdFx0XHRcdCk7XG5cdFx0XHR9ICk7XG5cblx0XHRcdHJldHVybiBwYWdlcztcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogU2hvdyBub3RpY2UgaWYgdGhlIHBhZ2UgdGl0bGUgbWF0Y2hlcyBzb21lIGtleXdvcmRzIGZvciBDbGFzc2ljIEVkaXRvci5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdG1heWJlU2hvd0NsYXNzaWNOb3RpY2UoKSB7XG5cdFx0XHRpZiAoIGFwcC5pc05vdGljZVZpc2libGUgKSB7XG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuXHRcdFx0aWYgKCBhcHAuaXNUaXRsZU1hdGNoS2V5d29yZHMoICQoICcjdGl0bGUnICkudmFsKCkgKSApIHtcblx0XHRcdFx0YXBwLmlzTm90aWNlVmlzaWJsZSA9IHRydWU7XG5cblx0XHRcdFx0JCggJy53cGZvcm1zLWVkaXQtcG9zdC1lZHVjYXRpb24tbm90aWNlJyApLnJlbW92ZUNsYXNzKCAnd3Bmb3Jtcy1oaWRkZW4nICk7XG5cdFx0XHR9XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIFNob3cgbm90aWNlIGlmIHRoZSBwYWdlIHRpdGxlIG1hdGNoZXMgc29tZSBrZXl3b3JkcyBmb3IgR3V0ZW5iZXJnIEVkaXRvci5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdG1heWJlU2hvd0d1dGVuYmVyZ05vdGljZSgpIHtcblx0XHRcdGlmICggYXBwLmlzTm90aWNlVmlzaWJsZSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRjb25zdCB0aXRsZSA9IGFwcC5nZXRFZGl0b3JUaXRsZSgpO1xuXG5cdFx0XHRpZiAoIGFwcC5pc1RpdGxlTWF0Y2hLZXl3b3JkcyggdGl0bGUgKSApIHtcblx0XHRcdFx0YXBwLmlzTm90aWNlVmlzaWJsZSA9IHRydWU7XG5cblx0XHRcdFx0YXBwLnNob3dHdXRlbmJlcmdOb3RpY2UoKTtcblx0XHRcdH1cblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogRGV0ZXJtaW5lIGlmIHRoZSB0aXRsZSBtYXRjaGVzIGtleXdvcmRzLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xXG5cdFx0ICpcblx0XHQgKiBAcGFyYW0ge3N0cmluZ30gdGl0bGVWYWx1ZSBQYWdlIHRpdGxlIHZhbHVlLlxuXHRcdCAqXG5cdFx0ICogQHJldHVybiB7Ym9vbGVhbn0gVHJ1ZSBpZiB0aGUgdGl0bGUgbWF0Y2hlcyBzb21lIGtleXdvcmRzLlxuXHRcdCAqL1xuXHRcdGlzVGl0bGVNYXRjaEtleXdvcmRzKCB0aXRsZVZhbHVlICkge1xuXHRcdFx0Y29uc3QgZXhwZWN0ZWRUaXRsZVJlZ2V4ID0gbmV3IFJlZ0V4cCggL1xcYihjb250YWN0fGZvcm0pXFxiL2kgKTtcblxuXHRcdFx0cmV0dXJuIGV4cGVjdGVkVGl0bGVSZWdleC50ZXN0KCB0aXRsZVZhbHVlICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIENsb3NlIGEgbm90aWNlLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xXG5cdFx0ICovXG5cdFx0Y2xvc2VOb3RpY2UoKSB7XG5cdFx0XHQkKCB0aGlzICkuY2xvc2VzdCggJy53cGZvcm1zLWVkaXQtcG9zdC1lZHVjYXRpb24tbm90aWNlJyApLnJlbW92ZSgpO1xuXG5cdFx0XHRhcHAudXBkYXRlVXNlck1ldGEoKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogVXBkYXRlIHVzZXIgbWV0YSBhbmQgZG9uJ3Qgc2hvdyB0aGUgbm90aWNlIG5leHQgdGltZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdHVwZGF0ZVVzZXJNZXRhKCkge1xuXHRcdFx0JC5wb3N0KFxuXHRcdFx0XHR3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24uYWpheF91cmwsXG5cdFx0XHRcdHtcblx0XHRcdFx0XHRhY3Rpb246ICd3cGZvcm1zX2VkdWNhdGlvbl9kaXNtaXNzJyxcblx0XHRcdFx0XHRub25jZTogd3Bmb3Jtc19lZGl0X3Bvc3RfZWR1Y2F0aW9uLmVkdWNhdGlvbl9ub25jZSxcblx0XHRcdFx0XHRzZWN0aW9uOiAnZWRpdC1wb3N0LW5vdGljZScsXG5cdFx0XHRcdH1cblx0XHRcdCk7XG5cdFx0fSxcblx0fTtcblxuXHRyZXR1cm4gYXBwO1xufSggZG9jdW1lbnQsIHdpbmRvdywgalF1ZXJ5ICkgKTtcblxuV1BGb3Jtc0VkaXRQb3N0RWR1Y2F0aW9uLmluaXQoKTtcbiJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7QUFBQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQSxJQUFJQSx3QkFBd0IsR0FBR0MsTUFBTSxDQUFDRCx3QkFBd0IsSUFBTSxVQUFVRSxRQUFRLEVBQUVELE1BQU0sRUFBRUUsQ0FBQyxFQUFHO0VBQ25HO0VBQ0EsSUFBTUMsWUFBWSxHQUFHLGdCQUFnQjtJQUNwQ0MsVUFBVSxHQUFHLGFBQWE7SUFDMUJDLGVBQWUsR0FBRyxtQkFBbUI7SUFDckNDLFdBQVcsR0FBRyxjQUFjO0lBRTVCO0lBQ0FDLFdBQVcsR0FBRyxjQUFjOztFQUU3QjtBQUNEO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtFQUNDLElBQU1DLEdBQUcsR0FBRztJQUVYO0FBQ0Y7QUFDQTtBQUNBO0FBQ0E7SUFDRUMsZUFBZSxFQUFFLEtBQUs7SUFFdEI7QUFDRjtBQUNBO0FBQ0E7QUFDQTtJQUNFQyxRQUFRLEVBQUUsMkNBQTJDO0lBRXJEO0FBQ0Y7QUFDQTtBQUNBO0FBQ0E7SUFDRUMsSUFBSSxXQUFKQSxJQUFJQSxDQUFBLEVBQUc7TUFDTlQsQ0FBQyxDQUFFRixNQUFPLENBQUMsQ0FBQ1ksRUFBRSxDQUFFLE1BQU0sRUFBRSxZQUFXO1FBQ2xDO1FBQ0EsSUFBSyxPQUFPVixDQUFDLENBQUNXLEtBQUssQ0FBQ0MsSUFBSSxLQUFLLFVBQVUsRUFBRztVQUN6Q1osQ0FBQyxDQUFDVyxLQUFLLENBQUNDLElBQUksQ0FBRU4sR0FBRyxDQUFDTyxJQUFLLENBQUM7UUFDekIsQ0FBQyxNQUFNO1VBQ05QLEdBQUcsQ0FBQ08sSUFBSSxDQUFDLENBQUM7UUFDWDtNQUNELENBQUUsQ0FBQztJQUNKLENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7SUFDRUEsSUFBSSxXQUFKQSxJQUFJQSxDQUFBLEVBQUc7TUFDTixJQUFLLENBQUVQLEdBQUcsQ0FBQ1EsaUJBQWlCLENBQUMsQ0FBQyxFQUFHO1FBQ2hDUixHQUFHLENBQUNTLHNCQUFzQixDQUFDLENBQUM7UUFDNUJULEdBQUcsQ0FBQ1UsaUJBQWlCLENBQUMsQ0FBQztRQUV2QjtNQUNEO01BRUFWLEdBQUcsQ0FBQ1csd0JBQXdCLENBQUMsQ0FBQzs7TUFFOUI7TUFDQSxJQUFLLENBQUMsQ0FBRUMsRUFBRSxDQUFDQyxJQUFJLENBQUNDLE1BQU0sQ0FBRW5CLFlBQWEsQ0FBQyxFQUFHO1FBQ3hDSyxHQUFHLENBQUNlLHNCQUFzQixDQUFDLENBQUM7UUFFNUI7TUFDRDtNQUVBZixHQUFHLENBQUNnQix1QkFBdUIsQ0FBQyxDQUFDO0lBQzlCLENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0lBQ0VELHNCQUFzQixXQUF0QkEsc0JBQXNCQSxDQUFBLEVBQUc7TUFDeEI7TUFDQSxJQUFJRSxTQUFTLEdBQUdqQixHQUFHLENBQUNrQixjQUFjLENBQUMsQ0FBQztNQUNwQyxJQUFJQyxhQUFhLEdBQUcsSUFBSTtNQUN4QixJQUFBQyxRQUFBLEdBQXdDUixFQUFFLENBQUNDLElBQUk7UUFBdkNRLFNBQVMsR0FBQUQsUUFBQSxDQUFUQyxTQUFTO1FBQUVQLE1BQU0sR0FBQU0sUUFBQSxDQUFOTixNQUFNO1FBQUVRLFFBQVEsR0FBQUYsUUFBQSxDQUFSRSxRQUFROztNQUVuQztNQUNBRCxTQUFTLENBQUUsWUFBTTtRQUNoQjtRQUNBO1FBQ0E7UUFDQTtRQUNBLElBQUFFLHFCQUFBLEdBQXNCVCxNQUFNLENBQUVsQixVQUFXLENBQUMsQ0FBQzRCLGlCQUFpQixDQUFDLENBQUM7VUFBdERDLFNBQVMsR0FBQUYscUJBQUEsQ0FBVEUsU0FBUzs7UUFFakI7UUFDQTtRQUNBO1FBQ0EsSUFBSyxDQUFFQSxTQUFTLElBQUl6QixHQUFHLENBQUNDLGVBQWUsRUFBRztVQUN6Q0QsR0FBRyxDQUFDQyxlQUFlLEdBQUcsS0FBSztVQUMzQmtCLGFBQWEsR0FBR00sU0FBUztVQUV6QkgsUUFBUSxDQUFFeEIsV0FBWSxDQUFDLENBQUM0QixZQUFZLENBQUUxQixHQUFHLENBQUNFLFFBQVMsQ0FBQztRQUNyRDtRQUVBLElBQU15QixLQUFLLEdBQUczQixHQUFHLENBQUNrQixjQUFjLENBQUMsQ0FBQzs7UUFFbEM7UUFDQSxJQUFLRCxTQUFTLEtBQUtVLEtBQUssSUFBSVIsYUFBYSxLQUFLTSxTQUFTLEVBQUc7VUFDekQ7UUFDRDs7UUFFQTtRQUNBUixTQUFTLEdBQUdVLEtBQUs7UUFDakJSLGFBQWEsR0FBR00sU0FBUzs7UUFFekI7UUFDQXpCLEdBQUcsQ0FBQ1csd0JBQXdCLENBQUMsQ0FBQztNQUMvQixDQUFFLENBQUM7SUFDSixDQUFDO0lBRUQ7QUFDRjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7SUFDRUssdUJBQXVCLFdBQXZCQSx1QkFBdUJBLENBQUEsRUFBRztNQUN6QixJQUFJQyxTQUFTLEdBQUdqQixHQUFHLENBQUNrQixjQUFjLENBQUMsQ0FBQztNQUNwQyxJQUFRRyxTQUFTLEdBQUtULEVBQUUsQ0FBQ0MsSUFBSSxDQUFyQlEsU0FBUzs7TUFFakI7TUFDQSxJQUFNTyxXQUFXLEdBQUdQLFNBQVMsQ0FBRSxZQUFNO1FBQ3BDLElBQU1NLEtBQUssR0FBRzNCLEdBQUcsQ0FBQ2tCLGNBQWMsQ0FBQyxDQUFDOztRQUVsQztRQUNBLElBQUtELFNBQVMsS0FBS1UsS0FBSyxFQUFHO1VBQzFCO1FBQ0Q7O1FBRUE7UUFDQVYsU0FBUyxHQUFHVSxLQUFLO1FBRWpCM0IsR0FBRyxDQUFDVyx3QkFBd0IsQ0FBQyxDQUFDOztRQUU5QjtRQUNBLElBQUtYLEdBQUcsQ0FBQ0MsZUFBZSxFQUFHO1VBQzFCMkIsV0FBVyxDQUFDLENBQUM7UUFDZDtNQUNELENBQUUsQ0FBQztJQUNKLENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7SUFDRVYsY0FBYyxXQUFkQSxjQUFjQSxDQUFBLEVBQUc7TUFDaEIsSUFBUUosTUFBTSxHQUFLRixFQUFFLENBQUNDLElBQUksQ0FBbEJDLE1BQU07O01BRWQ7TUFDQSxJQUFLLENBQUVBLE1BQU0sQ0FBRW5CLFlBQWEsQ0FBQyxFQUFHO1FBQy9CLE9BQU9tQixNQUFNLENBQUVsQixVQUFXLENBQUMsQ0FBQ2lDLHNCQUFzQixDQUFFLE9BQVEsQ0FBQztNQUM5RDtNQUVBLElBQUs3QixHQUFHLENBQUM4QixhQUFhLENBQUMsQ0FBQyxFQUFHO1FBQzFCLE9BQU85QixHQUFHLENBQUMrQixZQUFZLENBQUMsQ0FBQztNQUMxQjtNQUVBLE9BQU8vQixHQUFHLENBQUNnQyxzQkFBc0IsQ0FBQyxDQUFDO0lBQ3BDLENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtJQUNFQSxzQkFBc0IsV0FBdEJBLHNCQUFzQkEsQ0FBQSxFQUFHO01BQUEsSUFBQUMscUJBQUEsRUFBQUMsc0JBQUE7TUFDeEIsSUFBUXBCLE1BQU0sR0FBS0YsRUFBRSxDQUFDQyxJQUFJLENBQWxCQyxNQUFNO01BRWQsSUFBTXFCLFFBQVEsR0FBR3JCLE1BQU0sQ0FBRWpCLGVBQWdCLENBQUMsQ0FBQ3VDLGVBQWUsQ0FBRXJDLFdBQVksQ0FBQztNQUV6RSxJQUFLLENBQUVvQyxRQUFRLENBQUNFLE1BQU0sRUFBRztRQUN4QixPQUFPLEVBQUU7TUFDVjtNQUVBLElBQU1DLFlBQVksR0FBR3hCLE1BQU0sQ0FBRWpCLGVBQWdCLENBQUMsQ0FBQzBDLFFBQVEsQ0FBRUosUUFBUSxDQUFFLENBQUMsQ0FBRyxDQUFDO01BRXhFLFFBQUFGLHFCQUFBLEdBQU9LLFlBQVksYUFBWkEsWUFBWSxnQkFBQUosc0JBQUEsR0FBWkksWUFBWSxDQUFFRSxVQUFVLGNBQUFOLHNCQUFBLGdCQUFBQSxzQkFBQSxHQUF4QkEsc0JBQUEsQ0FBMEJPLE9BQU8sY0FBQVAsc0JBQUEsdUJBQWpDQSxzQkFBQSxDQUFtQ1EsSUFBSSxjQUFBVCxxQkFBQSxjQUFBQSxxQkFBQSxHQUFJLEVBQUU7SUFDckQsQ0FBQztJQUVEO0FBQ0Y7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0lBQ0VILGFBQWEsV0FBYkEsYUFBYUEsQ0FBQSxFQUFHO01BQ2YsSUFBUWhCLE1BQU0sR0FBS0YsRUFBRSxDQUFDQyxJQUFJLENBQWxCQyxNQUFNO01BQ2QsSUFBQTZCLGVBQUEsR0FBb0I3QixNQUFNLENBQUVuQixZQUFhLENBQUMsQ0FBQ2lELE9BQU8sQ0FBQyxDQUFDO1FBQTVDQyxPQUFPLEdBQUFGLGVBQUEsQ0FBUEUsT0FBTztNQUVmLE9BQU8sQ0FBQyxFQUFFQSxPQUFPLGFBQVBBLE9BQU8sZUFBUEEsT0FBTyxDQUFFQyxRQUFRO0lBQzVCLENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtJQUNFZixZQUFZLFdBQVpBLFlBQVlBLENBQUEsRUFBRztNQUNkLElBQVFqQixNQUFNLEdBQUtGLEVBQUUsQ0FBQ0MsSUFBSSxDQUFsQkMsTUFBTTtNQUNkLElBQUFpQyxnQkFBQSxHQUFvQmpDLE1BQU0sQ0FBRW5CLFlBQWEsQ0FBQyxDQUFDaUQsT0FBTyxDQUFDLENBQUM7UUFBNUNDLE9BQU8sR0FBQUUsZ0JBQUEsQ0FBUEYsT0FBTzs7TUFFZjtNQUNBO01BQ0EsSUFBQUcsSUFBQSxHQUF1QmxDLE1BQU0sQ0FBRSxNQUFPLENBQUMsQ0FBQ21DLHFCQUFxQixDQUM1RCxVQUFVLEVBQ1ZKLE9BQU8sQ0FBQ0MsUUFBUSxFQUNoQkQsT0FBTyxDQUFDSyxNQUNULENBQUMsSUFBSSxDQUFDLENBQUM7UUFBQUMsVUFBQSxHQUFBSCxJQUFBLENBSkNyQixLQUFLO1FBQUxBLEtBQUssR0FBQXdCLFVBQUEsY0FBRyxFQUFFLEdBQUFBLFVBQUE7TUFNbEIsT0FBT3hCLEtBQUs7SUFDYixDQUFDO0lBRUQ7QUFDRjtBQUNBO0FBQ0E7QUFDQTtJQUNFakIsaUJBQWlCLFdBQWpCQSxpQkFBaUJBLENBQUEsRUFBRztNQUNuQixJQUFNMEMsU0FBUyxHQUFHMUQsQ0FBQyxDQUFFRCxRQUFTLENBQUM7TUFFL0IsSUFBSyxDQUFFTyxHQUFHLENBQUNDLGVBQWUsRUFBRztRQUM1Qm1ELFNBQVMsQ0FBQ2hELEVBQUUsQ0FBRSxPQUFPLEVBQUUsUUFBUSxFQUFFaUQsQ0FBQyxDQUFDQyxRQUFRLENBQUV0RCxHQUFHLENBQUNTLHNCQUFzQixFQUFFLElBQUssQ0FBRSxDQUFDO01BQ2xGO01BRUEyQyxTQUFTLENBQUNoRCxFQUFFLENBQUUsT0FBTyxFQUFFLDJDQUEyQyxFQUFFSixHQUFHLENBQUN1RCxXQUFZLENBQUM7SUFDdEYsQ0FBQztJQUVEO0FBQ0Y7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0lBQ0UvQyxpQkFBaUIsV0FBakJBLGlCQUFpQkEsQ0FBQSxFQUFHO01BQ25CLE9BQU8sT0FBT0ksRUFBRSxLQUFLLFdBQVcsSUFBSSxPQUFPQSxFQUFFLENBQUM0QyxNQUFNLEtBQUssV0FBVztJQUNyRSxDQUFDO0lBRUQ7QUFDRjtBQUNBO0FBQ0E7QUFDQTtJQUNFQyxtQkFBbUIsV0FBbkJBLG1CQUFtQkEsQ0FBQSxFQUFHO01BQ3JCN0MsRUFBRSxDQUFDQyxJQUFJLENBQUNTLFFBQVEsQ0FBRXhCLFdBQVksQ0FBQyxDQUFDNEQsZ0JBQWdCLENBQy9DQywyQkFBMkIsQ0FBQ0MsZ0JBQWdCLENBQUNDLFFBQVEsRUFDckQ3RCxHQUFHLENBQUM4RCwwQkFBMEIsQ0FBQyxDQUNoQyxDQUFDOztNQUVEO01BQ0E7TUFDQSxJQUFNQyxTQUFTLEdBQUdDLFdBQVcsQ0FBRSxZQUFXO1FBQ3pDLElBQU1DLFVBQVUsR0FBR3ZFLENBQUMsQ0FBRSwwQ0FBMkMsQ0FBQztRQUNsRSxJQUFLLENBQUV1RSxVQUFVLENBQUM1QixNQUFNLEVBQUc7VUFDMUI7UUFDRDtRQUVBLElBQU02QixPQUFPLEdBQUdELFVBQVUsQ0FBQ0UsT0FBTyxDQUFFLG9CQUFxQixDQUFDO1FBQzFERCxPQUFPLENBQUNFLFFBQVEsQ0FBRSxvQ0FBcUMsQ0FBQztRQUN4REYsT0FBTyxDQUFDRyxJQUFJLENBQUUseUJBQTBCLENBQUMsQ0FBQ0MsV0FBVyxDQUFFLGNBQWUsQ0FBQyxDQUFDQSxXQUFXLENBQUUsU0FBVSxDQUFDLENBQUNGLFFBQVEsQ0FBRSxZQUFhLENBQUM7O1FBRXpIO1FBQ0EsSUFBTUcsYUFBYSxHQUFHTCxPQUFPLENBQUNHLElBQUksQ0FBRSw2QkFBOEIsQ0FBQztRQUNuRSxJQUFLRSxhQUFhLEVBQUc7VUFDcEJBLGFBQWEsQ0FBQ25FLEVBQUUsQ0FBRSxPQUFPLEVBQUUsWUFBVztZQUNyQ0osR0FBRyxDQUFDd0UsY0FBYyxDQUFDLENBQUM7VUFDckIsQ0FBRSxDQUFDO1FBQ0o7UUFFQUMsYUFBYSxDQUFFVixTQUFVLENBQUM7TUFDM0IsQ0FBQyxFQUFFLEdBQUksQ0FBQztJQUNULENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtJQUNFRCwwQkFBMEIsV0FBMUJBLDBCQUEwQkEsQ0FBQSxFQUFHO01BQzVCLElBQU1ZLGNBQWMsR0FBRztRQUN0QkMsRUFBRSxFQUFFM0UsR0FBRyxDQUFDRSxRQUFRO1FBQ2hCMEUsYUFBYSxFQUFFLElBQUk7UUFDbkJDLElBQUksRUFBRSxJQUFJO1FBQ1ZDLGNBQWMsRUFBRSxJQUFJO1FBQ3BCQyxPQUFPLEVBQUUsQ0FDUjtVQUNDQyxTQUFTLEVBQUUsaURBQWlEO1VBQzVEQyxPQUFPLEVBQUUsU0FBUztVQUNsQkMsS0FBSyxFQUFFdkIsMkJBQTJCLENBQUNDLGdCQUFnQixDQUFDdUI7UUFDckQsQ0FBQztNQUVILENBQUM7TUFFRCxJQUFLLENBQUV4QiwyQkFBMkIsQ0FBQ3lCLGVBQWUsRUFBRztRQUNwRFYsY0FBYyxDQUFDSyxPQUFPLENBQUUsQ0FBQyxDQUFFLENBQUNNLEdBQUcsR0FBRzFCLDJCQUEyQixDQUFDQyxnQkFBZ0IsQ0FBQ3lCLEdBQUc7UUFFbEYsT0FBT1gsY0FBYztNQUN0QjtNQUVNLElBQUVZLEtBQUssR0FBSzFFLEVBQUUsQ0FBQzJFLFVBQVUsQ0FBdkJELEtBQUs7UUFDVkUsUUFBUSxHQUFLNUUsRUFBRSxDQUFDNkUsT0FBTyxDQUF2QkQsUUFBUTtRQUFBRSxXQUFBLEdBQzZCOUUsRUFBRSxDQUFDK0UsT0FBTztRQUEvQ0MsY0FBYyxHQUFBRixXQUFBLENBQWRFLGNBQWM7UUFBRUMsZ0JBQWdCLEdBQUFILFdBQUEsQ0FBaEJHLGdCQUFnQjtNQUVuQyxJQUFNQyxpQkFBaUIsR0FBRyxTQUFwQkEsaUJBQWlCQSxDQUFBLEVBQWM7UUFDcEMsSUFBQUMsU0FBQSxHQUE4QlAsUUFBUSxDQUFFLElBQUssQ0FBQztVQUFBUSxVQUFBLEdBQUFDLGNBQUEsQ0FBQUYsU0FBQTtVQUF0Q0csTUFBTSxHQUFBRixVQUFBO1VBQUVHLFNBQVMsR0FBQUgsVUFBQTtRQUV6QixJQUFLLENBQUVFLE1BQU0sRUFBRztVQUNmLE9BQU8sSUFBSTtRQUNaO1FBRUE7VUFBQTtVQUNDO1VBQ0FFLEtBQUEsQ0FBQUMsYUFBQSxDQUFDZixLQUFLO1lBQ0xOLFNBQVMsRUFBQyx5QkFBeUI7WUFDbkNzQixRQUFRLEVBQUcsU0FBWEEsUUFBUUEsQ0FBQSxFQUFTO2NBQ2hCVCxnQkFBZ0IsQ0FBRTdGLEdBQUcsQ0FBQ0UsUUFBUyxDQUFDO2NBQ2hDaUcsU0FBUyxDQUFFLEtBQU0sQ0FBQztZQUNuQixDQUFHO1lBQ0hJLEtBQUssRUFBR3ZHLEdBQUcsQ0FBQ3dHLGFBQWEsQ0FBQztVQUFHLENBQzdCO1FBQUM7TUFFSixDQUFDO01BRUQ5QixjQUFjLENBQUNLLE9BQU8sQ0FBRSxDQUFDLENBQUUsQ0FBQzBCLE9BQU8sR0FBRztRQUFBLE9BQU1iLGNBQWMsQ0FBRTVGLEdBQUcsQ0FBQ0UsUUFBUSxFQUFFO1VBQUV3RyxNQUFNLEVBQUVaO1FBQWtCLENBQUUsQ0FBQztNQUFBO01BRXpHLE9BQU9wQixjQUFjO0lBQ3RCLENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtJQUNFOEIsYUFBYSxXQUFiQSxhQUFhQSxDQUFBLEVBQUc7TUFDZixJQUFNRCxLQUFLLEdBQUcsRUFBRTtNQUVoQjVDLDJCQUEyQixDQUFDeUIsZUFBZSxDQUFDdUIsT0FBTyxDQUFFLFVBQVVDLElBQUksRUFBRztRQUNyRUwsS0FBSyxDQUFDTSxJQUFJLENBQ1Q7VUFDQztVQUNBcEUsT0FBTyxlQUNOMkQsS0FBQSxDQUFBQyxhQUFBLENBQUFELEtBQUEsQ0FBQVUsUUFBQSxxQkFDQ1YsS0FBQSxDQUFBQyxhQUFBO1lBQUlyQixTQUFTLEVBQUM7VUFBa0MsR0FBRzRCLElBQUksQ0FBQ2pGLEtBQVcsQ0FBQyxlQUNwRXlFLEtBQUEsQ0FBQUMsYUFBQTtZQUFHckIsU0FBUyxFQUFDO1VBQStCLEdBQUc0QixJQUFJLENBQUNuRSxPQUFZLENBQy9ELENBQ0Y7VUFDRHNFLEtBQUssZUFBRVgsS0FBQSxDQUFBQyxhQUFBO1lBQUtyQixTQUFTLEVBQUMsZ0NBQWdDO1lBQUNnQyxHQUFHLEVBQUdKLElBQUksQ0FBQ0csS0FBTztZQUFDRSxHQUFHLEVBQUdMLElBQUksQ0FBQ2pGO1VBQU8sQ0FBRTtVQUM5RjtRQUNELENBQ0QsQ0FBQztNQUNGLENBQUUsQ0FBQztNQUVILE9BQU80RSxLQUFLO0lBQ2IsQ0FBQztJQUVEO0FBQ0Y7QUFDQTtBQUNBO0FBQ0E7SUFDRTlGLHNCQUFzQixXQUF0QkEsc0JBQXNCQSxDQUFBLEVBQUc7TUFDeEIsSUFBS1QsR0FBRyxDQUFDQyxlQUFlLEVBQUc7UUFDMUI7TUFDRDtNQUVBLElBQUtELEdBQUcsQ0FBQ2tILG9CQUFvQixDQUFFeEgsQ0FBQyxDQUFFLFFBQVMsQ0FBQyxDQUFDeUgsR0FBRyxDQUFDLENBQUUsQ0FBQyxFQUFHO1FBQ3REbkgsR0FBRyxDQUFDQyxlQUFlLEdBQUcsSUFBSTtRQUUxQlAsQ0FBQyxDQUFFLHFDQUFzQyxDQUFDLENBQUM0RSxXQUFXLENBQUUsZ0JBQWlCLENBQUM7TUFDM0U7SUFDRCxDQUFDO0lBRUQ7QUFDRjtBQUNBO0FBQ0E7QUFDQTtJQUNFM0Qsd0JBQXdCLFdBQXhCQSx3QkFBd0JBLENBQUEsRUFBRztNQUMxQixJQUFLWCxHQUFHLENBQUNDLGVBQWUsRUFBRztRQUMxQjtNQUNEO01BRUEsSUFBTTBCLEtBQUssR0FBRzNCLEdBQUcsQ0FBQ2tCLGNBQWMsQ0FBQyxDQUFDO01BRWxDLElBQUtsQixHQUFHLENBQUNrSCxvQkFBb0IsQ0FBRXZGLEtBQU0sQ0FBQyxFQUFHO1FBQ3hDM0IsR0FBRyxDQUFDQyxlQUFlLEdBQUcsSUFBSTtRQUUxQkQsR0FBRyxDQUFDeUQsbUJBQW1CLENBQUMsQ0FBQztNQUMxQjtJQUNELENBQUM7SUFFRDtBQUNGO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7SUFDRXlELG9CQUFvQixXQUFwQkEsb0JBQW9CQSxDQUFFRSxVQUFVLEVBQUc7TUFDbEMsSUFBTUMsa0JBQWtCLEdBQUcsSUFBSUMsTUFBTSxDQUFFLHFCQUFzQixDQUFDO01BRTlELE9BQU9ELGtCQUFrQixDQUFDRSxJQUFJLENBQUVILFVBQVcsQ0FBQztJQUM3QyxDQUFDO0lBRUQ7QUFDRjtBQUNBO0FBQ0E7QUFDQTtJQUNFN0QsV0FBVyxXQUFYQSxXQUFXQSxDQUFBLEVBQUc7TUFDYjdELENBQUMsQ0FBRSxJQUFLLENBQUMsQ0FBQ3lFLE9BQU8sQ0FBRSxxQ0FBc0MsQ0FBQyxDQUFDcUQsTUFBTSxDQUFDLENBQUM7TUFFbkV4SCxHQUFHLENBQUN3RSxjQUFjLENBQUMsQ0FBQztJQUNyQixDQUFDO0lBRUQ7QUFDRjtBQUNBO0FBQ0E7QUFDQTtJQUNFQSxjQUFjLFdBQWRBLGNBQWNBLENBQUEsRUFBRztNQUNoQjlFLENBQUMsQ0FBQytILElBQUksQ0FDTDlELDJCQUEyQixDQUFDK0QsUUFBUSxFQUNwQztRQUNDQyxNQUFNLEVBQUUsMkJBQTJCO1FBQ25DQyxLQUFLLEVBQUVqRSwyQkFBMkIsQ0FBQ2tFLGVBQWU7UUFDbERDLE9BQU8sRUFBRTtNQUNWLENBQ0QsQ0FBQztJQUNGO0VBQ0QsQ0FBQztFQUVELE9BQU85SCxHQUFHO0FBQ1gsQ0FBQyxDQUFFUCxRQUFRLEVBQUVELE1BQU0sRUFBRXVJLE1BQU8sQ0FBRztBQUUvQnhJLHdCQUF3QixDQUFDWSxJQUFJLENBQUMsQ0FBQyIsImlnbm9yZUxpc3QiOltdfQ==
},{}]},{},[1])