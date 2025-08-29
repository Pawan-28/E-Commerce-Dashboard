<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $auditLogs = AuditLog::query()
            ->with('admin')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('audit.index', compact('auditLogs'));
    }
}
