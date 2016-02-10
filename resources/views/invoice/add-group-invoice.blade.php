@extends('layout.main')
@section('title')
Add Group Invoice
@stop
@section('content')
<link href="/dist/css/jquery-ui.css" rel="stylesheet" type="text/css" />
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
        <p>{!!Session::get('global')!!}</p>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Register a new group invoice</h3>
            <form method="POST" action="/post/add-group-invoice">
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
                    <label for="invoice_no">Invoice Number</label>
                    <input type="text" style="text-transform:uppercase" name="invoice_no" class="form-control txt-auto" required="" placeholder="Invoice Number">
                </div>
                <div class="form-group">
                    <label for="reg_id">Group Registration Number(Auto  Generated)</label>
                    <input type="text" style="text-transform:uppercase" class="form-control txt-auto" id="reg_id" required="" placeholder="Registration Number">
                    <input type="text" hidden="" name="id" id="id">
                </div>
                <div class="form-group">
                    <label for="name">Group Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="" readonly="" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="type">Group Type</label>
                    <input type="text" name="group_type" class="form-control" id="group_type" value="" readonly="" required="" placeholder="Group Type">
                    <input type="text" name="type_id" id="type_id" readonly="" required="" hidden="">
                </div>
                <div class="form-group">
                    <label for="text">Number of Vehicles</label>
                    <input type="text" name="no_vehicle" class="form-control" id="no_vehicle" readonly="" placeholder="Number of vehicle in the group">
                </div>
                <div class="form-group">
                    <label for="fees">Fees (KSH)</label>
                    <input type="text" id="fee" class="form-control" onkeyup="sum();" readonly=""placeholder="Fees">
                </div>
                <div class="form-group">
                    <label for="Discount">Discount</label>
                    <input type="number" name="discount" class="form-control" id="discount" value="0" min="0" required="" onkeyup="sum();">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Total Fees</label>
                    <input type="text" name="total_fee"  class="form-control" readonly="" required="" id="total_fee"  placeholder="Total Fees">
                    <input type="text" hidden="" required="" name="licensed_vehicles" id="licenced_vehicles" readonly="">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date [MM/DD/YYYY]</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ date('Y-12-31')}}" required="" readonly="" placeholder="MM/DD/YYYY [Expiry date]">
                <div class="form-group">
                    <label for="no_vehicle">Region</label>
                    <select name="region_id" required="" class="form-control">
                        <option type="text" value=""  class="form-control" >Please select a region</option>
                        @foreach($region as $regions)
                        <option type="text" value="{{$regions->id}}"  class="form-control" >{{$regions->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="agent">Agent</label>
                    <select name="agent_id" required="" class="form-control">
                        <option type="text" value="">Please select an agent</option>
                        @foreach($agent as $agents)
                        <option type="text" value="{{$agents->id}}" >{{$agents->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Description</label>
                    <textarea type="text" name="description" required="" class="form-control" placeholder="Description"></textarea>
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
            source: "/invoice/group-autocomplete",
            select: function (event, group) {
                +
                        $("#reg_id").val(group.item.reg_id);
                $("#name").val(group.item.name);
                $("#no_vehicle").val(group.item.no_vehicle);
                $("#licenced_vehicles").val(group.item.licensed_vehicles);
                $("#fee").val(group.item.fee);
                $("#total_fee").val(group.item.fee);
                $("#discount").val(0);
                $("#type_id").val(group.item.type_id);
                $("#group_type").val(group.item.group_type);
                $("#id").val(group.item.id);


            },
            minLength: 2
        };
        console.log(sacco_details);
        $("#reg_id").autocomplete(sacco_details);

    });
    //Sums up both discount and fee
    function sum() {
        var discount = document.getElementById('discount').value;
        var initialFee = document.getElementById('fee').value;
        var result = parseInt(initialFee) - parseInt(discount);
        if (initialFee === "")
        {
            document.getElementById('total_fee').value = 0;
        }
        if (!isNaN(result))
        {
            document.getElementById('total_fee').value = result;
        }
    }

</script>   
@stop
