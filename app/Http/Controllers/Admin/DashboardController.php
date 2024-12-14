<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        try {
            return view('admin.dashboard');
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }
}
