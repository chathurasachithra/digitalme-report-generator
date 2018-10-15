<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use Log;

class GenerateReportWhatsNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:report-new-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate report whats new content';

    /**
     * Create a new command instance.
     *
     * BillingSubscription constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'Report content check started : ' . Carbon::now() . PHP_EOL;
        Log::info('Report content check started : ' . Carbon::now());
        DB::table('reports')->select('reports.id', 'user_id', 'entry_id', 'entry_type', 'role_id')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->chunk(20, function ($reports) {
            foreach ($reports as $report) {
                try {

                    $availableRecords = 0;
                    $currentRecords = 0;
                    $newRecords = [];
                    $reportRole = DB::table('report_roles')
                        ->where('role_id', $report->role_id)
                        ->where('type', $report->entry_type)
                        ->where('status', 1)->first();
                    if (isset($reportRole->id)) {

                        $entryKey = null;
                        switch ($report->entry_type) {
                            case 1:
                                $entryKey = 'cc_identification';
                                break;
                            case 2:
                                $entryKey = 'cc_company_identification';
                                break;
                            case 3:
                                $entryKey = 'cc_organisation_identification';
                                break;
                            case 4:
                                $entryKey = 'cc_government_identification';
                                break;
                        }

                        $reportPermissions = DB::table('report_permission_role')
                            ->join(
                                'report_permissions',
                                'report_permissions.id',
                                '=',
                                'report_permission_role.report_permission_id'
                            )
                            ->select([
                                'report_permission_role.id', 'report_permissions.id as report_permissions_id',
                                'report_permissions.name', 'report_permissions.table'
                            ])
                            ->groupBy('report_permissions.table')
                            ->where('report_role_id', $reportRole->id)->get();

                        foreach ($reportPermissions as $reportPermission) {
                            $contentObjects = DB::table($reportPermission->table)
                                ->select(['*'])
                                ->where($entryKey, $report->entry_id)->get();
                            $newRecordCount = 0;
                            foreach ($contentObjects as $key => $contentObject) {

                                $availableRecords = $availableRecords + 1;
                                if (isset($contentObject->id)) {
                                    $content = $contentObject->id;

                                } else if ($reportPermission->table == 'cc_personal_data') {
                                    $content = $contentObject->cc_identification;

                                } else if ($reportPermission->table == 'cc_companies') {
                                    $content = $contentObject->cc_company_identification;

                                } else if ($reportPermission->table == 'cc_organisations') {
                                    $content = $contentObject->cc_organisation_identification;

                                } else if ($reportPermission->table == 'cc_government') {
                                    $content = $contentObject->cc_government_identification;
                                } else {
                                    $content = null;
                                }
                                $count = DB::table('report_contents')
                                    ->where('report_id', $report->id)
                                    ->where('table', $reportPermission->table)
                                    ->where('record', $content)->count();
                                if ($count > 0) {
                                    $currentRecords = $currentRecords + 1;
                                } else {
                                    $newRecordCount = $newRecordCount + 1;
                                }
                            }
                            if ($newRecordCount > 0) {
                                $newRecords[$reportPermission->table] = $newRecordCount;
                            }
                        }
                    }
                    $whatsNew = serialize($newRecords);
                    $percentage = ($availableRecords > 0) ? number_format(($currentRecords/$availableRecords) * 100, 2) : 100;
                    DB::table('reports')->where('id', $report->id)
                        ->update(['whats_new' => $whatsNew, 'percentage' => $percentage]);
                } catch (\Exception $ex) {
                    echo $ex->getMessage() . PHP_EOL;
                    Log::error($ex->getMessage());
                }
            }
        });
        echo 'Report content check end : ' .Carbon::now() . PHP_EOL;
        Log::info('Report content check end : ' .Carbon::now());
    }
}
