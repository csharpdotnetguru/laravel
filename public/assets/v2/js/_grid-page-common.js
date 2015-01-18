$(function() {
    // Instantiate MixItUp:
    $('#Container').mixItUp();
});

var itemModal = {

    click: function(itemUrl) {
        $('.devices').on('click', 'a', function(e) {
            //console.log('clicked on modal link');
            e.preventDefault();

            var itemId = $(this).data('item-id'),
                modalClickId = $(this).data('modal-click-id');

            itemModal.init(itemId, itemUrl, modalClickId);
        });
    },

    init: function(itemId, itemUrl, modalClickId) {

        if (itemId === undefined) {
            //console.log('does not have device id; return to normal');
            return;
        }

        //console.log('Has device id; proceed to open modal');

        $.get(itemUrl, {item_id: itemId})
            .done(function(data) {
                // console.log(data);
                $('div.remodal').html(data);
                itemModal.openModal(modalClickId);
            }
        );
    },

    openModal: function(modalClickId) {
        var inst = $.remodal.lookup[$('[data-remodal-id=' + modalClickId + ']').data('remodal')];
        inst.open();

        // close button
        $('.close-button a').click(function() {
            inst.close();
        });
    }
};


