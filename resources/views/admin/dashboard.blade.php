@extends('layouts.app')

@section('title', 'Admin - Kelola Akun')

@section('content')
<div class="container">
    <h1 class="h3 mb-4">Kelola Akun User</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($users) && count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
    @if($user->last_active_at && \Carbon\Carbon::parse($user->last_active_at)->diffInMinutes(now()) < 5)
        <span class="badge bg-success text-white">Online</span>
    @else
        <span class="badge bg-dark text-white">Offline</span>
    @endif
</td>

                        <td>
                            <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <form action="{{ route('admin.resetPassword', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin mereset password?')">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm">Reset Password</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data pengguna</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
