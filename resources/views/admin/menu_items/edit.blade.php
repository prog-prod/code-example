@extends('admin.layouts.base')
@section('title', 'Edit Menu Item'. $menuItem->name)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.menus.show',$menu) }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Edit Menu Item {{$menuItem->name}}</h1>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            Edit Menu Item {{$menuItem->name}}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.menu_items.update', ['menu_item'=> $menuItem , 'menu_id' => $menu->id]) }}"
                  enctype="multipart/form-data"
                  method="POST">
                @csrf
                @method('PUT')
                <x-form-control attribute="key" :model="$menuItem"/>
                <x-multi-lang-form-control attribute-name="name" :model="$menuItem"/>
                <div class="form-group">
                    <label for="link">Link (Option):</label>
                    <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                           value="{{ old('link', $menuItem->link) }}">
                    @error('link')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <x-adminlte-input-switch name="mega" label="Mega menu (Option):" data-on-text="YES"
                                             data-off-text="NO"
                                             class="form-control @error('mega') is-invalid @enderror"
                                             data-on-color="teal" :checked="!!old('mega', $menuItem->mega)"/>
                    @error('mega')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div id="image-input" class="form-group">
                    <x-adminlte-input-file name="image" label="Image (Optional)"
                    >
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
                @if(count($parents) > 0)
                    <div class="form-group ">
                        <x-adminlte-select2 id="sel2Parent" placeholder="Select parent item"
                                            name="parent_id" :data-allow-clear="true" label="Parent item">
                            <option value="">no parent</option>
                            @include('admin.layouts.option_tree', [
                                        'children' => $parents,
                                        'parents' => [],
                                        'oldValue' => old('parent_id', $menuItem->parent_id),
                                      ])
                        </x-adminlte-select2>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function switchImageDiv() {
            $(this).val(Number($(this).closest('.bootstrap-switch-id-mega').hasClass('bootstrap-switch-on')));
            const imageDiv = $('#image-input');
            if ($(this).val() === '1') {
                imageDiv.find('input').prop('disabled', false);
                imageDiv.show();
            } else {
                imageDiv.find('input').prop('disabled', true);
                imageDiv.hide();
            }
        }

        $.fn.bootstrapSwitch.defaults.onSwitchChange = switchImageDiv;
        $(document).ready(() => {
            switchImageDiv.apply(document.querySelector('input[name="mega"]'));
        });

    </script>
@endsection

