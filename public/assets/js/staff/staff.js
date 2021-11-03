


var tableName = '#companiesTbl';

        /*callAjax(1);
        return;*/
$(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[1, 'asc']],
  ajax: {
    url: staffUrl,
    data: function data(_data) {
      _data.is_featured = $('#filter_featured').find('option:selected').val();
      _data.is_status = $('#filter_status').find('option:selected').val();
    }
  },
  columnDefs: [{
    'targets': [0],
    'orderable': false,
    'className': 'text-center',
    'width': '5%'
  }, {
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '5%'
  }],
  columns: [{
    data: function data(row) {
        console.log(row)
        return row.user.first_name;
      return '<a href="' + staffUrl + '/' + row.id + '">' + row.user.first_name + '</a>';
    },
    name: 'user.first_name'
  }, {
    data: 'user.email',
    name: 'user.email'
  }, {
    data: function data(row) {
      var checked = row.user.is_active === 0 ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return row.user.role;
    },
    name: 'user.is_active'
  }, {
    data: function data(row) {
      var url = staffUrl + '/' + row.id;
      var data = [{
        'id': row.id,
        'url': url + '/edit'
      }];
      return prepareTemplateRender('#companyActionTemplate', data);
    },
    name: 'id'
  }],
  'fnInitComplete': function fnInitComplete() {
    $('#filter_featured,#filter_status').change(function () {
      $(tableName).DataTable().ajax.reload(null, true);
    });
  }
});

$(document).ready(function () {
  $('#filter_featured').select2({
    width: '170px'
  });
  $('#filter_status').select2();
});
$(document).on('click', '.adminMakeFeatured', function (event) {
  var companyId = $(event.currentTarget).data('id');
  makeFeatured(companyId);
});

window.makeFeatured = function (id) {
  $.ajax({
    url: staffUrl + '/' + id + '/mark-as-featured',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
        displaySuccessMessage(result.message);
        $('[data-toggle="tooltip"]').tooltip('hide');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

        window.callAjax = function (id) {
            $.ajax({
                url: staffUrl,
                method: 'post',
                cache: false,
                success: function success(result) {
                    console.log(result.data);
                    /*if (result.success) {
                        $(tableName).DataTable().ajax.reload(null, false);
                        displaySuccessMessage(result.message);
                        $('[data-toggle="tooltip"]').tooltip('hide');
                    }*/
                },
                error: function error(result) {
                    displayErrorMessage(result.responseJSON.message);
                }
            });
        };

$(document).on('click', '.adminUnFeatured', function (event) {
  var companyId = $(event.currentTarget).data('id');
  makeUnFeatured(companyId);
});

window.revokeVerfication = function(id){
    swal({
        title: 'Verified',
        text: 'Do you want to revoke verification for this company?',
        type: 'info',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }, function () {
        $.ajax({
            url: verificationUrl.replace('*id*', id),
            method: 'post',
            cache: false,
            success: function success(result) {
                if (result.success) {
                    $(tableName).DataTable().ajax.reload(null, false);
                    displaySuccessMessage(result.message);
                    swal.close();
                    //$('[data-toggle="tooltip"]').tooltip('hide');
                }
            },
            error: function error(result) {
                displayErrorMessage(result.responseJSON.message);
                swal.close();
            }
        });
    });
};

window.makeUnFeatured = function (id) {
  $.ajax({
    url: staffUrl + '/' + id + '/mark-as-unfeatured',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
        displaySuccessMessage(result.message);
        $('[data-toggle="tooltip"]').tooltip('hide');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

$(document).on('click', '.delete-btn', function (event) {
  var staffId = $(event.currentTarget).data('id');
  //alert(staffUrl + '/' + staffId);
  deleteItem(staffUrl + '/' + staffId+'/delete', tableName, 'Staff');
});
$(document).on('change', '.isFeatured', function (event) {
  var companyId = $(event.currentTarget).data('id');
  activeIsFeatured(companyId);
});
$(document).on('change', '.isActive', function (event) {
  var companyId = $(event.currentTarget).data('id');
  changeIsActive(companyId);
});

window.changeIsActive = function (id) {
  $.ajax({
    url: staffUrl + '/' + id + '/change-is-active',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};


