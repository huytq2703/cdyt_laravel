<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Province;

class LocationController extends Controller
{
    public function getProvinces(Request $request)
    {
        $province = new Province();

        $provinces = $province->getAll($request->all())->toArray();

        return Inertia::render('Admin/Locations/Provinces', [
            'provinces'         => $provinces['data'],
            'pagination'    => [
                'perPage'       => $provinces['per_page'],
                'currentPage'   => $provinces['current_page'],
                'totalPages'    => $provinces['last_page'],
                'totalRecords'  => $provinces['total'],
                'first'         => $provinces['from']
            ],
            'params'        => $request->all(),
        ]);
    }
}
