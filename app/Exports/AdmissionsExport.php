<?php

namespace App\Exports;

use App\Models\Admissions;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AdmissionsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admissions::all();
    }

    public function view(): View
    {
        return view('exports.admissions.AllAdmission', [
            'invoices' => Admissions::with(['majors', 'province', 'district', 'ward'])->get()
        ]);
    }
}
