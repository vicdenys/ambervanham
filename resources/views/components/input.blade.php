@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block font-light text-black w-full placeholder-black text-xl border-t-0 border-x-0 border-b border-b-black  bg-transparent  focus:border-b-4  focus:ring focus:ring-0 focus:border-b focus:border-b-black']) !!}>
