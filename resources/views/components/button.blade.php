
<button {{ $attributes->merge(['class' => 'px-6 py-3 rounded-full text-sm md:text-lg font-semibold transition-all duration-300']) }}
    style="background-color: {{ $bg }}; color: {{ $color }}">
    {{ $slot }}
</button>
