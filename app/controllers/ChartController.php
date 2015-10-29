<?php

class ChartController extends \BaseController {
    public function showChart(){
        return View::make('chart.chart')->with(['title'=>'Chart']);
    }
}