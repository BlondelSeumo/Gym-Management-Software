@extends('layouts.merchant.locked')

@section('content')

    <div class="page-lock">
        <div class="page-logo">
            <a class="brand" href="javascript:;">
            @if(is_null($gymSettings))
                {!! HTML::image(asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png', 'Fitsigma',['class' => 'img-responsive']) !!}
            @else
                @if($gymSettings->image != '')
                    @if($gymSettings->local_storage == '0')
                        {!! HTML::image($gymSettingPath.$gymSettings->image, 'Fitsigma',array('class' => 'img-responsive')) !!}
                    @else
                        {!! HTML::image(asset('/uploads/gym_setting/master/').'/'.$gymSettings->image, 'Fitsigma',array('class' => 'img-responsive')) !!}
                    @endif
                @else
                    {!! HTML::image(asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png', 'Fitsigma',['class' => 'img-responsive']) !!}
                @endif
            @endif
        </div>
        <div class="page-body">
            @if($userValue->image == '')
                <img class="page-lock-img" src="{{ asset('/fitsigma/images/').'/'.'user.svg' }}" alt="">
            @elseif($gymSettings->local_storage == '0')
                <img class="page-lock-img" src="{{ $profileHeaderPath.$userValue->image }}" alt="">
            @else
                <img class="page-lock-img" src="{{asset('/uploads/profile_pic/master/').'/'.$userValue->image}}" alt="">
            @endif
            <div class="page-lock-info">
                <h1>{{ $userValue->first_name }}</h1>
                <span class="email"> {{ $userValue->email }} </span>
                <span class="locked"> Locked </span>
                {!! Form::open(array('route' => ['merchant.lockLogin'], 'method' => 'POST', "id" => "login-form", "class" => 'form-inline')) !!}
                    <div id="error-message"></div>
                    <div class="input-group input-medium">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="input-group-btn">
                                <button type="submit" class="btn green icn-only">
                                    <i class="fa fa-arrow-circle-o-right size-icon"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                    <div class="relogin">
                        <a href="{{ route('merchant.logout') }}"> Not {{ $userValue->first_name }} ? </a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="page-footer-custom"> {{ \Carbon\Carbon::now('Asia/Calcutta')->year }} &copy; Fitsigma </div>
    </div>


@stop