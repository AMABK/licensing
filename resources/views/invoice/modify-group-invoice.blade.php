@extends('layout.main')
@section('title')
Add Group Invoice
@stop
@section('content')
<link href="/dist/css/jquery-ui.css" rel="stylesheet" type="text/css" />
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
        <p>{!!Session::get('global')!!}</p>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Register a modified group invoice</h3>
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
                    <input type="text" style="text-transform:uppercase" readonly="" value="{{\Request::get('invoice_no')}}" name="invoice_no" class="form-control txt-auto" required="" placeholder="Invoice Number">
                </div>
                <div class="form-group">
                    <label for="reg_id">Group Registration Number(Auto  Generated)</label>
                    <input type="text" style="text-transform:uppercase" readonly="" value="{{$group->reg_id}}" class="form-control txt-auto" id="reg_id" required="" placeholder="Registration Number">
                    <input type="text" hidden="" name="id" value="{{$group->id}}" id="id">
                </div>
                <div class="form-group">
                    <label for="name">Group Name</label>
                    <input type="text" name="name" class="form-control" value="{{$group->name}}" id="name" value="" readonly="" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="type">Group Type</label>
                    <input type="text" name="group_type" class="form-control" id="group_type" value="{{$group->vehicle_type->name}}" readonly="" required="" placeholder="Group Type">
                    <input type="text" name="type_id" id="type_id" value="{{$group->type_id}}" readonly="" required="" hidden="">
                </div>
                <div class="form-group">
                    <!-- <label for="text">Number of Vehicles</label>-->
                    <input type="hidden" name="no_vehicle" value="0" class="form-control" id="no_vehicle" readonly="" placeholder="Number of vehicle in the group">
                </div>
                <div class="form-group">
                    <!--<label for="fees">Fees (KSH)</label>-->
                    <input type="hidden" id="fee" class="form-control" onkeyup="sum();" readonly=""placeholder="Fees">
                </div>
                <div class="form-group">
                    <label for="Discount">Discount</label>
                    <input type="number" name="discount" class="form-control" id="discount" value="0" min="0" required="" onkeyup="sum();">
                </div>
                <div class="form-group">
                    <!--<label for="no_vehicle">Total Fees</label>-->
                    <input type="hidden" name="total_fee" value="0"  class="form-control" readonly="" required="" id="total_fee"  placeholder="Total Fees">
                    <input type="hidden" required="" name="licensed_vehicles" value="0" id="licenced_vehicles" readonly="">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date [MM/DD/YYYY]</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ date('Y-12-31')}}" required="" readonly="" placeholder="MM/DD/YYYY [Expiry date]">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Region</label>
                    <select name="region_id" required="" class="form-control">
                        <option type="text" value=""  class="form-control" >Please select a region</option>
                        @foreach($regions as $region)
                        <option type="text" @if($region->id == \Request::get('region_id')) selected @endif value="{{$region->id}}"  class="form-control" >{{$region->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="agent">Agent</label>
                    <select name="agent_id" required="" class="form-control">
                        <option type="text" value="">Please select an agent</option>
                        @foreach($agents as $agent)
                        <option type="text" @if($agent->id == \Request::get('agent_id')) selected @endif value="{{$agent->id}}" >{{$agent->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Description</label>
                    <textarea type="text" name="description" required="" class="form-control" placeholder="Description">{{\Request::get('description')}}</textarea>
                </div>
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <table id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th>Reg No</th>
                            <th>Group</th>
                            <th>TLB NUmber</th>
                            <th>Number of seats</th>
                            <th>Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        //dd($group);
                        ?>
                        @foreach($group->vehicles as $vehicle)
                        <tr>
                            <td><a href="{{URL::to('vehicle/edit-vehicle/'.\Hashids::encode($vehicle->id))}}"> {{strtoupper($vehicle->reg_no)}}</a></td>
                            <td><?php
                                if ($vehicle->group_id == null) {
                                    echo 'No Group';
                                } else {
                                    ?>
                                    <a href="{{URL::to('group/view-group/'.\Hashids::encode($vehicle->group->id))}}">{{ $vehicle->group->name }}</a><?php } ?></td>
                            <td>{{ strtoupper($vehicle->tlb_no) }}</td>
                            <td>{{ $vehicle->no_of_seat }}</td>
                            <td><input type="checkbox" name="vehicles[]" value="{{$vehicle->reg_no}}"</td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Reg No</th>
                            <th>Sacco</th>
                            <th>TLB Number</th>
                            <th>Number of seats</th>
                            <th>Check</th>
                        </tr>
                    </tfoot>
                </table>
                <p>
                <div class="form-group">
                    <a href="/invoice/add-group-invoice" class="btn btn-info pull-left"><i class="fa fa-backward"></i> Back To Add Group Invoice</a>
                    <button class="btn btn-success pull-right" name="submit" value="register_modified" type="submit"><i class="fa fa-save"></i> Register Invoice</button>
                </div>
            </form>
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script src="/datatables/jquery.dataTables.min.js" type="text/javascript" ></script>
<script>
                        $(document).ready(function () {
                            $('#myTable').dataTable({
                                "bPaginate": false
                            });
                        });
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
                            //console.log(sacco_details);
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
