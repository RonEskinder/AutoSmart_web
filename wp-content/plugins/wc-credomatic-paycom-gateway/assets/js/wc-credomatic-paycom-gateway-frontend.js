;
(function(CredomaticPayCOMGatewayFrontEnd) {
    CredomaticPayCOMGatewayFrontEnd(window.jQuery, window, document);
}(function($, window, document) {
    $(function() {
        'use strict';
        $('.credomatic-card-holder').alpha();
        $('body').on('updated_checkout', function() {
            $('.credomatic-card-holder').alpha();
        });
    });
}));
