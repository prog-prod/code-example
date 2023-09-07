<?php

namespace App\Repositories;

use App\Contracts\LogsRepositoryInterface;
use App\Models\PhoneCodesLog;
use Exception;
use Illuminate\Database\Eloquent\Model;

class LogsRepository implements LogsRepositoryInterface
{

    /**
     * @throws Exception
     */
    public function logPhoneCode(string $phone, string $code)
    {
        $location = geoip()->getLocation()->toArray();
        return PhoneCodesLog::query()->create([
            'phone' => $phone,
            'code' => $code,
            'ip' => $location['ip'],
            'location' => json_encode($location)
        ]);
    }

    public function getPhoneCodeLogByPhone(string $phone): Model|null
    {
        return PhoneCodesLog::query()->where('phone', $phone)->limit(1)->latest()->first();
    }
}
