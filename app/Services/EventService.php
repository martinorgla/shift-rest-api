<?php

namespace App\Services;

use App\Models\Event;
use App\Repository\EventRepository;

/**
 * Class EventService
 * @package App\Services
 */
class EventService
{
    /**
     * @var EventRepository
     */
    private EventRepository $eventRepository;

    /**
     * EventService constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param string $shiftName
     * @return Event|null
     */
    public function findByName(string $shiftName): ?Event
    {
        return Event::whereName($shiftName)->first();
    }

    /**
     * @param $event
     * @return Event|null
     */
    public function create($event): ?Event
    {
        $newEvent = new Event();
        $newEvent->name = $event['name'];
        $newEvent->start = date('Y-m-d H:i:s', strtotime($event['start']));
        $newEvent->end = date('Y-m-d H:i:s', strtotime($event['end']));

        return $this->eventRepository->create($newEvent);
    }
}
