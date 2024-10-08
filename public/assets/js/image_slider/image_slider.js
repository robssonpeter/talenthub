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
/******/ 	return __webpack_require__(__webpack_require__.s = 68);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/image_slider/image_slider.js":
/*!**********************************************************!*\
  !*** ./resources/assets/js/image_slider/image_slider.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = '#imageSlidersTbl';
$(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[1, 'asc']],
  ajax: {
    url: imageSliderUrl,
    data: function data(_data) {
      _data.is_active = $('#image_filter_status').find('option:selected').val();
    }
  },
  columnDefs: [{
    'targets': [0],
    'width': '10%',
    'orderable': false,
    'className': 'text-center'
  }, {
    'targets': [1],
    'orderable': true,
    'className': 'text-center description'
  }, {
    'targets': [2],
    'orderable': false,
    'className': 'text-center'
  }, {
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }],
  columns: [{
    data: function data(row) {
      return '<img src="' + row.image_slider_url + '" class="rounded-circle thumbnail-rounded"' + '</img>';
    },
    name: 'id'
  }, {
    data: function data(row) {
      if (!isEmpty(row.description)) {
        var element = document.createElement('textarea');
        element.innerHTML = row.description;
        return element.value.length > 80 ? element.value.substr(0, 80) + '...' : element.value;
      } else return 'N/A';
    },
    name: 'description'
  }, {
    data: function data(row) {
      var checked = row.is_active === 0 ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return prepareTemplateRender('#isActive', data);
    },
    name: 'is_active'
  }, {
    data: function data(row) {
      var data = [{
        'id': row.id
      }];
      return prepareTemplateRender('#imageSliderActionTemplate', data);
    },
    name: 'id'
  }],
  'fnInitComplete': function fnInitComplete() {
    $('#image_filter_status').change(function () {
      $(tableName).DataTable().ajax.reload(null, true);
    });
  }
});
$(document).ready(function () {
  $('#image_filter_status').select2();
});
$(document).on('submit', '#addNewForm', function (e) {
  e.preventDefault();
  processingBtn('#addNewForm', '#btnSave', 'loading');

  if ($('#description').summernote('isEmpty')) {
    $('#description').val('');
  }

  $.ajax({
    url: imageSliderSaveUrl,
    type: 'POST',
    data: new FormData($(this)[0]),
    dataType: 'JSON',
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addModal').modal('hide');
        $('#imageSlidersTbl').DataTable().ajax.reload(null, false);
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
$(document).on('click', '.edit-btn', function (event) {
  var imageSliderId = $(event.currentTarget).data('id');
  renderData(imageSliderId);
});

window.renderData = function (id) {
  $.ajax({
    url: imageSliderUrl + id + '/edit',
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#imageSliderId').val(result.data.id);

        if (isEmpty(result.data.image_slider_url)) {
          $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
        } else {
          $('#editPreviewImage').attr('src', result.data.image_slider_url);
          $('#imageSliderUrl').attr('href', result.data.image_slider_url);
          $('#imageSliderUrl').text(view);
        }

        $('#editDescription').summernote('code', result.data.description);
        $('#editModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

$(document).on('submit', '#editForm', function (event) {
  event.preventDefault();
  processingBtn('#editForm', '#btnEditSave', 'loading');

  if ($('#editDescription').summernote('isEmpty')) {
    $('#editDescription').val('');
  }

  var id = $('#imageSliderId').val();
  $.ajax({
    url: imageSliderUrl + id + '/update',
    type: 'POST',
    data: new FormData($(this)[0]),
    dataType: 'JSON',
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editModal').modal('hide');
        $('#imageSlidersTbl').DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#editForm', '#btnEditSave');
    }
  });
});
$(document).on('click', '.addImageSliderModal', function () {
  $('#addModal').appendTo('body').modal('show');
});
$(document).on('click', '.delete-btn', function (event) {
  var imageSliderId = $(event.currentTarget).data('id');
  deleteItem(imageSliderUrl + imageSliderId, '#imageSlidersTbl', 'Image Slider');
});
$('#addModal').on('hidden.bs.modal', function () {
  resetModalForm('#addNewForm', '#validationErrorsBox');
  $('#description').summernote('code', '');
  $('#previewImage').attr('src', defaultDocumentImageUrl);
});
$('#description, #editDescription').summernote({
  minHeight: 200,
  toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough']], ['para', ['paragraph']]]
});

window.displayImage = function (input, selector, validationMessageSelector) {
  var displayPreview = true;

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var image = new Image();
      image.src = e.target.result;

      image.onload = function () {
        if (image.height < 500 || image.width < 1140) {
          $('#imageSlider').val('');
          $(validationMessageSelector).removeClass('d-none');
          $(validationMessageSelector).html(imageSizeMessage).show();
          return false;
        }

        $(selector).attr('src', e.target.result);
        displayPreview = true;
      };
    };

    if (displayPreview) {
      reader.readAsDataURL(input.files[0]);
      $(selector).show();
    }
  }
};

window.isValidImage = function (inputSelector, validationMessageSelector) {
  var ext = $(inputSelector).val().split('.').pop().toLowerCase();

  if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
    $(inputSelector).val('');
    $(validationMessageSelector).removeClass('d-none');
    $(validationMessageSelector).html(imageExtensionMessage).show();
    return false;
  }

  $(validationMessageSelector).hide();
  return true;
};

$(document).on('change', '#imageSlider', function () {
  $('#addModal #validationErrorsBox').addClass('d-none');

  if (isValidImage($(this), '#addModal #validationErrorsBox')) {
    displayImage(this, '#previewImage', '#addModal #validationErrorsBox');
  }
});
$(document).on('change', '#editImageSlider', function () {
  $('#editModal #validationErrorsBox').addClass('d-none');

  if (isValidFile($(this), '#editModal #validationErrorsBox')) {
    displayImage(this, '#editPreviewImage', '#editModal #validationErrorsBox');
  }
});
$(document).on('change', '.isActive', function (event) {
  var imageSliderId = $(event.currentTarget).data('id');
  changeIsActive(imageSliderId);
});

window.changeIsActive = function (id) {
  $.ajax({
    url: imageSliderUrl + id + '/change-is-active',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#imageSlidersTbl').DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

$('.searchIsActive').on('change', function () {
  $.ajax({
    url: imageSliderUrl + 'change-search-disable',
    method: 'post',
    data: $('#searchIsActive').serialize(),
    dataType: 'JSON',
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#imageSlidersTbl').DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

/***/ }),

/***/ 68:
/*!****************************************************************!*\
  !*** multi ./resources/assets/js/image_slider/image_slider.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/image_slider/image_slider.js */"./resources/assets/js/image_slider/image_slider.js");


/***/ })

/******/ });