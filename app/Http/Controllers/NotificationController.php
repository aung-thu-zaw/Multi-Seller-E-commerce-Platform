<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(string $notificationId): RedirectResponse
    {
        $user = Auth::user();

        $notification = $user->notifications()->findOrFail($notificationId);

        $notification->markAsRead();

        return back();
    }

    public function markAllAsRead(): RedirectResponse
    {
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();

        return back();
    }
}
