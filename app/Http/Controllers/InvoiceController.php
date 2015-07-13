<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;

class InvoiceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createGroupInvoice() {
        $regions = \App\Region::all();
        $agents = \App\Agent::all();
        return view('invoice.add-group-invoice', array('region' => $regions, 'agent' => $agents));
    }

    public function createVehicleInvoice() {
        $regions = \App\Region::all();
        $agents = \App\Agent::all();
        return view('invoice.add-vehicle-invoice', array('region' => $regions, 'agent' => $agents));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeGroupInvoice() {
//dd(\Request::all());
        $validator = \Validator::make(\Request::all(), array(
                    'invoice_no' => 'required|unique:invoices',
                    'id' => 'required|max:10',
                    'name' => 'required|max:255',
                    'no_vehicle' => 'required|integer',
                    'group_type' => 'required',
                    'discount' => 'required',
                    'licensed_vehicles' => 'required',
                    'total_fee' => 'required|integer',
                    'region_id' => 'required|integer',
                    'agent_id' => 'required|integer',
                    'expiry_date' => 'required',
                    'description' => 'required'
                        )
        );
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator);
        } else {
//dd(strtotime(\Request::get('expiry_date')));
            $invoice = \App\Invoice::create(array(
                        'invoice_no' => strtoupper(\Request::get('invoice_no')),
                        'payer_id' => \Request::get('id'),
                        'no_vehicle' => \Request::get('no_vehicle'),
                        'invoice_type' => 'Group Invoice',
                        'group_type' => \Request::get('group_type'),
                        'discount' => \Request::get('discount'),
                        'licensed_vehicles' => strtoupper(\Request::get('licensed_vehicles')),
                        'total_fee' => \Request::get('total_fee'),
                        'expiry_date' => \Request::get('expiry_date'),
                        'agent_id' => \Request::get('agent_id'),
                        'region_id' => \Request::get('region_id'),
                        'user_id' => \Auth::user()->id,
                        'description' => \Request::get('description')
                            )
            );
            if ($invoice) {
                return redirect('/invoice')
                                ->with('global', '<div class="alert alert-success">Group invoice successfullly created</div>');
            } else {
                return redirect('/invoice')
                                ->with('global', '<div class="alert alert-danger">Whoooops, the invoice could not be created. Please try again!</div>');
            }
        }
    }

    public function storeVehicleInvoice() {
//dd(\Request::all());
        $validator = \Validator::make(\Request::all(), array(
                    'invoice_no' => 'required|unique:invoices',
                    'id' => 'required|max:10',
                    'reg_no' => 'required|max:255',
                    'group_type' => 'required',
                    'discount' => 'required',
                    'total_fee' => 'required|integer',
                    'expiry_date' => 'required',
                    'region_id' => 'required',
                    'agent_id' => 'required',
                    'description' => 'required'
                        )
        );
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator);
        } else {
//dd(\Request::all());
            $invoice = \App\Invoice::create(array(
                        'invoice_no' => strtoupper(\Request::get('invoice_no')),
                        'payer_id' => \Request::get('id'),
                        'invoice_type' => 'Individual Invoice',
                        'group_type' => \Request::get('group_type'),
                        'discount' => \Request::get('discount'),
                        'reg_no' => strtoupper(\Request::get('reg_no')),
                        'total_fee' => \Request::get('total_fee'),
                        'no_vehicle' => 1,
                        'expiry_date' => \Request::get('expiry_date'),
                        'region_id' => \Request::get('region_id'),
                        'agent_id' => \Request::get('agent_id'),
                        'user_id' => \Auth::user()->id,
                        'description' => \Request::get('description')
                            )
            );
            if ($invoice) {
                return redirect('/invoice')
                                ->with('global', '<div class="alert alert-success">Vehicle invoice successfullly created</div>');
            } else {
                return redirect('/invoice')
                                ->with('global', '<div class="alert alert-danger">Whoooops, the invoice could not be created. Please try again!</div>');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show() {
        $invoices = \App\Invoice::all();
        return view('invoice.view-invoices', array('invoice' => $invoices));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
//
    }

    /**
     * Update the specified resource in storage.
      App\Http\Controllers\Auth  *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $select = \App\Invoice::find(\Hashids::decode($id))->first();
        $delete = $select->delete();
        if($delete){
            return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully deleted</div>');
        }else{
            return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-danger">Whoooops, the invoice could not be deleted. Please try again!</div>');
        }        
    }
    public function destroy($id) {
//
    }

    public function getGroupDetails() {
        $reg_id = trim(strip_tags($_GET['term']));
//$reg_id = 'KEs';
        $group_data = \App\Group::with('vehicle_type')
                ->where('reg_id', 'like', '%' . $reg_id . '%')
                ->get(['id', 'reg_id', 'name', 'type_id']);
//dd($data[0]->email);
//print json_encode($data);
//        $matches = array();
        foreach ($group_data as $data) {
            $vehicle_type = $data->type_id;
            $vehicle_fee = \App\Charge::find($data->type_id);
            $vehicles = \App\Vehicle::where('group_id', $data->id)->get();
            switch ($vehicle_type) {
                case 1:
                    /*
                     * Taxi charges
                     * Each taxi pays an annual fee of amount x
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 2:
                    /*
                     * Matatu charges
                     * Each matatu pays annual fee of amount y
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 3:
                    /*
                     * Company vehicles
                     * Each vehicle pays an annual fee of amount z
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 4:
                    /*
                     * Tour firms
                     * Tour vans(14 seater) pay annual fee of amount k and amount h for every extra seat
                     */
                    $fee = 0;
                    foreach ($vehicles as $vehicle) {
                        if ($vehicle->no_of_seat > 14) {
                            $fee += ($vehicle_fee->standard_fee * $vehicles->count()) + ($vehicle->no_of_seat - 14) * ($vehicle_fee->extra_fee);
                        }
                    }
                    break;
                default :
                    return redirect('invoice')
                                    ->with('global', '<div class="alert alert-danger">The system could not generate invoice due to invalid data provided. Please try again and contact the system administrator if this message persists</div>');
            }
            $allVehicles = [];
            $i = 0;
            foreach ($vehicles as $vehicle) {
                $allVehicles[$i] = $vehicle->reg_no;
                $i+=1;
            }
// dd($allVehicles);
            $det['reg_id'] = $data->reg_id;
            $det['id'] = $data->id;
            $det['name'] = $data->name;
            $det['fee'] = $fee;
            $det['licensed_vehicles'] = $allVehicles;
            $det['type_id'] = $data->type_id;
            $det['group_type'] = $data->vehicle_type->group;
            $det['no_vehicle'] = $vehicles->count();
            $det['value'] = $data->reg_id;
            $det['label'] = "{$data->reg_id}, {$data->name}";
            $matches[] = $det;
        }
        print json_encode($matches);
    }

    public function getVehicleDetails() {
        $reg_no = trim(strip_tags($_GET['term']));
//$reg_no = 'KBL';
        $group_data = \App\Vehicle::with('vehicle_type')
                ->where('reg_no', 'like', '%' . $reg_no . '%')
                ->get(['id', 'reg_no', 'tlb_no', 'no_of_seat', 'vehicle_make', 'group_id', 'type_id']);

        foreach ($group_data as $data) {
            if ($data->group_id == NULL) {
                $det['group_name'] = '';
                $det['reg_id'] = '';
            } else {

                $get_group = \App\Group::find($data->group_id);
//dd($get_group->name);
                $det['group_name'] = $get_group->name;
                $det['reg_id'] = $get_group->reg_id;
                $det['group_id'] = $data->group_id;
            }
            switch ($data->type_id) {
                case 1:
                    $vehicle_fee = \App\Charge::find($data->type_id);
                    $fee = $vehicle_fee->standard_fee;
                    $det['group_type'] = $data->vehicle_type->name;
                    break;
                case 2:
                    $vehicle_fee = \App\Charge::find($data->type_id);
                    $fee = $vehicle_fee->standard_fee;
                    $det['group_type'] = $data->vehicle_type->name;
                    break;
                case 3:
                    $vehicle_fee = \App\Charge::find($data->type_id);
                    $fee = $vehicle_fee->standard_fee;
                    $det['group_type'] = $data->vehicle_type->name;
                    break;
                case 4:
                    $vehicle_fee = \App\Charge::find($data->type_id);
                    $fee = $vehicle_fee->standard_fee;
                    $det['group_type'] = $data->vehicle_type->name;
                    break;
                case 5:
                    $vehicle_fee = \App\Charge::find($data->type_id);
                    $fee = $vehicle_fee->standard_fee;
                    $det['group_type'] = $data->vehicle_type->name;
                    break;
                case 6:
                    $vehicle_fee = \App\Charge::find($data->type_id);
                    $fee = $vehicle_fee->standard_fee;
                    $det['group_type'] = $$data->vehicle_type->name;
                    break;
                default :
                    break;
            }

// dd($allVehicles);
            $det['reg_no'] = $data->reg_no;
            $det['id'] = $data->id;
            $det['tlb_no'] = $data->tlb_no;
            $det['fee'] = $fee;
            $det['value'] = $data->reg_no;
            $det['label'] = "{$data->reg_no}, {$data->vehicle_make}";
            $matches[] = $det;
        }
        print json_encode($matches);
    }

    public function getInvoice($id) {
        $invoice = \App\Invoice::with('group', 'vehicle','status_finance','status_manager')->find($id);
//dd($invoice);
        return $invoice;
    }

    public function viewCert($id) {
        $check = \App\User_role::where('user_id', \Auth::user()->id)
                ->where('role_id', 3)
                ->count();
        if ($check) {
            $certs = \App\Invoice::with('group', 'vehicle')->find($id);
//dd($certs);
            return view('invoice.view-cert', array('cert' => $certs));
//$data = array("Test1", "Test2", "Test3");
//        $pdf = \PDF::loadView('invoice.view-cert', array('cert' => $certs));
//        return $pdf->stream();
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">You do not have the license viewing/printing rights</div>');
        }
    }

    public function printCert($id) {
//        $id = 3;
//        $certs = \App\Invoice::with('group', 'vehicle')->find($id);
//        //$certs = \App\Invoice::with('group', 'vehicle')->find($id);
//        $pdf = \PDF::loadView('invoice.print-cert',array('cert' => $certs));
//        
//        return $pdf->download('/invoice.pdf');
        $certs = \App\Invoice::with('group', 'vehicle')->find($id)->toArray();
//dd($certs['id']);
        $rows = 0;
        $licensed_vehicle = explode(",", $certs['licensed_vehicles']);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('<?php
        $rows = 0;
        $licensed_vehicle = explode(",", $certs["licensed_vehicles"]);
        //dd($licensed_vehicle);
        ?>
        <table>
        <?php
            for($i=0;$i< sizeof($licensed_vehicle); $i++){
            
            // dd($cert->id);
            $seats = \App\Vehicle::where("reg_no", $licensed_vehicle[$i])->get(["no_of_seat"])->first();
            $rows +=1;
            if ($cert->invoice_type == "Group") {
                $sacco = $cert->group->name;
            } else {
                $sacco = "N/A";
            }
            
            if($rows%4 == 0){ ?>
            <tr>
                <?php } ?>
                <td>
                    <h3 style="color: white">K</h3>
                    <h3></h3>
<!--                    <p>Serial Number </p>-->
                    <p style="margin-left: 40%"><?php sprintf("%06d",$cert->id)?>
<!--                    <p>SACCO/COMPANY </p>-->
                    <p style="margin-left: 55%"><?php echo $sacco;?></p>
<!--                    <p>Registration Number</p>-->
                    <p style="margin-left: 55%"><?php echo strtoupper($licensed_vehicle[$i])?></p>
            <barcode><?php echo \DNS2D::getBarcodeHTML("4445645656", "QRCODE",2,2); ?></barcode>
<!--                    <p>No. of Seats</p>-->
            <p style="margin-left: 40%"><?php echo $seats->no_of_seat; ?></p>
<!--                    <p><b>EXPIRY</b></p>-->
            <p style="margin-left: 25%"><b><?php echo $cert->expiry_date; ?></b></p>
            <p></p>
            <img src="/images/sign.png"/>
<!--                    <p>SIGNED</p>-->
            <p style="margin-left: 20%">SIGN</p>
        </td>
        <?php if($rows%4 == 0)?>
    </tr>
    <?php 
    }
    }?>');
        return $pdf->stream();
    }

    public function approve($id) {
        $finance_approval = \App\Status_finance::where('invoice_id', \Hashids::decode($id))->get();
//Check if approved
        if ($finance_approval->count() < 1) {
//Check if user has finance access rights
            $check = \App\User_role::where('user_id', \Auth::user()->id)
                    ->where('role_id', 3)
                    ->count();
            if ($check < 1) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">You do not have the finance approval rights</div>');
            } else {
//dd(\Hashids::decode($id));
                $invoice = \App\Invoice::find(\Hashids::decode($id));
                return view('invoice.approve-invoice-finance', array('invoices' => $invoice, 'status' => $finance_approval));
            }
        } else {

            //dd($finance_approval->toArray());
//Check if was approved or rejected
            if ($finance_approval[0]->status == 'Approved') {
//Check if user has managerial rights
                $check = \App\User_role::where('user_id', \Auth::user()->id)
                        ->where('role_id', 2)
                        ->count();
                if ($check > 0) {
//Check if is approved by manager
                    $manager_approval = \App\Status_manager::where('invoice_id', \Hashids::decode($id))->get();
                    if ($manager_approval->count() < 1) {
//Check if user has manager access rights
                        $check = \App\User_role::where('user_id', \Auth::user()->id)
                                ->where('role_id', 3)
                                ->count();
                        if ($check < 1) {
                            return redirect('/invoice/view-invoices')
                                            ->with('global', '<div class="alert alert-warning">You do not have the managerial approval rights</div>');
                        } else {
                            $invoice = \App\Invoice::find(\Hashids::decode($id));
                            return view('invoice.approve-invoice-manager', array('invoices' => $invoice, 'status' => $manager_approval));
                        }
                    } else {
                        return redirect('/invoice/view-invoices')
                                        ->with('global', '<div class="alert alert-warning">Invoice has already been approved by manager</div>');
                    }
                } else {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">You do not have the managerial approval rights</div>');
                }
                
            } else {

                $check = \App\User_role::where('user_id', \Auth::user()->id)
                        ->where('role_id', 3)
                        ->count();
                if ($check < 1) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">You do not have the finance approval rights</div>');
                } else {
//dd(\Hashids::decode($id));
                    $invoice = \App\Invoice::find(\Hashids::decode($id));
                    return view('invoice.approve-invoice-finance', array('invoices' => $invoice, 'status' => $finance_approval));
                }
            }
        }
    }

    public function financeApproval() {
        if (isset($_POST['approve'])) {
            $approved = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($approved->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved</div>');
            }
            $finance_approval = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');

            if ($finance_approval->count() > 0) {
                $approve = $finance_approval
                        ->update(array(
                    'status' => 'Approved',
                    'user_id' => Auth::user()->id
                        )
                );
                if ($approve) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-success">Invoice successfully approved</div>');
                } else {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
                }
            }
            $approve = \App\Status_finance::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Approved',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($approve) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
            }
        } else if (isset($_POST['reject'])) {
            $rejected = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved</div>');
            }
            $finance_reject = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');

            if ($finance_reject->count() > 0) {

                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice has already been approved</div>');
            }

            $reject = \App\Status_finance::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Rejected',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($reject) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
            }
        } else {
            $approved = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved</div>');
            }
            $finance_delete = \App\Status_finance::where('invoice_id', \Request::get('id'))->delete();
            if ($finance_delete) {
                \App\Invoice::find(\Hashids::decode($id))->delete();
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">This invoice has successfullly been deleted</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice counld not be deleted</div>');
            }
        }
    }

    public function managerApproval() {
        if (isset($_POST['approve'])) {
            $approved = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($approved->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved</div>');
            }
            $manager_approval = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');

            if ($manager_approval->count() > 0) {
                $approve = $manager_approval
                        ->update(array(
                    'status' => 'Approved',
                    'user_id' => Auth::user()->id
                        )
                );
                if ($approve) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-success">Invoice successfully approved</div>');
                } else {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
                }
            }
            $approve = \App\Status_manager::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Approved',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($approve) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
            }
        } else if (isset($_POST['reject'])) {
            $rejected = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved</div>');
            }
            $manager_reject = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');

            if ($manager_reject->count() > 0) {

                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice has already been approved</div>');
            }

            $reject = \App\Status_manager::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Rejected',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($reject) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
            }
        } else {
            $approved = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved</div>');
            }
            $manager_delete = \App\Status_manager::where('invoice_id', \Request::get('id'))->delete();
            if ($manager_delete) {
                \App\Status_finance::where('invoice_id', \Request::get('id'))->delete();
                \App\Invoice::find(\Request::get('id'))->delete();
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">This invoice has successfullly been deleted</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice counld not be deleted</div>');
            }
        }
    }

}
