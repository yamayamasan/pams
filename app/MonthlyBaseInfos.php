<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AppUuidTrait;
use App\Http\Traits\AppModelTrait;

class MonthlyBaseInfos extends AppModel
{
    use AppUuidTrait;
    use AppModelTrait;
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'monthly_base_infos';

    protected $uuidKey = 'uuid';

    /**
    * 期間が重なっていないか確認
    */
    public function checkTermOverlap($term)
    {
        $info = $this->where('user_id', $this->getUserId())
            ->where('term_start_day', '<=', $term)
            ->where('term_end_day', '>=', $term)
            ->first();

        if (!empty($info)) {
            return false;
        }
        return true;
    }
}
