<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Criteria List';
        $currentPage = $request->input('page', 1);
        $total_criteria = Criteria::paginate(8);
        return view('data.criteria', compact('title', 'total_criteria', 'currentPage'));
    }

    public function create()
    {
        return view('data.add_criteria', ['title' => 'Add Criteria Page', 'total_criteria' => Criteria::all()]);
    }

    public function store(Request $request)
    {
        $criteria = new Criteria;
        $criteria->criteria_name = $request->input('criteria_name');
        $criteria->criteria_status = $request->input('criteria_status');
        $criteria->save();

        return redirect('/add_criteria')->with('success', 'Criteria added successfully!');
    }

    public function updateName(Request $request)
    {
        $criteria_id = $request->input('criteria_id');
        $criteria_name = $request->input('criteria_name');
        $currentPage = $request->input('page', 1);

        DB::table('tb_criteria')
            ->where('criteria_id', $criteria_id)
            ->update(['criteria_name' => $criteria_name]);

        return redirect()->route('criteria.index', ['page' => $currentPage])
                         ->with('success', 'Criteria name updated successfully!');
    }

    public function updateStatus(Request $request)
    {
        $criteria_id = $request->input('criteria_id');
        $criteria_status = $request->input('criteria_status');
        $currentPage = $request->input('page', 1);

        DB::table('tb_criteria')
            ->where('criteria_id', $criteria_id)
            ->update(['criteria_status' => $criteria_status]);

        return redirect()->route('criteria.index', ['page' => $currentPage])
                         ->with('success', 'Criteria status updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        DB::table('tb_criteria')->where('criteria_id', $id)->delete();
        $currentPage = $request->input('page', 1);
        return redirect()->route('criteria.index', ['page' => $currentPage])->with('success', 'Criteria deleted successfully!');
    }

    public function show($id)
    {
        $criteriaDetail = DB::table('tb_criteria')
            ->where('criteria_id', $id)
            ->first();
        
        $criteria = DB::table('tb_alternative')
            ->leftJoin('tb_alternative_criteria', function($join) use ($id) {
                $join->on('tb_alternative.alternative_id', '=', 'tb_alternative_criteria.alternative_id')
                     ->where('tb_alternative_criteria.criteria_id', '=', $id);
            })
            ->select('tb_alternative.alternative_id', 'tb_alternative.alternative_name', 'tb_alternative_criteria.alternative_criteria_value')
            ->get();

        $title = "Criteria {$criteriaDetail->criteria_name} (" . ($criteriaDetail->criteria_status == 'b' ? 'Benefit)' : 'Cost)');

        return view('data.detailed_criteria', [
            'title' => $title,
            'criteria' => $criteria,
            'criteria_id' => $id
        ]);
    }

}
