<x-layouts.app title="New Facility — Admin">
    <h1 class="text-4xl font-black">New facility</h1>
    <form method="POST" action="{{ route('admin.facilities.store') }}" class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-8">
        @include('admin.facilities._form')
    </form>
</x-layouts.app>
