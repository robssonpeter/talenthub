<div class="modal fade bd-example-modal-lg" id="verification-setting" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="documentsViewContent">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__("messages.common.add_note")}}</h5>
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
            </div>
            <div  class="container mx-2 py-2">
                <div v-if="loading">
                    @include('loader')
                </div>
                <form v-else action="" class="container" @submit.prevent="saveDocuments">
                    <div v-if="!documents.length">
                        <span>No required documents have been specified</span>
                        <button class="btn btn-sm btn-primary float-right" @click.prevent="addDocument">Add a required doc</button>
                    </div>
                    <div v-for="(document, index) in documents">
                        <span><strong>Document @{{ index+1 }}</strong></span>
                        <div class="input-group mb-3">
                            <input type="text" @keyup="checkNames" v-model="documents[index].name" class="form-control rounded-0" placeholder="name" required>
                            <input type="text" v-model="documents[index].description" class="form-control rounded-0" placeholder="description" aria-describedby="basic-addon2">
                            <span class="align-self-center"><a href="" @click.prevent="removeDocument(index)" class="form-control text-danger rounded-0"><i class="fas fa-times"></i></a></span>
                        </div>
                    </div>
                    <button class="invisible" id="invisible-document-save">submit</button>
                    <button v-if="documents.length && !no_more" class="btn btn-sm btn-primary float-right" @click.prevent="addDocument">Add another document</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" @click.prevent="clickSubmit" class="btn btn-primary">{{__("messages.common.save")}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.common.close")}}</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script>
    let vue = new Vue({
        el: '#documentsViewContent',
        data: {
            loading: false,
            no_more: false,
            documents: [
                //{name: 'certificate of incorporation', description: 'this is the certficate of incorporation for a company'}
            ]
        },
        methods: {
            checkDocuments: function(){
                this.loading = true;
                $.post(verificationSettings, {retrieve: 1}).done(function(response){
                    vue.documents = JSON.parse(response.data);
                    console.log(JSON.parse(response.data));
                    vue.loading = false;
                });
            },
            clickSubmit: function(){
                document.getElementById('invisible-document-save').click();
                //alert('hellow there');
            },
            saveDocuments: function(){
                /*alert('hi there')
                axios.post(verificationSettings, {documents: JSON.stringify(this.documents)}, (result)=>{
                    console.log(result.data);

                }).catch((error)=>{
                    alert('not done')
                });
                return;*/

                $.post(verificationSettings, {documents: JSON.stringify(this.documents)}).done(function(response){
                    if(response.success){
                        displaySuccessMessage(response.message);
                        $('#verification-setting').modal('hide');
                    }
                });
                return;

                $.ajax({
                    url: verificationSettings,
                    type: 'post',
                    data: this.documents,
                    dataType: 'JSON',
                    contentType: 'application/x-www-form-urlencoded',
                    cache: false,
                    processData: false,
                    success: function success(result) {
                        console.log(result.data);
                    },
                    error: function error(result) {
                        console.log(result);
                        return;
                        displayErrorMessage(result.responseJSON.message);
                    }
                });
            },
            removeDocument: function(index){
                this.documents.splice(index, 1);
                this.checkNames();
            },
            addDocument: function(){
                this.documents.push({name: "", description: ''});
                this.no_more = true;
            },
            checkNames: function(){
                for(let x = 0; x < this.documents.length; x++){
                    if(!this.documents[x].name.length){
                        this.no_more = true;
                        return;
                    }else{
                        this.no_more = false;
                        return;
                    }
                }
            }
        }
    })
</script>
