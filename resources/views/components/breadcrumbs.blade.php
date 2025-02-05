<div class="breadcrumb-container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('welcome') }}"><i class="fas fa-home"></i> Accueil</a>
        </li>
        @if(isset($breadcrumbs) && count($breadcrumbs))
            @foreach($breadcrumbs as $breadcrumb)
                <span class="breadcrumb-separator">›</span>
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    @if(!$loop->last)
                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                    @else
                        {{ $breadcrumb['name'] }}
                    @endif
                </li>
            @endforeach
        @endif
    </ol>
</div>
