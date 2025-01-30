@if($articles->count())
<section>
    <div class="container">
        <h2 class="text-center fw-bold">Découvrez nos articles</h2>

        <div class="container py-5">
            <div class="row justify-content-center">
                @foreach($articles as $article)
                <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card h-100 d-flex flex-column">
                        <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top" alt="{{ $article->title }}">
                        <div class="card-body d-flex flex-column">
                            <p>{{ $article->type }}</p>
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary mt-auto">Lire la suite</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
