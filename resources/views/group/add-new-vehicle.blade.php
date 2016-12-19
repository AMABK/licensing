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
      <!-- /.row -->
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <h3>Register a new vehicle under group/company Reg No[{{$group->reg_id}}], {{$group->name}}</h3>
            <form method="POST" action="/post/add-vehicle">
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
                    <label for="reg_no">Registration Number</label>
                    <input type="text" name="reg_no" style="text-transform:uppercase" class="form-control" value="{{ old('reg_no') }}" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <input type="text" name="reg_id" value="{{$group->reg_id}}" hidden="">
                    <input name="type_id" value="{{$group->type_id}}" hidden="" readonly=""/>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <input name="group_id" value="{{$group->id}}" hidden="" readonly=""/>
                    <input name="under_group" value="Yes" hidden="" readonly=""/>
                </div>
                <div class="form-group">
                    <label for="tlb_no">TLB Number</label>
                    <input type="text" style="text-transform:uppercase" name="tlb_no" class="form-control" value="{{ old('tlb_no') }}"  placeholder="TLB No.">
                </div>
                <div class="form-group">
                    <label for="no_of_seat">Number of seats</label>
                    <input type="text" name="no_of_seat" class="form-control" value="{{ old('no_of_seat') }}" required="" placeholder="Number of seats">
                </div>
                <button class="btn btn-success" type="submit" >Register</button>

            </form>
        </div>
        <!-- right col (We are only adding the ID to make the widgets sortable)-->

</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@stop
@section('scripts')
@parent

@stop
