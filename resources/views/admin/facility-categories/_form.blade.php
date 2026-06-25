@csrf
<label class="block text-sm text-slate-300">Name
    <input name="name" value="{{ old('name', $category->name) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required>
</label>
<label class="mt-4 block text-sm text-slate-300">Description
    <textarea name="description" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">{{ old('description', $category->description) }}</textarea>
</label>
<label class="mt-4 block text-sm text-slate-300">Sort order
    <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white">
</label>
<label class="mt-4 flex items-center gap-3 text-sm text-slate-300">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $category->is_active ?? true))>
    Active
</label>
<button class="mt-6 rounded-xl bg-emerald-400 px-5 py-3 font-bold text-slate-950">Save category</button>
