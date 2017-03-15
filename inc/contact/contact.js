var contact = {
    config: {
        id: "#contactForm"
    },
    init: function() {
        if (jQuery(contact.config.id).length > 0) {
            jQuery(contact.config.id).submit(contact.submit);
        }
    },
    submit: function(e) {
        e.preventDefault();
        var Frm = jQuery(contact.config.id);
        jQuery('<i class="fa fa-spinner fa-spin"></i>').prependTo('.btn-primary');

        var formInfo = {
            name: jQuery('#name').val(),
            emailaddress: jQuery('#emailaddress').val(),
            message: jQuery('#message').val(),
            action: 'sendContact'
        };

        jQuery.ajax({
            url: meta.ajaxurl,
            type: Frm.attr('method'),
            data: formInfo,
            dataType: 'html',
            beforeSubmit: function(arr, jQueryform, options) {
                arr.push({
                    "contact": "nonce",
                    "value": meta.nonce
                });
            },
            success: function(data) {
                console.log(data);
                contact.response(data);
            }
        });

        return false;
    },
    response: function(response) {
        jQuery(contact.config.id + " .btn-primary i").remove();
        if (response === "Success") {
            jQuery(contact.config.id + " .btn-primary").replaceWith('<button class="btn btn-primary success"><i class="fa fa-check"></i></button>');
            jQuery(contact.config.id + " input").val("");
            jQuery(contact.config.id + " textarea").val("");
            // setTimeout(
            //     function() {
            //         jQuery('.btn-primary').replaceWith('<button class="btn btn-primary">Submit</button>');
            //     }, 2500
            // );
        }

        if (response === "E") {
            jQuery(contact.config.id + " .btn-primary").replaceWith('<button class="btn btn-primary error"><i class="fa fa-ban"></i></button>');
            // setTimeout(
            //     function() {
            //         jQuery('.btn-primary').replaceWith('<button class="btn btn-primary">Submit</button>');
            //     }, 2500
            // );
        }
    }
}

contact.init();
