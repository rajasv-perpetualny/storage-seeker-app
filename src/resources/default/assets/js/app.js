
require('./bootstrap');
require('jquery-ui-dist/jquery-ui');
//require('jquery-ui-dist/ui/widgets/datepicker');
require('./reserve');
require('jquery-star-rating-plugin/jquery.rating')
require('jquery_metadata/jquery.metadata');
require('./searchfilters');
require('./review');
require('./unit');
require('./searchzip');
const Places = require('./places');
const StarPicker = require('./starpicker');

const Phone = require('./phone');

$(document).ready(() => {
  let starPicker = new StarPicker(jQuery);

  starPicker.init();

  if(typeof google != 'undefined') {
     place = new Places(google);
     place.factoryAutoComplete('search_location');
     let phone = new Phone(jQuery);
     phone.init();
     phone.initCallNow();
  }
  if($('.map').length){
    fixMapToTop();
    $(document).scroll(fixMapToTop);
  }
});

function fixMapToTop(){
  if($('.search-container').offset().top - $(window).scrollTop() > 0) {
    if($('.map-container').hasClass('fixed')){
      $('.map-container').removeClass('fixed');
    }
  } else {
    if(!$('.map-container').hasClass('fixed')){
      $('.map-container').addClass('fixed');
    }
  }
}
