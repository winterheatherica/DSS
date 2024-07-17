<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Alternative_Proportion;
use App\Models\Criteria_Proportion;
use App\Models\Alternative_Criteria;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::with(['method', 'table_user'])->get();

        return view('/data/history', compact('history'));
    }

    public function show($history_id)
    {
        $detailed_history = History::with('method')->findOrFail($history_id);

        $alternative_proportions = Alternative_Proportion::where('history_id', $history_id)
            ->with('alternative')
            ->get();

        $criteria_proportions = Criteria_Proportion::where('history_id', $history_id)
            ->with('criteria')
            ->get();

        return view('/data/detailed_history', compact('detailed_history', 'alternative_proportions', 'criteria_proportions'));
    }
}
