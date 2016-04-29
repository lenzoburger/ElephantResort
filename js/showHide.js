/**
 * Created by lburka on 8/18/15.
 *
 * A script which show and hides room type categorical information and images in ourRooms.php
 */
var ShowHide = (function () {
    "use strict";

    var pub;

    // Public interface
    pub = {};

    /**
     * show and hides rooms in selected room type category.
     */
    function showHide() {
        var container = $(this).parent().parent().parent();
        $(container).next().toggle("slow");
    }

    /**
     * setup function.
     *
     * hides preloaded categorical room type information.
     */
    pub.setup = function () {
        $(".information").slideUp();
        $(".subheading").css('cursor', 'pointer');
        $(".subheading").click(showHide);
        $(".img-circle").css('cursor', 'pointer');
        $(".img-circle").click(showHide);
    };

    // Expose public interface
    return pub;
}());

$(document).ready(ShowHide.setup);