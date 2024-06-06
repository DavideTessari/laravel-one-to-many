@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Post</h1>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control my-3" id="name" value="{{ old('name', $post->name) }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" name="client_name" class="form-control my-3" id="client_name" value="{{ old('client_name', $post->client_name) }}">
            @error('client_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input type="file" name="cover_image" class="form-control my-3" id="cover_image">
            @error('cover_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if ($post->cover_image)
                <div>
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->name }}">
                </div>
            @else
                <small>No image</small>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" for="type_id">Type</label>
            <select class="form-select" id="type_id" name="type_id">
                <option value="">Select a type</option>
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id', $post->type_id)) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
                @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </select>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea name="summary" class="form-control my-3" id="summary" rows="5">{{ old('summary', $post->summary) }}</textarea>
            @error('summary')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
