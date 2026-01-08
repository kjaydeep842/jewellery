@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-zinc-800">Overview</h2>
                <p class="text-zinc-500 mt-1">Here's what's happening with your store today.</p>
            </div>
            <div class="flex space-x-3">
                <button
                    class="px-4 py-2 bg-white border border-zinc-200 rounded-lg text-zinc-600 hover:bg-zinc-50 transition-colors shadow-sm font-medium">Download
                    Report</button>
                <button
                    class="px-4 py-2 bg-zinc-900 text-amber-400 rounded-lg hover:bg-zinc-800 transition-all shadow-md font-medium border border-zinc-700">Add
                    Product</button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Revenue (Gold/Citrine) -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-amber-100 p-6 relative overflow-hidden group hover:shadow-lg transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">+12.5%</span>
                </div>
                <h3 class="text-3xl font-bold text-zinc-800">$24,500</h3>
                <p class="text-zinc-500 text-sm font-medium mt-1">Total Revenue</p>
                <div class="h-1 w-full bg-amber-100 rounded-full mt-4">
                    <div class="h-1 bg-gradient-to-r from-amber-400 to-yellow-500 rounded-full" style="width: 70%"></div>
                </div>
            </div>

            <!-- Card 2: Orders (Sapphire/Blue) -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6 relative overflow-hidden group hover:shadow-lg transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                        </path>
                    </svg>
                </div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">+4.2%</span>
                </div>
                <h3 class="text-3xl font-bold text-zinc-800">156</h3>
                <p class="text-zinc-500 text-sm font-medium mt-1">Active Orders</p>
                <div class="h-1 w-full bg-blue-100 rounded-full mt-4">
                    <div class="h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full" style="width: 45%"></div>
                </div>
            </div>

            <!-- Card 3: Customers (Emerald/Green) -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6 relative overflow-hidden group hover:shadow-lg transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">+8.1%</span>
                </div>
                <h3 class="text-3xl font-bold text-zinc-800">2,450</h3>
                <p class="text-zinc-500 text-sm font-medium mt-1">Total Customers</p>
                <div class="h-1 w-full bg-emerald-100 rounded-full mt-4">
                    <div class="h-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full" style="width: 80%"></div>
                </div>
            </div>

            <!-- Card 4: Low Stock (Ruby/Red) -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-red-100 p-6 relative overflow-hidden group hover:shadow-lg transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-rose-50 rounded-xl text-rose-600 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-rose-600 bg-rose-100 px-2.5 py-1 rounded-full">-1.5%</span>
                </div>
                <h3 class="text-3xl font-bold text-zinc-800">45</h3>
                <p class="text-zinc-500 text-sm font-medium mt-1">Low Stock Items</p>
                <div class="h-1 w-full bg-rose-100 rounded-full mt-4">
                    <div class="h-1 bg-gradient-to-r from-rose-500 to-red-600 rounded-full" style="width: 25%"></div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 p-6">
            <h3 class="text-lg font-bold text-zinc-800 mb-4">Recent Orders</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-600">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase font-semibold text-xs">
                        <tr>
                            <th class="px-4 py-3 rounded-l-lg">Order ID</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 rounded-r-lg">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-4 py-3 font-medium text-amber-600">#ORD-001</td>
                            <td class="px-4 py-3 font-medium text-zinc-900">Sarah Connor</td>
                            <td class="px-4 py-3">Diamond Ring</td>
                            <td class="px-4 py-3"><span
                                    class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Completed</span>
                            </td>
                            <td class="px-4 py-3">$1,200</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-4 py-3 font-medium text-amber-600">#ORD-002</td>
                            <td class="px-4 py-3 font-medium text-zinc-900">John Wick</td>
                            <td class="px-4 py-3">Gold Necklace</td>
                            <td class="px-4 py-3"><span
                                    class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">Pending</span>
                            </td>
                            <td class="px-4 py-3">$850</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-4 py-3 font-medium text-amber-600">#ORD-003</td>
                            <td class="px-4 py-3 font-medium text-zinc-900">Ellen Ripley</td>
                            <td class="px-4 py-3">Silver Bracelet</td>
                            <td class="px-4 py-3"><span
                                    class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Shipped</span>
                            </td>
                            <td class="px-4 py-3">$320</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection