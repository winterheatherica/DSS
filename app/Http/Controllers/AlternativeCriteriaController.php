<?php

namespace App\Http\Controllers;

use App\Models\Alternative_Criteria;
use App\Models\Alternative_Proportion;
use App\Models\Criteria_Proportion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternativeCriteriaController extends Controller
{
    public function saveCriteriaValue(Request $request)
    {
        $alternative_id = $request->input('alternative_id');
        $criteria_values = $request->input('criteria_values', []);

        foreach ($criteria_values as $criteria_id => $criteria_value) {
            if ($criteria_id) {
                if ($criteria_value === null || $criteria_value === '') {
                    DB::table('tb_alternative_criteria')
                        ->where('alternative_id', $alternative_id)
                        ->where('criteria_id', $criteria_id)
                        ->delete();
                } else {
                    $existing = DB::table('tb_alternative_criteria')
                        ->where('alternative_id', $alternative_id)
                        ->where('criteria_id', $criteria_id)
                        ->first();

                    if ($existing) {
                        DB::table('tb_alternative_criteria')
                            ->where('alternative_id', $alternative_id)
                            ->where('criteria_id', $criteria_id)
                            ->update(['alternative_criteria_value' => $criteria_value]);
                    } else {
                        DB::table('tb_alternative_criteria')
                            ->insert([
                                'alternative_id' => $alternative_id,
                                'criteria_id' => $criteria_id,
                                'alternative_criteria_value' => $criteria_value,
                            ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function saveAlternativeValue(Request $request)
    {
        $criteria_id = $request->input('criteria_id');
        $criteria_values = $request->input('criteria_values', []);

        foreach ($criteria_values as $alternative_id => $criteria_value) {
            if ($alternative_id) {
                if ($criteria_value === null || $criteria_value === '') {
                    DB::table('tb_alternative_criteria')
                        ->where('criteria_id', $criteria_id)
                        ->where('alternative_id', $alternative_id)
                        ->delete();
                } else {
                    $existing = DB::table('tb_alternative_criteria')
                        ->where('criteria_id', $criteria_id)
                        ->where('alternative_id', $alternative_id)
                        ->first();

                    if ($existing) {
                        DB::table('tb_alternative_criteria')
                            ->where('criteria_id', $criteria_id)
                            ->where('alternative_id', $alternative_id)
                            ->update(['alternative_criteria_value' => $criteria_value]);
                    } else {
                        DB::table('tb_alternative_criteria')
                            ->insert([
                                'criteria_id' => $criteria_id,
                                'alternative_id' => $alternative_id,
                                'alternative_criteria_value' => $criteria_value,
                            ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function show($alternative_id, $criteria_id)
    {
        $alternative_criteria = Alternative_Criteria::where('alternative_id', $alternative_id)
            ->where('criteria_id', $criteria_id)
            ->firstOrFail();

        return view('data.detailed_history', compact('alternative_criteria'));
    }
}

