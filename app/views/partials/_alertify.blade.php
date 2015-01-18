@section('scripts_from_partials')
<script>
    $(function() {
        @foreach(['danger', 'alert', 'success', 'info'] as $type)
            @if(Session::get($type))
            		<?php 
            			$alertify_type = $type;
            			if($type == 'danger') {
            				$alertify_type = 'error';
            			}
            		?>
                    alertify.{{  $alertify_type  }}('{{ Session::get($type) }}');
            @endif
        @endforeach
    });
</script>
@stop
