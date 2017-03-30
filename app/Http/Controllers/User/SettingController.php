<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\User\AppController;
use App\MonthlyBaseInfos;
use App\User;
use App\Http\Traits\AppModelTrait;
use App\Library\Util;

class SettingController extends AppController
{
    use AppModelTrait;

    protected $baseViewPath = 'user.setting.';
    /**
     *
     * @return void
     */
    public function index()
    {
        return $this->quickView('index');
    }

    /**
     * [account description]
     * @return [type] [description]
     */
    public function account()
    {
      $user = $this->getUser();
      $this->assigns = [
        'user' => [
          'name' => $user->name,
          'email' => $user->email,
        ],
        'actionUrl' => '/setting/account',
      ];
      return $this->quickView('account');
    }

    public function updateAccount(Request $request)
    {
        $model = new User();

        // $this->setUserId($model);
        // $this->setRequest($model, $request);
    }

    /**
     * [monthlyBaseInfos description]
     * @return [type] [description]
     */
    public function monthlyBaseInfos()
    {
        $monthBaseInfo = MonthlyBaseInfos::where('user_id', $this->getUserId())->get();

        $this->assigns = [
            'monthBaseInfo' => $monthBaseInfo,
        ];

        return $this->quickView('monthly_base_infos');
    }

    /**
     * MonthlyBaseInfos Edit Screen
     * @param  [type] $uuid [description]
     * @return [type]       [description]
     */
    public function monthlyBaseInfoEdit(string $uuid = null)
    {
        $this->assigns = [
            'info' => null,
            'actionUrl' => '/setting/create/monthly_base_infos',
        ];
        if (isset($uuid)) {
            $info = MonthlyBaseInfos::where('user_id', $this->getUserId())
                ->where('uuid', $uuid)
                ->first();
            $this->assigns['info'] = $info;
            $this->assigns['actionUrl'] = '/setting/update/monthly_base_infos/' . $info->uuid;
        }

        return $this->quickView('monthly_base_infos_edit');
    }

    /**
     * MonthlyBaseInfos Create
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createMonthlyBaseInfos(Request $request)
    {
        $model = new MonthlyBaseInfos;

        if (empty($request->term_end_day)) {
            $model->term_end_day = '9999-12-31';
        }

        $isExistStartTerm = $model->checkTermOverlap($request->term_start_day);
        $isExistEndTerm = $model->checkTermOverlap($request->term_end_day);
        if (!$isExistStartTerm || !$isExistEndTerm) {
            return redirect()->back()->withInput();
        }

        $this->setUserId($model);
        $this->setRequest($model, $request);
        if ($model->save()) {
            return redirect('/setting/monthly_base_infos');
        }
        return redirect()->back()->withInput();
    }

    /**
     * MonthlyBaseInfos Update
     * @param  Request $request [description]
     * @param  string  $uuid    [description]
     * @return [type]           [description]
     */
    public function updateMonthlyBaseInfos(Request $request, string $uuid)
    {
        $model = new MonthlyBaseInfos;
        exit();
        if (empty($request->term_end_day)) {
            $model->term_end_day = '9999-12-31';
        }

        $isExistStartTerm = $model->checkTermOverlap($request->term_start_day);
        $isExistEndTerm = $model->checkTermOverlap($request->term_end_day);
        if (!$isExistStartTerm || !$isExistEndTerm) {
            return redirect()->back()->withInput();
        }

        $this->setUserId($model);
        $this->setRequest($model, $request);
        if ($model->save()) {
            return redirect('/setting/monthly_base_infos');
        }
        return redirect()->back()->withInput();
    }
}
