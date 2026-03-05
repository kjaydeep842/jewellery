<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center justify-between">
            <span>👋 Welcome back, {{ Auth::user()->name }}!</span>
            <span class="text-sm text-gray-500">Last login: {{ now()->subDays(2)->format('d M Y') }}</span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">Total Orders</h3>
                    <p class="text-4xl font-bold mt-2">12</p>
                    <p class="text-sm mt-1 opacity-90">All-time orders placed</p>
                </div>

                <div class="bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">Wishlist Items</h3>
                    <p class="text-4xl font-bold mt-2">8</p>
                    <p class="text-sm mt-1 opacity-90">Products you love 💖</p>
                </div>

                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">Account Balance</h3>
                    <p class="text-4xl font-bold mt-2">₹2,350</p>
                    <p class="text-sm mt-1 opacity-90">Available for use</p>
                </div>
            </div>

            {{-- Orders Chart --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">📈 Orders Overview</h3>
                <canvas id="ordersChart" height="120"></canvas>
            </div>

            {{-- My Orders Table --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">🛍️ My Recent Orders</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800">#1045</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Nov 13, 2025</td>
                            <td class="px-6 py-4 text-sm text-gray-700">₹3,999</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800">#1042</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Nov 10, 2025</td>
                            <td class="px-6 py-4 text-sm text-gray-700">₹1,499</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Profile Info --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">👤 My Profile</h3>
                <div class="flex flex-col md:flex-row md:justify-between">
                    <div>
                        <p><span class="font-semibold">Name:</span> {{ Auth::user()->name }}</p>
                        <p><span class="font-semibold">Email:</span> {{ Auth::user()->email }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js Script --}}
 
</x-app-layout>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('ordersChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
                datasets: [{
                    label: 'Orders per Month',
                    data: [2, 5, 3, 6, 4, 7, 8],
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#4F46E5'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }
});
</script>
@endpush
