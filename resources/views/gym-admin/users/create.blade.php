@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
	{!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
	{!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('content')
	<div class="container-fluid"  >
		<!-- BEGIN PAGE BREADCRUMBS -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="{{ route('gym-admin.users.index') }}">Users</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>Add User</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMBS -->
		<!-- BEGIN PAGE CONTENT INNER -->
		<div class="page-content-inner">
			<div class="row">
				<div class="col-md-7 col-xs-12">

					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption font-dark">
								<i class="icon-plus font-red"></i>
								<span class="caption-subject font-red bold uppercase"> Add User</span>
							</div>
						</div>
						<div class="portlet-body">
							{!! Form::open(['route'=> ['gym-admin.users.store'],'id'=>'profileUpdateForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
							<div class="form-body col-md-6 col-md-offset-1">
								<div class="form-group form-md-line-input">
									<div class="input-icon right">
										<input type="text" class="form-control" placeholder="First Name" name="first_name" id="fisrt_name">
										<div class="form-control-focus"> </div>
										<span class="help-block">Enter first name</span>
										<i class="icon-user"></i>
									</div>
								</div>

								<div class="form-group form-md-line-input">
									<div class="input-icon right">
										<input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Enter last name</span>
										<i class="icon-user"></i>
									</div>
								</div>
								<div class="form-group form-md-radios">
									<label class="control-label" for="form_control_1">Gender</label>
									<div class="md-radio-inline">
										<div class="md-radio">
											<input type="radio" id="male" name="gender" value="male" class="md-radiobtn" checked>
											<label for="male">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Male </label>
										</div>
										<div class="md-radio">
											<input type="radio" id="female" name="gender" value="female" class="md-radiobtn" >
											<label for="female">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Female </label>
										</div>
									</div>
								</div>

								<div class="form-group form-md-line-input">
									<div class="input-icon right">
										<input type="tel" class="form-control" placeholder="Mobile number" id="mobile" name="mobile" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Mobile number</span>
										<i class="fa fa-mobile"></i>
									</div>
								</div>

								<div class="form-group form-md-line-input">
									<div class="input-icon right">
										<input type="email" class="form-control" placeholder="Email" id="email" name="email" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Email address</span>
										<i class="fa fa-envelope"></i>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<div class="input-icon right">
										<input readonly name="date_of_birth" id="date_of_birth" type="text"  class="form-control  date-picker" data-date-format="yyyy-mm-dd"  placeholder="Date of birth" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Enter date of birth</span>
										<i class="fa fa-calendar"></i>
									</div>
								</div>
								<div class="form-group form-md-line-input ">
									<div class="input-icon right">
										<input type="text"  class="form-control" placeholder="Username" name="username" >

										<span class="help-block">This cannot be changed later</span>
										<div class="form-control-focus"> </div>
										<i class="fa fa-users"></i>
									</div>
								</div>

								<div class="form-group form-md-line-input ">
									<div class="input-icon right">
										<input type="password" class="form-control" placeholder="New password" id="password" name="password">

										<span class="help-block">Enter password </span>
										<div class="form-control-focus"> </div>
										<i class="fa fa-key"></i>
									</div>
								</div>
								<hr>
							</div>

							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<a href="javascript:;" class="btn green" id="updateProfile">Submit</a>
										<a href="javascript:;" class="btn default">Cancel</a>
									</div>
								</div>
							</div>
							{!! Form::close() !!}
						</div>
					</div>


				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT INNER -->
	</div>
@stop

@section('footer')
	{!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
	{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
	{!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
	{!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
	{!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
	{!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
	{!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
	<script>

		$('#date_of_birth').datepicker({
			rtl: App.isRTL(),
			orientation: "left",
			autoclose: true,
			endDate: '+0d',
			startView: 'decades'
		});

	</script>
	<script>
		$('#updateProfile').click(function(){
			var url = '{{ route('gym-admin.users.store')}}';
			$.easyAjax({
				url: url,
				container:'#profileUpdateForm',
				type: "POST",
				data: $('#profileUpdateForm').serialize()
			})
		});

	</script>

@stop