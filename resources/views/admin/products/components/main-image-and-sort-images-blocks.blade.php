<div class="main-image-and-sort-images-block">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Main image:</label>

                <div class="upload-preview">
                    @foreach($product?->images ?? [] as $key => $image)
                        <div class="custom-control custom-radio mb-2">
                            <input class="custom-control-input" type="radio" id="customRadio_{{$key}}"
                                   name="main-image"
                                   @if($product?->mainImage?->basename === $image->basename) checked
                                   @endif
                                   value="{{$image->basename}}">
                            <label for="customRadio_{{$key}}"
                                   class="custom-control-label"> <img
                                    src="{{Storage::url($image->filename)}}" alt=""
                                    width="75px"></label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Images order:</label>
                <input type="hidden" class="image-order-input" name="images_order"
                       value="{{$product?->images->pluck('basename')->implode(',') ?? ''}}"

                >
                <div class="orderable-container">
                    @foreach($product?->images ?? [] as $key => $image)
                        <img src="{{Storage::url($image->filename)}}" alt="" width="100px"
                             data-id="{{$image->basename}}" data-order="{{$image->order}}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
