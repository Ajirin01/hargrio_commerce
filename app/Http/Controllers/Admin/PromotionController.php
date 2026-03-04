<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->paginate(10);
        return view('Admin.Promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('Admin.Promotions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|min:3|max:191',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        Promotion::create($data);

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion created successfully!');
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('Admin.Promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        $data = $request->validate([
            'title'       => 'required|min:3|max:191',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $promotion->update($data);

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion updated successfully!');
    }

    public function destroy($id)
    {
        Promotion::findOrFail($id)->delete();

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion deleted successfully!');
    }
}