@extends('layout.main')
@section('title')
Sacco
@stop
@section('content')
<link rel="stylesheet" type="text/css" href="/datatables/jquery.dataTables.min.css" title="yellow" media="screen" />
<style>
    table, td {
        border: 1px solid #086A87;
        background-color: #D8D8D8;
        height: 10px;
    }

    thead, th {
        background-color: #00BFFF;
        border: 1px solid #086A87;
        color: white;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
        background-color: #D8D8D8;
    }
    .nav-tabs>li>a {
        background-color: rgb(239, 224, 224);
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

        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="margin: 3px">
            <!-- Left col -->
            <h3>Add vehicle Reg No [{{strtoupper($vehicle->reg_no)}}], {{$vehicle->no_of_seat}} seator, to a group</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Name</th><th>Reg No</th><th>#Vehicles</th><th>Yr of License</th><th>Expiry Date</th><th>Fees Paid</th><th>Phone</th><th>Email</th><th>Address</th><th>Add Vehicle</th></tr></thead>
                <tbody>
                    @foreach ($group as $groups)
                    <tr>
                        <td><a href="{{URL::to('group/edit-group/'.\Hashids::encode($groups->id))}}"> {{$groups->name}}</a></td><td>{{ $groups->reg_id }}</td><td>{{ $groups->no_vehicle }}</td><td>{{ $groups->yr_of_license }}</td><td>{{ $groups->expiry_date }}</td><td>{{ $groups->fee_paid }}</td><td>{{ $groups->phone_no }}</td><td>{{ $groups->email }}</td><td>{{ $groups->address }}</td><td><a href="{{URL::to('vehicle/add-group/'.\Hashids::encode($groups->id,$vehicle->id))}}">Add</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot><tr><th>Name</th><th>Reg No</th><th>#Vehicles</th><th>Yr of License</th><th>Expiry Date</th><th>Fees Paid</th><th>Phone</th><th>Email</th><th>Address</th><th>Add Vehicle</th></tr></thead>
            </table>
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script src="/datatables/jquery.dataTables.min.js" type="text/javascript" ></script>

<script>
$(document).ready(function () {
    $('#myTable').dataTable();
});
</script>   
@stop
