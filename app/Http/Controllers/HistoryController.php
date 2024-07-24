<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Alternative_Proportion;
use App\Models\Criteria_Proportion;
use App\Models\Alternative_Criteria;
use App\Models\DSS_Method;
use App\Models\Alternative;
use App\Models\Criteria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $arr5 = [];
        $arr6 = [];
        $SAW = [];
        $WP = [];
        $WASPAS = [];
        $final_rank = [];

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
                $arr5[$i][$j] = $arr4[$j] * $arr3[$i][$j];
                $jumlah += $arr4[$j] * $arr3[$i][$j];
            }
            $SAW[$i] = $jumlah;
        }

        foreach ($alternative_proportions as $i => $alternative) {
            $kali = 1;
            foreach ($criteria_proportions as $j => $criteria) {
                $arr6[$i][$j] = pow($arr3[$i][$j], $arr4[$j]);
                $kali *= pow($arr3[$i][$j], $arr4[$j]);
            }
            $WP[$i] = $kali;
        }

        foreach ($alternative_proportions as $i => $alternative) {
            $WASPAS[$i] = $detailed_history->primary_weight * $SAW[$i] + $detailed_history->secondary_weight * $WP[$i];
        }

        $waspas_with_index = [];
        foreach ($WASPAS as $index => $value) {
            $waspas_with_index[] = ['index' => $index, 'value' => $value];
        }

        usort($waspas_with_index, function ($a, $b) {
            return $b['value'] <=> $a['value'];
        });

        $final_rank = array_fill(0, count($WASPAS), 0);
        foreach ($waspas_with_index as $rank => $item) {
            $final_rank[$item['index']] = $rank + 1;
        }

        return view('/data/detailed_history', compact('arr3', 'arr4', 'arr5', 'arr6', 'SAW', 'WP', 'WASPAS', 'final_rank', 'detailed_history', 'alternative_proportions', 'criteria_proportions'));
    }

    public function copy($history_id)
    {
        DB::beginTransaction();
        try {
            \Log::info('Mulai proses penyalinan history dengan history_id: ' . $history_id);

            $original_history = History::findOrFail($history_id);
            \Log::info('History asli ditemukan: ' . json_encode($original_history));

            $new_history = $original_history->replicate();
            $new_history->save();
            \Log::info('History baru berhasil disimpan dengan history_id: ' . $new_history->history_id);

            $alternative_proportions = Alternative_Proportion::where('history_id', $history_id)->get();
            foreach ($alternative_proportions as $alternative_proportion) {
                $new_alternative_proportion = $alternative_proportion->replicate();
                $new_alternative_proportion->history_id = $new_history->history_id;
                $new_alternative_proportion->save();
                \Log::info('Alternative proportion berhasil disimpan dengan history_id: ' . $new_alternative_proportion->history_id);
            }
            \Log::info('Alternative proportions berhasil disalin.');

            $criteria_proportions = Criteria_Proportion::where('history_id', $history_id)->get();
            foreach ($criteria_proportions as $criteria_proportion) {
                $new_criteria_proportion = $criteria_proportion->replicate();
                $new_criteria_proportion->history_id = $new_history->history_id;
                $new_criteria_proportion->save();
                \Log::info('Criteria proportion berhasil disimpan dengan history_id: ' . $new_criteria_proportion->history_id);
            }
            \Log::info('Criteria proportions berhasil disalin.');

            DB::commit();
            \Log::info('Transaksi berhasil dikomit.');

            return redirect('/history')->with('success', 'History berhasil disalin.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error saat menyalin history: '.$e->getMessage());
            return redirect('/history')->with('error', 'Terjadi kesalahan saat menyalin history.');
        }
    }

    public function editshow($history_id)
    {
        $detailed_history = History::with(['alternative_proportions', 'criteria_proportions', 'method', 'table_user'])->findOrFail($history_id);
        $methods = DSS_Method::all();
        $total_alternative = Alternative::all();
        $total_criteria = Criteria::all();

        return view('data.edit_history', compact('detailed_history', 'methods', 'total_alternative', 'total_criteria'));
    }

    public function update(Request $request, $history_id)
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

        DB::beginTransaction();
        try {
            \Log::info('Mulai proses update history dengan history_id: ' . $history_id);

            $history = History::findOrFail($history_id);
            $history->method_id = $request->input('method_id');
            $history->case_name = $request->input('case_name');
            $history->primary_weight = $request->input('primary_weight') == '-' ? null : $request->input('primary_weight');
            $history->secondary_weight = $request->input('secondary_weight') == '-' ? null : $request->input('secondary_weight');
            $history->save();
            \Log::info('History berhasil diupdate: ' . json_encode($history));

            Alternative_Proportion::where('history_id', $history_id)->delete();
            \Log::info('Alternative proportions berhasil dihapus.');

            foreach ($request->input('alternatives') as $alternative_id) {
                $alternativeProportion = new Alternative_Proportion();
                $alternativeProportion->history_id = $history_id;
                $alternativeProportion->alternative_id = $alternative_id;
                $alternativeProportion->final_score = null;
                $alternativeProportion->final_rank = null;
                $alternativeProportion->save();
                \Log::info('Alternative proportion berhasil disimpan dengan history_id: ' . $alternativeProportion->history_id);
            }
            \Log::info('Alternative proportions berhasil disalin.');

            Criteria_Proportion::where('history_id', $history_id)->delete();
            \Log::info('Criteria proportions berhasil dihapus.');

            $selectedCriteria = $request->input('criteria');
            $criteriaValues = $request->input('criteria_value');

            foreach ($selectedCriteria as $index => $criteria_id) {
                if (isset($criteriaValues[$criteria_id])) {
                    $criteriaProportion = new Criteria_Proportion();
                    $criteriaProportion->history_id = $history_id;
                    $criteriaProportion->criteria_id = $criteria_id;
                    $criteriaProportion->criteria_value = $criteriaValues[$criteria_id];
                    $criteriaProportion->criteria_priority = null; // Or according to your logic
                    $criteriaProportion->save();
                    \Log::info('Criteria proportion berhasil disimpan dengan history_id: ' . $criteriaProportion->history_id);
                }
            }
            \Log::info('Criteria proportions berhasil disalin.');

            DB::commit();
            \Log::info('Transaksi berhasil dikomit.');

            return redirect('/history')->with('success', 'Calculation updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error saat mengupdate history: '.$e->getMessage());
            return redirect()->route('history.editshow', ['history_id' => $history_id])->with('error', 'Terjadi kesalahan saat mengupdate history.');
        }
    }

    public function destroy($history_id)
    {
        DB::beginTransaction();
        try {
            \Log::info('Mulai proses penghapusan history dengan history_id: ' . $history_id);

            Alternative_Proportion::where('history_id', $history_id)->delete();
            \Log::info('Alternative proportions berhasil dihapus.');

            Criteria_Proportion::where('history_id', $history_id)->delete();
            \Log::info('Criteria proportions berhasil dihapus.');

            History::findOrFail($history_id)->delete();
            \Log::info('History berhasil dihapus.');

            DB::commit();
            \Log::info('Transaksi berhasil dikomit.');

            return redirect('/history')->with('success', 'History berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error saat menghapus history: '.$e->getMessage());
            return redirect('/history')->with('error', 'Terjadi kesalahan saat menghapus history.');
        }
    }

}
