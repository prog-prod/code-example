<div class="form-group">
    @if(!is_null($label))
        <label for="{{$attribute}}"
               class="col-form-label">{{$label}}</label>
    @else
        <label for="{{$attribute}}"
               class="col-form-label">{{ __(str_replace(['-','_'], ' ', ucfirst($attribute))) }}</label>
    @endif
    @if($formControlType === 'input')
        <input id="{{$attribute}}" type="{{$inputType}}"
               placeholder="Enter {{str_replace(['-','_'], ' ', ucfirst($attribute))}}..."
               class="form-control @error('key') is-invalid @enderror" name="{{$attribute}}"
               value="{{ old($attribute, $model?->{$attribute}) }}"
               @if($multiple) multiple @endif
               @if($required) required @endif
               @if($readonly) readonly @endif
               autocomplete="{{$attribute}}" autofocus>
    @elseif($formControlType === 'textarea')
        <textarea id="{{$attribute}}"
                  placeholder="Enter {{str_replace(['-','_'], ' ', ucfirst($attribute))}}..."
                  class="form-control @error('key') is-invalid @enderror" name="{{$attribute}}"
                  @if($required) required @endif
                  @if($readonly) readonly @endif
                  autocomplete="{{$attribute}}"
                  autofocus>{{old($attribute, $model?->{$attribute} ? (string)$model?->{$attribute} : $value) }}</textarea>
    @endif

    @error($attribute)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
