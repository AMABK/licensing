@extends('layout.main')
@section('title')
Update Vehicle
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
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Saccos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add group <i class="fa fa-arrow-circle-right"></i></a>
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
                        <p>Belong to groups</p>
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
                    <a href="{{URL::to('/group/add-group')}}" class="small-box-footer">Add group <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <!-- Left col -->
            <h3>Update vehicle details</h3>
            <form method="POST" action="/post/edit-vehicle">
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
                @foreach($vehicles as $vehicle)
                <div class="form-group">
                    <input type="text" name="id" value="{{$vehicle->id}}" hidden="">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" name="reg_no" style="text-transform:uppercase" class="form-control" value="{{$vehicle->reg_no }}" required="" readonly="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="vehicle_make">Vehicle Make</label>
                    <input type="text" class="form-control" name="vehicle_make" class="form-control" value="{{ $vehicle->vehicle_make }}" placeholder="Vehicle make">
                </div>
                <div class="form-group">
                    <label for="category" >Category</label>
                    <select type="text" name="category" id="category" class="form-control" required="">                        
                        <?php
                        if ($vehicle->category == 'Bus') {
                            echo '<option  value="Bus" class="no_group" selected >Bus</option>';
                        } else {
                            echo '<option  value="Bus" class="no_group" >Bus</option>';
                        }
                        if ($vehicle->category == 'Taxi') {
                            echo '<option  value="Taxi" selected class="no_group" >Taxi</option>';
                        } else {
                            echo '<option value="Taxi"  class="group_id" >Taxi</option>';
                        }
                        if ($vehicle->category == 'Company Vehicle') {
                            echo '<option  value="Company Vehicle" selected class="no_group" >Company Vehicle</option>';
                        } else {
                            echo '<option value="Company Vehicle"  class="group_id" >Company Vehicle</option>';
                        }
                        if ($vehicle->category == 'Sacco Vehicle') {
                            echo '<option value="Sacco Vehicle" selected  class="group_id" >Sacco Vehicle</option>';
                        } else {
                            echo '<option value="Sacco Vehicle"  class="group_id" >Sacco Vehicle</option>';
                        }
                        if ($vehicle->category == 'Other') {
                            echo '<option  value="Other" selected class="no_group" >Other</option>';
                        } else {
                            echo '<option  value="Other"  class="no_group" >Other</option>';
                        }
                        ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="group_id" >Sacco</label>
                    <select type="text" name="group_id" class="form-control" id="group_id" required="">
                        @if($vehicle->group_id != NULL)
                        <option value="{{$vehicle->group->id}}"  class="Sacco Vehicle" >{{$vehicle->group->name}}</option>
                        @else
                        <option value="" >Active only when Sacco Vehicle is selected</option>
                        @endif
                        @foreach($group as $groups)
                        <option value="{{$groups->id}}"  class="Sacco Vehicle" >{{$groups->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tlb_no">TLB Number</label>
                    <input type="text" style="text-transform:uppercase" name="tlb_no" class="form-control" value="{{ $vehicle->tlb_no }}" required=""  placeholder="TLB No.">
                </div>
                <div class="form-group">
                    <label for="no_of_seat">Number of seats</label>
                    <input type="text" name="no_of_seat" class="form-control" value="{{ $vehicle->no_of_seat }}" required="" placeholder="Number of seats">
                </div>
                @endforeach
                <div style="float: left">
                    <button type="submit" name="update">Update</button>
                </div>
                <div style="float: right">
                    <button type="submit"  name="delete">Delete</button>
                </div>
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
    //Chaining script
    (function ($) {
        $.fn.chained = function (parent_selector, options) {
            return this.each(function () {
                var self = this;
                var backup = $(self).clone();
                $(parent_selector).each(function () {
                    $(this).bind("change", function () {
                        $(self).html(backup.html());
                        var selected = "";
                        $(parent_selector).each(function () {
                            selected += "\\" + $(":selected", this).val();
                        });
                        selected = selected.substr(1);
                        var first = $(parent_selector).first();
                        var selected_first = $(":selected", first).val();
                        $("option", self).each(function () {
                            if (!$(this).hasClass(selected) && !$(this).hasClass(selected_first) && $(this).val() !== "") {
                                $(this).remove();
                            }
                        });
                        if (1 == $("option", self).size() && $(self).val() === "") {
                            $(self).attr("disabled", "disabled");
                        } else {
                            $(self).removeAttr("disabled");
                        }
                        $(self).trigger("change");
                    });
                    if (!$("option:selected", this).length) {
                        $("option", this).first().attr("selected", "selected");
                    }
                    $(this).trigger("change");
                });
            });
        };
        $.fn.chainedTo = $.fn.chained;
    })(jQuery);
    $("#group_id").chained("#category");
</script>
<script>
    $(document).ready(function () {

        $('#myTable').DataTable();
    });
</script>   
@stop
