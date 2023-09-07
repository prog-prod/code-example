@foreach($locales as $locale)
    <div class="form-group">
        @if($formControlType === 'input')
            @if($label)
                <label for="{{$label}}">{{$label}} {{$locale->name}}</label>
            @else
                <label for="{{$attributeName}}_{{$locale->value}}">
                    {{ucfirst($attributeLabel)}} {{$locale->name}}</label>
            @endif

            <input type="{{$inputType}}" class="form-control" id="{{$attributeName}}_{{$locale->value}}"
                   name="{{$attributeName}}_{{$locale->value}}"
                   value="{{old("{$attributeName}_$locale->value", $model?->trans($attributeName, $locale->value))}}"
                   placeholder="Enter {{$attributeLabel}}...">
        @elseif($formControlType === 'textarea')
            @if($label)
                <label for="{{$label}}">{{$label}} {{$locale->name}}</label>
            @else
                <label for="{{$attributeName}}_{{$locale->value}}">
                    {{ucfirst($attributeLabel)}} {{$locale->name}}</label>
            @endif
            <textarea class="form-control @error($attributeName) is-invalid @enderror"
                      id="{{$attributeName}}_{{$locale->value}}"
                      placeholder="Enter {{$attributeLabel}}..."
                      name="{{$attributeName}}_{{$locale->value}}"
            >{{  old("{$attributeName}_$locale->value", $model?->trans($attributeName, $locale->value)) }}</textarea>
        @elseif($formControlType === 'adminlte-text-editor')
            <x-adminlte-text-editor id="{{$attributeName}}_{{$locale->value}}" :config="$textEditorConf"
                                    name="{{$attributeName}}_{{$locale->value}}"
                                    :label=" $label ? $label. ' '. $locale->name : ucfirst($attributeLabel).' '.$locale->name">
                {!! old($attributeName.'_'.$locale->value, $model?->trans($attributeName, $locale->value)) !!}
            </x-adminlte-text-editor>
        @endif
        @error($attributeName)
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach
