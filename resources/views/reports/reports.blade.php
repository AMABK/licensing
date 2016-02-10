@extends('layout.main')
@section('title')
Reports
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
            <div class="panel panel-default" style="width: 70%;margin-left: 10%">
                <!-- Default panel contents -->
                <div class="panel-heading">Panel heading</div>

                <!-- Table -->
                <table class="table">
                    <thead><th>Item</th><th>Total(KES)</th><th>Discount(KES)</th><th>Net Fee(KES)</th></thead>
                    <tr><td>Collections per region per tariff</td><td>{{$price[1][0]->total}}</td><td>{{$price[1][0]->discount}}</td><td>{{$price[1][0]->total-$price[1][0]->discount}}</td></tr>
                    <tr><td>Total collections per tariff</td><td>{{$price[2][0]->total}}</td><td>{{$price[2][0]->discount}}</td><td>{{$price[2][0]->total-$price[2][0]->discount}}</td></tr>
                    <tr><td>Consolidated collections per Licensing Agent</td><td>{{$price[3][0]->total}}</td><td>{{$price[3][0]->discount}}</td><td>{{$price[3][0]->total-$price[3][0]->discount}}</td></tr>
                    <tr><td>Consolidated figure for all tariffs</td><td>{{$price[4][0]->total}}</td><td>{{$price[4][0]->discount}}</td><td>{{$price[4][0]->total-$price[4][0]->discount}}</td></tr>
                </table>
            </div>
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