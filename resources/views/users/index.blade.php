@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container">
    <h1 class="mt-4">Profil Saya</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ $user->role }}</td>
        </tr>
    </table>

    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit Profil</a>
</div>
@endsection
