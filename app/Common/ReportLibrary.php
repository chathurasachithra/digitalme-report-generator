<?php

namespace App\Common;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use App\ReportPrice;
use App\Role;
use DB;

/**
 * Class ReportLibrary
 * @package App\Common
 */
class ReportLibrary
{


    /**
     * get report info
     *
     * @param $entryId
     * @param $entryType
     * @return mixed
     */
    public static function getReportInfo($entryId, $entryType)
    {
        $checkReportExist = DB::table('reports')
            ->where('entry_id', $entryId)
            ->where('entry_type', $entryType)
            ->where('user_id', \Auth::user()->id)->first();

        if (in_array(\Auth::user()->role_id, [1, 2, 3])) {
            $reportPrice = 0;
        } else {
            $reportPriceObject = DB::table('cc_system_report_price')
                ->where('client_role_id', \Auth::user()->role_id)
                ->where('report_type', $entryType)->first();
            if (isset($reportPriceObject->report_price)) {
                $reportPrice = $reportPriceObject->report_price;
            } else {
                $reportPrice = config('custom.default_report_price');
            }
        }

        $reportExist =  isset($checkReportExist->id) ? true : false;
        $reportName = '';
        switch ($entryType) {
            case 1:
                $entry = DB::table('cc_personal_data')->where('cc_identification', $entryId)->first();
                if (isset($entry->firstname_original)) {
                    $reportName = 'Person - ' . $entry->firstname_original . ' ' . $entry->lastname_original;
                }
                break;
            case 2:
                $entry = DB::table('cc_companies')->where('cc_company_identification', $entryId)->first();
                if (isset($entry->company_name)) {
                    $reportName = 'Company - ' . $entry->company_name;
                }
                break;
            case 3:
                $entry = DB::table('cc_organisations')->where('cc_organisation_identification', $entryId)->first();
                if (isset($entry->organisation_name)) {
                    $reportName = 'Organization - ' . $entry->organisation_name;
                }
                break;
            case 4:
                $entry = DB::table('cc_government')->where('cc_government_identification', $entryId)->first();
                if (isset($entry->government_name)) {
                    $reportName = 'State Structure - ' . $entry->government_name;
                }
                break;
        }

        return[
            'name' => $reportName,
            'exist' => $reportExist,
            'price' => $reportPrice,
            'entryId' => $entryId,
            'entryType' => $entryType,
            'report' => ReportLibrary::expandReportInfo($checkReportExist),
        ];
    }

    /**
     * Expand report data
     *
     * @param $report
     * @return mixed
     */
    public static function expandReportInfo($report)
    {
        if (isset($report->id)) {
            $extraData = [];
            if (!empty($report->whats_new)) {
                $data = unserialize($report->whats_new);
                foreach ($data as $key => $row) {
                    if (in_array(\Auth::user()->role_id, [1, 2, 3])) {
                        $recordPrice = 0;
                    } else {
                        $price = DB::table('cc_system_record_price')
                            ->where('table_name', $key)
                            ->where('user_role_id', \Auth::user()->role_id)
                            ->first();
                        if (isset($price->fixed_price)) {
                            $recordPrice = $price->valid_price;
                        } else {
                            $recordPrice = config('custom.default_record_price');
                        }
                    }

                    $table = DB::table('report_chapters')
                        ->where('table_name', $key)
                        ->first();
                    if (isset($table->display_name)) {
                        $tableName = $table->display_name;
                    } else {
                        $tableName = $key;
                    }
                    $extraData[] = ['table' => $tableName, 'price' => $recordPrice, 'count' => $row];
                }
            }
            $report->new = $extraData;
        }
        return $report;
    }


}
