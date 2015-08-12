@extends('Backoffice::layouts.default')

{{-- Web site Title --}}
@section('title')
    Users
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <div class='btn-toolbar pull-right'>
                <div class='btn-group'>
                    <a class='btn btn-primary' href="{{ route('backoffice.users.create') }}">Create User</a>
                </div>
            </div>
            <h1>Users</h1>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <th>Name</th>
                <th>Roles</th>
                <th>Options</th>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{ route('backoffice.users.show', $user) }}">{{ $user->first_name." ".$user->last_name  }}</a></td>
                        <td>
                            @forelse($user->roles as $role)
                                {!!  $role->name !!}
                            @empty
                                No Roles added.
                            @endforelse


                        </td>

                        <td>
                            <button class="btn btn-default" >Edit</button>
                            <button class="btn btn-default" >Delete</button>
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

