@extends('layout.main')
@section('title')
Add Group
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
        <center>
            @if(Session::has('global'))
            <p>{!!Session::get('global')!!}</p>
            @endif
        </center>
        <!-- Main row -->
        <div class="row" style="width: 70%; margin-left: 10%">
            <!-- Left col -->
            <h3>Register a new group</h3>
            <form method="POST" action="/post/add-group">
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
                    <label for="name">Group Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="reg_id">Registration Number</label>
                    <input type="text" style="text-transform:uppercase" name="reg_id" class="form-control" value="{{ old('reg_id') }}" required="" placeholder="Registration Number">
                </div>
                <div class="form-group">
                    <label for="type">Group Type</label>
                    <select type="text" name="type_id" id="category" class="form-control" required="">
                        @foreach($group as $groups)
                        @if($groups->group == null)
                        @else
                         <option  value="{{$groups->id}}" class="no_sacco" >{{$groups->group}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    <input type="text" name="user_id" value="{{\Auth::user()->id}}" hidden="" >
                </div>
                <div class="form-group">
                    <label for="address">Postal Address</label>
                    <input type="text" name="postal_address" class="form-control" value="P.O Box" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="address">Physical Address</label>
                    <input type="text" name="physical_address" class="form-control" value="{{ old('physical_address') }}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ old('phone_no') }}" required="" placeholder="Phone number">
                </div>
                <div>
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
