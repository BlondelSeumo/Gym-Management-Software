@if(count($tasks)>0)

    @foreach($tasks as $task)
        <div class="icon-align" onclick="deleteTask({{ $task->id }})" id="todo-close-{{$task->id}}"><span class="lnr lnr-cross close-icon"></span></div>
        <div class="@if($task->status == 'pending')
            @if($task->priority == 'high')
                    todo-tasklist-item todo-tasklist-item-border-red high-priority-border
            @elseif($task->priority == 'low')
                    todo-tasklist-item todo-tasklist-item-border-red low-priority-border
            @else
                    todo-tasklist-item todo-tasklist-item-border-red medium-priority-border
            @endif
        @elseif($task->status == 'complete')
            @if($task->priority == 'high')
                todo-tasklist-item todo-tasklist-item-border-green success-card high-priority-border
            @elseif($task->priority == 'low')
                todo-tasklist-item todo-tasklist-item-border-green success-card
            @else
                todo-tasklist-item todo-tasklist-item-border-green success-card medium-priority-border
            @endif
        @endif task-{{ $task->id }}" onclick="show({{ $task->id }})" id="todo-container-{{$task->id}}">
            @if($task->merchant->image =='')
                <img class="todo-userpic pull-left" src="{{ asset('/fitsigma/images/').'/'.'user.svg' }}" width="27px" height="27px">
            @else
                <img class="todo-userpic pull-left" src="{{ $profilePath.$task->merchant->image }}" width="27px" height="27px">
            @endif
            <div class="todo-tasklist-item-title success-alert-title"> {{ $task->heading }}  </div>
            <div class="todo-tasklist-item-text"> {{ $task->description }} </div>
            <div class="todo-tasklist-controls pull-left">
                @if (\Carbon\Carbon::createFromFormat('Y-m-d', $task->deadline)->toFormattedDateString() <= \Carbon\Carbon::now()->toFormattedDateString())
                    <span class="todo-tasklist-date fail-alert-date">
                    <i class="fa fa-calendar fail-alert-date"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $task->deadline)->toFormattedDateString() }} </span>
                @else
                    <span class="todo-tasklist-date success-alert-date">
                    <i class="fa fa-calendar success-alert-date"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $task->deadline)->toFormattedDateString() }} </span>
                @endif
            </div>
        </div>
    @endforeach

        <div class="pagination-button-right">
                {{$tasks->links()}}
        </div>

@else
    <div class="row">
        <div class="col-sm-12 review-icon ">
            <h2 class="review-text">Task not assigned</h2>
        </div>
    </div>
@endif
