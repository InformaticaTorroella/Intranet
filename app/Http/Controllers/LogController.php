<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        // Opcional: paginación
        $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(20);

        return view('logs.index', compact('logs'));
    }
}
