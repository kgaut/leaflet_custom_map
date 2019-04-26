(function ($, Drupal, L) {

    jQuery(document).bind('leaflet.map', function(event, map, lMap) {
        if(Drupal.settings.leaflet_custom_maps.length > 0) {
            Drupal.settings.leaflet_custom_maps.forEach(function(element) {
                var imageUrl = element.url;
                var imageBounds = JSON.parse(element.bounds);

                var layer = L.imageOverlay(imageUrl, imageBounds, {'opacity' : element.opacity});
                layer.addTo(lMap);
            });
        }
    });

})(jQuery, Drupal, window.L);

