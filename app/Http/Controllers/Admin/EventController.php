<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Events\EventRepository;
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
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['data' => $this->eventRepository->getAllEvents()]);
        }
        return view('admin.event.index');
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
            'all-day' => 'required_without:evt-start,evt-end',
        ]);

        $result = $this->eventRepository->storeEvent($request->all());
        if ($result) {
            return response()->json([
                'success' => true,
            ]);
        }
        throw new Exception('Erro na criação do evento!');
    }
}
