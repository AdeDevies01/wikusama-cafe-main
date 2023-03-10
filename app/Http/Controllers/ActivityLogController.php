<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Http\Requests\StoreActivityLogRequest;
use App\Http\Requests\UpdateActivityLogRequest;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('activity-logs.index', [
            'title' => 'Log Aktivitas',
            'activityLogs' => ActivityLog::with('user')->options(request(['q', 'type', 'sortby', 'order']))->paginate(is_numeric(request('limit', 10)) ? request('limit', 10) : 10),
            'activityTypes' => ActivityLog::$activityTypes,
            'sortables' => ActivityLog::$sortables
        ]);
    }
}
