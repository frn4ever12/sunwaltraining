<div class="my-2">
    <div class="row g-4">
        <!-- Banner Carousel - Responsive -->
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div id="bannerCarousel" class="carousel slide border" data-bs-ride="carousel" data-bs-interval="5000"
                style="height: 70vh;">
                <div class="carousel-indicators">
                    @foreach ($banners as $key => $banner)
                        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner h-100">
                    @foreach (\App\Models\Banner::get() as $key => $banner)
                        <div class="carousel-item carousel-hover-item {{ $key == 0 ? 'active' : '' }} h-100">
                            <img src="{{ asset('files/' . $banner->image) }}"
                                class="d-block w-100 h-100 object-fit-cover" data-bs-toggle="tooltip"
                                data-bs-title="{{ $banner->title }}" alt="{{ $banner->title }}">
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        @include('welcome.partials.suchana-table')
    </div>
</div>
