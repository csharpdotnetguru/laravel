<h1>Settings</h1>

<a class="settings_editable" href="/dynamo/edit">Edit</a>
<div>
    @foreach($data as $d)
    <div class="setting">
        <div class="channel">
            <label>Channel:</label> <span class="text"><h4>{{$d->channel->channel}}</h4></span>
        </div>
        <div class="country">
        <label>Country:</label> 
        <span>{{$d->country->code}}</span>
        </div>
    </div>
    @endforeach
</div>