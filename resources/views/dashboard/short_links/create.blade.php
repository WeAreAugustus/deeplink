@extends('layouts.app')

@section('content')
    <h2>Create Short Link</h2>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Validation failed:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('short-links.store') }}">
        @csrf

        {{-- Generate random code (readonly & disabled in UI) --}}
        @php
            $defaultCode = old('code', Str::random(6));
        @endphp

        <div class="mb-3">
            <label class="form-label">Code (auto-generated)</label>
            <input type="text" class="form-control" value="{{ $defaultCode }}" disabled>
            {{-- Include code as hidden input to send it in POST --}}
            <input type="hidden" name="code" value="{{ $defaultCode }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Web (optional)</label>
            <input type="text" name="web" value="{{ old('web') }}"
                   class="form-control @error('web') is-invalid @enderror">
            @error('web')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Site</label>
            <select name="site_id" class="form-select @error('site_id') is-invalid @enderror" required>
                <option value="">-- Select Site --</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>
                        {{ $site->name }}
                    </option>
                @endforeach
            </select>
            @error('site_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Item Type</label>
            <select name="item_type" class="form-select @error('item_type') is-invalid @enderror" required>
                <option value="">-- Select Type --</option>
                <option value="video" {{ old('item_type') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="show" {{ old('item_type') == 'show' ? 'selected' : '' }}>Show</option>
                <option value="page" {{ old('item_type') == 'page' ? 'selected' : '' }}>Page</option>
            </select>
            @error('item_type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Item Value</label>
            <input type="text" name="item_value" value="{{ old('item_value') }}"
                   class="form-control @error('item_value') is-invalid @enderror" required>
            @error('item_value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
