<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\CriteriaProportion;
use App\Models\AlternativeProportion;
use App\Models\AlternativeCriteria;

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

        // Mengambil proporsi alternatif terkait
        $alternative_proportions = AlternativeProportion::where('history_id', $history_id)
            ->with('alternative')
            ->get();

        // Mengambil proporsi kriteria terkait
        $criteria_proportions = CriteriaProportion::where('history_id', $history_id)
            ->with('criteria')
            ->get();

        // Inisialisasi variabel
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

        // Ambil nilai arr1 dan bORc dari criteria_proportions
        foreach ($criteria_proportions as $i => $criteria) {
            $arr1[$i] = $criteria->criteria_value;
            $bORc[$i] = $criteria->criteria_status;
        }

        // Ambil nilai arr2 dari alternative_proportions
        foreach ($alternative_proportions as $i => $alternative) {
            $arr2[$i] = [];
            foreach ($criteria_proportions as $j => $criteria) {
                $alternativeCriteria = AlternativeCriteria::where('alternative_id', $alternative->alternative_id)
                    ->where('criteria_id', $criteria->criteria_id)
                    ->first();
                $arr2[$i][$j] = $alternativeCriteria ? $alternativeCriteria->alternative_criteria_value : 0;
            }
        }

        // Hitung total nilai arr1
        $total = array_sum($arr1);

        // Hitung arr4
        foreach ($arr1 as $i => $value) {
            $arr4[$i] = $value / $total;
        }

        // Hitung minORmax
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

        // Hitung arr3 (Matriks Normalisasi)
        foreach ($alternative_proportions as $i => $alternative) {
            foreach ($criteria_proportions as $j => $criteria) {
                if ($bORc[$j] === 'b') {
                    $arr3[$i][$j] = $arr2[$i][$j] / $minORmax[$j];
                } else if ($bORc[$j] === 'c') {
                    $arr3[$i][$j] = $minORmax[$j] / $arr2[$i][$j];
                }
            }
        }

        // Hitung SAW
        foreach ($alternative_proportions as $i => $alternative) {
            $jumlah = 0;
            foreach ($criteria_proportions as $j => $criteria) {
                $jumlah += $arr4[$j] * $arr3[$i][$j];
            }
            $SAW[$i] = $jumlah;
        }

        // Hitung WP
        foreach ($alternative_proportions as $i => $alternative) {
            $kali = 1;
            foreach ($criteria_proportions as $j => $criteria) {
                $kali *= pow($arr3[$i][$j], $arr4[$j]);
            }
            $WP[$i] = $kali;
        }

        // Hitung WASPAS
        foreach ($alternative_proportions as $i => $alternative) {
            $WASPAS[$i] = 0.5 * $SAW[$i] + 0.5 * $WP[$i];
        }

        // Kirim hasil ke view
        return view('data.detailed_history', compact('detailed_history', 'alternative_proportions', 'criteria_proportions', 'arr3', 'SAW', 'WP', 'WASPAS'));
    }
}
