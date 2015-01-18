<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign in</title>

        {{ HTML::style('assets/v2/lib/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('assets/alertify/themes/alertify.core.css') }}
        {{ HTML::style('assets/alertify/themes/alertify.default.css') }}
        {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
        {{ HTML::script('assets/alertify/lib/alertify.min.js') }}
        <style>
            #password {
                display: none;
            }
            .alert-danger {
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 class="page-header">
                <img src="/checkout/check1.gif" />
            </h1>

            <h2>Login to purchase</h2>

            @include('partials._notification')

            @if(Session::has('show_resend_confirmation_button'))
            <div class="alert">
                <a class="btn btn-success btn-sm resend-confirmation" href="{{ URL::route('user_resend_confirmation') }}"><i class="glyphicon glyphicon-repeat"></i> Send Confirmation</a>
            </div>
            @endif

            {{ Form::open(['route' => ['checkout_login_auth'], 'method' => 'POST', 'id' => 'checkout_login', 'class'=> 'form-horizontal']) }}
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="input01">E-mail</label>
                        <div class="controls">
                            <input type="text" name='email' class="form-control" id="input01" value='{{ Input::old('email') }}'>
                            <p class="help-block">Enter your e-mail address</p>
                        </div>
                    </div>


                            <label class="control-label" for="input01">Password</label>
                        <div class="controls">

                            <input type="password" name='password' class="form-control" id="input01">
                            <p class="help-block">Your UnoTelly password</p>
                                         </div>


                @if($show_recaptcha === TRUE)
                    <div class="form-group">
                        <label for="recaptcha" class="col-sm-3 control-label">
                            <h4>Are you human?</h4>
                        </label>

                        <div class="col-sm-9 signin-input-container">
                        <?php
                                require_once(app_path().'/libs/recaptchalib.php');
                                $publickey = Config::get('app.recaptcha_public_key');
                                echo recaptcha_get_html($publickey,null,true);
                        ?>
                        </div>
                    </div>
                @endif

                    <br/>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Sign in using our secure server</button>
                        <label>
                             <a href="{{ URL::route('user_create') }}" class="btn btn-success" role="button">I don't have an UnoTelly account.</a>
                        </label>
                        <a class="btn" href="http://www.unotelly.com/portal/pwreset.php" target="_BLANK">Forgot my password</a>
                    </div>
                </fieldset>
            {{ Form::close() }}
        </div>

        <script>

        $(function() {
            $('.register').change(function () {
                $('#password').fadeOut();
            });

            $('.signin').change(function () {
                $('#password').fadeIn();
            });
        });
        </script>
    </body>
</html>