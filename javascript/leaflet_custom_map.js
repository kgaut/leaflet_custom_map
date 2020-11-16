(function($, Drupal, drupalSettings, L) {
  jQuery(document).bind('leaflet.map', function(event, map, lMap) {
      if(drupalSettings.leaflet_custom_map.maps !== undefined && drupalSettings.leaflet_custom_map.maps.length > 0) {
        drupalSettings.leaflet_custom_map.maps.forEach(function(element) {
          let imageUrl = element.url;
          let imageBounds = JSON.parse(element.bounds);
          let layer = L.imageOverlay(imageUrl, imageBounds, {'opacity' : element.opacity});
          layer.addTo(lMap);
        });
      }
  });
})(jQuery, Drupal, drupalSettings, window.L);

