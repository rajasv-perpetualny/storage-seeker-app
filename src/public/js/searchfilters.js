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
/******/ 	return __webpack_require__(__webpack_require__.s = 51);
/******/ })
/************************************************************************/
/******/ ({

/***/ 3:
/***/ (function(module, exports) {

$('#show_more_button').unbind();
var searchFilters = {};

$(function () {
    $('#page-preloader').css('height', $('#main').height());
    // ID redirection for reviews is happening through URL hash, collides with searchfilter init, adding gard
    if (window.location.hash && window.location.hash !== "#reviews") {
        window.location = basePath + '/search?' + window.location.hash.substring(1, window.location.hash.length);
    } else {
        searchFilters.hideLoaders();
        searchFilters.initSearch();
    }
});

var show_more_button = $('#show_more_button');

searchFilters.hideLoaders = function () {
    $('.preloader').animate({ opacity: 0 }, 200, function () {
        $('.preloader').hide();
    });
};

searchFilters.initSearch = function () {
    $('[data-size-value]').click(function (element) {
        $('#search_squareFoot').val($(this).attr('data-size-value'));
    });
    $('#select_order, [name="type"]').change(function (element) {
        $('#search_sort').val($('#select_order').val());
        $('#search_form').submit();
    });
    $("#search_form").submit(function (event) {
        $('#search_page').val(1);
        $('#search_sort').val($('#search_sort').val());
    });
    $("#show_more_button").click(function (event) {
        var me = $(this);
        event.preventDefault();
        if (me.data('requestRunning')) {
            return;
        }

        $('#search_source').val('ajax');
        $('#search_page').val($('#search_page').val() * 1 + 1);
        var data = $("#search_form").serialize();
        $.ajax(this.href, {
            url: basePath + '/search',
            data: data,
            dataType: 'json',
            type: 'POST',
            async: true,
            beforeSend: function beforeSend() {
                $('#show_more_button').attr('disabled', true);
            },
            success: function success(data) {
                $('#listings').html($('#listings').html() + data.html);
                $('#search_source').val('');
                show_more_button.attr('disabled', false);
                show_more_button.text("Show More");

                searchFilters.resetGoogle(JSON.parse(data.json));
            },
            error: function error(e) {
                show_more_button.attr('disabled', true);
                show_more_button.text("There are no more facilities in the area");
                $('#search_page').val($('#search_page').val() * 1 - 1);
                show_more_button.show();
            }
        });
    });
};

searchFilters.resetGoogle = function (data) {
    listings = listings.concat(data);
    $('script[src$="/js/googlemaps.js"]').remove();
    $.getScript("/js/googlemaps.js", function () {
        $('script:last').attr('id', 'googlemapsjs');
    });
};

$(document).ready(function () {
    jQuery('main').find('[data-toggle="popover"]').popover();
});

/***/ }),

/***/ 51:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ })

/******/ });