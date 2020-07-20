<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\SendMailService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ContactFormController
 * @package App\Http\Controllers\Site
 */
class ContactFormController extends Controller
{
    /**
     * @var SendMailService
     */
    private $sendMailService;

    /**
     * ContactFormController constructor.
     * @param  SendMailService  $sendMailService
     */
    public function __construct(SendMailService $sendMailService)
    {
        $this->sendMailService = $sendMailService;
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function sendMessage(Request $request)
    {
        try {
            $mailRequest = $request->only('name', 'email', 'subject', 'message');
            $this->sendMailService->send($mailRequest);
            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
