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
/******/ 	return __webpack_require__(__webpack_require__.s = 34);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/job_applications/job_applications.js":
/*!******************************************************************!*\
  !*** ./resources/assets/js/job_applications/job_applications.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
        /*$("#notesViewContent").html('hellwo there')*/
var tableName = '#jobApplicationsTbl';
var filterBy = $('#filtering').val();
var data = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  ajax: {
    url: jobApplicationsUrl+'/'+filterBy
  },
  columnDefs: [{
    'targets': [0],
    'className': 'text-center',
    'width': '15%',
      'searchable': true
  }, {
    'targets': [2],
    'className': 'text-right',
    'width': '15%',
      'searchable': true
  }, {
    'targets': [3],
    'className': 'text-center',
    'width': '13%',
    'orderable': false,
      'searchable': true
  }, {
    'targets': [4],
    'className': 'text-center',
    'width': '15%',
    'orderable': false,
      'searchable': true
  }, {
    'targets': [7],
    'className': 'text-center',
    'width': '15%',
    'orderable': true,
      'searchable': false
  }, {
    'targets': [5],
    'className': 'text-center',
    'width': '12%',
    'orderable': false,
      'searchable': true
  }, {
    'targets': [6],
    'className': 'text-center',
    'width': '12%',
    'orderable': true,
    'searchable': false
  },{
      'targets': [8],
      'className': 'text-center',
      'orderable': false,
      'width': '5%',
      'searchable': false
  }],
  columns: [{
    /*data: 'candidate.user.full_name',
    name: 'candidate.user.first_name'*/
    data: function data(row){
        let noteSup = row.notes.length?"<sup> <a href='#show-note' title='"+transApplicationNote+"' class='action-notes' data-toggle='modal' data-target='#show-notes' data-id='"+row.id+"'><i class='fas fa-sticky-note'></i></a></sup>":"";
        return row.candidate.user.full_name+noteSup;
    },
    name: 'candidate.user.first_name'
  }, {
    data: function data(row) {
      return row.currency.currency_icon + '&nbsp;' + currency(row.expected_salary).format();
    },
    name: 'expected_salary'
  }, {
    data: function data(row) {
      return moment(row.created_at, 'YYYY-MM-DD').format('Do MMM, YYYY');
    },
    name: 'created_at'
  },{
      data: function(row){
          let interview_date = row.interview?row.interview.date:'';
          if(interview_date){
              let done = row.interview.status?'<span class="ml-2 text-success" title="Interview Done"><i class="fas fa-check-circle"></i></span>':'';
              return '<span>'+moment(interview_date, 'YYYY-MM-DD').format('Do MMM, YYYY')+done+'</span>';
          }else{
              return 'not-set';
          }

      },
      name: 'interview.date'
  },{
      data: function(row){
          let cover_letter = row.cover_letter;
          if(cover_letter){
              return "<a href='#view-cover' class='coverLetter' data-content='"+row.cover_letter+"' data-toggle=\"modal\" data-target=\"#coverLetter\">"+view+"</a>";
          }else{
              return '';
          }
      },
      name: 'cover_letter'
  },{
    data: function data(row) {
      var downloadLink = downloadDocumentUrl + '/' + row.id;
      //alert(row.resume_url)
      if(row.resume_url.indexOf('.pdf')){
        return  '<a href="#view-resume" class="document" id="'+row.resume_url+'" data-toggle="modal" data-target="#document" onclick="event.preventDefault()">' + view + '</a>';
      }else{
          return '<a href="' + downloadLink + '">' + 'Download' + '</a>';
      }

    },
    name: 'candidate.user.last_name'
  }, {
    data: function data(row) {
      var statusColor = {
        '0': 'warning',
        '1': 'primary',
        '2': 'danger',
        '3': 'info',
        '4': 'success',
        '5': 'success',
      };
      return '<span class="badge badge-' + statusColor[row.status] + '">' + statusArray[row.status] + '</span>';
    },
    name: 'status'
  }, {
    data: function data(row) {
      var isCompleted = false;
      var isShortlisted = false;
      var isRejected = false;
      var interviewScheduled = false;
      var interviewed = false;
      var notes = row.notes;

      console.log(row);

      if (row.status == 5 || row.status == 2) {
        isCompleted = true;
      }

      if(row.interview){
          interviewScheduled = true
      }

      if (row.status >= 3) {
        isShortlisted = true;
          if (row.status > 3){
              interviewScheduled = true;
              interviewed = true;
          }
      }

      if(row.interview && row.interview.status){
          interviewed = true;
      }

      if(row.status == 2){
          isRejected = true;
      }



      var data = [{
        'statusId': row.status,
        'id': row.id,
        'isCompleted': isCompleted,
        'isShortlisted': isShortlisted,
        'interviewScheduled': interviewScheduled,
        'interviewed': interviewed,
        'isRejected': isRejected,
        'notes': notes,
        'isStaff': isStaff,
      }];
      return prepareTemplateRender('#jobApplicationActionTemplate', data);
    },
    name: 'id'
  },{
      data: function data(row){
          let checkbox = '<input type="checkbox" class="bulk-selection" id="application-'+row.id+'" data-id="'+row.id+'">';
          if(isStaff){
              checkbox = '';
          }
          return checkbox;
      },
      name: 'candidate.user.last_name'
  }]
});

$('#filtering').change(function(){
    $(tableName).DataTable().ajax.reload(null, true);
});

$(document).on('keyup', '#note-description', function(event){
    showSaveButton();
});
$(document).on('change', '#select_all', function(event){
   $('.bulk-selection').prop('checked', this.checked);
   checkSelection();
});

$(document).on('change', '.bulk-selection', function(){
    bulkActionControl();
});

$(document).on('submit', '#add-interview-form', function(event){
    event.preventDefault();
    let form = $(this).html();
    let data = new FormData(this);
    //alert('you are about to submit your interview schedule')
    let notification = document.getElementById('email_notification');

    if(notification.checked){
        data.append('email_notification', '1');
        data.append('template_id', $('#template_id').val());
    }
    processingBtn('#add-interview', '#save-interview', 'loading');
    $.ajax({
        url: interviewScheduleUrl,
        type: 'post',
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            console.log(result);
            if(result.success){
                if(!result.next){
                    displaySuccessMessage(result.message);
                    $("#add-interview-form").html(form);
                    $(tableName).DataTable().ajax.reload(null, false);
                    $('#add-interview').modal('hide');
                    //processingBtn('#add-interview', '#save-interview');
                }
            }
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
});

$(document).on('submit', '#add-note-form', function(event){
   event.preventDefault();
   let appId = document.getElementById('note_application_id');
   let description = document.getElementById('note-description');
   /*let data = {
       application_id: appId.value,
       description: description.value
   };*/
   let data = new FormData();
   data.append('application_id', appId.value);
   data.append('description', description.value);
   processingBtn('#add-note-form', '#save-note', 'loading');
    $.ajax({
        url: addNoteUrl.replace('**appid**', appId.value),
        type: 'post',
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            console.log(result);
            displaySuccessMessage(noteSavedMessage);
            clearNote();
            closeModal();
            $(tableName).DataTable().ajax.reload(null, false);
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
   /*$.ajax({
       url: addNoteUrl.replace('**appid**', appId.value),
       data: data,
       success: function(result){
           console.log(result);
       },
       error: function(result){

       }

   })*/
});

$(document).on('change', '#bulk-action-select', function (event){
    let actions = {
        shortlisted: "Mark as shortlisted",
        schedule_interview: "Schedule an interview",
        interviewed: "Mark as interviewed",
        selected: "Mark as selected",
        delete: "Delete"
    };
    let actionText = actions[this.value];
    let action = this.value;
    clearBulkSelection();
    let closeOnConfirm;
    if(action ==='schedule_interview'){
        closeOnConfirm = true;
    }else{
        closeOnConfirm = false;
    }
    swal({
        title: actionText,
        text: 'Are you sure want to continue ?',
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: closeOnConfirm,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }, function () {
        if(action === "schedule_interview"){
            $('#application_id').val(JSON.stringify(selectedApplications));
            $('#add-interview').modal('show');
        }else{
            var jobApplicationId = JSON.stringify(selectedApplications);
            let applicationStatus;
            if(action === "shortlisted") {
                applicationStatus = 3;
            }else if(action === "interviewed"){
                applicationStatus = 4;
            }else if(action === "selected"){
                applicationStatus = 5;
            }else if(action === "rejected"){
                applicationStatus = 2;
            }
            if(action !== 'delete'){
                changeStatus(jobApplicationId, applicationStatus);
            }else{
                /*deleteItem(jobApplicationDeleteUrl + '/' + jobApplicationId+'/delete/'+jobId, tableName, 'Job Application');*/
                let url = jobApplicationDeleteUrl + '/' + jobApplicationId+'/delete/'+jobId;
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (obj) {
                        if (obj.success) {
                            if ($(tableName).DataTable().data().count() == 1) {
                                $(tableName).DataTable().page('previous').draw('page');
                            } else {
                                $(tableName).DataTable().ajax.reload(null, false);
                            }
                        }
                        swal({
                            title: 'Deleted!',
                            text: 'Job Applications have been deleted.',
                            type: 'success',
                            confirmButtonColor: '#6777ef',
                            timer: 2000,
                        });
                    },
                    error: function (data) {
                        swal({
                            title: '',
                            text: data.responseJSON.message,
                            type: 'error',
                            confirmButtonColor: '#6777ef',
                            timer: 5000,
                        });
                    },
                });
            }
        }
    });
});

$('input[type="search"]').attr('id', 'search');



$(document).on( 'keyup', '#search',  function (event) {
    //this.setAttribute( 'id', 'cerca' );
    //alert('hellow');
    // data.search(4, 6).draw();
    //data.search('peter', 0).draw();

});

$(document).on('click', '.action-note', function(event){
    let jobApplicationId = $(event.currentTarget).data('id');
    currentApplication(jobApplicationId);
})
$(document).on('click', '.action-delete', function (event) {
  var jobApplicationId = $(event.currentTarget).data('id');
  deleteItem(jobApplicationDeleteUrl + '/' + jobApplicationId, tableName, 'Job Application');
});
$(document).on('click', '.action-interview-schedule', function (event) {
    event.preventDefault();
  var jobApplicationId = $(event.currentTarget).data('id');
  $('#add-interview').modal('show');
  $('#application_id').val(jobApplicationId);
});
$(document).on('click', '.short-list', function (event) {
  var jobApplicationId = $(event.currentTarget).data('id');
  var applicationStatus = 3;
  changeStatus(jobApplicationId, applicationStatus);
});
$(document).on('click', '.action-interviewed', function (event) {
  var jobApplicationId = $(event.currentTarget).data('id');
  var applicationStatus = 4;
  changeStatus(jobApplicationId, applicationStatus);
});
$(document).on('click', '.action-completed', function (event) {
  var jobApplicationId = $(event.currentTarget).data('id');
  var applicationStatus = 5;
  changeStatus(jobApplicationId, applicationStatus);
});

$(document).on('click', '.action-decline', function (event) {
  var jobApplicationId = $(event.currentTarget).data('id');
  //alert('hellow')
  var applicationStatus = 2;
    swal({
        title: 'Confirm',
        text: 'Are you sure want to reject this application ?',
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }, function () {
        changeStatus(jobApplicationId, applicationStatus);
    });
});
$(document).on('click', '.action-notes', function (event) {
  var jobApplicationId = $(event.currentTarget).data('id');
  let data = new FormData();
  data.append('application_id', jobApplicationId);
  loadContent(showLoading());
  //alert(jobApplicationId);
    $.ajax({
        url: notesUrl.replace('**appid**', jobApplicationId),
        type: 'post',
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            loadContent(processNotesView(result));
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
  //var applicationStatus = 2;
  //changeStatus(jobApplicationId, applicationStatus);
});

window.processNotesView = function (data){
   let output = "";
   for(let x = 0; x < data.length; x++){
       let row = '<div class="d-flex flex-row mr-3 py-2">'+
           '                    <span><strong>'+Number(data[x].author.id) == Number(currentUser)?"Me":data[x].author.first_name+':</strong></span>'+
           '                    <span class="flex-fill ml-2">'+data[x].description+'</span>'+
           '     </div>';
       output += row;
   }
   return output
};

$(document).on('change', '#email_notification', function (event){
    let link = availableTemplatesUrl.replace('**type**', 'interview_schedule');
    if(this.checked){
        $('#template-type-div').html(showLoading());
        $('#save-interview').attr('disabled', true);

        $.ajax({
            url: link,
            type: 'get',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function success(result) {
                let selection = document.createElement('select');
                selection.setAttribute('id', 'template_id');
                selection.setAttribute('name', 'template_id');
                selection.setAttribute('class', 'form-control');
                if(result.data){
                    for(let x = 0; x < result.data.length; x++){
                        let opt = document.createElement('option')
                        opt.setAttribute("value", result.data[x].id);
                        let optText = document.createTextNode(result.data[x].name);
                        opt.appendChild(optText);
                        selection.appendChild(opt);
                    }
                    let label = document.createElement('label');
                    let labelText = document.createTextNode('Choose email template');
                    label.appendChild(labelText);
                    let div = document.getElementById('template-type-div');
                    $('#template-type-div').html('');
                    div.appendChild(label);
                    div.appendChild(selection);
                    //$('#template-type').html(label+selection);
                }
                $('#save-interview').attr('disabled', false);
            },
            error: function error(result) {
                displayErrorMessage(result.responseJSON.message);
            }
        });
    }else{
        $('#template-type-div').html('');
    }
});

window.bulkActionControl = function (){
    let selection = checkSelection();
    if(selection){
        $('#bulk-action-div').removeClass('d-none');
        return;
    }
    $('#bulk-action-div').addClass('d-none');
    $('#bulk-action-select').val('');
};

window.clearBulkSelection = function (){
    $('#bulk-action-select').val('');
};

window.checkSelection = function(){
    let checkboxes = document.getElementsByClassName('bulk-selection');
    let selected = 0;
    selectedApplications = [];
    for(let x = 0; x < checkboxes.length; x++){
        if(checkboxes[x].checked){
            let appId = checkboxes[x].id.replace('application-', '');
            selectedApplications.push(appId);
            selected += 1;
        }
    }
    return selected;
};

window.showLoading = function(){
    let content = '<div class="text-center">' +
        '                        <svg class="loader-position" width="150px" height="75px" viewBox="0 0 187.3 93.7"' +
        '                             preserveAspectRatio="xMidYMid meet">' +
        '                            <path stroke="#00c6ff" id="outline" fill="none" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"' +
        '                                  stroke-miterlimit="10"' +
        '                                  d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 \t\t\t\tc-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z"/>\n' +
        '                            <path id="outline-bg" opacity="0.05" fill="none" stroke="#f5981c" stroke-width="5" stroke-linecap="round"' +
        '                                  stroke-linejoin="round" stroke-miterlimit="10"' +
        '                                  d="\t\t\t\tM93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 \t\t\t\tc-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z"/>\n' +
        '                        </svg>' +
        '                    </div>';
    return content;
};

window.changeStatus = function (id, applicationStatus) {
  console.log(jobApplicationStatusUrl + id + '/status/' + applicationStatus);
  $.ajax({
    url: jobApplicationStatusUrl + id + '/status/' + applicationStatus,
    method: 'get',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
      swal.close();
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      swal.close();
    }
  });
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId);
    if (state === 'loading') {
        loadingButton.button('loading');
    } else {
        loadingButton.button('reset');
    }
};


/***/ }),

/***/ 34:
/*!************************************************************************!*\
  !*** multi ./resources/assets/js/job_applications/job_applications.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/job_applications/job_applications.js */"./resources/assets/js/job_applications/job_applications.js");


/***/ })

/******/ });
