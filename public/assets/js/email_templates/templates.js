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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/followers/followers.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/followers/followers.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//alert(templateShowUrl);
var tableName = '#templatesTbl';

$(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  ajax: {
    url: templatesUrl
  },
  columnDefs: [{
    'targets': [1],
    'defaultContent': 'N/A',
    'width': '15%'
  }, /*{
    'targets': [2],
    'className': 'text-center',
    'width': '25%'
  }*/],
  columns: [{
    data: function data(row) {
      return '<a href="" target="_blank">' + row.name + '</a>';
    },
    name: 'email_template.name'
  }, {
    data: function data(row){
        console.log(row);
        let action =  '';
        if(row.company_id){
           action += '<a class="text-danger btn btn-sm btn delete-template" data-id="'+row.id+'" title="Delete"><i class="fas fa-trash"></i></a>';
           action += '<a class="btn btn-sm text-primary edit-template" data-id="'+row.id+'" title="Edit"><i class="fas fa-edit"></i></a>';
        }
        action += '<a class="text-success btn btn-sm btn view-template" title="View" data-toggle="modal" data-target="#show-template" data-id="'+row.id+'"><i class="fas fa-desktop"></i></a>';

        return action
    },
    name: 'actions'
  }]
});

$(document).on('click', '.view-template', function (event){
    //$('.show-template').modal('show');
    var templateId = $(event.currentTarget).data('id');
    var link = templateShowUrl.replace('**id**', templateId);
    $('#templateContent').html(showLoading());
    $.ajax({
        url: link,
        type: 'get',
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            //loadContent(processNotesView(result));
            $('#templateContent').html(processTemplateView(result.data))
            console.log(result)
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
});

$(document).on('change', '#newTemplateType', function(){
    var type = $(this).val();
    var link = placeholdersRetrieveUrl.replace('**placeholder**', type);
    $('#placeholder-columns').html(showLoading());
    $.ajax({
        url: link,
        type: 'get',
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            //loadContent(processNotesView(result));
            let output = '';
            for(let x = 0; x < result.data.length; x++){
                output += '<small class=""><a class="btn btn-sm btn-primary mb-2 placeholder mr-1" data-action="new">'+result.data[x]+'</a></small>';
            }
            $('#placeholder-columns').html(output);
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
});

$(document).on('change', '#editTemplateType', function(){
    var type = $(this).val();
    var link = placeholdersRetrieveUrl.replace('**placeholder**', type);
    $('#edit-placeholder-columns').html(showLoading());
    $.ajax({
        url: link,
        type: 'get',
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            //loadContent(processNotesView(result));
            let output = '';
            for(let x = 0; x < result.data.length; x++){
                output += '<small class=""><a class="btn btn-sm btn-primary mb-2 placeholder mr-1" data-action="edit">'+result.data[x]+'</a></small>';
            }
            $('#edit-placeholder-columns').html(output);
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
});

$(document).on('click', '.edit-template', function(event){
    var templateId = $(event.currentTarget).data('id');
    var link = templateShowUrl.replace('**id**', templateId);
    $('#loading-template').html(showLoading());
    $('#editTemplate').hide();
    $('#edit-template').modal('show');

    $.ajax({
        url: link,
        type: 'get',
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function success(result) {
            $('#edit_template_id').val(result.data.id);
            $('#editTemplateName').val(result.data.name);
            $('#editTemplateType').val(result.data.type);
            $('#editTemplateType').trigger('change');
            $('#loading-template').html('');
            $('#editTemplate').fadeIn();
            quillEdit.root.innerHTML = result.data.content;
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        }
    });
    $('#edit-template').modal('show');
});

$(document).on('click', '.delete-template', function(event){
    var templateId = $(event.currentTarget).data('id');
    let url = templateDeleteUrl.replace('**temp_id**', templateId);
    //alert('hi there');
    deleteItem(url, '#templatesTbl', 'Template', '', '');
    $(tableName).DataTable().ajax.reload(null, true);
});

$(document).on('click', '#save-template', function(){
    let template  = quill.root.innerHTML
    $('#email_template').val(template);
    $('#submit-template').click();
});

$(document).on('click', '#save-template-edit', function(){
    let template  = quillEdit.root.innerHTML
    $('#edit_email_template').val(template);
    $('#submit-edit-template').click();
});

$(document).on('submit', '#addTemplate', function(event){
    event.preventDefault();
    let initialText = $('#save-template').html();
    let loadText = '<span class=\'spinner-border spinner-border-sm\'></span> Processing...';
    processingBtn('#addTemplate', '#save-template', 'loading');
    $('#save-template').html(loadText);
    $('#save-template').prop('disabled', true);
    $.ajax({
        url: templateSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function success(result) {
            if (result.data) {
                displaySuccessMessage(result.message);
                $('#add-template').modal('hide');
                quill.root.innerHTML = '<p>Write your email template here</p>';
                $('#newTemplateName').val('');
                $('#save-template').html(initialText);
                $('#save-template').prop('disabled', false);
                $(tableName).DataTable().ajax.reload(null, true);
            }else{
                displayErrorMessage(result.message)
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

$(document).on('submit', '#editTemplate', function(event){
    event.preventDefault();
    let initialText = $('#save-template-edit').html();
    let loadText = '<span class=\'spinner-border spinner-border-sm\'></span> Processing...';
    processingBtn('#editTemplate', '#save-template-edit', 'loading');
    $('#save-template-edit').html(loadText);
    $('#save-template-edit').prop('disabled', true);
    $.ajax({
        url: templateSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function success(result) {
            if (result.data) {
                displaySuccessMessage(result.message);
                $('#edit-template').modal('hide');
                $('#save-template-edit').html(initialText);
                $('#save-template-edit').prop('disabled', false);
                $(tableName).DataTable().ajax.reload(null, true);
            }else{
                displayErrorMessage(result.message)
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


$(document).on('click', '#add-template-button', function (){
    processingBtn('#addTemplate', '#save-template', 'loading');
});

window.processTemplateView = function (data){
    let output = "<div class=''><span><strong>"+data.name+"</strong></span>";
    output += "<div><p>"+data.content+"</p></div></div>";
    return output
};

$(document).on('click', '.placeholder', function (event){
    //alert('hi there')
    let placeholder = "["+event.target.innerText+"]";
    let action = $(this).attr('data-action');

    if(action === 'edit'){
        let selection = quillEdit.getSelection(true);
        quillEdit.insertText(selection.index, placeholder);
    }else{
        let selection = quill.getSelection(true);
        quill.insertText(selection.index, placeholder);
    }

    displaySuccessMessage('Placeholder added successfully');
    //copyToClipBoard(placeholder, 'Placeholder');
})



/***/ }),

/***/ 48:
/*!**********************************************************!*\
  !*** multi ./resources/assets/js/followers/followers.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/followers/followers.js */"./resources/assets/js/followers/followers.js");


/***/ })

/******/ });
