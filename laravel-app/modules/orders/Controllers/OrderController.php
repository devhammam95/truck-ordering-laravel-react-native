<?php

namespace Orders\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\Contracts\Services\GetAllOrdersServiceInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\Contracts\Services\GetUserOrdersServiceInterface;
use Orders\Contracts\Services\SendOrderNotificationToUserServiceInterface;
use Orders\Contracts\Services\UpdateOrderStatusServiceInterface;
use Orders\DTOs\CreateOrderDTO;
use Orders\DTOs\GetOrderDTO;
use Orders\DTOs\SendOrderNotificationToUserDTO;
use Orders\DTOs\UpdateOrderStatusDTO;
use Orders\Requests\CreateOrderRequest;
use Orders\Services\GetUserOrdersService;

class OrderController extends Controller
{
    private GetAllOrdersServiceInterface $getAllOrdersService;
    private GetUserOrdersService $getUserOrdersService;

    private GetOrderServiceInterface $getOrderService;

    private CreateOrderServiceInterface $createOrderService;

    private UpdateOrderStatusServiceInterface $updateOrderStatusService;

    private SendOrderNotificationToUserServiceInterface $sendOrderNotificationToUserService;


    public function __construct(
        GetAllOrdersServiceInterface $getAllOrders,
        GetOrderServiceInterface $getOrder,
        GetUserOrdersServiceInterface $getUserOrders,
        CreateOrderServiceInterface $createOrder,
        UpdateOrderStatusServiceInterface $updateOrderStatus,
        SendOrderNotificationToUserServiceInterface $sendOrderNotificationToUser
    ) {
        $this->getAllOrdersService = $getAllOrders;
        $this->getOrderService = $getOrder;
        $this->getUserOrdersService = $getUserOrders;
        $this->createOrderService = $createOrder;
        $this->updateOrderStatusService = $updateOrderStatus;
        $this->sendOrderNotificationToUserService = $sendOrderNotificationToUser;
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

    public function updateOrderStatus(int $id, Request $request)
    {
        try {
            $this->updateOrderStatusService->handle(
                new UpdateOrderStatusDTO($id)
            );
        } catch (\Exception $exception) {
            Log::info("Exception: updateOrderStatus : {$exception->getMessage()}");
            return redirect()->back()->with('alert-error', 'issue in updating order, try again');
        }
        return redirect()->back()->with('alert-success', 'Order status updated successfully.');
    }
    

    public function getSendNotificationToUserPage(int $id, string $notificationType)
    {

        try {
            $orderData = $this->getOrderService->handle(
                new GetOrderDTO($id)
            );
        } catch (\Exception $exception) {
            Log::info("Exception: getSendNotificationToUserPage : {$exception->getMessage()}");
            return redirect()->back()->with('alert-error', 'issue No Order Existed, try again');
        }

        return view('admin.orders.send_notification', ['id' => $id, 'userIdentifier' => $orderData->user->phone,  'notiifcationType' => $notificationType]);
    }

    public function sendNotificationToUser(int $id, string $notificationType, Request $request)
    {
        try {
            $this->sendOrderNotificationToUserService->handle(
                new SendOrderNotificationToUserDTO($id, $notificationType, $request->msg_content)
            );
        } catch (\Exception $exception) {
            Log::info("Exception: sendNotificationToUser : {$exception->getMessage()}");
            return redirect()->back()->with('alert-error', 'issue in updating order, try again');
        }
        return redirect()->route('orders.all')->with('alert-success', 'Order status updated successfully.');
    }
}
