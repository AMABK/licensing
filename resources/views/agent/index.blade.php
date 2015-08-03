@extends('layout.main')
@section('title')
View agents
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
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Main row -->
        <div class="row" style="margin: 3px">
            <!-- Left col -->
            <h3>Registered agents</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Name</th><th>Phone</th><th>Region</th><th>Address</th><th></th></tr></thead>
                <tbody>
                    @foreach ($agent as $agents)
                    <tr>
                        <td><a href="{{URL::to('agent/edit-agent/'.\Hashids::encode($agents->id))}}"> {{strtoupper($agents->name)}}</a></td><td>{{ $agents->phone_no }}</td><td>{{ $agents->region->name }}</td><td>{{ $agents->postal_address }}</td><td><a href="{{URL::to('agent/delete-agent/'.\Hashids::encode($agents->id))}}">delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot><tr><th>Name</th><th>Phone</th><th>Region</th><th>Address</th><th></th></tr></thead>
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