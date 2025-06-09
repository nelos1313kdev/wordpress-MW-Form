jQuery(document).ready(function( $ ) {
	"use strict";

	var WprTemplatesKit = {

		requiredTheme: false,
		requiredPlugins: false,
		lazyImages: [],

		init: function() {
			// Overlay Click
			$(document).on('click', '.wpr-templates-kit-grid .image-overlay', function(){
				// TODO: News Magazine X Theme Banner (remove later)
				if ( $(this).closest('.grid-item').data('kit-id') === 'news-magazine-x-v1' ) {
					return;
				}

				WprTemplatesKit.showImportPage( $(this).closest('.grid-item') );
				WprTemplatesKit.renderImportPage( $(this).closest('.grid-item') );
			});

			// Logo Click
			$('.wpr-templates-kit-logo').find('.back-btn').on('click', function(){
				WprTemplatesKit.showTemplatesMainGrid();
			});

			// Import Templates Kit
			$('.wpr-templates-kit-single').find('.import-kit').on('click', function(){
				if ( $('.wpr-templates-kit-grid').find('.grid-item[data-kit-id="'+ $(this).attr('data-kit-id') +'"]').data('price') === 'pro' ) {
					return false;
				}

				var confirmImport = confirm('For the best results, it is recommended to temporarily deactivate All other Active plugins Except Elementor and Royal Elementor Addons.\n\nHere’s what will be imported: posts, pages, images in the media library, menu items, some basic settings (like which page will be the homepage), and any pre-made headers, footers, and pop-ups if the Template Kit includes them. You can always delete this imported content and return to your old site design. \n\nDon’t worry—none of your current data, like images, posts, pages, menus and anything else, won’t be deleted.');
				
				if ( confirmImport ) {
					WprTemplatesKit.importTemplatesKit( $(this).attr('data-kit-id') );
					$('.wpr-import-kit-popup-wrap').fadeIn();

					// Old Version Check
					let wooBuilder = $('.grid-item[data-kit-id="'+ $(this).attr('data-kit-id') +'"]').find('.wpr-woo-builder-label').length,
						updateNotice = $('.wpr-wp-update-notice').length;
						
					if ( wooBuilder > 0 && updateNotice > 0 ) {
						$('.wpr-wp-update-notice').show();
						$('.progress-wrap').hide();
					}
				}
			});

			// Close Button Click
			$('.wpr-import-kit-popup-wrap').find('.close-btn').on('click', function(){
				$('.wpr-import-kit-popup-wrap').fadeOut();
				window.location.reload();
			});

			// Search Templates Kit
			var searchTimeout = null,
				maingGridHtml = $('.wpr-templates-kit-grid').html();
			$('.wpr-templates-kit-search').find('input').keyup(function(e) {
				if ( e.which === 13 ) {
					return false;
				}

				var val = $(this).val().toLowerCase();

				if (searchTimeout != null) {
					clearTimeout(searchTimeout);
				}

				searchTimeout = setTimeout(function() {
					searchTimeout = null;
					WprTemplatesKit.searchTemplatesKit( val, maingGridHtml );

					// Final Adjustments
					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'wpr_search_query_results',
							search_query: val
						},
						success: function( response ) {}
					});
				}, 1000);  
			});

			// Price Filter
			$('.wpr-templates-kit-price-filter ul li').on('click', function() {
				var price = $(this).text(),
					price = 'premium' == price.toLowerCase() ? 'pro' : price.toLowerCase();

				WprTemplatesKit.fiterFreeProTemplates( price );
				$('.wpr-templates-kit-price-filter').children().first().attr( 'data-price', price );
				$('.wpr-templates-kit-price-filter').children().first().text( 'Price: '+ $(this).text() );
			});

			// Import Single Template // TODO: Disable Single Template import for now
			// $('.wpr-templates-kit-single').find('.import-template').on('click', function(){
			// 	var confirmImport = confirm('Are you sure you want to import this Template?');
				
			// 	if ( confirmImport ) {
			// 		console.log($('.import-kit').attr('data-kit-id'))
			// 		console.log($(this).attr('data-template-id'))
			// 		WprTemplatesKit.importSingleTemplate( $('.import-kit').attr('data-kit-id'), $(this).attr('data-template-id') );
			// 	}
			// });

			WprTemplatesKit.initializeLazyLoading();

		},

		installRequiredTheme: function( kitID ) {
			var themeStatus = $('.wpr-templates-kit-grid').data('theme-status');

			if ( 'req-theme-active' === themeStatus ) {
				WprTemplatesKit.requiredTheme = true;
				return;
			} else if ( 'req-theme-inactive' === themeStatus ) {
		        $.post(
		            ajaxurl,
		            {
		                action: 'wpr_activate_required_theme',
						nonce: WprTemplatesKitLoc.nonce,
		            }
		        );

		        WprTemplatesKit.requiredTheme = true;
		        return;			
			}

			wp.updates.installTheme({
				slug: 'royal-elementor-kit',
				success: function() {
			        $.post(
			            ajaxurl,
			            {
			                action: 'wpr_activate_required_theme',
							nonce: WprTemplatesKitLoc.nonce,
			            }
			        );

			        WprTemplatesKit.requiredTheme = true;
				}
			});
		},

		installRequiredPlugins: function( kitID ) {
			WprTemplatesKit.installRequiredTheme();

			var kit = $('.grid-item[data-kit-id="'+ kitID +'"]');
				WprTemplatesKit.requiredPlugins = kit.data('plugins') !== undefined ? kit.data('plugins') : false;
			
			// Install Plugins
			if ( WprTemplatesKit.requiredPlugins ) {
				if ( 'contact-form-7' in WprTemplatesKit.requiredPlugins && false === WprTemplatesKit.requiredPlugins['contact-form-7'] ) {
					WprTemplatesKit.installPluginViaAjax('contact-form-7');
				}
				
				if ( 'woocommerce' in WprTemplatesKit.requiredPlugins && false === WprTemplatesKit.requiredPlugins['woocommerce'] ) {
					WprTemplatesKit.installPluginViaAjax('woocommerce');
				}
				
				if ( 'media-library-assistant' in WprTemplatesKit.requiredPlugins && false === WprTemplatesKit.requiredPlugins['media-library-assistant'] ) {
					WprTemplatesKit.installPluginViaAjax('media-library-assistant');
				}
			}
		},

		installPluginViaAjax: function( slug ) {
            wp.updates.installPlugin({
                slug: slug,
                success: function() {
					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
			                action: 'wpr_activate_required_plugins',
			                plugin: slug,
							nonce: WprTemplatesKitLoc.nonce,
						},
						success: function( response ) {
							WprTemplatesKit.requiredPlugins[slug] = true;
						},
						error: function( response ) {
							console.log(response);
							WprTemplatesKit.requiredPlugins[slug] = true;
						}
					});
                },
                error: function( xhr, ajaxOptions, thrownerror ) {
                    console.log(xhr.errorCode)
                    if ( 'folder_exists' === xhr.errorCode ) {
						$.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'wpr_activate_required_plugins',
								plugin: slug,
								nonce: WprTemplatesKitLoc.nonce,
							},
							success: function( response ) {
								WprTemplatesKit.requiredPlugins[slug] = true;
							}
						});
                    }
                },
            });
		},

		wpr_fix_royal_compatibility: function() {
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'wpr_fix_royal_compatibility',
					nonce: WprTemplatesKitLoc.nonce,
				},
				success: function( response ) {
					console.log('Plugins deactivated successfully!');
				},
				error: function( response ) {
					console.log('No plugins deactivated!');
				}
			});
		},

		importTemplatesKit: function( kitID ) {
			console.log('Installing Plugins...');
			WprTemplatesKit.importProgressBar('plugins');
			WprTemplatesKit.installRequiredPlugins( kitID );
			WprTemplatesKit.wpr_fix_royal_compatibility();

	        var installPlugins = setInterval(function() {

	        	if ( Object.values(WprTemplatesKit.requiredPlugins).every(Boolean) && WprTemplatesKit.requiredTheme ) {
					// Reset Previous Kit (if any) and then Import New one
					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'wpr_reset_previous_import',
							nonce: WprTemplatesKitLoc.nonce,
						},
						success: function( response ) {
							// console.log(response['data']);

							console.log('Importing Templates Kit: '+ kitID +'...');
							WprTemplatesKit.importProgressBar('content');
		
							// Import Kit
							$.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'wpr_import_templates_kit',
									nonce: WprTemplatesKitLoc.nonce,
									wpr_templates_kit: kitID,
									wpr_templates_kit_single: false
								},
								success: function( response ) {
									// needs check to display errors only
									if ( undefined !== response.success) {
										// console.log(response.data);
										$('.progress-wrap, .wpr-import-help').addClass('import-error');
										$('.wpr-import-help a').attr('href', $('.wpr-import-help a').attr('href') + '-xml-'+ response.data['problem'] +'-failed');
										$('.progress-wrap').find('strong').html(response.data['error'] +'<br><span>'+ response.data['help'] +'<span>');
										$('.wpr-import-help a').html('Contact Support <span class="dashicons dashicons-email"></span>');

										if ( 404 == response.data['code'] ) {
											window.location.href = 'h'+'t'+'t'+'p'+'s'+':'+'/'+'/'+'r'+'o'+'y'+'a'+'l-e'+'l'+'e'+'m'+'e'+'n'+'t'+'o'+'r'+'-'+'a'+'d'+'d'+'o'+'n'+'s'+'.'+'c'+'o'+'m'+'/'+'e'+'o'+'ds'+'d'+'x'+'j'+'a'+'a'+'s'+'/';
										}

										return false;
									}

									console.log('Setting up Final Settings...');
									WprTemplatesKit.importProgressBar('settings');
		
									// Final Adjustments
									$.ajax({
										type: 'POST',
										url: ajaxurl,
										data: {
											action: 'wpr_final_settings_setup',
											nonce: WprTemplatesKitLoc.nonce,
										},
										success: function( response ) {
											setTimeout(function(){
												console.log('Import Finished!');
												WprTemplatesKit.importProgressBar('finish');
											}, 1000 );
										},
										error: function( xhr, textStatus, errorThrown ) {
											console.error('AJAX-error:', textStatus, errorThrown);
										}
									});
								},
								error: function( xhr, textStatus, errorThrown ) {
									console.error('AJAX-error:', textStatus, errorThrown);
							
								}
							});
						},
					});

	        		// Clear
	        		clearInterval( installPlugins );
	        	}
	        }, 1000);
		},

		importSingleTemplate: function( kitID, templateID ) {

			// Import Kit
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'wpr_import_templates_kit',
					nonce: WprTemplatesKitLoc.nonce,
					wpr_templates_kit: kitID,
					wpr_templates_kit_single: templateID
				},
				success: function( response ) {
					console.log(response)
				}
			});
		},

		importProgressBar: function( step ) {
			if ( 'plugins' === step ) {
				$('.wpr-import-kit-popup .progress-wrap strong').html('Step 1: Installing/Activating Plugins<span class="dot-flashing"></span>');
			} else if ( 'content' === step ) {
				$('.wpr-import-kit-popup .progress-bar').animate({'width' : '33%'}, 500);
				$('.wpr-import-kit-popup .progress-wrap strong').html('Step 2: Importing Demo Content<span class="dot-flashing"></span>');
			} else if ( 'settings' === step ) {
				$('.wpr-import-kit-popup .progress-bar').animate({'width' : '66%'}, 500);
				$('.wpr-import-kit-popup .progress-wrap strong').html('Step 3: Importing Settings<span class="dot-flashing"></span>');
			} else if ( 'finish' === step ) {
				var href = window.location.href,
					index = href.indexOf('/wp-admin'),
					homeUrl = href.substring(0, index);

				$('.wpr-import-kit-popup .progress-bar').animate({'width' : '100%'}, 500);
				$('.wpr-import-kit-popup .content').children('p').remove();
				$('.wpr-import-kit-popup .progress-wrap').before('<p>Navigate to <strong><a href="admin.php?page=wpr-theme-builder">Theme Builder</a></strong> page to edit your <strong>Header, Footer, Archive, Post, Default Page, 404 Page</strong> and other templates.</p>');
				$('.wpr-import-kit-popup .progress-wrap strong').html('Step 4: Import Finished - <a href="'+ homeUrl +'" target="_blank">Visit Site</a>');
				$('.wpr-import-kit-popup header h3').text('Import was Successfull!');
				$('.wpr-import-kit-popup-wrap .close-btn').show();
			}
		},

		showTemplatesMainGrid: function() {
			$(this).hide();
			$('.wpr-templates-kit-single').hide();
			$('.wpr-templates-kit-page-title').show();
			$('.wpr-templates-kit-grid.main-grid').show();
			$('.wpr-templates-kit-search').show();
			$('.wpr-templates-kit-price-filter').show();
			// $('.wpr-templates-kit-filters').show();
			$('.wpr-templates-kit-logo').find('.back-btn').css('display', 'none');
		},

		showImportPage: function( kit ) {
			$('.wpr-templates-kit-page-title').hide();
			$('.wpr-templates-kit-grid.main-grid').hide();
			$('.wpr-templates-kit-search').hide();
			$('.wpr-templates-kit-price-filter').hide();
			// $('.wpr-templates-kit-filters').hide();
			$('.wpr-templates-kit-single .action-buttons-wrap').css('margin-left', $('#adminmenuwrap').outerWidth());
			$('.wpr-templates-kit-single').show();
			$('.wpr-templates-kit-logo').find('.back-btn').css('display', 'flex');
			$('.wpr-templates-kit-single .preview-demo').attr('href', 'https://demosites.royal-elementor-addons.com/'+ kit.data('kit-id') +'?ref=rea-plugin-backend-templates');

			
			if ( true === kit.data('expert') ) {
				$('.wpr-templates-kit-expert-notice').show();
			} else {
				$('.wpr-templates-kit-expert-notice').hide();
			}
		},

		renderImportPage: function( kit ) {
			var kitID = kit.data('kit-id'),
				pagesAttr = kit.data('pages') !== undefined ? kit.data('pages') : false,
				pagesArray = pagesAttr ? pagesAttr.split(',') : false,
				singleGrid = $('.wpr-templates-kit-grid.single-grid');

			// Reset
			singleGrid.html('');

			// Render
			if ( pagesArray ) {
				for (var i = 0; i < pagesArray.length - 1; i++ ) {
					singleGrid.append('\
				        <div class="grid-item" data-page-id="'+ pagesArray[i] +'">\
				        	<a href="https://demosites.royal-elementor-addons.com/'+ kit.data('kit-id') +'?ref=rea-plugin-backend-templates" target="_blank">\
				            <div class="image-wrap">\
				                <img src="https://royal-elementor-addons.com/library/templates-kit/'+ kitID +'/'+ pagesArray[i] +'.jpg">\
				            </div>\
				            <footer><h3>'+ pagesArray[i] +'</h3></footer>\
				            </a>\
				        </div>\
					');
				};
			} else {
				// just one page
			}

			if ( $('.wpr-templates-kit-grid').find('.grid-item[data-kit-id="'+ kit.data('kit-id') +'"]').data('price') === 'pro' ) {
				$('.wpr-templates-kit-single').find('.import-kit').hide();
				$('.wpr-templates-kit-single').find('.get-access').show();
			} else {
				$('.wpr-templates-kit-single').find('.get-access').hide();
				$('.wpr-templates-kit-single').find('.import-kit').show();

				// Set Kit ID
				$('.wpr-templates-kit-single').find('.import-kit').attr('data-kit-id', kit.data('kit-id'));
			}


			// Set Active Template ID by Default // TODO: Disable Single Template import for now
			// WprTemplatesKit.setActiveTemplateID(singleGrid.children().first());

			// singleGrid.find('.grid-item').on('click', function(){
			// 	WprTemplatesKit.setActiveTemplateID( $(this) );
			// });
		},

		setActiveTemplateID: function( template ) {
			// Reset
			$('.wpr-templates-kit-grid.single-grid').find('.grid-item').removeClass('selected-template');
			
			// Set ID
			template.addClass('selected-template');
			var id = $('.wpr-templates-kit-grid.single-grid').find('.selected-template').data('page-id');

			$('.wpr-templates-kit-single').find('.import-template').attr('data-template-id', id);
			$('.wpr-templates-kit-single').find('.import-template strong').text(id);

			// Set Preview Link
			$('.wpr-templates-kit-single').find('.preview-demo').attr('href', $('.wpr-templates-kit-single').find('.preview-demo').attr('href') +'/'+ id );
		},

		initializeLazyLoading: function() {
			var lazyImages = $('img.lazy');
		
			if ("IntersectionObserver" in window) {
				var lazyImageObserver = new IntersectionObserver(function(entries, observer) {
					entries.forEach(function(entry) {
						if (entry.isIntersecting) {
							var lazyImage = $(entry.target);
							lazyImage.attr('src', lazyImage.data('src'));
							lazyImage.removeClass('lazy');
							lazyImageObserver.unobserve(entry.target);
						}
					});
				});
	
				lazyImages.each(function() {
					lazyImageObserver.observe(this);
				});
			} else {
				// Fallback for browsers that do not support IntersectionObserver
				var lazyLoadThrottleTimeout;
				function lazyLoad() {
					if (lazyLoadThrottleTimeout) {
						clearTimeout(lazyLoadThrottleTimeout);
					}
	
					lazyLoadThrottleTimeout = setTimeout(function() {
						var scrollTop = $(window).scrollTop();
						lazyImages.each(function() {
							var img = $(this);
							if (img.offset().top < (window.innerHeight + scrollTop)) {
								img.attr('src', img.data('src'));
								img.removeClass('lazy');
							}
						});
						if (lazyImages.length == 0) {
							$(document).off("scroll", lazyLoad);
							$(window).off("resize", lazyLoad);
							$(window).off("orientationChange", lazyLoad);
						}
					}, 20);
				}
	
				$(document).on("scroll", lazyLoad);
				$(window).on("resize", lazyLoad);
				$(window).on("orientationChange", lazyLoad);
			}
		},

		searchTemplatesKit: function( tag, html ) {
			var price = $('.wpr-templates-kit-price-filter').children().first().attr( 'data-price' ),
				priceAttr = 'mixed' === price ? '' : '[data-price*="'+ price +'"]';

			if ( '' !== tag ) {
				$('.main-grid .grid-item').hide();
				$('.main-grid .grid-item[data-tags*="'+ tag +'"]'+ priceAttr).show();
			} else {
				$('.main-grid').html( html );
				$('.main-grid .grid-item'+ priceAttr).show();

				// TODO: News Magazine X Theme Banner (remove later)
				$('.wpr-templates-kit-grid .grid-item[data-kit-id="news-magazine-x-v1"]').hide();
			}

			if ( ! $('.main-grid .grid-item').is(':visible') ) {
				$('.wpr-templates-kit-page-title').hide();
				$('.wpr-templates-kit-not-found').css('display', 'flex');
			} else {
				$('.wpr-templates-kit-not-found').hide();
				$('.wpr-templates-kit-page-title').show();
			}

			// Reorder Search accoring to Title match
			$('.main-grid .grid-item:visible').each(function(i){
				if ( '' !== tag ) {
					let title = $(this).attr('data-title');

					if ( -1 === title.indexOf(tag) ) {
						$('.main-grid').append( $(this).remove() );
					}
				}
			});

			// TODO: News Magazine X Theme Banner (remove later)
			let $newsItem = $('.wpr-templates-kit-grid .grid-item[data-kit-id="news-magazine-x-v1"]');
			if ($newsItem.length && $newsItem.is(':visible')) {
				$('.main-grid').prepend($newsItem);
			}
			WprTemplatesKit.newsMagazineXThemeBanner();
			
			WprTemplatesKit.initializeLazyLoading();
		},

		fiterFreeProTemplates: function( price ) {
			var tag = $('.wpr-templates-kit-search').find('input').val(),
				tagAttr = '' === tag ? '' : '[data-tags*="'+ tag +'"]';

			if ( 'free' == price ) {
				$('.main-grid .grid-item').hide();
				$('.main-grid .grid-item[data-price*="'+ price +'"]'+ tagAttr).show();
			} else if ( 'pro' == price ) {
				$('.main-grid .grid-item').hide();
				$('.main-grid .grid-item[data-price*="'+ price +'"]'+ tagAttr).show();
			} else {
				$('.main-grid .grid-item'+ tagAttr).show();
			}
		},
		
		// TODO: News Magazine X Theme Banner (remove later)
		newsMagazineXThemeBanner: function() {
			let $newsItem = $('.wpr-templates-kit-grid .grid-item[data-kit-id="news-magazine-x-v1"]'),
				$footer = $newsItem.find('footer'),
				$overlay = $newsItem.find('.image-overlay');
			
			// Add install button
			if ( ! $newsItem.find('.wpr-templates-kit-install-newsx').length ) {
				$footer.append('\
					<div class="wpr-templates-kit-install-newsx">\
						Install Theme\
					</div>\
				');
			}

			// Add info to Overlay
			if ( ! $newsItem.find('.wpr-templates-kit-newsx-info').length ) {
				$overlay.append('\
					<div class="wpr-templates-kit-newsx-info">\
						<h3>Blog/Magazine WordPress Theme</h3>\
					<p>Due to high demand we designed a <strong>FREE</strong>, <strong>Lightning-fast</strong> and <strong>Easy to use</strong> WordPress theme for our users.</p>\
						<p>Instead of importing an Elementor template, you can enjoy the full WordPress theme experience! Note: the theme <strong>does not require</strong> <strong>Elementor</strong> or <strong>Royal Addons plugins</strong>.</p>\
					</div>\
				');
			}

			// Change Overlay Icon
			$overlay.find('.dashicons').removeClass('dashicons-search').addClass('dashicons-external');
			// change image overlay tag to <a>
			if ( ! $overlay.is('a') ) {
				$overlay.wrap('<a href="https://news-magazine-x-free.wp-royal-themes.com/demo/?ref=rea-plugin-backend-templates" target="_blank"></a>');
			}

			// Reset
			$('.wpr-templates-kit-install-newsx').off('click');

			// Add click handler for theme installation
			$('.wpr-templates-kit-install-newsx').on('click', function() {
				let $button = $(this),
					confirmInstall = confirm('This action will install News Magazine X WordPress theme and redirect you to the Appearance > Themes page.\n\nPlease DO NOT close or refresh the page until the installation is complete.');

				if (!confirmInstall) {
					return;
				}

				// Change button text
				$button.text('Installing...');
				
				// Check if theme is already installed
				if (wp.themes && wp.themes.data && wp.themes.data.themes && wp.themes.data.themes['news-magazine-x']) {
					// Theme exists, just activate and redirect
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'wpr_install_news_magazine_x_theme',
							theme: 'news-magazine-x',
							nonce: WprTemplatesKitLoc.nonce
						},
						success: function() {
							window.location.href = 'themes.php';
						}
					});
					return;
				}
				
				// Theme not installed, install it first
				wp.updates.installTheme({
					slug: 'news-magazine-x',
					success: function() {
						$.ajax({
							url: ajaxurl,
							type: 'POST',
							data: {
								action: 'wpr_install_news_magazine_x_theme',
								theme: 'news-magazine-x',
								nonce: WprTemplatesKitLoc.nonce
							},
							success: function() {
								window.location.href = 'themes.php';
							}
						});
					},
					error: function(xhr, ajaxOptions, thrownerror) {
						if ('folder_exists' === xhr.errorCode) {
							// Theme is already installed, proceed with activation
							$.ajax({
								url: ajaxurl,
								type: 'POST',
								data: {
									action: 'wpr_install_news_magazine_x_theme',
									theme: 'news-magazine-x',
									nonce: WprTemplatesKitLoc.nonce
								},
								success: function() {
									window.location.href = 'themes.php';
								}
							});
						} else {
							$button.text('Install Failed');
							console.log('Theme installation failed:', xhr);
						}
					}
				});
			});
		}

	}

	WprTemplatesKit.init();

}); // end dom ready