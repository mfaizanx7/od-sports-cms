@if (Cart::instance('cart')->count() > 0)
    <div class="flex flex-col gap-2">
        @php
            $products = [];
            $productIds = Cart::instance('cart')->content()->pluck('id')->toArray();

            if ($productIds) {
                $products = get_products([
                    'condition' => [
                        ['ec_products.id', 'IN', $productIds],
                    ],
                    'with' => ['slugable'],
                ]);
            }
        @endphp
        
        @if (count($products))
            @foreach(Cart::instance('cart')->content() as $key => $cartItem)
                @php
                    $product = $products->where('id', $cartItem->id)->first();
                @endphp

                @if (!empty($product))
                    <div class="flex items-center gap-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="peer hidden" />
                            <i class="fa-solid fa-square-check hidden peer-checked:inline"></i>
                            <i class="fa-regular fa-square-check peer-checked:hidden"></i>
                        </label>
                        <img src="{{ RvMedia::getImageUrl($cartItem->options['image'], 'thumb', false, RvMedia::getDefaultImage()) }}" class="max-h-[100px] max-w-[100px] object-contain" alt="{{ $product->name }}">
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold w-full">{{ $product->name }} @if ($product->isOutOfStock()) <span class="text-red-500 text-xs">({!! $product->stock_status_html !!})</span> @endif</p>
                            <div class="flex justify-between">
                                <div class="flex gap-1 text-xs items-center flex-shrink-0">
                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                    {{ $cartItem->options['attributes'] ?? '' }}
                                </div>
                                <div class="border flex gap-2 rounded-lg justify-between w-fit px-1 max-w-[100px]">
                                    <div class="text-gray-500">Qty:</div>
                                    <input type="tel" value="{{ $cartItem->qty }}" onkeydown="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="focus-within:outline-none focus:outline-none bg-transparent w-full p-0 m-0 text-sm" />
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-bold">{{ format_price($cartItem->price) }} @if ($product->front_sale_price != $product->price)
                                    <small class="text-gray-500"><del>{{ format_price($product->price) }}</del></small>
                                @endif</span>
                                <a href="{{ route('public.cart.remove', $cartItem->rowId) }}" class="cursor-pointer text-gray-500 hover:text-black"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    
    <div class="p-6 flex flex-col gap-2 border-t">
        <div class="flex justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" class="peer hidden" />
                <i class="fa-solid fa-square-check hidden peer-checked:inline"></i>
                <i class="fa-regular fa-square-check peer-checked:hidden"></i>
                <p>All</p>
            </label>
            <div class="flex items-center gap-1">
                <p>Total:</p>
                <p class="font-bold text-base">
                    @if (EcommerceHelper::isTaxEnabled())
                        {{ format_price(Cart::instance('cart')->rawSubTotal() + Cart::instance('cart')->rawTax()) }}
                    @else
                        {{ format_price(Cart::instance('cart')->rawSubTotal()) }}
                    @endif
                </p>
            </div>
        </div>
        <a href="{{ route('public.cart') }}" class="font-bold text-white bg-black w-full py-2 text-center">View Cart ({{ Cart::instance('cart')->count() }})</a>
    </div>
@else
    <p class="text-center text-gray-500 py-8">Your cart is empty!</p>
@endif