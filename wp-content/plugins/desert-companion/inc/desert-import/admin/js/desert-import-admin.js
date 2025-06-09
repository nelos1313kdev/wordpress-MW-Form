(function ($) {
    'use strict';
	
    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
	
    // console.log(desert_theme_object[0]);

	// Product Show Method
	$(document).on('click','#product_filter a',function(e){
        e.preventDefault();
        $(this).tab('show');
    });
	
	$(document).on('click','.btn-preview',function(){
        $(".preview-live-btn").addClass('uk-hidden');
        $(".import-priview").removeClass('uk-hidden');
        for (var i = 0; i < desert_theme_object.length; i++) {
            if (desert_theme_object[i].id === $(this).data('id')) {
                //console.log(desert_theme_object[i]);
                $("#theme_preview").attr('src', desert_theme_object[i].meta.preview_link);
                $(".theme-screenshot").attr('src', desert_theme_object[i].meta.preview_url);
                //alert(my_ajax_object.theme_name +'->'+ desert_theme_object[i].meta.theme_name);
                if (my_ajax_object.theme_name === desert_theme_object[i].meta.theme_name) {
                    $(".import-priview").attr('data-id', $(this).data('id'));
                    $(".import-priview").removeClass('uk-hidden');
                    $(".preview-buy").addClass('uk-hidden');
                } else {
                    $(".import-priview").addClass('uk-hidden');
                    $(".preview-buy").removeClass('uk-hidden');
                    $(".preview-buy").attr('src', desert_theme_object[i].meta.pro_link);
                }

            }

        }
        if ($(this).data('live') === 1) {
            $(".import-priview").addClass('uk-hidden');
            $(".preview-live-btn").removeClass('uk-hidden');
        }


        UIkit.modal('#DesertdemoPreview').show();

    });

	$(document).on('click','.preview-desktop',function(){
        $(".wp-full-overlay-main").removeClass('p-mobile');
        $(".wp-full-overlay-main").removeClass('p-tablet');
    });
	$(document).on('click','.preview-tablet',function(){
        $(".wp-full-overlay-main").addClass('p-tablet');
        $(".wp-full-overlay-main").removeClass('p-mobile');
    });
	$(document).on('click','.preview-mobile',function(){
        $(".wp-full-overlay-main").addClass('p-mobile');
        $(".wp-full-overlay-main").removeClass('p-tablet');
    });
	
	$(document).on('click','.collapse-sidebar',function(){

        var x = $(this).attr("aria-expanded");
        if (x === "true")
        {
            $(this).attr("aria-expanded", "false");
            $(".theme-install-overlay").addClass('expanded').removeClass('collapsed');
        } else {
            $(this).attr("aria-expanded", "true");
            $(".theme-install-overlay").addClass('collapsed').removeClass('expanded');
        }

        // $(this).attr("aria-expanded","false");
        //  $(".theme-install-overlay").addClass('collapsed').removeClass('expanded');

    });

	$(document).on('click','.close-full-overlay',function(){

        UIkit.modal('#DesertdemoPreview').hide();

    });

	$(document).on('click','.btn-import',function(){
        $("#theme_id").val($(this).data('id'));
        UIkit.modal('#DesertdemoPreview').hide();
        UIkit.modal('#Confirm').show();
    });

	$(document).on('click','#import_data',function(){
        var theme_id = $("#theme_id").val();
        UIkit.modal('#Confirm').hide();
        $(".theme").addClass("focus");
        $('.btn-import-' + theme_id).addClass('updating-message');
        $('.btn-import-' + theme_id).html("Importing...");

        var data = {
            'action': 'import_action',
            'theme_id': theme_id,
            'desert_import_nonce': my_ajax_object.nonce
        };
        $.ajax({
            type: "POST",
            url: my_ajax_object.ajax_url,
            data: data,
            success: function (data) {
                // $(".demo-desert-container").hide();
                $('.btn-import-' + theme_id).addClass("uk-hidden");
                $('.live-btn-' + theme_id).removeClass("uk-hidden");


                console.log(data);
            },
            error: function (data) {
                alert(data);
            }

        });
        return false;

    });

})(jQuery);