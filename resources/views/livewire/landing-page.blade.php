<div class="flex flex-col bg-indigo-900 w-full h-screen" x-data="{ showSubscribe: @entangle('showSubscribe'), showSuccess: @entangle('showSuccess') }">
    <nav class="flex pt-5 justify-between container mx-auto text-indigo-200">
        <a href="/">
            <x-application-logo></x-application-logo>
        </a>

        <div class="flex justify-end">
            @auth
                <a href="{{route('dashboard')}}">Dashboard</a>
            @else
                <a href="{{route('login')}}">Login</a>
            @endauth
        </div>
    </nav>
    <div class="flex container mx-auto items-center h-full">
        <div class="flex flex-col w-1/3 items-start">
            <h1 class="text-white font-bold text-5xl leading-tight mb-4">This is a simple landing page.</h1>
            <p class="text-indigo-200 text-xl mb-10">We are just checking out the Tall Stack!</p>
            <x-button class="py-3 px-8 bg-red-500 hover:bg-red-600" x-on:click="showSubscribe = true">Subscribe</x-button>
        </div>
    </div>
    <x-modal class="bg-pink-500" trigger="showSubscribe">
        <p class="text-white text-5xl font-extrabold text-center">Let's do it.</p>
        <form class="flex flex-col items-center p-24" wire:submit.prevent="Subscribe">
            <x-input wire:model.defer="email" type="email" name="email" placeholder="Email Address" class="px-5 py-3 w-80 border border-indigo-400"></x-input>
            <span class="my-1 text-white">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                <span class="animate-spin" wire:loading wire:target="Subscribe">&#9696;</span>
                <span wire:loading.remove wire:target="Subscribe">Sign Up</span>
            </x-button>
        </form>
    </x-modal>
    <x-modal class="bg-green-500 w-1/3" trigger="showSuccess">
        <p class="animate-pulse text-white text-9xl font-extrabold text-center">&check;</p>
        <p class="text-white text-5xl font-extrabold text-center mt-16">Success!</p>
        @if (request()->has('verified') && request()->verified == 1)
            <p class="text-white text-3xl text-center mt-2">Thank you for confirming your email address.</p>
        @else
            <p class="text-white text-3xl text-center mt-2">Please check your inbox to confirm your email address.</p>
        @endif
    </x-modal>
</div>
