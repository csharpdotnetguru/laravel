@foreach([ 'error', 'danger', 'alert', 'success', 'info' ] as $type)
    @if(strlen(Session::get($type)) > 0)
    <div class="alert alert-{{ $type }}">
        <p align='center'>{{ Session::get($type) }} </p>
    </div>
    @endif
@endforeach

@include('partials._alertify')

@if($errors->has())
<div class="alert alert-danger">
    <ul class="unstyled">
        {{ $errors->first('firstname', '<li>:message</li>') }}
        {{ $errors->first('lastname', '<li>:message</li>') }}

        {{ $errors->first('email', '<li>:message</li>') }}
        {{ $errors->first('username', '<li>:message</li>') }}
        {{ $errors->first('password', '<li>:message</li>') }}
        {{ $errors->first('tweet', '<li>:message</li>') }}
        {{ $errors->first('network_name', '<li>:message</li>') }}
        {{ $errors->first('ip1', '<li>:message</li>') }}
        {{ $errors->first('ip2', '<li>:message</li>') }}
        {{ $errors->first('ip3', '<li>:message</li>') }}
        {{ $errors->first('ip4', '<li>:message</li>') }}
        {{ $errors->first('hostname', '<li>:message</li>') }}
        {{ $errors->first('address1', '<li>:message</li>') }}
        {{ $errors->first('city', '<li>:message</li>') }}
        {{ $errors->first('state', '<li>:message</li>') }}
        {{ $errors->first('country', '<li>:message</li>') }}
        {{ $errors->first('postcode', '<li>:message</li>') }}
        {{ $errors->first('new_password', '<li>:message</li>') }}
    </ul>
</div>

<script>
    $(document).ready(function(){
        alertify.error(""+
        "{{ $errors->first('network_name', '<p>:message</p>') }}"+
        "{{ $errors->first('ip1', '<p>:message</p>') }}"+
        "{{ $errors->first('ip2', '<p>:message</p>') }}"+
        "{{ $errors->first('ip3', '<p>:message</p>') }}"+
        "{{ $errors->first('ip4', '<p>:message</p>') }}"+
        "{{ $errors->first('username', '<p>:message</p>') }}"+
        "{{ $errors->first('password', '<p>:message</p>') }}"+
        "{{ $errors->first('hostname', '<p>:message</p>') }}"+
        "");
    });
</script>

@endif