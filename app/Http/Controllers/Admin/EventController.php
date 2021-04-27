<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\Events\EventRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class EventController
 * @package App\Http\Controllers\Admin
 */
class EventController extends Controller
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * EventController constructor.
     * @param  EventRepository  $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('admin.event.index');
    }

    /**
     * @return JsonResponse
     */
    public function getData()
    {
        return response()->json($this->eventRepository->getAllEvents());
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'startDate' => 'date|required',
            'endDate' => 'date|required',
            'evt-title' => 'string|required',
            'evt-start' => 'string',
            'evt-end' => 'string',
            'evt-desc' => 'string|required',
        ]);

        $result = $this->eventRepository->storeEvent($request->all());
        if ($result) {
            return response()->json([
                'success' => true,
            ]);
        }
        throw new Exception('Erro na criação do evento!');
    }

    /**
     * @param $id
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function dragEvent($id, Request $request)
    {
        $event = $this->eventRepository->getEvent($id);
        if ($event instanceof Event) {
            $result = $this->eventRepository->updateDragEvent($event, $request->all());
            if ($result) {
                return response()->json([
                    'success' => true,
                ]);
            }
            throw new Exception('Erro na atualização do evento!');
        }
        throw new Exception('Não foi possivel localizar o evento!');
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function show(int $id)
    {
        try {
            $event = $this->eventRepository->getEvent($id);
            if ($event instanceof Event) {
                $event->StartDate = Carbon::parse($event->StartDate)->format('Y-m-d\TH:i:s');
                $event->EndDate = Carbon::parse($event->EndDate)->format('Y-m-d\TH:i:s');
                return response()->json($event);
            }
            throw new Exception('Não foi possível encontrar o evento!', 404);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param  int  $id
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        try {
            $event = $this->eventRepository->getEvent($id);
            if ($event instanceof Event) {
                $updated = $this->eventRepository->updateEvent($event, $request->all());
                if ($updated) {
                    return response()->json([
                        'message' => 'Evento atualizado com sucesso!',
                    ]);
                }
                throw new Exception('Não foi possível atualizar o evento!', 500);
            }
            throw new Exception('Não foi possível encontrar o evento!', 404);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteEvent($id)
    {
        $event = $this->eventRepository->getEvent($id);
        if ($event instanceof Event) {
            try {
                $event->delete();
                return response()->json([
                    'success' => true,
                ]);
            } catch (Exception $exception) {
                throw new Exception('Erro ao remover o evento!');
            }
        }
        throw new Exception('Não foi possivel localizar o evento!');
    }
}
