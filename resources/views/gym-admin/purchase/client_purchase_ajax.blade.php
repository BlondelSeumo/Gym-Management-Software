<div class="form-group form-md-line-input ">
    <select  class="form-control" name="purchase_id" id="purchase_id">
        @forelse($purchases as $purc)
            @if(!is_null($purc->membership_id))
                <option value="{{$purc->id}}">{{ ucwords($purc->membership->title) }} - [Purchased on: {{$purc->purchase_date->format('d-M')}}]</option>
            @elseif(!is_null($purc->offer_id))
                <option value="{{$purc->id}}">{{ ucwords($purc->offer->title) }}&nbsp;<{{$purc->purchase_date->format('d-M')}}></option>
            @elseif(!is_null($purc->package_id))
                <option value="{{$purc->id}}">{{ ucwords($purc->package->title) }}&nbsp;<{{$purc->purchase_date->format('d-M')}}></option>
            @endif
        @empty
            <option value="">No purchase by this client</option>
        @endforelse
    </select>
    <label for="title">Payment For</label>
    <span class="help-block"></span>
</div>