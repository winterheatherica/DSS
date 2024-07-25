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
