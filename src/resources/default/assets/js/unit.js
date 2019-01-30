var UnitForm = {};
UnitForm.reservationForm  = jQuery('main div.form').find('form');
UnitForm.init = function(){
    this.reservationForm.find('input').focusout((event) => {
        this.validateInputField(jQuery(event.currentTarget));
    });
};
UnitForm.validateInputField = function(field) {
    valid = true;
    switch(field.attr('id')) {
        case 'reservation_emailAddress':
            valid = this.validateEmailAddress(field);
            break;
        case 'reservation_phoneNumber':
            valid = this.validatePhoneNumber(field);
            break;
        case 'reservation_moveInDate_datepicker':
            valid = this.validateDate(field);
            break;
        case 'reservation_firstName':
        case 'reservation_lastName':
            valid = this.validateMoreThanCharacters(field);
            break;
    }
    this.toggleInputValid(field, valid);
    return valid;
}
UnitForm.validateEmailAddress = function(field) {
    emailRgx = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return !!field.val().match(emailRgx);
}
UnitForm.validatePhoneNumber = function(field) {
    phoneRgx = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return !!field.val().match(phoneRgx);
}
UnitForm.validateDate = function(field) {
    dateRgx = /^\d{4}[/-]\d{2}[/-]\d{2}$/;
    return !!field.val().match(dateRgx);
}
UnitForm.validateMoreThanCharacters = function(field, num = 1) {
    return field.val().length > num;
}
UnitForm.toggleInputValid = function(input, valid) {
    div = input.closest('div');
    if (valid) {
        div.removeClass('has-error');
        div.addClass('valid');
    } else {
        div.removeClass('valid');
        div.addClass('has-error');
    }
}

$(document).ready(function () {
    UnitForm.init();
});