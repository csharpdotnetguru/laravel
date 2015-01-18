var SpeedSection = function () {
    'use strict';

    return {
        initialize: function () {
            this.renderSection();
        },

        resetAnimations: function() {
            var pointer1 = $('.pointer1'),
                pointer2 = $('.pointer2');

            // cloning elements
            var pointer1Clone = pointer1.clone(true),
                pointer2Clone = pointer2.clone(true);

            // reinserting cloned elements
            pointer1.before(pointer1Clone);
            pointer2.before(pointer2Clone);

            // deleting old elements
            $('.' + pointer1.attr('class') + ':last').remove();
            $('.' + pointer2.attr('class') + ':last').remove();
        },

        renderSection: function () {
            var that = this;

            // Starts the animation once the slider has finished scrolling
            setTimeout(function(){
                that.resetAnimations();
            }, 500);
        }
    };
};