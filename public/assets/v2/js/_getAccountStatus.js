var checkStatus = {

    initCheck: function (dnsStatusApiLink, accountStatusApiLink) {
        $.getJSON(dnsStatusApiLink, function (dnsStatusResult) {
            //console.log(this);
            checkStatus.getAccountStatus(dnsStatusResult, accountStatusApiLink);
        });
    },

    getAccountStatus: function (dnsStatusResult, accountStatusApiLink) {
        $.getJSON(accountStatusApiLink, function (accountStatusResult) {
            checkStatus.statusConditionCheck(dnsStatusResult, accountStatusResult)
        });
    },

    displayStatus: function (hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, buzz, autoHide) {
        hideBarEl.hide();
        showBarEl.slideDown();

        if (autoHide == true) {
            setTimeout(function () {
                showBarEl.slideUp();
            }, 3000);
        }

        if (remodalId != undefined) {
            // if setup incomplete, and don't show this anymore, don't show modal
            if ((remodalId == 'dns-setup-failed') && (localStorage['dont-show-setup-incomplete-modal-quickstart']))
                return false;

            //console.log('has remodal id. open modal');
            //console.log(remodalId);
            var inst = $.remodal.lookup[$('[data-remodal-id=' + remodalId + ']')
                .data('remodal')];
            inst.open();
        }

        if (buzz == true) {
            //console.log('buzz the tile');
            infiniteWiggle.startWiggle(tileEl);
        }

        var replacementElHtml = replacementEl.html();
        var wrapAHtml = wrapA.removeClass('hidden');

        tileEl.removeClass('success');
        tileEl.addClass(className);
        tileEl.find('.tile-content').html(replacementElHtml);
        tileEl.wrap(wrapA);

        $('a.stop-buzzing').click(function () {
            event.preventDefault();
            infiniteWiggle.stopWiggle();
        });
    },

    statusConditionCheck: function (dnsStatusResult, accountStatusResult) {
        var hideBarEl = $('#checking-bar'),
            tileEl = $('#tile_account_status');

        if (accountStatusResult.email_confirmed != true) {
            var showBarEl = $('#email-confirm-bar'),
                remodalId = 'email-confirm',
                replacementEl = $('.fixture-email-confirm'),
                wrapA = $('.fixture-email-confirm-fix-link'),
                className = 'warning';

            this.displayStatus(hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, true);

            return false;
        }
        
        if (dnsStatusResult.dns_status != 'true') {
            var showBarEl = $('#dns-failed-bar'),
                remodalId = 'dns-setup-failed',
                replacementEl = $('.fixture-incomplete'),
                wrapA = $('.fixture-incomplete-fix-link'),
                className = 'error';

            //console.log('Display DNS Setup Failed');

            return this.displayStatus(hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, true);
        }

        if (accountStatusResult.known_user != true) {
            var showBarEl = $('#unknown-user-bar'),
                remodalId = 'update-ip',
                replacementEl = $('.fixture-update-ip'),
                wrapA = $('.fixture-update-ip-fix-link'),
                className = 'error';

            // console.log('Display Update IP Address');

            return this.displayStatus(hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, true);
        }

        if (accountStatusResult.no_sub != false) {
            var showBarEl = $('#no-subscription-bar'),
                remodalId = 'no-subscription',
                replacementEl = $('.fixture-no-subscription'),
                wrapA = $('.fixture-no-subscription-fix-link'),
                className = 'error';

            //console.log('Display Purchase Sub');
            return this.displayStatus(hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, true);
        }

        if (accountStatusResult.expired != false) {
            var showBarEl = $('#account-expired-bar'),
                remodalId = 'account-expired',
                replacementEl = $('.fixture-account-expired'),
                wrapA = $('.fixture-account-expired-fix-link'),
                className = 'error';

            //console.log('Display Account Expired');

            return this.displayStatus(hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, true);
        }



        if (accountStatusResult.sub_suspended != false) {
            var showBarEl = $('#account-suspended-bar'),
                remodalId = 'account-suspended',
                replacementEl = $('.fixture-account-suspended'),
                wrapA = $('.fixture-account-suspended-fix-link'),
                className = 'error';

            //console.log('Dispaly Account Suspended');
            return this.displayStatus(hideBarEl, showBarEl, remodalId, tileEl, replacementEl, wrapA, className, true);
        }

        var showBarEl = $('#all-success-bar'),
            replacementEl = $('.fixture-all-success'),
            wrapA = $('.fixture-all-success-link'),
            className = 'success';

        if (localStorage['dont-show-first-time-modal-quickstart'] === undefined) {
            var inst = $.remodal.lookup[$('[data-remodal-id=first-time]')
                .data('remodal')];
            inst.open();
        }

        //console.log('Setup is Complete');
        return this.displayStatus(hideBarEl, showBarEl, undefined, tileEl, replacementEl, wrapA, className, false, true);
    }

};