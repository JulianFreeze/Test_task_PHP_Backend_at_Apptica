<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataStorage;
use App\Models\DataProceccor;

class MainController extends Controller
{
    /**
     * Main page
     */
    public function index()
    {
        $rows = DataStorage::all();
        $state = $rows->isEmpty() ?  'No data is avaliable.' : 'Data is avaliable';
        $refreshUrl = url("/refresh");
        return view('welcome', compact(['state', 'refreshUrl']));
    }

    /**
     * Refresh database data
     */
    public function refresh()
    {
        $model = new DataStorage();
        $result = $model->refreshTable();

        if ($result['status']) {
            return redirect('/');
        } else {
            $message = $result['data'] ?? 'Unknown error';
            if (is_array($message)) {
                $message = print_r($message, true);
            }
            $message = 'Failed: ' . $message;
            return view('error', compact('message'));
        }
    }
}
