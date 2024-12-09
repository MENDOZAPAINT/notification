<?php

namespace App\Events;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VentaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $venta;
    private array $targetUsers;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
        $this->targetUsers = $this->getTargetUsers($venta->user_id);
    }

    private function getTargetUsers(?int $userId): array
    {
        $query = User::where('role', 'admin');

        if ($userId !== null) {
            // Include the user ID if they are not null
            $query->orWhere('id', $userId);
        }

        // Include users with role NULL
        $query->orWhere('role', null);

        return $query->pluck('id')->toArray();
    }

    public function broadcastOn(): array
    {
        return array_map(fn($userId) => new PrivateChannel("venta_notifications.$userId"), $this->targetUsers);
    }

    public function broadcastWith(): array
    {
        // Return the sales count for the user, regardless of their role
        return ['count' => cache()->remember("venta_count_user_{$this->venta->user_id}", 60, fn() => Venta::where('user_id', $this->venta->user_id)->count())];
    }

    public function broadcastAs(): string
    {
        return 'nueva-venta';
    }
}





/*

<?php

namespace App\Events;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class VentaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $venta;
    private array $targetUsers;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
        $this->targetUsers = $this->getTargetUsers($venta->user_id);
    }

    private function getTargetUsers(?int $userId): array
    {
        $query = User::where('role', 'admin');

        if ($userId) {
            $query->orWhere('id', $userId);
        }

        return $query->pluck('id')->toArray();
    }

    public function broadcastOn(): array
    {
        return array_map(fn($userId) => new PrivateChannel("venta_notifications.$userId"), $this->targetUsers);
    }

    public function broadcastWith(): array
    {
        return ['count' => cache()->remember('venta_count', 60, fn() => Venta::count())];
    }

    public function broadcastAs(): string
    {
        return 'nueva-venta';
    }
}

*/