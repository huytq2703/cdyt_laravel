<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Posts;

class NotificationsController extends Controller
{
    const v_NotifyDetails = 'notify.details';
    public function details (Request $request, String $slug)
    {
        $notifications = Posts::whereType('notice')->get();
        $notification = Posts::whereType('notice')->whereSlug($slug)->first();
        return Inertia::render('Notifications/NotificationDetails', [
            'notifications' => $notifications,
            'notification'  => $notification,
            'v_NotifyDetails' => self::v_NotifyDetails
        ]);
    }
}
