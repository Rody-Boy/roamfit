<!doctype html>
<html lang="en-PH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'RoamFit' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <header class="border-b border-white/10 bg-slate-950/90">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ route('home') }}" class="text-xl font-bold text-emerald-300">RoamFit</a>
            <div class="flex items-center gap-4 text-sm text-slate-200">
                <a href="{{ route('facilities.index') }}" class="hover:text-emerald-300">Facilities</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-emerald-300">Dashboard</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.index') }}" class="hover:text-emerald-300">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="hover:text-emerald-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-emerald-300">Login</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-emerald-400 px-4 py-2 font-semibold text-slate-950">Join</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-10">
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-400/40 bg-red-500/10 p-4 text-red-100">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>
