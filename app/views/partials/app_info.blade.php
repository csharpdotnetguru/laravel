@if(Config::get('app.debug') === true)

<style>
    /* Adding top margin to make sure we see the whole page below the red bar */
    body {
        margin-top: 20px !important;
    }
</style>

<div class="fixed-debug-banner row-fluid">
    <div class="col-xs-4 text-center">
        Environment: <strong>{{ App::environment() }}</strong>
    </div>

    @if(App::environment('development'))
    <div class="col-xs-4 text-center">
        Release: <strong>Local</strong>
    </div>
    @else
    <div class="col-xs-4 text-center">
        Release: <strong><span title="{{ ReleaseHelper::getReleaseNumber() }}">{{ date('r', strtotime(ReleaseHelper::getReleaseNumber())) }}</span></strong>
    </div>
    @endif

    <div class="col-xs-4 text-center">
        <strong>{{ Route::currentRouteAction()  }}</strong>
    </div>

</div>

@endif