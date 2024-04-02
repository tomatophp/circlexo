<div class="flex justify-center md:justify-end gap-4 mt-8 mx-16">
    @if($edit)
        <x-tomato-admin-tooltip :text="__('QR Generator')">
            <x-splade-link modal href="{{route('profile.qr')}}"
                           class="bg-success-600 text-white rounded-md shadow-md font-bold text-sm px-4 py-2">
                <i class="bx bx-qr"></i>
            </x-splade-link>
        </x-tomato-admin-tooltip>
        <x-tomato-admin-tooltip :text="__('Sponsoring')">
            <x-splade-link modal href="{{route('profile.sponsoring.show')}}"
                           class="bg-danger-600 text-white rounded-md shadow-md font-bold text-sm px-4 py-2">
                <i class="bx bxs-heart"></i>
            </x-splade-link>
        </x-tomato-admin-tooltip>
        <x-circle-xo-share :title="$account->username" :description="$account->bio" :url="url($account->username)">
            <x-tomato-admin-tooltip :text="__('Share')">
            <span class="bg-success-600 flex flex-col justify-center items-center text-white rounded-md shadow-md font-bold text-sm px-4 py-2 -mt-1">
                <i class="bx bxs-share text-lg text-white"></i>
            </span>
            </x-tomato-admin-tooltip>
        </x-circle-xo-share>
        <x-tomato-admin-tooltip :text="__('Settings')">
            <x-tomato-admin-dropdown>
                <x-slot:button>
                    <button>
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                </x-slot:button>
                <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-plus-circle" :label="__('List Item')"
                                              href="{{ route('profile.listing.create') }}"/>
                <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-edit" :label="__('Edit Profile')"
                                              href="{{ route('profile.info.show') }}"/>
                <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-lock" :label="__('Edit Password')"
                                              href="{{ route('profile.password.show') }}"/>
                <x-tomato-admin-dropdown-item modal type="link" icon="bx bxl-twitter" :label="__('Link Social Account')"
                                              href="{{ route('profile.social-accounts.show') }}"/>

                @php $profileDropdown = \Modules\CircleXo\App\Facades\CircleXo::slots('profile-dropdown'); @endphp
                @foreach($profileDropdown as $slot)
                    @if(view()->exists($slot))
                        @include($slot)
                    @endif
                @endforeach
                <x-tomato-admin-dropdown-item type="link" method="DELETE" confirm-danger icon="bx bxs-trash" danger
                                              :label="__('Delete Account')" href="{{ route('profile.destroy') }}"/>
            </x-tomato-admin-dropdown>
        </x-tomato-admin-tooltip>
    @else
        <x-circle-xo-button modal href="{{route('home.contact', $account->username)}}" :label="__('Message')"
                            size="sm"/>
        @if(auth('accounts')->user())
            @if(!auth('accounts')->user()->isFollowing($account))
                <x-circle-xo-button href="{{route('profile.actions.follow', $account->username)}}" :label="__('Follow')"
                                    size="sm"/>
            @else
                <x-circle-xo-button href="{{route('profile.actions.unfollow', $account->username)}}" danger
                                    confirm-danger :label="__('UnFollow')" size="sm"/>
            @endif
        @endif
        @if($account->meta('sponsoring_link'))
            <x-tomato-admin-tooltip :text="__('Sponsoring')">
                <x-splade-link href="{{ route('home.sponsoring', $account->username) }}"
                               class="bg-danger-600 text-white rounded-md shadow-md font-bold text-sm px-4 py-2">
                    <i class="bx bxs-heart text-white"></i>
                </x-splade-link>
            </x-tomato-admin-tooltip>
        @endif
        <x-circle-xo-share :title="$account->username" :description="$account->bio" :url="url($account->username)">
            <x-tomato-admin-tooltip :text="__('Share')">
            <span class="bg-success-600 flex flex-col justify-center items-center text-white rounded-md shadow-md font-bold text-sm px-4 py-2 -mt-1">
                <i class="bx bxs-share text-lg text-white"></i>
            </span>
            </x-tomato-admin-tooltip>
        </x-circle-xo-share>

        @php $profileButtons = \Modules\CircleXo\App\Facades\CircleXo::slots('profile-buttons'); @endphp
        @foreach($profileButtons as $slot)
            @if(view()->exists($slot))
                @include($slot)
            @endif
        @endforeach
    @endif
</div>

