<?php

namespace App\Services;

use App\MonthlyBaseInfos;
use App\Attendances as AttendancesModel;
use App\Http\Traits\AppModelTrait;
use App\Library\Util;

class Attendances
{

  use AppModelTrait;
  protected $attendKeys = [
    'date_at'    => null,
    'begin_time' => null,
    'end_time'   => null,
    'break_time' => null,
    'work_time'  => null,
    'fore_work_time' => null,
    'status'     => 0,
    'is_holiday' => null,
    'dotweek'    => null,
  ];
  /**
  *一週間分を取得
  */
  public function getWeekDateList($year, $month, $day)
  {
      $monthList = $this->getMonthDateList($year, $month);

      $date = Util::dateYmd($year, $month, $day);
      $weekDays = Util::getDaysOnWeeks($date);

      $weekDayDatas = [];
      foreach ($weekDays as $wday) {
          if (!isset($monthList[$wday])) {
              $tmp = $this->attendKeys;
              $tmp['date_at'] = $wday;
              $tmp['is_holiday'] = Util::isHoliday($wday);
              $tmp['dotweek'] = to_dotweek($wday);
              $weekDayDatas[$wday] = $tmp;
          } else {
              $weekDayDatas[$wday] = $monthList[$wday];
          }
      }
      return $weekDayDatas;
  }

  /**
   * [getMonthDateList description]
   *
   * 1:既に入力済みの勤務データがある場合はそれを使用
   * 2:入力済みの勤務データがない場合は月の基本情報から使う。
   * 3:月の基本情報がない場合は'-'にする。
   * 4:休日判定を入れる
   * @param  [type] $year  [description]
   * @param  [type] $month [description]
   * @return [type]        [description]
   */
  public function getMonthDateList($year, $month)
  {
    // y-m-d
    $monthStartDate = Util::startOfMonth($year, $month);
    $monthEndDate   = Util::endOfMonth($year, $month);

    // j
    $monthStartDay = Util::startOfMonth($year, $month, 'j');
    $monthEndDay   = Util::endOfMonth($year, $month, 'd');

    // ①月の基本情報取得(基準出勤、基準退勤時間などをとるため)
    $monthBaseInfo = MonthlyBaseInfos::where('user_id', $this->getUserId())
        ->where('term_start_day', '<=', $monthStartDate)
        // term_end_dayは$monthBeginDayでOK?
        ->where('term_end_day', '>', $monthStartDate)
        ->first();


    // ②月の勤務データを取得
    $attendances = AttendancesModel::where('user_id', $this->getUserId())
        ->where('date_at', '>=', $monthStartDate)
        ->where('date_at', '<=', $monthEndDate)
        ->get();

    $dateList = [];

    $defBeginTime = null;
    $defEndTime   = null;
    $defBreakTime = null;

    // 月の基本情報があればセット
    if (!empty($monthBaseInfo)) {
        $defBeginTime = $monthBaseInfo->base_attend_time;
        $defEndTime   = $monthBaseInfo->base_leaving_time;
        $defBreakTime = $monthBaseInfo->base_break_time;
    }

    for ($i = $monthStartDay;$i <= $monthEndDay;$i++) {
        $date = Util::dateYmd($year, $month, $i);
        $isHoliday = Util::isHoliday($date);
        $dateList[$date] = [
            'date_at'    => $date,
            'begin_time' => ($isHoliday)? null : $defBeginTime ?? null,
            'end_time'   => ($isHoliday)? null : $defEndTime ?? null,
            'break_time' => ($isHoliday)? null : $defBreakTime ?? null,
            'work_time'  => null,
            // 想定業務時間 status == 0の時使用
            'fore_work_time' => ($isHoliday)? null : Util::calcTime($defBeginTime, $defEndTime, $defBreakTime),
            'status'     => 0,
            'is_holiday' => $isHoliday,
            'dotweek'    => to_dotweek($date),
        ];
    }

    $workStates = Util::getWorkStates('id');

    foreach ($attendances as $key => $attendance) {
        $dateData = &$dateList[$attendance->date_at];
        $dateData['status'] = $attendance->status;
        $isAdsense = Util::isAdsense($attendance->work_states_id);

        if ((int)$attendance->work_states_id > 0) {
            $dateData['work_state'] = $workStates[$attendance->work_states_id]['title'];
        }

        if ($isAdsense) {
            $dateData['begin_time'] = null;
            $dateData['end_time']   = null;
            $dateData['break_time'] = null;
            $dateData['fore_work_time'] = null;
        } else {
          if (!empty($attendance->begin_time)) {
              $dateData['begin_time'] = $attendance->begin_time;
          }
          if (!empty($attendance->end_time)) {
              $dateData['end_time'] = $attendance->end_time;
          }
          if (!empty($attendance->break_time)) {
              $dateData['break_time'] = $attendance->break_time;
          }
          if (!empty($dateData['begin_time']) && !empty($dateData['end_time']) && !empty($dateData['break_time'])) {
              $dateData['work_time'] = Util::calcTime($dateData['begin_time'], $dateData['end_time'], $dateData['break_time']);
          }
        }
    }

    return $dateList;
  }

  /**
   * [getDayData description]
   * @param  [type] $year  [description]
   * @param  [type] $month [description]
   * @param  [type] $day   [description]
   * @return [type]        [description]
   */
  public function getDayData($year, $month, $day)
  {
      $dateAt = Util::dateYmd($year, $month, $day);
      $attendance = AttendancesModel::where('user_id', $this->getUserId())
          ->where('date_at', $dateAt)
          ->first();

      $monthBaseInfo = MonthlyBaseInfos::where('user_id', $this->getUserId())
          ->where('term_start_day', '<=', $dateAt)
          ->where('term_end_day', '>', $dateAt)->first();

      $dayData = [
          'date_at'    => $dateAt,
          'begin_time' => null,
          'end_time'   => null,
          'break_time' => null,
          'note'       => null,
          'work_states_id' => null,
          'uuid' => null,
      ];

      if (!empty($attendance)) {
          $dayData['begin_time']     = $attendance->begin_time;
          $dayData['end_time']       = $attendance->end_time;
          $dayData['break_time']     = $attendance->break_time;
          $dayData['note']           = $attendance->note;
          $dayData['work_states_id'] = $attendance->work_states_id;
          $dayData['uuid']           = $attendance->uuid;
      } elseif (!empty($monthBaseInfo)) {
          $dayData['begin_time'] = $monthBaseInfo->base_attend_time ?? null;
          $dayData['end_time']   = $monthBaseInfo->base_leaving_time ?? null;
          $dayData['break_time'] = $monthBaseInfo->base_break_time ?? null;
      }

      return $dayData;
  }

}
