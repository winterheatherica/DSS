<?php

namespace App\Http\Controllers;

use App\Models\Alternative_Criteria;
use App\Models\Alternative_Proportion;
use App\Models\Criteria_Proportion;
use Illuminate\Http\Request;

class AlternativeCriteriaController extends Controller
{
    public function show($alternative_id, $criteria_id)
    {
        $alternative_criteria = Alternative_Criteria::where('alternative_id', $alternative_id)
            ->where('criteria_id', $criteria_id)
            ->firstOrFail();

        return view('data.detailed_history', compact('alternative_criteria'));
    }
}

