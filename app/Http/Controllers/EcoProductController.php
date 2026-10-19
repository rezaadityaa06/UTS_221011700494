<?php

namespace App\Http\Controllers;

use App\Models\EcoProduct;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EcoProductController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'featuredProducts' => EcoProduct::orderBy('id')->limit(3)->get(),
            'productCount' => EcoProduct::count(),
        ]);
    }

    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $query = EcoProduct::query();
        $keyword = trim($filters['q'] ?? '');

        if ($keyword !== '') {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('material', 'like', '%' . $keyword . '%');
            });
        }

        return view('products.index', [
            'products' => $query->orderBy('id')->get(),
        ]);
    }

    public function show(EcoProduct $ecoProduct): View
    {
        return view('products.show', [
            'product' => $ecoProduct,
        ]);
    }
}