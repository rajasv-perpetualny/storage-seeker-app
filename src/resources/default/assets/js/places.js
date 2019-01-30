module.exports = class Places {

    constructor(google) {
        this.google = google;
    }

    factoryAutoComplete(id) {
        let element = document.getElementById(id);
        if (element) {
            let autoCompleteOptions = {
                types: ['geocode']
                , componentRestrictions: {
                    country: 'us'
                }
            };
            return new this.google.maps.places.Autocomplete(element, autoCompleteOptions);
        }
        return false;

    }

}