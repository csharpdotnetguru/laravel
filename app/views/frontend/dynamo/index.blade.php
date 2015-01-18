<?php
$index = 0;
?>

{{ Form::open(['route' => ['dynamo_update', $uid], 'method' => 'PUT']) }}
<div>
    @foreach($settings as $setting)
    <div class="setting" data-setting="{{$setting['index']}}">
        <div class="channel">
            <span class="channel_name">
                <h3>{{$setting['channel_name']}}</h3>
            </span>
            <span>
                <!--{{$setting['icon']}}-->
            </span>

            <span class="channel_subtitle">
                {{$setting['subtitle']}}
            </span>

            <div class="channel_description">
                {{$setting['channel_description']}}
            </div>
        </div>
        <div class="country">
            {{Form::label('Country:')}}
                    <span>
                        {{$setting['user_channel']}}
                    </span>
        </div>
        <div>
                    <span>
                            @foreach($setting['country'] as $country)
                                <input class="ajaxSend" data-index="{{$setting['index']}}"
                                       name="{{$setting['channel_id']}}" type="radio"
                                       value="{{$country['country_id']}}"/>
                                    <label for="{{$setting['channel_id']}}">{{$country['country_name']}}</label>
                            @endforeach
                    </span>
        </div>
    </div>
    <br/>
    @endforeach
</div>
<input type="submit" value="save" class="JShide"/>
{{Form::close()}}
