@extends('layout.main')
@section('title')
Edit Sacco
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
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Edit sacco details</h3>
            <form method="POST" action="/post/edit-sacco">
                {!! csrf_field() !!}
                @foreach($saccos as $sacco)
                <div class="form-group">
                    <label for="name">Sacco Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $sacco->name }}" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="text" name="id" value="{{ $sacco->id }}" hidden="">
                    <label for="reg_id">Registration Number</label>
                    <input type="text" style="text-transform:uppercase" class="form-control" value="{{ $sacco->reg_id }}" readonly="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{  $sacco->email }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" value="{{  $sacco->address }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{  $sacco->phone_no }}" required="" placeholder="Phone number">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Number of vehicles</label>
                    <input type="text" name="no_vehicle" class="form-control" value="{{  $sacco->no_vehicle }}" required=""  placeholder="No of vehicles">
                </div>
                <div class="form-group">
                    <label for="yr_of_license">Year of license</label>
                    <input type="text" name="yr_of_license" class="form-control" value="{{  $sacco->yr_of_license }}" required="" placeholder="Year of license">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{  $sacco->expiry_date }}" required="" placeholder="MM/DD/YYYY [Expiry date]">
                </div>
                <div class="form-group">
                    <label for="fee_paid">Fee paid</label>
                    <input type="text" name="fee_paid" class="form-control" value="{{  $sacco->fee_paid }}" required="" placeholder="Fees paid">
                </div>
                @endforeach
                <div style="float: left">
                    <button type="submit" name="update">Update</button>
                </div>
                <div style="float: right">
                    <button type="submit"  name="delete">Delete</button>
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
        $('#myTable').dataTable();
    });
</script>   
@stop
