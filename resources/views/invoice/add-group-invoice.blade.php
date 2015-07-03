@extends('layout.main')
@section('title')
Add Group Invoice
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
            <h3>Register a new group</h3>
            <form method="POST" action="/post/add-group">
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
                <div class="form-group">
                    <label for="reg_id">Registration Number</label>
                    <input type="text" style="text-transform:uppercase" name="reg_id" class="form-control txt-auto" id="reg_id" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="name">Group Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="" readonly="" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="type">Group Type</label>
                    <input type="text" name="group_type" class="form-control" id="group_type" value="" readonly="" required="" placeholder="Group Type">
                </div>
                <div class="form-group">
                    <label for="text">Number of Vehicles</label>
                    <input type="text" class="form-control" id="no_vehicle" readonly="" placeholder="Number of vehicle in the group">
                </div>
                <div class="form-group">
                    <label for="text">Charges</label>
                    <input type="text" class="form-control" id="charges" readonly="" placeholder="Charges">
                </div>
                <div class="form-group">
                    <label for="fees">Fees</label>
                    <input type="text" id="fees" class="form-control" readonly=""placeholder="Fees">
                </div>
                <div class="form-group">
                    <label for="Discount">Discount</label>
                    <input type="text" name="discount" class="form-control" value="0" required="" placeholder="Discount">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Total Fees</label>
                    <input type="text" name="total_fee" class="form-control" readonly="" value="{{ old('total_fee') }}" required="" id="total_fee"  placeholder="Total Fees">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date [MM/DD/YYYY]</label>
                    <input type="text" name="expiry_date" class="form-control" value="12-31-{{ date('Y') }}" required="" readonly="" placeholder="MM/DD/YYYY [Expiry date]">
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
        var sacco_details = {
            source: "/invoice/sacco-autocomplete",
            select: function (event, group) {
                +
                        $("#reg_id").val(group.item.reg_id);
                        $("#name").val(group.item.name);
                        $("#no_vehicle").val(group.item.no_vehicle);
                        $("#fee").val(group.item.fee);
                        $("#group_type").val(group.item.group_type);
                       // document.getElementById("dicount").innerHTML = "";
                        //$("#total_fee").total_fee;

            },
            minLength: 1
        };
        console.log(sacco_details);
        $("#reg_id").autocomplete(sacco_details);
    });
</script>   
@stop
