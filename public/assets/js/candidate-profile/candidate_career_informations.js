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
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js ***!
  \*******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  $('#countryId, #educationCountryId, #editCountry, #editState, #editCity, #degreeLevelId, #editEducationCountry, #editEducationState, #editEducationCity').select2({
    'width': '100%'
  });
  $('#addExperienceModal').on('shown.bs.modal', function () {
    setDatePicker('#startDate', '#endDate');
  });
  $('#editExperienceModal').on('shown.bs.modal', function () {
    setDatePicker('#editStartDate', '#editEndDate');

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

  window.setExperienceSelect2 = function () {
    $('#stateId').select2({
      'width': '100%',
      'placeholder': 'Select Region'
    });
    $('#cityId').select2({
      'width': '100%',
      'placeholder': 'Select City'
    });
    $('#addModalFunctionalAreas').select2({
      'width': '100%'
    });
  };

  window.setEducationSelect2 = function () {
    $('#educationStateId').select2({
      'width': '100%',
      'placeholder': 'Select Region'
    });
    $('#educationCityId').select2({
      'width': '100%',
      'placeholder': 'Select City'
    });
    $('#educationSchoolId').select2({
      'width': '100%',
      'placeholder': 'Select School'
    });
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
        //alert('hellw there')
        if ($(this).prop('checked') === true) {
              $('#newEducationEndYear').prop('disabled', true);
              $('#newEducationResult').prop('disabled', true);
              $('#newEducationEndYear').val('');
              $('#newEducationEndYearRequired').text('');
              $('#newEducationResultRequired').text('');
              $('#newEducationEndYear').prop('required', false);
              $('#newEducationResult').prop('required', false);

        } else if ($(this).prop('checked') == false) {
            //$('#endDate').data('DateTimePicker').minDate($('#startDate').val());
            $('#newEducationEndYear').prop('disabled', false);
            $('#newEducationResult').prop('disabled', false);
            $('#newEducationEndYear').prop('required', true);
            $('#newEducationResult').prop('required', true);
            $('#newEducationEndYearRequired').text('*');
            $('#newEducationResultRequired').text('*');
        }
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
  $('.addExperienceModal').on('click', function () {
    setExperienceSelect2();
    $('#addExperienceModal').appendTo('body').modal('show');
  });
  $('.addEducationModal').on('click', function () {
    setEducationSelect2();
    $('#addEducationModal').appendTo('body').modal('show');
  });
  $('.addRefereeModal').on('click', function () {
    $('#addRefereeModal').appendTo('body').modal('show');
  });
  $('.addAchievementModal').on('click', function () {
    $('#addAchievementModal').appendTo('body').modal('show');
    $('#countryOfInstitution').select2({
        'width': '100%',
    });
    $('#certificateCategory').select2({
        'placeholder': 'Select Category',
        'width': '100%',
    });
    $('#idOfInstitution').select2({
        'placeholder': 'Select Institution',
        'width': '100%',
    });
  });

  $(document).on('change', '#countryOfInstitution', function(){
      $.ajax({
          url: schoolUrl,
          type: 'get',
          dataType: 'json',
          data: {
              country: $(this).val()
          },
          success: function success(data) {
            //console.log(data);
            $('#idOfInstitution').empty();
            $.each(data.data, function (i, v) {
                  $('#idOfInstitution').append($('<option></option>').attr('value', i).text(v));
              });
          }
      });
  });

  $(document).on('change', '#editCountryOfInstitution', function(){
      $.ajax({
          url: schoolUrl,
          type: 'get',
          dataType: 'json',
          data: {
              country: $(this).val()
          },
          success: function success(data) {
            //console.log(data);
              let institutionId = $('#editIdOfInstitution').val();
            $('#editIdOfInstitution').empty().append($('<option></option>').attr('value', '').text('Select Institution'));
            $.each(data.data, function (i, v) {
                  $('#editIdOfInstitution').append($('<option></option>').attr('value', i).text(v));
            });
              $('#editIdOfInstitution').val(institutionId).trigger('change');
          }
      });
  });
  $(document).on('change', '#is_ongoing', function(){
      //alert('hello her')
     if($(this).prop('checked', true)){
         //alert('the box is checked my friend')
         $('#addAchievementCompletionDate').prop('disabled', true).prop('required', false);
     }else{
         $('#addAchievementCompletionDate').prop('disabled', false).prop('required', true);
     }
  });
  /*$(document).on('click', '#edit_is_ongoing', function(){
     onGoingChecked = !onGoingChecked;
  });*/
  $(document).on('change', '#edit_is_ongoing', function(){

      onGoingChecked = $(this).prop('checked');
     if(onGoingChecked){
         $('#editAchievementCompletionDate').prop('disabled', true).prop('required', false);
     }else{
         $('#editAchievementCompletionDate').prop('disabled', false).prop('required', true);
     }
  });
  $('.addObjectiveModal').on('click', function () {
    $('#addObjectiveModal').appendTo('body').modal('show');
  });
  window.renderExperienceTemplate = function (experienceArray) {
      var converter = new showdown.Converter();
    var candidateExperienceCount = $('.candidate-experience-container .candidate-experience:last').data('experience-id') != undefined ? $('.candidate-experience-container .candidate-experience:last').data('experience-id') + 1 : 0;
    var template = $.templates('#candidateExperienceTemplate');
    var endDate = experienceArray.currently_working == 1 ? present : moment(experienceArray.end_date, 'YYYY-MM-DD').format('Do MMM, YYYY');
    var data = {
      candidateExperienceNumber: candidateExperienceCount,
      id: experienceArray.id,
      title: experienceArray.experience_title,
      company: experienceArray.company,
      startDate: moment(experienceArray.start_date, 'YYYY-MM-DD').format('Do MMM, YYYY'),
      endDate: endDate,
      description: converter.makeHtml(experienceArray.description),
      country: experienceArray.country
    };
    var stageTemplateHtml = template.render(data);
    $('.candidate-experience-container').append(stageTemplateHtml);
    $('#notfoundExperience').addClass('d-none');
  };

  /*$(document).on('click', '#btnExperienceSave', function(){
      $('#addExperienceAchievementOriginal').val(qNewExperience.root.innerHTML);
  });*/

 /* $(document).on('click', '#btnEditExperienceSave', function(){
      //alert(document.getElementById('editExperienceAchievementOriginal'))
      let markdown = turndownService.turndown(qEditExperience.root.innerHTML);
      $('#editDescription').val(markdown);
      alert(markdown)
  });*/

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
          $('#addExperienceModal').modal('hide');
          location.reload();
          renderExperienceTemplate(result.data);
          updateProfileCompletion();
          console.log(result.data);
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

  window.renderExperienceData = function (id) {

    $.ajax({
      url: candidateUrl + id + '/edit-experience',
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#experienceId').val(result.data.id);
          $('#editTitle').val(result.data.experience_title);
          $('#editCompany').val(result.data.company);
          $('#editCareerLevel').val(result.data.career_level_id);
          $('#editIndustryId').val(result.data.industry_id);
          $('#editJobCategoryId').val(result.data.job_category_id);
          $('#editCountry').val(result.data.country_id).trigger('change', [{
            stateId: result.data.state_id,
            cityId: result.data.city_id
          }]);
          //alert(result.data.functional_areas);
          let functions = JSON.parse(result.data.functional_areas);
            $('#editModalFunctionalAreas').select2({
                'width': '100%',
            });
          $('#editModalFunctionalAreas').val(functions).trigger('change');

          $('#editStartDate').val(moment(result.data.start_date).format('YYYY-MM-DD'));
          $('#editDescription').val(converter.makeHtml(result.data.description));
          let descriptionHtml = converter.makeHtml(result.data.description);
          qEditExperience.root.innerHTML = descriptionHtml;

          if (result.data.currently_working == 1) {
            $('#editWorking').prop('checked', true);
            $('#editEndDate').val('');
          } else {
            $('#editWorking').prop('checked', false);
            $('#editEndDate').val(moment(result.data.end_date).format('YYYY-MM-DD'));
          }

          if (result.data.currently_working == 1) {
            $('#editEndDate').prop('disabled', true);
          }

          $('#editExperienceModal').appendTo('body').modal('show');
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  };

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
          $('#editExperienceModal').modal('hide');
          location.reload();
          $('.candidate-experience-container').children('.candidate-experience').each(function () {
            var candidateExperienceId = $(this).attr('data-id');

            if (candidateExperienceId === result.data.id) {
              $(this).remove();
            }
          });
          renderExperienceTemplate(result.data.candidateExperience);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editExperienceForm', '#btnEditExperienceSave');
      }
    });
  });

  $('#addExperienceModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewExperienceForm', '#validationErrorsBox');
    $('#countryId, #stateId, #cityId').val('');
    $('#stateId, #cityId').empty();
    $('#countryId').trigger('change.select2');
  });
  $('#addEducationModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewEducationForm', '#validationErrorsBox');
    $('#degreeLevelId').val('');
    $('#degreeLevelId').select2({
      'width': '100%',
      'placeholder': 'Select Degree Level'
    });
    $('#educationCountryId, #educationStateId, #educationCityId').val('');
    $('#educationStateId, #educationCityId, #educationSchoolId').empty();
    $('#educationCountryId').trigger('change.select2');
  });
  $(document).on('click', '.delete-experience', function (event) {
    var experienceId = $(event.currentTarget).data('id');
    deleteItem(experienceUrl + experienceId, 'Experience', '.candidate-experience-container', '.candidate-experience', '#notfoundExperience');
  });

  window.renderEducationTemplate = function (educationArray) {
    var candidateEducationCount = $('.candidate-education-container .candidate-education:last').data('education-id') != undefined ? $('.candidate-education-container .candidate-education:last').data('experience-id') + 1 : 0;
    var template = $.templates('#candidateEducationTemplate');
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

  $(document).on('submit', '#addNewEducationForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewEducationForm', '#btnEducationSave', 'loading');
    $.ajax({
      url: addEducationUrl,
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          $('#notfoundEducation').addClass('d-none');
          displaySuccessMessage(result.message);
          $('#addEducationModal').modal('hide');
          renderEducationTemplate(result.data);
          updateProfileCompletion();
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

  window.renderEducationData = function (id) {
    $.ajax({
      url: candidateUrl + id + '/edit-education',
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#educationId').val(result.data.id);
          $('#editDegreeLevel').val(result.data.degree_level.id).trigger('change');
          $('#editDegreeTitle').val(result.data.degree_title);
          $('#editStartYear').val(result.data.start_year);
          $('#editEducationCountry').val(result.data.country_id).trigger('change', [{
            stateId: result.data.state_id,
            cityId: result.data.city_id
          }]);
          $('#editInstitute').val(result.data.institute);
          //alert(result.data.currently_studying);
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
          $('#editResult').val(result.data.result);
          $('#editYear').val(result.data.year).trigger('change');
          $('#editEducationModal').appendTo('body').modal('show');
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  };

    $(document).on('submit', '#addNewRefereeForm', function (e) {
        e.preventDefault();
        processingBtn('#addNewRefereeForm', '#btnRefereeSave', 'loading');
        $.ajax({
            url: addRefereeUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    $('#notfoundReferee').addClass('d-none');
                    displaySuccessMessage(result.message);
                    $('#addRefereeModal').modal('hide');
                    renderRefereesTemplate(result.data);
                    updateProfileCompletion();
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

    window.renderRefereesTemplate = function (refereeArray) {
        var candidateRefereesCount = $('.candidate-referees-container .candidate-education:last').data('referee-id') != undefined ? $('.candidate-referees-container .candidate-education:last').data('referee-id') + 1 : 0;
        var template = $.templates('#candidateRefereesTemplate');
        var data = {
            candidateRefereeNumber: candidateRefereesCount,
            id: refereeArray.id,
            refereeName: refereeArray.name,
            refereePosition: refereeArray.position,
            phone: refereeArray.region_code+refereeArray.phone,
            email: refereeArray.email,
            postalAddress: refereeArray.postal_address,
            company: refereeArray.company,
        };
        var stageTemplateHtml = template.render(data);
        $('.candidate-referees-container').append(stageTemplateHtml);
        $('#notfoundReferee').addClass('d-none');
    };

    $(document).on('click', '.edit-referee', function (event) {
        var refereeId = $(event.currentTarget).data('id');
        renderRefereeData(refereeId);
    });

    $(document).on('submit', '#editRefereeForm', function (event) {
        event.preventDefault();

        processingBtn('#editRefereeForm', '#btnEditRefereeSave', 'loading');
        var id = $('#refereeId').val();
        $.ajax({
            url: refereeUrl + id,
            type: 'put',
            data: $(this).serialize(),
            success: function success(result) {
                console.log(result);
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editRefereeModal').modal('hide');
                    location.reload();
                    $('.candidate-referees-container').children('.candidate-referee').each(function () {
                        var candidateRefereeId = $(this).attr('data-id');

                        if (candidateRefereeId == result.data.id) {
                            $(this).remove();
                        }
                    });
                    renderRefereesTemplate(result.data.candidateReference);
                }
            },
            error: function error(result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function complete() {
                processingBtn('#editRefereeForm', '#btnEditRefereeSave');
            }
        });
    });
    $('#editRefereeModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewRefereeForm', '#validationErrorsBox');
    });
    $(document).on('click', '.delete-referee', function (event) {
        var refereeId = $(event.currentTarget).data('id');
        deleteItem(refereeUrl + refereeId, 'Referee', '.candidate-referees-container', '.candidate-referee', '#notfoundReferee');
    });

    window.renderRefereeData = function (id) {
        $.ajax({
            url: candidateUrl + id + '/edit-referee',
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    $('#refereeId').val(result.data.id);
                    $('#editRefereeName').val(result.data.name).trigger('change');
                    $('#editRefereePosition').val(result.data.position);
                    $('#editRefereeCompany').val(result.data.company);
                    $('#editRefereeEmail').val(result.data.email);
                    $('#refereePhoneNumber').val(result.data.phone);
                    $('#editRefereePostalAddress').val(result.data.postal_address);
                    $('#referee_prefix_code').val(result.data.region_code);

                    $('#editRefereeModal').appendTo('body').modal('show');
                }
            },
            error: function error(result) {
                displayErrorMessage(result.responseJSON.message);
            }
        });
    };

    // Achievements
    $(document).on('submit', '#addNewAchievementForm', function (e) {
        e.preventDefault();
        processingBtn('#addNewAchievementForm', '#btnAchievementSave', 'loading');
        $.ajax({
            url: addAchievementUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    $('#notfoundReferee').addClass('d-none');
                    displaySuccessMessage(result.message);
                    $('#addAchievementModal').modal('hide');
                    location.reload();
                    renderAchievementsTemplate(result.data);
                    updateProfileCompletion();
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
    // Objective
    $(document).on('submit', '#addNewObjectiveForm', function (e) {
        e.preventDefault();
        processingBtn('#addNewObjectiveForm', '#btnObjectiveSave', 'loading');
        $.ajax({
            url: addObjectiveUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    $('#notfoundObjective').addClass('d-none');
                    displaySuccessMessage(result.message);
                    $('#addObjectiveModal').modal('hide');
                    //renderAchievementsTemplate(result.data);
                    $('#candidate-objective').html(result.data.description);
                    updateProfileCompletion();
                }
            },
            error: function error(result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function complete() {
                processingBtn('#addNewObjectiveForm', '#btnObjectiveSave');
            }
        });
    });

    window.renderAchievementsTemplate = function (achievementArray) {
        var candidateAchievementsCount = $('.candidate-achievements-container .candidate-achievement:last').data('achievement-id') != undefined ? $('.candidate-achievements-container .candidate-achievement:last').data('achievement-id') + 1 : 0;
        var template = $.templates('#candidateAchievementsTemplate');
        var data = {
            candidateAchievementNumber: candidateAchievementsCount,
            id: achievementArray.id,
            achievementName: achievementArray.title,
            institutionName: '',
            achievementDescription: achievementArray.description,
        };
        var stageTemplateHtml = template.render(data);
        $('.candidate-achievements-container').append(stageTemplateHtml);
        $('#notfoundAchievement').addClass('d-none');
    };

    $(document).on('click', '.edit-achievement', function (event) {
        var achievementId = $(event.currentTarget).data('id');
        $('#editCountryOfInstitution').select2({
            'width': '100%',
        });
        $('#editCertificateCategory').select2({
            'placeholder': 'Select Category',
            'width': '100%',
        });
        $('#editIdOfInstitution').select2({
            'placeholder': 'Select Institution',
            'width': '100%',
        });
        renderAchievementsData(achievementId);
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
                console.log(result);
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editAchievementModal').modal('hide');
                    let txt = $("#idOfInstitution option:selected").text();
                    location.reload();
                    $('.candidate-achievement-container').children('.candidate-achievement').each(function () {
                        var candidateAchievementId = $(this).attr('data-id');

                        if (candidateAchievementId === result.data.id) {
                            $(this).remove();
                        }
                    });
                    renderAchievementsTemplate(result.data.candidateAchievements);
                }
            },
            error: function error(result) {
                console.log(result);
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function complete() {
                processingBtn('#editRefereeForm', '#btnEditRefereeSave');
            }
        });
    });
    $('#editAchievementModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewAchievementForm', '#validationErrorsBox');
    });
    $(document).on('click', '.delete-achievement', function (event) {
        var achievementId = $(event.currentTarget).data('id');
        deleteItem(achievementUrl + achievementId, 'Achievement', '.candidate-achievements-container', '.candidate-achievement', '#notfoundAchievement');
    });

    window.renderAchievementsData = function (id) {
        $.ajax({
            url: achievementUrl + id + '/edit-achievement',
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    $('#achievementId').val(result.data.id);
                    $('#editAchievementTitle').val(result.data.title).trigger('change');
                    $('#editAchievementDescription').val(result.data.description);
                    $('#editAchievementCompletionDate').val(result.data.completion_date);
                    $('#editAchievementValidUntil').val(result.data.valid_until);
                    if(result.data.ongoing){
                        $('#edit_is_ongoing').prop('checked', true);
                        $('#editAchievementCompletionDate').prop('disabled', true);

                    }
                    //alert('hellow there');
                    if(result.data.category){
                        $('#editCertificateCategory').empty().append($('<option></option>').attr('value', result.data.category.id).text(result.data.category.name));
                        $('#editCertificateCategory').val(result.data.category?result.data.category.id:'');
                    }

                    if(result.data.country){
                        $('#editCountryOfInstitution').val(result.data.country.id).trigger('change');
                    }

                    if(result.data.institution){
                        $('#editIdOfInstitution').append($('<option></option>').attr('value', result.data.institution.id).text(result.data.institution.name))/*.val(result.data.institution.id).trigger('change')*/;
                        $('#editIdOfInstitution').val(result.data.institution.id).trigger('change');
                    }

                    $('#editAchievementAttachment').val(result.data.attachment_id);

                    $('#editAchievementModal').appendTo('body').modal('show');
                }
            },
            error: function error(result) {
                console.log(result);
                displayErrorMessage(result.responseJSON.message);
            }
        });
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
          $('#editEducationModal').modal('hide');
          location.reload();
          $('.candidate-education-container').children('.candidate-education').each(function () {
            var candidateEducationId = $(this).attr('data-id');

            if (candidateEducationId == result.data.id) {
              $(this).remove();
            }
          });
          renderEducationTemplate(result.data.candidateEducation);
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
  $('#editEducationModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewEducationForm', '#validationErrorsBox');
  });
  $(document).on('click', '.delete-education', function (event) {
    var educationId = $(event.currentTarget).data('id');
    deleteItem(educationUrl + educationId, 'Education', '.candidate-education-container', '.candidate-education', '#notfoundEducation');
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
        }

        swal({
          title: 'Deleted!',
          text: header + ' has been deleted.',
          type: 'success',
          confirmButtonColor: '#6777ef',
          timer: 2000
        });
        updateProfileCompletion(userId);
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
        console.log(data);
        $.each(data.data, function (i, v) {
          $(modalType === 'experience' ? !modalTypeHasEdit ? '#stateId' : '#editState' : !modalTypeHasEdit ? '#educationStateId' : '#editEducationState').append($('<option></option>').attr('value', i).text(v));
        });
        if (modalTypeHasEdit) $(modalType === 'experience' ? '#editState' : '#editEducationState').val(typeof paramData !== 'undefined' ? paramData.stateId : '').trigger('change', typeof paramData !== 'undefined' ? [{
          cityId: paramData.cityId
        }] : '');
      }
    });
  });
  $('#stateId, #educationStateId, #editState, #editEducationState, #educationCityId').on('change', function (e, paramData) {
    var modalType = $(this).data('modal-type');
    var modalTypeHasEdit = typeof $(this).data('is-edit') === 'undefined' ? false : true;
      var elementId = $(this).attr('id');
      var country = $(modalType === 'experience' ? !modalTypeHasEdit ? '#countryId' : '#editCountry' : !modalTypeHasEdit ? '#educationCountryId' : '#editEducationCountry').val();
      if(elementId == 'educationCityId'){
          //alert(modalType)
          //return;
          $.ajax({
              url: schoolUrl,
              type: 'get',
              dataType: 'json',
              data: {
                  city: $(this).val(),
                  country: $(modalType === 'experience' ? !modalTypeHasEdit ? '#countryId' : '#editCountry' : !modalTypeHasEdit ? '#educationCountryId' : '#editEducationCountry').val()
              },
              success: function success(data) {
                  console.log(data);
                  $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationSchoolId' : '#editEducationSchool').empty();
                  $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationSchoolId' : '#editEducationSchool').append('<option value="" selected>Select School</option>');
                  $.each(data.data, function (i, v) {
                      $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationSchoolId' : '#editEducationSchool').append($('<option></option>').attr('value', v).text(v));
                  });
                  if (modalTypeHasEdit) $(modalType === 'experience' ? '#editCity' : '#editEducationCity').val(typeof paramData !== 'undefined' ? paramData.cityId : '').trigger('change.select2');
              }
          });
          return;
      }
    $.ajax({
      url: companyCityUrl,
      type: 'get',
      dataType: 'json',
      data: {
        state: $(this).val(),
        country: $(modalType === 'experience' ? !modalTypeHasEdit ? '#countryId' : '#editCountry' : !modalTypeHasEdit ? '#educationCountryId' : '#editEducationCountry').val()
      },
      success: function success(data) {
          console.log(data);
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

/***/ }),

/***/ 37:
/*!*************************************************************************************************!*\
  !*** multi ./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js ***!
  \*************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidates/candidate-profile/candidate_career_informations.js */"./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js");


/***/ })

/******/ });
