var PricePlaningSection = function () {
    'use strict';

    return {
        initialize: function () {
            $('#trust .prev').click(function() {
                $('.slidesjs-previous').click();
            });

            $('#trust .next').click(function() {
                $('.slidesjs-next').click();
            });

            this.renderSection();
        },

        renderSection: function () {
            $('.trust_slides_container').slidesjs({
                width: 700,
                height: 90,
                effect: {
                    slide: {
                        speed: 3000
                    }
                },
                play: {
                    active: true,
                    auto: true,
                    interval: 5000,
                    swap: true,
                    pauseOnHover: true,
                    restartDelay: 2500
                }
            });
        }
    };
};