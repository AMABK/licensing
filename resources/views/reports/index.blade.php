@extends('layout.main')
@section('title')
Reports | Home
@stop
@section('content')
<style>
    h7{
        font-size: 20px;
    }
    h8{
        font-size: 20px;
        margin-left: 10px;
    }
</style>
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
            <form id="report_form" action="/reports" method="POST">
                {!! csrf_field() !!}
                <input type="date" class="form-control txt-auto" name="set_date" id="set_date" required="" placeholder="Please select a valid date">
            </form>
            <div class="col col-xs-12">
            Report from : <h8>{{$data['set_date']}} </h8> To<h8>{{date('d-m-Y')}}</h8>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['total_groups']}} Groups</h7><br>
                        <p><h8>{{$data['total_vehicles']}} Vehicles</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['sacco_groups']}} Matatu Saccos</h7><br>
                        <p><h8>{{$data['sacco_vehicles']}} Vehicles</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['company_groups']}} Companies</h7><br>
                        <p><h8>{{$data['company_vehicles']}} Vehicles</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="" class="small-box-footer"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['tour_groups']}} Tour Companies</h7><br>
                        <p><h8>{{$data['tour_vehicles']}} Vehicles</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['bus_groups']}} Bus Companies</h7><br>
                        <p><h8>{{$data['bus_vehicles']}} Vehicles</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['taxi_groups']}} Taxi Companies</h7><br>
                        <p><h8>{{$data['taxi_vehicles']}} Vehicles</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h7>{{$data['taxis']}}</h7><br>
                        <p><h8>Freelance Taxis</h8></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        @if(Session::has('global'))
        <p>{!!Session::get('global')!!}</p>
        @endif
        <!-- Main row -->


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script>
    document.getElementById("set_date").onchange = function () {
        document.getElementById("report_form").submit();
    }
//    $(document).ready(function () {
//        var vehicle_details = {
//            source: "/reports/details",
//            select: function (event, vehicle) {
//                +
//                        $("#total_groups").val(vehicle.item.total_groups);
//                $("#company_groups").val(vehicle.item.company_groups);
//                $("#taxi_groups").val(vehicle.item.taxi_groups);
//                $("#bus_groups").val(vehicle.item.bus_groups);
//                $("#sacco_groups").val(vehicle.item.sacco_groups);
//                $("#tour_groups").val(vehicle.item.tour_groups);
//
//                $("#total_vehicles").val(vehicle.item.total_vehicles);
//                $("#company_vehicles").val(vehicle.item.company_vehicles);
//                $("#taxi_vehicles").val(vehicle.item.taxi_vehicles);
//                $("#bus_vehicles").val(vehicle.item.bus_vehicles);
//                $("#sacco_vehicles").val(vehicle.item.sacco_vehicles);
//                $("#tour_vehicles").val(vehicle.item.tour_vehicles);
//                $("#taxis").val(vehicle.item.taxis);
//                $("#current_date").val(vehicle.item.current_date);
//                //$("#id").val(vehicle.item.id);
//                //console.log(vehicle.item.total_groups);
//
//
//
//            },
//            minLength: 0
//        };
//        $("#set_date").autocomplete(vehicle_details);
//
//
//    });
    //Sums up both discount and fee
//    function sum() {
//        var discount = document.getElementById('discount').value;
//        var initialFee = document.getElementById('fee').value;
//        var result = parseInt(initialFee) - parseInt(discount);
//        if (initialFee === "")
//        {
//            document.getElementById('total_fee').value = 0;
//        }
//        if (!isNaN(result))
//        {
//            document.getElementById('total_fee').value = result;
//        }
//    }

</script>   
@stop