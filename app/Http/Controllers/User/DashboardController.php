<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Util;
use App\MonthlySummary;
use App\Services\Attendances as AttendancesService;

class DashboardController extends AppController
{
    protected $baseViewPath = 'user.dashboard.';

    public function index()
    {
        $today = date('Y-m-d');

        $monthStartDay = date("Y-m-01", time());
        $monthSummary = MonthlySummary::where('user_id', $this->getUserId())
            ->where('year_month', $monthStartDay)
            ->first();

        $attendService = new AttendancesService();
        $weekDateList = $attendService->getWeekDateList(date('Y'), date('m'), date('d'));

        // $dateList = $attendService->getMonthDateList($year, $month);

        $this->assigns = [
            'today'   => $today,
            'summary' => $monthSummary,
            'dateList' => $weekDateList,
        ];

        return $this->quickView('index');
    }
}
