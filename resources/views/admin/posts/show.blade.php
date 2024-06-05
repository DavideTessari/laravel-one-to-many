@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Post Details</h1>
    <div class="card">
        <div class="card-header">
            <h5>{{ $post->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $post->name }}</p>
            <p><strong>Slug:</strong> {{ $post->slug }}</p>
            <p><strong>Client Name:</strong> {{ $post->client_name }}</p>
            <p><strong>Summary:</strong> {!! $post->summary !!}</p>
            <p><strong>Created At:</strong> {{ $post->created_at }}</p>
            @if ($post->cover_image)
                <div class="my-4">
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->name }}" class="img-fluid">
                </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning my-2">Edit</a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
