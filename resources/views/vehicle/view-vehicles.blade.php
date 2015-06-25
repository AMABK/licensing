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
    .modal-content{
        margin-top: 20%;
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
            <h3>Registered vehicles</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Reg No</th><th>Vehicle make</th><th>Category</th><th>Sacco</th><th>TLB NUmber</th><th>Number of seats</th><th>Add to sacco</th></tr></thead>

                @foreach ($vehicle as $vehicles)
                <tbody>
                    <tr>
                        <td><a href="{{URL::to('vehicle/edit-vehicle/'.\Hashids::encode($vehicles->id))}}"> {{strtoupper($vehicles->reg_no)}}</a></td><td>{{ $vehicles->vehicle_make }}</td><td>{{ $vehicles->category }}</td><td>{{ $vehicles->sacco->name }}</td><td>{{ $vehicles->tlb_no }}</td><td>{{ $vehicles->no_of_seat }}</td><td><a href="{{URL::to('/vehicles/add-vehicle/'.\Hashids::encode($vehicles->id))}}">Add to sacco</a></td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot><tr><th>Reg No</th><th>Vehicle make</th><th>Category</th><th>Sacco</th><th>TLB Number</th><th>Number of seats</th><th>Add to sacco</th></tr></thead>
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
    $('#myTable').DataTable();
});
</script>   
@stop
