<?php

namespace App\Modules\Partners\Core\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Dropshipper;

class PartnerRegisterd
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partner;

    /**
     * Create a new event instance.
     * @param Dropshipper $partner
     * @return void
     */
    public function __construct(Dropshipper $partner)
    {
        $this->partner = $partner;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
