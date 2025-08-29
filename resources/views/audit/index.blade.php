<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <h2 class="font-bold text-xl sm:text-2xl text-gray-800 dark:text-gray-100">
                📊 Audit Logs
            </h2>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Track all changes and activities
            </div>
        </div>
    </x-slot>

    <div class="py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-xs sm:text-sm font-medium">Total Logs</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ $auditLogs->total() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-blue-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-xs sm:text-sm font-medium">Today's Activity</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ $auditLogs->where('created_at', '>=', now()->startOfDay())->count() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-green-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-xs sm:text-sm font-medium">This Week</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ $auditLogs->where('created_at', '>=', now()->startOfWeek())->count() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-purple-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Logs Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-0">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100">
                            📋 Activity Log ({{ $auditLogs->total() }} entries)
                        </h3>
                        <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ $auditLogs->firstItem() ?? 0 }} to {{ $auditLogs->lastItem() ?? 0 }} of {{ $auditLogs->total() }}
                        </div>
                    </div>
                </div>

                <!-- Mobile Audit Log Cards -->
                <div class="block sm:hidden">
                    @forelse($auditLogs as $log)
                        <div class="border-b border-gray-200 dark:border-gray-700 p-4">
                            <div class="space-y-3">
                                <!-- Admin Info -->
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $log->admin?->name ?? 'System' }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $log->admin?->email ?? 'system@example.com' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action & Model -->
                                <div class="flex flex-wrap gap-2">
                                    @if($log->action === 'created')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Created
                                        </span>
                                    @elseif($log->action === 'updated')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Updated
                                        </span>
                                    @elseif($log->action === 'deleted')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Deleted
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ ucfirst($log->action) }}
                                        </span>
                                    @endif
                                    
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 font-mono">
                                        {{ class_basename($log->model_changed) }}
                                    </span>
                                </div>
                                
                                <!-- Changes -->
                                @if($log->changes && is_array($log->changes))
                                    <div class="text-xs space-y-2 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                        @if(isset($log->changes['before']) && isset($log->changes['after']))
                                            <div class="text-gray-600 dark:text-gray-400">
                                                <span class="font-medium">Before:</span> 
                                                <span class="break-all">{{ Str::limit(json_encode($log->changes['before']), 100) }}</span>
                                            </div>
                                            <div class="text-gray-600 dark:text-gray-400">
                                                <span class="font-medium">After:</span> 
                                                <span class="break-all">{{ Str::limit(json_encode($log->changes['after']), 100) }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400 break-all">
                                                {{ Str::limit(json_encode($log->changes), 120) }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                
                                <!-- Timestamp -->
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    <div class="font-medium">{{ $log->created_at->format('M d, Y H:i:s') }}</div>
                                    <div class="text-gray-400">{{ $log->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <div class="text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-base sm:text-lg font-medium">No audit logs found</p>
                                <p class="text-xs sm:text-sm">Activity will appear here as you manage products and categories</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Desktop Table -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-purple-700 dark:text-purple-300 uppercase tracking-wider">Admin</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-purple-700 dark:text-purple-300 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-purple-700 dark:text-purple-300 uppercase tracking-wider">Model</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-purple-700 dark:text-purple-300 uppercase tracking-wider">Changes</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-purple-700 dark:text-purple-300 uppercase tracking-wider">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($auditLogs as $log)
                                <tr class="hover:bg-purple-50/50 dark:hover:bg-purple-900/10 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $log->admin?->name ?? 'System' }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $log->admin?->email ?? 'system@example.com' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($log->action === 'created')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Created
                                            </span>
                                        @elseif($log->action === 'updated')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Updated
                                            </span>
                                        @elseif($log->action === 'deleted')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Deleted
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                {{ ucfirst($log->action) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 font-mono">
                                            {{ class_basename($log->model_changed) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            @if($log->changes && is_array($log->changes))
                                                @if(isset($log->changes['before']) && isset($log->changes['after']))
                                                    <div class="text-xs space-y-1">
                                                        <div class="text-gray-600 dark:text-gray-400">
                                                            <span class="font-medium">Before:</span> 
                                                            {{ Str::limit(json_encode($log->changes['before']), 50) }}
                                                        </div>
                                                        <div class="text-gray-600 dark:text-gray-400">
                                                            <span class="font-medium">After:</span> 
                                                            {{ Str::limit(json_encode($log->changes['after']), 50) }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ Str::limit(json_encode($log->changes), 80) }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-gray-500">No changes recorded</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $log->created_at->format('M d, Y') }}</span>
                                            <span class="text-xs">{{ $log->created_at->format('H:i:s') }}</span>
                                            <span class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-500 dark:text-gray-400">
                                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-lg font-medium">No audit logs found</p>
                                            <p class="text-sm">Activity will appear here as you manage products and categories</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($auditLogs->hasPages())
                    <div class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $auditLogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>



