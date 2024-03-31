<div @preserveScroll class="mx-8 lg:mx-0">
    <Swiper
        :breakpoints="{
          '350': {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          '768': {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          '1024': {
            slidesPerView: 4,
            spaceBetween: 10,
          },
          '1024': {
            slidesPerView: 4,
            spaceBetween: 10,
          },

          '1900': {
            slidesPerView: 5,
            spaceBetween: 10,
          },
        }"
        :space-between="10"
        :loop="true"
        :centeredSlides="true"
        class="w-full lg:w-1/2 xl:w-1/3"
    >
        <x-circle-xo-listing-filter-item
            filter="all"
            icon="bx bx-category"
            label="{{__('All')}}"
            color="#8805DD"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="link"
            icon="bx bx-link"
            label="{{__('Link')}}"
            color="#FF3D64"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="post"
            icon="bx bx-news"
            label="{{__('Posts')}}"
            color="#00E0B2"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="skill"
            icon="bx bxs-face-mask"
            label="{{__('Skills')}}"
            color="red"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="portfolio"
            icon="bx bx-image"
            label="{{__('Portfolios')}}"
            color="blue"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="review"
            icon="bx bxs-star"
            label="{{__('Reviews')}}"
            color="orange"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="service"
            icon="bx bxs-briefcase-alt-2"
            label="{{__('Services')}}"
            color="#F8CF00"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="product"
            icon="bx bxs-cart"
            label="{{__('Products')}}"
            color="green"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="game"
            icon="bx bxs-game"
            label="{{__('Game')}}"
            color="#008469"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="music"
            icon="bx bxs-music"
            label="{{__('Music')}}"
            color="#FF3D64"
            :link="$link"
        />
        <x-circle-xo-listing-filter-item
            filter="video"
            icon="bx bxs-video"
            label="{{__('Video')}}"
            color="#8A7407"
            :link="$link"
        />
    </Swiper>
</div>

