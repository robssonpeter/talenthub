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
/******/ 	return __webpack_require__(__webpack_require__.s = 29);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidates/candidate-profile/candidate-resume.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/js/candidates/candidate-profile/candidate-resume.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  $(document).on('click', '.uploadResumeModal', function () {
    $('#uploadModal').appendTo('body').modal('show');
  });
  $(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewForm', '#btnSave', 'loading');
    $.ajax({
      url: resumeUploadUrl,
      type: 'post',
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function success(result) {
          console.log(result)
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#uploadModal').modal('hide');
          location.reload();
        }
      },
      error: function error(result) {
          console.log(result);
        //displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#addNewForm', '#btnSave');
      }
    });
  });
  $(document).on('change', '#customFile', function () {
    var extension = isValidDocument($(this), '#validationErrorsBox');

    if (!isEmpty(extension) && extension != false) {
      $('#validationErrorsBox').html('').hide();
    }
  });

  window.isValidDocument = function (inputSelector, validationMessageSelector) {
    var ext = $(inputSelector).val().split('.').pop().toLowerCase();

    if ($.inArray(ext, ['jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
      $(inputSelector).val('');
      $(validationMessageSelector).removeClass('d-none').html('The document must be a file of type: jpeg, jpg, pdf, doc, docx.').show();
      return false;
    }

    return ext;
  };

  $('.custom-file-input').on('change', function () {
    var fileName = $(this).val().split('\\').pop();
    $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
  });
  $(document).on('click', '.delete-resume', function (event) {
    var resumeId = $(event.currentTarget).data('id');
    swal({
      title: 'Delete !',
      text: 'Are you sure want to delete this "Resume" ?',
      type: 'warning',
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
      confirmButtonColor: '#5cb85c',
      cancelButtonColor: '#d33',
      cancelButtonText: 'No',
      confirmButtonText: 'Yes'
    }, function () {
      $.ajax({
        url: resumeUploadUrl + '/' + resumeId,
        type: 'DELETE',
        success: function success(result) {
          if (result.success) {
            setTimeout(location.reload(), 1000);
          }

          swal({
            title: 'Deleted!',
            text: 'Resume has been deleted.',
            type: 'success',
            timer: 2000
          });
        },
        error: function error(data) {
          swal({
            title: '',
            text: data.responseJSON.message,
            type: 'error',
            timer: 5000
          });
        }
      });
    });
  });
});
$('#uploadModal').on('hidden.bs.modal', function () {
  $('#customFile').siblings('.custom-file-label').addClass('selected').html('Choose file');
  resetModalForm('#addNewForm', '#validationErrorsBox');
});

/***/ }),

/***/ 29:
/*!************************************************************************************!*\
  !*** multi ./resources/assets/js/candidates/candidate-profile/candidate-resume.js ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidates/candidate-profile/candidate-resume.js */"./resources/assets/js/candidates/candidate-profile/candidate-resume.js");


/***/ })

/******/ });
