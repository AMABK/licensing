@extends('layout.main')
@section('title')
Update Charges
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
        <!-- /.row -->
        <center>
            @if(Session::has('global'))
            <p>{!!Session::get('global')!!}</p>
            @endif
        </center>
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Update Charges</h3>
            <form method="POST" action="/admin/view-charges">
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
                       @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">These are charges that the system uses to calculate amount to be charged</div>

                    <!-- Table -->
                    <table class="table">
                        <thead><th>Group Type</th><th>Std no. of seats</th><th>Standard Fee</th><th>Extra fee/seat</th></thead>
                    @foreach($charge as $charges)
                    <tr>
                        <th>{{$charges->name}}</th>
                        <td><input type="text" name="seat[{{$charges->id}}]" required="" value="{{$charges->charge->standard_seats}}"</td>
                        <td><input type="text" name="std_fee[{{$charges->id}}]" required="" value="{{$charges->charge->standard_fee}}"</td>
                        <td><input type="text" name="extra_fee[{{$charges->id}}]" required="" value="{{$charges->charge->extra_fee}}"</td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                <div>
                    <button type="submit" name="update">Update charges</button>
                    <button type="submit" name="close" style="float: right">Close</button>
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
