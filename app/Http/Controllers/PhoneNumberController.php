<?php

namespace App\Http\Controllers;

use App\Imports\SendSms;
use App\PhoneNumber;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class PhoneNumberController extends Controller
{
    public function import()
    {
        Excel::import(new SendSms(), 'phone_numbers.xlsx');
    }
}
