@foreach($children as $child)
    <option value="{{ $child->id }}"
            @if(is_array($oldValue) ? in_array($child->id,$oldValue) : $oldValue == $child->id) selected @endif>
        @foreach($parents as $parent)
            {{ isset($lang) && $lang ? __($lang.$parent->name) : $parent->name }} -
        @endforeach
        {{ isset($lang) && $lang ? __($lang.$child->name) : $child->name }}
    </option>
    @if($child->children && !in_array($child->id, $child->children->pluck('id')->toArray()))
        @include('admin.layouts.option_tree', ['children' => $child->children, 'parents' => [...$parents, $child]])
    @endif

@endforeach
