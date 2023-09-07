<div class="row align-items-center colors-images-item">
    <div class="col-1">
        <a href="#" class="remove-colors-images-item mr-3"><i
                class="fa fa-trash text-danger "></i></a>
    </div>
    <div class="col-11">
        <div class="row">
            <div class="col-sm-4">
                <x-adminlte-select2 id="sel2Colors_{{$productColor->id}}"
                                    label="Color"
                                    name="colors[]"
                                    :config="array_merge($config_select2,['placeholder' => 'Select color'])"
                                    required>
                    @foreach($colors as $color)
                        <option
                            value="{{$color->id}}" {{ $color->id === $productColor->id ? 'selected' : '' }}>{{$color->name}}</option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="col-sm-8 ">
                <div class="row">
                    <div class="col-sm-12">
                        <x-adminlte-input-file id="ifMultiple" name="images[{{$productColor->id}}][]"
                                               label="Upload files"
                                               placeholder="Choose multiple files..." multiple>
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-file-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.products.components.main-image-and-sort-images-blocks',[
                                                   'product' => $product
                                               ])
    </div>
</div>
