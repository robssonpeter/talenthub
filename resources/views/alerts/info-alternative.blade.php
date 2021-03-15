@if($alertMessage['type'] == 'info')
    <div class="padding-12 alert-info d-flex">
        <span class="flex-fill"><strong class="text-da">Info:</strong> {{$alertMessage['message']}}</span>
        <a href="{{$alertMessage['action']['url']}}" class="align-self-center    btn-sm btn-primary pull-right">{{$alertMessage['action']['name']}}</a>
    </div>
@endif
