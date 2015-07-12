<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
            <style>
            barcode,img{
                position:absolute;
                margin-left: 85%;
                
            }
            img{
                position:absolute;
                margin-left: 35%;
                
            }
            .cert-row{
                
            }
        </style>
    <?php
    $rows = 0;
    $licensed_vehicle = explode(",", $cert->licensed_vehicles);
    //dd($licensed_vehicle);
    ?>
        <div class="row" style="width: 100px">
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
        <div class="col-lg-3" style="width: 20px">
            @endif
<!--                    <p>Serial Number </p>-->
            <p style="margin-left: 40%">{{sprintf("%06d",$cert->id)}}</p>
<!--                    <p>SACCO/COMPANY </p>-->
            <p style="margin-left: 55%">{{$sacco}}</p>
<!--                    <p>Registration Number</p>-->
            <p style="margin-left: 55%">{{strtoupper($licensed_vehicle[$i])}}</p>
<!--                    <p>No. of Seats</p>-->
            <p style="margin-left: 40%">{{$seats->no_of_seat}}</p>
            <barcode>{!!\DNS2D::getBarcodeHTML("4445645656", "QRCODE",2,2)!!}</barcode>
<!--                    <p><b>EXPIRY</b></p>-->
        <p style="margin-left: 45%"><b>{{$cert->expiry_date}}</b></p>

            <img src="/images/sign.png"/>
<!--                    <p>SIGNED</p>-->
            <p style="margin-left: 15%">SIGN</p>
        @if($rows%4 == 0)
        </div>
    @endif
        @if($rows%4 == 0)
        <div class="col-lg-3" style="width: 20px">
            @endif
<!--                    <p>Serial Number </p>-->
            <p style="margin-left: 40%">{{sprintf("%06d",$cert->id)}}</p>
<!--                    <p>SACCO/COMPANY </p>-->
            <p style="margin-left: 55%">{{$sacco}}</p>
<!--                    <p>Registration Number</p>-->
            <p style="margin-left: 55%">{{strtoupper($licensed_vehicle[$i])}}</p>
<!--                    <p>No. of Seats</p>-->
            <p style="margin-left: 40%">{{$seats->no_of_seat}}</p>
            <barcode>{!!\DNS2D::getBarcodeHTML("4445645656", "QRCODE",2,2)!!}</barcode>
<!--                    <p><b>EXPIRY</b></p>-->
        <p style="margin-left: 45%"><b>{{$cert->expiry_date}}</b></p>

            <img src="/images/sign.png"/>
<!--                    <p>SIGNED</p>-->
            <p style="margin-left: 15%">SIGN</p>
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