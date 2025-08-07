<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurityLog;

class SecurityLogController extends Controller
{
    public function index()
    {
        $this->authorize('view_page_admin');

        $logs = SecurityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return view('admin.security-logs', compact('logs'));
    }
}