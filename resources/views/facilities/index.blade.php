<x-layouts.app title="Facilities — RoamFit">
    <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
        <div>
            <p class="text-emerald-300">Discover</p>
            <h1 class="text-4xl font-black">Facilities</h1>
        </div>
        <form class="flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Search gyms" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-white">
            <button class="rounded-xl bg-emerald-400 px-4 py-2 font-bold text-slate-950">Search</button>
        </form>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        @foreach($facilities as $facility)
            <a href="{{ route('facilities.show', $facility) }}" class="rounded-2xl border border-white/10 bg-white/5 p-5 hover:border-emerald-300/60">
                <h2 class="text-xl font-bold">{{ $facility->name }}</h2>
                <p class="mt-2 text-slate-300">{{ $facility->city }}, {{ $facility->province }}</p>
                <p class="mt-4 text-sm text-slate-400">{{ $facility->categories->pluck('name')->join(', ') ?: 'Fitness facility' }}</p>
                <p class="mt-4 text-emerald-300">{{ $facility->credit_cost }} credits</p>
            </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $facilities->links() }}</div>
</x-layouts.app>
