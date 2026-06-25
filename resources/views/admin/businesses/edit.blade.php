<x-layouts.app title="Edit Business — Admin">
    <h1 class="text-4xl font-black">Edit business</h1>
    <form method="POST" action="{{ route('admin.businesses.update', $business) }}" class="mt-6 max-w-3xl rounded-3xl border border-white/10 bg-white/5 p-8">
        @method('PUT')
        @include('admin.businesses._form')
    </form>
</x-layouts.app>
