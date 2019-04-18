(function ($, Drupal, L) {

    jQuery(document).bind('leaflet.map', function(event, map, lMap) {
        if(Drupal.settings.leaflet_custom_map.url !== null) {
            var imageUrl = Drupal.settings.leaflet_custom_map.url;
            var imageBounds = JSON.parse(Drupal.settings.leaflet_custom_map.bounds);

            var layer = L.imageOverlay(imageUrl, imageBounds, {'opacity' : Drupal.settings.leaflet_custom_map.opacity});
            layer.addTo(lMap);
        }
    });

})(jQuery, Drupal, window.L);

