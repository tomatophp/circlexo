<x-circle-xo-profile-layout>
  <div class="my-4">
      <x-circle-xo-listing-filters link />

      @if(!$listing->count())
          <div class="bg-zinc-800 border border-zinc-700 mx-16 mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
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
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-8 md:mx-16 my-4">
              @foreach($listing as $item)
                  <x-circle-xo-listing-card  edit :item="$item" />
              @endforeach
          </div>

          <div class="mx-16 my-4">
              {!! $listing->links('tomato-admin::components.pagination') !!}
          </div>
      @endif
  </div>
</x-circle-xo-profile-layout>
