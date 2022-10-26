@extends('layouts.master' , ['isDarkTheme' => 'true'])

@section('content')


<div class=" px-8  relative text-white z-40 mx-auto items-center text-center justify-center text-[1.5rem] flex w-screen h-screen ">
    <div>
        <div class="text-3xl font-victorianna-thin  tracking-wider">
            @yield('code')
        </div>

        <div class=" text-lg uppercase tracking-wider">
            @yield('message')
        </div>

        <div class=" max-w-xl mt-8">
            {{ __('errors.404.1') }}
            <a data-hover href="/" data-hover>home page</a>

        </div>
    </div>


</div>


@stop