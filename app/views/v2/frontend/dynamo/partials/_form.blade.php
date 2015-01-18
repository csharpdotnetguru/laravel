{{Form::open(['route'=>['dynamo_update',$uid],'method'=>'put','id'=>'channel_update'])}}
<h2>Dynamo Settings</h2>
<div>
    @foreach($settings as $setting)
    <div class="setting" data-setting="{{$setting['index']}}">
        <div class="channel">
            @if($setting['icon']!='')
                <span>
                    {{HTML::image($setting['icon'])}}
                </span>
            @endif
                <span class="channel_name capitalize">
                    <h3 style="display:inline-block;">{{$setting['channel_name']}}</h3>
                </span>

            @if($setting['subtitle']!="")
            <small>
                {{$setting['subtitle']}}
            </small>
            @endif
            @if($setting['channel_description']!="")
                    <span class="channel_description">
                        {{$setting['channel_description']}}
                    </span>
            @endif
        </div>
        <div class="country capitalize">
            {{Form::label('Country:')}}
                <span>
                    @if(isset($setting['user_flag']) && isset($setting['user_channel']))
                        {{HTML::image($setting['user_flag'])}}
                    @endif
                    {{$setting['user_channel']}}
                </span>
        </div>
        <div class='options'>
                <span class="country_block">
                    @foreach($setting['country'] as $country)
                        <div class="country_info">
                            <input class="ajaxSend" data-index="{{$setting['index']}}"
                                   name="{{$setting['channel_id']}}" type="radio"
                                   value="{{$country['country_id']}}"/>

                            {{HTML::image($country['country_flag'])}}
                            <label class='ajaxSend_label capitalize'
                                   for="{{$setting['channel_id']}}">{{$country['country_name']}}
                            </label>

                            <ul>
                                @foreach($country['content'] as $content)
                                <li>
                                    <a href="{{$content['channel_url']}}">{{$content['channel_name']}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </span>
        </div>
        <hr/>
    </div>
    @endforeach
</div>
<input type="submit" value="Update Dynamo" class="JShide easy_click btn btn-primary"/>
{{Form::close()}}