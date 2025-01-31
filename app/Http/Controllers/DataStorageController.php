<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateStorageRequest;
use App\Models\DataStorage;
use Illuminate\Support\Facades\Log;

class DataStorageController extends Controller
{
    /**
     * Response codes
     */
    CONST CODE_FAILED = 400;
    CONST CODE_SUCCESS = 200;

    /**
     * Endpoint for rank info for date
     * @param DateStorageRequest $request
     */
    public function appTopCategory(DateStorageRequest $request) 
    {
        if ($data = $request->hasError()) {
            $code = self::CODE_FAILED;
            Log::channel('api')->info('Request failed. Error: ' . $data);
        } else {
            $date = $request->date;
            Log::channel('api')->info('Request. Date: ' . $date);
    
            $model = new DataStorage();
            $data = $model->getForDate($date);

            $code = empty($data) ? self::CODE_FAILED : self::CODE_SUCCESS;
        }

        $result = [
            'status_code' => $code,
            'data' => $data
        ];

        return response()->json($result);
    }
}
