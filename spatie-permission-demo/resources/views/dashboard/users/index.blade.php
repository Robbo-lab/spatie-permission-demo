@extends('layout.app')

@section('title', 'Articles')

@section('content')
<section class="section">
        <div class="container">
            <!-- <h2 class="title is-3">User Management</h2> -->
            
            <table class="table is-fullwidth is-striped is-hoverable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-info btn-sm">
                                    Edit Permissions
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection