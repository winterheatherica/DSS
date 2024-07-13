<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\WPDataService;

use App\Models\History;
use App\Models\Method;


class HistoryController extends Controller
{
    public function showDetailedHistory($history_id)
    {
        $detailed_history = DB::table('tb_history')
            ->join('tb_method', 'tb_history.method_id', '=', 'tb_method.method_id')
            ->select('tb_history.*', 'tb_method.method_name')
            ->where('tb_history.history_id', $history_id)
            ->first();

        $wp1_data = WPDataService::getWP1Data($history_id);
        $wp2_data = WPDataService::getWP2Data($history_id);
        $wp3_data = WPDataService::getWP3Data($history_id);

        return view('data.detailed_history', [
            'title' => "History {$detailed_history->case_name}",
            'detailed_history' => $detailed_history,
            'wp1_data' => $wp1_data,
            'wp2_data' => $wp2_data,
            'wp3_data' => $wp3_data,
        ]);
    }
}
