<x-layouts.app title="{{ $facility->name }} — RoamFit">
    <article class="rounded-3xl border border-white/10 bg-white/5 p-8">
        <p class="text-emerald-300">{{ $facility->city }}, {{ $facility->province }}</p>
        <h1 class="mt-2 text-5xl font-black">{{ $facility->name }}</h1>
        <p class="mt-5 max-w-3xl text-slate-300">{{ $facility->description ?: 'Partner fitness facility on RoamFit.' }}</p>
        <dl class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl bg-slate-900 p-5"><dt class="text-slate-400">Credit cost</dt><dd class="text-2xl font-bold text-emerald-300">{{ $facility->credit_cost }}</dd></div>
            <div class="rounded-2xl bg-slate-900 p-5"><dt class="text-slate-400">Capacity</dt><dd class="text-2xl font-bold">{{ $facility->capacity ?: 'TBD' }}</dd></div>
            <div class="rounded-2xl bg-slate-900 p-5"><dt class="text-slate-400">Status</dt><dd class="text-2xl font-bold">{{ ucfirst($facility->status) }}</dd></div>
        </dl>
        @auth
            <button class="mt-8 rounded-full bg-emerald-400 px-6 py-3 font-bold text-slate-950">Check-in flow starts in Phase 3</button>
        @else
            <a href="{{ route('login') }}" class="mt-8 inline-block rounded-full bg-emerald-400 px-6 py-3 font-bold text-slate-950">Login to check in</a>
        @endauth
    </article>
</x-layouts.app>
