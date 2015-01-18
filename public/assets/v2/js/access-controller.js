var UnlimitedAccessAndBandwidthSection = function () {
    'use strict';

    return {
        initialize: function () {
            this.renderSection();
        },

        renderSection: function () {
            var $header = $('#unlimitedAccess #header'),
                $flowChart = $('#unlimitedAccess .access-container .flow-chart'),
                $flowCenter = $('#unlimitedAccess .access-container .flow-chart .flow-center');

            var width = $(window).width(),
                height = $(window).height(),
                containerOriginWidth = 1400,
                imageOriginHeight = 690,
                imageOriginWidth = 920,
                sectionHeight = height - $header.height() - 15,
                curSectionRatio = sectionHeight / containerOriginWidth;

            $flowChart.css({
                'max-width': width,
                'height': imageOriginHeight * curSectionRatio,
                'width': imageOriginWidth * curSectionRatio
            });

            $flowCenter.css({
                'font-size': ($flowCenter.width() * 0.21),
                'height': $flowCenter.width(),
                'padding-top': ($flowCenter.width() / 2 - 12),
                'top': ($flowChart.height() - $flowCenter.width()) / 2
            });

        }
    };
};