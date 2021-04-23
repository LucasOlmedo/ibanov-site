<?php

namespace App\Repositories\Events;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @param  Collection  $events
     * @return Collection|\Illuminate\Support\Collection
     */
    private function transformEventData(Collection $events)
    {
        return $events->map(function (Event $event) {
            return [
                'id' => $event->agendaID,
                'title' => $event->Titulo,
                'start' => Carbon::parse($event->StartDate),
                'end' => Carbon::parse($event->EndDate),
            ];
        });
    }

    /**
     * @param $id
     * @return Builder|Model|object|null
     */
    public function getEvent($id)
    {
        return $this->model->newQuery()
            ->where('agendaID', '=', $id)
            ->first();
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

    /**
     * @param  Event  $event
     * @param  array  $params
     * @return bool
     */
    public function updateEvent(Event $event, array $params)
    {
        $allDay = Arr::get($params, 'all-day', false);
        if (Arr::get($params, 'startDate')) {
            $startDate = "{$params['startDate']} ".($allDay ? '00:00' : Arr::get($params, 'evt-start', ''));
            $event->StartDate = Carbon::parse($startDate);
        }
        if (Arr::get($params, 'endDate')) {
            $endDate = "{$params['endDate']} ".($allDay ? '23:59' : Arr::get($params, 'evt-end', ''));
            $event->EndDate = Carbon::parse($endDate);
        }
        $event->Titulo = Arr::get($params, 'evt-title', $event->Titulo);
        $event->Texto = Arr::get($params, 'evt-desc', $event->Texto);
        return $event->save();
    }
}
