<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DSS_Method;
use App\Models\Alternative;
use App\Models\Criteria;

use App\Models\History;
use App\Models\Alternative_Proportion;
use App\Models\Criteria_Proportion;


class CalculationController extends Controller
{
    public function showForm()
    {
        $methods = DSS_Method::all();
        $total_alternative = Alternative::all();
        $total_criteria = Criteria::all();

        return view('data.calculation', [
            'title' => 'Calculation',
            'methods' => $methods,
            'total_alternative' => $total_alternative,
            'total_criteria' => $total_criteria,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'method_id' => 'required|exists:tb_method,method_id',
            'case_name' => 'required|string|max:100',
            'primary_weight' => 'nullable|numeric',
            'secondary_weight' => 'nullable|numeric',
            'alternatives' => 'required|array',
            'alternatives.*' => 'exists:tb_alternative,alternative_id',
            'criteria' => 'required|array',
            'criteria.*' => 'exists:tb_criteria,criteria_id',
            'criteria_value' => 'required|array',
        ]);

        $history = new History();
        $history->method_id = $request->input('method_id');
        $history->user_id = 1; // Assuming user_id 1 for example
        $history->case_name = $request->input('case_name');
        $history->primary_weight = $request->input('primary_weight') ?: null;
        $history->secondary_weight = $request->input('secondary_weight') ?: null;
        $history->save();

        $history_id = $history->history_id;

        foreach ($request->input('alternatives') as $alternative_id) {
            $alternativeProportion = new Alternative_Proportion();
            $alternativeProportion->history_id = $history_id;
            $alternativeProportion->alternative_id = $alternative_id;
            $alternativeProportion->final_score = null; // Initialize as needed
            $alternativeProportion->final_rank = null; // Initialize as needed
            $alternativeProportion->save();
        }

        $selectedCriteria = $request->input('criteria');
        $criteriaValues = $request->input('criteria_value');

        foreach ($selectedCriteria as $index => $criteria_id) {
            if (isset($criteriaValues[$criteria_id])) {
                $criteriaProportion = new Criteria_Proportion();
                $criteriaProportion->history_id = $history_id;
                $criteriaProportion->criteria_id = $criteria_id;
                $criteriaProportion->criteria_value = $criteriaValues[$criteria_id];
                $criteriaProportion->criteria_priority = null; // Initialize as needed
                $criteriaProportion->save();
            }
        }

        return redirect()->route('history.show', ['history_id' => $history_id])->with('success', 'Calculation stored successfully!');
    }
}
