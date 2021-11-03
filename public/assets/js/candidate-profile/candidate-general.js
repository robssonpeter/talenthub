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
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidates/candidate-profile/candidate-general.js":
/*!*******************************************************************************!*\
  !*** ./resources/assets/js/candidates/candidate-profile/candidate-general.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {
"use strict";
$(document).ready(function () {
    getSalarySlip(1);
  $('#birthDate').datetimepicker(DatetimepickerDefaults({
    format: 'YYYY-MM-DD',
    useCurrent: true,
    sideBySide: true,
    maxDate: new Date()
  }));
  $('#skillId, #languageId, #salaryCurrencyId,#countryId,#stateId,#cityId').select2({
    width: '100%'
  });
  $('#countryId').on('change', function () {
    $.ajax({
      url: companyStateUrl,
      type: 'get',
      dataType: 'json',
      data: {
        postal: $(this).val()
      },
      success: function success(data) {
        $('#stateId').empty();
        $('#stateId').append($('<option value=""></option>').text('Select Region'));
        $.each(data.data, function (i, v) {
          $('#stateId').append($('<option></option>').attr('value', i).text(v));
        });

        if (isEdit && stateId) {
          $('#stateId').val(stateId).trigger('change');
        }
      }
    });
  });
  $('#stateId').on('change', function () {
    $.ajax({
      url: companyCityUrl,
      type: 'get',
      dataType: 'json',
      data: {
        state: $(this).val(),
        country: $('#countryId').val()
      },
      success: function success(data) {
        $('#cityId').empty();
        $.each(data.data, function (i, v) {
          $('#cityId').append($('<option ></option>').attr('value', i).text(v));
        });

        if (isEdit && cityId) {
          $('#cityId').val(cityId).trigger('change');
        }
      }
    });
  });

  if (isEdit & countryId) {
    $('#countryId').val(countryId).trigger('change');
  }

  $(document).on('change', '#profile', function () {
    var validFile = isValidFile($(this), '#validationErrors');

    if (validFile) {
      displayPhoto(this, '#profilePreview');
      $('.btnSave').prop('disabled', false);
    } else {
      $('.btnSave').prop('disabled', true);
    }
  });

});
$(document).on('click', '#attach-salary-slip', function (event){
   event.preventDefault();
});
$(document).on('click', '#delete-slip', function (event){
    event.preventDefault();
    swal({
            title: 'Delete !',
            text: 'Are you sure want to delete this file ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        },
        function () {
            //setTimeout(()=>{ swal.close(); }, 3000);
            $.ajax({
                url: slipDeleteUrl,
                type: 'post',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function success(result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        swal.close();
                        populateSalarySlip(false);
                    }
                },
                error: function error(result) {
                    displayErrorMessage(result.responseJSON.message);
                },
                /*complete: function complete() {
                    processingBtn('#addNewForm', '#btnSave');
                }*/
            });

        });
});
$(document).on('keyup', '#facebookUrl', function () {
  this.value = this.value.toLowerCase();
});
$(document).on('keyup', '#twitterUrl', function () {
  this.value = this.value.toLowerCase();
});
$(document).on('keyup', '#linkedInUrl', function () {
  this.value = this.value.toLowerCase();
});
$(document).on('keyup', '#googlePlusUrl', function () {
  this.value = this.value.toLowerCase();
});
$(document).on('keyup', '#pinterestUrl', function () {
  this.value = this.value.toLowerCase();
});
$(document).on('submit', '#candidateProfileUpdate', function (e) {
  e.preventDefault();

  if ($('#error-msg').text() !== '') {
    $('#phoneNumber').focus();
    return false;
  }

  $('#candidateProfileUpdate').find('input:text:visible:first').focus();
  var facebookUrl = $('#facebookUrl').val();
  var twitterUrl = $('#twitterUrl').val();
  var linkedInUrl = $('#linkedInUrl').val();
  var googlePlusUrl = $('#googlePlusUrl').val();
  var pinterestUrl = $('#pinterestUrl').val();
  var facebookExp = new RegExp(/^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
  var twitterExp = new RegExp(/^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
  var googlePlusExp = new RegExp(/^(https?:\/\/)?((w{3}\.)?)?(plus\.)?(google\.[a-z]{2,3})\/?(([a-zA-Z 0-9._])?).*/i);
  var linkedInExp = new RegExp(/^(https?:\/\/)?((w{3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);
  var pinterestExp = new RegExp(/^(https?:\/\/)?((w{3}\.)?)pinterest\.[a-z]{2,3}\/?.*/i);
  urlValidation(facebookUrl, facebookExp);
  urlValidation(twitterUrl, twitterExp);
  urlValidation(linkedInUrl, linkedInExp);
  urlValidation(googlePlusUrl, googlePlusExp);
  urlValidation(pinterestUrl, pinterestExp);

  if (!urlValidation(facebookUrl, facebookExp)) {
    displayErrorMessage('Please enter a valid Facebook Url');
    return false;
  }

  if (!urlValidation(twitterUrl, twitterExp)) {
    displayErrorMessage('Please enter a valid Twitter Url');
    return false;
  }

  if (!urlValidation(googlePlusUrl, googlePlusExp)) {
    displayErrorMessage('Please enter a valid Google Plus Url');
    return false;
  }

  if (!urlValidation(linkedInUrl, linkedInExp)) {
    displayErrorMessage('Please enter a valid Linkedin Url');
    return false;
  }

  if (!urlValidation(pinterestUrl, pinterestExp)) {
    displayErrorMessage('Please enter a valid Pinterest Url');
    return false;
  }

  $('#candidateProfileUpdate')[0].submit();
  return true;
});

window.getSalarySlip = function(ajax){
    $.ajax({
        url: ajax?salarySlipUrl+"?ajax=true&cd="+candidateId:salarySlipUrl+"?cd="+candidateId,
        type: 'get',
        success: function success(result) {
            console.log(result);
            populateSalarySlip(result);
            if(result){
                salarySlipName = result.id+"/"+result.file_name;
            }
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
};

$(document).on('submit', '#addSlipForm', function (e) {
            e.preventDefault();
            processingBtn('#addSlipForm', '#btnSave', 'loading');
            let title = document.getElementById('slip-title');
            let file = document.getElementById('slipFile');
           /* var form = $('#addSlipForm')[0];
            let data = new FormData(form);
            console.log(data);
            /!*data.append('title', title.value);
            data.append('file', file.value);*!/
            //console.log(file.value);*/
            //return;
            $.ajax({
                url: resumeUploadUrl,
                type: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function success(result) {
                    //console.log(result);
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        $('#uploadSlipModal').modal('hide');
                        processingBtn('#addSlipForm', '#btnSave');
                        getSalarySlip(true);
                        //location.reload();
                    }
                },
                error: function error(result) {
                    displayErrorMessage(result.responseJSON.message);
                },
                complete: function complete() {
                    processingBtn('#addNewForm', '#btnSave');
                }
            });
        });

window.salarySlipLink = function(file){
    return slipsAsset.replace('**file**', file);
};

window.populateSalarySlip = function (media) {
    let salarySlipDiv = document.getElementById('salary_slip');
    if(media){
        var content = '<a href="#view-salary-slip" id="'+salarySlipLink(media.id+'/'+media.file_name)+'" onclick="this.event.preventDefault()" data-toggle="modal" data-target="#document" class="document">View Salary Slip</a>\n' +
            '<a href="#delete-salary-slip" class="ml-2 text-danger" id="delete-slip"><i class="fas fa-arrow-left"></i> Delete</a>';
    }else{
        var content = '<a href="#attach-slip" id="attach-salary-slip" data-toggle="modal" data-target="#uploadSlipModal">Attach Salary Slip</a>';
    }
    salarySlipDiv.innerHTML = content;
}

/***/ }),

/***/ 38:
/*!*************************************************************************************!*\
  !*** multi ./resources/assets/js/candidates/candidate-profile/candidate-general.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidates/candidate-profile/candidate-general.js */"./resources/assets/js/candidates/candidate-profile/candidate-general.js");


/***/ })

/******/ });
