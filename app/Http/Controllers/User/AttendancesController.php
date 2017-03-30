<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\User\AppController;
use App\Http\Traits\AppModelTrait;
use App\Attendances;
use App\MonthlyBaseInfos;
use App\MonthlySummary;
use App\Library\Util;
use App\Library\Assumed;

use App\Services\Attendances as AttendancesService;

class AttendancesController extends AppController
{
    use AppModelTrait;

    protected $baseViewPath = 'user.attendances.';

    /**
     *
     * @return void
     */
    public function index()
    {
        $monthSummaryModel = new MonthlySummary;
        $dataList = $monthSummaryModel->getSummaryInfos(date('Y'));

        $this->assigns = [
            'monthSummary' => $dataList,
        ];

        return $this->quickView('index');
    }

    public function month(int $year, int $month)
    {
        $monthStartDay = Util::startOfMonth($year, $month);

        $monthSummary = MonthlySummary::where('user_id', $this->getUserId())
            ->where('year_month', $monthStartDay)
            ->first();

        $attendService = new AttendancesService();
        $dateList = $attendService->getMonthDateList($year, $month);

        // 想定勤務時間
        $assumedDatas = Assumed::allInfos($dateList);

        $this->assigns = [
            'dateList'     => $dateList,
            'year'         => $year,
            'month'        => $month,
            'monthSummary' => $monthSummary,
            'assumedDatas' => $assumedDatas,
        ];

        return $this->quickView('month');
    }


    /**
     * 勤怠詳細
     *
     */
    public function day(int $year, int $month, int $day)
    {
        $attendService = new AttendancesService();
        $attendance = $attendService->getDayData($year, $month, $day);

        $actionUrl = isset($attendance['uuid'])? '/attendances/update/day/' . $attendance['uuid']: '/attendances/create/day';
        $method = 'POST';

        $workStates = Util::getWorkStates();
        $monthDay = Util::dateYmd($year, $month, $day);

        $this->assigns = [
            'attendance' => $attendance,
            'date'       => $monthDay,
            'actionUrl'  => $actionUrl,
            'method'     => $method,
            'workStates' => $workStates,
        ];

        return $this->quickView('day');
    }


    /**
     * 勤怠登録
     *
     */
    public function createDay(Request $request)
    {
        $model = new Attendances;

        $this->setUserId($model);
        $this->setRequest($model, $request);

        $model->work_time = Attendances::getWorkTime($request);
        $model->status    = Attendances::getStatus($model->work_time);

        if (!$model->save()) {
            return redirect()->back()->withInput();
        }

        $monthSummary = new MonthlySummary;
        if ($monthSummary->updateSummary($request)) {
            $pathYm = date_to_fmt($model->date_at, 'Y/m/');
            return redirect('/attendances/month/' . $pathYm);
        }
        return redirect()->back()->withInput();
    }

    public function createDayYmd(Request $request)
    {

    }

    /**
     * 勤怠更新
     *
     */
    public function updateDay(Request $request, string $uuid)
    {
        $attendance = Attendances::where('uuid', '=' ,$uuid);

        $workTime = Attendances::getWorkTime($request);
        $status = Attendances::getStatus($workTime);

        $isUpdated = $attendance->update([
            'begin_time'     => $request->begin_time,
            'end_time'       => $request->end_time,
            'break_time'     => $request->break_time,
            'work_time'      => $workTime,
            'status'         => $status,
            'work_states_id' => $request->work_states_id,
        ]);

        if (!$isUpdated) {
            return redirect()->back()->withInput();
        }

        $monthSummary = new MonthlySummary;
        $monthSummary->updateSummary($request);

        $pathYm = date_to_fmt($request->date_at, 'Y/m/');
        return redirect('/attendances/month/' . $pathYm);
    }

    public function downloadCsv($year, $month)
    {

    }

    public function monthStatusClose(string $uuid)
    {
        $monthSummary = MonthlySummary::where('user_id', $this->getUserId())
            ->where('uuid', $uuid);

        if (empty($monthSummary->first())) {
            return;
        }

        $monthSummary->update([
            'status' => 2
        ]);

        return redirect('/attendances/');
    }
}
