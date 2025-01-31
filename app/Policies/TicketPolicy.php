<?php

namespace App\Policies;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

    public function reply(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

    public function close(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }
} 