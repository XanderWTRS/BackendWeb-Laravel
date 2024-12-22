<h1>User Management</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
            <td>
                @if (!$user->isAdmin)
                <form action="{{ route('admin.users.makeAdmin', $user) }}" method="POST">
                    @csrf
                    <button type="submit">Make Admin</button>
                </form>
                @else
                <form action="{{ route('admin.users.revokeAdmin', $user) }}" method="POST">
                    @csrf
                    <button type="submit">Revoke Admin</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
