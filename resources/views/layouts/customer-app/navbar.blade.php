<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part">
            <a class="logo" href="{{ route('customer-app.dashboard.index') }}">
                <span class="hidden-xs">
                    @if(is_null($gymSettings))
                        {!! HTML::image(asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red-white.png', 'Logo',array("class" => "logo-style")) !!}
                    @else
                        @if($gymSettings->customer_logo != '')
                            @if($gymSettings->local_storage == '0')
                                {!! HTML::image($gymSettingPath.$gymSettings->customer_logo, 'Logo',array("class" => "logo-style")) !!}
                            @else
                                {!! HTML::image(asset('/uploads/gym_setting/master/').'/'.$gymSettings->customer_logo, 'Logo',array("class" => "logo-style")) !!}
                            @endif
                        @else
                            {!! HTML::image(asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red-white.png', 'Logo',array("class" => "logo-style")) !!}
                        @endif
                    @endif
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-bell"></i>
                    <div class="notify">@if($unreadNotifications > 0)<span class="heartbit"></span><span class="point"></span>@endif</div>
                </a>
                <ul class="dropdown-menu mailbox scale-up">
                    <li>
                        <div class="drop-title">You have {{ $unreadNotifications }} new notifications</div>
                    </li>
                    <li>
                        <div class="message-center">
                            @foreach($notifications as $notification)
                                <a href="javascript:;">
                                    <div class="user-img"> <img src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>{!! $notification['notification_type'] !!}</h5>
                                        <span class="mail-desc">{{ $notification['title'] }}</span> </div>
                                </a>
                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a class="text-center mark-read"> <strong>Mark as Read</strong> <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    @if($customerValues->image =='')
                        <img src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" width="36" class="img-circle img-change" />
                    @else
                        @if($gymSettings->local_storage == 0)
                            <img class="img-circle img-change" width="36" src="{{$profilePath.$customerValues->image}}" />
                        @else
                            <img class="img-circle img-change" width="36" src="{{asset('/uploads/profile_pic/thumb/').'/'.$customerValues->image}}" />
                        @endif
                    @endif<b class="hidden-xs">{{ $customerValues->first_name }}</b>
                </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    <li><a href="{{ route('customer-app.profile.index') }}"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="{{ route('customer-app.message.index') }}"><i class="ti-email"></i> Inbox</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('customer-app.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>