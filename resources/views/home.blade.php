@extends('layout.main')
@section('title')
Home
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
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['groups']}}</h3>
                        <p>Groups</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add group <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['matatu']}}</h3>
                        <p>Matatu Groups</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add a vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['taxi']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Taxi Group</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['tour']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Tour Group</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add group <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['company']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Companies</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add group <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['bus']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Bus Groups</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add group <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
<!--        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
             Left col 
            <h3>Register a new group</h3>
            <form method="POST" action="/group/add-group">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required="" placeholder=Name">
                </div>
                <div class="form-group">
                    <label for="reg_id">Registration Number</label>
                    <input type="text" name="reg_id" class="form-control" value="{{ old('reg_id') }}" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ old('phone_no') }}" required="" placeholder="Phone number">
                </div>
                <div class="form-group">
                    <label for="no_vehicle">Number of vehicles</label>
                    <input type="text" name="no_vehicle" class="form-control" value="{{ old('no_vehicle') }}" required=""  placeholder="No of vehicles">
                </div>
                <div class="form-group">
                    <label for="yr_of_license">Year of license</label>
                    <input type="date" name="yr_of_license" class="form-control" value="{{ old('yr_of_license') }}" required="" placeholder="Year of license">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry date</label>
                    <input type="text" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" required="" placeholder="MM/DD/YYYY [Expiry date]">
                </div>
                <div class="form-group">
                    <label for="fee_paid">Fee paid</label>
                    <input type="text" name="fee_paid" class="form-control" value="{{ old('fee_paid') }}" required="" placeholder="Fees paid">
                </div>
                <div>
                    <button type="submit">Register</button>
                </div>
            </form>
             right col (We are only adding the ID to make the widgets sortable)

        </div> /.row (main row) -->

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>   
@stop