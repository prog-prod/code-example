<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MonobankServiceInterface;
use App\Contracts\SettingsServiceInterface;
use App\Contracts\TelegramServiceInterface;
use App\Models\Order;
use App\Models\TelegramChat;
use App\Services\NovaPoshtaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends BaseAdminController
{
    public function getNotifications()
    {
        return view('admin.settings.notifications', [
            'admin' => Auth::user()
        ]);
    }

    public function getBanks(MonobankServiceInterface $monobankService)
    {
        $info = $monobankService->getInfo();
        $accounts = $info->accounts;
        return view('admin.settings.banks', [
            'monobank' => $info,
            'accounts' => $accounts
        ]);
    }

    public function getNovaPoshtaSettings(SettingsServiceInterface $settingService)
    {
        $order = Order::latest()->limit(1)->get()->first();
        $res = app(NovaPoshtaService::class)->createTTN($order);
        $citySender = $settingService->getCitySender();
        return view('admin.settings.nova-poshta', compact('citySender'));
    }

    public function saveSenderCitySetting(Request $request, SettingsServiceInterface $settingsService)
    {
        $request->validate([
            'citySender' => 'json'
        ]);
        $senderCity = json_decode($request->get('citySender'));
        if ($settingsService->setCitySender($senderCity)) {
            return back()->with('success', 'City sender was set successfully');
        }
        return back()->with('error', 'City sender was not set successfully');
    }


    public function getMonobankExtract(Request $request, MonobankServiceInterface $monobankService)
    {
        $request->validate([
            'account_id' => 'required|string',
        ]);
        $from = Carbon::now()->subWeek()->startOfWeek()->timestamp;
        $to = time();
//        $from = Carbon::parse('2022-02-01')->timestamp;
        $extract_data = $monobankService->getExtract($request->get('account_id'), $from, $to);

        dd($extract_data);
    }

    public function setMonobankWebhook(MonobankServiceInterface $monobankService)
    {
        try {
            $response = $monobankService->setWebhook();
            if ($response) {
                return back()->with('success', 'Webhook was set successfully');
            }
            throw new \Exception('Webhook was not set successfully');
        } catch (\Exception $exception) {
            return back()->with('error', 'Webhook was not set successfully: ' . $exception->getMessage());
        }
    }

    public function setTelegramWebhook(TelegramServiceInterface $telegramService)
    {
        if ($telegramService->setWebhook()) {
            return back()->with('success', 'Webhook was set successfully');
        }
        return back()->with('error', 'Webhook was not set successfully');
    }

    public function removeTelegramWebhook(TelegramServiceInterface $telegramService)
    {
        if ($telegramService->removeWebhook()) {
            return back()->with('success', 'Webhook was removed successfully');
        }
        return back()->with('error', 'Webhook was not removed successfully');
    }

    public function removeTelegramChat(Request $request, TelegramChat $telegramChat)
    {
        $admin = $request->user();

        if ($admin->detachTelegramChat($telegramChat)) {
            return back()->with('success', 'Chat was detached successfully');
        }

        return back()->with('error', 'Chat was not detached successfully');
    }

    public function regenerateTelegramApiToken(Request $request, TelegramServiceInterface $telegramService)
    {
        $request->user()->api_token = $telegramService->generateToken();
        $request->user()->save();

        return back()->with('success', 'Token regenerated successfully');
    }
}
