<h3>New Network</h3>
<hr/>

<div class="row">
    <div class="col-sm-11">
        <!-- Removed uid parameter -->
        {{ Form::open(['route' => 'network_store', 'method' => 'POST', 'role' => 'form']) }}

        <div class="form-group">
            {{ Form::label('network_name', 'Network Name') }}
            {{ Form::text('network_name', Input::old('network_name'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('ip_address', 'IP Address') }}
            <div>
                {{ Form::text('ip1', Input::old('ip1'), array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }} .
                {{ Form::text('ip2', Input::old('ip2'), array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }} .
                {{ Form::text('ip3', Input::old('ip3'), array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }} .
                {{ Form::text('ip4', Input::old('ip4'), array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }}
            </div>
        </div>

        <div class="checkbox">
            <label for="ip_status">
                {{ Form::checkbox('ip_status', 1, true) }} Activate
            </label>
        </div>

        {{ Form::submit('Add Network', array('class' => 'btn btn-primary', 'name' => 'add_network')) }}

        {{ Form::close() }}
    </div>
</div>