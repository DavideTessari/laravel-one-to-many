@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Create New Post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control my-3" id="name" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" name="client_name" class="form-control my-3" id="client_name" value="{{ old('client_name') }}">
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
        </div>
        <div class="mb-3">
            <label class="form-label" for="type_id">Type</label>
            <select class="form-select" id="type_id" name="type_id">
                <option value="">Select a type</option>
                @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id')) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea name="summary" class="form-control my-3" id="summary" rows="5">{{ old('summary') }}</textarea>
            @error('summary')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
























