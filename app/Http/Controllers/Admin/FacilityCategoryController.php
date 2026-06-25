<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacilityCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FacilityCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.facility-categories.index', [
            'categories' => FacilityCategory::query()->orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.facility-categories.create', ['category' => new FacilityCategory()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:facility_categories,name'],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        FacilityCategory::create($validated);

        return redirect()->route('admin.facility-categories.index')->with('status', 'Category created.');
    }

    public function edit(FacilityCategory $facilityCategory): View
    {
        return view('admin.facility-categories.edit', ['category' => $facilityCategory]);
    }

    public function update(Request $request, FacilityCategory $facilityCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:facility_categories,name,'.$facilityCategory->id],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $facilityCategory->update($validated);

        return redirect()->route('admin.facility-categories.index')->with('status', 'Category updated.');
    }
}
