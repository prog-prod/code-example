<?php

namespace App\Http\Controllers\Api;

use App\Contracts\LogServiceInterface;
use App\Contracts\MonobankServiceInterface;
use App\Contracts\OrderRepositoryInterface;
use App\DTO\Monobank\MonoStatementResponseDTO;
use App\Facades\HelperServiceFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonoController extends Controller
{
    public function setMonobankWebhook()
    {
        return response('', 200)->header('Content-Type', 'application/json');
    }

    public function handleMonobankEvent(
        Request $request,
        MonobankServiceInterface $monobankService,
        LogServiceInterface $logService,
        OrderRepositoryInterface $orderRepository
    ) {
        if (HelperServiceFacade::isNotProduction()) {
            $order = $orderRepository->getLastOrder();
            $data = $monobankService->getMockDataTransactionMonobank($order);
        } else {
            return new MonoStatementResponseDTO($request->input('data'));
        }
        $logService->info("MONOBANK HANDLE EVENT INPUT DATA:" . json_encode($data, JSON_UNESCAPED_UNICODE));
        try {
            $monobankService->updateOrderPayment($data);
        } catch (\Exception $exception) {
            $logService->error("MONOBANK HANDLE EVENT ERROR:" . $exception->getMessage());
        }

        return response('', 200)->header('Content-Type', 'application/json');
    }

}
