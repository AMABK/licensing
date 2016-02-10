@extends('layout.admin.main')

@section('content')
<style>
    table, td {
        border: 1px solid #086A87;
        background-color: #D8D8D8;
    }

    thead, th {
        background-color: #00BFFF;
        border: 1px solid #086A87;
        color: white;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
        background-color: #D8D8D8;
    }
    .nav-tabs>li>a {
        background-color: rgb(239, 224, 224);
    }

</style>
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



    <?php
    $m = 6;
    ?>

    <!-- Tab panes -->
    <div class="tab-content">
        @for($n = 1;$n<=$m;$n++)
        @if($n==1)
        <div role="tabpanel" class="tab-pane active" id="{{$n}}">.{{$n}}.</div>
        @endif
        @if($n>1)
        <div role="tabpanel" class="tab-pane" id="{{$n}}">.{{$n}}.</div>
        @endif
        @endfor
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @for($n = 1;$n<=$m;$n++)
        @if($n==1)
        <li role="presentation" class="active"><a href="#{{$n}}" aria-controls="{{$n}}" role="tab" data-toggle="tab">First</a></li>
        @endif
        @if(($n>1)&&($n<$m))
        <li role="presentation"><a href="#{{$n}}" aria-controls="{{$n}}" role="tab" data-toggle="tab">{{$n}}</a></li>
        @endif
        @if($n==$m)
        <li role="presentation"><a href="#{{$n}}" aria-controls="{{$n}}" role="tab" data-toggle="tab">Last</a></li>
        @endif
        @endfor
    </ul>


    <!-- Main content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="collapse navbar-collapse navbar-ex-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::route('s-view-tests')}}">&longleftarrow;Available Tests</a></li>
                </ul>
            </div>        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- <div class="col-lg-8">-->
        <div class="panel panel-default" >
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Attempted Tests
                <div class="pull-right">
                    <div class="btn-group">

                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" >
                @if(Session::has('global'))
                <p>{!!Session::get('global')!!}</p>
                @endif
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li class="active"><a href="#Primary" role="tab" data-toggle="tab">Tests</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="Primary">
                        <table id="myTable" width="100%">
                            <thead><tr><th>#</th><th>Exam Region</th><th>Code</th><th>Exam Type</th><th>Created on</th><th>Created by</th><th>Status</th><th>Take Test</th></tr></thead>
                            <?php
                            $counter = 1;
                            ?>
                            @foreach ($c_tests as $c_test)
                            <tbody><tr><td><?php echo $counter ?>. </td><td>{{ $c_test->county }}</td><td>{{ $c_test->code }}</td><td>{{ $c_test->exam_type }}</td><td>{{ $c_test->created_at }}</td><td>{{ $c_test->email }}</td><td>{{ $c_test->status }}</td>
                                    <td><form action="{{URL::route('post-take-test')}}" method="POST" accept-charset="UTF-8" style="display:inline" align="center">
                                            <?php
                                            $id = $c_test->id;
                                            ?>
                                            {!!Html::linkRoute('completed-tests-results','View Test',$c_test->id)!!}
                                            {!!Form::token()!!}
                                        </form></td></tr></tbody>
                            <?php
                            $counter++;
                            ?>
                            @endforeach
                            <thead><tr><th>#</th><th>Exam Region</th><th>Code</th><th>Exam Type</th><th>Created on</th><th>Created by</th><th>Status</th><th>Take Test</th></tr></thead>
                        </table>
                        </table>
                        <?php
                        ?>
                    </div>
                </div>                   
            </div>
            <!-- /.panel-body -->
        </div>

        <!--</div>
         /.col-lg-8 -->
        <!-- /.col-lg-4 -->
    </div>
</div>
@stop
@section('scripts')
@parent
<script>
    $(document).ready(function () {
        $('#myTable').dataTable();
    });
</script>
@include('layout.special.confirm-test')
@stop