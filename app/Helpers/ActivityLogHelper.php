<?php

namespace App\Helpers;

use App\Models\ActivityLog;

class ActivityLogHelper
{
    public static function log($userId, $activity, $description = null)
    {
        ActivityLog::create([
            'user_id' => $userId,
            'activity' => $activity,
            'description' => $description,
        ]);
    }
}