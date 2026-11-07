<article class="card">
    <a href="{{ route('product.show', $item->id) }}" aria-label="View {{ $item->name }}">
        <div class="image">
            @if (is_file(public_path($item->main_image_path)))
                <img
                    src="{{ asset($item->main_image_path) }}"
                    alt="{{ $item->name }}"
                    loading="lazy"
                >
            @else
                <div class="placeholder">
                    Add photo:<br>{{ $item->main_image_path }}
                </div>
            @endif
        </div>
    </a>

    <div class="card-body">
        <span class="badge">{{ $item->condition }}</span>
        <h3>{{ $item->name }}</h3>

        <p class="price">
            ${{ number_format($item->price, 2) }}
        </p>

        <a href="{{ route('product.show', $item->id) }}" class="button">
            View Details
        </a>
    </div>
</article>