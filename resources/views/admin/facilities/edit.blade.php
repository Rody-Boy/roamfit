<x-layouts.app title="Edit Facility — Admin">
    <h1 class="text-4xl font-black">Edit facility</h1>
    <form method="POST" action="{{ route('admin.facilities.update', $facility) }}" class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-8">
        @method('PUT')
        @include('admin.facilities._form')
    </form>
</x-layouts.app>
