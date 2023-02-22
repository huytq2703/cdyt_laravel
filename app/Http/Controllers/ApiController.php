<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\TimeSlot;

class ApiController extends Controller
{
    public function test ()
    {
        sleep(2);
        $posts = [
            'post_1' => 'Bài viết 1',
            'post_2' => 'Bài viết 2'
        ];

        $user = [
            'username' => "admin@gmail.com",
            'fullName' => "Admin"
        ];

        return response()->json([
            'data' => ['posts' => $posts, 'user' => $user],
            'statusValue' => 'Gọi api thành công!',
            'statusCode' => 200,
            'success'  => true
        ]);
    }

    public function getProvinces()
    {
        $provinces = Province::all();

        return response()->json([
            'data' => $provinces,
            'statusValue' => 'Gọi api thành công!',
            'statusCode' => 200,
            'success'  => true
        ]);
    }

    public function getDistricts($province_id)
    {
        $districts = District::whereProvinceId($province_id)->get();

        return response()->json([
            'data' => $districts,
            'statusValue' => 'Gọi api thành công!',
            'statusCode' => 200,
            'success'  => true
        ]);
    }

    public function getTimeSlots()
    {
        $timeSlots = TimeSlot::get();

        return response()->json([
            'data' => $timeSlots,
            'statusValue' => 'Thành công',
            'statusCode' => 200,
            'success'  => true
        ]);
    }

    public function getWards($district_id)
    {
        $wards = Ward::whereDistrictId($district_id)->get();

        return response()->json([
            'data' => $wards,
            'statusValue' => 'Gọi api thành công!',
            'statusCode' => 200,
            'success'  => true
        ]);
    }
}
