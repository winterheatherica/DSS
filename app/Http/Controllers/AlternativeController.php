<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alternative;

class AlternativeController extends Controller
{
    public function index()
    {
        $title = 'Alternative List';
        $total_alternative = Alternative::paginate(8);
        return view('data.alternative', compact('title', 'total_alternative'));
    }

    public function show($id)
    {
        $alternativeDetail = DB::table('tb_alternative')
            ->where('alternative_id', $id)
            ->first();

        $alternative = DB::table('tb_criteria')
            ->leftJoin('tb_alternative_criteria', function($join) use ($id) {
                $join->on('tb_criteria.criteria_id', '=', 'tb_alternative_criteria.criteria_id')
                     ->where('tb_alternative_criteria.alternative_id', '=', $id);
            })
            ->select('tb_criteria.criteria_id', 'tb_criteria.criteria_name', 'tb_alternative_criteria.alternative_criteria_value')
            ->get();

        $title = "Alternative {$alternativeDetail->alternative_id} -> {$alternativeDetail->alternative_name}";

        return view('data.detailed_alternative', [
            'title' => $title, 
            'alternative' => $alternative,
            'alternative_id' => $id
        ]);
    }

    public function create()
    {
        return view('data.add_alternative', ['title' => 'Add Alternative Page', 'total_alternative' => Alternative::all()]);
    }

    public function store(Request $request)
    {
        $alternative = new Alternative;
        $alternative->alternative_name = $request->input('alternative_name');
        $alternative->save();

        return redirect('/add_alternative')->with('success', 'Alternative added successfully!');
    }

    public function update(Request $request)
    {
        $alternative_id = $request->input('alternative_id');
        $alternative_name = $request->input('alternative_name');
        $currentPage = $request->input('page', 1);

        DB::table('tb_alternative')
            ->where('alternative_id', $alternative_id)
            ->update(['alternative_name' => $alternative_name]);

        return redirect()->route('alternative.index', ['page' => $currentPage])
                        ->with('success', 'Alternative updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        DB::table('tb_alternative')->where('alternative_id', $id)->delete();
        $currentPage = $request->input('page', 1);
        return redirect()->route('alternative.index', ['page' => $currentPage])->with('success', 'Alternative deleted successfully!');
    }

}
