@csrf
<label class="block text-sm text-slate-300">Business
    <select name="business_id" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
        <option value="">Select business</option>
        @foreach($businesses as $business)
            <option value="{{ $business->id }}" @selected((string) old('business_id', $facility->business_id) === (string) $business->id)>{{ $business->trade_name }}</option>
        @endforeach
    </select>
</label>
<label class="mt-4 block text-sm text-slate-300">Name
    <input name="name" value="{{ old('name', $facility->name) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
</label>
<label class="mt-4 block text-sm text-slate-300">Description
    <textarea name="description" rows="4" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">{{ old('description', $facility->description) }}</textarea>
</label>
<div class="mt-4 grid gap-4 md:grid-cols-3">
    <label class="block text-sm text-slate-300">Status
        <select name="status" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
            @foreach($statuses as $status)<option value="{{ $status }}" @selected(old('status', $facility->status) === $status)>{{ ucfirst($status) }}</option>@endforeach
        </select>
    </label>
    <label class="block text-sm text-slate-300">Credit cost
        <input name="credit_cost" type="number" min="1" value="{{ old('credit_cost', $facility->credit_cost ?? 1) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
    </label>
    <label class="block text-sm text-slate-300">Capacity
        <input name="capacity" type="number" min="1" value="{{ old('capacity', $facility->capacity) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
    </label>
</div>
<label class="mt-4 block text-sm text-slate-300">Address
    <input name="address_line" value="{{ old('address_line', $facility->address_line) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
</label>
<div class="mt-4 grid gap-4 md:grid-cols-2">
    <label class="block text-sm text-slate-300">City
        <input name="city" value="{{ old('city', $facility->city) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
    </label>
    <label class="block text-sm text-slate-300">Province
        <input name="province" value="{{ old('province', $facility->province) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
    </label>
</div>
<div class="mt-4 grid gap-4 md:grid-cols-2">
    <label class="block text-sm text-slate-300">Latitude
        <input name="latitude" value="{{ old('latitude', $facility->latitude) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
    </label>
    <label class="block text-sm text-slate-300">Longitude
        <input name="longitude" value="{{ old('longitude', $facility->longitude) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
    </label>
</div>
<fieldset class="mt-4 rounded-2xl border border-white/10 p-4">
    <legend class="px-2 text-sm text-slate-300">Categories</legend>
    <div class="grid gap-2 md:grid-cols-2">
        @foreach($categories as $category)
            <label class="flex items-center gap-3 text-sm text-slate-200">
                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" @checked(in_array($category->id, old('category_ids', $facility->exists ? $facility->categories->pluck('id')->all() : []), true))>
                {{ $category->name }}
            </label>
        @endforeach
    </div>
</fieldset>
<button class="mt-6 rounded-xl bg-emerald-400 px-5 py-3 font-bold text-slate-950">Save facility</button>
