@extends('gym-admin.setting.master-setting') @push('mail-styles')
<style>
    .mail-credentials-hide {
        display: none;
    }
</style>

@endpush 
@section('settingBody')
<div class="portlet-body">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3">
            <ul class="nav nav-tabs tabs-left">
                <li>
                    <a href="{{ route('gym-admin.setting.index') }}"> General </a>
                </li>
                <li class="active">
                    <a href="javascript:;"> Mail </a>
                </li>
                <li>
                    <a href="{{ route('gym-admin.setting.fileUpload') }}"> File Upload </a>
                </li>
                <li>
                    <a href="{{ route('gym-admin.setting.others') }}"> Others </a>
                </li>
                <li>
                    <a href="{{ route('gym-admin.setting.footer') }}"> Footer </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-9">
            <div class="tab-content">
                {!! Form::open(['route'=>'gym-admin.setting.storeMailCredentials','id'=>'mailCredentialForm','class'=>'ajax-form form-horizontal','method'=>'POST','files'
                => true]) !!}
                <div class="form-body col-md-6 col-md-offset-1">
                    <div class="form-group form-md-line-input">
                        <label class="control-label" for="form_control_1">Mail Driver</label>
                        <select class="form-control" name="mail_driver">
                                        <option @if($merchantSetting !='' && $merchantSetting->mail_driver == 'smtp') selected @endif value="smtp">SMTP</option>
                                        <option @if($merchantSetting !='' && $merchantSetting->mail_driver == 'mail') selected @endif value="mail">Mail</option>
                                    </select>
                        <div class="form-control-focus"> </div>
                    </div>
                    <div class="form-group form-md-line-input mail-credentials @if($merchantSetting !='' && $merchantSetting->mail_driver == 'mail') mail-credentials-hide @endif">
                        <label class="control-label" for="form_control_1">Mail Host</label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" placeholder="Mail Host" id="mail_host" name="mail_host" value="@if($merchantSetting !=''){{ $merchantSetting->mail_host }}@endif">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Enter Mail Host</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input mail-credentials @if($merchantSetting !='' && $merchantSetting->mail_driver == 'mail') mail-credentials-hide @endif">
                        <label class="control-label" for="form_control_1">Mail Port</label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" placeholder="Mail Port" id="mail_port" name="mail_port" value="@if($merchantSetting !=''){{ $merchantSetting->mail_port }}@endif">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Enter Mail Port</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input mail-credentials @if($merchantSetting !='' && $merchantSetting->mail_driver == 'mail') mail-credentials-hide @endif">
                        <label class="control-label" for="form_control_1">Mail Username</label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" placeholder="Mail Username" id="mail_username" name="mail_username" value="@if($merchantSetting !=''){{ $merchantSetting->mail_username }}@endif">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Enter Mail Username</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input mail-credentials @if($merchantSetting !='' && $merchantSetting->mail_driver == 'mail') mail-credentials-hide @endif">
                        <label class="control-label" for="form_control_1">Mail Password</label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" placeholder="Mail Password" id="mail_password" name="mail_password" value="@if($merchantSetting !=''){{ $merchantSetting->mail_password }}@endif">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Enter Mail Password</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input mail-credentials @if($merchantSetting !='' && $merchantSetting->mail_driver == 'mail') mail-credentials-hide @endif">
                        <label class="control-label" for="form_control_1">Mail Encryption</label>
                        <select class="form-control" name="mail_encryption">
                                        <option @if($merchantSetting !='' && $merchantSetting->mail_encryption == 'tls') selected @endif value="tls">TLS</option>
                                        <option @if($merchantSetting !='' && $merchantSetting->mail_encryption == 'ssl') selected @endif value="ssl">SSL</option>
                                    </select>
                        <div class="form-control-focus"> </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="control-label" for="form_control_1">Mail From Name</label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" placeholder="Mail From Name" id="mail_name" name="mail_name" value="@if($merchantSetting !=''){{ $merchantSetting->mail_name }}@endif">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Enter name of company/person</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="control-label" for="form_control_1">Mail From Email</label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" placeholder="Mail From Email" id="mail_email" name="mail_email" value="@if($merchantSetting !=''){{ $merchantSetting->mail_email }}@endif">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Enter email of company/person</span>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="javascript:;" class="btn green" id="mailSettingUpdate">Submit</a>
                            <a href="javascript:;" class="btn default">Cancel</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop @push('mail-scripts')
<script>
    $('#mailSettingUpdate').click(function() {
            $.easyAjax({
                url: '{{ route('gym-admin.setting.storeMailCredentials') }}',
                container: '#mailCredentialForm',
                type: "POST",
                data: $('#mailCredentialForm').serialize()
            });
        });

        $('select[name=mail_driver]').change(function () {
            var driver = $('select[name=mail_driver]').val();
            if(driver == 'mail') {
                $('.mail-credentials-hide').hide();
                $('.mail-credentials').hide();
            } else {
                $('.mail-credentials-hide').show();
                $('.mail-credentials').show();
            }
        });
</script>

@endpush