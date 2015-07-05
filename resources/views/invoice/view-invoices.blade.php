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

        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="margin: 3px">
            <!-- Left col -->
            <h3>Registered invoices</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Invoice #</th><th>Payer</th><th>Group Type</th><th>Vehicle #</th><th>Fees Paid</th><th>Discount</th><th>Net Fees</th><th>Expiry Date</th><th>Vehicles</th></tr></thead>
                <tbody>
                    @foreach ($invoice as $invoices)
                    <tr>
                        <td><a href="{{URL::to('invoice/edit-invoice/'.\Hashids::encode($invoices->id))}}"> {{strtoupper($invoices->invoice_no)}}</a></td><td>{{ $invoices->payer_id }}</td><td>{{ $invoices->group_type }}</td><td>{{ $invoices->no_vehicle }}</td><td>{{ $invoices->total_fee }}</td><td>{{ $invoices->discount }}</td><td>{{ $invoices->total_fee-$invoices->discount }}</td><td>{{ $invoices->expiry_date }}</td><td><a href="{{URL::to('invoice/add-new-vehicle/'.\Hashids::encode($invoices->id))}}">Add</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot><tr><th>Name</th><th>Reg No</th><th>Group Type</th><th>Expiry Date</th><th>Fees Paid</th><th>Phone</th><th>Email</th><th>Address</th><th>Add Vehicles</th></tr></thead>
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