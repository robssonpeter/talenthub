$(document).ready(function () {
    $('.selectpicker').selectpicker({
        dropupAuto: false,
    });

    $('#search-location').autocomplete({
        source: availableLocation,
    });

        $('.image-slider').owlCarousel({
            margin: 10,
            autoplay: true,
            loop: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: false,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                320: {
                    items: 1,
                    margin: 20,
                },
                540: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
            },
        });

    $('.pricing-slider').owlCarousel({
        margin: 10,
        autoplay: true,
        loop: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: false,
        dots: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 3,
            },
        },
    });

    $('#notices').on('mouseover', function () {
        this.stop();
    });

    $('#notices').on('mouseout', function () {
        this.start();
    });

});
