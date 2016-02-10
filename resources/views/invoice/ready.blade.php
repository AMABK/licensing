@extends('layout.main')
@section('title')
Invoices
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
            <h3>All license approved for printing</h3>
            <form method="POST" action="/post/print-invoice">
                {!! csrf_field() !!}
                <div>
                    <button><a href="{{URL::to('/invoice/print')}}">Print</a></button>
                </div>
                <table id="myTable" width="100%">
                    <thead><tr><th>Serial</th><th>No of seats</th><th>Sacco</th><th>Expiry date</th><th>Reg No</th></tr></thead>
                    <tbody>
                        <?php
                        $i = 0;
                        ?>
                        @foreach ($print as $prints)
                        <tr>
                            <td>{{$prints->sn }}</td><td>{{ $prints->seats }}</td><td>{{ $prints->sacco }}</td><td>{{ $prints->expiry_date }}</td><td>{{ $prints->reg_no }}</td> </tr>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                    </tbody>
                    <tfoot><tr><th>Serial</th><th>No of seats</th><th>Sacco</th><th>Expiry date</th><th>Reg No</th></tr></tfoot>

                </table>
            </form>
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

                $("#viewInvoiceModal").modal("show");
            }
        });


    });
});

</script>   
@stop