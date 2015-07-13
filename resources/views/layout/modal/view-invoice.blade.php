<div class="modal fade" id="viewInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="viewInvoiceModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">View Invoice Details</h4>
            </div>
            <form METHOD="post" ACTION="">
                <div class="modal-body">
                    <table class="table table-striped table-condensed table-bordered">
                        <thead><tr><td></td><td></td></tr></thead>
                        <tr><td>Invoice Number</td><td><input style='text-transform:uppercase' id="noInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Paid By</td><td><input id="payerInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Invoice Type</td><td><input  id="typeInvoice" readonly=""></td>
                        </tr>
                        <tr><td>No. of Vehicles</td><td><input  id="noVehicleInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Discount</td><td><input id="discountInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Net Fee</td><td><input id="feeInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Created On</td><td><input  id="createdInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Updated On</td><td><input id="updatedInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Expiry Date</td><td><input id="expiryInvoice" readonly=""></td>
                        </tr>
                        <tr><td>Finance Approval</td><td><input id="statusFinance" value="Feature Not Configured" readonly=""></td>
                        </tr>
                        <tr><td>Manager Approval</td><td><input id="statusManager" value="Feature Not Configured" readonly=""></td>
                        </tr>
                        <tr><td>Licensed Vehicles</td><td><textarea style='text-transform:uppercase;' id="licensedInvoice" readonly=""></textarea></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>

        </div>
    </div>
</div>
</div>