
<h4>New Network</h4>

<!-- Removed uid parameter -->
{{ Form::open(['route' => ['network_store'], 'method' => 'POST']) }}

 <p>
{{ Form::label('network_name', 'Network Name') }}
{{ Form::text('network_name', Input::old('network_name')) }}
</p>

 <p>
{{ Form::label('ip_address', 'IP Address') }}
{{ Form::text('ip1', Input::old('ip1'), array('maxlength' => '3','class'=>'autotab ipbox')) }} .
{{ Form::text('ip2', Input::old('ip2'), array('maxlength' => '3','class'=>'autotab ipbox')) }} .
{{ Form::text('ip3', Input::old('ip3'), array('maxlength' => '3','class'=>'autotab ipbox')) }} .
{{ Form::text('ip4', Input::old('ip4'), array('maxlength' => '3','class'=>'autotab ipbox')) }}

</p>

<p class="inline">
{{ Form::label('ip_status', 'Activate') }}

{{ Form::checkbox('ip_status', 1, true) }}
</p>


{{ Form::submit('Add Network', array('class' => 'btn btn-primary', 'name' => 'add_network')) }}

{{ Form::close() }}

