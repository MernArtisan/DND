(function ($) {
    "use strict";

    /* Google Map Active */
    function contactMap() {
        var mapElement = document.getElementById('google-map');

        if (!mapElement) return;

        var mapOptions = {
            zoom: 11,
            scrollwheel: false,
            center: new google.maps.LatLng(40.6700, -73.9400),
            styles: [/* your styles here */]
        };

        var map = new google.maps.Map(mapElement, mapOptions);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(40.6700, -73.9400),
            map: map,
            title: 'Cryptox'
        });
    }

    // Safe way to initialize after window and Google API loaded
    $(window).on('load', function () {
        if ($('#google-map').length !== 0 && typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
            contactMap();
        }
    });

})(jQuery);
