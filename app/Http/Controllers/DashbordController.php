<?php

namespace App\Http\Controllers;

use App\Traits\ViewTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashbordController extends Controller
{
    use ViewTrait;
    public function __invoke()
    {
        return self::view('manager.index');
    }
}
