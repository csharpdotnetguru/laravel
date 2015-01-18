var FrontPageSection = function () {
    'use strict';

    return {
        initialize: function () {
            this.renderSection();
        },

        renderSection: function () {
            var $content = $('#geoBlocks .geoContent');

            // Clicking on homepage brings section #1 (top)
            $('a.navbar-brand').click(function () {
                $.fn.fullpage.moveTo(1);
                return false;
            });

            // BigVideoJs (body background)
            // TODO: replace this by videoBG
//            var BV = new $.BigVideo({
//                useFlashForFirefox: false
//            });
//
//            BV.init();
//            BV.show('assets/videos/moments.mp4', {ambient: true});
        }
    };
};