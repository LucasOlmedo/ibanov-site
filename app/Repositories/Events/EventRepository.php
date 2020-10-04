<?php

namespace App\Repositories\Events;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

/**
 * Class EventRepository
 * @package App\Repositories\Events
 */
class EventRepository
{
    /**
     * @var Event
     */
    private $model;

    /**
     * EventRepository constructor.
     * @param  Event  $event
     */
    public function __construct(Event $event)
    {
        $this->model = $event;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllEvents()
    {
        $query = $this->model->newQuery();
        return $this->transformEventData($query->get());
    }

    private function transformEventData(Collection $events)
    {
        return $events->map(function (Event $event) {
            return [
                'id' => 'event_'.uniqid(),
                'title' => $event->Titulo,
                'start' => Carbon::parse($event->StartDate),
                'end' => Carbon::parse($event->EndDate),
                'editable' => false,
            ];
        });
    }

    /**
     * @param  array  $params
     * @return bool
     */
    public function storeEvent(array $params)
    {
        $allDay = Arr::get($params, 'all-day', false);
        $startDate = "{$params['startDate']} ".($allDay ? '00:00' : Arr::get($params, 'evt-start', ''));
        $endDate = "{$params['endDate']} ".($allDay ? '23:59' : Arr::get($params, 'evt-end', ''));
        $newEvent = new Event;
        $newEvent->userID = auth()->user()->userID;
        $newEvent->StartDate = Carbon::parse($startDate);
        $newEvent->EndDate = Carbon::parse($endDate);
        $newEvent->Titulo = $params['evt-title'];
        $newEvent->Texto = $params['evt-desc'];
        return $newEvent->save();
    }
}
