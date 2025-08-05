@extends('layouts.app')

@section('content')
    <h2>Create Site</h2>

    {{-- Display global error alert --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('sites.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Android Link</label>
            <input name="android_link" class="form-control @error('android_link') is-invalid @enderror"
                   value="{{ old('android_link') }}" required>
            @error('android_link')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">iOS Link</label>
            <input name="ios_link" class="form-control @error('ios_link') is-invalid @enderror"
                   value="{{ old('ios_link') }}" required>
            @error('ios_link')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Web Link</label>
            <input name="web_link" class="form-control @error('web_link') is-invalid @enderror"
                   value="{{ old('web_link') }}" required>
            @error('web_link')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Create</button>
    </form>
@endsection
