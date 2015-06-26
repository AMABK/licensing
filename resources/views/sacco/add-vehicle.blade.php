@extends('layout.main')
@section('title')
Add Vehicles
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
                        <p>Saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/sacco/add-sacco')}}" class="small-box-footer">Add sacco <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53</h3>
                        <p>Total Vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="#" class="small-box-footer">Add a vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>57<sup style="font-size: 20px">%</sup></h3>
                        <p>Belong to saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65<sup style="font-size: 20px">%</sup></h3>
                        <p>Are company vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/sacco/add-sacco')}}" class="small-box-footer">Add sacco <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <!-- Left col -->
            <h3>Register a new vehicle</h3>
            <form method="POST" action="/vehicle/add-vehicle">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" name="reg_no" class="form-control" value="{{ old('reg_no') }}" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="vehicle_make">Vehicle Make</label>
                    <input type="text" name="vehicle_make" class="form-control" value="{{ old('vehicle_make') }}" placeholder="Vehicle make">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category') }}" required="" placeholder="Category">
                </div>
                <div class="form-group">
                    <label for="sacco_id">Sacco</label>
                    <input type="text" name="sacco_id" class="form-control" value="{{ old('sacco_id') }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="tlb_no">TLB Number</label>
                    <input type="text" name="tlb_no" class="form-control" value="{{ old('tlb_no') }}" required=""  placeholder="TLB No.">
                </div>
                <div class="form-group">
                    <label for="no_of_seat">Number of seats</label>
                    <input type="text" name="no_of_seat" class="form-control" value="{{ old('no_of_seat') }}" required="" placeholder="Number of seats">
                </div>
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
