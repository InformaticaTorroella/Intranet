<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Carbon;

class Calendari extends Component
{
    public $month;
    public $year;

    public function __construct($month = null, $year = null)
    {
        $now = Carbon::now();
        $this->month = $month ?? $now->month;
        $this->year = $year ?? $now->year;
    }

    public function render()
    {
        return view('components.calendari');
    }
}

