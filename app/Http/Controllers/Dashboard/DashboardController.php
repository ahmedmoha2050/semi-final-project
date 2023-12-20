<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __invoke()
    {
//        Mail::to('test@email.com')->send(new TestMail());
        return view('dashboard.index');
    }
}
