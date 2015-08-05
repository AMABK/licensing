@extends('layout.main')
@section('title')
Edit/Delete Sacco
@stop
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Edit/Delete group details</h3>
            <form method="POST" action="/post/edit-group">
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
                @foreach($groups as $group)
                <div class="form-group">
                    <label for="name">Group Name</label>
                    <input type="text" name="name" max="14" class="form-control" value="{{ $group->name }}" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="name">GoK Reg No</label>
                    <input type="text" name="group_code" class="form-control" value="{{ $group->group_code }}" placeholder="Reg No">
                </div>
                <div class="form-group">
                    <input type="text" name="id" value="{{ $group->id }}" hidden="">
                    <label for="reg_id">Registration Number(Auto generated)</label>
                    <input type="text" style="text-transform:uppercase" class="form-control" value="{{ $group->reg_id }}" readonly="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{  $group->email }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="type">Group Type</label>
                    <input type="text" name="type_id"  value="{{$group->type_id}}" class="no_sacco" hidden="">
                    <input type="text"  class="form-control" value="{{$group->vehicle_type->group}}" readonly="">
                </div>
                <div class="form-group">
                    <label for="address">Postal Address</label>
                    <input type="text" name="postal_address" class="form-control" value="{{ $group->postal_address }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="address">Physical Address</label>
                    <input type="text" name="physical_address" class="form-control" value="{{ $group->physical_address }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{  $group->phone_no }}" required="" placeholder="Phone number">
                </div>
                @endforeach
                <div style="float: left">
                    <button type="submit" name="update">Update</button>
                </div>
                <div style="float: right">
                    <button type="submit"  name="delete">Delete</button>
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

</script>   
@stop
