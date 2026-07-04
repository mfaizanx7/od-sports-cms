<section class="bg-white absolute z-30 m-auto max-h-[500px] w-[400px] right-7 top-12 shadow-md overflow-y-auto"
    id="cart">

    @if (Cart::instance('cart')->count() > 0)
            <div class="bg-white">
                @if (Cart::instance('cart')->count() > 0)
                    @php
                        $products = [];
                        $productIds = Cart::instance('cart')->content()->pluck('id')->toArray();

                        if ($productIds) {
                            $products = get_products([
                                'condition' => [['ec_products.id', 'IN', $productIds]],
                                'with' => ['slugable'],
                            ]);
                        }
                    @endphp

                    <div class="overflow-hidden">
                        <div class="p-4 bg-gray-50 border-b">
                            <div class="flex justify-between items-center">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    {{-- <input type="checkbox" class="peer hidden" />
                                <i class="fa-solid fa-square-check !hidden peer-checked:!inline"></i>
                                <i class="fa-regular fa-square-check inline peer-checked:hidden"></i> --}}
                                    <p class="text-sm font-bold text-xl text-black">Your Cart</p>
                                </label>
                                <div class="text-sm">
                                    <span class="text-gray-600">Total:</span>
                                    <span class="text-black font-bold text-base">
                                        @if (EcommerceHelper::isTaxEnabled())
                                            {{ format_price(Cart::instance('cart')->rawSubTotal() + Cart::instance('cart')->rawTax()) }}
                                        @else
                                            {{ format_price(Cart::instance('cart')->rawSubTotal()) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 p-4">
                            @foreach (Cart::instance('cart')->content() as $key => $cartItem)
                                @php
                                    $product = $products->where('id', $cartItem->id)->first();
                                @endphp

                                @if (!empty($product))
                                    <div class="flex items-start gap-3 border-b pb-4 last:border-0 last:pb-0">
                                        {{-- <label class="flex items-center gap-2 cursor-pointer mt-2">
                                        <input type="checkbox" class="peer hidden" />
                                        <i class="fa-solid fa-square-check !hidden peer-checked:!inline"></i>
                                        <i class="fa-regular fa-square-check peer-checked:hidden"></i>
                                    </label> --}}

                                        <img src="{{ RvMedia::getImageUrl($cartItem->options['image'], 'thumb', false, RvMedia::getDefaultImage()) }}"
                                            class="w-16 h-16 object-contain border rounded-md"
                                            alt="{{ $product->name }}">

                                        <div class="flex-1">
                                            <div class="flex justify-between">
                                                <a href="{{ $product->original_product->url }}"
                                                    class="font-medium hover:text-primary line-clamp-2 text-black">
                                                    {{ $product->name }}
                                                </a>
                                                <a href="{{ route('public.cart.remove', $cartItem->rowId) }}"
                                                    class="">
                                                    <i class="fas fa-trash text-xs cursor-pointer"></i>
                                                </a>
                                            </div>

                                            @if ($product->isOutOfStock())
                                                <span class="text-red-500 text-xs block mt-1">
                                                    {!! $product->stock_status_html !!}
                                                </span>
                                            @endif

                                            @if (!empty($cartItem->options['attributes']))
                                                <p class="text-xs text-gray-500 mt-1 flex items-center">
                                                    <i class="fa fa-circle text-[6px] mr-1"></i>
                                                    {{ $cartItem->options['attributes'] }}
                                                </p>
                                            @endif

                                            @if (!empty($cartItem->options['options']))
                                                <div class="mt-1 text-xs text-gray-500">
                                                    {!! render_product_options_info($cartItem->options['options'], $product, true) !!}
                                                </div>
                                            @endif

                                            <div class="flex justify-between items-center mt-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-bold text-sm">
                                                        {{ format_price($cartItem->price) }} x {{ $cartItem->qty }}
                                                    </span>
                                                    @if ($product->front_sale_price != $product->price)
                                                        <small class="text-gray-500 text-xs line-through">
                                                            {{ format_price($product->price) }} x {{ $cartItem->qty }}
                                                        </small>
                                                    @endif
                                                </div>

                                                {{-- <div class="product-quantity" data-title="{{ __('Quantity') }}">
                                                <div class="quantity">
                                                    <input type="button" value="-" class="minus">
                                                    <input type="text" value="{{ $cartItem->qty }}" title="Qty"
                                                        class="qty" size="4"
                                                        name="items[{{ $key }}][values][qty]">
                                                    <input type="button" value="+" class="plus">
                                                </div>
                                            </div> --}}

                                                {{-- <div class="product-quantity flex items-center border rounded-md overflow-hidden"
                                                    data-title="{{ __('Quantity') }}">
                                                    <div class="quantity flex items-center">
                                                        <button type="button"
                                                            class="minus bg-white !pl-0 !pt-0 !m-0 !text-xs"
                                                            value="-">
                                                            <i class="fa-solid fa-minus text-xs"></i>
                                                        </button>
                                                        <input type="text" value="{{ $cartItem->qty }}"
                                                            title="Qty"
                                                            class="w-8 text-center text-sm focus:outline-none qty !border-y-0 !border-x"
                                                            size="4"
                                                            name="items[{{ $key }}][values][qty]"
                                                            onkeydown="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <button type="button"
                                                            class="plus bg-white !pl-0 !pt-0 !m-0 !text-xs"
                                                            value="+">
                                                            <i class="fa-solid fa-plus text-xs"></i>
                                                        </button>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="p-4 border-t bg-white sticky bottom-0 shadow-top">
                        {{-- <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-600 text-sm">Subtotal:</span>
                        <span class="font-medium">
                            {{ format_price(Cart::instance('cart')->rawSubTotal()) }}
                        </span>
                    </div> --}}

                        @if (EcommerceHelper::isTaxEnabled())
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600 text-sm">Tax:</span>
                                <span class="font-medium">
                                    {{ format_price(Cart::instance('cart')->rawTax()) }}
                                </span>
                            </div>
                        @endif

                        <div class="flex space-x-2">
                            <a href="{{ route('public.cart') }}"
                                class="flex-1 bg-black hover:bg-gray-900 text-white text-center py-2 rounded-md transition text-sm">
                                View Cart
                            </a>
                            {{-- @if (session('tracked_start_checkout'))
                                    <a href="{{ route('public.checkout.information', session('tracked_start_checkout')) }}"
                                        class="flex-1 bg-primary hover:bg-primary-dark text-white text-center py-2 rounded-md transition text-sm">
                                        Checkout
                                    </a>
                                @endif --}}
                        </div>
                    </div>
                @else
                    <div class="p-8 flex flex-col items-center justify-center">
                        <i class="fa-solid fa-cart-shopping text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-center">{{ __('Your cart is empty!') }}</p>
                        <a href="{{ route('public.products') }}"
                            class="mt-4 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition text-sm">
                            Continue Shopping
                        </a>
                    </div>
                @endif
            </div>
    @else
        <p class="text-center mt-2 py-10">{{ __('Your cart is empty!') }}</p>
    @endif
</section>
