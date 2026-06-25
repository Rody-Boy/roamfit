<x-layouts.app title="Dashboard — RoamFit">
    <h1 class="text-4xl font-black">Dashboard</h1>
    <div class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-8">
        <p class="text-slate-300">Current credit balance</p>
        <p class="text-6xl font-black text-emerald-300">{{ $creditBalance }}</p>
    </div>
    <section class="mt-8">
        <h2 class="text-2xl font-bold">Recent ledger</h2>
        <div class="mt-4 overflow-hidden rounded-2xl border border-white/10">
            @forelse($ledgerEntries as $entry)
                <div class="flex justify-between border-b border-white/10 p-4 last:border-0"><span>{{ $entry->reason }}</span><span>{{ $entry->delta }}</span></div>
            @empty
                <p class="p-4 text-slate-300">No credit activity yet.</p>
            @endforelse
        </div>
    </section>
</x-layouts.app>
