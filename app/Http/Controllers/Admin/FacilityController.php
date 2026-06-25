<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Facility;
use App\Models\FacilityCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        return view('admin.facilities.index', [
            'facilities' => Facility::query()->with(['business', 'categories'])->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.facilities.create', $this->formData(new Facility(['status' => 'draft', 'credit_cost' => 1])));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $categoryIds = $validated['category_ids'] ?? [];
        unset($validated['category_ids']);
        $validated['slug'] = Str::slug($validated['name']);

        $facility = Facility::create($validated);
        $facility->categories()->sync($categoryIds);

        return redirect()->route('admin.facilities.index')->with('status', 'Facility created.');
    }

    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', $this->formData($facility));
    }

    public function update(Request $request, Facility $facility): RedirectResponse
    {
        $validated = $this->validated($request);
        $categoryIds = $validated['category_ids'] ?? [];
        unset($validated['category_ids']);
        $validated['slug'] = Str::slug($validated['name']);

        $facility->update($validated);
        $facility->categories()->sync($categoryIds);

        return redirect()->route('admin.facilities.index')->with('status', 'Facility updated.');
    }

    private function formData(Facility $facility): array
    {
        return [
            'facility' => $facility,
            'businesses' => Business::query()->orderBy('trade_name')->get(),
            'categories' => FacilityCategory::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'statuses' => ['draft', 'active', 'paused', 'suspended'],
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'business_id' => ['required', 'exists:businesses,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:draft,active,paused,suspended'],
            'address_line' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'province' => ['required', 'string', 'max:120'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'credit_cost' => ['required', 'integer', 'min:1', 'max:1000'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['exists:facility_categories,id'],
        ]);
    }
}
