@extends('layout.main')
@section('title')
Add Vehicle
@stop
@section('content')
<link href="/dist/css/jquery-ui.css" rel="stylesheet" type="text/css" />
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
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/sacco/add-sacco')}}" class="small-box-footer">Add sacco <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
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
                <div class="small-box bg-yellow">
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
                <div class="small-box bg-red">
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
            <h3>Register a new vehicle</h3>
            <form method="POST" action="/post/add-vehicle">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" name="reg_no" style="text-transform:uppercase" class="form-control" value="{{ old('reg_no') }}" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="vehicle_make">Vehicle Make</label>
                    <input type="text" class="form-control" name="vehicle_make" class="form-control" value="{{ old('vehicle_make') }}" placeholder="Vehicle make">
                </div>
                <div class="form-group">
                    <input name="under_sacco" value="No" hidden="" readonly=""/>
                    <label for="category" >Category</label>
                    <select type="text" name="category" id="category" class="form-control" required="">
                        <option  value="Bus" class="no_sacco" >Bus</option>
                        <option  value="Taxi" class="no_sacco" >Taxi</option>
                        <option  value="Company Vehicle" class="no_sacco" >Company Vehicle</option>
                        <option value="Sacco Vehicle"  class="reg_id" >Sacco Vehicle</option>
                        <option  value="Other"  class="no_sacco" >Other</option>
                    </select>
                </div>
                <div id="sacco" style="display:none;">
                    <div class="form-group">
                        <label for="sacco_id" >Sacco</label>
                        <input name="reg_id" placeholder="Please select a valid Sacco Reg No" id="reg_id" class="form-control txt-auto"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tlb_no">TLB Number</label>
                    <input type="text" style="text-transform:uppercase" name="tlb_no" class="form-control" value="{{ old('tlb_no') }}" required=""  placeholder="TLB No.">
                </div>
                <div class="form-group">
                    <label for="no_of_seat">Number of seats</label>
                    <input type="text" name="no_of_seat" class="form-control" value="{{ old('no_of_seat') }}" required="" placeholder="Number of seats">
                </div>
                <button type="submit">Register</button>
        </div>
        </form>
        <script>

        </script>
        <!-- right col (We are only adding the ID to make the widgets sortable)-->

</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent
<script>
$('#category').on('change',function(){
    if( $(this).val()==="Sacco Vehicle"){
    $("#sacco").show()
    }
    else{
    $("#sacco").hide()
    }
});

</script>  
<script>$('#reg_id').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/sacco/autocomplete',
                dataType: "json",
                data: {
                    name_startsWith: request.term,
                    type: 'reg_id'
                },
                success: function (data) {
                    var saccoArray = data;
                    //console.log(saccoArray.reg_id);
                    var arr = new Array;
                    for (var i = 0; i < saccoArray.length; i++) {
                        arr[i] = saccoArray[i].reg_id;
                        // console.log(arr);
                    }
                    response($.map(arr, function (item) {
                        return {
                            label: item,
                            value: item

                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0
    });
</script>
@stop
