<?php

namespace App\Events;

use App\Models\Pickup;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PickupStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pickup;

    public function __construct(Pickup $pickup)
    {
        $this->pickup = $pickup;
    }

    public function broadcastOn()
    {
        return new Channel('pickups.' . $this->pickup->user_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->pickup->id,
            'status' => $this->pickup->status,
            'waste_type' => $this->pickup->waste_type,
            'message' => 'Status changed to ' . $this->pickup->status
        ];
    }
}
