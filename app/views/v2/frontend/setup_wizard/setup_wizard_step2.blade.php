@extends('layout.test')

@section('content')

	@include('partials._notification')

	<h2>Setup Wizard Step 2</h2>
	<hr>
	@if($setup_wizard_step2_data['instruction_type'] == 'video')
		<!-- instruction model -->
		<div class="modal fade" id="videoInstructionModel" tabindex="-1" role="dialog" aria-labelledby="videoInstructionModelLabel" aria-hidden="true" style=" width: 600px;">
			<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h4 class="modal-title" id="myModalLabel">Video Instruction</h4>
		      		</div>
			      	<div class="modal-body">
			      		{{$setup_wizard_step2_data['data']->video_link}}
				    </div>
			    	<div class="modal-footer">
			    		<a href="" class="btn btn-default" id='finish-instruction' data-dismiss="modal">close</a>
			    	</div>
			    </div>
		  	</div>
		</div>
	@else
		{{$setup_wizard_step2_data['data']}}
	@endif

	<!-- Javascript -->
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			@if($setup_wizard_step2_data['instruction_type'] == 'video')
				// see-video-inst
				$('#videoInstructionModel').modal('show');
			@endif
		});
	</script>

@stop