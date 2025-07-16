<!-- Settings Dropdown -->


<x-slot name="content">
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                                                this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</x-slot>
</x-dropdown>
</div>



<!-- Responsive Settings Options -->
<div class="pt-4 pb-1 border-t border-gray-200">
    <div class="px-4">
        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
    </div>

    <div class="mt-3 space-y-1">
        <!-- Authentication  esto sirve para el logout que lo maneja laravel -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</div>
</div>
</nav>
