<div class="modal fade bd-example-modal-lg show" id="show-template" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__("messages.common.view_template")}}</h5>
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
            </div>
            <div id="templateContent" class="container mx-2 py-2">

                {{--<div class="d-flex flex-row mr-3 py-2">
                    <span><strong>Peter:</strong></span>
                    <span class="flex-fill ml-2">This is a bad application it should be rejected right now, and a lot of people are asking whether we should make this happen</span>
                </div>
                <div class="d-flex flex-row mr-3 py-2">
                    <span><strong>Peter:</strong></span>
                    <span class="flex-fill ml-2">This is a bad application it should be rejected right now, and a lot of people are asking whether we should make this happen</span>
                </div>--}}
                {{--<div class="text-center d-none" id="notes-loader">
                    <svg class="loader-position" width="150px" height="75px" viewBox="0 0 187.3 93.7"
                         preserveAspectRatio="xMidYMid meet">
                        <path stroke="#00c6ff" id="outline" fill="none" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"
                              stroke-miterlimit="10"
                              d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z"/>
                        <path id="outline-bg" opacity="0.05" fill="none" stroke="#f5981c" stroke-width="5" stroke-linecap="round"
                              stroke-linejoin="round" stroke-miterlimit="10"
                              d="				M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z"/>
                    </svg>
                </div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary invisible" id="save-note">{{__("messages.common.save")}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.common.close")}}</button>
            </div>
        </div>
    </div>
</div>
<script>
    /*function showLoader(){
        document.getElementById('notes-loader').classList.remove('d-none');
    }

    function hideLoader(){
        document.getElementById('notes-loader').classList.add('d-none');
    }*/

    function loadContent(content){
        document.getElementById('notesContent').innerHTML = content;
    }
</script>
