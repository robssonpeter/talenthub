@if($alertMessage['type'] == 'info')
    <div class="padding-12 alert-info">
        <a href="{{$alertMessage['action']['url']}}" class="btn-xs btn-primary pull-right">{{$alertMessage['action']['name']}}</a>
        <strong>Info:</strong> {{$alertMessage['message']}}
    </div>
@endif
