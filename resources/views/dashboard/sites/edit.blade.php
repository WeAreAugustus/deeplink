@extends('layouts.app')

@section('content')
    <h2>Edit Site</h2>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some issues with your input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sites.update', $site->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Site Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $site->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="android_link" class="form-label">Android Link</label>
            <input type="url" name="android_link" class="form-control"
                   value="{{ old('android_link', $site->android_link) }}">
        </div>

        <div class="mb-3">
            <label for="ios_link" class="form-label">iOS Link</label>
            <input type="url" name="ios_link" class="form-control"
                   value="{{ old('ios_link', $site->ios_link) }}">
        </div>

        <div class="mb-3">
            <label for="web_link" class="form-label">Web Link</label>
            <input type="url" name="web_link" class="form-control"
                   value="{{ old('web_link', $site->web_link) }}">
        </div>

        <div class="mb-3">
            <label for="api_key" class="form-label">API Key</label>
            <input type="text" name="api_key" class="form-control"
                   value="{{ old('api_key', $site->api_key) }}" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                   value="1" {{ old('is_active', $site->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>

        <button type="submit" class="btn btn-success">💾 Update</button>
        <a href="{{ route('sites.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
