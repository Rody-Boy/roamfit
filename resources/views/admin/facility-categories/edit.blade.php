<x-layouts.app title="Edit Category — Admin">
    <h1 class="text-4xl font-black">Edit category</h1>
    <form method="POST" action="{{ route('admin.facility-categories.update', $category) }}" class="mt-6 max-w-2xl rounded-3xl border border-white/10 bg-white/5 p-8">
        @method('PUT')
        @include('admin.facility-categories._form')
    </form>
</x-layouts.app>
