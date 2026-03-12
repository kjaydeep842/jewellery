@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <h1 class="text-2xl sm:text-3xl font-premium font-bold text-zinc-900 tracking-wide">Products</h1>

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.products.import') }}" class="flex items-center space-x-2 px-6 py-2.5 bg-zinc-800 text-white hover:bg-zinc-900 rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            <span>Bulk Import</span>
        </a>
        <a href="{{ route('admin.products.create') }}"
            class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
            <span class="text-xl">+</span>
            <span>Add Product</span>
        </a>
    </div>
</div>

@if(session('success'))
<div class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('import_stats'))
<div class="mb-6 bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-100">
        <h3 class="text-lg font-bold text-zinc-900">Import Summary</h3>
    </div>
    <div class="p-6">
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg font-bold border border-blue-200 shadow-sm">Scanned: {{ session('import_stats')['total'] }}</div>
            <div class="px-4 py-2 bg-emerald-50 text-emerald-800 rounded-lg font-bold border border-emerald-200 shadow-sm">Imported: {{ session('import_stats')['success'] }}</div>
            <div class="px-4 py-2 bg-red-50 text-red-800 rounded-lg font-bold border border-red-200 shadow-sm">Failed: {{ session('import_stats')['failed'] }}</div>
        </div>
        @if(session('import_errors') && count(session('import_errors')) > 0)
        <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100 max-h-48 overflow-y-auto w-full">
            <h4 class="font-bold mb-2">Errors Details:</h4>
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach(session('import_errors') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endif

<div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-x-auto animate-enter p-4">
    <table id="productsTable" class="w-full text-left border-collapse stripe hover">
        <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
            <tr>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Image</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Name</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">SKU</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Category</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Brand</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Stock</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Price</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Status</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-100 text-sm">
            @foreach($products as $product)
            <tr class="group hover:bg-amber-50/50 transition-colors">
                <td class="p-4">
                    @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                        class="w-12 h-12 rounded-lg object-cover border border-zinc-200">
                    @else
                    <div
                        class="w-12 h-12 bg-zinc-100 rounded-lg flex items-center justify-center text-zinc-400 text-xs">
                        No Img</div>
                    @endif
                </td>
                <td class="p-4 font-bold text-zinc-800">
                    {{ $product->name }}
                    @if($product->is_featured)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 ml-1">
                        Featured
                    </span>
                    @endif
                </td>
                <td class="p-4 text-zinc-600">{{ $product->sku }}</td>
                <td class="p-4 text-zinc-600">{{ $product->category?->name ?? 'No Category' }}</td>
                <td class="p-4 text-zinc-600">{{ $product->brand?->name ?? '-' }}</td>
                <td class="p-4 text-zinc-600">
                    {{ $product->variants->count() > 0 ? $product->variants->sum('stock_quantity') : $product->stock }}
                </td>
                <td class="p-4 font-bold text-zinc-900">₹{{ number_format($product->price, 2) }}</td>
                <td class="p-4">
                    @if($product->status == 'active')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                    @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Inactive
                    </span>
                    @endif
                </td>
                <td class="p-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm"
                            title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="p-2 bg-white border border-zinc-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm"
                                title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="p-4 border-t border-zinc-100 bg-zinc-50">
    {{ $products->links() }}
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search products...",
                lengthMenu: "Show _MENU_ entries"
            },
            columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                } // Disable sorting on Image and Actions
            ]
        });
    });
</script>
@endpush

@endsection