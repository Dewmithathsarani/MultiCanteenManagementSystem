<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = $user->notifications()->latest()->paginate(10);

        // Mark all as read when opening the page
        $user->unreadNotifications->markAsRead();

        return view('student.notifications.index', compact('notifications'));
    }
}
