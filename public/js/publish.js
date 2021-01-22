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
    var postcode = e.suggestion.highlight.postcode;
    var code_departement = postcode.substr(0, 2);
    if (code_departement == 20) {
      if (postcode.substr(0, 3) == 201) {
        code_departement = '2a';
      } else {
        code_departement = '2b';
      }
    }
    $('input[name="ville"]').val(city);
    $('input[name="code_departement"]').val(code_departement);
    $('input[name="latitude"]').val(lat);
    $('input[name="longitude"]').val(lng);
  });

  $('#destination').on('keyup', function() {
    if ($(this).val() == '') {
      $('input[name="ville"]').val('');
      $('input[name="code_departement"]').val('');
      $('input[name="latitude"]').val('');
      $('input[name="longitude"]').val('');
    }
  });

  placesAutocomplete.on('clear', function(e) {
    $('input[name="ville"]').val('');
    $('input[name="code_departement"]').val('');
    $('input[name="latitude"]').val('');
    $('input[name="longitude"]').val('');
  });

});