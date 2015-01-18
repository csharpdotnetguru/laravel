$(function() {

    // back buttons
    $('.global-back-button a').click(function() {
        event.preventDefault();

        // can't go back, go home
        if ((document.referrer == '') && (back_url)) {
            window.location.href = back_url;
        } else {
            history.back(1);
        }
    });

});