@extends('layout.main')
@section('title')
Invoice
@stop
@section('content')

<div class="content-wrapper" style="background-color: white;">
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
        <center><p>{!!Session::get('global')!!}</p>11111</center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <center><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Create a new invoice</button></center>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Select type of invoice</h4>
                        </div>
                        <div class="modal-body">
                            <center><a href="{{URL::to('/invoice/add-group-invoice')}}">CREATE A GROUP INVOICE </a></center>
                        </div>
                        <div class="modal-body">
                            <center><a href="{{URL::to('/invoice/add-vehicle-invoice')}}">CREATE A VEHICLE INVOICE </a></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script>
    $(document).ready(function () {
        $('#myTable').dataTable();
    });
</script>   
@stop
