    @extends('layouts.gym-merchant.gymbasic')

    @section('CSS')
        {!! HTML::style('admin/apps/css/todo-2.css') !!}
        {!! HTML::style('admin/admin/layout3/css/custom.min.css') !!}
        {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
        {!! HTML::style('admin/global/plugins/select2/select2.min.css') !!}
        {!! HTML::style('admin/global/plugins/select2/select2-bootstrap.min.css') !!}
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <style>
            .todo-tasklist {
                position: relative;
            }
            .close-icon {
                color: #868282;
                cursor: pointer;
            }
            .icon-align {
                position: absolute;
                right: 11px;
                margin-top: 12px;
            }
            .success-card {
                background-color: rgba(3, 218, 119, 0.42);
                color: white;
                border-left: #00a65a 4px solid;
            }
            .success-alert-title {
                color: #49504d;
            }
            .success-alert-date {
                color: #49494a !important;
            }
            .fail-alert-date {
                color: #e43a45 !important;
            }
            .success-badge {
                background-color: #00a65a;
            }
            .alert-badge {
                background-color: #e43a45;
            }
            .todo-tasklist-date i {
                color: #5d686f !important;
            }
            div .todo-tasklist-item.alert-card:hover {
                background-color: rgba(232, 58, 69, 0.32);
            }
            div .todo-tasklist-item.success-card:hover {
                background-color: rgba(3, 218, 119, 0.42);
            }
            .todo-tasklist-item-text {
                color: #4c4d4e;
            }
            .high-priority-border {
                border-left: #e43a45 4px solid;
            }
            .medium-priority-border {
                border-left: #f0ad4e 4px solid;
            }
            .low-priority-border {
                border-left: #00a65a 4px solid;
            }
            .task-title {
                font-weight: 700;
                font-size: 17px;
                color: #54575a;
                margin-bottom: 18px;
                text-transform: uppercase;
            }
            .number-of-days-input {
                width: 68%;
                float: right;
            }
            .select2-container .select2-selection--single.reset-class {
                height: 33px;
                padding-top: 1px;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow b {
                top: 62%;
            }
            .sort-distance {
                padding-right: 8px !important;
            }
            .add-task-btn {
                display: none;
            }
        </style>
    @stop

    @section('content')
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE BREADCRUMBS -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Task</span>
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="todo-ui">
                                <!-- BEGIN TODO CONTENT -->
                                <div class="todo-content">
                                    <div class="portlet light ">
                                        <!-- PROJECT HEAD -->
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-tasks font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Task</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filters
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li onclick="taskLoad()">
                                                            <a href="javascript:;" data-pk="pending"> Pending</a>
                                                        </li>
                                                        <li onclick="taskLoad()">
                                                            <a href="javascript:;" data-pk="complete"> Completed </a>
                                                        </li>
                                                        <li onclick="taskLoad()">
                                                            <a href="javascript:;" data-pk=""> All Task </a>
                                                        </li>
                                                        <li class="divider"> </li>
                                                        <li onclick="taskLoad()">
                                                            <a href="javascript:;" data-pk="low"> Low Priority </a>
                                                        </li>
                                                        <li onclick="taskLoad()">
                                                            <a href="javascript:;" data-pk="medium"> Medium Priority </a>
                                                        </li>
                                                        <li onclick="taskLoad()">
                                                            <a href="javascript:;" data-pk="high"> High Priority </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="actions sort-distance">
                                                <div class="btn-group">
                                                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Sort By
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li onclick="sortBy()">
                                                            <a href="javascript:;" data-sk="new"> Last Added </a>
                                                        </li>
                                                        <li onclick="sortBy()">
                                                            <a href="javascript:;" data-sk="deadline"> Due Date </a>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="sort" id="sort">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end PROJECT HEAD -->
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-4">
                                                    <div class="todo-tasklist" id="task-populate">
                                                        <!--Data come from loadmoretaskcard blade-->
                                                    </div>
                                                </div>
                                                <div class="todo-tasklist-devider"> </div>
                                                <div class="col-md-6 col-md-offset-1 col-sm-8">
                                                    <div class="task-title"><span id="change-task">Add</span> Task</div>
                                                    <form id="create-edit-task" class="form-horizontal">
                                                        <!-- TASK HEAD -->
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <div class="col-md-8 col-sm-8">
                                                                    <div class="todo-taskbody-user">
                                                                        @if($user->image =='')
                                                                            <img src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" class="todo-userpic pull-left" width="50px" height="50px"/>
                                                                        @else
                                                                            <img src="{{$profilePath.$user->image}}" class="todo-userpic pull-left" width="50px" height="50px"/>
                                                                        @endif
                                                                        <span class="todo-username pull-left">{{ $user->first_name }} {{ $user->last_name }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 add-task-btn">
                                                                    <div class="todo-taskbody-date pull-right">
                                                                        <button type="button" class="todo-username-btn btn btn-circle btn-default btn-sm" onclick="addTask();return false;">&nbsp; Add Task <i class="fa fa-plus"></i> &nbsp;</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- END TASK HEAD -->
                                                            <!-- TASK TITLE -->
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <label>Title</label>
                                                                    <input type="text" id="heading" name="heading" class="form-control todo-taskbody-tasktitle" placeholder="Task Title..."> </div>
                                                            </div>
                                                            <!-- TASK DESC -->
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <label>Description</label>
                                                                    <textarea id="description" name="description" class="form-control todo-taskbody-taskdesc" rows="8" placeholder="Task Description..."></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- END TASK DESC -->
                                                            <!-- TASK DUE DATE -->
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <label>Deadline</label>
                                                                    <div class="input-icon">
                                                                        <i class="fa fa-calendar"></i>
                                                                        <input type="text" id="deadline" readonly name="deadline" class="form-control todo-taskbody-due" placeholder="Due Date..."> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 0">
                                                                <div class="col-md-6">
                                                                    <div class="mt-checkbox-list">
                                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                                            Remind Me
                                                                            <input class="checkbox" value="1" type="checkbox" id="reminder" name="reminder">
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" style="display: none;" id="days-show">
                                                                    <div class="input-group number-of-days-input">
                                                                        <input type="number" class="form-control" name="numberOfDays" min="0" max="99">
                                                                        <span class="input-group-addon" id="basic-addon2">days before</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- TASK TAGS -->
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <label>Status</label>
                                                                    <select class="form-control todo-taskbody-tags" id="task-status" name="status">
                                                                        <option></option>
                                                                        <option value="pending">Pending</option>
                                                                        <option value="complete">Completed</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- TASK TAGS -->
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <label>Priority</label>
                                                                    <select class="form-control todo-taskbody-tags" id="task-priority" name="priority">
                                                                        <option></option>
                                                                        <option value="low">Low</option>
                                                                        <option value="medium">Medium</option>
                                                                        <option value="high">High</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions right todo-form-actions">
                                                                <button class="btn btn-circle btn-sm green" id="add-update-btn" onclick="addUpdate();return false;">Save Changes</button>
                                                                <button class="btn btn-circle btn-sm btn-default">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END TODO CONTENT -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT-->
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Remove Task</h4>
                    </div>
                    <div class="modal-body"> Do you want to delete task ? </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="button" class="btn red" id="deleteBtn">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @stop

    @section('footer')
        {!! HTML::script('admin/apps/scripts/todo-2.min.js') !!}
        {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
        {!! HTML::script('admin/global/plugins/bootstrap-daterangepicker/moment.min.js') !!}
        {!! HTML::script('admin/global/plugins/select2/select2.js') !!}
        <script>
            $(document).ready(function() {
                $('#task-status').select2({
                    placeholder: "Status"
                });

                $('#task-priority').select2({
                    placeholder: "Priority"
                });

                taskLoad(1);
            });

            $(document).on('click', '.pagination a', function (e) {
                taskLoad($(this).attr('href').split('page=')[1]);
                $("html, body").animate({ scrollTop: 0 }, 600);
                e.preventDefault();
            });

            function sortBy() {
                $('#sort').val(event.target.getAttribute('data-sk'));
                taskLoad();
            }

            //Populate the task card
            function taskLoad(page) {
                var data;
                var sort = $('#sort').val();

                if(page != '1') {
                    data = event.target.getAttribute('data-pk');
                }

                $.ajax({
                    type: 'GET',
                    url: "{{ route('gym-admin.task.loadmoretask') }}",
                    cache: false,
                    data: {
                        'page': page,
                        'data': data,
                        'sort': sort
                    }
                }).done(
                    function( response ) {
                        $('#task-populate').html(response);
                        $("[data-pk], [data-sk]").each(function(){
                            $(".fa-check").remove();
                        });
                        $("[data-pk='" + data + "']").append('<i class="fa fa-check"></i>');
                        $("[data-sk='" + sort + "']").append('<i class="fa fa-check"></i>');
                    }
                );
            }

            //Show function run when click on any card for edit
            function show(id) {
                var url = '{{ route('gym-admin.task.edit',':id') }}';
                url = url.replace(':id',id);

                $.easyAjax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        var data = response.taskDetail;
                        $('#heading').val(data.heading);
                        $('#description').val(data.description);
                        $('#deadline').val(moment(data.deadline).format('l'));
                        $('#task-status').val(data.status).trigger('change');
                        $('#task-priority').val(data.priority).trigger('change');
                        $('#add-update-btn').val(data.id);
                        $('<input>').attr({
                            id: 'method',
                            type: 'hidden',
                            name: '_method',
                            value: 'PUT'
                        }).appendTo('#create-edit-task');
                        $('#change-task').html('edit');
                        $('.add-task-btn').show();
                    }
                });
            }

            //Function used for store and update task.
            function addUpdate() {
                var id = $("#add-update-btn").val();
                var url;
                if(id == '') {
                    url = '{{ route('gym-admin.task.store') }}';
                } else {
                    url = '{{ route('gym-admin.task.update',':id') }}';
                    url = url.replace(':id',id);
                }

                $.easyAjax({
                    url: url,
                    type: "POST",
                    data: $('#create-edit-task').serialize(),
                    success: function(response) {
                        if(response.status == 'success') {
                            $('#heading').val('');
                            $('#description').val('');
                            $('#deadline').val('');
                            $('#task-status').prop('selectedIndex',0).trigger('change');
                            $('#task-priority').prop('selectedIndex',0).trigger('change');
                            $('#method').remove();
                            $('#add-update-btn').val('');
                        }
                    }
                });
            }

            //Function used to delete task.
            function deleteTask(id) {
                $('#deleteModal').modal('show');
                var url = '{{ route('gym-admin.task.destroy',':id') }}';
                url = url.replace(':id',id);
                $('#deleteModal').find("#deleteBtn").off().click(function () {
                    $.easyAjax({
                        url: url,
                        type: "DELETE",
                        success: function(response) {
                            $('#deleteModal').modal('hide');
                            $("#todo-close-"+id).remove();
                            $("#todo-container-"+id).remove();
                        }
                    });
                });

            }

            //Function to clear all the data if present
            function addTask() {
                $('#heading').val('');
                $('#description').val('');
                $('#deadline').val('');
                $('#task-status').prop('selectedIndex',0).trigger('change');
                $('#task-priority').prop('selectedIndex',0).trigger('change');
                $('#method').remove();
                $('#add-update-btn').val('');
                $('#change-task').html('add');
                $('.add-task-btn').hide();
            }

            //Function for days hide/show
            $('#reminder').click(function() {
                $('#days-show')[this.checked ? "show" : "hide"]();
            });
        </script>
    @stop