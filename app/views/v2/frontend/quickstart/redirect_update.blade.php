@extends('layout.v2.home')

@if(!is_null($origin))
<meta http-equiv='refresh' content='2;url={{$origin}}'>
@endif


@section('stylesheets')
	@include('v2.frontend.partials._grid-page-common-css')

@stop

@section('content')

<div class="remodal quickstart-modal redirect-update" data-remodal-id="redirect-update">

	<div class='row'>
		<div class='col-sm-12 text-center'>
			<h1>Updating IP... You will be redirected in 5 seconds.</h1>
		</div>
	</div>


</div>


<style>
	.redirect-update {
	}

</style>



</div>


	@section('scripts')
		
	@include('v2.frontend.partials._grid-page-common-js')
	<script type="text/javascript">
		$(function () {
            var inst = $.remodal.lookup[$('.redirect-update')
            .data('remodal')];
            inst.open();  
		});
	</script>

	@stop
@stop