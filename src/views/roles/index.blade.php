@extends('Backoffice::layouts.default')

{{-- Web site Title --}}
@section('title')
    Roles
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <div class='btn-toolbar pull-right'>
                <div class='btn-group'>
                    <a class='btn btn-primary' href="{{ route('backoffice.roles.create') }}">Create Role</a>
                </div>
            </div>
            <h1>Roles</h1>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <th>Name</th>
                <th>Permissions</th>
                <th>Options</th>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td><a href="{{ route('backoffice.roles.show', $role) }}">{{ $role->name }}</a></td>
                        <td>
                            <?php
                            $permissions = $role->getPermissions();
                            $keys = array_keys($permissions);
                            $last_key = end($keys);
                            ?>
                            @foreach ($permissions as $key => $value)
                                {{ ucfirst($key) . ($key == $last_key ? '' : ', ') }}
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-default">Edit</button>
                            <button class="btn btn-default">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--
        The delete button uses Resftulizer.js to restfully submit with "Delete".  The "action_confirm" class triggers an optional confirm dialog.
        Also, I have hardcoded adding the "disabled" class to the Admin group - deleting your own admin access causes problems.
    -->
@stop

