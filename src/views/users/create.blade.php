@extends('Backoffice::layouts.default')

{{-- Web site Title --}}
@section('title')
    Users
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <h1>Create User</h1>
        </div>
    </div>

    <div class="row">
            <form action="{!! route('backoffice.users.store') !!}"  method="POST" class="form-horizontal" id="formAddRole" >

                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">E-Mail</label>
                    <div class="col-sm-4">
                        <input type="text" name="email" class="form-control" placeholder="E-Mail">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">Password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">Repeat Password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password confirmation">
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" id="submitAddPermission">Go!</button>
                    </div>
                </div>

            </form>
    </div>
    <!--
        The delete button uses Resftulizer.js to restfully submit with "Delete".  The "action_confirm" class triggers an optional confirm dialog.
        Also, I have hardcoded adding the "disabled" class to the Admin group - deleting your own admin access causes problems.
    -->
@stop

