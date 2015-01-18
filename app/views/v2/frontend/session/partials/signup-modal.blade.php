<!-- Sign up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="signupModalLabel">UnoDNS™ Premium 8-day free trial</h4>
            </div>
            <div class="modal-body">
                <p>Your UnoDNS™ Premium 8-day free trial will give you access to the full UnoDNS™ experience without
                    commitment, no credit card required.</p>

                <br/>

                <div class="modal-alert alert alert-danger hidden">
                    <ul>
                    </ul>
                </div>

                <br/>

                <form class="form-horizontal" method="POST" action="{{ URL::route('user_store') }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="firstname">First Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="First Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="email">Email Address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="password">Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <button type="submit" data-loading-text="Loading..." class="create-account btn btn-custom-small btn-red no-margin no-shadow">
                        Create my Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts_from_partials')

{{ HTML::script('assets/v2/js/signup-controller.js') }}

<script>
    var user_check_email_route = '{{ URL::route('user_check_email') }}';
    $(function() {
        // Initializing Signup Modal
        SignupModal().initialize();
    });
</script>

@stop