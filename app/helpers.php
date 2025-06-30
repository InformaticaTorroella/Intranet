<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

if (!function_exists('logActivity')) {
    function logActivity(string $action, string $target = null, string $details = null)
    {
        $username = session('username', 'guest');
        $ip = Request::ip();

        ActivityLog::create([
            'username' => $username,
            'action' => $action,
            'target' => $target,
            'ip_address' => $ip,
            'details' => $details,
        ]);
    }
}
