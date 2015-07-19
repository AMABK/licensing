@extends('layout.main')
@section('title')
Admin | Add user
@stop
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrator
            <small>Add user</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Add user</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add g <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>53</h3>
                        <p>Total Vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="#" class="small-box-footer">Add a vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>57<sup style="font-size: 20px">%</sup></h3>
                        <p>Belong to saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>65<sup style="font-size: 20px">%</sup></h3>
                        <p>Are company vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/sacco/add-sacco')}}" class="small-box-footer">Add sacco <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <!-- Left col -->
            <h3>Edit user {{strtoupper($user[0]->job_id)}}, [{{$user[0]->first_name}} {{$user[0]->last_name}} - {{$user[0]->designation->name}}] privileges</h3>
            <form method="POST" action="/post/edit-privileges">
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
                <style>
                    th{
                        color: gray;
                        border-color: blue;
                        border: 2px;
                    }
                    table{
                        border: 1px;
                        border-color: blue;
                    }
                </style>

                <table>
                    <tr><th style="width:32%; ">Privilege</th><th style="width:70%">Description</th><th style="width:20%">Access</th></tr>
                    @foreach ($priv as $privs) 
                    <?php
                    $i = 0;
                    ?>
                    @foreach ($user[0]->roles as $users) 
                    @if ($privs->id == $users->id) 
                    <tr><td>{{$privs->role}}</td><td>Description</td><td><input type="radio" checked="" name="{{$privs->id}}">Yes<input type="radio" name="{{$privs->id}}">No</td></tr>
                    <?php
                    $i++;
                    ?>
                    @endif
                    @endforeach
                    @if($i == 0)
                    <tr><td>{{$privs->role}}</td><td>Description</td><td><input type="radio" name="{{$privs->id}}">Yes<input type="radio" checked="" name="{{$privs->id}}">No</td></tr>
                    @endif
                    @endforeach
                </table
        </div>
        <button type="submit">Update Privileges</button>
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
    })
</script>   
@stop
