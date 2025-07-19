// StarHotel Javascripts
jQuery(document).ready(function () {
    "use strict";

	

    // Reservation Form	
    //jQueryUI - Datepicker
    if (jQuery().datepicker) {
        jQuery('#checkin').datepicker({
            showAnim: "drop",
            dateFormat: "dd/mm/yy",
        });

        jQuery('#checkout').datepicker({
            showAnim: "drop",
            dateFormat: "dd/mm/yy",
            minDate: "-0D",
            beforeShow: function () {
                var a = jQuery("#checkin").datepicker('getDate');
                if (a) return {
                    minDate: a
                }
            }
        });
        jQuery('#checkin, #checkout').on('focus', function () {
            jQuery(this).blur();
        }); // Remove virtual keyboard on touch devices
    }






});