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
        <!-- /.row -->
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
                <div class="form-group">
                    <input type="text" name="id" value="{{$vehicles->id}}" hidden="">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" name="reg_no" style="text-transform:uppercase" class="form-control" value="{{$vehicles->reg_no }}" required="" readonly="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="vehicle_make">Vehicle Make</label>
                    <input type="text" class="form-control" name="vehicle_make" class="form-control" value="{{ $vehicles->vehicle_make }}" placeholder="Vehicle make">
                </div>
                <div class="form-group">
                    <label for="tlb_no">TLB Number</label>
                    <input type="text" style="text-transform:uppercase" name="tlb_no" class="form-control" value="{{ $vehicles->tlb_no }}" required=""  placeholder="TLB No.">
                </div>
                <div class="form-group">
                    <label for="no_of_seat">Number of seats</label>
                    <input type="text" name="no_of_seat" class="form-control" value="{{ $vehicles->no_of_seat }}" required="" placeholder="Number of seats">
                </div>
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
    $('#category').on('change', function () {
        if (($(this).val() == 6) || ($(this).val() == 2) || ($(this).val() == 3) || ($(this).val() == 4) || ($(this).val() == 5)) {
            $("#group").show()
        }
        else {
            $("#group").hide()
        }
    });

</script> 
<script>
    $('#reg_id').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/group/autocomplete',
                dataType: "json",
                data: {
                    name_has: request.term,
                    type: 'reg_id'
                },
                success: function (data) {
                    var groupArray = data;
                    //console.log(groupArray.reg_id);
                    var arr = new Array;
                    for (var i = 0; i < groupArray.length; i++) {
                        arr[i] = groupArray[i].reg_id;
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
        minLength: 2
    });

</script>   
@stop
