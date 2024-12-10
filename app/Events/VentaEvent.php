<?php

namespace App\Events;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VentaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $count;

    public function __construct(public Venta $venta)
    {
        $this->count = Venta::count();
    }

    public function broadcastOn(): array
    {
        return User::pluck('id')
            ->map(fn($id) => new PrivateChannel("venta_notifications.$id"))
            ->all();
    }

    public function broadcastWith(): array
    {
        return [
            'count' => $this->count,
            'message' => 'Nueva venta registrada'
        ];
    }

    public function broadcastAs(): string
    {
        return 'nueva-venta';
    }
}