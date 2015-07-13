<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- Bootstrap 3.3.4 -->
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            barcode,img{
                position:absolute;
                margin-left: 85%;
                
            }
            img{
                position:absolute;
                margin-left: 35%;
                
            }
        </style>
    </head>
    <body>
        <?php
        $rows = 0;
        $licensed_vehicle = explode(",", $cert->licensed_vehicles);
        //dd($licensed_vehicle);
        ?>
        <div class="container">
            @for($i=0;$i< sizeof($licensed_vehicle); $i++)
            <?php
            // dd($cert->id);
            $seats = \App\Vehicle::where("reg_no", $licensed_vehicle[$i])->get(["no_of_seat"])->first();
            $rows +=1;
            if ($cert->invoice_type == "Group") {
                $sacco = $cert->group->name;
            } else {
                $sacco = "N/A";
            }
            ?>
            @if($rows%4 == 0)
            <div class="row">
                @endif
                <?php
                $qr = ''.sprintf("%06d",$cert->id).'-'.strtoupper($licensed_vehicle[$i]);
                ?>
                <div class="col-sm-3">
                    <h3 style="color: white">K</h3>
                    <h3></h3>
<!--                    <p>Serial Number </p>-->
                    <p style="margin-left: 40%">{{sprintf("%06d",$cert->id)}}
<!--                    <p>SACCO/COMPANY </p>-->
                    <p style="margin-left: 55%">{{$sacco}}</p>
<!--                    <p>Registration Number</p>-->
                    <p style="margin-left: 55%">{{strtoupper($licensed_vehicle[$i])}}</p>
                    
<!--                    <p>No. of Seats</p>-->
                    <p style="margin-left: 40%">{{$seats->no_of_seat}}</p>
<!--                    <p><b>EXPIRY</b></p>-->
                    <p style="margin-left: 45%"><b>{{$cert->expiry_date}}</b></p>
                    
                    <img src="/images/sign.png"/>
                    <barcode>{!!\DNS2D::getBarcodeHTML($qr, "QRCODE",2,2)!!}</barcode>
<!--                    <p>SIGNED</p>-->
                    <p style="margin-left: 15%">SIGN</p>
                </div>
                @if($rows%4 == 0)
            </div>
            @endif
            @endfor
        </div>
        <!-- jQuery 2.1.4 -->
        <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

        <!-- Bootstrap 3.3.2 JS -->
        <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    

    </body>
</html>