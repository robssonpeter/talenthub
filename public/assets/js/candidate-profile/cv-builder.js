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
/******/ 	return __webpack_require__(__webpack_require__.s = 31);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidates/candidate-profile/cv-builder.js":
/*!************************************************************************!*\
  !*** ./resources/assets/js/candidates/candidate-profile/cv-builder.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  renderCandidateData();
  randerCVTemplate();
  $('#skillId,#candidateCountryId,#candidateStateId,#candidateCityId').select2({
    width: '100%'
  });
  $('#candidateCountryId').on('change', function () {
    $.ajax({
      url: companyStateUrl,
      type: 'get',
      dataType: 'json',
      data: {
        postal: $(this).val()
      },
      success: function success(data) {
        $('#candidateStateId').empty();
        $('#candidateStateId').append($('<option value="" selected>Select State</option>'));
        $.each(data.data, function (i, v) {
          $('#candidateStateId').append($('<option></option>').attr('value', i).text(v));
        });

        if (isEditProfile && stateId != '') {
          $('#candidateStateId').val(stateId).trigger('change');
        }

        if ($('#candidateStateId').val() == null) {
          $('#candidateStateId').find('option[value=""]').remove();
          $('#candidateStateId').prepend($('<option value="" selected>Select State</option>'));
        }

        if ($('#candidateCityId').val() == null) {
          $('#candidateCityId').prepend($('<option value="" selected>Select City</option>'));
        }
      }
    });
  });
  $('#candidateStateId').on('change', function () {
    $.ajax({
      url: companyCityUrl,
      type: 'get',
      dataType: 'json',
      data: {
        state: $(this).val(),
        country: $('#candidateCountryId').val()
      },
      success: function success(data) {
        $('#candidateCityId').empty();
        $.each(data.data, function (i, v) {
          $('#candidateCityId').append($('<option ></option>').attr('value', i).text(v));
        });

        if (isEditProfile && cityId != '') {
          $('#candidateCityId').val(cityId).trigger('change');
        }

        if ($('#candidateCityId').val() == null) {
          $('#candidateCityId').prepend($('<option value="" selected>Select City</option>'));
        }
      }
    });
  });

  if (isEditProfile & countryId) {
    $('#candidateCountryId').val(countryId).trigger('change');
  }

  $(document).on('submit', '#editGeneralForm', function (e) {
    e.preventDefault();
    processingBtn('#editGeneralForm', '#btnEditGeneralSave', 'loading');
    $.ajax({
      url: updateCandidateUrl,
      type: 'post',
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          hideAddGeneralDiv();
          randerCVTemplate();
          $('#candidateName').text(result.data.full_name);
          $('#candidateLocation').text(result.data.candidate.full_location);
          $('#candidatePhone').text(result.data.phone);
          $('#candidateProfessionalTitle').text(result.data.candidate.professional_title);
          let title = $('#professional_title').val();
          let objective = $('#candidate_objective').val();
          if(objective){
              let objectiveContent = '<div class="mt-3 border-bottom mb-3 d-flex justify-content-between">\n' +
                  '        <h5 class="mt-2">Career Objective</h5>\n' +
                  '    </div>\n' +
                  '    <div id="candidateObjectiveDiv">\n' +
                  '        <p>'+objective+'</p>\n' +
                  '    </div>';
              $('#candidateObjectiveDiv').html(objectiveContent);
          }
          updateProfileCompletion(userId);
          var skills = result.data.candidateSkill;
          var skillHtml = '<ul class="pl-3">';
          skills.forEach(function (item) {
            skillHtml = skillHtml + '<li class="font-weight-bold">' + item + '</li>';
          });
          skillHtml = skillHtml + '</ul>';
          $('#candidateSkillDiv').html(skillHtml);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editGeneralForm', '#btnEditGeneralSave');
      }
    });
  });
  $(document).on('keyup', '#facebookId', function () {
    this.value = this.value.toLowerCase();
  });
  $(document).on('keyup', '#twitterId', function () {
    this.value = this.value.toLowerCase();
  });
  $(document).on('keyup', '#linkedinId', function () {
    this.value = this.value.toLowerCase();
  });
  $(document).on('keyup', '#googlePlusId', function () {
    this.value = this.value.toLowerCase();
  });
  $(document).on('keyup', '#pinterestId', function () {
    this.value = this.value.toLowerCase();
  });
  $(document).on('submit', '#editOnlineProfileForm', function (e) {
    e.preventDefault();
    processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave', 'loading');
    var facebookUrl = $('#facebookId').val();
    var twitterUrl = $('#twitterId').val();
    var linkedInUrl = $('#linkedinId').val();
    var googlePlusUrl = $('#googlePlusId').val();
    var pinterestUrl = $('#pinterestId').val();
    var facebookExp = new RegExp(/^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    var twitterExp = new RegExp(/^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    var googlePlusExp = new RegExp(/^(https?:\/\/)?((w{3}\.)?)?(plus\.)?(google\.[a-z]{2,3})\/?(([a-zA-Z 0-9._])?).*/i);
    var linkedInExp = new RegExp(/^(https?:\/\/)?((w{3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);
    var pinterestExp = new RegExp(/^(https?:\/\/)?((w{3}\.)?)pinterest\.[a-z]{2,3}\/?.*/i);
    urlValidation(facebookUrl, facebookExp);
    urlValidation(twitterUrl, twitterExp);
    urlValidation(linkedInUrl, googlePlusExp);
    urlValidation(googlePlusUrl, linkedInExp);
    urlValidation(pinterestUrl, pinterestExp);

    if (!urlValidation(facebookUrl, facebookExp)) {
      displayErrorMessage('Please enter a valid Facebook Url');
      processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave');
      return false;
    }

    if (!urlValidation(twitterUrl, twitterExp)) {
      displayErrorMessage('Please enter a valid Twitter Url');
      processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave');
      return false;
    }

    if (!urlValidation(linkedInUrl, linkedInExp)) {
      displayErrorMessage('Please enter a valid Linkedin Url');
      processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave');
      return false;
    }

    if (!urlValidation(googlePlusUrl, googlePlusExp)) {
      displayErrorMessage('Please enter a valid Google Plus Url');
      processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave');
      return false;
    }

    if (!urlValidation(pinterestUrl, pinterestExp)) {
      displayErrorMessage('Please enter a valid Pinterest Url');
      processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave');
      return false;
    }

    $.ajax({
      url: updateonlineProfileUrl,
      type: 'post',
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          hideAddOnlineProfileDiv();
          $('#candidateOnlineProfileDiv').html(result.data.onlineProfileLayout);
          $('#addOnlineProfileDiv').html(result.data.editonlineProfileLayout);
          randerCVTemplate();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave');
      }
    });
  });
  $(document).on('click', '.editGeneralBtn', function () {
    showEditGeneralDiv();
  });
  $(document).on('click', '#btnGeneralCancel', function () {
    hideAddGeneralDiv();
  });
  $(document).on('click', '.addOnlineProfileBtn', function () {
    showAddOnlineProfileDiv();
  });
  $(document).on('click', '#btnOnlineProfileCancel', function () {
    hideAddOnlineProfileDiv();
  });
  $(document).on('click', '.cv-preview', function () {
    $('#cvModal').appendTo('body').modal('show');
  });
  $(document).on('click', '#downloadPDF', function () {
    makeCVPDF();
  });
  $(document).on('click', '.printCV', function () {
    var divToPrint = document.getElementById('cvTemplate');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write('<html>' + '<link href="' + bootstarpUrl + '" rel="stylesheet" type="text/css"/>' + '<link href="' + styleCssUrl + '" rel="stylesheet" type="text/css"/>' + '<link href="' + customCssUrl + '" rel="stylesheet" type="text/css"/>' + '<link href="' + fontCssUrl + '" rel="stylesheet" type="text/css"/>' + '<body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function () {
      newWin.close();
    }, 10);
  });
});

window.renderCandidateData = function () {
  $.ajax({
    url: candidateProfileUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#first_name').val(result.data.first_name);
        $('#last_name').val(result.data.last_name);
        $('#email').val(result.data.email);
        $('#phone').val(result.data.phone);
        $('#candidateCountryId').val(result.data.country_id).trigger('change');
        stateId = result.data.state_id;
        cityId = result.data.city_id;
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

window.randerCVTemplate = function () {
  $('#btnEditGeneralSave').attr('disabled', true);
  $.ajax({
    url: cvTemplateUrl,
    type: 'GET',
    success: function success(result) {
      if (result) {
        $('#cvTemplate').html(result);
        $('#btnEditGeneralSave').attr('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

window.showEditGeneralDiv = function () {
  hideAddExperienceDiv();
  hideEditExperienceDiv();
  hideAddEducationDiv();
  hideEditEducationDiv();
  hideAddOnlineProfileDiv();
  $('#candidateGeneralDiv').hide();
  $('#editGeneralDiv').removeClass('d-none');
  //resetModalForm('#editGeneralForm');
  renderCandidateData();
};

window.hideAddGeneralDiv = function () {
  $('#candidateGeneralDiv').show();
  $('#editGeneralDiv').addClass('d-none');
};

window.showAddOnlineProfileDiv = function () {
  hideAddExperienceDiv();
  hideEditExperienceDiv();
  hideAddEducationDiv();
  hideEditEducationDiv();
  hideAddGeneralDiv();
  $('#candidateOnlineProfileDiv').hide();
  $('#addOnlineProfileDiv').removeClass('d-none');
  resetModalForm('#editOnlineProfileForm');
};

window.hideAddOnlineProfileDiv = function () {
  $('#candidateOnlineProfileDiv').show();
  $('#addOnlineProfileDiv').addClass('d-none');
};

        /*window.updateProfileCompletion = function(id){
            $.ajax({
                url: candidateProgressUrl,
                type: 'GET',
                success: function success(result) {
                    let progress = '<span><strong>Profile Completion</strong></span>'+
                        '<div class="single-chart w-75">'+
                        '<svg viewBox="0 0 36 36" class="circular-chart blue">'+
                        '<path class="circle-bg"'+
                        'd="M18 2.0845'+
                        'a 15.9155 15.9155 0 0 1 0 31.831'+
                        'a 15.9155 15.9155 0 0 1 0 -31.831"'+
                        '/>'+
                        '<path id="completion" class="circle"'+
                        'stroke-dasharray="'+result+', 100"'+
                        'd="M18 2.0845'+
                        'a 15.9155 15.9155 0 0 1 0 31.831'+
                        'a 15.9155 15.9155 0 0 1 0 -31.831"'+
                        '/>'+
                        '<text x="18" y="20.35" class="percentage">'+result+'%</text>'+
                        '</svg>'+
                        '</div>';
                    $('#profile-completion').html(progress);
                }
            });
        }*/

function makeCVPDF() {
  var element = document.getElementById('cvTemplate');
  html2pdf(element);
  return;
}

/***/ }),

/***/ 31:
/*!******************************************************************************!*\
  !*** multi ./resources/assets/js/candidates/candidate-profile/cv-builder.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidates/candidate-profile/cv-builder.js */"./resources/assets/js/candidates/candidate-profile/cv-builder.js");


/***/ })

/******/ });
