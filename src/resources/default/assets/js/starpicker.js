'use strict';

module.exports = class StarPicker {

  constructor(jQuery) {
    this.jQuery = jQuery;
  }

  init() {
    this.jQuery('.rating-widget').each((i, element) => {
        this.initWidget(this.jQuery(element));
      }
    );
  }

  initWidget(widget) {
    widget.find('.star > div').each((i, element) => {
      let star = this.jQuery(element);
      let rating = parseFloat(star.attr('data-rating'));
      let field = widget.attr('data-field');
      let form = star.closest('form');

      star.click(() => {
        form.find('[name="'+ field +'"]').attr('value', rating);
        widget.find('.star > div').each((i, e) => {
          StarPicker.updateStar(this.jQuery(e), rating, 'active');
        });
      });

      star.hover(() => {
          widget.find('.star > div').each((i, e) => {
            StarPicker.updateStar(this.jQuery(e), rating, 'hover');
          });
        }, () => {
          widget.find('.star > div').each((i, e) => {
            StarPicker.updateStar(this.jQuery(e), 0, 'hover');
          });
        }
      );
    });
  }

  static updateStar(star, rating, classStr) {
    let value = parseFloat(star.attr('data-rating'));
    if (rating >= value) {
      star.addClass(classStr);
    } else {
      star.removeClass(classStr);
    }
  }
}