<div class="modal fade" id="viewInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="viewInvoiceModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">View Invoice Details</h4>
            </div>
            <form METHOD="post" ACTION="">
                <div class="modal-body">
                    <table class="table table-striped table-responsive table-bordered col-md-12">
                        <tr>
                        <thead>
                        <th class="col-md-3">Title</th><th class="col-md-9">Value</th>
                        </thead>
                        </tr>
                        <tr><td>Invoice Number</td><td><div id="noInvoice"></div></td>
                        </tr>
                        <tr><td>Paid By</td><td><div id="payerInvoice"></div></td>
                        </tr>
                        <tr><td>Invoice Type</td><td><div  id="typeInvoice" ></div></td>
                        </tr>
                        <tr><td>No. of Vehicles</td><td><div  id="noVehicleInvoice" ></div></td>
                        </tr>
                        <tr><td>Discount</td><td><div id="discountInvoice"></div></td>
                        </tr>
                        <tr><td>Net Fee</td><td><div id="feeInvoice" ></div></td>
                        </tr>
                        <tr><td>Created On</td><td><div  id="createdInvoice" ></div></td>
                        </tr>
                        <tr><td>Updated On</td><td><div id="updatedInvoice" ></div></td>
                        </tr>
                        <tr><td>Expiry Date</td><td><div id="expiryInvoice" ></div></td>
                        </tr>
                        <tr><td>Licensed Vehicles</td><td><div id="licensedInvoice" readonly=""></div></td>
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