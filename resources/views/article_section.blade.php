@if($articles->count())
<section>
    <div class="container">
        <h2 class="text-center fw-bold">
            Découvrez nos articles
        </h2>

        <div class="container py-5">
            <div class="row justify-content-center">
                @foreach($articles as $article)
                <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card">
                        <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top" alt="{{ $article->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->description }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary">Lire la suite</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endif
