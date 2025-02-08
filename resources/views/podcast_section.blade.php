@if($podcasts->count())
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold pt-5"><i class="fas fa-microphone"></i> Découvrez nos podcasts</h2>
        <p class="text-muted text-center">Plongez dans nos émissions captivantes et inspirantes.</p>

        <div class="container py-5">
            <div class="row justify-content-center">
                @foreach ($podcasts as $podcast)
                <div class="col-md-6 mb-4">
                    <div class="podcast-card d-flex align-items-start p-3 rounded shadow-sm bg-white">
                        <img src="{{ asset('storage/' . $podcast->image) }}" alt="{{ $podcast->name }}" class="podcast-card-image rounded shadow">
                        <div class="ms-3">
                            <h3 class="h5 fw-bold">{{ $podcast->name }}</h3>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-calendar-alt"></i> {{ $podcast->created_at->format('d M, Y') }}
                            </p>
                            <p class="text-muted">{{ Str::limit($podcast->description, 120) }}</p>
                            <a href="{{ route('podcasts.show', $podcast->slug) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-play"></i> Écouter le Podcast
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
@endif
