<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use ConsoleTVs\Charts\ChartsServiceProvider;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Khill\Lavacharts\Lavacharts;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends BaseController
{
    private $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return mixed
     */
    public function index()
    {
    	return view('homepage.main');
    }

    /**
     * @return mixed
     */
    public function getEmailReport()
    {
        $active = 350000;
        $randomNum = rand(60,78) + (mt_rand() / mt_getrandmax());
        $unSubscribers = rand(1,21);
        $open = round(($active * $randomNum) / 100);
        $unOpen = $active - $open;

        return view('report.email', [
            'active' => $active, 'open' => $open, 'unOpen' => $unOpen, 'unSubscribers' => $unSubscribers
        ]);
    }

    /**
     * @return mixed
     */
    public function getSmsReport()
    {
        return view('report.sms', []);
    }

    /**
     * @return mixed
     */
    public function getWhatsAppReport()
    {
        return view('report.whats-app', []);
    }

    public function postEmailReport()
    {
        $data = Input::only('name', 'subject', 'sender', 'total_active_sub', 'total_open_sub', 'total_un_open_sub',
            'total_un_sub', 'campaign_date', 'download_date');
        $lava = new Lavacharts; // See note below for Laravel
        $reasons = $lava->DataTable();
        $reasons
            ->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Total Opened Subscribers', intval($data['total_open_sub'])])
            ->addRow(['Total Un-opened Subscribers', intval($data['total_un_open_sub'])]);

        $lava->DonutChart('IMDB', $reasons, [
            'title' => '',
            'height' => 600,
            'legend' => 'bottom',
        ]);

        $data = [
           'company_name' => $data['name'],
           'subject' => $data['subject'],
           'sender' => $data['sender'],
           'active_subscribers' => $data['total_active_sub'],
           'open_subscribers' => $data['total_open_sub'],
           'un_open_subscribers' => $data['total_un_open_sub'],
           'un_subscribed_emails' => $data['total_un_sub'],
           'campaign_date' => Carbon::parse($data['campaign_date'])->format('l, jS \\of F Y'),
           'downloaded_date' => Carbon::parse($data['download_date'])->format('l, jS \\of F Y'),
        ];
        /*$pdf = $this->pdf->loadView('report.print-email-report', [
            'lava'      => $lava, 'data' => $data
        ]);
        return $pdf->download('invoice.pdf');*/
        return view('report.email-report', [
            'lava' => $lava, 'data' => $data
        ]);
    }

    public function postSmsReport()
    {
        $data = Input::only('name', 'sender', 'db-type', 'sent-message-count', 'open-message', 'db-type-custom',
            'un-open-message', 'campaign_date', 'download_date', 'description', 'sent-message-count-custom');
        $lava = new Lavacharts; // See note below for Laravel
        $reasons = $lava->DataTable();
        $percentage = number_format((intval($data['open-message']) / (intval($data['open-message']) + intval($data['un-open-message']))) * 100, 2);
        $percentageUnOpen = number_format(100 - $percentage, 2);
        $reasons
            ->addStringColumn('Reasons')
            ->addNumberColumn('Total Opened Messages - ' . $percentage . '%')
            ->addNumberColumn('Total Un-Opened Messages - ' . $percentageUnOpen . '%')
            ->addRow(['', intval($data['open-message']), intval($data['un-open-message'])]);

        /*$lava->DonutChart('IMDB', $reasons, [
            'title' => '',
            'height' => 600,
            'legend' => 'bottom',
            'colors' => ['#1a056d', '#ff8409'],
        ]);*/


        $lava->ColumnChart('IMDB', $reasons, [
            'title'  => '',
            'height' => 600,
            'tooltip' => [
                'isHtml' => true, 'trigger' => 'always'
            ],
            'legend' => [
                'position' => 'bottom'
            ],
            'colors' => ['#0698D8', '#F73C13'],
            'seriesType' => 'bars',
            'series' => [
                2 => ['type' => 'line']
            ]
        ]);

        $data = [
            'company_name' => $data['name'],
            'sender' => $data['sender'],
            'db_type' => ($data['db-type'] == 'custom') ? $data['db-type-custom'] : $data['db-type'],
            'sent_message_count' => ($data['sent-message-count'] == 'custom') ? $data['sent-message-count-custom'] : $data['sent-message-count'],
            'open_subscribers' => $data['open-message'],
            'un_open_subscribers' => $data['un-open-message'],
            'description' => $data['description'],
            'campaign_date' => Carbon::parse($data['campaign_date'])->format('l, jS \\of F Y'),
            'downloaded_date' => Carbon::parse($data['download_date'])->format('l, jS \\of F Y'),
        ];
        return view('report.sms-report', [
            'lava' => $lava, 'data' => $data
        ]);
    }

    public function postWhatsAppReport()
    {
        $data = Input::only('name', 'sender', 'db-type', 'sent-message-count', 'open-message', 'db-type-custom',
            'un-open-message', 'campaign_date', 'download_date', 'description', 'sent-message-count-custom');
        $lava = new Lavacharts; // See note below for Laravel
        $reasons = $lava->DataTable();
        $reasons
            ->addStringColumn('Reasons')
            ->addNumberColumn('Percent')

            ->addRow(['Total Un-Opened Messages', intval($data['un-open-message'])])
            ->addRow(['Total Opened Messages', intval($data['open-message'])]);

        /*$lava->DonutChart('IMDB', $reasons, [
            'title' => '',
            'height' => 600,
            'legend' => 'bottom',
            'colors' => ['#34af23', '#34b7f1'],
        ]);*/

        $lava->PieChart('IMDB', $reasons, [
            'title'  => '',
            'is3D'   => true,
            'height' => 600,
            'tooltip' => [
                'isHtml' => true, 'trigger' => 'always'
            ],
            'legend' => [
                'position' => 'right'
            ],
            'colors' => ['#34b7f1', '#34af23'],
            'slices' => [
                ['offset' => 0.07],
                ['offset' => 0.09],
                ['offset' => 0.05]
            ]
        ]);

        $data = [
            'company_name' => $data['name'],
            'sender' => $data['sender'],
            'db_type' => ($data['db-type'] == 'custom') ? $data['db-type-custom'] : $data['db-type'],
            'sent_message_count' => ($data['sent-message-count'] == 'custom') ? $data['sent-message-count-custom'] : $data['sent-message-count'],
            'open_subscribers' => $data['open-message'],
            'un_open_subscribers' => $data['un-open-message'],
            'description' => $data['description'],
            'campaign_date' => Carbon::parse($data['campaign_date'])->format('l, jS \\of F Y'),
            'downloaded_date' => Carbon::parse($data['download_date'])->format('l, jS \\of F Y'),
        ];
        return view('report.whats-app-report', [
            'lava' => $lava, 'data' => $data
        ]);
    }
}
