
<?php
//require_once base_path('dompdf/dompdf_config.inc.php');

ob_start();
?>
<style>
    li { 
        list-style: none; 
    }
    body{
        font-size: 14px;
    }   
    table, th, td {
        border: 1px solid black;
    }
    barcode{
        position:absolute;
        margin-left: 74%;
        padding-top: 32px;
    }
    img{
        position:absolute;
        margin-left: 30%;
       padding-top: -25px;

    }
</style>
<html>
    <body>
        <?php
        $rows = 0;
        $licensed_vehicle = explode(",", $cert->licensed_vehicles);
        ?>
        <table style="width: auto">
            <tbody>
                @for($i=0;$i< sizeof($licensed_vehicle); $i++)
                <?php
                $size = (((sizeof($licensed_vehicle))/4)*241)+700;
                $get_sn = App\Serial_number::where('invoice_id', $cert->id)
                        ->where('reg_no', $licensed_vehicle[$i])
                        ->get()
                        ->toArray();
                //dd($get_sn);
                $seats = \App\Vehicle::where("reg_no", $licensed_vehicle[$i])->get(["no_of_seat"])->first();
                if ($cert->invoice_type == "Group") {
                    $sacco = $cert->group->name;
                } else {
                    $sacco = "N/A";
                }
                $link = \App\Sign_link::where('status',1)->first();
                ?>
                @if($rows%4 == 0)
                <tr>
                    @endif
                    <td style="width: 282.1px;height: 282.1px ">
            <li>
                <ul style="padding-top: 2%;padding-left: 28%">{{$get_sn[0]['sn']}}</ul>
                <ul style="padding-left: 44%;padding-top: -1px">{{$sacco}}</ul>
                <ul style="padding-left: 47%">{{strtoupper($licensed_vehicle[$i])}}</ul>
               
                <ul style="padding-left: 35%; padding-top: -3px;padding-bottom: -10px">{{$seats->no_of_seat}}</ul> <barcode>{!!\DNS2D::getBarcodeHTML($get_sn[0]['sn'], "QRCODE",3.4,3.4)!!}</barcode>
                <ul style="padding-left: 35%; padding-bottom: 28px">{{$cert->expiry_date}}</ul><img src="{{$link->link}}sign.png" width="80px" height="26px"/>
                <ul></ul>
                
                
            
        </li>
    </td>
    <?php
    if($rows%4 == 0){
    $rows +=1;
    }
?>
@endfor
</tbody>
</table>
</body>
</html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
//default size =863.89
$customPaper = array(0,0,933,$size);
$dompdf->set_paper($customPaper);
$dompdf->load_html($html);
$dompdf->render();
date_default_timezone_set('Africa/Nairobi');
$filename = date('m/d/Y h:i:s a', time());
$dompdf->stream($filename.".pdf");
?>