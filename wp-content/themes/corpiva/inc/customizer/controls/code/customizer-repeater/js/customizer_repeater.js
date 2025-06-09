/* global jQuery */
/* global wp */
function corpiva_media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function () {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function (props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function (html) {

        };
        return false;
    });
}

/********************************************
 *** Generate unique id ***
 *********************************************/
function corpiva_customizer_repeater_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
        .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}


/********************************************
 *** General Repeater ***
 *********************************************/
function corpiva_customizer_repeater_refresh_social_icons(th) {
    'use strict';
    var icons_repeater_values = [];
    th.find('.customizer-repeater-social-repeater-container').each(function () {
        var icon = jQuery(this).find('.icp').val();
        var link = jQuery(this).find('.customizer-repeater-social-repeater-link').val();
        var id = jQuery(this).find('.customizer-repeater-social-repeater-id').val();

        if (!id) {
            id = 'customizer-repeater-social-repeater-' + corpiva_customizer_repeater_uniqid();
            jQuery(this).find('.customizer-repeater-social-repeater-id').val(id);
        }

        if (icon !== '' && link !== '') {
            icons_repeater_values.push({
                'icon': icon,
                'link': link,
                'id': id
            });
        }
    });

    th.find('.social-repeater-socials-repeater-colector').val(JSON.stringify(icons_repeater_values));
    corpiva_customizer_repeater_refresh_general_control_values();
}


function corpiva_customizer_repeater_refresh_general_control_values() {
    'use strict';
    jQuery('.customizer-repeater-general-control-repeater').each(function () {
        var values = [];
        var th = jQuery(this);
        th.find('.customizer-repeater-general-control-repeater-container').each(function () {

            var icon_value = jQuery(this).find('.icp').val();
            var text = jQuery(this).find('.customizer-repeater-text-control').val();
            var link = jQuery(this).find('.customizer-repeater-link-control').val();
            var text2 = jQuery(this).find('.customizer-repeater-text2-control').val();
            var link2 = jQuery(this).find('.customizer-repeater-link2-control').val();
			 var link3 = jQuery(this).find('.customizer-repeater-link3-control').val();
            var color = jQuery(this).find('input.customizer-repeater-color-control').val();
            var color2 = jQuery(this).find('input.customizer-repeater-color2-control').val();
            var image_url = jQuery(this).find('.custom-media-url').val();
            var image_url2 = jQuery(this).find('.custom-media-url2').val();
            var choice = jQuery(this).find('.customizer-repeater-image-choice').val();
            var title = jQuery(this).find('.customizer-repeater-title-control').val();
            var subtitle = jQuery(this).find('.customizer-repeater-subtitle-control').val();
			var subtitle2 = jQuery(this).find('.customizer-repeater-subtitle2-control').val();
			var subtitle3 = jQuery(this).find('.customizer-repeater-subtitle3-control').val();
			var subtitle4 = jQuery(this).find('.customizer-repeater-subtitle4-control').val();
			var subtitle5 = jQuery(this).find('.customizer-repeater-subtitle5-control').val();
			var video_url = jQuery(this).find('.customizer-repeater-video-url-control').val();
			var button_second = jQuery(this).find('.customizer-repeater-button2-control').val();
			var slide_align = jQuery(this).find('.customizer-repeater-slide-align').val();
			var bg_type = jQuery(this).find('.customizer-repeater-bg-type').val();
			var open_new_tab = jQuery(this).find('.customizer-repeater-checkbox').attr("checked") ? 'yes' : 'no';
            var id = jQuery(this).find('.social-repeater-box-id').val();
            if (!id) {
                id = 'social-repeater-' + corpiva_customizer_repeater_uniqid();
                jQuery(this).find('.social-repeater-box-id').val(id);
            }
            var social_repeater = jQuery(this).find('.social-repeater-socials-repeater-colector').val();
            var shortcode = jQuery(this).find('.customizer-repeater-shortcode-control').val();

            if (text !== '' || image_url !== '' || image_url2 !== '' || title !== '' || subtitle !== '' || icon_value !== '' || link !== '' || choice !== '' || social_repeater !== '' || shortcode !== '' || slide_align !== ''  || bg_type !== '' || color !== '') {
                values.push({
                    'icon_value': (choice === 'customizer_repeater_none' ? '' : icon_value),
                    'color': color,
                    'color2': color2,
                    'text': corpivaescapeHtml(text),
                    'link': link,
                    'text2': corpivaescapeHtml(text2),
					'button_second': corpivaescapeHtml(button_second),
                    'link2': link2,
					'link3': link3,
                    'image_url': (choice === 'customizer_repeater_none' ? '' : image_url),
                    'choice': choice,
                    'image_url2': image_url2,
                    'title': corpivaescapeHtml(title),
                    'subtitle': corpivaescapeHtml(subtitle),
					'subtitle2': corpivaescapeHtml(subtitle2),
					'subtitle3': corpivaescapeHtml(subtitle3),
					'subtitle4': corpivaescapeHtml(subtitle4),
					'subtitle5': corpivaescapeHtml(subtitle5),
					'video_url': corpivaescapeHtml(video_url),
					'slide_align': corpivaescapeHtml(slide_align),
					'bg_type': corpivaescapeHtml(bg_type),
					'open_new_tab' : open_new_tab,
                    'social_repeater': corpivaescapeHtml(social_repeater),
                    'id': id,
                    'shortcode': corpivaescapeHtml(shortcode)
                });
            }

        });
        th.find('.customizer-repeater-colector').val(JSON.stringify(values));
        th.find('.customizer-repeater-colector').trigger('change');
    });
}


jQuery(document).ready(function () {
    'use strict';
    var corpiva_theme_controls = jQuery('#customize-theme-controls');
    corpiva_theme_controls.on('click', '.customizer-repeater-customize-control-title', function () {
        jQuery(this).next().slideToggle('medium', function () {
            if (jQuery(this).is(':visible')){
                jQuery(this).prev().addClass('repeater-expanded');
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).prev().removeClass('repeater-expanded');
            }
        });
    });

    corpiva_theme_controls.on('change', '.icp',function(){
        corpiva_customizer_repeater_refresh_general_control_values();
        return false;
    });
	
	corpiva_theme_controls.on('change','.customizer-repeater-slide-align', function(){
		corpiva_customizer_repeater_refresh_general_control_values();
        return false;
		
	});
	
	corpiva_theme_controls.on('change','.customizer-repeater-bg-type', function(){
		corpiva_customizer_repeater_refresh_general_control_values();
        return false;
		
	});

    corpiva_theme_controls.on('change','.customizer-repeater-image2-control', function(){
        corpiva_customizer_repeater_refresh_general_control_values();
        return false;
        
    });
	
    corpiva_theme_controls.on('change', '.customizer-repeater-image-choice', function () {
        if (jQuery(this).val() === 'customizer_repeater_image') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').show();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').hide();

        }
        if (jQuery(this).val() === 'customizer_repeater_icon') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').show();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().show();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').show();
        }
        if (jQuery(this).val() === 'customizer_repeater_none') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').hide();
        }

        corpiva_customizer_repeater_refresh_general_control_values();
        return false;
    });
    corpiva_media_upload('.customizer-repeater-custom-media-button');
    jQuery('.custom-media-url').on('change', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            corpiva_customizer_repeater_refresh_general_control_values();
        }
    };

    /**
     * This adds a new box to repeater
     *
     */
    corpiva_theme_controls.on('click', '.customizer-repeater-new-field', function () {
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-' + corpiva_customizer_repeater_uniqid();
		var parentid = jQuery(this).parent().attr("id");
		
		if(parentid == 'customize-control-corpiva_hdr_social')
		{	
			var totalItems = jQuery("#customize-control-corpiva_hdr_social .customizer-repeater-general-control-repeater-container").length 
			if(totalItems >= 4){
			  jQuery( "#customize-control-corpiva_social_option_upsale .desert-companion-upgrade-message" ).show();
			  return false;   
			}
		}
		
		if(parentid == 'customize-control-corpiva_slider_option')
		{	
			var totalItems = jQuery("#customize-control-corpiva_slider_option .customizer-repeater-general-control-repeater-container").length 
			if(totalItems >= 3){
			  jQuery( "#customize-control-corpiva_slider_option_upsale .desert-companion-upgrade-message" ).show();
			  return false;   
			}
		}
		
		if(parentid == 'customize-control-corpiva_information_option')
		{	
			var totalItems = jQuery("#customize-control-corpiva_information_option .customizer-repeater-general-control-repeater-container").length 
			if(totalItems >= 4){
			  jQuery( "#customize-control-corpiva_information_option_upsale .desert-companion-upgrade-message" ).show();
			  return false;   
			}
		}
		
		if(parentid == 'customize-control-corpiva_service_option')
		{	
			var totalItems = jQuery("#customize-control-corpiva_service_option .customizer-repeater-general-control-repeater-container").length 
			if(totalItems >= 4){
			  jQuery( "#customize-control-corpiva_service_option_upsale .desert-companion-upgrade-message" ).show();
			  return false;   
			}
		}
		
		if(parentid == 'customize-control-corpiva_features_option')
		{	
			var totalItems = jQuery("#customize-control-corpiva_features_option .customizer-repeater-general-control-repeater-container").length 
			if(totalItems >= 6){
			  jQuery( "#customize-control-corpiva_features_option_upsale .desert-companion-upgrade-message" ).show();
			  return false;   
			}
		}
		
		if(parentid == 'customize-control-corpiva_ov_counter_option')
		{	
			var totalItems = jQuery("#customize-control-corpiva_ov_counter_option .customizer-repeater-general-control-repeater-container").length 
			if(totalItems >= 2){
			  jQuery( "#customize-control-corpiva_ov_counter_option_upsale .desert-companion-upgrade-message" ).show();
			  return false;   
			}
		}
		
        if (typeof th !== 'undefined') {
            /* Clone the first box*/
            var field = th.find('.customizer-repeater-general-control-repeater-container:first').clone( true, true );

            if (typeof field !== 'undefined') {
                /*Set the default value for choice between image and icon to icon*/
                field.find('.customizer-repeater-image-choice').val('customizer_repeater_icon');

                /*Show icon selector*/
                field.find('.social-repeater-general-control-icon').show();

                /*Hide image selector*/
                if (field.find('.social-repeater-general-control-icon').length > 0) {
                    field.find('.customizer-repeater-image-control').hide();
                }

                /*Show delete box button because it's not the first box*/
                field.find('.social-repeater-general-control-remove-field').show();

                /* Empty control for icon */
                field.find('.input-group-addon').find('.fa').attr('class', 'fa');


                /*Remove all repeater fields except first one*/

                field.find('.customizer-repeater-social-repeater').find('.customizer-repeater-social-repeater-container').not(':first').remove();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.social-repeater-socials-repeater-colector').val('');

                /*Remove value from icon field*/
                field.find('.icp').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text-control').val('');

                /*Remove value from link field*/
                field.find('.customizer-repeater-link-control').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text2-control').val('');
				
				/*Remove value from button field*/
                field.find('.customizer-repeater-button2-control').val('');
				
                /*Remove value from link field*/
                field.find('.customizer-repeater-link2-control').val('');
				
				 /*Remove value from link field*/
                field.find('.customizer-repeater-link3-control').val('');
				
				/*Set the default value in slide align*/
                field.find('.customizer-repeater-slide-align').val('left');
				
				/*Set the default value in slide align*/
                field.find('.customizer-repeater-bg-type').val('left');
				
				/*Set the default value in checkbox*/
                field.find('.customizer-repeater-checkbox').val('');
				
                /*Set box id*/
                field.find('.social-repeater-box-id').val(id);

                /*Remove value from media field*/
                field.find('.custom-media-url').val('');

                /*Remove value from title field*/
                field.find('.customizer-repeater-title-control').val('');


                /*Remove value from color field*/
                field.find('div.customizer-repeater-color-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color-control ' + id + '">');
                field.find('input.customizer-repeater-color-control').wpColorPicker(color_options);


                field.find('div.customizer-repeater-color2-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color2-control ' + id + '">');
                field.find('input.customizer-repeater-color2-control').wpColorPicker(color_options);

                // field.find('.customize-control-notifications-container').remove();


                /*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle-control').val('');
				
				 /*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle2-control').val('');
				
				 /*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle3-control').val('');
				
				/*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle4-control').val('');
				
				/*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle5-control').val('');
				
				/*Remove value from subtitle field*/
                field.find('.customizer-repeater-video-url-control').val('');
				
                /*Remove value from shortcode field*/
                field.find('.customizer-repeater-shortcode-control').val('');

                /*Append new box*/
                th.find('.customizer-repeater-general-control-repeater-container:first').parent().append(field);

                /*Refresh values*/
                corpiva_customizer_repeater_refresh_general_control_values();
            }

        }
        return false;
    });


    corpiva_theme_controls.on('click', '.social-repeater-general-control-remove-field', function () {
		var split_delete_button=jQuery(this).text();
        var split_delete_button_split=split_delete_button.substr(8, 12);
        if (typeof    jQuery(this).parent() !== 'undefined') {
            jQuery(this).parent().hide(500, function(){
                jQuery(this).parent().remove();
                corpiva_customizer_repeater_refresh_general_control_values();
				
				var corpiva_hdr_social = jQuery("#customize-control-corpiva_hdr_social .customizer-repeater-general-control-repeater-container").length 
				if(corpiva_hdr_social < 4){ 
				  jQuery( "#customize-control-corpiva_social_option_upsale .desert-companion-upgrade-message" ).hide();
				}
				
				var corpiva_slider_option = jQuery("#customize-control-corpiva_slider_option .customizer-repeater-general-control-repeater-container").length 
				if(corpiva_slider_option < 3){ 
				  jQuery( "#customize-control-corpiva_slider_option_upsale .desert-companion-upgrade-message" ).hide();
				}

				var corpiva_information_option = jQuery("#customize-control-corpiva_information_option .customizer-repeater-general-control-repeater-container").length 
				if(corpiva_information_option < 4){ 
				  jQuery( "#customize-control-corpiva_information_option_upsale .desert-companion-upgrade-message" ).hide();
				}
				
				var corpiva_service_option = jQuery("#customize-control-corpiva_service_option .customizer-repeater-general-control-repeater-container").length 
				if(corpiva_service_option < 4){ 
				  jQuery( "#customize-control-corpiva_service_option_upsale .desert-companion-upgrade-message" ).hide();
				}
				
				var corpiva_features_option = jQuery("#customize-control-corpiva_features_option .customizer-repeater-general-control-repeater-container").length 
				if(corpiva_features_option < 6){ 
				  jQuery( "#customize-control-corpiva_features_option_upsale .desert-companion-upgrade-message" ).hide();
				}
				
				var corpiva_ov_counter_option = jQuery("#customize-control-corpiva_ov_counter_option .customizer-repeater-general-control-repeater-container").length 
				if(corpiva_ov_counter_option < 2){ 
				  jQuery( "#customize-control-corpiva_ov_counter_option_upsale .desert-companion-upgrade-message" ).hide();
				}
            });
        }
        return false;
    });


    corpiva_theme_controls.on('keyup', '.customizer-repeater-title-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });

    jQuery('input.customizer-repeater-color-control').wpColorPicker(color_options);
    jQuery('input.customizer-repeater-color2-control').wpColorPicker(color_options);

    corpiva_theme_controls.on('keyup', '.customizer-repeater-subtitle-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	 corpiva_theme_controls.on('keyup', '.customizer-repeater-subtitle2-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('keyup', '.customizer-repeater-subtitle3-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('keyup', '.customizer-repeater-subtitle4-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('keyup', '.customizer-repeater-subtitle5-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('keyup', '.customizer-repeater-video-url-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });

    corpiva_theme_controls.on('keyup', '.customizer-repeater-shortcode-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });

    corpiva_theme_controls.on('keyup', '.customizer-repeater-text-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });

    corpiva_theme_controls.on('keyup', '.customizer-repeater-link-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });

    corpiva_theme_controls.on('keyup', '.customizer-repeater-text2-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('keyup', '.customizer-repeater-button2-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });

    corpiva_theme_controls.on('keyup', '.customizer-repeater-link2-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('keyup', '.customizer-repeater-link3-control', function () {
        corpiva_customizer_repeater_refresh_general_control_values();
    });
	
	corpiva_theme_controls.on('change','.customizer-repeater-checkbox', function(){
		
		corpiva_customizer_repeater_refresh_general_control_values();
	});
	
    /*Drag and drop to change icons order*/

    jQuery('.customizer-repeater-general-control-droppable').sortable({
        axis: 'y',
        update: function () {
            corpiva_customizer_repeater_refresh_general_control_values();
        }
    });


    /*----------------- Socials Repeater ---------------------*/
    corpiva_theme_controls.on('click', '.social-repeater-add-social-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-social-repeater-' + corpiva_customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            var field = th.find('.customizer-repeater-social-repeater-container:first').clone( true, true );
            if (typeof field !== 'undefined') {
                field.find( '.icp' ).val('');
                field.find( '.input-group-addon' ).find('.fa').attr('class','fa');
                field.find('.social-repeater-remove-social-item').show();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.customizer-repeater-social-repeater-id').val(id);
                th.find('.customizer-repeater-social-repeater-container:first').parent().append(field);
            }
        }
        return false;
    });

    corpiva_theme_controls.on('click', '.social-repeater-remove-social-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var repeater = jQuery(this).parent().parent();
        th.remove();
        corpiva_customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    corpiva_theme_controls.on('keyup', '.customizer-repeater-social-repeater-link', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent();
        corpiva_customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    corpiva_theme_controls.on('change', '.customizer-repeater-social-repeater-container .icp', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent().parent();
        corpiva_customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

});

var corpivaentityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;'
};

function corpivaescapeHtml(string) {
    'use strict';
    //noinspection JSUnresolvedFunction
    string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
    string = String(string).replace(/\\/g, '&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return corpivaentityMap[s];
    });

}