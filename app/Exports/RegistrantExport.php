<?php

namespace App\Exports;


use App\Models\Logistic;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrantExport implements FromView
{
    public function __construct(public $items)
    {}

    public function view(): View
    {
        return view('export.registrant', ['items' => $this->items]);
    }
}