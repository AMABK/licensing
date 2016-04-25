@extends('layout.main')
@section('title')
Vehicle
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
                        <h3>{{$counts['vehicles']}}</h3>
                        <p>Total registered vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/vehicle/add-vehicle')}}" class="small-box-footer">Add vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['matatu']}}</h3>
                        <p>Matatus</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bus"></i>
                    </div>
                    <a href="{{URL::to('/vehicle/add-vehicle')}}" class="small-box-footer">Add a vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['taxi']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Taxis</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="{{URL::to('/vehicle/add-vehicle')}}" class="small-box-footer">Add vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['tour']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Tour vans</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/vehicle/add-vehicle')}}" class="small-box-footer">Add vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['company']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Comany vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/vehicle/add-vehicle')}}" class="small-box-footer">Add vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{$counts['bus']}}<sup style="font-size: 20px"></sup></h3>
                        <p>Buses</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{URL::to('/vehicle/add-vehicle')}}" class="small-box-footer">Add vehicle <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script>

</script>   
@stop
