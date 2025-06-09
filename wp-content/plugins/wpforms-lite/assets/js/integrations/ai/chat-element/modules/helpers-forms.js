/* global WPFormsAIChatHTMLElement, WPFormsAIFormGenerator, wpf, wpforms_builder */

/**
 * @param chat.modeStrings.footerFirst
 * @param chat.modeStrings.inactiveAnswerTitle
 * @param chat.preventResizeInput
 * @param response.form_title
 * @param wpforms_builder.allowed_label_html_tags
 */

/**
 * The WPForms AI chat element.
 *
 * Forms mode helpers module.
 *
 * @since 1.9.2
 *
 * @param {WPFormsAIChatHTMLElement} chat The chat element.
 *
 * @return {Object} Forms helpers object.
 */
export default function( chat ) { // eslint-disable-line no-unused-vars, max-lines-per-function
	/**
	 * The default `forms` mode helpers object.
	 *
	 * @since 1.9.2
	 */
	const forms = {
		/**
		 * Init `forms` mode.
		 *
		 * @since 1.9.2
		 */
		init() {
			// Set the initial form generator state.
			if ( chat.sessionId ) {
				WPFormsAIFormGenerator.state.chatStart = true;

				// Remove the selected state from the current template card.
				WPFormsAIFormGenerator.main.el.$templateCard
					.next( '.selected' ).removeClass( 'selected' );
			}
		},

		/**
		 * Reset the message input field.
		 *
		 * @since 1.9.2
		 */
		resetInput() {
			chat.resizeInput();
		},

		/**
		 * Get the answer based on AI response data.
		 *
		 * @since 1.9.2
		 *
		 * @param {Object} response The AI response data.
		 *
		 * @return {string} HTML markup.
		 */
		getAnswer( response ) {
			if ( ! response ) {
				return '';
			}

			const rnd = Math.floor( Math.random() * chat.modeStrings.footer.length );
			const footer = chat.modeStrings.footer[ rnd ];
			const answer = response.explanation || ( response.form_title ?? '' );

			return `
				<h4>${ answer }</h4>
				<span>${ footer }</span>
			`;
		},

		/**
		 * Get the answer pre-buttons HTML markup.
		 *
		 * @since 1.9.2
		 *
		 * @return {string} The answer pre-buttons HTML markup.
		 */
		getAnswerButtonsPre() {
			return `
				<button type="button" class="wpforms-ai-chat-use-form wpforms-ai-chat-answer-action wpforms-btn-sm wpforms-btn-orange" >
					<span>${ chat.modeStrings.useForm }</span>
				</button>
			`;
		},

		/**
		 * The answer was added.
		 *
		 * @since 1.9.2
		 *
		 * @param {HTMLElement} element The answer element.
		 */
		addedAnswer( element ) { // eslint-disable-line no-unused-vars
			forms.updateInactiveAnswers();
		},

		/**
		 * Set active answer.
		 *
		 * @since 1.9.2
		 *
		 * @param {HTMLElement} element The answer element.
		 */
		setActiveAnswer( element ) {
			forms.updateInactiveAnswers();

			element.querySelector( '.wpforms-chat-item-content' ).setAttribute( 'title', '' );
		},

		/**
		 * Update inactive answers.
		 *
		 * @since 1.9.2
		 */
		updateInactiveAnswers() {
			chat.messageList.querySelectorAll( '.wpforms-chat-item-answer:not(.active) .wpforms-chat-item-content' )
				.forEach( ( el ) => {
					// Set title attribute for inactive answers.
					el.setAttribute( 'title', chat.modeStrings.inactiveAnswerTitle );
				} );
		},

		/**
		 * Determine whether the Welcome Screen should be displayed.
		 *
		 * @since 1.9.2
		 *
		 * @return {boolean} Display the Welcome Screen or not.
		 */
		isWelcomeScreen() {
			return true;
		},

		/**
		 * Sanitize response.
		 *
		 * @since 1.9.2
		 *
		 * @param {Object} response The response data to sanitize.
		 *
		 * @return {Object} The sanitized response.
		 */
		sanitizeResponse( response ) {
			if ( ! response.explanation ) {
				return response;
			}

			// Sanitize explanation string.
			response.explanation = wpf.sanitizeHTML( response.explanation, wpforms_builder.allowed_label_html_tags );

			return response;
		},
	};

	return forms;
}
