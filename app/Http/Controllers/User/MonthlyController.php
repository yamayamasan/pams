<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\User\AppController;

class MonthlyController extends AppController
{
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
}
