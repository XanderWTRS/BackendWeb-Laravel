@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold my-4">User Management</h1>
        <table class="table-auto mt-10 w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Username</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Admin</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->username }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
                    <td class="border px-4 py-2">
                        @if (!$user->isAdmin)
                        <form action="{{ route('admin.users.makeAdmin', $user) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Make Admin</button>
                        </form>
                        @else
                        <form action="{{ route('admin.users.revokeAdmin', $user) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Revoke Admin</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
