<?php

namespace App\Observers;

use App\Helpers\Common;
use App\Jobs\SendTelegramNotificationJob;
use App\Models\Company;
use App\Jobs\SendEmailNotification;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        // Gửi thông báo tới telegram
        $message = "🏢 **Có nhà tuyển dụng mới đăng ký**\n\n";
        $message .= "✉️ *Tên công ty:* {$company->name}\n";
        $message .= "📍 *Địa chỉ:* {$company->address}\n";
        $message .= "📧 *Email:* {$company->email}\n";
        $message .= "📞 *Số điện thoại:* {$company->phone}";

        dispatch(new SendTelegramNotificationJob($message));
    }

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updated(Company $company)
    {
        // Kiểm tra xem trạng thái của công ty đã thay đổi hay không
        if ($company->isDirty('is_active')) {
            $status = Common::getStatusCompanyOnlyText($company->is_active);
            // Gửi thông báo tới email của người nhà tuyển dụng
            $message = "🏢 **Trạng thái công ty đã được thay đổi**\n\n";
            $message .= "✉️ *Công ty:* {$company->name}\n";
            $message .= "🔄 *Trạng thái mới:* {$status}";

            dispatch(new SendEmailNotification($company->email, $message));
        }
    }
}
