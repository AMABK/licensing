<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        @foreach($cert as $cert)
        <?php
        $rows = 0;
        $licensed_vehicle = explode(",", $cert->licensed_vehicles);
        
        ?>
        <div class="container">
            @for($i=0;$i< sizeof($licensed_vehicle); $i++)
            <?php
            $get_sn = App\Serial_number::where('invoice_id',$cert->id)
                    ->where('reg_no',$licensed_vehicle[$i])
                    ->get()
                    ->toArray();
            //dd($get_sn[0]['sn']);
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
                //$qr = ''.sprintf("%06d",$cert->id).'-'.strtoupper($licensed_vehicle[$i]);
                ?>
                <div class="col-sm-3">
                    <h3 style="color: white">K</h3>
                    <h3></h3>
<!--                    <p>Serial Number </p>-->
                    <p style="margin-left: 40%">{{$get_sn[0]['sn']}}
<!--                    <p>SACCO/COMPANY </p>-->
                    <p style="margin-left: 55%">{{$sacco}}</p>
<!--                    <p>Registration Number</p>-->
                    <p style="margin-left: 55%">{{strtoupper($licensed_vehicle[$i])}}</p>
                    
<!--                    <p>No. of Seats</p>-->
                    <p style="margin-left: 40%">{{$seats->no_of_seat}}</p>
<!--                    <p><b>EXPIRY</b></p>-->
                    <p style="margin-left: 45%"><b>{{$cert->expiry_date}}</b></p>
                    
                    <img src="/images/sign.png"/>
                    <barcode>{!!\DNS2D::getBarcodeHTML($get_sn[0]['sn'], "QRCODE",3,3)!!}</barcode>
<!--                    <p>SIGNED</p>-->
                    <p style="margin-left: 15%">SIGN</p>
                </div>
                @if($rows%4 == 0)
            </div>
            @endif
            @endfor
        </div>  
@endforeach
    </body>
</html>