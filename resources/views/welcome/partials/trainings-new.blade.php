<!-- Training Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>तालिमहरू</h2>
            <p>हाम्रो गुणस्तरीय तालिम कार्यक्रमहरू अन्वेषण गर्नुहोस् र आफ्नो करियर अगाडि बढाउनुहोस्</p>
            <div class="divider"></div>
        </div>

        <div class="row g-4">
            @if(isset($trainings) && $trainings->count() > 0)
                @foreach($trainings as $training)
                    <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="training-card">
                            <div class="training-image">
                                @if($training->image)
                                    <img src="{{ asset('files/' . $training->image) }}" alt="{{ $training->name_np ?? $training->name_eng }}">
                                @else
                                    <img src="{{ asset('dist/img/training/default.jpg') }}" alt="Training Image">
                                @endif
                                <span class="category-badge">{{ $training->category->name_np ?? '' }}</span>
                                <span class="status-badge {{ $training->status }}">
                                    {{ __('messages.' . $training->status) }}
                                </span>
                            </div>
                            <div class="training-body">
                                <h3 class="training-title">{{ $training->name_np ?? $training->name_eng }}</h3>
                                <div class="training-info">
                                    <div class="training-info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $training->district->name ?? '' }}</span>
                                    </div>
                                    <div class="training-info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>{{ $training->start_miti_bs ?? '' }}</span>
                                    </div>
                                    <div class="training-info-item">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $training->duration ?? '' }} दिन</span>
                                    </div>
                                    <div class="training-info-item">
                                        <i class="fas fa-user-tie"></i>
                                        <span>{{ $training->trainer_name_np ?? $training->trainer_name_eng }}</span>
                                    </div>
                                </div>
                                <div class="training-footer">
                                    <div class="seats-info">
                                        <small class="text-muted">सिट: {{ $training->available_seats ?? 0 }}</small>
                                    </div>
                                    <a href="{{ route('training.show', $training->id) }}" class="btn btn-primary">
                                        विवरण हेर्नुहोस्
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        हाल कुनै तालिम उपलब्ध छैन।
                    </div>
                </div>
            @endif
        </div>

        @if(isset($trainings) && $trainings->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $trainings->withQueryString()->links() }}
            </div>
        @endif

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('training.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-right me-2"></i>सबै तालिमहरू हेर्नुहोस्
            </a>
        </div>
    </div>
</section>
