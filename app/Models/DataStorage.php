<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataProceccor;

class DataStorage extends Model
{
    /**
     * For adding several items to DB
     */
    protected $guarded = [];

    /**
     * Do not store date of creation
     */
    public $timestamps = false;

    /**
     * Get statistics for specific date
     * @param array $date 
     */
    public function getForDate($date)
    {
        $items = DataStorage::where('rank_date', $date)->get();
        $data = [];
        if(!$items->isEmpty()) {
            foreach($items as $item) {
                $data[] = [$item->categoryId => $item->rank];
            }
        }
        return $data;
    }

    /**
     * Refresh DB data
     */
    public function refreshTable() 
    {
        $dataProceccor = new DataProceccor();
        $response = $dataProceccor->makeRequest();

        if ($response['status']) {
            $data = $response['data'] ?? [];
            $data = $this->_filterData($data);
            $this::query()->truncate();
            foreach($data as $category => $items) {
                foreach($items as $date => $rank) {
                    self::updateOrCreate(
                        [
                            'categoryId' => $category,
                            'rank_date' => $date
                        ], 
                        [
                            'categoryId' => $category,
                            'rank_date' => $date,
                            'rank' => $rank 
                        ]
                    );
                }
            }
        } 

        return $response;
    }

    /**
     * Prepare data for saving to db
     * @param array $data
     */
    protected function _filterData($data) 
    {
        $result = [];
        foreach($data as $categoryId => $items) {
            $row = [];
            foreach($items as $item) {
                foreach($item as $date => $rank) {
                    $rank = (int)$rank;
                    if (empty($rank)) {
                        continue;
                    }
                    
                    if (!isset($row[$date]) || ($row[$date] > $rank)) {
                        $row[$date] = $rank;
                    } 
                }
            }

            $result[$categoryId] = $row;
        }

        return $result;
    }
}
