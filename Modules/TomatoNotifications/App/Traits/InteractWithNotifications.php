<?php

namespace Modules\TomatoNotifications\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Modules\TomatoNotifications\App\Jobs\NotifyDatabaseJob;
use Modules\TomatoNotifications\App\Jobs\NotifyDiscordJob;
use Modules\TomatoNotifications\App\Jobs\NotifyEmailJob;
use Modules\TomatoNotifications\App\Jobs\NotifyFCMJob;
use Modules\TomatoNotifications\App\Jobs\NotifyPusherJob;
use Modules\TomatoNotifications\App\Jobs\NotifySlackJob;
use Modules\TomatoNotifications\App\Jobs\NotifySMSMisrJob;
use Modules\TomatoNotifications\App\Mail\SendEmail;
use Modules\TomatoNotifications\App\Models\UserNotification;
use Modules\TomatoNotifications\App\Models\UserToken;

trait InteractWithNotifications
{
    public function notifySMSMisr(string $message): void
    {
        dispatch(new NotifySMSMisrJob([
            'phone' => $this->phone,
            'message' => $message,
        ]));
    }

    public function notifyEmail(string $message, ?string $subject = null, ?string $url = null)
    {
        dispatch(new NotifyEmailJob([
            'email' => $this->email,
            'subject' => $subject,
            'message' => $message,
        ]));
    }

    public function notifyDB(string $message, ?string $title=null, ?string $url =null)
    {
        dispatch(new NotifyDatabaseJob([
            'model_type' => get_called_class(),
            'model_id' => $this->id,
            'subject' => $title,
            'message' => $message,
            'url' => $url,
        ]));
    }

    public function notifySlack(string $title,string $message=null,?string $url=null, ?string $image=null, ?string $webhook=null)
    {
        dispatch(new NotifySlackJob([
            'webhook' => $webhook,
            'title' => $title,
            'message' => $message,
            'url' => $url,
            'image' => $image,
        ]));
    }

    public function notifyDiscord(string $title,string $message=null,?string $url=null, ?string $image=null, ?string $webhook=null)
    {
        dispatch(new NotifyDiscordJob([
            'webhook' => $webhook,
            'title' => $title,
            'message' => $message,
            'url' => $url,
            'image' => $image,
        ]));
    }

    public function notifyFCMSDK(string $message, string $type='web', ?string $title=null, ?string $url=null, ?string $image=null, ?string $icon=null, ?array $data=[])
    {
        dispatch(new NotifyFCMJob([
            'user' => $this,
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
            'image' => $image,
            'url' => $url,
            'type' => $type,
            'data' => $data,
        ]));
    }

    public function notifyPusherSDK(string $token, string $title, string $message)
    {
        dispatch(new NotifyPusherJob([
            'user' => $this,
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
            'image' => $image,
            'url' => $url,
            'type' => $type,
            'data' => $data,
        ]));
    }

    public function initializeUseNotifications()
    {
        $this->appends[] = 'fcm';
        $this->appends[] = 'fcmID';
    }

    public function setFcmAttribute($value)
    {
        $this->fcm = $value;
    }

    public function getFcmAttribute()
    {
        return 'fcm-web';
    }

    public function setFcmIdAttribute($value)
    {
        $this->fcmId = $value;
    }

    public function getFcmIdAttribute()
    {
        return $this->id;
    }

    public function getUserNotifications()
    {
        return $this->morphMany(UserNotification::class, 'model');
    }

    public function userTokensFcm()
    {
        return $this->morphOne(UserToken::class, 'model')->where('provider', $this->fcm);
    }

    public function userTokensPusher()
    {
        return $this->morphOne(UserToken::class, 'model')->where('provider', 'pusher');
    }

    public function routeNotificationForFcm()
    {
        return $this->userTokensFcm ? $this->userTokensFcm->provider_token : '';
    }
}
