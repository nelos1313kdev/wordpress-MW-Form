(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/* global wpforms_settings */

(function () {
  /**
   * Predefine hint text to display.
   *
   * @since 1.5.6
   * @since 1.6.4 Added a new macros - {remaining}.
   *
   * @param {string} hintText Hint text.
   * @param {number} count    Current count.
   * @param {number} limit    Limit to.
   *
   * @return {string} Predefined hint text.
   */
  function renderHint(hintText, count, limit) {
    return hintText.replace('{count}', count).replace('{limit}', limit).replace('{remaining}', limit - count);
  }

  /**
   * Create HTMLElement hint element with text.
   *
   * @since 1.5.6
   *
   * @param {number|string} formId  Form id.
   * @param {number|string} fieldId Form field id.
   * @param {string}        text    Hint text.
   *
   * @return {Object} HTMLElement hint element with text.
   */
  function createHint(formId, fieldId, text) {
    var hint = document.createElement('div');
    formId = _typeof(formId) === 'object' ? '' : formId;
    fieldId = _typeof(fieldId) === 'object' ? '' : fieldId;
    hint.classList.add('wpforms-field-limit-text');
    hint.id = 'wpforms-field-limit-text-' + formId + '-' + fieldId;
    hint.setAttribute('aria-live', 'polite');
    hint.textContent = text;
    return hint;
  }

  /**
   * Keyup/Keydown event higher order function for characters limit.
   *
   * @since 1.5.6
   *
   * @param {Object} hint  HTMLElement hint element.
   * @param {number} limit Max allowed number of characters.
   *
   * @return {Function} Handler function.
   */
  function checkCharacters(hint, limit) {
    // noinspection JSUnusedLocalSymbols
    return function (e) {
      // eslint-disable-line no-unused-vars
      hint.textContent = renderHint(window.wpforms_settings.val_limit_characters, this.value.length, limit);
    };
  }

  /**
   * Count words in the string.
   *
   * @since 1.6.2
   *
   * @param {string} string String value.
   *
   * @return {number} Words count.
   */
  function countWords(string) {
    if (typeof string !== 'string') {
      return 0;
    }
    if (!string.length) {
      return 0;
    }
    [/([A-Z]+),([A-Z]+)/gi, /([0-9]+),([A-Z]+)/gi, /([A-Z]+),([0-9]+)/gi].forEach(function (pattern) {
      string = string.replace(pattern, '$1, $2');
    });
    return string.split(/\s+/).length;
  }

  /**
   * Keyup/Keydown event higher order function for words limit.
   *
   * @since 1.5.6
   *
   * @param {Object} hint  HTMLElement hint element.
   * @param {number} limit Max allowed number of characters.
   *
   * @return {Function} Handler function.
   */
  function checkWords(hint, limit) {
    return function (e) {
      var value = this.value.trim(),
        words = countWords(value);
      hint.textContent = renderHint(window.wpforms_settings.val_limit_words, words, limit);

      // We should prevent the keys: Enter, Space, Comma.
      if ([13, 32, 188].indexOf(e.keyCode) > -1 && words >= limit) {
        e.preventDefault();
      }
    };
  }

  /**
   * Get passed text from the clipboard.
   *
   * @since 1.5.6
   *
   * @param {ClipboardEvent} e Clipboard event.
   *
   * @return {string} Text from clipboard.
   */
  function getPastedText(e) {
    if (window.clipboardData && window.clipboardData.getData) {
      // IE
      return window.clipboardData.getData('Text');
    } else if (e.clipboardData && e.clipboardData.getData) {
      return e.clipboardData.getData('text/plain');
    }
    return '';
  }

  /**
   * Paste event higher order function for character limit.
   *
   * @since 1.6.7.1
   *
   * @param {number} limit Max allowed number of characters.
   *
   * @return {Function} Event handler.
   */
  function pasteText(limit) {
    return function (e) {
      e.preventDefault();
      var pastedText = getPastedText(e),
        newPosition = this.selectionStart + pastedText.length,
        newText = this.value.substring(0, this.selectionStart) + pastedText + this.value.substring(this.selectionStart);
      this.value = newText.substring(0, limit);
      this.setSelectionRange(newPosition, newPosition);
    };
  }

  /**
   * Limit string length to a certain number of words, preserving line breaks.
   *
   * @since 1.6.8
   *
   * @param {string} text  Text.
   * @param {number} limit Max allowed number of words.
   *
   * @return {string} Text with the limited number of words.
   */
  function limitWords(text, limit) {
    var result = '';

    // Regular expression pattern: match any space character.
    var regEx = /\s+/g;

    // Store separators for further join.
    var separators = text.trim().match(regEx) || [];

    // Split the new text by regular expression.
    var newTextArray = text.split(regEx);

    // Limit the number of words.
    newTextArray.splice(limit, newTextArray.length);

    // Join the words together using stored separators.
    for (var i = 0; i < newTextArray.length; i++) {
      result += newTextArray[i] + (separators[i] || '');
    }
    return result.trim();
  }

  /**
   * Paste event higher order function for words limit.
   *
   * @since 1.5.6
   *
   * @param {number} limit Max allowed number of words.
   *
   * @return {Function} Event handler.
   */
  function pasteWords(limit) {
    return function (e) {
      e.preventDefault();
      var pastedText = getPastedText(e),
        newPosition = this.selectionStart + pastedText.length,
        newText = this.value.substring(0, this.selectionStart) + pastedText + this.value.substring(this.selectionStart);
      this.value = limitWords(newText, limit);
      this.setSelectionRange(newPosition, newPosition);
    };
  }

  /**
   * Array.from polyfill.
   *
   * @since 1.5.6
   *
   * @param {Object} el Iterator.
   *
   * @return {Object} Array.
   */
  function arrFrom(el) {
    return [].slice.call(el);
  }

  /**
   * Remove existing hint.
   *
   * @since 1.9.5.1
   *
   * @param {Object} element Element.
   */
  var removeExistingHint = function removeExistingHint(element) {
    var existingHint = element.parentNode.querySelector('.wpforms-field-limit-text');
    if (existingHint) {
      existingHint.remove();
    }
  };

  /**
   * Public functions and properties.
   *
   * @since 1.8.9
   *
   * @type {Object}
   */
  var app = {
    /**
     * Init text limit hint.
     *
     * @since 1.8.9
     *
     * @param {string} context Context selector.
     */
    initHint: function initHint(context) {
      arrFrom(document.querySelectorAll(context + ' .wpforms-limit-characters-enabled')).map(function (e) {
        // eslint-disable-line array-callback-return
        var limit = parseInt(e.dataset.textLimit, 10) || 0;
        e.value = e.value.slice(0, limit);
        var hint = createHint(e.dataset.formId, e.dataset.fieldId, renderHint(wpforms_settings.val_limit_characters, e.value.length, limit));
        var fn = checkCharacters(hint, limit);
        removeExistingHint(e);
        e.parentNode.appendChild(hint);
        e.addEventListener('keydown', fn);
        e.addEventListener('keyup', fn);
        e.addEventListener('paste', pasteText(limit));
      });
      arrFrom(document.querySelectorAll(context + ' .wpforms-limit-words-enabled')).map(function (e) {
        // eslint-disable-line array-callback-return
        var limit = parseInt(e.dataset.textLimit, 10) || 0;
        e.value = limitWords(e.value, limit);
        var hint = createHint(e.dataset.formId, e.dataset.fieldId, renderHint(wpforms_settings.val_limit_words, countWords(e.value.trim()), limit));
        var fn = checkWords(hint, limit);
        removeExistingHint(e);
        e.parentNode.appendChild(hint);
        e.addEventListener('keydown', fn);
        e.addEventListener('keyup', fn);
        e.addEventListener('paste', pasteWords(limit));
      });
    }
  };

  /**
   * DOMContentLoaded handler.
   *
   * @since 1.5.6
   */
  function ready() {
    // Expose to the world.
    window.WPFormsTextLimit = app;
    app.initHint('body');
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
  } else {
    ready();
  }
})();
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJyZW5kZXJIaW50IiwiaGludFRleHQiLCJjb3VudCIsImxpbWl0IiwicmVwbGFjZSIsImNyZWF0ZUhpbnQiLCJmb3JtSWQiLCJmaWVsZElkIiwidGV4dCIsImhpbnQiLCJkb2N1bWVudCIsImNyZWF0ZUVsZW1lbnQiLCJfdHlwZW9mIiwiY2xhc3NMaXN0IiwiYWRkIiwiaWQiLCJzZXRBdHRyaWJ1dGUiLCJ0ZXh0Q29udGVudCIsImNoZWNrQ2hhcmFjdGVycyIsImUiLCJ3aW5kb3ciLCJ3cGZvcm1zX3NldHRpbmdzIiwidmFsX2xpbWl0X2NoYXJhY3RlcnMiLCJ2YWx1ZSIsImxlbmd0aCIsImNvdW50V29yZHMiLCJzdHJpbmciLCJmb3JFYWNoIiwicGF0dGVybiIsInNwbGl0IiwiY2hlY2tXb3JkcyIsInRyaW0iLCJ3b3JkcyIsInZhbF9saW1pdF93b3JkcyIsImluZGV4T2YiLCJrZXlDb2RlIiwicHJldmVudERlZmF1bHQiLCJnZXRQYXN0ZWRUZXh0IiwiY2xpcGJvYXJkRGF0YSIsImdldERhdGEiLCJwYXN0ZVRleHQiLCJwYXN0ZWRUZXh0IiwibmV3UG9zaXRpb24iLCJzZWxlY3Rpb25TdGFydCIsIm5ld1RleHQiLCJzdWJzdHJpbmciLCJzZXRTZWxlY3Rpb25SYW5nZSIsImxpbWl0V29yZHMiLCJyZXN1bHQiLCJyZWdFeCIsInNlcGFyYXRvcnMiLCJtYXRjaCIsIm5ld1RleHRBcnJheSIsInNwbGljZSIsImkiLCJwYXN0ZVdvcmRzIiwiYXJyRnJvbSIsImVsIiwic2xpY2UiLCJjYWxsIiwicmVtb3ZlRXhpc3RpbmdIaW50IiwiZWxlbWVudCIsImV4aXN0aW5nSGludCIsInBhcmVudE5vZGUiLCJxdWVyeVNlbGVjdG9yIiwicmVtb3ZlIiwiYXBwIiwiaW5pdEhpbnQiLCJjb250ZXh0IiwicXVlcnlTZWxlY3RvckFsbCIsIm1hcCIsInBhcnNlSW50IiwiZGF0YXNldCIsInRleHRMaW1pdCIsImZuIiwiYXBwZW5kQ2hpbGQiLCJhZGRFdmVudExpc3RlbmVyIiwicmVhZHkiLCJXUEZvcm1zVGV4dExpbWl0IiwicmVhZHlTdGF0ZSJdLCJzb3VyY2VzIjpbImZha2VfZmNlYzM4ZDQuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLyogZ2xvYmFsIHdwZm9ybXNfc2V0dGluZ3MgKi9cblxuKCBmdW5jdGlvbigpIHtcblx0LyoqXG5cdCAqIFByZWRlZmluZSBoaW50IHRleHQgdG8gZGlzcGxheS5cblx0ICpcblx0ICogQHNpbmNlIDEuNS42XG5cdCAqIEBzaW5jZSAxLjYuNCBBZGRlZCBhIG5ldyBtYWNyb3MgLSB7cmVtYWluaW5nfS5cblx0ICpcblx0ICogQHBhcmFtIHtzdHJpbmd9IGhpbnRUZXh0IEhpbnQgdGV4dC5cblx0ICogQHBhcmFtIHtudW1iZXJ9IGNvdW50ICAgIEN1cnJlbnQgY291bnQuXG5cdCAqIEBwYXJhbSB7bnVtYmVyfSBsaW1pdCAgICBMaW1pdCB0by5cblx0ICpcblx0ICogQHJldHVybiB7c3RyaW5nfSBQcmVkZWZpbmVkIGhpbnQgdGV4dC5cblx0ICovXG5cdGZ1bmN0aW9uIHJlbmRlckhpbnQoIGhpbnRUZXh0LCBjb3VudCwgbGltaXQgKSB7XG5cdFx0cmV0dXJuIGhpbnRUZXh0LnJlcGxhY2UoICd7Y291bnR9JywgY291bnQgKS5yZXBsYWNlKCAne2xpbWl0fScsIGxpbWl0ICkucmVwbGFjZSggJ3tyZW1haW5pbmd9JywgbGltaXQgLSBjb3VudCApO1xuXHR9XG5cblx0LyoqXG5cdCAqIENyZWF0ZSBIVE1MRWxlbWVudCBoaW50IGVsZW1lbnQgd2l0aCB0ZXh0LlxuXHQgKlxuXHQgKiBAc2luY2UgMS41LjZcblx0ICpcblx0ICogQHBhcmFtIHtudW1iZXJ8c3RyaW5nfSBmb3JtSWQgIEZvcm0gaWQuXG5cdCAqIEBwYXJhbSB7bnVtYmVyfHN0cmluZ30gZmllbGRJZCBGb3JtIGZpZWxkIGlkLlxuXHQgKiBAcGFyYW0ge3N0cmluZ30gICAgICAgIHRleHQgICAgSGludCB0ZXh0LlxuXHQgKlxuXHQgKiBAcmV0dXJuIHtPYmplY3R9IEhUTUxFbGVtZW50IGhpbnQgZWxlbWVudCB3aXRoIHRleHQuXG5cdCAqL1xuXHRmdW5jdGlvbiBjcmVhdGVIaW50KCBmb3JtSWQsIGZpZWxkSWQsIHRleHQgKSB7XG5cdFx0Y29uc3QgaGludCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoICdkaXYnICk7XG5cblx0XHRmb3JtSWQgPSB0eXBlb2YgZm9ybUlkID09PSAnb2JqZWN0JyA/ICcnIDogZm9ybUlkO1xuXHRcdGZpZWxkSWQgPSB0eXBlb2YgZmllbGRJZCA9PT0gJ29iamVjdCcgPyAnJyA6IGZpZWxkSWQ7XG5cblx0XHRoaW50LmNsYXNzTGlzdC5hZGQoICd3cGZvcm1zLWZpZWxkLWxpbWl0LXRleHQnICk7XG5cdFx0aGludC5pZCA9ICd3cGZvcm1zLWZpZWxkLWxpbWl0LXRleHQtJyArIGZvcm1JZCArICctJyArIGZpZWxkSWQ7XG5cdFx0aGludC5zZXRBdHRyaWJ1dGUoICdhcmlhLWxpdmUnLCAncG9saXRlJyApO1xuXHRcdGhpbnQudGV4dENvbnRlbnQgPSB0ZXh0O1xuXG5cdFx0cmV0dXJuIGhpbnQ7XG5cdH1cblxuXHQvKipcblx0ICogS2V5dXAvS2V5ZG93biBldmVudCBoaWdoZXIgb3JkZXIgZnVuY3Rpb24gZm9yIGNoYXJhY3RlcnMgbGltaXQuXG5cdCAqXG5cdCAqIEBzaW5jZSAxLjUuNlxuXHQgKlxuXHQgKiBAcGFyYW0ge09iamVjdH0gaGludCAgSFRNTEVsZW1lbnQgaGludCBlbGVtZW50LlxuXHQgKiBAcGFyYW0ge251bWJlcn0gbGltaXQgTWF4IGFsbG93ZWQgbnVtYmVyIG9mIGNoYXJhY3RlcnMuXG5cdCAqXG5cdCAqIEByZXR1cm4ge0Z1bmN0aW9ufSBIYW5kbGVyIGZ1bmN0aW9uLlxuXHQgKi9cblx0ZnVuY3Rpb24gY2hlY2tDaGFyYWN0ZXJzKCBoaW50LCBsaW1pdCApIHtcblx0XHQvLyBub2luc3BlY3Rpb24gSlNVbnVzZWRMb2NhbFN5bWJvbHNcblx0XHRyZXR1cm4gZnVuY3Rpb24oIGUgKSB7IC8vIGVzbGludC1kaXNhYmxlLWxpbmUgbm8tdW51c2VkLXZhcnNcblx0XHRcdGhpbnQudGV4dENvbnRlbnQgPSByZW5kZXJIaW50KFxuXHRcdFx0XHR3aW5kb3cud3Bmb3Jtc19zZXR0aW5ncy52YWxfbGltaXRfY2hhcmFjdGVycyxcblx0XHRcdFx0dGhpcy52YWx1ZS5sZW5ndGgsXG5cdFx0XHRcdGxpbWl0XG5cdFx0XHQpO1xuXHRcdH07XG5cdH1cblxuXHQvKipcblx0ICogQ291bnQgd29yZHMgaW4gdGhlIHN0cmluZy5cblx0ICpcblx0ICogQHNpbmNlIDEuNi4yXG5cdCAqXG5cdCAqIEBwYXJhbSB7c3RyaW5nfSBzdHJpbmcgU3RyaW5nIHZhbHVlLlxuXHQgKlxuXHQgKiBAcmV0dXJuIHtudW1iZXJ9IFdvcmRzIGNvdW50LlxuXHQgKi9cblx0ZnVuY3Rpb24gY291bnRXb3Jkcyggc3RyaW5nICkge1xuXHRcdGlmICggdHlwZW9mIHN0cmluZyAhPT0gJ3N0cmluZycgKSB7XG5cdFx0XHRyZXR1cm4gMDtcblx0XHR9XG5cblx0XHRpZiAoICEgc3RyaW5nLmxlbmd0aCApIHtcblx0XHRcdHJldHVybiAwO1xuXHRcdH1cblxuXHRcdFtcblx0XHRcdC8oW0EtWl0rKSwoW0EtWl0rKS9naSxcblx0XHRcdC8oWzAtOV0rKSwoW0EtWl0rKS9naSxcblx0XHRcdC8oW0EtWl0rKSwoWzAtOV0rKS9naSxcblx0XHRdLmZvckVhY2goIGZ1bmN0aW9uKCBwYXR0ZXJuICkge1xuXHRcdFx0c3RyaW5nID0gc3RyaW5nLnJlcGxhY2UoIHBhdHRlcm4sICckMSwgJDInICk7XG5cdFx0fSApO1xuXG5cdFx0cmV0dXJuIHN0cmluZy5zcGxpdCggL1xccysvICkubGVuZ3RoO1xuXHR9XG5cblx0LyoqXG5cdCAqIEtleXVwL0tleWRvd24gZXZlbnQgaGlnaGVyIG9yZGVyIGZ1bmN0aW9uIGZvciB3b3JkcyBsaW1pdC5cblx0ICpcblx0ICogQHNpbmNlIDEuNS42XG5cdCAqXG5cdCAqIEBwYXJhbSB7T2JqZWN0fSBoaW50ICBIVE1MRWxlbWVudCBoaW50IGVsZW1lbnQuXG5cdCAqIEBwYXJhbSB7bnVtYmVyfSBsaW1pdCBNYXggYWxsb3dlZCBudW1iZXIgb2YgY2hhcmFjdGVycy5cblx0ICpcblx0ICogQHJldHVybiB7RnVuY3Rpb259IEhhbmRsZXIgZnVuY3Rpb24uXG5cdCAqL1xuXHRmdW5jdGlvbiBjaGVja1dvcmRzKCBoaW50LCBsaW1pdCApIHtcblx0XHRyZXR1cm4gZnVuY3Rpb24oIGUgKSB7XG5cdFx0XHRjb25zdCB2YWx1ZSA9IHRoaXMudmFsdWUudHJpbSgpLFxuXHRcdFx0XHR3b3JkcyA9IGNvdW50V29yZHMoIHZhbHVlICk7XG5cblx0XHRcdGhpbnQudGV4dENvbnRlbnQgPSByZW5kZXJIaW50KFxuXHRcdFx0XHR3aW5kb3cud3Bmb3Jtc19zZXR0aW5ncy52YWxfbGltaXRfd29yZHMsXG5cdFx0XHRcdHdvcmRzLFxuXHRcdFx0XHRsaW1pdFxuXHRcdFx0KTtcblxuXHRcdFx0Ly8gV2Ugc2hvdWxkIHByZXZlbnQgdGhlIGtleXM6IEVudGVyLCBTcGFjZSwgQ29tbWEuXG5cdFx0XHRpZiAoIFsgMTMsIDMyLCAxODggXS5pbmRleE9mKCBlLmtleUNvZGUgKSA+IC0xICYmIHdvcmRzID49IGxpbWl0ICkge1xuXHRcdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7XG5cdFx0XHR9XG5cdFx0fTtcblx0fVxuXG5cdC8qKlxuXHQgKiBHZXQgcGFzc2VkIHRleHQgZnJvbSB0aGUgY2xpcGJvYXJkLlxuXHQgKlxuXHQgKiBAc2luY2UgMS41LjZcblx0ICpcblx0ICogQHBhcmFtIHtDbGlwYm9hcmRFdmVudH0gZSBDbGlwYm9hcmQgZXZlbnQuXG5cdCAqXG5cdCAqIEByZXR1cm4ge3N0cmluZ30gVGV4dCBmcm9tIGNsaXBib2FyZC5cblx0ICovXG5cdGZ1bmN0aW9uIGdldFBhc3RlZFRleHQoIGUgKSB7XG5cdFx0aWYgKCB3aW5kb3cuY2xpcGJvYXJkRGF0YSAmJiB3aW5kb3cuY2xpcGJvYXJkRGF0YS5nZXREYXRhICkgeyAvLyBJRVxuXHRcdFx0cmV0dXJuIHdpbmRvdy5jbGlwYm9hcmREYXRhLmdldERhdGEoICdUZXh0JyApO1xuXHRcdH0gZWxzZSBpZiAoIGUuY2xpcGJvYXJkRGF0YSAmJiBlLmNsaXBib2FyZERhdGEuZ2V0RGF0YSApIHtcblx0XHRcdHJldHVybiBlLmNsaXBib2FyZERhdGEuZ2V0RGF0YSggJ3RleHQvcGxhaW4nICk7XG5cdFx0fVxuXG5cdFx0cmV0dXJuICcnO1xuXHR9XG5cblx0LyoqXG5cdCAqIFBhc3RlIGV2ZW50IGhpZ2hlciBvcmRlciBmdW5jdGlvbiBmb3IgY2hhcmFjdGVyIGxpbWl0LlxuXHQgKlxuXHQgKiBAc2luY2UgMS42LjcuMVxuXHQgKlxuXHQgKiBAcGFyYW0ge251bWJlcn0gbGltaXQgTWF4IGFsbG93ZWQgbnVtYmVyIG9mIGNoYXJhY3RlcnMuXG5cdCAqXG5cdCAqIEByZXR1cm4ge0Z1bmN0aW9ufSBFdmVudCBoYW5kbGVyLlxuXHQgKi9cblx0ZnVuY3Rpb24gcGFzdGVUZXh0KCBsaW1pdCApIHtcblx0XHRyZXR1cm4gZnVuY3Rpb24oIGUgKSB7XG5cdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7XG5cblx0XHRcdGNvbnN0IHBhc3RlZFRleHQgPSBnZXRQYXN0ZWRUZXh0KCBlICksXG5cdFx0XHRcdG5ld1Bvc2l0aW9uID0gdGhpcy5zZWxlY3Rpb25TdGFydCArIHBhc3RlZFRleHQubGVuZ3RoLFxuXHRcdFx0XHRuZXdUZXh0ID0gdGhpcy52YWx1ZS5zdWJzdHJpbmcoIDAsIHRoaXMuc2VsZWN0aW9uU3RhcnQgKSArIHBhc3RlZFRleHQgKyB0aGlzLnZhbHVlLnN1YnN0cmluZyggdGhpcy5zZWxlY3Rpb25TdGFydCApO1xuXG5cdFx0XHR0aGlzLnZhbHVlID0gbmV3VGV4dC5zdWJzdHJpbmcoIDAsIGxpbWl0ICk7XG5cdFx0XHR0aGlzLnNldFNlbGVjdGlvblJhbmdlKCBuZXdQb3NpdGlvbiwgbmV3UG9zaXRpb24gKTtcblx0XHR9O1xuXHR9XG5cblx0LyoqXG5cdCAqIExpbWl0IHN0cmluZyBsZW5ndGggdG8gYSBjZXJ0YWluIG51bWJlciBvZiB3b3JkcywgcHJlc2VydmluZyBsaW5lIGJyZWFrcy5cblx0ICpcblx0ICogQHNpbmNlIDEuNi44XG5cdCAqXG5cdCAqIEBwYXJhbSB7c3RyaW5nfSB0ZXh0ICBUZXh0LlxuXHQgKiBAcGFyYW0ge251bWJlcn0gbGltaXQgTWF4IGFsbG93ZWQgbnVtYmVyIG9mIHdvcmRzLlxuXHQgKlxuXHQgKiBAcmV0dXJuIHtzdHJpbmd9IFRleHQgd2l0aCB0aGUgbGltaXRlZCBudW1iZXIgb2Ygd29yZHMuXG5cdCAqL1xuXHRmdW5jdGlvbiBsaW1pdFdvcmRzKCB0ZXh0LCBsaW1pdCApIHtcblx0XHRsZXQgcmVzdWx0ID0gJyc7XG5cblx0XHQvLyBSZWd1bGFyIGV4cHJlc3Npb24gcGF0dGVybjogbWF0Y2ggYW55IHNwYWNlIGNoYXJhY3Rlci5cblx0XHRjb25zdCByZWdFeCA9IC9cXHMrL2c7XG5cblx0XHQvLyBTdG9yZSBzZXBhcmF0b3JzIGZvciBmdXJ0aGVyIGpvaW4uXG5cdFx0Y29uc3Qgc2VwYXJhdG9ycyA9IHRleHQudHJpbSgpLm1hdGNoKCByZWdFeCApIHx8IFtdO1xuXG5cdFx0Ly8gU3BsaXQgdGhlIG5ldyB0ZXh0IGJ5IHJlZ3VsYXIgZXhwcmVzc2lvbi5cblx0XHRjb25zdCBuZXdUZXh0QXJyYXkgPSB0ZXh0LnNwbGl0KCByZWdFeCApO1xuXG5cdFx0Ly8gTGltaXQgdGhlIG51bWJlciBvZiB3b3Jkcy5cblx0XHRuZXdUZXh0QXJyYXkuc3BsaWNlKCBsaW1pdCwgbmV3VGV4dEFycmF5Lmxlbmd0aCApO1xuXG5cdFx0Ly8gSm9pbiB0aGUgd29yZHMgdG9nZXRoZXIgdXNpbmcgc3RvcmVkIHNlcGFyYXRvcnMuXG5cdFx0Zm9yICggbGV0IGkgPSAwOyBpIDwgbmV3VGV4dEFycmF5Lmxlbmd0aDsgaSsrICkge1xuXHRcdFx0cmVzdWx0ICs9IG5ld1RleHRBcnJheVsgaSBdICsgKCBzZXBhcmF0b3JzWyBpIF0gfHwgJycgKTtcblx0XHR9XG5cblx0XHRyZXR1cm4gcmVzdWx0LnRyaW0oKTtcblx0fVxuXG5cdC8qKlxuXHQgKiBQYXN0ZSBldmVudCBoaWdoZXIgb3JkZXIgZnVuY3Rpb24gZm9yIHdvcmRzIGxpbWl0LlxuXHQgKlxuXHQgKiBAc2luY2UgMS41LjZcblx0ICpcblx0ICogQHBhcmFtIHtudW1iZXJ9IGxpbWl0IE1heCBhbGxvd2VkIG51bWJlciBvZiB3b3Jkcy5cblx0ICpcblx0ICogQHJldHVybiB7RnVuY3Rpb259IEV2ZW50IGhhbmRsZXIuXG5cdCAqL1xuXHRmdW5jdGlvbiBwYXN0ZVdvcmRzKCBsaW1pdCApIHtcblx0XHRyZXR1cm4gZnVuY3Rpb24oIGUgKSB7XG5cdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7XG5cblx0XHRcdGNvbnN0IHBhc3RlZFRleHQgPSBnZXRQYXN0ZWRUZXh0KCBlICksXG5cdFx0XHRcdG5ld1Bvc2l0aW9uID0gdGhpcy5zZWxlY3Rpb25TdGFydCArIHBhc3RlZFRleHQubGVuZ3RoLFxuXHRcdFx0XHRuZXdUZXh0ID0gdGhpcy52YWx1ZS5zdWJzdHJpbmcoIDAsIHRoaXMuc2VsZWN0aW9uU3RhcnQgKSArIHBhc3RlZFRleHQgKyB0aGlzLnZhbHVlLnN1YnN0cmluZyggdGhpcy5zZWxlY3Rpb25TdGFydCApO1xuXG5cdFx0XHR0aGlzLnZhbHVlID0gbGltaXRXb3JkcyggbmV3VGV4dCwgbGltaXQgKTtcblx0XHRcdHRoaXMuc2V0U2VsZWN0aW9uUmFuZ2UoIG5ld1Bvc2l0aW9uLCBuZXdQb3NpdGlvbiApO1xuXHRcdH07XG5cdH1cblxuXHQvKipcblx0ICogQXJyYXkuZnJvbSBwb2x5ZmlsbC5cblx0ICpcblx0ICogQHNpbmNlIDEuNS42XG5cdCAqXG5cdCAqIEBwYXJhbSB7T2JqZWN0fSBlbCBJdGVyYXRvci5cblx0ICpcblx0ICogQHJldHVybiB7T2JqZWN0fSBBcnJheS5cblx0ICovXG5cdGZ1bmN0aW9uIGFyckZyb20oIGVsICkge1xuXHRcdHJldHVybiBbXS5zbGljZS5jYWxsKCBlbCApO1xuXHR9XG5cblx0LyoqXG5cdCAqIFJlbW92ZSBleGlzdGluZyBoaW50LlxuXHQgKlxuXHQgKiBAc2luY2UgMS45LjUuMVxuXHQgKlxuXHQgKiBAcGFyYW0ge09iamVjdH0gZWxlbWVudCBFbGVtZW50LlxuXHQgKi9cblx0Y29uc3QgcmVtb3ZlRXhpc3RpbmdIaW50ID0gKCBlbGVtZW50ICkgPT4ge1xuXHRcdGNvbnN0IGV4aXN0aW5nSGludCA9IGVsZW1lbnQucGFyZW50Tm9kZS5xdWVyeVNlbGVjdG9yKCAnLndwZm9ybXMtZmllbGQtbGltaXQtdGV4dCcgKTtcblx0XHRpZiAoIGV4aXN0aW5nSGludCApIHtcblx0XHRcdGV4aXN0aW5nSGludC5yZW1vdmUoKTtcblx0XHR9XG5cdH07XG5cblx0LyoqXG5cdCAqIFB1YmxpYyBmdW5jdGlvbnMgYW5kIHByb3BlcnRpZXMuXG5cdCAqXG5cdCAqIEBzaW5jZSAxLjguOVxuXHQgKlxuXHQgKiBAdHlwZSB7T2JqZWN0fVxuXHQgKi9cblx0Y29uc3QgYXBwID0ge1xuXHRcdC8qKlxuXHRcdCAqIEluaXQgdGV4dCBsaW1pdCBoaW50LlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC45XG5cdFx0ICpcblx0XHQgKiBAcGFyYW0ge3N0cmluZ30gY29udGV4dCBDb250ZXh0IHNlbGVjdG9yLlxuXHRcdCAqL1xuXHRcdGluaXRIaW50KCBjb250ZXh0ICkge1xuXHRcdFx0YXJyRnJvbSggZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCggY29udGV4dCArICcgLndwZm9ybXMtbGltaXQtY2hhcmFjdGVycy1lbmFibGVkJyApIClcblx0XHRcdFx0Lm1hcChcblx0XHRcdFx0XHRmdW5jdGlvbiggZSApIHsgLy8gZXNsaW50LWRpc2FibGUtbGluZSBhcnJheS1jYWxsYmFjay1yZXR1cm5cblx0XHRcdFx0XHRcdGNvbnN0IGxpbWl0ID0gcGFyc2VJbnQoIGUuZGF0YXNldC50ZXh0TGltaXQsIDEwICkgfHwgMDtcblxuXHRcdFx0XHRcdFx0ZS52YWx1ZSA9IGUudmFsdWUuc2xpY2UoIDAsIGxpbWl0ICk7XG5cblx0XHRcdFx0XHRcdGNvbnN0IGhpbnQgPSBjcmVhdGVIaW50KFxuXHRcdFx0XHRcdFx0XHRlLmRhdGFzZXQuZm9ybUlkLFxuXHRcdFx0XHRcdFx0XHRlLmRhdGFzZXQuZmllbGRJZCxcblx0XHRcdFx0XHRcdFx0cmVuZGVySGludChcblx0XHRcdFx0XHRcdFx0XHR3cGZvcm1zX3NldHRpbmdzLnZhbF9saW1pdF9jaGFyYWN0ZXJzLFxuXHRcdFx0XHRcdFx0XHRcdGUudmFsdWUubGVuZ3RoLFxuXHRcdFx0XHRcdFx0XHRcdGxpbWl0XG5cdFx0XHRcdFx0XHRcdClcblx0XHRcdFx0XHRcdCk7XG5cblx0XHRcdFx0XHRcdGNvbnN0IGZuID0gY2hlY2tDaGFyYWN0ZXJzKCBoaW50LCBsaW1pdCApO1xuXG5cdFx0XHRcdFx0XHRyZW1vdmVFeGlzdGluZ0hpbnQoIGUgKTtcblxuXHRcdFx0XHRcdFx0ZS5wYXJlbnROb2RlLmFwcGVuZENoaWxkKCBoaW50ICk7XG5cdFx0XHRcdFx0XHRlLmFkZEV2ZW50TGlzdGVuZXIoICdrZXlkb3duJywgZm4gKTtcblx0XHRcdFx0XHRcdGUuYWRkRXZlbnRMaXN0ZW5lciggJ2tleXVwJywgZm4gKTtcblx0XHRcdFx0XHRcdGUuYWRkRXZlbnRMaXN0ZW5lciggJ3Bhc3RlJywgcGFzdGVUZXh0KCBsaW1pdCApICk7XG5cdFx0XHRcdFx0fVxuXHRcdFx0XHQpO1xuXG5cdFx0XHRhcnJGcm9tKCBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCBjb250ZXh0ICsgJyAud3Bmb3Jtcy1saW1pdC13b3Jkcy1lbmFibGVkJyApIClcblx0XHRcdFx0Lm1hcChcblx0XHRcdFx0XHRmdW5jdGlvbiggZSApIHsgLy8gZXNsaW50LWRpc2FibGUtbGluZSBhcnJheS1jYWxsYmFjay1yZXR1cm5cblx0XHRcdFx0XHRcdGNvbnN0IGxpbWl0ID0gcGFyc2VJbnQoIGUuZGF0YXNldC50ZXh0TGltaXQsIDEwICkgfHwgMDtcblxuXHRcdFx0XHRcdFx0ZS52YWx1ZSA9IGxpbWl0V29yZHMoIGUudmFsdWUsIGxpbWl0ICk7XG5cblx0XHRcdFx0XHRcdGNvbnN0IGhpbnQgPSBjcmVhdGVIaW50KFxuXHRcdFx0XHRcdFx0XHRlLmRhdGFzZXQuZm9ybUlkLFxuXHRcdFx0XHRcdFx0XHRlLmRhdGFzZXQuZmllbGRJZCxcblx0XHRcdFx0XHRcdFx0cmVuZGVySGludChcblx0XHRcdFx0XHRcdFx0XHR3cGZvcm1zX3NldHRpbmdzLnZhbF9saW1pdF93b3Jkcyxcblx0XHRcdFx0XHRcdFx0XHRjb3VudFdvcmRzKCBlLnZhbHVlLnRyaW0oKSApLFxuXHRcdFx0XHRcdFx0XHRcdGxpbWl0XG5cdFx0XHRcdFx0XHRcdClcblx0XHRcdFx0XHRcdCk7XG5cblx0XHRcdFx0XHRcdGNvbnN0IGZuID0gY2hlY2tXb3JkcyggaGludCwgbGltaXQgKTtcblxuXHRcdFx0XHRcdFx0cmVtb3ZlRXhpc3RpbmdIaW50KCBlICk7XG5cblx0XHRcdFx0XHRcdGUucGFyZW50Tm9kZS5hcHBlbmRDaGlsZCggaGludCApO1xuXG5cdFx0XHRcdFx0XHRlLmFkZEV2ZW50TGlzdGVuZXIoICdrZXlkb3duJywgZm4gKTtcblx0XHRcdFx0XHRcdGUuYWRkRXZlbnRMaXN0ZW5lciggJ2tleXVwJywgZm4gKTtcblx0XHRcdFx0XHRcdGUuYWRkRXZlbnRMaXN0ZW5lciggJ3Bhc3RlJywgcGFzdGVXb3JkcyggbGltaXQgKSApO1xuXHRcdFx0XHRcdH1cblx0XHRcdFx0KTtcblx0XHR9LFxuXHR9O1xuXG5cdC8qKlxuXHQgKiBET01Db250ZW50TG9hZGVkIGhhbmRsZXIuXG5cdCAqXG5cdCAqIEBzaW5jZSAxLjUuNlxuXHQgKi9cblx0ZnVuY3Rpb24gcmVhZHkoKSB7XG5cdFx0Ly8gRXhwb3NlIHRvIHRoZSB3b3JsZC5cblx0XHR3aW5kb3cuV1BGb3Jtc1RleHRMaW1pdCA9IGFwcDtcblxuXHRcdGFwcC5pbml0SGludCggJ2JvZHknICk7XG5cdH1cblxuXHRpZiAoIGRvY3VtZW50LnJlYWR5U3RhdGUgPT09ICdsb2FkaW5nJyApIHtcblx0XHRkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCAnRE9NQ29udGVudExvYWRlZCcsIHJlYWR5ICk7XG5cdH0gZWxzZSB7XG5cdFx0cmVhZHkoKTtcblx0fVxufSgpICk7XG4iXSwibWFwcGluZ3MiOiI7OztBQUFBOztBQUVFLGFBQVc7RUFDWjtBQUNEO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7RUFDQyxTQUFTQSxVQUFVQSxDQUFFQyxRQUFRLEVBQUVDLEtBQUssRUFBRUMsS0FBSyxFQUFHO0lBQzdDLE9BQU9GLFFBQVEsQ0FBQ0csT0FBTyxDQUFFLFNBQVMsRUFBRUYsS0FBTSxDQUFDLENBQUNFLE9BQU8sQ0FBRSxTQUFTLEVBQUVELEtBQU0sQ0FBQyxDQUFDQyxPQUFPLENBQUUsYUFBYSxFQUFFRCxLQUFLLEdBQUdELEtBQU0sQ0FBQztFQUNoSDs7RUFFQTtBQUNEO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0VBQ0MsU0FBU0csVUFBVUEsQ0FBRUMsTUFBTSxFQUFFQyxPQUFPLEVBQUVDLElBQUksRUFBRztJQUM1QyxJQUFNQyxJQUFJLEdBQUdDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFFLEtBQU0sQ0FBQztJQUU1Q0wsTUFBTSxHQUFHTSxPQUFBLENBQU9OLE1BQU0sTUFBSyxRQUFRLEdBQUcsRUFBRSxHQUFHQSxNQUFNO0lBQ2pEQyxPQUFPLEdBQUdLLE9BQUEsQ0FBT0wsT0FBTyxNQUFLLFFBQVEsR0FBRyxFQUFFLEdBQUdBLE9BQU87SUFFcERFLElBQUksQ0FBQ0ksU0FBUyxDQUFDQyxHQUFHLENBQUUsMEJBQTJCLENBQUM7SUFDaERMLElBQUksQ0FBQ00sRUFBRSxHQUFHLDJCQUEyQixHQUFHVCxNQUFNLEdBQUcsR0FBRyxHQUFHQyxPQUFPO0lBQzlERSxJQUFJLENBQUNPLFlBQVksQ0FBRSxXQUFXLEVBQUUsUUFBUyxDQUFDO0lBQzFDUCxJQUFJLENBQUNRLFdBQVcsR0FBR1QsSUFBSTtJQUV2QixPQUFPQyxJQUFJO0VBQ1o7O0VB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
},{}]},{},[1])