@extends('layout.main')
@section('title')
Add Sacco
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
        @if(Session::has('global'))
        <p>{!!Session::get('global')!!}</p>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Register a new sacco</h3>
            <form method="POST" action="/post/add-sacco">
                {!! csrf_field() !!}
                
                <div class="form-group">
                    <label for="name">Sacco Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="reg_id">Registration Number</label>
                    <input type="text" style="text-transform:uppercase" name="reg_id" class="form-control" value="{{ old('reg_id') }}" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="type" name="type" class="form-control" value="{{ old('type') }}" placeholder="Type">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ old('phone_no') }}" required="" placeholder="Phone number">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Number of vehicles</label>
                    <input type="text" name="no_vehicle" class="form-control" value="{{ old('no_vehicle') }}" required=""  placeholder="No of vehicles">
                </div>
                <div class="form-group">
                    <label for="yr_of_license">Year of license</label>
                    <input type="text" name="yr_of_license" class="form-control" value="{{ old('yr_of_license') }}" required="" placeholder="Year of license">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" required="" placeholder="MM/DD/YYYY [Expiry date]">
                </div>
                <div class="form-group">
                    <label for="fee_paid">Fee paid</label>
                    <input type="text" name="fee_paid" class="form-control" value="{{ old('fee_paid') }}" required="" placeholder="Fees paid">
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
        $('#myTable').dataTable();
    });
</script>   
@stop
