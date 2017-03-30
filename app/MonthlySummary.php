<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AppUuidTrait;
use App\Http\Traits\AppModelTrait;

use App\Library\Util;
use App\Attendances;
use App\AppModel;

class MonthlySummary extends AppModel
{
    use AppUuidTrait;
    use AppModelTrait;

    protected $table = 'monthly_summary';

    protected $uuidKey = 'uuid';

    /**
    *
    */
    public function getSummaryInfos($year)
    {
        $summaryInfos = $this->where('user_id', $this->getUserId())
            ->where('year_month', '>=', $year . "-01-01")
            ->where('year_month', '<=', $year . "-12-31")
            ->get();
        $monthList = Util::getMonthList($year, [
            'year_month', 'total_work_time', 'avg_work_time_day', 'total_work_day_count',
        ], 'year_month');

        foreach ($summaryInfos as $summary) {
            $monthList[$summary['year_month']] = [
                'year_month'           => $summary['year_month'],
                'total_work_time'      => $summary['total_work_time'],
                'avg_work_time_day'    => $summary['avg_work_time_day'],
                'total_work_day_count' => $summary['total_work_day_count'],
            ];
        }
        return $monthList;
    }

    /**
    *
    */
    public function updateSummary($request)
    {
        $dateArr = explode('-', $request->date_at);
        $monthBeginDay = Util::dateYmd($dateArr[0], $dateArr[1], 1);
        $monthEndDay = Util::endOfMonth($dateArr[0], $dateArr[1]);

        // utilに移植？
        $attendances = Attendances::where('user_id', $this->getUserId())
            ->where('date_at', '>=', $monthBeginDay)
            ->where('date_at', '<=', $monthEndDay)
            ->whereIn('work_states_id', [1, 4, 5])
            ->get();

        // 存在確認
        $summary = $this->where('user_id', $this->getUserId())->where('year_month', $monthBeginDay);

        // calc
        $yearMonth = $monthBeginDay;
        $totalWorkDayCount = count($attendances);
        $totalWorkTime = 0;

        // 関数で書けそう
        foreach ($attendances as $attendance) {
            $totalWorkTime += $attendance->work_time;
        }
        $avgWorkTimeDay = $totalWorkTime / $totalWorkDayCount;

        // save or update
        if (empty($summary->first())) {
            $this->setUserId($this);
            $this->year_month           = $yearMonth;
            $this->total_work_time      = $totalWorkTime;
            $this->avg_work_time_day    = $avgWorkTimeDay;
            $this->total_work_day_count = $totalWorkDayCount;
            $this->save();
        } else {
            $summary->update([
                'total_work_time' => $totalWorkTime,
                'avg_work_time_day' => $avgWorkTimeDay,
                'total_work_day_count' => $totalWorkDayCount,
            ]);
        }
        return true;
    }
}
