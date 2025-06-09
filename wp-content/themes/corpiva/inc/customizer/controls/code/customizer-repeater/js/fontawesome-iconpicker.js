(function ($) {
    'use strict';
    wp.corpivacustomizerRepeater = {

        init: function () {
            $('.iconpicker-items>i').on('click', function () {
                var iconClass = $(this).attr('class');
                var classInput = $(this).parents('.iconpicker-popover').prev().find('.icp');
                classInput.val(iconClass);
                classInput.attr('value', iconClass);

                var iconPreview = classInput.next('.input-group-addon');
                var iconElement = '<i class="'.concat(iconClass, '"><\/i>');
                iconPreview.empty();
                iconPreview.append(iconElement);

                var th = $(this).parent().parent().parent();
                classInput.trigger('change');
                corpiva_customizer_repeater_refresh_social_icons(th);
                return false;
            });
        },
        search: function ($searchField) {
            var itemsList = $searchField.parent().next().find('.iconpicker-items');
            var searchTerm = $searchField.val().toLowerCase();
            if (searchTerm.length > 0) {
                itemsList.children().each(function () {
                    if ($(this).filter('[title*='.concat(searchTerm)).length > 0 || searchTerm.length < 1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else {
                itemsList.children().show();
            }
        },
        iconPickerToggle: function ($input) {
            var iconPicker = $input.parent().next();
            iconPicker.addClass('iconpicker-visible');
        }
    };

    $(document).ready(function () {
        wp.corpivacustomizerRepeater.init();

        $('.iconpicker-search').on('keyup', function () {
            wp.corpivacustomizerRepeater.search($(this));
        });

        $('.icp-auto').on('click', function () {
            wp.corpivacustomizerRepeater.iconPickerToggle($(this));
        });

        $(document).mouseup( function (e) {
            var container = $('.iconpicker-popover');

            if (!container.is(e.target)
                && container.has(e.target).length === 0)
            {
                container.removeClass('iconpicker-visible');
            }
        });

    });

})(jQuery);
