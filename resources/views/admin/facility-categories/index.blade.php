<x-layouts.app title="Facility Categories — Admin">
    <div class="flex items-center justify-between">
        <h1 class="text-4xl font-black">Facility Categories</h1>
        <a href="{{ route('admin.facility-categories.create') }}" class="rounded-full bg-emerald-400 px-5 py-3 font-bold text-slate-950">New category</a>
    </div>
    @if(session('status'))<p class="mt-4 rounded-xl bg-emerald-400/10 p-4 text-emerald-200">{{ session('status') }}</p>@endif
    <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
        @foreach($categories as $category)
            <div class="flex items-center justify-between border-b border-white/10 p-4 last:border-0">
                <div><p class="font-bold">{{ $category->name }}</p><p class="text-sm text-slate-400">{{ $category->is_active ? 'Active' : 'Inactive' }} · Sort {{ $category->sort_order }}</p></div>
                <a href="{{ route('admin.facility-categories.edit', $category) }}" class="text-emerald-300">Edit</a>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $categories->links() }}</div>
</x-layouts.app>
