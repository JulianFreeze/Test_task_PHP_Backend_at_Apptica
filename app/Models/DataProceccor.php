<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class DataProceccor 
{
    /**
     * Endoint for requesting data
     */
    CONST ENDOINT_URL = "https://api.apptica.com/package/top_history/";

    /**
     * Make request to fetch fresh data
     */
    public function makeRequest() 
    {
        $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $today = $date->format('Y-m-d');
        $date->modify('-30 day');

        $url = $this->_getUrl($date->format('Y-m-d'), $today);
        $response =  Http::acceptJson()->get($url);
        $data = json_decode($response, JSON_OBJECT_AS_ARRAY);

        if ($data['status_code'] == 200) {
            return [
                'status' => true,
                'data' => $data['data'] ?? []
            ];
        } else {
            return [
                'status' => false,
                'data' => $data['error']
            ];
        }
    }

    /**
     * Prepare URL string for request
     * @param string $dateFrom 
     * @param string $dateTo 
     * @param string $appId 1421444 for AmongUs app
     * @param string $countryId 1 for USA
     */
    protected function _getUrl($dateFrom, $dateTo, $appId = "1421444", $countryId = "1")
    {
        return self::ENDOINT_URL . "$appId/$countryId?date_from=$dateFrom&date_to=$dateTo&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l";
    }
}