@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-summernote/summernote.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}

    <style>
        .email-template-list {
            background: #fdfdfd;
            border-bottom: 1px solid #e8e8e8;
        }

        #email-template-html{
            border: 1px solid #ccc8c8;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{route('gym-admin.email-promotion.index')}}">Email Promotions</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Campaign</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">


            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-paper-plane font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Email Promotion</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div id="select-template-section">
                                <h3>Select Email Template To Use</h3>
                                <hr>
                                @foreach($emailTemplates as $template)
                                    <div class="email-template-list template-div-{{ $template->id }}"

                                         @if($campaignDetail->template_id == $template->id)
                                         style="background-color: #4db"
                                            @endif
                                    >
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1" style="padding-top: 6%">
                                                    <div class="md-checkbox has-info" style="margin-left: 50%;">
                                                        <input type="checkbox" name="template_id"

                                                               @if($campaignDetail->template_id == $template->id)
                                                                       checked
                                                               @endif

                                                               value="{{ $template->id }}"
                                                               id="template-{{ $template->id }}"
                                                               class="md-check">
                                                        <label for="template-{{ $template->id }}">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9" style="padding-top: 4%">
                                                    <h4 class="sbold col-md-12">{{ ucwords($template->template_name) }}</h4>

                                                    <div class="col-md-8">
                                                        {{ ucfirst($template->description) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding: 10px 0">
                                                    <div class="mt-element-card mt-element-overlay">
                                                        <div class="row">
                                                            <div class="col-xs-10 col-xs-offset-1">
                                                                <div class="mt-card-avatar mt-overlay-1">
                                                                    <img src="{{ asset('admin/gym-email-template/'.$template->image) }}"
                                                                         class="img-reponsive">

                                                                    <div class="mt-overlay">
                                                                        <ul class="mt-info">
                                                                            <li>
                                                                                <a class="btn red btn-outline preview-template"
                                                                                   data-template-id="{{ $template->id }}"
                                                                                   href="javascript:;">
                                                                                    <i class="icon-magnifier"></i>
                                                                                    Preview
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach

                                <hr>
                                <div class="col-md-offset-10">
                                    <a href="javascript:;" class="btn blue-chambray btn-lg btn-block"
                                       id="edit-campaign">NEXT <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>

                            <div id="template-content-section" style="display: none">
                                <h3>Campaign Setup</h3>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="javascript:;" class="btn red-mint btn-lg" id="select-template"><i
                                                    class="fa fa-arrow-left"></i> back</a>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="campaign_name"
                                                       name="campaign_name" value="{{ $campaignDetail->campaign_name }}">

                                                <div class="form-control-focus"></div>
                                                <span class="help-block">Enter campaign name</span>
                                                <label for="campaign_name">Campaign Name</label>
                                            </div>
                                        </div>

                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="email_title"
                                                       name="email_title" value="{{ $campaignDetail->email_title }}">

                                                <div class="form-control-focus"></div>
                                                <span class="help-block">Enter Email Heading</span>
                                                <label for="email_title">Email Heading</label>
                                            </div>
                                        </div>

                                        <div class="form-body">
                                            <label for="summernote_1">Email Content</label>

                                            <div class="form-group form-md-line-input">
                                                <div name="summernote" id="summernote_1">{!! $campaignDetail->email_content !!}</div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-center">Live Preview</h3>

                                        <div id="email-template-html">

                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-offset-8 col-md-4 text-right">
                                        <a href="javascript:;" class="btn blue-chambray btn-lg"
                                           id="save-campaign"><i class="fa fa-save"></i> SAVE Draft</a>

                                        <a href="javascript:;" class="btn green btn-lg "
                                           id="select-recipient">SeLECT recipient <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>

                            <div id="select-recipient-section" style="display: none">
                                <h3>Select Recipients</h3>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="javascript:;" class="btn red-mint btn-lg" id="select-recipient-back"><i
                                                    class="fa fa-arrow-left"></i> back</a>
                                        <hr>
                                    </div>
                                </div>

                                {!! Form::open(['id'=>'sendPromotionForm','class'=>'ajax-form']) !!}

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input ">
                                                <select  class="bs-select form-control" data-live-search="true" data-size="8" name="filter" id="filter">
                                                    <option value="all">Select All</option>
                                                    <option value="manual">Manually Select</option>
                                                    <option value="random">Select Random</option>
                                                    <option value="male">Select all Male</option>
                                                    <option value="female">Select all Female</option>
                                                </select>
                                                <label for="title">Filter</label>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label" id="random_div" style="display: none">
                                                <input type="text" class="form-control" id="random" name="random">
                                                <label for="form_control_1">No of random records</label>
                                                <span class="help-block">Please enter number of random records.</span>
                                            </div>

                                            <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $campaignDetail->id }}">

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="targetDataTable">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="promotion_table">
                                            <thead>
                                            <tr>
                                                <th class="max-desktop"> # </th>
                                                <th class="desktop"> Name </th>
                                                <th class="desktop"> Email </th>
                                                <th class="desktop"> Mobile </th>
                                                <th class="desktop"> Age </th>
                                                <th class="desktop"> Gender </th>
                                            </tr>
                                            </thead>

                                        </table>                                        <!-- END EXAMPLE TABLE PORTLET-->
                                    </div>
                                </div>
                                {!! Form::close() !!}

                                <hr>
                                <div class="row">
                                    <div class="col-md-offset-8 col-md-4 text-right">
                                        <a href="javascript:;" class="btn blue-chambray btn-lg"
                                           id="save-campaign"><i class="fa fa-save"></i> SAVE Draft</a>

                                        <a href="javascript:;" class="btn green btn-lg "
                                           id="send-email-promotion"><i class="fa fa-send"></i> Send now</a>
                                    </div>
                                </div>

                            </div>

                            <div id="campaign-complete" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12 text-center margin-top-75">
                                        <h1>
                                            <i style="font-size: 3em" class="icon-check font-dark"></i>
                                        </h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h1 class="sbold font-dark">Yay! Emails sent successfully!</h1>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="{{route('gym-admin.dashboard.index')}}" class="btn green"> Show All Campaigns <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
    </div>


    <div class="modal fade bs-modal-md in" id="previewModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{--End Modal--}}



@stop

@section('footer')
    {!! HTML::script('admin/global/scripts/datatable.js') !!}
    {!! HTML::script('admin/pages/scripts/table-datatables-managed.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-summernote/summernote.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    <script>

        var campaignName = $('#campaign_name');
        var emailHeading = $('#email_title');
        var emailContent = $('#summernote_1');
        var saveCampaign = $('#save-campaign');
        var selectRecipient = $('#select-recipient');

        $('.preview-template').click(function () {
            var templateId = $(this).data('template-id');
            var show_url = '{{route('gym-admin.email-promotion.preview-template',['#templateId'])}}';
            var url = show_url.replace('#templateId', templateId);
            $('#modelHeading').html('Preview Template');
            $.ajaxModal("#previewModal", url);
        });

        $("input[name = 'template_id']").click(function () {
            var selectedTemplate;
            if ($(this).is(':checked')) {

                selectedTemplate = $(this).val();
            }

            $("input[name='template_id']").each(function () {
                if ($(this).val() != selectedTemplate) {
                    $('.template-div-' + $(this).val()).css('background-color', '#fdfdfd');
                    $(this).removeAttr('checked');
                }
                $('.template-div-' + selectedTemplate).css('background-color', '#4db');
            });

        });

        $('#edit-campaign').click(function () {

            if( $("input[name='template_id']:checked").length == 0){
                $.showToastr('Please Select a Template','error');
                return false;
            }

            var templateId = $("input[name='template_id']:checked").val();

            var url = '{{ route('gym-admin.email-promotion.show',[':id']) }}';
            url = url.replace(':id',templateId);
            $.easyAjax({
                url : url,
                type:'GET',
                success:function(response)
                {
                    $('#email-template-html').html(response.html);

                    if(response.logo){
                        $('#email-logo-html').attr('src', response.logo);
                    }

                    $('#select-template-section').hide();

                    $('#email-template-html').find('#email-content-html').html($("#summernote_1").code());
                    $('#email-template-html').find('#email-heading-html').html(emailHeading.val());

                    $('#template-content-section').fadeIn();
                }
            })

        });

        $('#select-template').click(function () {

            $('#template-content-section').hide();
            $('#select-template-section').fadeIn();
        });

        $('#select-recipient-back').click(function () {
            $('#select-recipient-section').hide();
            $('#template-content-section').fadeIn();
        });

        saveCampaign.click(function () {
            var url = '{{ route('gym-admin.email-promotion.store') }}';
            $.easyAjax({
                url : url,
                type:'POST',
                data: {
                    campaign_name: $('#campaign_name').val(),
                    email_title: $('#email_title').val(),
                    email_content: $("#summernote_1").code(),
                    template_id: $("input[name='template_id']:checked").val(),
                    campaign_id: $('#campaign_id').val()
                }
            })
        });

        selectRecipient.click(function () {
            var url = '{{ route('gym-admin.email-promotion.store') }}';
            $.easyAjax({
                url : url,
                type:'POST',
                data: {
                    campaign_name: $('#campaign_name').val(),
                    email_title: $('#email_title').val(),
                    email_content: $("#summernote_1").code(),
                    template_id: $("input[name='template_id']:checked").val(),
                    select_recipient: true,
                    campaign_id: $('#campaign_id').val()
                },
                success:function(response)
                {
                    if(response.status = 'success'){
                        $('#campaign_id').val(response.campaignId);
                        $('#template-content-section').hide();
                        $('#select-recipient-section').fadeIn();
                    }
                }
            })
        });

        var ComponentsEditors = function () {

            var handleSummernote = function () {

                $('#summernote_1').summernote({
                    onkeydown: function(e) {
                        $('#email-template-html').find('#email-content-html').html($("#summernote_1").code());
                    },
                    onkeyup: function(e) {
                        $('#email-template-html').find('#email-content-html').html($("#summernote_1").code());
                    },
                    onToolbarClick: function(e) {
                        $('#email-template-html').find('#email-content-html').html($("#summernote_1").code());
                    },
                    height: 550,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'strikethrough', 'clear']],
                        ['fontname', ['fontname']],
                        // ['fontsize', ['fontsize']], // Still buggy
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'hr']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
                //API:
                //var sHTML = $('#summernote_1').code(); // get code
                //$('#summernote_1').destroy(); // destroy
            }

            return {
                //main function to initiate the module
                init: function () {
                    handleSummernote();
                }
            };

        }();

        //        Show live preview
        emailHeading.keyup(function () {
            $('#email-template-html').find('#email-heading-html').html(emailHeading.val());
        });

    </script>
    <script>
        $('#filter').change(function(){
            var filter = $('#filter option:selected').val();
            load_data_table(filter);
            if(filter == 'random')
            {
                $('#random_div').css('display','block');
            }else{
                $('#random_div').css('display','none');
            }

        });

        $('#send-email-promotion').click(function () {
            var filter = $('#filter option:selected').val();
            if(filter == 'random')
            {
                var random_num = $('#random').val();
                if(random_num !='')
                {
                    ajaxPromotion();
                }else {
                    $('#random_div').addClass('has-error');
                    $.showToastr('Random Records field  is required','error');
                }
            }else{
                ajaxPromotion();
            }

        });

        function ajaxPromotion() {
            $('#random_div').removeClass('has-error');
            $.easyAjax({
                'url':'{{ route('gym-admin.email-promotion.sendPromotion') }}',
                'container':"#sendPromotionForm",
                'type':'POST',
                'data':$('#sendPromotionForm').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        $('#select-recipient-section').hide();
                        $('#campaign-complete').fadeIn();
                    }
                }
            })
        }

        function load_data_table(id){
            var table = $('#promotion_table');
            var url = '{{route('gym-admin.promotion.ajax-create',['#id'])}}';
            url = url.replace('#id',id);
            table.dataTable({
                responsive: true,
                "serverSide": true,
                "processing": true,
                "ajax": url,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true, "width": "20%"  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": false }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "No records found",
                    "infoFiltered": "(filtered1 from _MAX_ total records)",
                    "lengthMenu": "Show _MENU_",
                    "search": "Search:",
                    "processing": "<i class='fa fa-spinner faa-spin animated'></i> Processing",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                }
            });
        }

        jQuery(document).ready(function() {
            ComponentsEditors.init();
            load_data_table('all');
        });
    </script>
@stop