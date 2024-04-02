<?php

namespace Modules\CircleXo\App\Services;

use Modules\CircleXo\App\Facades\CircleXoSlots;

class CircleServices
{
    /**
     * @return array
     */
    public function slots(string $place): array
    {
        $slots = [];
        $getSlots = CircleXoSlots::get();
        foreach ($getSlots as $key=>$slot){
            if($key == $place){
                $slots[] = $slot;
            }
        }
        return $slots;
    }
}
