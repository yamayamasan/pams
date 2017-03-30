<?php

namespace App\Library;

use DateTime;
use App\WorkStates;

class Util
{
  /**
   * 日付をY-m-dに変換
   * [dateYmd description]
   * @param  [type] $y   [description]
   * @param  [type] $m   [description]
   * @param  [type] $d   [description]
   * @param  string $fmt [description]
   * @return [type]      [description]
   */
  public static function dateYmd($y, $m, $d, $fmt = 'Y-m-d')
  {
    $defYmd = implode('-', [$y, $m, $d]);
    return date($fmt, strtotime($defYmd));
  }

  /**
   * 月始め取得
   * [startOfMonth description]
   * @param  [type] $year  [description]
   * @param  [type] $month [description]
   * @param  string $fmt   [description]
   * @return [type]        [description]
   */
  public static function startOfMonth($year, $month, $fmt = 'Y-m-d')
  {
    return Util::dateYmd($year, $month, 1, $fmt);
  }

  /**
   * 月末日を取得
   * [endOfMonth description]
   * @param  [type] $year  [description]
   * @param  [type] $month [description]
   * @param  string $fmt   [description]
   * @return [type]        [description]
   */
  public static function endOfMonth($year, $month, $fmt = 'Y-m-d')
  {
    $endOfMonth = date($fmt, mktime(0, 0, 0, (int)$month + 1, 0, (int)$year));
    return $endOfMonth;
  }

  /**
   * 稼働時間を計算 退勤時間ー出勤時間ー休憩時間
   * [calcTime description]
   * @param  [type] $begin [description]
   * @param  [type] $end   [description]
   * @param  [type] $break [description]
   * @param  [type] $date  [description]
   * @return [type]        [description]
   */
  public static function calcTime($begin, $end, $break, $date = null)
  {
    if (empty($begin) || empty($end) || empty($break)) {
      return null;
    }
    $beginArr = explode(':', $begin);
    $endArr   = explode(':', $end);
    $breakArr = explode(':', $break);

    $diffHour = (int)$endArr[0] - (int)$beginArr[0] - (int)$breakArr[0];
    $diffMin  = (int)$endArr[1] - (int)$beginArr[1] - (int)$breakArr[1];

    $diffTime = $diffHour + ($diffMin / 60);
    return $diffTime;
  }

  /**
   * 休日取得
   * [isHoliday description]
   * @param  [type]  $date [description]
   * @return boolean       [description]
   */
  public static function isHoliday($date)
  {
    $datetime = new DateTime($date);
    $w = (int)$datetime->format('w');
    if ($w === 0 || $w === 6) {
      return true;
    }
    return false;
  }

  /**
   * 配列のキーを日付にする
   * [getMonthList description]
   * @param  [type] $year      [description]
   * @param  [type] $keys      [description]
   * @param  [type] $valYmdKey [description]
   * @return [type]            [description]
   */
  public static function getMonthList($year, $keys, $valYmdKey = null)
  {
    $values = [];
    foreach ($keys as $key) {
      $values[$key] = null;
    }
    $list = [];
    for ($i = 1;$i <=12;$i++) {
      $ymd = Util::dateYmd($year, $i, 1);
      if (!is_null($valYmdKey)) {
        $values[$valYmdKey] = $ymd;
      }
      $list[$ymd] = $values;
    }
    return $list;
  }

  /**
   * 出勤ステータス
   * [getWorkStates description]
   * @param  [type] $key [description]
   * @return [type]      [description]
   */
  public static function getWorkStates($key = null)
  {
    // キャッシュ化したい
      $workStates = WorkStates::all();
      if (!is_null($key)) {
        return array_column($workStates->toArray(), null, 'id');
      }

      return $workStates;
  }

  /**
   * 想定勤務時間
   * [assumedWorkingHours description]
   * @param  array  $dateList [description]
   * @return [type]           [description]
   */
  public static function assumedWorkingHours(array $dateList)
  {
    $foreTotalTime = 0;
    foreach ($dateList as $date) {
      $foreTotalTime += $date['work_time'] ?? $date['fore_work_time'] ?? 0;
    }

    return $foreTotalTime;
  }

  /**
  * 勤務ステータスから休みかどうか判定
  * id: 2:欠勤, 3: 休日, 6: 有給
  * 休みならtrue
  */
  public static function isAdsense(int $workStatesId)
  {
    if ($workStatesId === 2 || $workStatesId === 3 || $workStatesId === 6) {
      return true;
    }
    return false;
  }

  public static function getDaysOnWeeks($baseDay)
  {
      $w = to_dotweek($baseDay, false);
      $days = [];

      for ($i = 0;$i < 7;$i++) {
        $diff = $w - $i;
        $days[] = date('Y-m-d', strtotime("-{$diff} day", strtotime($baseDay)));
      }
      return $days;
  }

}
