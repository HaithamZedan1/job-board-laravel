<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign up
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{route('auth.store_new')}}" method="post">
        @csrf
        <div class="mb-8">
            <x-label for="name" :required="true">
                Name
            </x-label>
            <x-text-input name="name" />
        </div>
        <div class="mb-8">
            <x-label for="email" :required="true">
                Email
            </x-label>
            <x-text-input name="email" />
        </div>
        <div class="mb-8">
            <x-label for="password" :required="true">
                Password
            </x-label>
            <x-text-input name="password" type="password" />
        </div>
        <div class="mb-8">
            <x-label for="password_confirmation" :required="true">
               Confirm Password
            </x-label>
            <x-text-input name="password_confirmation" type="password" />
        </div>

        <div class="mb-8 flex justify-between text-sm font-medium">
            <div>
                <div class="text-slate-500">
                Have an account? <a href="{{route('auth.create')}}" class="text-indigo-600 hover:underline" >Sign in!</a>
                </div>
            </div>
        </div>

        <x-button class="w-full bg-green-50">Sign up</x-button>
    </form>
    </x-card>
</x-layout>