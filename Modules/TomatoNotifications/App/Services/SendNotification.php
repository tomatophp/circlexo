<?php

namespace Modules\TomatoNotifications\App\Services;

use Modules\TomatoNotifications\App\Models\NotificationsTemplate;
use Modules\TomatoNotifications\App\Models\UserNotification;
use Modules\TomatoNotifications\App\Jobs\NotificationJop;
use Modules\TomatoNotifications\App\Services\Actions\FireEvent;
use Modules\TomatoNotifications\App\Services\Actions\LoadTemplate;
use Modules\TomatoNotifications\App\Services\Actions\SendToDatabase;
use Modules\TomatoNotifications\App\Services\Actions\SendToJob;
use Modules\TomatoNotifications\App\Services\Concerns\HasCreatedBy;
use Modules\TomatoNotifications\App\Services\Concerns\HasData;
use Modules\TomatoNotifications\App\Services\Concerns\HasFindBody;
use Modules\TomatoNotifications\App\Services\Concerns\HasFindTitle;
use Modules\TomatoNotifications\App\Services\Concerns\HasIcon;
use Modules\TomatoNotifications\App\Services\Concerns\HasId;
use Modules\TomatoNotifications\App\Services\Concerns\HasImage;
use Modules\TomatoNotifications\App\Services\Concerns\HasLang;
use Modules\TomatoNotifications\App\Services\Concerns\HasMessage;
use Modules\TomatoNotifications\App\Services\Concerns\HasModel;
use Modules\TomatoNotifications\App\Services\Concerns\HasPrivacy;
use Modules\TomatoNotifications\App\Services\Concerns\HasProviders;
use Modules\TomatoNotifications\App\Services\Concerns\HasReplaceBody;
use Modules\TomatoNotifications\App\Services\Concerns\HasReplaceTitle;
use Modules\TomatoNotifications\App\Services\Concerns\HasTemplate;
use Modules\TomatoNotifications\App\Services\Concerns\HasTemplateModel;
use Modules\TomatoNotifications\App\Services\Concerns\HasTitle;
use Modules\TomatoNotifications\App\Services\Concerns\HasType;
use Modules\TomatoNotifications\App\Services\Concerns\HasUrl;
use Modules\TomatoNotifications\App\Services\Concerns\HasUser;
use Modules\TomatoNotifications\App\Services\Concerns\IsDatabase;

class SendNotification
{
    use HasTitle;
    use HasMessage;
    use HasType;
    use HasProviders;
    use HasPrivacy;
    use HasUrl;
    use HasImage;
    use HasIcon;
    use HasModel;
    use HasTemplate;
    use HasFindTitle;
    use HasFindBody;
    use HasReplaceTitle;
    use HasReplaceBody;
    use HasId;
    use HasCreatedBy;
    use HasUser;
    use HasLang;
    use HasTemplateModel;
    use IsDatabase;

    /*
     * Actions
     */
    use FireEvent;
    use LoadTemplate;
    use SendToDatabase;
    use SendToJob;
    use HasData;
    /**
     * @param ?array $providers
     * @return static
     */
    public static function make(?array $providers): static
    {
        return (new static)->providers($providers);
    }
}
