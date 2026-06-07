<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(Request $request): View
    {
        $facilities = Facility::query()
            ->with('categories')
            ->where('status', 'active')
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%'.$request->q.'%'))
            ->when($request->filled('city'), fn ($query) => $query->where('city', $request->city))
            ->when($request->filled('province'), fn ($query) => $query->where('province', $request->province))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('facilities.index', compact('facilities'));
    }

    public function show(Facility $facility): View
    {
        abort_unless($facility->status === 'active', 404);

        return view('facilities.show', compact('facility'));
    }
}
