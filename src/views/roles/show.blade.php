@extends('Backoffice::layouts.default')

{{-- Web site Title --}}
@section('title')
    Roles
@stop

{{-- Content --}}
@section('content')

    {{--{!! dd($role) !!}--}}

    <br><br><br>

    <div class="row">
        <div class="col-lg-12">


            <h4 style="width: 160px; text-align: right;"> Role data </h4>

            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{!! $role->id !!}</dd>
                <dt>Slug</dt>
                <dd>{!! $role->slug !!}</dd>
                <dt>Name</dt>
                <dd>{!! $role->name !!}</dd>
                <dt>Created at</dt>
                <dd>{!! $role->created_at !!}</dd>
                <dt>Updated at</dt>
                <dd>{!! $role->updated_at !!}</dd>
            </dl>



            <br><br><br>


            <h4>  Add Permission </h4>

            <form action="{!! route('backoffice.role.permission.manage',['id'=>$role->id , 'action' => 'add']) !!}"
                  method="POST" class="form-horizontal" id="formAddPermission" >

                {!! csrf_field() !!}

                <input type="hidden" name="role_id" value="{!! $role->id !!}" >

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">Permission Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="permission_type" class="col-sm-2 control-label text-right">Permission Type</label>
                    <div class="col-sm-4 radio-group">

                        <div class="radio">
                            <label>
                                <input type="radio" name="permission_type" value="true">
                                True
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="permission_type" value="false">
                                False
                            </label>
                        </div>

                        <div class="radio-error-container"></div>


                    </div>
                </div>

                <br>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" id="submitAddPermission">Go!</button>
                    </div>
                </div>

            </form>


            <br><br><br>


            <h4 style="width: 160px; text-align: right;"> Permissions </h4>


            <div class="row">
                <div class="col-sm-8">

                    <table class="table table-striped table-hover">
                        <tr>
                            <th> Name  </th>
                            <th> Allow </th>
                            <th> Action </th>
                        </tr>
                        @forelse($role->permissions as $key => $value)
                            <tr>

                                <?php ($value=="true") ? $class = "success" : $class = "danger" ?>

                                <td class="{!! $class !!}">{!! $key !!}</td>

                                <td class="{!! $class !!}">{!! $value !!}</td>

                                <td align="right">
                                    @if($value != "true")
                                    <a href="{!! route('backoffice.role.permission.manage',['id'=>$role->id , 'action' => 'true', 'permission' => $key ]) !!}" class="btn btn-success">Change to True</a>
                                    @endif
                                    @if($value != "false")
                                    <a href="{!! route('backoffice.role.permission.manage',['id'=>$role->id , 'action' => 'false', 'permission' => $key ]) !!}" class="btn btn-warning">Change to False</a>
                                    @endif
                                    <a href="{!! route('backoffice.role.permission.manage',['id'=>$role->id , 'action' => 'delete', 'permission' => $key ]) !!}" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No permissions.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">

                    @if( Sentinel::check()->hasAnyAccess(['admin.copy']) )

                        tem acesso a admin.copy

                    @endif


                </div>
            </div>




        </div>
    </div>

    <script type="text/javascript">

        $(document).ready( function(){

            $('#formAddPermission').validate({
                rules: {
                    name: "required",
                    permission_type: "required"

                },
                errorPlacement: function(error, element){
                    var name = element[0]['name'];
                    if ( name == "permission_type" )
                        $(".radio-error-container").html(error.text());
                    }
            });

        });

    </script>



@stop

