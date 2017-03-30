<?php

namespace App\Library;

use App\Library\Util;

class Assumed
{
    /**
     * 想定データを取得
     * [assumedDatas description]
     * @param  [type] $dateList [description]
     * @return [type]           [description]
     */
    public static function allInfos($dateList)
    {
      // 出勤日数
      $attendanceCount = self::getAttendanceCount($dateList);
      // 営業日
      $businessCount = self::getBusinessCount($dateList);
      // 平均勤務時間
      $averageWorkHour = self::getAverageWorkHour($dateList);

      $res = [
        'attendanceCount' => $attendanceCount,
        'businessCount' => $businessCount,
        'averageWorkHour' => $averageWorkHour,
      ];

      // print_r($res);exit();
      return $res;
    }
    /**
     * 出勤日数
     * [getAttendanceCount description]
     * @return [type] [description]
     */
    public static function getAttendanceCount($dateList)
    {
        $res = array_filter($dateList, function($k) {
          return $k['status'] == 1;
        });
        return count($res);
    }

    /**
     * 営業日
     * [getBusinessCount description]
     * @return [type] [description]
     */
    public static function getBusinessCount($dateList)
    {
      $res = array_filter($dateList, function($k) {
        return $k['is_holiday'] == 0;
      });
      return count($res);
    }

    /**
     * 平均勤務時間
     * [getAverageWorkHour description]
     * @return [type] [description]
     */
    public static function getAverageWorkHour($dateList)
    {
      $a = array_map(function($k) {
        if (isset($k['work_time']) && $k['work_time'] > 0) {
          return $k['work_time'];
        }
        if (isset($k['fore_work_time']) && $k['fore_work_time'] > 0) {
          return $k['fore_work_time'];
        }
        return 0;
      }, $dateList);
      return array_sum($a);
    }

}
