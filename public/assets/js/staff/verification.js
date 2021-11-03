$(document).ready(function(){
    //alert('helloe tr')
    //displaySuccessMessage('done');
    //processingBtn('#verifyForm', '#btn-submit-verification', 'loading');
});

$(document).on('submit', '#verifyForm', function (e) {
    e.preventDefault();
    processingBtn('#verifyForm', '#btn-submit-verification', 'loading');
    $.ajax({
        url: saveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function success(result) {
            displaySuccessMessage(uploadSuccess);
            setTimeout(function(){
                location.reload();
            }, 2000);
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function complete() {
            //processingBtn('#addNewExperienceForm', '#btnExperienceSave');
            processingBtn('#verifyForm', '#btn-submit-verification');
        }
    });
});

$(document).on('change', '.attachment', function(e){
    let type = e.target.name;
    let id = e.target.id;
    let index = id.replace('attachment-', '');
    let file = e.target.files || e.dataTransfer.files;
    console.log(file[0]);
    if(file.length){
        let formData = new FormData();
        formData.append('attachment', file[0]);
        axios.post(uploadUrl, formData, {
            headers: {
                'Content-type' : 'multipart/form-data'
            },
            onUploadProgress: function(progressEvent) {
                let progress = document.getElementById('resume-progress-'+index);
                var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                progress.style.width = percentCompleted+"%";
                console.log(percentCompleted)
            }
        }).then(function(response){
            let progress = document.getElementById('resume-progress-'+index);
            //progress.style.width = '0%';
            $('#uploaded_file_'+index).val(response.data.saved);
            //displaySuccessMessage(uploadSuccess);
            console.log(response.data);
        }).catch(error => {
            console.log(error.response.data)
            let progress = document.getElementById('resume-progress-'+index);
            progress.style.width = '0%';
            $('#attachment-'+index).val('');
            displayErrorMessage(error.response.data.message);

            //console.log(error.response.data.errors.attachment);
        })
    }
})
