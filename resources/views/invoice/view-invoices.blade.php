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
        @include('layout.modal.view-invoice')
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="margin: 3px">
            <!-- Left col -->
            <h3>Registered invoices</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Invoice #</th><th>Payer</th><th>Invoice Type</th><th>Vehicle #</th><th>Fees Paid</th><th>Discount</th><th>Net Fees</th><th>Expiry Date</th><th>Approve</th><th>License</th><th>Delete</th></tr></thead>
                <tbody>
                    @foreach ($invoice as $invoices)
                    <tr>
                        <td><?php if ($invoices->invoice_type == 'Group Invoice') { ?><a href="#" class="viewGroupInvoice" data-prop="{{$invoices->id}}" >{{strtoupper($invoices->invoice_no)}}</a><?php } else { ?><a href="#" class="viewIndividualInvoice" data-prop="{{$invoices->id}}" >{{strtoupper($invoices->invoice_no)}}</a><?php } ?></td><td><?php
                            if ($invoices->invoice_type == 'Group Invoice') {
                                echo $invoices->group['reg_id'];
                            } else {
                                echo $invoices->vehicle['reg_no'];
                            }
                            ?></td><td>{{ $invoices->invoice_type }}</td><td>{{ $invoices->no_vehicle }}</td><td>{{ $invoices->total_fee }}</td><td>{{ $invoices->discount }}</td><td>{{ $invoices->total_fee-$invoices->discount }}</td><td>{{ $invoices->expiry_date }}</td><td><a href="{{URL::to('invoice/approve/'.\Hashids::encode($invoices->id))}}">Approve</a></td><td><a href="{{URL::to('/invoice/view-cert/'.Hashids::encode($invoices->id))}}" target="_blank">Print</a></td><td><a href="{{URL::to('/invoice/delete-invoice/'.\Hashids::encode($invoices->id))}}"> Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot><tr><th>Invoice #</th><th>Payer</th><th>Invoice Type</th><th>Vehicle #</th><th>Fees Paid</th><th>Discount</th><th>Net Fees</th><th>Expiry Date</th><th>Approve</th><th>License</th><th>Delete</tr></thead>
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
//view farmer
$(document).ready(function () {
    $(".viewGroupInvoice").click(function () {
        var prop = $(this).attr("data-prop");
        //console.log(prop);
        $.ajax({
            type: "GET",
            url: "/invoice/get-group-invoice/" + prop,
            success: function (data) {

                var invoiceArray = data;
                console.log(invoiceArray.statusManager);
                //Inserting into modal:
//                    var contentString = ""
//                    for (var i = 0; i < projectArray.length; i++) {
//                        contentString += "<input type='digit' name='id' value=" + projectArray[i].id + " >"
//                    }
                //console.log(contentString);
                //console.log(projectArray.projects[0].id);
                $("#idInvoice").val(invoiceArray.id);
                $("#noInvoice").val(invoiceArray.invoice_no);
                $("#licensedInvoice").val(invoiceArray.licensed_vehicles);
                $("#payerInvoice").val(invoiceArray.group.reg_id);
                $("#typeInvoice").val(invoiceArray.invoice_type);
                $("#createdInvoice").val(invoiceArray.created_at);
                $("#updatedInvoice").val(invoiceArray.updated_at);
                $("#feeInvoice").val(invoiceArray.total_fee);
                $("#discountInvoice").val(invoiceArray.discount);
                $("#noVehicleInvoice").val(invoiceArray.no_vehicle);
                $("#expiryInvoice").val(invoiceArray.expiry_date);
//                if (invoiceArray.status_finance === null) {
//                    document.getElementById('#statusFinance').value = 'N/A';
//                }
//                else {
//                    $("#statusFinance").val(invoiceArray.status_finance.status);
//                }
//                if (invoiceArray.status_manager === null) {
//                    document.getElementById('#statusManager').value = 'N/A';
//                }
//                else {
//                    $("#statusManager").val(invoiceArray.status_finance.status);
//                }
                //console.log(projectArray);
                //$("#subCountyValue").val(projectArray['sub-county']);
                //$("#viewFarmerModalContent").append(contentString);
                $("#viewInvoiceModal").modal("show");
            }
        });
        //Load data into modal:
        // var content = 

    });
});
$(document).ready(function () {
    $(".viewIndividualInvoice").click(function () {
        var prop = $(this).attr("data-prop");
        //console.log(prop);
        $.ajax({
            type: "GET",
            url: "/invoice/get-individual-invoice/" + prop,
            success: function (data) {

                var invoiceArray = data;
                console.log(invoiceArray);
                //Inserting into modal:
//                    var contentString = ""
//                    for (var i = 0; i < projectArray.length; i++) {
//                        contentString += "<input type='digit' name='id' value=" + projectArray[i].id + " >"
//                    }
                //console.log(contentString);
                //console.log(projectArray.projects[0].id);
                $("#idInvoice").val(invoiceArray.id);
                $("#noInvoice").val(invoiceArray.invoice_no);
                $("#licensedInvoice").val(invoiceArray.reg_no);
                $("#payerInvoice").val(invoiceArray.vehicle.reg_no);
                $("#typeInvoice").val(invoiceArray.invoice_type);
                $("#createdInvoice").val(invoiceArray.created_at);
                $("#updatedInvoice").val(invoiceArray.updated_at);
                $("#feeInvoice").val(invoiceArray.total_fee);
                $("#discountInvoice").val(invoiceArray.discount);
                $("#noVehicleInvoice").val(invoiceArray.no_vehicle);
                $("#expiryInvoice").val(invoiceArray.expiry_date);
                //console.log(projectArray);
                //$("#subCountyValue").val(projectArray['sub-county']);
                //$("#viewFarmerModalContent").append(contentString);
                $("#viewInvoiceModal").modal("show");
            }
        });
        //Load data into modal:
        // var content = 

    });
});
//Edit farmer
//$(document).ready(function () {
//    $(".editFarmerLink").click(function () {
//        var prop = $(this).attr("data-prop");
//        console.log(prop);
//        $.ajax({
//            type: "GET",
//            url: "/farmer/get/" + prop,
//            success: function (data) {
//
//                var projectArray = data;
//                //console.log(projectArray);
//                //Inserting into modal:
////                    var contentString = ""
////                    for (var i = 0; i < projectArray.length; i++) {
////                        contentString += "<input type='digit' name='id' value=" + projectArray[i].id + " >"
////                    }
//                //console.log(contentString);
//                $("#idProjectE").val(projectArray.projects.id);
//                $("#idFarmerE").val(projectArray.id);
//                $("#fNameValueE").val(projectArray.first_name);
//                $("#mNameValueE").val(projectArray.middle_name);
//                $("#sNameValueE").val(projectArray.surname);
//                $("#dobValueE").val(projectArray.dob);
//                $("#idNoValueE").val(projectArray.id_number);
//                $("#phoneValueE").val(projectArray.phone);
//                $("#addressValueE").val(projectArray.address);
//                $("#genderValueE").val(projectArray.gender);
//                $("#countryValueE").val(projectArray.country);
//                $("#countyValueE").val(projectArray.county);
//                $("#subCountyValueE").val(projectArray['sub-county']);
//                console.log(projectArray);
//                $("#editFarmerModal").modal("show");
//            }
//        });
//        //Load data into modal:
//        // var content = 
//
//    });
//});
</script>   
@stop