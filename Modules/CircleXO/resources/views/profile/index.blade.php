<x-circle-xo-profile-layout>
  <div class="my-4">
      <x-circle-xo-listing-filters link />
      <div class="flex items-center justify-center w-full">
          <div class="w-full lg:w-1/2 xl:w-1/3">
              @if(!$listing->count())
                  <div class="bg-zinc-800 border border-zinc-700 md:mx-0 mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
                      <div class="p-8 md:p-16 text-center">
                          <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                          <h1>{{__('Your Profile is empty try add some listing')}}</h1>
                          <div class="my-4">
                              <x-circle-xo-button size="sm" modal :href="route('profile.listing.create')">
                                  {{__('Add Listing')}}
                              </x-circle-xo-button>
                          </div>
                      </div>
                  </div>
              @else
                  <div class="grid grid-cols-1 gap-4 mx-8 md:mx-0 my-4">
                      @foreach($listing as $item)
                          <x-circle-xo-listing-card  edit :item="$item" />
                      @endforeach
                  </div>

                  <div class="mx-8 md:mx-0 my-4">
                      {!! $listing->links('tomato-admin::components.pagination') !!}
                  </div>
              @endif
          </div>
      </div>

  </div>
</x-circle-xo-profile-layout>
