@extends('admin.layouts.base')
@section('title', 'Page'. $page->name)

@section('header')
    <h1>Page {{$page->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Page {{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i
                        class="fa fa-arrow-left"></i> Back</a>
                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.pages.destroy', $page) }}" method="post"
                      class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <li>Title: {{$page->title}}</li>
                <li>Meta title: {{$page->meta_title}}</li>
                <li>Meta description: {{$page->meta_title}}</li>
                <li>Meta keywords: {{$page->meta_title}}</li>
                <li>Sections:
                    <ul>
                        @forelse($page->sections as $section)
                            <li>Key: {{$section['key']}} | Order: {{$section['order']}} |
                                Active: {{$section['active']}}</li>
                        @empty
                            <li>No sections</li>
                        @endforelse
                    </ul>
                </li>
            </ul>
        </div>
    </div>
@endsection
