@extends('layout.main')
@section('title')
Group
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
        <center><p><div class="alert alert-warning">Once these groups are deleted, all related data and vehicles will also be deleted(This process is not reversible)</div></p></center>

        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="margin: 3px">
            <!-- Left col -->
            <h3>Deleted groups</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Name</th><th>RegNo(Auto)</th><th>GoK RegNo</th><th>Group Type</th><th>Phone</th><th>Email</th><th>Postal Address</th><th>Physical Address</th><th>Restore</th></tr></thead>
                <tbody>
                    @foreach ($group as $groups)
                    <tr>
                        <td><a href="{{URL::to('group/edit-group/'.\Hashids::encode($groups->id))}}"> {{$groups->name}}</a></td><td>{{ $groups->reg_id }}</td><td>{{ $groups->group_code }}</td><td>{{ $groups->vehicle_type->group }}</td><td>{{ $groups->phone_no }}</td><td>{{ $groups->email }}</td><td>{{ $groups->postal_address }}</td><td>{{ $groups->physical_address }}</td><td><a href="{{URL::to('group/restore-group/'.\Hashids::encode($groups->id))}}">Restore</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot><tr><th>Name</th><th>RegNo(Auto)</th><th>GoK RegNo</th><th>Group Type</th><th>Phone</th><th>Email</th><th>Postal Address</th><th>Physical Address</th><th>Restore</th></tr></thead>
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