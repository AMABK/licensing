
<?php
//require_once base_path('dompdf/dompdf_config.inc.php');
ob_start();
?>
<style>
    li { 
        list-style: none; 
        height: 22px;
    }
    body{
        font-size: 14px;
    }   
    table, th, td {
    }
    barcode{
        position:absolute;
        margin-left: -29.2%;
        padding-top: 49px;
    }
    img{
        position:absolute;
        margin-left: -80%;
        padding-top: 38px;

    }
</style>
<html>
    <body>
        <?php
        $rows = 0;
        $licensed_vehicle = explode(",", $cert->licensed_vehicles);
        ?>
        <table style="width: auto; padding-top: -7.3%">
            <tbody>
                @for($i=0;$i< sizeof($licensed_vehicle); $i++)
                <?php
                $size = (((sizeof($licensed_vehicle)) / 4) * 241) + 700;
                $get_sn = App\Serial_number::where('invoice_id', $cert->id)
                        ->where('reg_no', $licensed_vehicle[$i])
                        ->get()
                        ->toArray();
                //dd($get_sn);
                $seats = \App\Vehicle::where("reg_no", $licensed_vehicle[$i])->get(["no_of_seat"])->first();
                if ($cert->invoice_type == "Group Invoice") {
                    $sacco = $cert->group->name;
                } else {
                    $sacco = "N/A";
                }
                $link = \App\Sign_link::where('status', 1)->first();
                ?>
                @if($rows%4 == 0)
                <tr>
                    @endif
                    <td style="width: 283.1px;height: 283.1px ">
                        <ul>
                            <li style="padding-top: 4%;padding-left: 18%">{{$get_sn[0]['sn']}}</li>
                            <li style="padding-left: 44%; height: 15px;padding-bottom: 10px">{{$sacco}}</li>
                            <li style="padding-left: 47%; height: 26px">{{strtoupper($licensed_vehicle[$i])}}</li>              
                            <li style="padding-left: 35%;height: 32px; padding-top: 0px;">{{$seats->no_of_seat}}</li> <barcode>{!!\DNS2D::getBarcodeHTML($get_sn[0]['sn'], "QRCODE",3.4,3.4)!!}</barcode>
                            <li style="padding-left: 25%; padding-bottom: 25px">{{$cert->expiry_date}}</li>
                        </ul>
                    </td>
                    <?php
                        $rows +=1;
                    ?>
                    @if($rows%4 == 0)
                </tr>
                @endif
                @endfor
            </tbody>
        </table>
    </body>
</html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
//default size =863.89
$customPaper = array(0, 0, 933, $size);
$dompdf->set_paper($customPaper);
$dompdf->load_html($html);
$dompdf->render();
date_default_timezone_set('Africa/Nairobi');
$filename = date('m/d/Y h:i:s a', time());
$dompdf->stream($filename . ".pdf");
?>