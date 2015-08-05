<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Knp\Snappy\Pdf;

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
                $arr_reg_no = explode(',', \Request::get('licensed_vehicles'));
                for ($i = 0; $i < sizeof($arr_reg_no); $i++) {
                    $add_sn = \App\Serial_number::create(array(
                                'invoice_id' => $invoice->id,
                                'reg_no' => $arr_reg_no[$i],
                                'sn' => $this->generateSn()
                    ));
                    if (!$add_sn) {
                        \App\Serial_number::where('invoice_id', $invoice->id)->delete();
                        \App\Invoice::find($invoice->id)->delete();
                        return redirect('/invoice')
                                        ->with('global', '<div class="alert alert-warning">Group invoice could not be created created. Please try again!</div>');
                    }
                }
            }
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


            $invoice = \App\Invoice::create(array(
                        'invoice_no' => strtoupper(\Request::get('invoice_no')),
                        'payer_id' => \Request::get('id'),
                        'invoice_type' => 'Individual Invoice',
                        'group_type' => \Request::get('group_type'),
                        'discount' => \Request::get('discount'),
                        'reg_no' => strtoupper(\Request::get('reg_no')),
                        'total_fee' => \Request::get('total_fee'),
                        'no_vehicle' => 1,
                        'licensed_vehicles' => \Request::get('reg_no'),
                        'expiry_date' => \Request::get('expiry_date'),
                        'region_id' => \Request::get('region_id'),
                        'agent_id' => \Request::get('agent_id'),
                        'user_id' => \Auth::user()->id,
                        'description' => \Request::get('description')
                            )
            );
            if ($invoice) {

                $add_sn = \App\Serial_number::create(array(
                            'invoice_id' => $invoice->id,
                            'reg_no' => \Request::get('reg_no'),
                            'sn' => $this->generateSn()
                ));
            } else {
                \App\Serial_number::where('invoice_id', $invoice->id)->delete();
                \App\Invoice::find($invoice->id)->delete();
                return redirect('/invoice')
                                ->with('global', '<div class="alert alert-warning">Invoice details could not be saved into the database</div>');
            }
            if ($add_sn) {
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
        $invoices = \App\Invoice::with('status_manager', 'status_finance')->get();
        //dd($invoices);
        $i = 0;
        $status[0] = null;
        foreach ($invoices as $invoice) {
            if (isset($invoice->status_finance->status)) {
                $status[$i]['finance'] = $invoice->status_finance->status;
            } else {
                $status[$i]['finance'] = 'Approve';
            }
            if (isset($invoice->status_manager->status)) {
                $status[$i]['manager'] = $invoice->status_manager->status;
            } else {
                $status[$i]['manager'] = 'Approve';
            }
            if (isset($invoice->status_licensing->status)) {
                $status[$i]['licensing'] = $invoice->status_licensing->status;
            } else {
                $status[$i]['licensing'] = 'Approve';
            }
            $i++;
        }
        //dd($status);
        return view('invoice.view-invoices', array('invoice' => $invoices, 'status' => $status));
    }

    public function showDeleted() {
        $invoices = \App\Invoice::with('status_manager', 'status_finance')->onlyTrashed()->get();
        //dd($invoices);
        return view('invoice.view-deleted-invoices', array('invoice' => $invoices));
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
        if ($delete) {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-success">Invoice successfully deleted</div>');
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-danger">Whoooops, the invoice could not be deleted. Please try again!</div>');
        }
    }

    public function confirmDelete($id) {
        $check = \App\User_role::where('user_id', \Auth::user()->id)
                ->where('role_id', 3)
                ->count();
        if ($check > 0) {
            $destroy = \App\Invoice::onlyTrashed()->find(\Hashids::decode($id)[0])->forceDelete();
            if (!$destroy) {
                \App\Serial_number::where('invoice_id', \Hashids::decode($id)[0])->delete();
                \App\Status_manager::where('invoice_id', \Hashids::decode($id)[0])->deleted();
                \App\Status_finance::where('invoice_id', \Hashids::decode($id)[0])->deleted();
                \App\Status_licensing::where('invoice_id', \Hashids::decode($id)[0])->deleted();
                \App\Status_printed::where('invoice_id', \Hashids::decode($id)[0])->deleted();
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice permanently deleted</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice could not be permanently deleted</div>');
            }
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">You do not have privileges to permanently delete invoices. Please contact system administator</div>');
        }
    }

    public function restore($id) {
        $restore = \App\Invoice::onlyTrashed()->find(\Hashids::decode($id)[0])->restore();
        if ($restore) {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-success">Invoice successfully restored</div>');
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">Invoice could not be restored</div>');
        }
    }

    public function getGroupDetails() {
        $reg_id = trim(strip_tags($_GET['term']));
//$reg_id = '56';
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
                     * Matatu charges
                     * Each matatu pays annual fee of amount y
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 4:
                    /*
                     * Taxi vehicles
                     * Each vehicle pays an annual fee of amount z
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 5:
                    /*
                     * Company vehicle
                     * Each vehicle pays an annual fee of amount z
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 6:
                    /*
                     * Tour firms
                     * Tour vans(14 seater) pay annual fee of amount k and amount h for every extra seat
                     */
                    $fee = 0;
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
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
                    $det['group_type'] = $data->vehicle_type->name;
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
        $invoice = \App\Invoice::with('group', 'vehicle', 'status_finance', 'status_manager')->find($id);
        return $invoice;
    }

    public function viewCert($iId) {
        $id = \Hashids::decode($iId);
        $check = \App\User_role::where('user_id', \Auth::user()->id)
                ->where('role_id', 3)
                ->count();
        // Grant everyone right to view
        $cert = \App\Invoice::with('group', 'vehicle')->find($id[0]);
//dd($certs);
        return view('invoice.view-cert', array('cert' => $cert));
        //End of granting all rights
        if ($check) {
            $cert = \App\Invoice::with('group', 'vehicle')->find($id[0]);
//dd($certs);
            return view('invoice.view-cert', array('cert' => $cert));
//$data = array("Test1", "Test2", "Test3");
//        $pdf = \PDF::loadView('invoice.view-cert', array('cert' => $certs));
//        return $pdf->stream();
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">You do not have the license viewing/printing rights</div>');
        }
    }

// Prints the certificate
    public function printCert($iId) {
        $id = \Hashids::decode($iId);
        $check = \App\User_role::where('user_id', \Auth::user()->id)
                ->where('role_id', 5)
                ->count();
        $authorised = \App\Status_manager::where('invoice_id', $id[0])
                ->where('status', 'Approved')
                ->count();
        if ($authorised < 1) {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">This invoice has not been approved by CEO, please request approval before trying again</div>');
        }
        if ($check) {
            $printer_approval = \App\Status_printed::where('invoice_id', $id[0])->count();
            if ($printer_approval < 1) {
                $print = \App\Status_printed::create(array(
                            'invoice_id' => $id[0],
                            'status' => 'Printed',
                            'user_id' => \Auth::user()->id
                                )
                );
                if (!$print) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">License cound not be printed, system unable to update printing status</div>');
                }
            }


            $cert = \App\Invoice::with('group', 'vehicle')->find($id[0]);
//dd($certs);
            return view('invoice.print-cert', array('cert' => $cert));
//$data = array("Test1", "Test2", "Test3");
//        $pdf = \PDF::loadView('invoice.view-cert', array('cert' => $certs));
//        return $pdf->stream();
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">You do not have the license viewing/printing rights</div>');
        }
    }

    public function approve($id) {
        //Liensing approval
        $licensing_approval = \App\Status_licensing::where('invoice_id', \Hashids::decode($id))->get();
        if ($licensing_approval->count() < 1) {
            $check = \App\User_role::where('user_id', \Auth::user()->id)
                    ->where('role_id', 4)
                    ->count();
            if ($check < 1) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">You do not have the licensing approval rights</div>');
            } else {
//dd(\Hashids::decode($id));
                $invoice = \App\Invoice::find(\Hashids::decode($id));
                return view('invoice.approve-invoice-licensing', array('invoices' => $invoice, 'status' => $licensing_approval));
            }
        } else {
            $check = \App\User_role::where('user_id', \Auth::user()->id)
                    ->where('role_id', 4)
                    ->count();
            if ($check < 1) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">You do not have the licensing approval rights</div>');
            } else {
                //dd($licensing_approval);
                if ($licensing_approval[0]->status == 'Rejected') {
                    $invoice = \App\Invoice::find(\Hashids::decode($id));
                    return view('invoice.approve-invoice-licensing', array('invoices' => $invoice, 'status' => $licensing_approval))
                                    ->with('global', '<div class="alert alert-warning">This invoice had been previously rejected. Do you want to approve it?</div>');
                }
            }
            //Finance approval
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
    }

    public function licensingApproval() {
        if (isset($_POST['approve'])) {
            $approved = \App\Status_licensing::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($approved->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by licensing department</div>');
            }
            $finance_approval = \App\Status_licensing::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');

            if ($finance_approval->count() > 0) {
                $approve = $finance_approval
                        ->update(array(
                    'status' => 'Approved',
                    'user_id' => \Auth::user()->id
                        )
                );
                if ($approve) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-success">Invoice successfully approved by licensing department</div>');
                } else {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">Invoice approval by licensing department failed</div>');
                }
            }
            $approve = \App\Status_licensing::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Approved',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($approve) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved by licensing department</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval by licensing department failed</div>');
            }
        } else if (isset($_POST['reject'])) {
            $rejected = \App\Status_licensing::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by licensing department</div>');
            }
            $finance_reject = \App\Status_licensing::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');

            if ($finance_reject->count() > 0) {

                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice has already been rejected by licensing department</div>');
            }

            $reject = \App\Status_licensing::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Rejected',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($reject) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved by licensing department</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval by licensing department failed</div>');
            }
        } else {
            $approved = \App\Status_licensing::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by licensing department</div>');
            }
            $finance_delete = \App\Status_licensing::where('invoice_id', \Request::get('id'))->delete();
            if ($finance_delete) {
                \App\Invoice::find(\Hashids::decode($id))->delete();
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">This invoice has successfullly been deleted by licensing department</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice could not be deleted by licensing department</div>');
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
                    'user_id' => \Auth::user()->id
                        )
                );
                if ($approve) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-success">Invoice successfully approved by finance</div>');
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
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved approved by finance</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval failed</div>');
            }
        } else if (isset($_POST['reject'])) {
            $rejected = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by finance</div>');
            }
            $finance_reject = \App\Status_finance::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');

            if ($finance_reject->count() > 0) {

                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice has already been rejected by finance</div>');
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
                                ->with('global', '<div class="alert alert-success">This invoice has successfullly been deleted by finance</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice could not be deleted by finance</div>');
            }
        }
    }

    public function managerApproval() {
        if (isset($_POST['approve'])) {
            $approved = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($approved->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by manager</div>');
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
                                    ->with('global', '<div class="alert alert-success">Invoice successfully approved by manager</div>');
                } else {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">Invoice approval by manager failed</div>');
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
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved by manager</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval by manager failed</div>');
            }
        } else if (isset($_POST['reject'])) {
            $rejected = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Rejected');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by manager</div>');
            }
            $manager_reject = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');

            if ($manager_reject->count() > 0) {

                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice has already been approved by manager</div>');
            }

            $reject = \App\Status_manager::create(array(
                        'invoice_id' => \Request::get('id'),
                        'status' => 'Rejected',
                        'user_id' => \Auth::user()->id,
                            )
            );
            if ($reject) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">Invoice successfully approved by manager</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">Invoice approval by manager failed</div>');
            }
        } else {
            $approved = \App\Status_manager::where('invoice_id', \Request::get('id'))
                    ->where('status', 'Approved');
            if ($rejected->count() > 0) {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice has already been approved by manager</div>');
            }
            $manager_delete = \App\Status_manager::where('invoice_id', \Request::get('id'))->delete();
            if ($manager_delete) {
                \App\Status_finance::where('invoice_id', \Request::get('id'))->delete();
                \App\Invoice::find(\Request::get('id'))->delete();
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-success">This invoice has successfullly been deleted by manager</div>');
            } else {
                return redirect('/invoice/view-invoices')
                                ->with('global', '<div class="alert alert-warning">This invoice counld not be deleted by manager</div>');
            }
        }
    }

    public function generateSn() {
        $check = \App\Serial_number::all()->count();
        if ($check < 1) {
            return 'KP-PSV-A-00001';
        }
        $pick_latest = \DB::select('SELECT * FROM serial_numbers ORDER BY id DESC LIMIT 1');
        $sn_array = explode("-", $pick_latest[0]->sn);
        if ($sn_array[2] == 'Z' && intval($sn_array[3]) > 90000) {
            $remainder = 99999 - intval($sn_array[3]);
            $request->session()->flash('status', '<div class="alert alert-warning">There are ONLY ' . $remainder . ' license serial numbers remaining. Please contact the product owner to add new parameters.</div>');
            if (intval($sn_array[3]) > 99998) {
                return redirect('/')
                                ->with('global', '<div class="alert alert-danger">You exhausted the existing license serial numbers. Please contact the product owner!</div>');
            }
        }
        if (intval($sn_array[3]) < 99999) {
            $digit = intval($sn_array[3]) + 1;
            $new_num = str_pad($digit, 5, '0', STR_PAD_LEFT);
            $new_sn = 'KP-PSV-' . $sn_array[2] . '-' . $new_num;
            return $new_sn;
        } else {
            $new_alp = chr(ord($sn_array[2]) + 1);
            $new_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            $new_sn = 'KP-PSV-' . $new_alp . '-' . $new_num;
            return $new_sn;
        }
    }

    public function printInvoice() {
        // dd(\Request::all());
        $input = \Request::all();
        // dd($input['print']);
        $i = 0;
        $k = 0;
        if (sizeof($input) > 2) {
            foreach ($input['print'] as $key => $value) {
                $arr[$i] = $key;
                $i++;
            }
            foreach ($arr as $key => $value) {
                //Check whether all are approved
                $id = $value;
                $check = \App\User_role::where('user_id', \Auth::user()->id)
                        ->where('role_id', 5)
                        ->count();
                $authorised = \App\Status_manager::where('invoice_id', $id)
                        ->where('status', 'Approved')
                        ->count();
                if ($authorised < 1) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">One of the invoice you selected has not been approved by CEO, please request approval before trying again</div>');
                }
                if ($check < 1) {
                    return redirect('/invoice/view-invoices')
                                    ->with('global', '<div class="alert alert-warning">One of the invoice you selected has not been approved by CEO, please request approval before trying again</div>');
                }
                $printer_approval = \App\Status_printed::where('invoice_id', $value)->count();
                if ($printer_approval < 1) {
                    $print = \App\Status_printed::create(array(
                                'invoice_id' => $value,
                                'status' => 'Printed',
                                'user_id' => \Auth::user()->id
                                    )
                    );
                    if (!$print) {
                        return redirect('/invoice/view-invoices')
                                        ->with('global', '<div class="alert alert-warning">License cound not be printed, system unable to update printing status</div>');
                    }
                }
                //echo "Key: $key; Value: $value<br />\n";
                $cert[$key] = \App\Invoice::with('group', 'vehicle')->find($value);
                $licensed_vehicle = explode(",", $cert[$key]->licensed_vehicles);
                for ($i = 0; $i < sizeof($licensed_vehicle); $i++) {
                    $get_sn = \App\Serial_number::where('invoice_id', $cert[$key]->id)
                            ->where('reg_no', $licensed_vehicle[$i])
                            ->get()
                            ->toArray();

                    $seats = \App\Vehicle::where("reg_no", $licensed_vehicle[$i])->get(["no_of_seat"])->first();
                    if ($cert[$key]->invoice_type == "Group Invoice") {
                        $sacco = $cert[$key]->group->name;
                    } else {
                        $sacco = "N/A";
                    }
                    $license[$k]['sn'] = $get_sn[0]['sn'];
                    $license[$k]['sacco'] = $sacco;
                    $license[$k]['reg_no'] = strtoupper($licensed_vehicle[$i]);
                    $license[$k]['no_of_seat'] = $seats->no_of_seat;
                    $license[$k]['expiry_date'] = $cert[$key]->expiry_date;

                    $k++;
                }
            }
            //dd($license);
            return view('invoice.mass-print-cert', array('licenses' => $license));
        } else {
            return redirect('/invoice/view-invoices')
                            ->with('global', '<div class="alert alert-warning">You have not slected any invoices for mass printing</div>');
        }
    }

}
