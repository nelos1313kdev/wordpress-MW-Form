(function(api) {

    api.sectionConstructor['mechanic-car-repair-upsell'] = api.Section.extend({
        attachEvents: function() {},
        isContextuallyActive: function() {
            return true;
        }
    });

})(wp.customize);