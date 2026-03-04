<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;

class PromoCodeController extends Controller
{
    public function index()
    {
        $codes = PromoCode::latest()->paginate(10);
        return view('Admin.PromoCodes.index', compact('codes'));
    }

    public function create()
    {
        return view('Admin.PromoCodes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|unique:promo_codes,code',
            'type'        => 'required|in:percentage,fixed',
            'value'       => 'required|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'expires_at'  => 'nullable|date',
        ]);

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        PromoCode::create($data);

        return redirect()->route('promo-codes.index')
            ->with('success', 'Promo code created successfully!');
    }

    public function edit($id)
    {
        $code = PromoCode::findOrFail($id);
        return view('Admin.PromoCodes.edit', compact('code'));
    }

    public function update(Request $request, $id)
    {
        $code = PromoCode::findOrFail($id);

        $data = $request->validate([
            'code'        => 'required|unique:promo_codes,code,' . $id,
            'type'        => 'required|in:percentage,fixed',
            'value'       => 'required|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'expires_at'  => 'nullable|date',
        ]);

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $code->update($data);

        return redirect()->route('promo-codes.index')
            ->with('success', 'Promo code updated successfully!');
    }

    public function destroy($id)
    {
        PromoCode::findOrFail($id)->delete();

        return redirect()->route('promo-codes.index')
            ->with('success', 'Promo code deleted successfully!');
    }
}