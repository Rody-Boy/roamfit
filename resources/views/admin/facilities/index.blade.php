<x-layouts.app title="Facilities — Admin">
    <div class="flex items-center justify-between">
        <h1 class="text-4xl font-black">Facilities</h1>
        <a href="{{ route('admin.facilities.create') }}" class="rounded-full bg-emerald-400 px-5 py-3 font-bold text-slate-950">New facility</a>
    </div>
    @if(session('status'))<p class="mt-4 rounded-xl bg-emerald-400/10 p-4 text-emerald-200">{{ session('status') }}</p>@endif
    <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
        @foreach($facilities as $facility)
            <div class="flex items-center justify-between border-b border-white/10 p-4 last:border-0">
                <div>
                    <p class="font-bold">{{ $facility->name }}</p>
                    <p class="text-sm text-slate-400">{{ ucfirst($facility->status) }} · {{ $facility->business?->trade_name }} · {{ $facility->city }}, {{ $facility->province }} · {{ $facility->credit_cost }} credits</p>
                    <p class="mt-1 text-xs text-slate-500">{{ $facility->categories->pluck('name')->join(', ') ?: 'No categories' }}</p>
                </div>
                <a href="{{ route('admin.facilities.edit', $facility) }}" class="text-emerald-300">Edit</a>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $facilities->links() }}</div>
</x-layouts.app>
