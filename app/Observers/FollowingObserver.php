<?php

namespace App\Observers;

use App\Helpers\Common;
use App\Jobs\SendEmailNotification;
use App\Jobs\SendTelegramNotificationJob;
use App\Models\Following;

class FollowingObserver
{
    /**
     * Handle the Following "created" event.
     */
    public function created(Following $following): void
    {
        // Xử lý khi có Following được tạo
        $created_at = date('H:i d/m/Y', strtotime($following->created_at));
        $telegramMessage = "ℹ️ <b>{$following->user->full_name}</b> đã ứng tuyển vào công việc <b>{$following->job->title}</b>\n";
        $telegramMessage .= "Thời gian ứng tuyển: <b>{$created_at}</b>";

        // Gửi thông báo tới Telegram bằng Queue Job
        dispatch(new SendTelegramNotificationJob($telegramMessage));


        // send mail to user
        $messageToUser = "Chúc mừng bạn đã ứng tuyển thành công vào công việc {$following->job->title}.";
        dispatch(new SendEmailNotification($following->user, $messageToUser));

        // send mail to employer
        $messageToEmployer = "Chúc mừng bạn đã có ứng viên ứng tuyển thành công vào công việc {$following->job->title}.";
        dispatch(new SendEmailNotification($following->job->company, $messageToEmployer));
    }

    /**
     * Handle the Following "updated" event.
     */
    public function updated(Following $following): void
    {
        // Xử lý khi có Following được cập nhật

        $nameStatus = Common::getStatusFollow($following->status);

        $message = "
        ℹ️ Trạng thái công việc #{$following->job->id} đã được thay đổi thành: <b>{$nameStatus}</b>
        Thông tin người ứng tuyển:
        - Họ và tên: {$following->user->name}
        - Email: {$following->user->email}
        - Số điện thoại: {$following->user->phone}
        ";

        // Gửi thông báo tới Telegram bằng Queue Job
        dispatch(new SendTelegramNotificationJob($message));
        // send mail to user
        $messageToUser = "Trạng thái công việc {$following->job->title} mà bạn đã ứng tuyển được thay đổi thành: <b>{$nameStatus}</b>";
        dispatch(new SendEmailNotification($following->user, $messageToUser));
    }
}
