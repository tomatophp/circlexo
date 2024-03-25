<x-circle-xo-app-layout>
    <div class="h-screen flex flex-col justify-center items-center  mx-6">
        <div class="w-full justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                    class="w-full lg:w-1/2"
                    :title="__('Login to your Profile')"
                    :description="__('please input your username and password')"
                    icon="bxs-log-in"
                >
                    <x-splade-form method="POST" :action="route('account.login.check')" class="flex flex-col gap-4 w-full">
                        <x-splade-input type="text" name="username" label="Username" />
                        <x-splade-input type="password" name="password" label="Password" />
                        <x-splade-button label="Login" class="bg-main-600 border-main-400 text-gray-900" />
                    </x-splade-form>
                </x-circle-xo-card>
            </div>
        </div>

    </div>
</x-circle-xo-app-layout>
