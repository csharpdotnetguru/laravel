(function () {
    'use strict';

    // Extending jQuery
    $.fn.extend({
        // validates in input / check if it's an email
        isEmail: function () {
            return !!this.val().match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
        },

        // return the integer value from a css attribute
        intFromCss: function (attribute) {
            return parseInt(this.css(attribute).replace(/[^-\d\.]/g, ''));
        }
    });

    // On document ready
    $(function () {
        // if not mobile, run the fullpagejs stuff
        if (typeof is_mobile !== false) {
            $('.has-tooltip').tooltip();
            fullPageInitialize();
            $(window).bind('resize', renderPage);
            switchIndex(1);
        }

        renderPage();
    });

    // Initialize sections
    var renderPage = function () {
        // For front page (GeoBlock) section
        FrontPageSection().initialize();

        // For channels section
        ChannelsSection().initialize();

        // For devices Page
        DevicesAndPlatformsSection().initialize();

        // For 'Unlimited Access and Bandwidth' section
        UnlimitedAccessAndBandwidthSection().initialize();

        // For 'Customize your Favorite Channels'
        FavoriteChannelsSection().initialize();

        // For 'We care about your experience' section
        OnDemandSection().initialize();

        // For 'Blazing Speed with DirectConnect' section
        SpeedSection().initialize();

        // For 'Map section' section
        MapSection().initialize();

        // For 'Price Planing' section
        PricePlaningSection().initialize();

        // For 'Footer' section
        FooterSection().initialize();
    };

    var fullPageInitialize = function () {
        $('#main').fullpage({
            verticalCentered: false,
            css3: true,
            navigation: true,
            navigationPosition: 'right',
            fixedElements: '.navbar',

            navigationTooltips: [
                'Experience',
                'Channels',
                'Devices',
                'Unlimited Access',
                'Customize',
                'We Care',
                'Blazing Speed',
                'Global Presence',
                // 'Press Reviews',
                'Pricing',
                'Contact Us'
            ],
            anchors:[
                '1-experience',
                '2-channels',
                '3-devices',
                '4-unlimited-access',
                '5-customize',
                '6-we-care',
                '7-blazing-speed',
                '8-global-presence',
                // '9-press-reviews',
                '10-pricing',
                '11-contact-us'
            ],

            'onLeave': function(index, nextIndex, direction) {
                switchIndex(nextIndex);
            }

        });
    };

    var switchIndex = function(index) {
        switch(index) {
            case 1:
                setOnePageWhite();
                FrontPageSection().renderSection();
                break;
            case 2:
                setOnePageBlack();
                ChannelsSection().renderSection();
                break;
            case 3:
                setOnePageWhite();
                DevicesAndPlatformsSection().renderSection();
                break;
            case 4:
                setOnePageWhite();
                UnlimitedAccessAndBandwidthSection().renderSection();
                break;
            case 5:
                setOnePageWhite();
                FavoriteChannelsSection().renderSection();
                break;
            case 6:
                setOnePageBlack();
                OnDemandSection().renderSection();
                break;
            case 7:
                setOnePageWhite();
                SpeedSection().renderSection();
                break;
            case 8:
                setOnePageWhite();
                MapSection().renderSection();
                break;
            case 9:
                setOnePageBlack();
                PricePlaningSection().renderSection();
                break;
            case 10:
                setOnePageWhite();
                FooterSection().renderSection();
                break;
        }
    };

    var setOnePageWhite = function() {
        setTimeout(function(){
            $('#fullPage-nav').addClass('white');
        }, 250);
    };

    var setOnePageBlack = function () {
        setTimeout(function(){
            $('#fullPage-nav').removeClass('white');
        }, 250);
    };

})();