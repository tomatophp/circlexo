<x-circle-xo-app-layout>
    <div class="h-screen flex flex-col justify-center items-center  mx-6">
        <div class="w-full justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                  class="w-full lg:w-1/2"
                  :title="__('Create New Profile')"
                  :description="__('please fill this form the create a new profile')"
                  icon="bxs-user-plus"
                >
                    <x-splade-form method="POST" :action="route('account.register.store')" class="flex flex-col gap-4 w-full">
                        <x-splade-input name="name" label="Name" />
                        <x-splade-input name="username" label="Username">
                            <x-slot:prepend>
                                <span>@</span>
                            </x-slot:prepend>
                        </x-splade-input>
                        <x-splade-input name="email" label="Email" />
                        <x-splade-input name="password" label="Password" type="password" />
                        <x-splade-input name="password_confirmation" label="Confirm Password" type="password" />
                        <x-splade-button label="Register" class="bg-main-600 border-main-400 text-gray-900" />
                    </x-splade-form>
                </x-circle-xo-card>
            </div>
        </div>

    </div>
</x-circle-xo-app-layout>
