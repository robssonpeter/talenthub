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
/******/ 	return __webpack_require__(__webpack_require__.s = 30);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidates/candidate-profile/candidate-education-experience.js":
/*!********************************************************************************************!*\
  !*** ./resources/assets/js/candidates/candidate-profile/candidate-education-experience.js ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  $('#countryId,#educationCountryId, #editCountry,#editEducationCountry').select2({
    'width': '100%'
  });
  $('#editState, #editEducationState').select2({
    'width': '100%'
  });
  $('#editCity,#editEducationCity').select2({
    'width': '100%'
  });
  $('#degreeLevelId').select2({
    'width': '100%'
  });
  $('.addExperienceBtn').on('click', function () {
    showAddExperienceDiv();
  });
  $('.addEducationBtn').on('click', function () {
    showAddEducationDiv();
  });
  $('.addAchievementBtn').on('click', function () {
    showAddAchievementDiv();
  });
  $('.addObjectiveBtn').on('click', function () {
    showAddEducationDiv();
  });
  $('#btnEducationCancel').on('click', function () {
    $('#degreeLevelId').val('');
    $('#degreeLevelId').select2({
      'width': '100%',
      'placeholder': 'Select Degree Level'
    });
    hideAddEducationDiv();
  });
  $('#btnEditEducationCancel').on('click', function () {
    hideEditEducationDiv();
  });
  $('#btnCancel').on('click', function () {
    hideAddExperienceDiv();
  });
  $('#btnEditCancel').on('click', function () {
    hideEditExperienceDiv();
  });

    $('#btnAchievementCancel').on('click', function () {
        $('#addAchievementTitle, #addAchievementDescription').val('');

        hideAddAchievementDiv();
    });
    $('#btnEditAchievementCancel').on('click', function () {
        hideEditAchievementDiv();
    });

  window.setDatePicker = function (startDate, endDate) {
    $(startDate).datetimepicker(DatetimepickerDefaults({
      format: 'YYYY-MM-DD',
      useCurrent: true,
      sideBySide: true,
      maxDate: new moment()
    }));
    $(endDate).datetimepicker(DatetimepickerDefaults({
      format: 'YYYY-MM-DD',
      sideBySide: true,
      maxDate: new moment(),
      useCurrent: false
    }));
  };

  $('#startDate').on('dp.change', function (e) {
    $('#endDate').val('');
    $('#endDate').data('DateTimePicker').minDate(e.date);
  });
  $('#editStartDate').on('dp.change', function (e) {
    setTimeout(function () {
      $('#editEndDate').data('DateTimePicker').minDate(e.date);
    }, 1000);
  });
  $('#newCurrentlyStudying').on('click', function () {
      if ($(this).prop('checked') == true) {
          $('#year').prop('disabled', true);
          $('#result').prop('disabled', true);
          $('#year').val('');
          $('#newEducationEndYearRequired').text('');
          $('#newEducationResultRequired').text('');
          $('#year').prop('required', false);
          $('#result').prop('required', false);

      } else if ($(this).prop('checked') == false) {
          //$('#endDate').data('DateTimePicker').minDate($('#startDate').val());
          $('#year').prop('disabled', false);
          $('#result').prop('disabled', false);
          $('#year').prop('required', true);
          $('#result').prop('required', true);
          $('#newEducationEndYearRequired').text('*');
          $('#newEducationResultRequired').text('*');
      }
  });
  $('#default').on('click', function () {
    if ($(this).prop('checked') == true) {
      $('#endDate').prop('disabled', true);
      $('#endDate').val('');
    } else if ($(this).prop('checked') == false) {
      $('#endDate').data('DateTimePicker').minDate($('#startDate').val());
      $('#endDate').prop('disabled', false);
    }
  });
  $('#editWorking').on('click', function () {
    if ($(this).prop('checked') == true) {
      $('#editEndDate').prop('disabled', true);
      $('#editEndDate').val('');
    } else if ($(this).prop('checked') == false) {
      $('#editEndDate').data('DateTimePicker').minDate($('#editStartDate').val());
      $('#editEndDate').prop('disabled', false);
    }
  });
  $(document).on('submit', '#addNewExperienceForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewExperienceForm', '#btnExperienceSave', 'loading');
    $.ajax({
      url: addExperienceUrl,
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          $('#notfoundExperience').addClass('d-none');
          displaySuccessMessage(result.message);
          hideAddExperienceDiv();
          qNewExperience.root.innerHTML = '';
          $('#endDate').attr('disabled', false);
          renderExperienceTemplate(result.data);
          randerCVTemplate();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#addNewExperienceForm', '#btnExperienceSave');
      }
    });
  });
  $(document).on('click', '.edit-experience', function (event) {
    var experienceId = $(event.currentTarget).data('id');
    renderExperienceData(experienceId);
  });
  $(document).on('click', '.edit-achievement', function (event) {
    var achievementId = $(event.currentTarget).data('id');
    renderAchievementsData(achievementId);
  });
  $(document).on('submit', '#editExperienceForm', function (event) {
    event.preventDefault();
    processingBtn('#editExperienceForm', '#btnEditExperienceSave', 'loading');
    var id = $('#experienceId').val();
    $.ajax({
      url: experienceUrl + id,
      type: 'put',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          hideEditExperienceDiv();
          $('.candidate-experience-container').children('.candidate-experience').each(function () {
            var candidateExperienceId = $(this).attr('data-id');

            if (candidateExperienceId === result.data.id) {
              $(this).remove();
            }
          });
            processingBtn('#editExperienceForm', '#btnEditExperienceSave');
            renderExperienceTemplate(result.data.candidateExperience);
            randerCVTemplate();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
          //alert(done);
        processingBtn('#editExperienceForm', '#btnEditExperienceSave');
      }
    });
  });

    $(document).on('submit', '#addNewAchievementForm', function (e) {
        e.preventDefault();
        processingBtn('#addNewAchievementForm', '#btnAchievementSave', 'loading');
        $.ajax({
            url: addAchievementUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    $('#notfoundAchievement').addClass('d-none');
                    displaySuccessMessage(result.message);
                    hideAddAchievementDiv();
                    renderAchievementsTemplate(result.data);
                    randerCVTemplate();
                    updateProfileCompletion(userId);
                }
            },
            error: function error(result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function complete() {
                processingBtn('#addNewAchievementForm', '#btnAchievementSave');
            }
        });
    });

  $(document).on('submit', '#editAchievementForm', function (event) {
    event.preventDefault();
    processingBtn('#editAchievementForm', '#btnEditAchievementSave', 'loading');
    var id = $('#achievementId').val();

    $.ajax({
      url: achievementUrl + id,
      type: 'put',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          hideEditAchievementDiv();
          $('.candidate-achievement-container').children('.candidate-achievement').each(function () {
            var candidateAchievementId = $(this).attr('data-id');

            if (candidateAchievementId == result.data.id) {
              $(this).remove();
            }
          });
          renderAchievementsTemplate(result.data.candidateAchievements);
          randerCVTemplate();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editAchievementForm', '#btnEditAchievementSave');
      }
    });
  });
  $(document).on('click', '.delete-experience', function (event) {
    var experienceId = $(event.currentTarget).data('id');
    deleteItem(experienceUrl + experienceId, 'Experience', '.candidate-experience-container', '.candidate-experience', '#notfoundExperience');
  });
  $(document).on('click', '.delete-achievement', function (event) {
    var achievementId = $(event.currentTarget).data('id');
    deleteItem(achievementUrl + achievementId, 'Achievement', '.candidate-achievement-container', '.candidate-achievement', '#notfoundAchievement');
  });
  $(document).on('submit', '#addNewEducationForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewEducationForm', '#btnEducationSave', 'loading');
    $.ajax({
      url: addEducationUrl,
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          renderEducationTemplate(result.data);
          $('#candidateEducationsDiv').show();
          $('#createEducationsDiv').addClass('d-none');
          randerCVTemplate();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#addNewEducationForm', '#btnEducationSave');
      }
    });
  });
  $(document).on('click', '.edit-education', function (event) {
    var educationId = $(event.currentTarget).data('id');
    renderEducationData(educationId);
  });
  $(document).on('submit', '#editEducationForm', function (event) {
    event.preventDefault();
    processingBtn('#editEducationForm', '#btnEditEducationSave', 'loading');
    var id = $('#educationId').val();
    $.ajax({
      url: educationUrl + id,
      type: 'put',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          hideEditEducationDiv();
          $('.candidate-education-container').children('.candidate-education').each(function () {
            var candidateEducationId = $(this).attr('data-id');

            if (candidateEducationId == result.data.id) {
              $(this).remove();
            }
          });
          renderEducationTemplate(result.data.candidateEducation);
          randerCVTemplate();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editEducationForm', '#btnEditEducationSave');
      }
    });
  });
  $(document).on('click', '.delete-education', function (event) {
    var educationId = $(event.currentTarget).data('id');
    deleteItem(educationUrl + educationId, 'Education', '.candidate-education-container', '.candidate-education', '#notfoundEducation');
  });

    $(document).on('click', '#editCurrentlyStudying', function () {
        //alert('hellw there')
        if ($(this).prop('checked') == true) {
            $('#editYear').prop('disabled', true);
            $('#editResult').prop('disabled', true);
            $('#editYear').val('');
            $('#editResult').val('');
            $('#editEducationEndYearRequired').text('');
            $('#editEducationResultRequired').text('');
            $('#editYear').prop('required', false);
            $('#editResult').prop('required', false);

        } else if ($(this).prop('checked') == false) {
            //$('#endDate').data('DateTimePicker').minDate($('#startDate').val());
            $('#editYear').prop('disabled', false);
            $('#editResult').prop('disabled', false);
            $('#editYear').prop('required', true);
            $('#editResult').prop('required', true);
            $('#editEducationEndYearRequired').text('*');
            $('#editEducationResultRequired').text('*');
        }
    });

  window.deleteItem = function (url, header, parent, child, selector) {
    swal({
      title: 'Delete !',
      text: 'Are you sure want to delete this "' + header + '" ?',
      type: 'warning',
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
      confirmButtonColor: '#6777ef',
      cancelButtonColor: '#d33',
      cancelButtonText: 'No',
      confirmButtonText: 'Yes'
    }, function () {
      deleteItemAjax(url, header, parent, child, selector);
    });
  };

  function deleteItemAjax(url, header, parent, child, selector) {
    $.ajax({
      url: url,
      type: 'DELETE',
      dataType: 'json',
      success: function success(obj) {
        if (obj.success) {
          $(parent).children(child).each(function () {
            var templateId = $(this).attr('data-id');

            if (templateId == obj.data) {
              $(this).remove();
            }
          });

          if ($(parent).children(child).length <= 0) {
            $(selector).removeClass('d-none');
          }

          randerCVTemplate();
        }
        updateProfileCompletion(userId);
        swal({
          title: 'Deleted!',
          text: header + ' has been deleted.',
          type: 'success',
          confirmButtonColor: '#6777ef',
          timer: 2000
        });
      },
      error: function error(data) {
        swal({
          title: '',
          text: data.responseJSON.message,
          type: 'error',
          confirmButtonColor: '#6777ef',
          timer: 5000
        });
      }
    });
  }

  $('#countryId, #educationCountryId, #editCountry, #editEducationCountry').on('change', function (e, paramData) {
    var modalType = $(this).data('modal-type');
    var modalTypeHasEdit = typeof $(this).data('is-edit') === 'undefined' ? false : true;
    $.ajax({
      url: companyStateUrl,
      type: 'get',
      dataType: 'json',
      data: {
        postal: $(this).val()
      },
      success: function success(data) {
        $(modalType === 'experience' ? !modalTypeHasEdit ? '#stateId' : '#editState' : !modalTypeHasEdit ? '#educationStateId' : '#editEducationState').empty();
        $(modalType === 'experience' ? !modalTypeHasEdit ? '#stateId' : '#editState' : !modalTypeHasEdit ? '#educationStateId' : '#editEducationState').append('<option value="" selected>Select Region</option>');
        $.each(data.data, function (i, v) {
          $(modalType === 'experience' ? !modalTypeHasEdit ? '#stateId' : '#editState' : !modalTypeHasEdit ? '#educationStateId' : '#editEducationState').append($('<option></option>').attr('value', i).text(v));
        });
        if (modalTypeHasEdit) $(modalType === 'experience' ? '#editState' : '#editEducationState').val(paramData.stateId).trigger('change', [{
          cityId: paramData.cityId
        }]);
      }
    });
  });
  $('#stateId, #educationStateId, #editState, #editEducationState').on('change', function (e, paramData) {
    var modalType = $(this).data('modal-type');
    var modalTypeHasEdit = typeof $(this).data('is-edit') === 'undefined' ? false : true;
    $.ajax({
      url: companyCityUrl,
      type: 'get',
      dataType: 'json',
      data: {
        state: $(this).val(),
        country: $(modalType === 'experience' ? !modalTypeHasEdit ? '#countryId' : '#editCountry' : !modalTypeHasEdit ? '#educationCountryId' : '#editEducationCountry').val()
      },
      success: function success(data) {
        $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationCityId' : '#editEducationCity').empty();
        $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationCityId' : '#editEducationCity').append('<option value="" selected>Select City</option>');
        $.each(data.data, function (i, v) {
          $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationCityId' : '#editEducationCity').append($('<option></option>').attr('value', i).text(v));
        });
        if (modalTypeHasEdit) $(modalType === 'experience' ? '#editCity' : '#editEducationCity').val(typeof paramData !== 'undefined' ? paramData.cityId : '').trigger('change.select2');
      }
    });
  });
});

/*$('#functionalAreasBuilder').select2({
    'width': '100%',
});*/

window.showAddEducationDiv = function () {
  hideAddExperienceDiv();
  hideEditExperienceDiv();
  hideAddAchievementDiv();
  hideEditAchievementDiv();
  hideAddOnlineProfileDiv();
  hideAddGeneralDiv();
  $('#candidateEducationsDiv').hide();
  $('#createEducationsDiv').removeClass('d-none');
  resetModalForm('#addNewEducationForm', '#validationErrorsBox');
  $('#educationCountryId, #educationStateId, #educationCityId').val('');
  $('#educationStateId, #educationCityId').empty();
  $('#educationStateId').select2({
    'width': '100%',
    'placeholder': 'Select Region'
  });
  $('#educationCityId').select2({
    'width': '100%',
    'placeholder': 'Select City'
  });
  $('#editFunctionalAreas').select2({
    'width': '100%',
  });
  $('#educationCountryId').trigger('change.select2');
};


window.showAddObjectiveDiv = function () {
  hideAddExperienceDiv();
  hideEditExperienceDiv();
  hideAddOnlineProfileDiv();
  hideAddGeneralDiv();
  $('#candidateEducationsDiv').hide();
  $('#createObjectiveDiv').removeClass('d-none');
};

window.showEditEducationDiv = function () {
  hideAddExperienceDiv();
  hideEditExperienceDiv();
  hideAddAchievementDiv();
  hideEditAchievementDiv();
  hideAddOnlineProfileDiv();
  hideAddGeneralDiv();
  $('#candidateEducationsDiv').hide();
  $('#editEducationsDiv').removeClass('d-none');
  resetModalForm('#editEducationForm', '#editValidationErrorsBox');
  $('#editEducationCountry, #editEducationState, #editEducationCity').val('');
  $('#editEducationState, #editEducationCity').empty();
  $('#editEducationCountry').trigger('change.select2');
};

window.hideAddEducationDiv = function () {
  $('#candidateEducationsDiv').show();
  $('#createEducationsDiv').addClass('d-none');
};

window.hideEditEducationDiv = function () {
  $('#candidateEducationsDiv').show();
  $('#editEducationsDiv').addClass('d-none');
};

window.showAddExperienceDiv = function () {
  hideAddEducationDiv();
  hideEditEducationDiv();
  hideAddAchievementDiv();
  hideEditAchievementDiv();
  hideAddOnlineProfileDiv();
  hideAddGeneralDiv();
  $('#candidateExperienceDiv').hide();
  $('#createExperienceDiv').removeClass('d-none');
  setDatePicker('#startDate', '#endDate');
  resetModalForm('#addNewExperienceForm', '#validationErrorsBox');
  $('#countryId, #stateId, #cityId').val('');
  $('#stateId, #cityId').empty();
  $('#stateId').select2({
    'width': '100%',
    'placeholder': 'Select Region'
  });
  $('#cityId').select2({
    'width': '100%',
    'placeholder': 'Select City'
  });
  $('#countryId').trigger('change.select2');
  $('#functionalAreasBuilder').select2({

  });
};

window.showEditExperienceDiv = function () {
  hideAddEducationDiv();
  hideEditEducationDiv();
  hideAddAchievementDiv();
  hideEditAchievementDiv();
  hideAddOnlineProfileDiv();
  hideAddGeneralDiv();
  $('#candidateExperienceDiv').hide();
  $('#editExperienceDiv').removeClass('d-none');
  resetModalForm('#editExperienceForm', '#editValidationErrorsBox');
  setDatePicker('#editStartDate', '#editEndDate');
  $('#editExperienceCountry, #editExperienceState, #editExperienceCity').val('');
  $('#editExperienceState, #editExperienceCity').empty();
  $('#editExperienceCountry').trigger('change.select2');
};

window.hideAddExperienceDiv = function () {
  $('#candidateExperienceDiv').show();
  $('#createExperienceDiv').addClass('d-none');
};

window.hideEditExperienceDiv = function () {
  $('#candidateExperienceDiv').show();
  $('#editExperienceDiv').addClass('d-none');
};

// Career Achievements
window.showAddAchievementDiv = function () {
  hideAddEducationDiv();
  hideEditEducationDiv();
  hideAddExperienceDiv();
  hideEditExperienceDiv();
  hideAddOnlineProfileDiv();
  hideAddGeneralDiv();
  $('#candidateAchievementDiv').hide();
  $('#createAchievementDiv').removeClass('d-none');
  //setDatePicker('#startDate', '#endDate');
  resetModalForm('#addNewAchievementForm', '#validationErrorsBox');
  $('#addAchievementTitle, #addAchievementDescription').val('');
};

window.showEditAchievementDiv = function () {
  hideAddEducationDiv();
  hideEditEducationDiv();
    hideEditExperienceDiv();
    hideAddExperienceDiv();
    hideAddOnlineProfileDiv();
    hideAddGeneralDiv();
  $('#candidateAchievementDiv').hide();
  $('#editAchievementDiv').removeClass('d-none');
  resetModalForm('#editAchievementForm', '#editValidationErrorsBox');
  $('#editAchievementTitle, #editAchievementDescription').val('');
};

window.hideAddAchievementDiv = function () {
  $('#candidateAchievementDiv').show();
  $('#createAchievementDiv').addClass('d-none');
};

window.hideEditAchievementDiv = function () {
  $('#candidateAchievementDiv').show();
  $('#editAchievementDiv').addClass('d-none');
};

window.renderEducationData = function (id) {
  showEditEducationDiv();
  startLoader();
  $('#btnEditEducationSave').attr('disabled', true);
  $.ajax({
    url: candidateUrl + id + '/edit-education',
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        stopLoader();
        $('#educationId').val(result.data.id);
        $('#editDegreeLevel').val(result.data.degree_level.id).trigger('change');
        $('#editDegreeTitle').val(result.data.degree_title);
        $('#editStartYear').val(result.data.start_year);
        $('#editEducationCountry').val(result.data.country_id).trigger('change', [{
          stateId: result.data.state_id,
          cityId: result.data.city_id
        }]);
          if(result.data.currently_studying){
              $('#editCurrentlyStudying').prop('checked', true);
              $('#editYear').prop('disabled', true);
              $('#editResult').prop('disabled', true);
              $('#editYear').val('');
              $('#editResult').val('');
              $('#editEducationEndYearRequired').text('');
              $('#editEducationResultRequired').text('');
              $('#editYear').prop('required', false);
              $('#editResult').prop('required', false);
          }else{
              $('#editCurrentlyStudying').prop('checked', false);
              $('#editYear').prop('disabled', false);
              $('#editResult').prop('disabled', false);
              $('#editYear').prop('required', true);
              $('#editResult').prop('required', true);
              $('#editEducationEndYearRequired').text('*');
              $('#editEducationResultRequired').text('*');
          }
        $('#editInstitute').val(result.data.institute);
        $('#editResult').val(result.data.result);
        $('#editYear').val(result.data.year).trigger('change');
        $('#btnEditEducationSave').attr('disabled', false);
      }
    },
    error: function error(result) {
      stopLoader();
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

window.renderEducationTemplate = function (educationArray) {
  var candidateEducationCount = $('.candidate-education-container .candidate-education:last').data('education-id') != undefined ? $('.candidate-education-container .candidate-education:last').data('experience-id') + 1 : 0;
  var template = $.templates('#CVcandidateEducationTemplate');
  var data = {
    candidateEducationNumber: candidateEducationCount,
    id: educationArray.id,
    degreeLevel: educationArray.degree_level.name,
    degreeTitle: educationArray.degree_title,
    year: educationArray.year,
    country: educationArray.country,
    institute: educationArray.institute
  };
  var stageTemplateHtml = template.render(data);
  $('.candidate-education-container').append(stageTemplateHtml);
  $('#notfoundEducation').addClass('d-none');
};

window.renderExperienceData = function (id) {
  showEditExperienceDiv();
  startLoader();
    //var converter = new showdown.Converter();
  $('#btnEditCancel').attr('disabled', true);
  $.ajax({
    url: candidateUrl + id + '/edit-experience',
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        stopLoader();
        $('#experienceId').val(result.data.id);
        $('#editTitle').val(result.data.experience_title);
        $('#editCompany').val(result.data.company);
        $('#editExperienceCareerLevel').val(result.data.career_level_id);
        $('#editExperienceIndustry').val(result.data.industry_id);
        $('#editExperienceCategory').val(result.data.job_category_id);
        $('#editExperienceFunctionalAreasBuilder').val(JSON.parse(result.data.functional_areas)).select2({

        }).trigger('change');
        $('#editCountry').val(result.data.country_id).trigger('change', [{
          stateId: result.data.state_id,
          cityId: result.data.city_id
        }]);

        $('#editStartDate').val(moment(result.data.start_date).format('YYYY-MM-DD'));
        $('#editDescription').val(result.data.description);
          let descriptionHtml = result.data.description;
          qEditExperience.root.innerHTML = descriptionHtml;

        if (result.data.currently_working) {
          $('#editWorking').prop('checked', true);
          $('#editEndDate').val('').attr('disabled', true);
        } else {
          $('#editWorking').prop('checked', false);
          $('#editEndDate').val(moment(result.data.end_date).format('YYYY-MM-DD')).attr('disabled', false);
        }

        if (result.data.currently_working == 1) {
          $('#editEndDate').prop('disabled', true);
        }

        $('#btnEditCancel').attr('disabled', false);
      }
    },
    error: function error(result) {
      stopLoader();
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

window.renderExperienceTemplate = function (experienceArray) {
    //var converter = new showdown.Converter();
    let candidateExperienceCount =
        $('.candidate-experience-container .candidate-experience:last').
        data('experience-id') != undefined ?
            $('.candidate-experience-container .candidate-experience:last').
            data('experience-id') + 1 : 0;
    let template = $.templates('#CVcandidateExperienceTemplate');
    let endDate = experienceArray.currently_working === 1
        ? present
        : moment(experienceArray.end_date, 'YYYY-MM-DD').
        format('Do MMM, YYYY');
    let data = {
        candidateExperienceNumber: candidateExperienceCount,
        id: experienceArray.id,
        title: experienceArray.experience_title,
        company: experienceArray.company,
        startDate: moment(experienceArray.start_date, 'YYYY-MM-DD').
        format('Do MMM, YYYY'),
        endDate: endDate,
        description: experienceArray.description,
        country: experienceArray.country,
    };
    let stageTemplateHtml = template.render(data);
    $('.candidate-experience-container').append(stageTemplateHtml);
    $('#notfoundExperience').addClass('d-none');
};

window.renderAchievementsData = function (id) {
  showEditAchievementDiv();
  startLoader();
  $('#btnEditAchievementCancel').attr('disabled', true);
  $.ajax({
    url: achievementUrl + id + '/edit-achievement',
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        stopLoader();
        $('#achievementId').val(result.data.id);
        $('#editAchievementTitle').val(result.data.title);
        $('#editAchievementDescription').val(result.data.description);
        $('#editAchievementAttachment').val(result.data.attachment_id);

        $('#btnEditAchievementCancel').attr('disabled', false);
      }
    },
    error: function error(result) {
      stopLoader();
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

window.renderAchievementsTemplate = function (achievementArray) {
  var candidateAchievementCount = $('.candidate-achievement-container .candidate-achievement:last').data('achievement-id') != undefined ? $('.candidate-achievement-container .candidate-achievement:last').data('achievement-id') + 1 : 0;
  var template = $.templates('#CVcandidateAchievementTemplate');
  var data = {
    candidateAchievementNumber: candidateAchievementCount,
    id: achievementArray.id,
    title: achievementArray.title,
    description: achievementArray.description,
  };
  var stageTemplateHtml = template.render(data);
  $('.candidate-achievement-container').append(stageTemplateHtml);
  $('#notfoundAchievement').addClass('d-none');
};

/***/ }),

/***/ 30:
/*!**************************************************************************************************!*\
  !*** multi ./resources/assets/js/candidates/candidate-profile/candidate-education-experience.js ***!
  \**************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidates/candidate-profile/candidate-education-experience.js */"./resources/assets/js/candidates/candidate-profile/candidate-education-experience.js");


/***/ })

/******/ });
