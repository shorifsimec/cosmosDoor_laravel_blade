@php
$menuItems = [
[
'label' => 'Dashboard',
'route' => 'dashboard',
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
],

[
'label' => 'Customers',
'route' => 'customers.index',
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />',
'children' => [
['label' => 'All Customers', 'route' => 'customers.index'],
],
],

[
'label' => 'Categories',
'route' => 'categories.index',
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />',
'children' => [
['label' => 'All Categories', 'route' => 'categories.index'],
],
],

[
'label' => 'Brands',
'route' => 'brands.index',
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
],

];
@endphp

<aside
  :class="{
        'w-64': sidebarOpen,
        'w-20': !sidebarOpen && window.innerWidth > 1024,
        '-translate-x-full': !sidebarOpen && window.innerWidth < 1024,
        'translate-x-0': sidebarOpen,
        'w-64 mobile-open': sidebarOpen && window.innerWidth < 1024
    }"
  class="bg-slate-800 text-slate-200 min-h-screen fixed transform transition-all duration-300 z-50 overflow-x-hidden shadow-2xl lg:shadow-none">

  <div
    class="p-6 text-xl font-bold border-b border-slate-700 whitespace-nowrap overflow-hidden flex justify-between items-center">
    <div>
      <span x-show="sidebarOpen || window.innerWidth < 1024" x-transition>Admin Panel</span>
      <span x-show="!sidebarOpen && window.innerWidth > 1024" x-transition>AP</span>
    </div>

    <!-- Close button for mobile -->
    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <nav class="p-4 space-y-2">

    @foreach ($menuItems as $item)
    @php
    $isActive =
    request()->routeIs($item['route'] ?? '') ||
    collect($item['children'] ?? [])
    ->pluck('route')
    ->contains(fn($r) => request()->routeIs($r));
    $slug = \Illuminate\Support\Str::slug($item['label']);
    @endphp

    @if (!empty($item['children']))
    <div x-data="{ open: {{ $isActive ? 'true' : 'false' }} }">

      <button @click="open = !open"
        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-slate-700 {{ $isActive ? 'bg-slate-700' : '' }}">
        <div class="flex items-center space-x-3">
          <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            {!! $item['icon'] !!}
          </svg>
          <span x-show="sidebarOpen || window.innerWidth < 1024"
            class="transition-opacity duration-300">{{ $item['label'] }}</span>
        </div>

        <svg x-show="sidebarOpen || window.innerWidth < 1024"
          class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''"
          fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div x-show="open && (sidebarOpen || window.innerWidth < 1024)" x-transition
        class="ml-9 mt-2 space-y-1">
        @foreach ($item['children'] as $child)
        <a href="{{ route($child['route']) }}"
          class="block px-3 py-2 rounded text-sm hover:bg-slate-700
{{ request()->routeIs($child['route']) ? 'bg-slate-700 font-semibold' : '' }}">
          {{ $child['label'] }}
        </a>
        @endforeach
      </div>
    </div>
    @else
    <a href="{{ route($item['route']) }}"
      class="flex items-center space-x-3 px-3 py-2 rounded hover:bg-slate-700
{{ $isActive ? 'bg-slate-700 font-semibold' : '' }}">
      <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        {!! $item['icon'] !!}
      </svg>
      <span x-show="sidebarOpen || window.innerWidth < 1024"
        class="transition-opacity duration-300">{{ $item['label'] }}</span>
    </a>
    @endif
    @endforeach

  </nav>
</aside>