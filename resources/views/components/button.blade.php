@php
    $attributes['color'] ? $color = $attributes['color'] : $color = 'white';
    $attributes['negative-color'] ? $negativeColor = $attributes['negative-color'] : $negativeColor = 'green';
@endphp

<button aria-label="{{ $slot }}"  {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex font-light items-center px-4 py-2 lowercase border  hover:shadow-lg hover:scale-105 focus:shadow-lg focus:scale-105 shadow-gray-900  focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150 hover:bg-' . $negativeColor . ' focus:bg-' .$negativeColor . ' active:bg-' .$negativeColor . '  hover:text-' .$color . ' focus:text-' .$color . ' active:text-' .$color . '  text-' .$negativeColor . ' border-' .$negativeColor .' hover:text-' .$color ]) }}>
    {{ $slot  }}
</button>
