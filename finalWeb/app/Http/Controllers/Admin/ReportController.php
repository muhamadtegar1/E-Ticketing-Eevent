<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Example data for Chart.js
        $reportData = [
            'labels' => ['Event A', 'Event B', 'Event C'],
            'data' => [50, 75, 100],
        ];

        return view('admin.reports.index', compact('reportData'));
    }
}
