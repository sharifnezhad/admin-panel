<?php

namespace App;

class GlobalParams
{
    public static function dashboardUrl()
    {
        return route('manager');
    }

    public static function redirectToHome()
    {
        return to_route('manager');
    }
}
