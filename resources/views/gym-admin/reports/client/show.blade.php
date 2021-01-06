<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">User Memberships</span>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <ul>
            @if(!empty($memberships))
            @foreach($memberships as $membership)
                <li>{{$membership}}</li>
            @endforeach
            @else
                No Memberships
            @endif
        </ul>
    </div>
</div>