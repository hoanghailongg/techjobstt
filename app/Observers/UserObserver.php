<?php

namespace App\Observers;

use App\Jobs\SendTelegramNotificationJob;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
        $fullName = $user->full_name;
        $dateTime = $user->created_at;
        $email = $user->email;
        $message = "👥 <b>Thành viên mới đăng ký:</b>
                    <b>Họ và tên:</b> $fullName
                    <b>Thời gian:</b> $dateTime
                    📧 <b>Email:</b> $email";
        dispatch(new SendTelegramNotificationJob($message));
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        $message = "
            ❌ Người dùng đã bị xóa:
            <b>Họ và tên:</b> $user->full_name
            <b>Email:</b> $user->email
            ";
        dispatch(new SendTelegramNotificationJob($message));
    }
}
