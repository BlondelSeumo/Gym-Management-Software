@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/fancybox/source/jquery.fancybox.css') !!}
    {!! HTML::style('admin/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') !!}
    {!! HTML::style('admin/global/plugins/jquery-file-upload/css/jquery.fileupload.css') !!}
    {!! HTML::style('admin/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
@stop

@section('content')
    <div class="container-fluid"      >
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Media</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            @if($user->can("add_media"))
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'gym-admin.media.store','id'=>'fileupload','method'=>'POST','file'=>true]) !!}
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="154998037">
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn green fileinput-button">
                                                    <i class="fa fa-plus"></i>
                                                    <span> Add files... </span>
                                                    <input type="file" name="files" > </span>
                            <button type="reset" class="btn warning cancel">
                                <i class="fa fa-ban-circle"></i>
                                <span> Cancel upload </span>
                            </button>
                            <button type="button" class="btn red delete">
                                <i class="fa fa-trash"></i>
                                <span> Delete </span>
                            </button>
                            <input type="checkbox" class="toggle">
                            <!-- The global file processing state -->
                            <span class="fileupload-process"> </span>
                        </div>
                        <!-- The global progress information -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                            </div>
                            <!-- The extended global progress information -->
                            <div class="progress-extended"> &nbsp; </div>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped clearfix">
                        <tbody class="files"> </tbody>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-camera font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Media</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">

                            </div>
                            <table class="table-100 table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>

                                    <th class="max-desktop"> Title </th>
                                    <th class="desktop"> Type </th>
                                    <th class="desktop"> Status </th>
                                    <th class="desktop"> Uploaded On </th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
    {{--Modal Start--}}


    {{--End Modal--}}
@stop

@section('footer')
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-upload fade">
                    <td>
                        <span class="preview"></span>
                    </td>
                    <td>
                        <p class="name">{%=file.name%}</p>
                        <strong class="error text-danger label label-danger"></strong>
                    </td>
                    <td>
                        <p class="size">Processing...</p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                    </td>
                    <td> {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn blue start" disabled>
                            <i class="fa fa-upload"></i>
                            <span>Start</span>
                        </button> {% } %} {% if (!i) { %}
                        <button class="btn red cancel">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button> {% } %} </td>
                </tr>
        {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview"> {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                            <img src="{%=file.thumbnailUrl%}">
                        </a> {% } %} </span>
                </td>
                <td>
                    <p class="name"> {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                        <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                    <div>
                        <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td> {% if (file.deleteUrl) { %}
                    <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {%
                        } %}>
                        <i class="fa fa-trash-o"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
                    <button class="btn yellow cancel btn-sm">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </button> {% } %} </td>
            </tr> {% } %}
</script>
    {!! HTML::script('admin/global/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/vendor/load-image.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js') !!}
    {!! HTML::script('admin/pages/scripts/form-fileupload.js') !!}
    {!! HTML::script('admin/global/scripts/datatable.js') !!}

    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}

    <script>
            function loadDataTable() {
                var table = $('#sample_1');

                // begin first table
                table.dataTable({
                    responsive: true,
                    "sAjaxSource": "{{ route('gym-admin.media.ajax_create') }}",
                    "bDestroy": true,
                    "aoColumns": [
                        {'sClass': 'center', "bSortable": true},
                        {'sClass': 'center', "bSortable": true, "bSearchable": true},
                        {'sClass': 'center', "bSortable": true},
                        {'sClass': 'center', "bSortable": true}
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
                        "zeroRecords": "No matching records found",
                        "paginate": {
                            "previous": "Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },

                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                    // So when dropdowns used the scrollable div should be removed.
                    "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                    "columnDefs": [{
                        "targets": 0,
                        "orderable": false,
                        "searchable": false
                    }],

                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ] // set first column as a default sort by asc
                });
            }
            $(document).ready(function(){
                loadDataTable();
            });

            $('#fileupload').bind('fileuploaddone', function (e, data) {
                loadDataTable();
            });

    </script>

@stop