<x-circle-xo-app-layout>
    <div class="h-screen flex flex-col justify-center items-center  mx-6">
        <div class="w-full justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                    class="w-full lg:w-1/2"
                    :title="__('Verify Your Account')"
                    :description="__('please input the code sent to your email')"
                    icon="bxs-check-circle"
                >
                    <x-splade-form method="POST" :action="route('account.otp.check')" class="flex flex-col gap-4 w-full">
                        <x-splade-input type="number" name="otp_code" label="Code" />
                        <x-splade-button label="Verify" class="bg-main-600 border-main-400 text-gray-900" />
                    </x-splade-form>
                </x-circle-xo-card>
            </div>
        </div>

    </div>
</x-circle-xo-app-layout>
