<?php

namespace App\Http\Controllers;

use App\Events\Order\OrderCreated;
use App\Events\Vendor\VendorCreated;
use App\Http\Requests\Questionnaire\CustomerBookingRequest;
use App\Http\Requests\Questionnaire\VendorJoinRequest;
use App\Services\OrderService;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;
use Response;

class QuestionnaireController extends Controller
{
    public function order(
        CustomerBookingRequest $request,
        OrderService           $orderService
    ): JsonResponse
    {
        $order = $orderService->store($request->collect());

        event(new OrderCreated($order));

        return Response::json(null, 201);
    }

    public function vendor(
        VendorJoinRequest $request,
        VendorService     $vendorService,
    ): JsonResponse
    {
        $vendor = $vendorService->store($request->collect());

        event(new VendorCreated($vendor));

        return Response::json(null, 201);
    }
}
