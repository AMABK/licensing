@extends('layout.main')
@section('title')
View users
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

        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="margin: 3px">
            <!-- Left col -->
            <h3>Registered users</h3>
            <table id="myTable" width="100%">
                <thead><tr><th>Job ID</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th>Designation</th><th>Status</th><th>Add User</th><th>Privileges</th></tr></thead>
                <tbody>
                    @foreach ($user as $users)
                    <tr>
                        <td><a href="{{URL::to('admin/edit-user/'.\Hashids::encode($users->id))}}"> {{strtoupper($users->job_id)}}</a></td><td>{{ $users->first_name }}</td><td>{{ $users->last_name }}</td><td>{{ $users->phone_no }}</td><td>{{ $users->email }}</td><td>{{ $users->designation_id }}</td><td>{{ $users->status ? 'Active':'Suspended' }}</td><td><a href="{{URL::to('/admin/add-user')}}">Add</a></td><td><a href="{{URL::to('/admin/manage-user/'.Hashids::encode($users->id))}}">Privileges</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot><tr><th>Job ID</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th>Designation</th><th>Status</th><th>Add User</th><th>Privileges</th></tr></thead>
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
</script>   
@stop