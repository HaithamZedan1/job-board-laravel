<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign in
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{route('auth.store')}}" method="post">
        @csrf
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

        <div class="mb-8 flex justify-between text-sm font-medium">
            <div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="rounded-sm border border-slate-400">
                    <label for="remember">Remember me</label>
                </div>
            </div>
            <div>
                <div class="text-slate-500">
                Don't have an account? <a href="{{route('auth.create_new')}}" class="text-indigo-600 hover:underline" >Sign up!</a>
                </div>
            </div>
        </div>

        <x-button class="w-full bg-green-50">Login</x-button>
    </form>
    </x-card>
</x-layout>