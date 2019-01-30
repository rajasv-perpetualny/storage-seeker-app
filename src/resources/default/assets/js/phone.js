module.exports = class Phone {

    constructor(jQuery) {
        this.jQuery = jQuery;
    }

    init() {
        this.initPhoneNumber();
    }

    initPhoneNumber() {
        let headerPhone = this.jQuery('#header-phone-number');
        let facilityPhone = this.jQuery('#facility-phone-number');
        this.headerPhone = headerPhone;
        this.facilityPhone = facilityPhone;

        if (headerPhone.length > 0 && facilityPhone.length > 0) {
            headerPhone.html(facilityPhone.html());
        }
    }

    initCallNow() {
        if(!this.headerPhone || !this.headerPhone.text()) { return; }

        let phoneNumber = this.headerPhone.text();

        this.jQuery('#listings').find('span.call-now').each((i,span) => {
            let spanElement = this.jQuery(span);
            spanElement.show(0, 'inline-block');
            spanElement.off('click'); // turn click off so we dont double bind when show more is called
            spanElement.click(e => {
                let a = spanElement.find('a');

                a.attr('href', 'tel:' + phoneNumber.replace(/[- )(]/g,''));
                a.find('span').text(' ' + phoneNumber);
                spanElement.off('click');
            });
        });
    }
}