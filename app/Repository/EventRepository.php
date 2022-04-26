<?php

namespace App\Repository;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EventRepository
 * @package App\Repository
 */
class EventRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Event::get();
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function save(Event $event): bool
    {
        return $event->save();
    }

    /**
     * @param Event $event
     * @return Event
     */
    public function create(Event $event): Event
    {
        return Event::create($event->toArray());
    }
}
