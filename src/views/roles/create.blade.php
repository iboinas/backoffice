@extends('Backoffice::layouts.default')

{{-- Web site Title --}}
@section('title')
    Roles
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <h1>Create Role</h1>
        </div>
    </div>

    <div class="row">
            <form action="{!! route('backoffice.roles.store') !!}"  method="POST" class="form-horizontal" id="formAddRole" >

                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">Role Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" placeholder="Name">
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

