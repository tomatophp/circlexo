@php $langs = collect(config('tomato-admin.langs')) @endphp

<x-splade-data :default="[$name => (object)array_fill_keys($langs->pluck('key')->toArray(), ''),'label'=>  $langs->where('key', app()->getLocale())->first()['label'][app()->getLocale()], 'lang' => app()->getLocale(), 'flag' => $langs->where('key', app()->getLocale())->first()['flag']]">
    @foreach($langs as $lang)
        @if($type === 'text')
            <div v-if="data.lang === '{{$lang['key']}}'">
                <label class="block text-sm font-medium leading-6 text-zinc-950 dark:text-white">{{ $label }} [@{{ data.label }}]</label>
                <x-splade-input  class="w-full" name="{{ $name.'['.$lang['key'].']' }}"  placeholder="{{$placeholder}}">
                    <x-slot:append>
                        <x-tomato-admin-dropdown>
                            <x-slot:button>
                                <x-tomato-admin-tooltip :text="__('Change Language')">
                                    @{{ data.flag }}
                                </x-tomato-admin-tooltip>
                            </x-slot:button>

                            @foreach($langs as $lang)
                                <button @click.prevent="data.label = '{{$lang['label'][app()->getLocale()]}}', data.lang = '{{$lang['key']}}', data.flag = '{{$lang['flag']}}', data[{{$name}}]['{{$lang['key']}}'] = ''" :class="{'text-primary-600 dark:text-primary-200 hover:text-zinc-500': data.lang ===  '{{$lang['key']}}', ' text-zinc-600 dark:text-zinc-200 hover:text-primary-500': data.lang !==  '{{$lang['key']}}' }" class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col items-center justify-center">
                                            {{$lang['flag']}}
                                        </div>
                                        <div>
                                            {{$lang['label'][app()->getLocale()]}}
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </x-tomato-admin-dropdown>
                    </x-slot:append>
                </x-splade-input>
            </div>
            @elseif($type === 'textarea')
                <div v-if="data.lang === '{{$lang['key']}}'">
                    <label class="block text-sm font-medium leading-6 text-zinc-950 dark:text-white">{{ $label }} [@{{ data.label }}]</label>
                    <x-splade-textarea autosize  class="w-full" name="{{ $name.'['.$lang['key'].']' }}"  placeholder="{{$placeholder}}" />
                    <div class="flex justify-end my-2">
                        <div>
                            <x-tomato-admin-dropdown>
                                <x-slot:button>
                                    <x-tomato-admin-tooltip :text="__('Change Language')">
                                        <span class="text-sm text-zinc-600 dark:text-zinc-200">{{__('Current Language')}}</span>  @{{ data.flag }}
                                    </x-tomato-admin-tooltip>
                                </x-slot:button>

                                @foreach($langs as $lang)
                                    <button @click.prevent="data.label = '{{$lang['label'][app()->getLocale()]}}', data.lang = '{{$lang['key']}}', data.flag = '{{$lang['flag']}}', data[{{$name}}]['{{$lang['key']}}'] = ''" :class="{'text-primary-600 dark:text-primary-200 hover:text-zinc-500': data.lang ===  '{{$lang['key']}}', ' text-zinc-600 dark:text-zinc-200 hover:text-primary-500': data.lang !==  '{{$lang['key']}}' }" class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
                                        <div class="flex justify-start gap-2">
                                            <div class="flex flex-col items-center justify-center">
                                                {{$lang['flag']}}
                                            </div>
                                            <div>
                                                {{$lang['label'][app()->getLocale()]}}
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </x-tomato-admin-dropdown>
                        </div>
                    </div>
                </div>
        @elseif($type === 'rich')
            <div v-if="data.lang === '{{$lang['key']}}'">
                <label class="block text-sm font-medium leading-6 text-zinc-950 dark:text-white">{{ $label }} [@{{ data.label }}]</label>
                <x-tomato-admin-rich class="w-full" name="{{ $name.'['.$lang['key'].']' }}"  placeholder="{{$placeholder}}" />
                <div class="flex justify-end my-2">
                    <div>
                        <x-tomato-admin-dropdown>
                            <x-slot:button>
                                <x-tomato-admin-tooltip :text="__('Change Language')">
                                    <span>{{__('Current Language')}}</span> @{{ data.flag }}
                                </x-tomato-admin-tooltip>
                            </x-slot:button>

                            @foreach($langs as $lang)
                                <button @click.prevent="data.label = '{{$lang['label'][app()->getLocale()]}}', data.lang = '{{$lang['key']}}', data.flag = '{{$lang['flag']}}', data[{{$name}}]['{{$lang['key']}}'] = ''" :class="{'text-primary-600 dark:text-primary-200 hover:text-zinc-500': data.lang ===  '{{$lang['key']}}', ' text-zinc-600 dark:text-zinc-200 hover:text-primary-500': data.lang !==  '{{$lang['key']}}' }" class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col items-center justify-center">
                                            {{$lang['flag']}}
                                        </div>
                                        <div>
                                            {{$lang['label'][app()->getLocale()]}}
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </x-tomato-admin-dropdown>
                    </div>
                </div>
            </div>
        @elseif($type === 'markdown')
            <div v-if="data.lang === '{{$lang['key']}}'">
                <label class="block text-sm font-medium leading-6 text-zinc-950 dark:text-white">{{ $label }} [@{{ data.label }}]</label>
                <x-tomato-markdown-editor class="w-full" name="{{ $name.'['.$lang['key'].']' }}"  placeholder="{{$placeholder}}" />
                <div class="flex justify-end my-2">
                    <div>
                        <x-tomato-admin-dropdown>
                            <x-slot:button>
                                <x-tomato-admin-tooltip :text="__('Change Language')">
                                    @{{ data.flag }}
                                </x-tomato-admin-tooltip>
                            </x-slot:button>

                            @foreach($langs as $lang)
                                <button @click.prevent="data.label = '{{$lang['label'][app()->getLocale()]}}', data.lang = '{{$lang['key']}}', data.flag = '{{$lang['flag']}}', data[{{$name}}]['{{$lang['key']}}'] = ''" :class="{'text-primary-600 dark:text-primary-200 hover:text-zinc-500': data.lang ===  '{{$lang['key']}}', ' text-zinc-600 dark:text-zinc-200 hover:text-primary-500': data.lang !==  '{{$lang['key']}}' }" class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col items-center justify-center">
                                            {{$lang['flag']}}
                                        </div>
                                        <div>
                                            {{$lang['label'][app()->getLocale()]}}
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </x-tomato-admin-dropdown>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</x-splade-data>
