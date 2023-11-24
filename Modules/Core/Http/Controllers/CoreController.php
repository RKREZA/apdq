<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class CoreController extends Controller
{



    public $mpdf;

    private static function mpdfconfig(){
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        return [

            'margin_left' => 10,

            'margin_right' => 10,

            'margin_top' => 35,

            'margin_bottom' => 20,

            'margin_header' => 5,

            'margin_footer' => 10,

            'orientation' => 'P',

            'mode' => 'utf-8',

            // 'debug'=>true,

            'format' => [210, 297],

            'fontDir' => array_merge($fontDirs, [
                storage_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R'  => 'SolaimanLipi.ttf',
                    'B'  => 'SolaimanLipi_Bold.ttf',
                    'I'  => 'SolaimanLipi.ttf',
                    'BI' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ]
            ],
            'default_font' => 'solaimanlipi',

        ];

    }

    private static function mpdfconfig_land(){
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        return [

            'margin_left' => 10,

            'margin_right' => 10,

            'margin_top' => 35,

            'margin_bottom' => 20,

            'margin_header' => 5,

            'margin_footer' => 10,

            'orientation' => 'L',

            'mode' => 'utf-8',

            'format' => [210,297],


            'fontDir' => array_merge($fontDirs, [
                storage_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R'  => 'SolaimanLipi.ttf',
                    'B'  => 'SolaimanLipi_Bold.ttf',
                    'I'  => 'SolaimanLipi.ttf',
                    'BI' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ]
            ],
            'default_font' => 'solaimanlipi',
        ];

    }

    public function mpdf($name,$config = '', $h = '')
    {

        ini_set("pcre.backtrack_limit", "50000000");

        switch ($config) {
            case 'L':
                $config = self::mpdfconfig_land();
                break;
            default:
                $config = self::mpdfconfig();
                break;
        }



        $this->mpdf = new \Mpdf\Mpdf($config);
        // $this->mpdf->WriteHTML(File::get(public_path() . "/backend_assets/css/material-dashboard.css"), \Mpdf\HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetFooter('{PAGENO} of {nbpg}|  | '.Carbon::now()->format('jS M Y'));
        $this->mpdf->SetProtection(array('print'));
        $this->mpdf->SetTitle("$name");
        $this->mpdf->SetAuthor("");
        $this->mpdf->showWatermarkImage = true;
        $this->mpdf->shrink_tables_to_fit = 1;
        $this->mpdf->SetWatermarkImage(
            asset('assets/backend/img/bangladesh_government.png'),
            0.05,
            array(150,150)
        );
    }


}
