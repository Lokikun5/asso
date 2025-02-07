@if($articles->count())
<section class="">
    <div class="container">
        <h2 class="text-center fw-bold pt-5">Découvrez nos articles</h2>

        <div class="container py-5">
            <div class="row justify-content-center">
                @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top" alt="{{ $article->title }}">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <p>{{ $article->type }}</p>
                                <p>{{ $article->created_at->format('d/m/Y') }}</p>
                            </div>
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-color btn-primary mt-auto">Lire la suite</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
