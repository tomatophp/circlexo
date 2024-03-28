<div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-8">
    <h1 class="text-4xl font-bold tracking-tight text-gray-900">
        {{$title ?? __('Shop')}}
    </h1>

    <div class="flex items-center">
        <x-splade-toggle>
            <div  class="relative inline-block text-left">
                <div>
                    <button @click.prevent="toggle" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
                        {{__('Sort')}}
                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <Transition
                    v-show="toggled"
                    enter="transition ease-out duration-100"
                    enter-start="transform opacity-0 scale-95"
                    enter-end="transform opacity-100 scale-100"
                    leave="transition ease-in duration-75"
                    leave-start="transform opacity-100 scale-100"
                    leave-end="transform opacity-0 scale-95"
                >
                    <div  class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <x-splade-link  :href="url('shop?orderBy=popular')"  method="GET" :class="request()->orderBy === 'popular' ? 'font-medium text-gray-900 block px-4 py-2 text-sm' : 'text-gray-500 block px-4 py-2 text-sm'" role="menuitem" tabindex="-1" id="menu-item-0">{{__('Most Popular')}}</x-splade-link>
                            <x-splade-link  :href="url('shop?orderBy=rating')"  method="GET"  :class="request()->orderBy === 'rating' ? 'font-medium text-gray-900 block px-4 py-2 text-sm' : 'text-gray-500 block px-4 py-2 text-sm'" role="menuitem" tabindex="-1" id="menu-item-1">{{__('Best Rating')}}</x-splade-link>
                            <x-splade-link  :href="url('shop?orderBy=newest')" method="GET"  :class="request()->orderBy === 'newest' ? 'font-medium text-gray-900 block px-4 py-2 text-sm' : 'text-gray-500 block px-4 py-2 text-sm'" role="menuitem" tabindex="-1" id="menu-item-2">{{__('Newest')}}</x-splade-link>
                            <x-splade-link  :href="url('shop?orderBy=lowToHigh')"  method="GET"  :class="request()->orderBy === 'lowToHigh' ? 'font-medium text-gray-900 block px-4 py-2 text-sm' : 'text-gray-500 block px-4 py-2 text-sm'" role="menuitem" tabindex="-1" id="menu-item-3">{{__('Price: Low to High')}}</x-splade-link>
                            <x-splade-link  :href="url('shop?orderBy=highToLow')"  method="GET"  :class="request()->orderBy === 'highToLow' ? 'font-medium text-gray-900 block px-4 py-2 text-sm' : 'text-gray-500 block px-4 py-2 text-sm'" role="menuitem" tabindex="-1" id="menu-item-4">{{__('Price: High to Low')}}</x-splade-link>
                        </div>
                    </div>
                </Transition>
            </div>

        </x-splade-toggle>
        <button @click.prevent="data.showMenu = !data.showMenu" type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden">
            <span class="sr-only">{{__('Filters')}}</span>
            <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
