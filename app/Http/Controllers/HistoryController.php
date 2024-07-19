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

        $Crit = count($criteria_proportions);
        $Alt = count($alternative_proportions);

        $bORc = [];
        $arr1 = [];
        $arr2 = [];
        $minORmax = array_fill(0, $Crit, 0);
        $arr3 = [];
        $arr4 = [];
        $SAW = [];
        $WP = [];
        $WASPAS = [];

        foreach ($criteria_proportions as $i => $criteria) {
            $arr1[$i] = $criteria->criteria_value;
            $bORc[$i] = $criteria->criteria->criteria_status;
        }

        foreach ($alternative_proportions as $i => $alternative) {
            $arr2[$i] = [];
            foreach ($criteria_proportions as $j => $criteria) {
                $alternativeCriteria = Alternative_Criteria::where('alternative_id', $alternative->alternative_id)
                    ->where('criteria_id', $criteria->criteria_id)
                    ->first();
                $arr2[$i][$j] = $alternativeCriteria ? $alternativeCriteria->alternative_criteria_value : 0;
            }
        }

        $total = array_sum($arr1);

        foreach ($arr1 as $i => $value) {
            $arr4[$i] = $value / $total;
        }

        foreach ($criteria_proportions as $i => $criteria) {
            $nilai_max = PHP_INT_MIN;
            $nilai_min = PHP_INT_MAX;
            if ($bORc[$i] === 'b') {
                foreach ($arr2 as $j => $values) {
                    if ($values[$i] > $nilai_max) {
                        $nilai_max = $values[$i];
                    }
                }
                $minORmax[$i] = $nilai_max;
            } else if ($bORc[$i] === 'c') {
                foreach ($arr2 as $j => $values) {
                    if ($values[$i] < $nilai_min) {
                        $nilai_min = $values[$i];
                    }
                }
                $minORmax[$i] = $nilai_min;
            }
        }

        foreach ($alternative_proportions as $i => $alternative) {
            foreach ($criteria_proportions as $j => $criteria) {
                if ($bORc[$j] === 'b') {
                    $arr3[$i][$j] = $arr2[$i][$j] / $minORmax[$j];
                } else if ($bORc[$j] === 'c') {
                    $arr3[$i][$j] = $minORmax[$j] / $arr2[$i][$j];
                }
            }
        }

        foreach ($alternative_proportions as $i => $alternative) {
            $jumlah = 0;
            foreach ($criteria_proportions as $j => $criteria) {
                $jumlah += $arr4[$j] * $arr3[$i][$j];
            }
            $SAW[$i] = $jumlah;
        }

        foreach ($alternative_proportions as $i => $alternative) {
            $kali = 1;
            foreach ($criteria_proportions as $j => $criteria) {
                $kali *= pow($arr3[$i][$j], $arr4[$j]);
            }
            $WP[$i] = $kali;
        }

        foreach ($alternative_proportions as $i => $alternative) {
            $WASPAS[$i] = 0.5 * $SAW[$i] + 0.5 * $WP[$i];
        }

        return view('/data/detailed_history', compact('SAW', 'WP', 'WASPAS', 'detailed_history', 'alternative_proportions', 'criteria_proportions'));
    }
}
