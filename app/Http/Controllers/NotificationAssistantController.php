<?php

namespace App\Http\Controllers;

use App\Models\NotificationAssistant;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class NotificationAssistantController extends AppBaseController
{
    public function readNotification(NotificationAssistant $notification): JsonResponse
    {
        $notification->read_at = Carbon::now();
        $notification->save();

        return $this->sendSuccess(__('messages.flash.notification_read'));
    }

    public function readAllNotification(): JsonResponse
    {
        NotificationAssistant::whereReadAt(null)->where('user_id',
            getLogInUserId())->update(['read_at' => Carbon::now()]);

        return $this->sendSuccess(__('messages.flash.all_notification_read'));
    }
}
