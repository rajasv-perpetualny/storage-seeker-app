/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
/******/ })
/************************************************************************/
/******/ ({

/***/ 4:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

module.exports = function () {
  function StarPicker(jQuery) {
    _classCallCheck(this, StarPicker);

    this.jQuery = jQuery;
  }

  _createClass(StarPicker, [{
    key: 'init',
    value: function init() {
      var _this = this;

      this.jQuery('.rating-widget').each(function (i, element) {
        _this.initWidget(_this.jQuery(element));
      });
    }
  }, {
    key: 'initWidget',
    value: function initWidget(widget) {
      var _this2 = this;

      widget.find('.star > div').each(function (i, element) {
        var star = _this2.jQuery(element);
        var rating = parseFloat(star.attr('data-rating'));
        var field = widget.attr('data-field');
        var form = star.closest('form');

        star.click(function () {
          form.find('[name="' + field + '"]').attr('value', rating);
          widget.find('.star > div').each(function (i, e) {
            StarPicker.updateStar(_this2.jQuery(e), rating, 'active');
          });
        });

        star.hover(function () {
          widget.find('.star > div').each(function (i, e) {
            StarPicker.updateStar(_this2.jQuery(e), rating, 'hover');
          });
        }, function () {
          widget.find('.star > div').each(function (i, e) {
            StarPicker.updateStar(_this2.jQuery(e), 0, 'hover');
          });
        });
      });
    }
  }], [{
    key: 'updateStar',
    value: function updateStar(star, rating, classStr) {
      var value = parseFloat(star.attr('data-rating'));
      if (rating >= value) {
        star.addClass(classStr);
      } else {
        star.removeClass(classStr);
      }
    }
  }]);

  return StarPicker;
}();

/***/ }),

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(4);


/***/ })

/******/ });