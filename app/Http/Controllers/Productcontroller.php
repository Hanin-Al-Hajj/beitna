<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class Productcontroller extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by category if passed as ?category=chairs
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Search by name or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->get();

        return view('shopping', compact('products'));
    }
}
