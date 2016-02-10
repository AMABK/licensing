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
    <section class="content">Wat
        <!-- Small boxes (Stat box) -->
<!--        <div class="row">
            <div class="col-lg-3 col-xs-6">
                 small box 
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/sacco/add-sacco')}}" class="small-box-footer">Add sacco <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> ./col 
            <div class="col-lg-3 col-xs-6">
                 small box 
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
            </div> ./col 
            <div class="col-lg-3 col-xs-6">
                 small box 
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
            </div> ./col 
            <div class="col-lg-3 col-xs-6">
                 small box 
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
            </div> ./col 
        </div> /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <!-- Left col -->
            <h3>Register a new user</h3>
            <form method="POST" action="/post/add-user">
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

                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required="" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required="" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="job_id">Job Id</label>
                    <input type="text" name="job_id" class="form-control" value="{{ old('job_id') }}" required="" placeholder="Job Id">
                </div>
                <div class="form-group">
                    <label for="national_id">National Id</label>
                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" required="" placeholder="National Id">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <select type="text" name="designation_id" class="form-control" >
                        <option value="" >Please select user designation</option>
                        @foreach($designations as $designation)
                        <option value="{{$designation->id}}" >{{$designation->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone_no">Password</label>
                    <input type="text" name="password" class="form-control" value="" required="" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="phone_no">Confirm Password</label>
                    <input type="text" name="password_confirmation" class="form-control" value="" required="" placeholder="Password Confirmation">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ old('phone_no') }}" required="" placeholder="Phone number">
                </div>
                    <button type="submit">Register</button>
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
