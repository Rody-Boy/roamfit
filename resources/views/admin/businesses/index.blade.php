<x-layouts.app title="Businesses — Admin">
    <div class="flex items-center justify-between">
        <h1 class="text-4xl font-black">Businesses</h1>
        <a href="{{ route('admin.businesses.create') }}" class="rounded-full bg-emerald-400 px-5 py-3 font-bold text-slate-950">New business</a>
    </div>
    @if(session('status'))<p class="mt-4 rounded-xl bg-emerald-400/10 p-4 text-emerald-200">{{ session('status') }}</p>@endif
    <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
        @foreach($businesses as $business)
            <div class="flex items-center justify-between border-b border-white/10 p-4 last:border-0">
                <div><p class="font-bold">{{ $business->trade_name }}</p><p class="text-sm text-slate-400">{{ ucfirst($business->status) }} · {{ $business->owner?->email ?: 'No owner' }}</p></div>
                <a href="{{ route('admin.businesses.edit', $business) }}" class="text-emerald-300">Edit</a>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $businesses->links() }}</div>
</x-layouts.app>
