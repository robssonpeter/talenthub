'use strict';

let tableName = '#educationInstitutionsTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: educationInstitutionUrl,
    },
    columnDefs: [
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return row.name;
            },
            name: 'name',
        },
        {
            data: function (row) {
                return row.country_name;
            },
            name: 'country_name',
        },
        {
            data: function (row) {
                let data = [{ 'id': row.id }];
                return prepareTemplateRender(
                    '#salaryCurrencyActionTemplate',
                    data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.addSalaryCurrencyModal', function () {
    $('#addModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewForm', '#btnSave', 'loading');
    $.ajax({
        url: educationInstitutionSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, true);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addNewForm', '#btnSave');
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    let salaryCurrencyId = $(event.currentTarget).data('id');
    renderData(salaryCurrencyId);
});

window.renderData = function (id) {
    $.ajax({
        url: salaryCurrencyUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#salaryCurrencyId').val(result.data.id);
                $('#editCurrencyName').val(result.data.currency_name);
                $('#editCurrencyIcon').val(result.data.currency_icon);
                $('#editModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    processingBtn('#editForm', '#btnEditSave', 'loading');
    const id = $('#salaryCurrencyId').val();
    $.ajax({
        url: salaryCurrencyUrl + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, true);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#editForm', '#btnEditSave');
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let salaryCurrencyId = $(event.currentTarget).data('id');
    deleteItem(salaryCurrencyUrl + salaryCurrencyId, tableName,
        'Salary Currency');
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});
