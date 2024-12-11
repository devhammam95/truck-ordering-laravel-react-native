<?php

namespace Orders\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\Contracts\Services\GetAllOrdersServiceInterface;
use Orders\Contracts\Services\GetUserOrdersServiceInterface;
use Orders\DTOs\CreateOrderDTO;
use Orders\Requests\CreateOrderRequest;
use Orders\Services\GetUserOrdersService;

class OrderController extends Controller
{
    private GetAllOrdersServiceInterface $getAllOrdersService;
    private GetUserOrdersService $getUserOrdersService;

    private CreateOrderServiceInterface $createOrderService;

    public function __construct(
        GetAllOrdersServiceInterface $getAllOrders,
        GetUserOrdersServiceInterface $getUserOrders,
        CreateOrderServiceInterface $createOrder
    ) {
        $this->getAllOrdersService = $getAllOrders;
        $this->getUserOrdersService = $getUserOrders;
        $this->createOrderService = $createOrder;
    }

    public function index()
    {
        return response()->json([
            'orders' => $this->getUserOrdersService->handle()
        ], 200);
    }

    public function getAllOrders()
    {
        return view('admin.orders.index', ['orders' => $this->getAllOrdersService->handle()]);
    }

    public function store(CreateOrderRequest $request)
    {
        try {
            $this->createOrderService->handle(
                new CreateOrderDTO(
                    Auth::user()->id,
                    $request->location,
                    $request->size,
                    $request->weight
                )
            );
        } catch (\Exception $exception) {
            Log::info("Exception: {$exception->getMessage()}");
            return response()->json([
                'error' => 'issue in creating a new purchase, try again.'
            ], 500);
        }
        return response()->json([
            'message' => 'New Purchase added successfully',
        ], 200);

    }

    // public function show(int $purchaseId)
    // {
    //     return response()->json([
    //         'purchase' => $this->getPurchaseService->handle(new GetPurchaseDTO($purchaseId))
    //     ], 200);
    // }

    // public function update(int $purchaseId, Request $request)
    // {
    //     try {
    //         $this->updatePurchaseService->handle(
    //             new UpdatePurchaseDTO($request->get('purchase_id'), $request->get('products'))
    //         );
    //     } catch (\Exception $exception) {
    //         Log::info("Exception: {$exception->getMessage()}");
    //         return response()->json([
    //             'error' => 'issue in updating purchase, try again.'
    //         ], 500);
    //     }
    //     return response()->json([
    //         'message' => 'Purchase updated successfully.'
    //     ], 200);
    // }

}
