jQuery(document).ready(function($) {

  const fixedOptions = {
    appId: 'plTMQFX51F13',
    apiKey: '3c4df5ca3fb2e2e07d495ad55ccec79b',
    container: document.querySelector('#destination')
  };

  const reconfigurableOptions = {
    language: 'fr',           // Receives results in french
    countries: ['fr'],        // Search in the United States of America and in the Russian Federation
    type: 'city',             // Search only for cities names
    gestureHandling: true,
    aroundLatLngViaIP: false  // disable the extra search/boost around the source IP
  };
  const placesAutocomplete = places(fixedOptions).configure(reconfigurableOptions);

  placesAutocomplete.on('change', function(e) {
    var latlng = e.suggestion.latlng;
    var lat = latlng.lat;
    var lng = latlng.lng;
    var city = e.suggestion.name;
  });

});