@extends('layouts.admin')

@section('title', 'Ustawienia strony')

@section('content')
    <h1>Ustawienia strony</h1>
    <form method="POST" action="{{ route('settings-admin.update') }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @foreach($fullSettings as $setting)

            @if($setting->settingType == 'text' or $setting->settingType == 'int')
                <label for="{{$setting->settingName}}">{{$setting->displayedName}}:</label>

                @if($setting->description != '')
                    (<small>{!! $setting->description !!}</small>)
                @endif
            @endif

        <div class="form-group">
            @if($setting->settingType == 'boolean')
                <div class="checkbox">
                    <label><input type="checkbox" name="{{$setting->settingName}}" {{ $setting->settingValue==1 ? 'checked': '' }} >{{$setting->displayedName}}</label>
                </div>
            @elseif($setting->settingType == 'int')
                <input type="number" id="{{$setting->settingName}}" name="{{$setting->settingName}}" class="form-control" placeholder="{{$setting->displayedName}}" value="{{$setting->settingValue}}" required>
            @elseif($setting->settingType == 'separator')
                <hr>
            @else
                <input type="text" id="{{$setting->settingName}}" name="{{$setting->settingName}}" class="form-control" placeholder="{{$setting->displayedName}}" value="{{$setting->settingValue}}" required>
            @endif
        </div>
        @endforeach

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a  class="btn btn-danger" href="{{ URL::route('pages-admin.index') }}">Anuluj</a>
        </div>

    </form>
@endsection