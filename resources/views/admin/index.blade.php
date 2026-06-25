<x-layouts.app title="Admin — RoamFit">
    <h1 class="text-4xl font-black">RoamFit Admin</h1>
    <p class="mt-4 text-slate-300">Manage the MVP marketplace supply and configuration.</p>

    <div class="mt-8 grid gap-4 md:grid-cols-3">
        <a href="{{ route('admin.businesses.index') }}" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-300/60">
            <h2 class="text-xl font-bold">Businesses</h2>
            <p class="mt-2 text-slate-300">Approve and manage partner businesses.</p>
        </a>
        <a href="{{ route('admin.facilities.index') }}" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-300/60">
            <h2 class="text-xl font-bold">Facilities</h2>
            <p class="mt-2 text-slate-300">Create listings and set credit costs.</p>
        </a>
        <a href="{{ route('admin.facility-categories.index') }}" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-300/60">
            <h2 class="text-xl font-bold">Categories</h2>
            <p class="mt-2 text-slate-300">Configure facility types without code changes.</p>
        </a>
    </div>
</x-layouts.app>
