@extends('layouts.app')

@section('content')
    <h2>Sites</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Android</th>
            <th>iOS</th>
            <th>Web</th>
            <th>Key</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sites as $site)
            <tr>
                <td>{{ $site->name }}</td>
                <td><a href="{{ $site->android_link }}" target="_blank">Android</a></td>
                <td><a href="{{ $site->ios_link }}" target="_blank">iOS</a></td>
                <td><a href="{{ $site->web_link }}" target="_blank">Web</a></td>
                <td><a href="#" target="_blank"
                       onclick="event.preventDefault(); navigator.clipboard.writeText('{{ $site->api_key }}').then(() => { alert('Copied: {{ $site->api_key }}'); })">
                        ******
                    </a></td>
                <td>{{ $site->is_active ? '✅ Active' : '❌ Inactive' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
