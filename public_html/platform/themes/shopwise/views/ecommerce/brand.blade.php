@php Theme::set('pageName', $brand->name) @endphp

<div class="section">
    <form action="{{ URL::current() }}" method="GET">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                @include(Theme::getThemeNamespace() . '::views/ecommerce/includes/sort')
                            </div>
                        </div>
                    </div>
                    <div class="shop_container">
                        @if ($products->count() > 0)
                            <div class="shop_container flex flex-col grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                                @foreach($products as $product)
                                    {!! Theme::partial('product-item-grid', compact('product')) !!}
                                @endforeach
                            </div>
                            <div class="mt-3 justify-content-center pagination_style1">
                                {!! $products->appends(request()->query())->onEachSide(1)->links() !!}
                            </div>
                        @else
                            <br>
                            <div class="col-12 text-center">{{ __('No products Found!') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="sidebar">
                        @include(Theme::getThemeNamespace() . '::views/ecommerce/includes/filters')
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END SECTION SHOP -->
