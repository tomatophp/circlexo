<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\Splade\Facades\Splade;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public int $id,
        public array $data
    )
    {
        //
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        $events = [];
        if(isset($this->data['flash'])){
            $events[] = Splade::toastOnEvent($this->data['flash'])->style(isset($this->data['flash_type']) ? $this->data['flash_type'] : 'warning')->autoDismiss(2);
        }

        if(isset($this->data['refresh'])){
            $events[] = Splade::refreshOnEvent()->preserveScroll();
        }

        return $events;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('accounts.'. $this->id),
        ];
    }
}
