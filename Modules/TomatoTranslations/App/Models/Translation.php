<?php

namespace Modules\TomatoTranslations\App\Models;

use Modules\TomatoTranslations\App\Services\SaveScan;
use Sushi\Sushi;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use Sushi;

    protected ?array $rows = [];

    public function getRows()
    {
        return (new SaveScan())->getKeys();
    }

    protected function sushiShouldCache()
    {
        return false;
    }
}
