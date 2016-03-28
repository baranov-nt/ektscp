/**
 * Created by User on 25.01.2016.
 */
(function ($) {
    $('.spinner .btn-hours-start:first-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-start').val() < 24) {
        $('.spinner #catalogform-hours-start').val( parseInt($('.spinner #catalogform-hours-start').val(), 10) + 1)};
    });

    $('.spinner .btn-hours-start:last-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-start').val() > 0) {
            $('.spinner #catalogform-hours-start').val( parseInt($('.spinner #catalogform-hours-start').val(), 10) - 1)};
    });
})(jQuery);
(function ($) {
    $('.spinner .btn-minutes-start:first-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-start').val() < 60) {
        $('.spinner #catalogform-minutes-start').val( parseInt($('.spinner #catalogform-minutes-start').val(), 10) + 1)};
    });

    $('.spinner .btn-minutes-start:last-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-start').val() > 0) {
        $('.spinner #catalogform-minutes-start').val( parseInt($('.spinner #catalogform-minutes-start').val(), 10) - 1)};
    });
    $('.spinner .btn-hours-end:first-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-end').val() < 24) {
            $('.spinner #catalogform-hours-end').val( parseInt($('.spinner #catalogform-hours-end').val(), 10) + 1)};
    });

    $('.spinner .btn-hours-end:last-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-end').val() > 0) {
            $('.spinner #catalogform-hours-end').val( parseInt($('.spinner #catalogform-hours-end').val(), 10) - 1)};
    });
})(jQuery);
(function ($) {
    $('.spinner .btn-minutes-end:first-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-end').val() < 60) {
            $('.spinner #catalogform-minutes-end').val( parseInt($('.spinner #catalogform-minutes-end').val(), 10) + 1)};
    });

    $('.spinner .btn-minutes-end:last-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-end').val() > 0) {
            $('.spinner #catalogform-minutes-end').val( parseInt($('.spinner #catalogform-minutes-end').val(), 10) - 1)};
    });
    // -----------------------------------------------------------------------------------------------------------------
    $('.spinner .btn-hours-start-timeout:first-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-start-timeout').val() < 24) {
            $('.spinner #catalogform-hours-start-timeout').val( parseInt($('.spinner #catalogform-hours-start-timeout').val(), 10) + 1)};
    });

    $('.spinner .btn-hours-start-timeout:last-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-start-timeout').val() > 0) {
            $('.spinner #catalogform-hours-start-timeout').val( parseInt($('.spinner #catalogform-hours-start-timeout').val(), 10) - 1)};
    });
})(jQuery);
(function ($) {
    $('.spinner .btn-minutes-start-timeout:first-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-start-timeout').val() < 60) {
            $('.spinner #catalogform-minutes-start-timeout').val( parseInt($('.spinner #catalogform-minutes-start-timeout').val(), 10) + 1)};
    });

    $('.spinner .btn-minutes-start-timeout:last-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-start-timeout').val() > 0) {
            $('.spinner #catalogform-minutes-start-timeout').val( parseInt($('.spinner #catalogform-minutes-start-timeout').val(), 10) - 1)};
    });
    $('.spinner .btn-hours-end-timeout:first-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-end-timeout').val() < 24) {
            $('.spinner #catalogform-hours-end-timeout').val( parseInt($('.spinner #catalogform-hours-end-timeout').val(), 10) + 1)};
    });

    $('.spinner .btn-hours-end-timeout:last-of-type').on('click', function() {
        if($('.spinner #catalogform-hours-end-timeout').val() > 0) {
            $('.spinner #catalogform-hours-end-timeout').val( parseInt($('.spinner #catalogform-hours-end-timeout').val(), 10) - 1)};
    });
})(jQuery);
(function ($) {
    $('.spinner .btn-minutes-end-timeout:first-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-end-timeout').val() < 60) {
            $('.spinner #catalogform-minutes-end-timeout').val( parseInt($('.spinner #catalogform-minutes-end-timeout').val(), 10) + 1)};
    });

    $('.spinner .btn-minutes-end-timeout:last-of-type').on('click', function() {
        if($('.spinner #catalogform-minutes-end-timeout').val() > 0) {
            $('.spinner #catalogform-minutes-end-timeout').val( parseInt($('.spinner #catalogform-minutes-end-timeout').val(), 10) - 1)};
    });
    
})(jQuery);