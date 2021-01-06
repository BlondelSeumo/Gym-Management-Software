<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span></div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">
                <a href="javascript:;" class="waves-effect">
                    @if($customerValues->image =='')
                        <img src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" class="img-circle img-change"/>
                    @else
                        @if($gymSettings->local_storage == '0')
                            <img class="img-circle img-change" src="{{$profilePath.$customerValues->image}}"/>
                        @else
                            <img class="img-circle img-change"
                                 src="{{asset('/uploads/profile_pic/thumb/').'/'.$customerValues->image}}"/>
                        @endif
                    @endif<span class="hide-menu">{{ $customerValues->first_name.' '.$customerValues->last_name }}<span
                                class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('customer-app.profile.index') }}"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="{{ route('customer-app.message.index') }}"><i class="ti-email"></i> Inbox</a></li>
                    <li><a href="{{ route('customer-app.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li><a href="{{ route('customer-app.dashboard.index') }}" class="waves-effect {{ $dashboardMenu or '' }}"><i
                            class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> <span
                            class="hide-menu"> Dashboard </span></a></li>
            <li><a href="{{ route('customer-app.manage-subscription.index') }}"
                   class="waves-effect {{$subscriptionMenu or ''}}"><i class="zmdi zmdi-account zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu"> Subscriptions </span></a></li>
            <li><a href="javascript:;" class="waves-effect {{ $paymentMenu or '' }}"><i
                            class="fa {{ $gymSettings->currency->symbol }}"></i> <span class="hide-menu gap-payments"> Payments <span
                                class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('customer-app.payments.index') }}" class="{{ $paymentSubMenu or '' }}">Payments</a>
                    </li>
                    <li><a href="{{ route('customer-app.payments.due-payments') }}" class="{{ $duePaymentMenu or '' }}">Due
                            Payments</a></li>
                </ul>
            </li>
            <li><a href="{{ route('customer-app.attendance.index') }}" class="waves-effect {{ $attendanceMenu or '' }}"><i
                            class="zmdi zmdi-calendar-check zmdi-hc-fw fa-fw"></i> <span
                            class="hide-menu"> Attendance </span></a></li>
            <li><a href="{{ route('customer-app.message.index') }}" class="waves-effect {{ $messageMenu or '' }}"><i
                            class="zmdi zmdi-email zmdi-hc-fw fa-fw"></i> <span class="hide-menu"> Message </span></a>
            </li>
        </ul>
    </div>
</div>