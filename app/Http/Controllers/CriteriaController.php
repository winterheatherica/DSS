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
        $total_criteria = Criteria::paginate(6);
        return view('data.criteria', compact('title', 'total_criteria', 'currentPage'));
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

}
