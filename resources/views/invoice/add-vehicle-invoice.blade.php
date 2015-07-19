@extends('layout.main')
@section('title')
Add Group Invoice
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
        <!--        <div class="row">
                    <div class="col-lg-3 col-xs-6">
                         small box 
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>150</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div> ./col 
                    <div class="col-lg-3 col-xs-6">
                         small box 
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div> ./col 
                    <div class="col-lg-3 col-xs-6">
                         small box 
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>44</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div> ./col 
                    <div class="col-lg-3 col-xs-6">
                         small box 
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div> ./col 
                </div> /.row -->
        @if(Session::has('global'))
        <p>{!!Session::get('global')!!}</p>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Register a new vehicle invoice</h3>
            <form method="POST" action="/post/add-vehicle-invoice">
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
                    <input type="text" style="text-transform:uppercase" class="form-control txt-auto"  name="invoice_no" required="" placeholder="Invoice Number">
                </div>
                <div class="form-group">
                    <label for="reg_no">Vehicle Registration Number</label>
                    <input type="text" name="reg_no" style="text-transform:uppercase" class="form-control txt-auto" id="reg_no" required="" placeholder="Registration Number">
                    <input type="text" hidden="" name="id" id="id">
                </div>
                <div class="form-group">
                    <label for="name">Group Name</label>
                    <input type="text" class="form-control" id="group_name" value="" readonly=""  placeholder="Vehicle does not belong to any group">
                    <input type="text" name="reg_id" id="reg_id" readonly="" hidden="">
                    <input type="text" name="group_id" id="group_id" readonly="" hidden="">
                </div>
                <div class="form-group">
                    <label for="type">Vehicle Type</label>
                    <input type="text" name="group_type" class="form-control" id="group_type" value="" readonly="" required="" placeholder="Group Type">
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
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date [MM/DD/YYYY]</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ date('Y-12-31') }}" required="" readonly="" placeholder="MM/DD/YYYY [Expiry date]">
                </div>
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
                        <option type="text" value="" >Please select an agent</option>
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
        var vehicle_details = {
            source: "/invoice/vehicle-autocomplete",
            select: function (event, vehicle) {
                +
                        $("#reg_no").val(vehicle.item.reg_no);
                $("#tlb_no").val(vehicle.item.tbl_no);
                $("#group_name").val(vehicle.item.group_name);
                $("#group_type").val(vehicle.item.group_type);
                $("#reg_id").val(vehicle.item.reg_id);
                $("#fee").val(vehicle.item.fee);
                $("#total_fee").val(vehicle.item.fee);
                $("#discount").val(0);
                $("#group_id").val(vehicle.item.group_id);
                $("#id").val(vehicle.item.id);


            },
            minLength: 0
        };
        $("#reg_no").autocomplete(vehicle_details);

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
