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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/admin.js":
/*!**************************************!*\
  !*** ./resources/assets/js/admin.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  var HTTP;

  function updateFaqSort() {
    var items = document.querySelectorAll('.faq-item');
    var formData = new FormData();
    items.forEach(function (v) {
      var id = v.getAttribute('data-id');
      formData.append('items[]', id);
    });
    var url = '/admin/faqs/update/sort';
    HTTP.post(url, formData).then(function (response) {})["catch"](function (e) {
      console.log('sort error');
    });
  }

  function updateFaqGroupSort() {
    var items = document.querySelectorAll('.faq-item');
    var formData = new FormData();
    items.forEach(function (v) {
      var id = v.getAttribute('data-id');
      formData.append('items[]', id);
    });
    var url = '/admin/faq-group/update/sort';
    HTTP.post(url, formData).then(function (response) {})["catch"](function (e) {
      console.log('sort error');
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    HTTP = axios.create(axios.defaults.headers.common = {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': app.csrfToken,
      'Content-Type': 'multipart/form-data'
    });
    var $faqsList = document.querySelector('.faqs-table tbody');

    if ($faqsList) {
      sortable.create($faqsList, {
        handle: '.sort-handle',
        easing: "cubic-bezier(1, 0, 0, 1)",
        animation: 150,
        onEnd: function onEnd(e) {
          updateFaqSort();
        },
        onAdd: function onAdd(e) {},
        onStart: function onStart(evt) {}
      });
    }

    var $faqGroupList = document.querySelector('.faq-group-table tbody');

    if ($faqGroupList) {
      sortable.create($faqGroupList, {
        handle: '.sort-handle',
        easing: "cubic-bezier(1, 0, 0, 1)",
        animation: 150,
        onEnd: function onEnd(e) {
          updateFaqGroupSort();
        },
        onAdd: function onAdd(e) {},
        onStart: function onStart(evt) {}
      });
    }
  });
})();

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/assets/js/admin.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/donjones/Sites/neutrino-test/vendor/newelement/faqs/resources/assets/js/admin.js */"./resources/assets/js/admin.js");


/***/ })

/******/ });