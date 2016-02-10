@extends('layout.main')
@section('title')
Add user
@stop
@section('content')
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrator
            <small>Add user</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Add user</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <!-- Left col -->
            <h3>Edit user {{strtoupper($user->job_id)}}, [{{$user->first_name}} {{$user->last_name}} - {{$user->designation->name}}] privileges</h3>
            <form method="POST" action="/post/edit-privileges">
                {!! csrf_field() !!}
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <style>
                    th{
                        color: gray;
                        border-color: blue;
                        border: 2px;
                    }
                    table{
                        border: 1px;
                        border-color: blue;
                    }
                </style>

                <table>
                    <tr><th style="width:32%; ">Privilege</th><th style="width:70%">Description</th><th style="width:20%">Access</th></tr>
                    <input name="user_id" value="{{$user->id}}" hidden="">
                    <tr><td>Users Status</td><td>Is the user Active?</td><td><input type="radio" <?php if($user->status == 1) echo 'checked=""';?> name="status" value="1">Yes<input type="radio"  <?php if($user->status == 0) echo 'checked=""';?> name="status" value="0">No</td></tr>
                    @foreach ($priv as $privs) 
                    <?php
                    $i = 0;
                    ?>
                    @foreach ($user->roles as $users) 
                    @if ($privs->id == $users->id) 
                    <tr><td>{{$privs->role}}</td><td>Description</td><td><input type="radio" checked="" name="privilege[{{$privs->id}}]" value="Yes">Yes<input type="radio" value="No" name="privilege[{{$privs->id}}]">No</td></tr>
                    <?php
                    $i++;
                    ?>
                    @endif
                    @endforeach
                    @if($i == 0)
                    <tr><td>{{$privs->role}}</td><td>Description</td><td><input type="radio" name="privilege[{{$privs->id}}]" value="Yes">Yes<input type="radio" checked="" value="No" name="privilege[{{$privs->id}}]">No</td></tr>
                    @endif
                    @endforeach
                </table
        </div>
        <button type="submit">Update Privileges</button>
</div>

</form>
<!-- right col (We are only adding the ID to make the widgets sortable)-->

</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script>
    $(document).ready(function () {
        $('#myTable').dataTable();
    })
</script>   
@stop
