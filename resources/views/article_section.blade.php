@if($articles->count())
<section class="background-gradient">
    <div class="container">
        <h2 class="text-center fw-bold pt-5">Découvrez nos articles</h2>

        <div class="container py-5">
            <div class="row justify-content-center">
                @foreach($articles as $article)
                <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card h-100 d-flex flex-column">
                        <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top" alt="{{ $article->title }}">
                        <div class="card-body d-flex flex-column">
                            <p>{{ $article->type }}</p>
                            <h3 class="card-title">{{ $article->title }}</h3>
                            <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary btn-color mt-auto">Lire la suite</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
