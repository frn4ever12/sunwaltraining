<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>तालिम क्याटेगोरीहरू</h2>
            <p>आफ्नो रुचि अनुसार तालिम क्याटेगोरी छान्नुहोस्</p>
            <div class="divider"></div>
        </div>

        <div class="row g-4">
            @foreach(\App\Models\Category::select('id', 'name_np', 'name_eng', 'icon')->get() as $category)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="category-card" onclick="window.location.href='{{ route('training.index') }}?category={{ $category->id }}'">
                        <div class="category-icon">
                            <i class="{{ $category->icon ?? 'fas fa-book' }}"></i>
                        </div>
                        <h4 class="category-name">{{ $category->name_np ?? $category->name_eng }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
