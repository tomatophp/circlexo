<template>
    <div v-show="loading" class="text-center flex justify-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
    <ais-instant-search v-show="!loading" :search-client="searchClient" index-name="username_index" :future="{preserveSharedStateOnUnmount: true}">
        <ais-autocomplete :escape-html="true">
            <template v-slot="{ currentRefinement, indices, refine }">
                <input
                    class="fi-input block w-full border-gray-700 bg-white dark:bg-zinc-800 py-1.5 text-base text-zinc-950 outline-none transition duration-75 placeholder:text-zinc-400 disabled:text-zinc-500 disabled:[-webkit-text-fill-color:theme(colors.zinc.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.zinc.400)] dark:text-white dark:placeholder:text-zinc-500 dark:disabled:text-zinc-400 dark:disabled:[-webkit-text-fill-color:theme(colors.zinc.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.zinc.500)] sm:text-sm sm:leading-6 ps-3 pe-3 focus:ring-2 ring-primary-500 focus:ring-2 focus:ring-primary-500 rounded-lg"
                    type="search"
                    ref="searchInput"
                    :value="currentRefinement"
                    :placeholder="$props.placeholder"
                    @input="refine($event.currentTarget.value)"
                >
                <ul v-if="currentRefinement" v-for="index in indices" :key="index.indexId">
                    <li >
                        <ul class="flex flex-col gap-2 my-8">
                            <li v-for="(hit, hitKey) in index.hits" :key="hit.objectID" class="text-white cursor-pointer" @click="goToProfile(hit)">
                                <div class="flex justify-start gap-4 p-4 border border-zinc-700 rounded-lg">
                                    <div  v-if="hit.avatar" :style="'background-image: url('+hit.avatar+')'" class="w-16 h-16 bg-cover bg-center rounded-full border border-zinc-700">

                                    </div>
                                    <div v-else class="flex flex-col bg-zinc-900 justify-center items-center w-16 h-16 bg-cover bg-center rounded-full border border-zinc-700">
                                        <i class="bx bx-user text-3xl text-zinc-500"></i>
                                    </div>
                                    <div class="flex flex-col justify-center items-center">
                                        <div>
                                            <div class="text-2xl font-bold">
                                                <div class="flex justify-start gap-2">
                                                    <ais-highlight attribute="name" :hit="hit" />
                                                    <div v-if="hit.type === 'verified'" class="flex flex-col justify-center items-center">
                                                        <i class="bx bxs-badge-check text-blue-400 text-xl"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-zinc-200">{{ hit.username }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li v-show="index.hits.length<1">
                                <div class="flex justify-center gap-4 p-4 border border-zinc-700 rounded-lg">
                                    <div class="flex flex-col justify-center items-center">
                                        <div>
                                            <div class="text-2xl font-bold">
                                                <div class="flex flex-col justify-center text-center gap-2">
                                                    <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                                                    <div class="text-zinc-200">No results found</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </template>
        </ais-autocomplete>
    </ais-instant-search>
</template>

<script>

import { instantMeiliSearch } from '@meilisearch/instant-meilisearch';
import { AisAutocomplete } from 'vue-instantsearch/vue3/es';


export default {
    mounted() {
        const _this = this;

        setTimeout(() => {
            _this.loading =false;
            this.$refs.searchInput.focus();
        }, 1000);
    },
    components: {
        AisAutocomplete
    },
    props: {
        url: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            default: 'Search'
        }
    },
    data() {
        return {
            loading: true,
            searchClient: instantMeiliSearch(
                import.meta.env.VITE_MEILISEARCH_HOST,
                import.meta.env.VITE_MEILISEARCH_KEY,
            ).searchClient
        };
    },
    methods:{
        goToProfile(item){
            console.log(item);
            this.$splade.visit(this.$props.url +"/"+ item.username)
        }
    }
}

</script>

