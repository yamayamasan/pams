<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AppUuidTrait;
use App\Library\Util;

class Attendances extends AppModel
{
    use AppUuidTrait;
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'attendances';

    protected $uuidKey = 'uuid';

    protected $guarded = ['uuid'];

    // protected $primaryKey = ['user_id', 'date_at'];

    public static function getWorkTime($attendance)
    {
        $workTime = null;
        if (!empty($attendance->begin_time) && !empty($attendance->end_time) && !empty($attendance->break_time)) {
            $workTime = Util::calcTime($attendance->begin_time, $attendance->end_time, $attendance->break_time);
        }
        return $workTime;
    }

    public static function getStatus($workTime)
    {
        $status = 0;
        if (isset($work_time) && !empty($work_time)) {                          
            $status = 2;
        }
        return $status;
    }
}
