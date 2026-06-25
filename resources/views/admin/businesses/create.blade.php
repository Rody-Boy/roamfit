<x-layouts.app title="New Business — Admin">
    <h1 class="text-4xl font-black">New business</h1>
    <form method="POST" action="{{ route('admin.businesses.store') }}" class="mt-6 max-w-3xl rounded-3xl border border-white/10 bg-white/5 p-8">
        @include('admin.businesses._form')
    </form>
</x-layouts.app>
