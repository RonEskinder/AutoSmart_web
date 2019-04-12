;
(function(CredomaticPayCOMGatewayAdmin) {
    CredomaticPayCOMGatewayAdmin(window.jQuery, window, document);
}(function($, window, document) {
    $(function() {
        'use strict';
        $('#mainform').validate({
            rules: {
                woocommerce_credomatic_username: {
                    required: true
                },
                woocommerce_credomatic_key: {
                    required: true
                },
                woocommerce_credomatic_key_id: {
                    required: true
                },
                woocommerce_credomatic_processor_id: {
                    required: function(element) {
                        return $(element).val().length > 0;
                    },
                    rangelength: [8, 8]
                },
                woocommerce_credomatic_timeout: {
                    required: true,
                    range: [45, 60]
                }
            },
            messages: {
                woocommerce_credomatic_username: {
                    required: '(This field is required)'
                },
                woocommerce_credomatic_key: {
                    required: '(This field is required)'
                },
                woocommerce_credomatic_key_id: {
                    required: '(This field is required)'
                },
                woocommerce_credomatic_processor_id: {
                    required: '(This field is required)',
                    rangelength: '(This field must have 8 digits)'
                },
                woocommerce_credomatic_timeout: {
                    required: '(This field is required)',
                    range: '(This field is out the range)'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        var $keys = $('#woocommerce_credomatic_key_id, #woocommerce_credomatic_key');
        $keys.each(function(index) {
            var $input = $(this);
            $input.on('change', function(event) {
                var key = $.trim($input.val());
                if (key.length > 0) {
                    $input.val('Processing the key please wait...').prop('disabled', true);
                    setTimeout(function() {
                        var data = {
                            'action': 'wc_credomatic_paycom_gateway_encrypt_key',
                            'key': key
                        };
                        $.post(ajaxurl, data, function(encryptedKey) {
                            $input.val(encryptedKey).prop('disabled', false);
                        });
                    }, 3000);
                }
            }).on('copy', function(event) {
                event.preventDefault();
            });
        });
    });
}));
