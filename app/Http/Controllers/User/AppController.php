<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    protected $baseViewPath = '';
    protected $assigns = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function getUser()
    {
        return Auth::user();
    }

    protected function getUserId()
    {
        return Auth::user()->id;
    }

    protected function getViewPath($suffix)
    {
        return $this->baseViewPath . $suffix;
    }

    protected function view($path, $assigns = null)
    {
        if ($assigns !== null) {
          $this->assigns = $assigns;
        }
        return view($path, $this->assigns);
    }

    protected function quickView($endpoint)
    {
        return view($this->getViewPath($endpoint), $this->assigns);
    }
}
