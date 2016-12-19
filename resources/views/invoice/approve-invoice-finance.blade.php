@extends('layout.main')
@section('title')
Approve Invoice | Finance
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
        @if(Session::has('global'))
        <p>{!!Session::get('global')!!}</p>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Finance invoice approval</h3>
            <form method="POST" action="/post/finance-approve">
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
                @foreach($invoices as $invoice)
                <div class="form-group">
                    <label for="invoice_no">Invoice Number</label>
                    <input type="text" style="text-transform:uppercase" class="form-control txt-auto" readonly="" name="invoice_no" required="" value="{{$invoice->invoice_no}}">
                    <input type="text" hidden="" name="id" value="{{$invoice->id}}">
                </div>
                <div class="form-group">
                    <label for="name">Paid by</label>
                    @if($invoice->invoice_type == 'Group Invoice')
                    <input type="text" class="form-control" value="{{$invoice->group->reg_id}}-{{$invoice->group->name}}" readonly="" >
                    @else
                    <input type="text" class="form-control" value="{{$invoice->vehicle->reg_id}}-{{$invoice->vehicle->name}}" readonly="">
                    @endif
                </div>
                <div class="form-group">
                    <label for="type">Invoice Type</label>
                    <input type="text" name="group_type" class="form-control" value="{{$invoice->invoice_type}}" readonly="" required="" placeholder="Group Type">
                </div>
                <div class="form-group">
                    <label for="type">No of Vehicles</label>
                    <input type="text" name="" class="form-control"  value="{{$invoice->no_vehicle}}" readonly="" required=""">
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label for="Discount">Discount</label>
                    <input type="number" name="discount" class="form-control" value="{{$invoice->discount}}" readonly="" required="" >
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Total Fees</label>
                    <input type="text" name="total_fee"  class="form-control" readonly="" required="" value="{{$invoice->total_fee}}">
                <div class="form-group">
                    <label for="expiry_date">Expiry date [MM/DD/YYYY]</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ date($invoice->expiry_date) }}" required="" readonly="" placeholder="MM/DD/YYYY [Expiry date]">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Region</label>
                    <input type="text" name="total_fee"  class="form-control" readonly="" required="" value="{{$invoice->region->name}}">
                </div>
                <div class="form-group">
                    <label for="agent">Agent</label>
                    <input type="text" name="total_fee"  class="form-control" readonly="" required="" value="{{$invoice->agent->name}}">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Description</label>
                    <textarea type="text" name="description" required="" class="form-control" readonly="">{{$invoice->description}}</textarea>
                </div>
                @endforeach
                <div>
                    <button type="submit" class="btn btn-success"  name="approve" value="approve">Approve</button>
                    <button type="submit" class="btn btn-warning"  name="reject" value="reject">Reject</button>
                    <button type="submit" class="btn btn-danger"  name="delete" value="delete" style="float: right">Delete</button>
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

</script>
@stop
