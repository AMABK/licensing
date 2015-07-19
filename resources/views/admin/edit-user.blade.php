@extends('layout.main')
@section('title')
Admin | Add user
@stop
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrator
            <small>Edit user</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Edit user</li>
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
            <h3>Edit user</h3>
            <form method="POST" action="/post/edit-user">
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
                @foreach($users as $user)
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required="" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required="" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="job_id">Job Id (&lowast;) Read only</label>
                    <input type="text" name="job_id" class="form-control" value="{{ $user->job_id }}" required="" readonly="">
                </div>
                <div class="form-group">
                    <label for="job_id">National Id (&lowast;) Read only</label>
                    <input type="text" name="national_id" class="form-control" value="{{ $user->national_id }}" required="" readonly="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly="">
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <select type="text" name="designation_id" class="form-control" >
                        <option value="{{$user->designation_id}}" >{{$user->designation->name}}</option>
                        @foreach($designations as $designation)
                        <option value="{{$designation->id}}" >{{$designation->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ $user->phone_no }}" required="" placeholder="Phone number">
                </div>
                @endforeach
                <div> 
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete">Delete</button>
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
    });
</script>   
@stop
