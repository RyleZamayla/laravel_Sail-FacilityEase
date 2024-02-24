<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 hover:outline-none hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
