<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
/*
 * This trait is to be used with the default $table->uuid('id') schema definition
 * @package Alsofronie\Uuid
 * @author Alex Sofronie <alsofronie@gmail.com>
 * @license MIT
 */
trait AppModelTrait
{
    
    public function setUserId(&$model)
    {
        $model->user_id = Auth::user()->id;
    }

    /**
    */
    public function setRequest(&$model, $request)
    {
      foreach ($request->all() as $key => $param) {
        if ($key !== '_token' && !empty($param)) {
          $model->{$key} = $param;
        }
      }
    }

    public function getUserId()
    {
      return Auth::user()->id;
    }
}
