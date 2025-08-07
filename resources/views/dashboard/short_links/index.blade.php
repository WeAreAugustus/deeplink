@extends('layouts.app')

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Short Links</h2>
        <a href="{{ route('short-links.create') }}" class="btn btn-primary">➕ Create Short Link</a>
    </div>

    @if($shortLinks->isEmpty())
        <div class="alert alert-info">No short links available.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle" id="shortLinksTable">
                <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Copy Link</th>
                    <th>Web</th>
                    <th>Site</th>
                    <th>Item Type</th>
                    <th>Item Value</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($shortLinks as $link)
                    @php
                        $details = json_decode($link->details, true);
                        $shortUrl = url($link->code);
                    @endphp
                    <tr>
                        <td><strong>{{ $link->code }}</strong></td>
                        <td>
                            <button
                                class="btn btn-sm btn-outline-secondary"
                                onclick="navigator.clipboard.writeText('{{ $shortUrl }}').then(() => {
                                    alert('Copied: {{ $shortUrl }}');
                                })"
                            >
                                📋 Copy
                            </button>
                        </td>
                        <td>
                            @if($link->web)
                                <a href="{{ $link->site->web_link . $link->web }}" target="_blank">
                                    {{ $link->site->web_link . $link->web }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $link->site->name ?? '—' }}</td>
                        <td>{{ $details['item_type'] ?? '—' }}</td>
                        <td>{{ $details['item_value'] ?? '—' }}</td>
                        <td>{{ $link->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('short-links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this link?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#shortLinksTable').DataTable({
                pageLength: 10,
                order: [],
                columnDefs: [
                    { orderable: false, targets: [1, 7] } // Disable sort for "Copy Link" and "Actions"
                ]
            });
        });
    </script>
@endpush
