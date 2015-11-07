<?php

class DashboardController extends \BaseController{

    public static function userDashboard(){
        //get user view info
        return View::make('dashboard')
            ->with(['title'=>'Dashboard']);
    }

    public static function adminDashboard(){
        //get admin view info

        //total activated user number
        $totalUserNumber = UserInfo::where('activation',true)->count();

        //total results added
        $totalResultNumber = Result::count();

        return View::make('dashboard')
            ->with([
                'title'             =>      'Dashboard',
                'totalUserNumber'   =>      $totalUserNumber,
                'totalResultNumber' =>      $totalResultNumber
            ]);
    }
}

?>