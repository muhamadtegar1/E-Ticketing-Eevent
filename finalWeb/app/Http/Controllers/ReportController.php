<?php

namespace App\Http\Controllers;

use App\Models\EventAnalytics;

class ReportController extends Controller
{
    public function index()
    {
        $analytics = EventAnalytics::with('event')->get();

        return view('admin.reports.index', compact('analytics'));
    }
}
