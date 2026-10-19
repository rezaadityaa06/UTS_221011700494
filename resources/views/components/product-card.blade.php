<div class="col-sm-6 col-lg-4">
    <article class="card product-card h-100">
        <a
            class="product-visual"
            href="{{ route('products.show', $product) }}"
            aria-label="Lihat detail {{ $product->name }}"
        >
            <img
                src="{{ asset($product->image) }}"
                alt="Foto {{ $product->name }}"
                loading="lazy"
                width="800"
                height="600"
            >
        </a>

        <div class="card-body p-4 d-flex flex-column">
            <div class="mb-3">
                <span class="badge badge-soft">
                    {{ $product->material }}
                </span>
            </div>

            <h3 class="h5 fw-bold">
                <a
                    class="product-name"
                    href="{{ route('products.show', $product) }}"
                >
                    {{ $product->name }}
                </a>
            </h3>

            <p class="text-secondary small mb-4">
                {{ \Illuminate\Support\Str::limit($product->description, 110) }}
            </p>

            <div class="d-flex justify-content-between align-items-center gap-2 mt-auto">
                <strong class="price">
                    Rp{{ number_format((float) $product->price, 0, ',', '.') }}
                </strong>

                <a
                    class="btn btn-outline-success btn-sm rounded-pill px-3"
                    href="{{ route('products.show', $product) }}"
                >
                    Lihat detail
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </article>
</div>