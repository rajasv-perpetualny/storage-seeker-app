var SfCpaReserve = {};
var SfCpaFacility = {};

$(function(){

    $('#first-name').focus();

    $('#move-in-date-not-sure').change(function(){
        if ($('#move-in-date-not-sure').is(':checked')) {
            showMessageModal('No problem!','Choose a date a few days after when you think you\'re likely to move in. You can move in any time before this date. If you need to push the date back you can call or email us.');
        }
    });

    if ($('#aaa-member-number').val() == ''  ) {
        $('#aaa-member-number-input').addClass('hidden');
    }

    $('#aaa-member-box').change(function(){
        if ($('#aaa-member-box').is(':checked')) {
            $('#aaa-member-number-input').removeClass('hidden');
        } else {
            $('#aaa-member-number').val('');
            $('#aaa-member-number-input').addClass('hidden');
        }
    });

    $('#discount-button').click(function(){
        $('#discount-modal').modal();
    });

    $('#discount-modal').submit(function(event){
        event.preventDefault();
        SfCpaFacility.saveDiscount();
    });

    $('#directions-modal').submit(function(event){
        event.preventDefault();
        SfCpaFacility.sendDirections();
    });

    $('#hours-directions-modal').submit(function(event){
        event.preventDefault();
        SfCpaFacility.sendDirectionsHours();
    });

    if (typeof Modernizr !== 'undefined' && Modernizr.touch && Modernizr.inputtypes.date) {

        $('#move-in-date').attr('type','date');

    } else {

        $('#move-in-date').datepicker({
            minDate: 0,
            maxDate: typeof(maxBookDays) !== 'undefined' ? maxBookDays : 0,
            beforeShowDay: SfCpaReserve.isNotClosed,
            beforeShow: function(){
                setTimeout(function(){
                    $(".ui-datepicker").css("z-index", 9999);
                }, 10);
            },
            onSelect: function(date) {
                $('#move-in-date').blur();
                $('#move-in-date-error-feedback').addClass('hidden');
            }
        });
    }

    $("#booking-form").submit(function(event){

        var $form = $(this);
        if ($form.hasClass('js-validated')) {
            // Validation handled by universal_validator, so skipping:
            return true;
        }

        $form.find('.form-group').removeClass('has-error');

        var erroredFields = [];
        if ($form.find('#first-name').val() == '') {
            erroredFields.push('first-name');
        }

        if ($form.find('#last-name').val() == '') {
            erroredFields.push('last-name');
        }

        if ($form.find('#email').val() == '') {
            erroredFields.push('email');
        }

        if ($form.find('#phone').val() == '') {
            erroredFields.push('phone');
        }

        if($form.find("#credit-card-fields").length > 0){

            if($form.find('#credit-card-number').val() == '' || !$.payment.validateCardNumber($form.find('#credit-card-number').val())) {
                erroredFields.push('credit-card-number');
            }

            if(!$.payment.validateCardExpiry($form.find('#credit-card-exp-month').val(),$form.find('#credit-card-exp-year').val())) {
                erroredFields.push('credit-card-exp-month');
                erroredFields.push('credit-card-exp-year');
            }

            if($form.find('#credit-card-security-code').val() == '' || !$.payment.validateCardCVC($form.find('#credit-card-security-code').val(),$.payment.cardType($form.find('#credit-card-number').val()))) {
                erroredFields.push('credit-card-security-code');
            }

            if(!$form.find("#credit-card-terms-agree").attr('checked')){
                erroredFields.push('credit-card-terms-agree');
            }
        }

        if ($form.find('#move-in-date').val() == '') {
            erroredFields.push('move-in-date');
        }

        if (erroredFields.length > 0) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $form.offset().top},'fast');

            for (var i = 0; i < erroredFields.length; i++) {
                $('#' + erroredFields[i]).closest('.form-group').addClass('has-error');
            }
        } else {

            $form.find(".js-btn-loader").attr('disabled','disabled').val('Reserving...');
        }

    });

});

SfCpaReserve.isNotClosed = function(date) {
    //remove the milliseconds from the date object timestamp
    var dateTimestamp = parseInt(date.valueOf().toString().slice(0, -3));
    var holidayResult = $.inArray(dateTimestamp, holidays) == -1 ? true : false;
    var closureResult = $.inArray(dateTimestamp, closures) == -1 ? true : false;
    var result = $.inArray( date.getDay(), closedDays ) ==-1 ? true : false;

    // Also disable date if past office closing time:
    var afterHoursResult = true;
    if (dateTimestamp == parseInt((new Date().setHours(0,0,0,0)).valueOf().toString().slice(0, -3))) {
        var hours = ('00'+(new Date()).getHours()).substr(-2,2);
        var minutes = ('00'+(new Date()).getMinutes()).substr(-2,2);
        afterHoursResult = hours+':'+minutes+':00' < closingTime;
    }

    return [(result && holidayResult && closureResult && afterHoursResult)];
}

SfCpaFacility.saveDiscount = function() {

    var formData = $('#discount-modal').serialize();

    $.ajax({
        url: basePath+"_unit/discount/",
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
            $('#discount-modal-loading').toggleClass('hide');
            $('#discount-submit').button('loading');
        },
        success: function(data){
            if (data.success == 0) {
                showMessageModal('Error',data.message);
            } else {
                $('#discount-modal').modal('hide');
                showMessageModal('Discount Sent','Your discount is on its way!');
                $('#message-modal').on('hidden', function() {
                    $('#discount-modal').modal('hide');
                });
            }
        },
        error: function (){
            showMessageModal('Error','There was an error sending your discount. Please try again later.');
        },
        complete: function() {
            $('#discount-modal-loading').toggleClass('hide');
            $('#discount-submit').button('reset');
        }
    });
}

SfCpaFacility.sendDirections = function() {

    var formData = $('#directions-modal').serialize();

    $.ajax({
        url: basePath+"_unit/directions/",
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
            $('#directions-modal-loading').toggleClass('hide');
            $('#directions-submit').button('loading');
        },
        success: function(data){
            if (data.success == 0) {
                showMessageModal('Error',data.message);
            } else {
                $('#directions-modal').modal('hide');
                showMessageModal('Directions Sent','Your directions are on their way!');
                $('#message-modal').on('hidden', function() {
                    $('#directions-modal').modal('hide');
                });
            }
        },
        error: function (){
            showMessageModal('Error','There was an error sending your message. Please try again later.');
        },
        complete: function() {
            $('#directions-modal-loading').toggleClass('hide');
            $('#directions-submit').button('reset');
        }
    });
}

SfCpaFacility.sendDirectionsHours = function() {

    var formData = $('#hours-directions-modal').serialize();

    $.ajax({
        url: basePath+"_unit/hours/",
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
            $('#hours-directions-modal-loading').toggleClass('hide');
            $('#hours-directions-submit').button('loading');
        },
        success: function(data){
            if (data.success == 0) {
                showMessageModal('Error',data.message);
            } else {
                $('#hours-directions-modal').modal('hide');
                showMessageModal('Directions Sent','Your directions are on their way!');
                $('#message-modal').on('hidden', function() {
                    $('#hours-directions-modal').modal('hide');
                });
            }
        },
        error: function (){
            showMessageModal('Error','There was an error sending your message. Please try again later.');
        },
        complete: function() {
            $('#hours-directions-modal-loading').toggleClass('hide');
            $('#hours-directions-submit').button('reset');
        }
    });
}


$(document).ready(function () {
    let abbreviated = jQuery('div.hours div.abbreviated');
    let full = jQuery('div.hours div.full');

    jQuery('#view-all-hours').click(e => {
        e.preventDefault();
    });

    abbreviated.click(() => {
        abbreviated.toggle();
        full.toggle();
    });
});
