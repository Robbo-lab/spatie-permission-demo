@extends('layout.app')

@section('title', 'Edit User Permissions')

@section('content')
    <section class="section">
        <div class="container">
            <!-- <h2 class="title is-3">Edit Permissions for {{ $user->name }}</h2> -->

            <form action="{{ route('users.updatePermissions', $user) }}" method="POST">
                @csrf

                <div class="field">
                    <label class="tag is-info">{{$user->name}}</label>
                    <div class="control">
                        @foreach($permissions as $permission)
                            <label class="checkbox">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="btn btn-warning btn-sm mt-2 mb-2">Update Permissions</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('users.index') }}" class="btn btn-info btn-sm mt-2">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection