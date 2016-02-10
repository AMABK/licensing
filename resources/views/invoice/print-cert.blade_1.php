
<?php
require_once base_path('dompdf/dompdf_config.inc.php');

ob_start();
?>
<style>
    li { 
        list-style: none; 
    }
    body{
        font-size: 8px;
    }   
    table, th, td {
        border: 1px solid black;
    }
    barcode,img{
        position:absolute;
        margin-left: 85%;

    }
    img{
        position:absolute;
        margin-left: 35%;

    }
</style>
<html>
    <body>
        @foreach($cert as $cert)
        <?php
        $rows = 0;
        $licensed_vehicle = explode(",", $cert->licensed_vehicles);
        ?>
        <table style="width: 100%;">
            @for($i=0;$i< sizeof($licensed_vehicle); $i++)
            <?php
            $get_sn = App\Serial_number::where('invoice_id', $cert->id)
                    ->where('reg_no', $licensed_vehicle[$i])
                    ->get()
                    ->toArray();
            //dd($get_sn);
            $seats = \App\Vehicle::where("reg_no", $licensed_vehicle[$i])->get(["no_of_seat"])->first();
            $rows +=1;
            if ($cert->invoice_type == "Group") {
                $sacco = $cert->group->name;
            } else {
                $sacco = "N/A";
            }
            ?>
            @if($rows%4 == 0)
            <tr>
                @endif
                <td style="width: 25%; ">
            <li>
                <ul style="padding-top: 5%;padding-left: 28%">{{$get_sn[0]['sn']}}</ul>
                <ul style="padding-left: 33%">{{$sacco}}</ul>
                <ul style="padding-left: 34%">{{strtoupper($licensed_vehicle[$i])}}</ul>
                <ul>14</ul>
                <ul style="padding-left: 25%">{{$seats->no_of_seat}}</ul>
                <ul style="padding-left: 19%">{{$cert->expiry_date}}</ul>
                <img src="/images/sign.png"/>
            <barcode>{!!\DNS2D::getBarcodeHTML($get_sn[0]['sn'], "QRCODE",3,3)!!}</barcode>
        </li>
    </td>
    @if($rows%4 == 0)
</tr>
@endif
@endfor
</table>
@endforeach
</body>
</html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");
?>