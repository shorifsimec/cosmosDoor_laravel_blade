<header class="bg-white shadow h-16 flex items-center justify-between px-6">

  <div class="flex items-center space-x-4">
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none hover:text-gray-900">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <h1 class="text-lg font-semibold text-gray-700">
      Laravel Dashboard
    </h1>
  </div>

  <div class="relative">
    <span class="text-gray-600 mr-4">
      {{ auth()->user()->name ?? 'User' }}
    </span>

    <form method="POST" action="{{ route('logout') }}" class="inline">
      @csrf
      <button class="text-red-500 hover:underline text-sm">
        Logout
      </button>
    </form>
  </div>

</header>