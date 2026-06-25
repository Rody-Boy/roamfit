<x-layouts.app title="RoamFit — Train Anywhere in the Philippines">
    <section class="py-12">
        <p class="text-sm uppercase tracking-[0.35em] text-emerald-300">RoamFit Philippines</p>
        <h1 class="mt-6 max-w-4xl text-5xl font-black tracking-tight md:text-7xl">Train Anywhere in the Philippines.</h1>
        <p class="mt-6 max-w-2xl text-lg text-slate-300">A simple credit-based marketplace connecting members with independent gyms and fitness facilities.</p>
        <div class="mt-8 flex gap-4">
            <a href="{{ route('facilities.index') }}" class="rounded-full bg-emerald-400 px-6 py-3 font-bold text-slate-950">Browse facilities</a>
            <a href="{{ route('register') }}" class="rounded-full border border-white/20 px-6 py-3 font-bold">Create account</a>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-3">
        @forelse($featuredFacilities as $facility)
            <a href="{{ route('facilities.show', $facility) }}" class="rounded-2xl border border-white/10 bg-white/5 p-5 hover:border-emerald-300/60">
                <h2 class="text-xl font-bold">{{ $facility->name }}</h2>
                <p class="mt-2 text-slate-300">{{ $facility->city }}, {{ $facility->province }}</p>
                <p class="mt-4 text-emerald-300">{{ $facility->credit_cost }} credits</p>
            </a>
        @empty
            <div class="rounded-2xl border border-dashed border-white/20 p-6 text-slate-300 md:col-span-3">No facilities yet. Seed or create launch facilities in Phase 1.</div>
        @endforelse
    </section>
</x-layouts.app>
