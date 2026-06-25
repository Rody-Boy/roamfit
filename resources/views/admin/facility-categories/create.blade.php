<x-layouts.app title="New Category — Admin">
    <h1 class="text-4xl font-black">New category</h1>
    <form method="POST" action="{{ route('admin.facility-categories.store') }}" class="mt-6 max-w-2xl rounded-3xl border border-white/10 bg-white/5 p-8">
        @include('admin.facility-categories._form')
    </form>
</x-layouts.app>
