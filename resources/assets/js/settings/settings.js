'use strict';

$(document).on('change', '#logo', function () {
    if (isValidFile($(this), '#validationErrorsBox')) {
        displayPhoto(this, '#logoPreview');
    }
});

window.displayFavicon = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                if ((image.height != 16 || image.width != 16) &&
                    (image.height != 32 || image.width != 32)) {
                    $('#favicon').val('');
                    $('#validationErrorsBox').removeClass('d-none');
                    $('#validationErrorsBox').
                        html('The image must be of pixel 16 x 16 and 32 x 32.').
                        show();
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

window.isValidFavicon = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'ico']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: gif, ico, png.').
            show();
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

$(document).on('change', '#favicon', function () {
    $('#validationErrorsBox').addClass('d-none');
    if (isValidFavicon($(this), '#validationErrorsBox')) {
        displayFavicon(this, '#faviconPreview');
    }
});
$(document).on('click', '#btn-reset', function () {
    location.reload();
});

$('#facebookUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#twitterUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#googleUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#linkedInUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#editFrontSettingForm').submit(function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
});
$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();

    $('#editForm').
        find('input:text:visible:first').
        focus();

    let facebookUrl = $('#facebookUrl').val();
    let twitterUrl = $('#twitterUrl').val();
    let googlePlusUrl = $('#googlePlusUrl').val();
    let linkedInUrl = $('#linkedInUrl').val();

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let googlePlusExp = new RegExp(
        /^(https?:\/\/)?(plus\.)?(google\.[a-z]{2,3})\/?(([a-zA-Z 0-9._])?).*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
        facebookExp) ? true : false));
    if (!facebookCheck) {
        displayErrorMessage('Please enter a valid Facebook Url');
        return false;
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false));
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter Url');
        return false;
    }
    let googlePlusCheck = (googlePlusUrl == '' ? true : (googlePlusUrl.match(
        googlePlusExp) ? true : false));
    if (!googlePlusCheck) {
        displayErrorMessage('Please enter a valid Google Plus Url');
        return false;
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false));
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin Url');
        return false;
    }
    $('#editForm')[0].submit();

    return true;
});
