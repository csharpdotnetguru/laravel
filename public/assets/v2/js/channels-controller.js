var ChannelsSection = function () {
    'use strict';

    return {
        initialize: function () {
            this.renderSection();
        },

        resetAnimations: function() {
            var list1 = $('.slider1'),
                list2 = $('.slider2'),
                list3 = $('.slider3');

            // cloning elements
            var list1Clone = list1.clone(true),
                list2Clone = list2.clone(true),
                list3Clone = list3.clone(true);

            // reinserting cloned elements
            list1.before(list1Clone);
            list2.before(list2Clone);
            list3.before(list3Clone);

            // deleting old elements
            $('.' + list1.attr('class') + ':last').remove();
            $('.' + list2.attr('class') + ':last').remove();
            $('.' + list3.attr('class') + ':last').remove();
        },

        renderSection: function () {
            var that = this;
            that.resetAnimations();
        }

    };
};