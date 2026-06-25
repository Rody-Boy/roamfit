<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(): View
    {
        return view('admin.businesses.index', [
            'businesses' => Business::query()->with('owner')->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.businesses.create', [
            'business' => new Business(['status' => 'pending']),
            'owners' => User::query()->whereIn('role', ['business_owner', 'admin'])->orderBy('name')->get(),
            'statuses' => $this->statuses(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Business::create($this->validated($request));

        return redirect()->route('admin.businesses.index')->with('status', 'Business created.');
    }

    public function edit(Business $business): View
    {
        return view('admin.businesses.edit', [
            'business' => $business,
            'owners' => User::query()->whereIn('role', ['business_owner', 'admin'])->orderBy('name')->get(),
            'statuses' => $this->statuses(),
        ]);
    }

    public function update(Request $request, Business $business): RedirectResponse
    {
        $business->update($this->validated($request));

        return redirect()->route('admin.businesses.index')->with('status', 'Business updated.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'owner_id' => ['nullable', 'exists:users,id'],
            'legal_name' => ['required', 'string', 'max:255'],
            'trade_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:pending,approved,rejected,suspended'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
        ]);
    }

    private function statuses(): array
    {
        return ['pending', 'approved', 'rejected', 'suspended'];
    }
}
