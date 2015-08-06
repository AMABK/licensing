
<?php
//require_once base_path('dompdf/dompdf_config.inc.php');
ob_start();
?>
<html>
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
            margin-left: -20.2%;
            padding-top: 50px;
        }
        img{
            position:absolute;
            margin-left: -90%;
            padding-top: 38px;

        }
    </style>
    <body>
        <?php
        $rows = 0;
        ?>
        <table style="width: auto; padding-top: -6.5%">
            <tbody>
                @foreach($licenses as $license)
                <?php
                $size = (((sizeof($license)) / 4) * 241) + 700;
                ?>
                @if($rows%4 == 0)
                <tr>
                    @endif
                    <td style="width: 283.1px;height: 283.1px ">
                        <ul>
                            <li style="padding-top: 4%;padding-left: 18%">{{$license->sn}}</li>
                            <li style="padding-left: 44%; height: 15px;padding-bottom: 10px">{{substr($license->sacco, 0, 20)}}</li>
                            <li style="padding-left: 47%; height: 26px">{{$license->reg_no}}</li>              
                            <li style="padding-left: 35%;height: 32px; padding-top: 0px;">{{$license->seats}}</li> <barcode>{!!\DNS2D::getBarcodeHTML($license->sn, "QRCODE",3.4,3.4)!!}</barcode>
                            <li style="padding-left: 25%; padding-bottom: 25px">{{$license->expiry_date}}</li>
                        </ul>
                    </td>
                    <?php
                    $rows +=1;
                    ?>
                    @if($rows%4 == 0)
                </tr>
                @endif
                @endforeach
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

return redirect('/invoice/print');
