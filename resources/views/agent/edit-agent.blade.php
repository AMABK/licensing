@extends('layout.main')
@section('title')
Add agent
@stop
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            
            <small>Edit agent</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/agent')}}"><i class="fa fa-dashboard"></i> Agents</a></li>
            <li class="active">Edit user</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @if(Session::has('global'))
        <center><p>{!!Session::get('global')!!}</p></center>
        @endif
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 15%;margin-top: 5%">
            <!-- Left col -->
            <h3>Register a new agent</h3>
            <form method="POST" action="/post/edit-agent">
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
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$agent->name}}" required="" placeholder="Name">
                    <input type="text" name="id" value="{{$agent->id}}" hidden="" required="" >
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ $agent->phone_no}}" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="region">Region</label>
                    <select type="text" name="region_id" required="" class="form-control" >
                        <option value="{{$agent->region_id}}" >{{$agent->region->name}}</option>
                        @foreach($regions as $region)
                        <option value="{{$region->id}}" >{{$region->name}}</option>
                        @endforeach
                    </select>
                </div>
                    <button class="btn btn-primary" type="submit">Update</button>
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
