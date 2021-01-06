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

        hr{
            max-width: 100% !important;
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
                <span>View Campaign</span>
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


                            <div id="template-content-section" >

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat red-mint">
                                            <div class="visual">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number"> {{ $campaign->no_of_emails }} </div>
                                                <div class="desc">Emails Sent </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue-soft">
                                            <div class="visual">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $campaign->sent_on)->format('d M, y') }} </div>
                                                <div class="desc">Sent On </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="text-center">Sent Email Preview</h3>

                                        <div id="email-template-html">
                                            <?php
                                            $message = str_replace('/%%/HEADING/%%/', ucwords($campaign->email_title), $campaign->template->html_template);
                                            $message = str_replace('/%%/CONTENT/%%/', ucfirst($campaign->email_content), $message);
                                            $message = str_replace('/%%/COPYRIGHT/%%/', \Carbon\Carbon::today('Asia/Calcutta')->year.'. '.ucwords($common_details->title), $message);
                                            ?>

                                            {!! $message !!}
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('gym-admin.email-promotion.index') }}" class="btn blue btn-lg"
                                          ><i class="fa fa-arrow-left"></i> Back to all campaigns</a>

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
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-summernote/summernote.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
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
            // begin first table
            table.DataTable({
                "sAjaxSource": url,
                bDestroy:true,
                scrollY:        300,
                deferRender:    true,
                scroller:       true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": false },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [-1],
                    ["All"] // change per page values here
                ]
            });
        }

        jQuery(document).ready(function() {
            ComponentsEditors.init();
            load_data_table('all');
        });
    </script>
@stop