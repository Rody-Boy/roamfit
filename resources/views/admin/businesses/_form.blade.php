@csrf
<label class="block text-sm text-slate-300">Owner
    <select name="owner_id" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
        <option value="">No owner yet</option>
        @foreach($owners as $owner)
            <option value="{{ $owner->id }}" @selected((string) old('owner_id', $business->owner_id) === (string) $owner->id)>{{ $owner->name }} — {{ $owner->email }}</option>
        @endforeach
    </select>
</label>
<label class="mt-4 block text-sm text-slate-300">Legal name
    <input name="legal_name" value="{{ old('legal_name', $business->legal_name) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
</label>
<label class="mt-4 block text-sm text-slate-300">Trade name
    <input name="trade_name" value="{{ old('trade_name', $business->trade_name) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
</label>
<label class="mt-4 block text-sm text-slate-300">Status
    <select name="status" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
        @foreach($statuses as $status)
            <option value="{{ $status }}" @selected(old('status', $business->status) === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
</label>
<div class="mt-4 grid gap-4 md:grid-cols-2">
    <label class="block text-sm text-slate-300">Contact email
        <input name="contact_email" type="email" value="{{ old('contact_email', $business->contact_email) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
    </label>
    <label class="block text-sm text-slate-300">Contact phone
        <input name="contact_phone" value="{{ old('contact_phone', $business->contact_phone) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
    </label>
</div>
<button class="mt-6 rounded-xl bg-emerald-400 px-5 py-3 font-bold text-slate-950">Save business</button>
