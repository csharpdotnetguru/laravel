var DevicesAndPlatformsSection = function () {
    'use strict';

    return {
        initialize: function () {
            this.renderSection();
        },

        renderSection: function () {
            var $deviceTop = $('#main #devicesAndPlatforms .devices-wrapper .devices-top'),
                $deviceDown = $('#main #devicesAndPlatforms .devices-wrapper .devices-down');

            $deviceTop.hide();
            $deviceDown.hide();

            // Fade in once the slider has finished scrolling
            setTimeout(function(){
                $deviceTop.fadeIn(750);
                $deviceDown.fadeIn(750);
            }, 500);
        }
    };
};