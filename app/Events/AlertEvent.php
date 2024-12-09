<?php

namespace App\Events;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlertEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $venta;
    private $targetUsers;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
        // Obtenemos los usuarios admin y el creador
        $this->targetUsers = User::where('role', 'admin')
            ->orWhere('id', $venta->user_id)
            ->pluck('id')
            ->toArray();
    }

    public function broadcastOn(): array
    {
        // Creamos un canal privado para cada usuario objetivo
        return array_map(function($userId) {
            return new PrivateChannel('alert.' . $userId);
        }, $this->targetUsers);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->venta->id,
            'title' => $this->venta->title,
            'description' => $this->venta->description,
            'created_at' => $this->venta->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function broadcastAs(): string
    {
        return 'nueva-venta';
    }
}