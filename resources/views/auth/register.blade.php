<x-layouts.app title="Join RoamFit">
    <form method="POST" action="{{ route('register') }}" class="mx-auto max-w-md rounded-3xl border border-white/10 bg-white/5 p-8">
        @csrf
        <h1 class="mb-6 text-3xl font-black">Create your account</h1>
        <label class="block text-sm text-slate-300">Name<input name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required></label>
        <label class="mt-4 block text-sm text-slate-300">Email<input name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required></label>
        <label class="mt-4 block text-sm text-slate-300">Password<input name="password" type="password" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required></label>
        <label class="mt-4 block text-sm text-slate-300">Confirm password<input name="password_confirmation" type="password" class="mt-1 w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white" required></label>
        <button class="mt-6 w-full rounded-xl bg-emerald-400 px-4 py-3 font-bold text-slate-950">Join RoamFit</button>
    </form>
</x-layouts.app>
