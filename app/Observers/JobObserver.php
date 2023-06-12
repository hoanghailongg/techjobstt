<?php

namespace App\Observers;

use App\Helpers\Common;
use App\Jobs\SendEmailNotification;
use App\Jobs\SendTelegramNotificationJob;
use App\Models\Job;

class JobObserver
{
    /**
     * Handle the Job "created" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function created(Job $job)
    {
        // Gửi thông báo tới telegram
        $message = "🌟 **Nhà tuyển dụng tạo công việc mới**\n\n";
        $message .= "✉️ *Công việc:* {$job->title}\n";
        $message .= "📅 *Thời gian tạo:* {$job->created_at}\n";
        $message .= "🏢 *Công ty:* {$job->company->name}";

        dispatch(new SendTelegramNotificationJob($message));
    }

    /**
     * Handle the Job "updated" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function updated(Job $job)
    {
        // Kiểm tra xem trạng thái công việc đã thay đổi hay không
        if ($job->isDirty('is_active')) {
            $status = Common::getStatusFollow($job->is_active);
            // Gửi thông báo tới email của người nhà tuyển dụng
            $message = "🌟 **Trạng thái công việc đã được thay đổi**\n\n";
            $message .= "✉️ *Công việc:* {$job->title}\n";
            $message .= "🔄 *Trạng thái mới:* " . $status . "\n\n";
            \Log::info('send mail status job');
            dispatch(new SendEmailNotification($job->company, $message));
            dispatch(new SendTelegramNotificationJob($message));
        }
    }
}
