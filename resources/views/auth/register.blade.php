@extends('layout.main')
@section('title')
Home
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Register a new user</h3>
            <form method="POST" action="/auth/register">
                {!! csrf_field() !!}
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required="" id="exampleInputEmail1" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required="" id="exampleInputEmail1" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required="" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="national_id">National Id</label>
                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" required="" id="exampleInputEmail1" placeholder="National Id">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ old('phone_no') }}" required="" id="exampleInputEmail1" placeholder="Phone number">
                </div>
                <div class="form-group">
                    <label for="status">National Id</label>
                    <input type="text" name="status" class="form-control" value="{{ old('status') }}" required="" id="exampleInputEmail1" placeholder="Status">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required="" id="exampleInputEmail1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="national_id">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required="" id="exampleInputEmail1" placeholder="Password confirmation">
                </div>
                <div>
                    <button type="submit">Register</button>
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
        $('#myTable').DataTable();
    });
</script>   
@stop
