<div class="form-group">
    @if($label)
        <label for="active">{{$label}}</label>
    @endif
    <select class="form-control" id="{{$attribute}}"
            name="{{$attribute}}">
        @foreach($values ?? ["Ні", "Так"] as $key => $value)
            <option value="{{$key}}"
                    @if($key == old($attribute, $model?->{$attribute} ?? '')) selected @endif>{{$value}}</option>
        @endforeach
    </select>
</div>
