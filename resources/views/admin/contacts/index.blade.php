@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <h1 class="text-2xl sm:text-3xl font-premium font-bold text-zinc-900 tracking-wide">Contacts</h1>
    {{-- No Add Button --}}
</div>

<div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-x-auto animate-enter p-4">
    <table id="contactsTable" class="w-full text-left border-collapse stripe hover">
        <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
            <tr>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">ID</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Name</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Email</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Phone</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Message</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-100 text-sm">
            @foreach($contacts as $contact)
            <tr class="group hover:bg-amber-50/50 transition-colors">
                <td class="p-4 text-zinc-500">#{{ $contact->id }}</td>
                <td class="p-4 font-bold text-zinc-800">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td class="p-4 text-zinc-600">{{ $contact->email }}</td>
                <td class="p-4 text-zinc-600">
                    @if($contact->phone_number)
                    {{ $contact->phone_code }} {{ $contact->phone_number }}
                    @else
                    -
                    @endif
                </td>
                <td class="p-4 text-zinc-600 max-w-xs truncate" title="{{ $contact->message }}">
                    {{ Str::limit($contact->message, 50) }}
                </td>
                <td class="p-4 text-zinc-500">{{ $contact->created_at->format('M d, Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contactsTable').DataTable({
            responsive: true,
            autoWidth: false,
            order: [
                [0, 'desc']
            ], // Sort by ID descending
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Contacts...",
                lengthMenu: "Show _MENU_ entries"
            }
        });
    });
</script>
@endpush

@endsection