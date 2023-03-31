<div>
    <label for="">State<span class="text-danger">*</span></label>
    <select name="state" id="state" class="form-control">
        @foreach($states as $state)
            <option value="{{$state->id}}">{{$state->name}}</option>
        @endforeach
    </select>
    @error('state') <i class="text-danger">{{$message}}</i>@enderror
</div>
