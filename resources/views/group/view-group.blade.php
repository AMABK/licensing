@extends('layout.main')
@section('title')
View Vehicles
@stop
@section('content')
<link rel="stylesheet" type="text/css" href="/datatables/custom.dataTables.css" title="yellow" media="screen" />

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
            <h3>Registered vehicles under {{$group[0]->name}} Sacco [Reg No: {{$group[0]->reg_id}}]</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Reg No</th><th>TLB Number</th><th>Number of seats</th><th>Remove from group</th></tr></thead>

                @foreach ($group as $groups)
                <tbody>
                    <tr>
                        <td><a href="{{URL::to('vehicle/edit-vehicle/'.\Hashids::encode($groups->id))}}"> {{strtoupper($groups->reg_no)}}</a></td><td>{{ strtoupper($groups->tlb_no) }}</td><td>{{ $groups->no_of_seat }}</td><td><a href="{{URL::to('/vehicle/remove-group/'.\Hashids::encode($groups->group_id,$groups->id))}}">Remove</a></td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot><tr><th>Reg No</th><th>TLB Number</th><th>Number of seats</th><th>Remove from group</th></tr></thead>
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
