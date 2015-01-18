@extends('layout.test')

@section('content')

	@include('partials._notification')

	<!-- instruction model -->

	<div class="modal fade" id="setupInstructionModel" tabindex="-1" role="dialog" aria-labelledby="setupInstructionModelLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title" id="myModalLabel">See Instruction</h4>
	      		</div>
		      	<div class="modal-body">
		      		<h4>Would you like to see a video or text instruction ?</h4>
			    </div>
		    	<div class="modal-footer">
		    		{{HTML::link("/setup_wizard/step2/".$device_id."/video", "See video instruction", "class='btn btn-default'")}}
		    		{{HTML::link("/setup_wizard/step2/".$device_id."/text", "See text instruction", "class='btn btn-default'")}}
		    	</div>
		    </div>
	  	</div>
	</div>

	<!-- Javascript -->
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#setupInstructionModel').modal('show');
		});
	</script>

@stop