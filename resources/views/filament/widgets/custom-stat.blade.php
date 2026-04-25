<div class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
    <div class="flex items-start justify-between">
        <div class="space-y-2">
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                {{ $getLabel() }}
            </span>

            <div class="text-3xl pt-2 font-bold tracking-tight text-gray-950 dark:text-white">
                {{ $getValue() }}
            </div>
        </div>

        @php
            $extraAttributes = $getExtraAttributes();
            $iconColor = $extraAttributes['iconColor'] ?? 'text-gray-600';
            $iconBg = $extraAttributes['iconBg'] ?? 'bg-gray-100/50';
        @endphp

        @if ($icon = $getIcon())
            <div class="rounded-2xl p-2 {{ $iconBg }}">
                <x-filament::icon
                    :icon="$icon"
                    class="h-8 w-8 {{ $iconColor }}"
                />
            </div>
        @endif
    </div>

    @if ($description = $getDescription())
        <div class="mt-4 flex items-center gap-x-1">
            @if ($descriptionIcon = $getDescriptionIcon())
                <x-filament::icon
                    :icon="$descriptionIcon"
                    class="h-4 w-4 {{ $getDescriptionColor() === 'success' ? 'text-emerald-500' : 'text-danger-500' }}"
                />
            @endif
            
            <span>
                {{ $description }} 
            </span>
            
            <!-- <span class="text-xs text-gray-500">
                Up from yesterday
            </span> -->
        </div>
    @endif
</div>