@php Theme::set('pageName', __('Shopping Cart')); @endphp

{{-- <div class="section">
    <div class="container">
        @if (Cart::instance('cart')->count() > 0)
            @if (session()->has('success_msg'))
                <div class="alert alert-success">
                    <span>{{ session('success_msg') }}</span>
                </div>
            @endif

            @if (session()->has('error_msg'))
                <div class="alert alert-warning">
                    <span>{{ session('error_msg') }}</span>
                </div>
            @endif

            @if (isset($errors) && count($errors->all()) > 0)
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form class="form--shopping-cart" method="post" action="{{ route('public.cart.update') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shop_cart_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">{{ __('Image') }}</th>
                                        <th class="product-name">{{ __('Product') }}</th>
                                        <th class="product-price">{{ __('Price') }}</th>
                                        <th class="product-quantity">{{ __('Quantity') }}</th>
                                        <th class="product-subtotal">{{ __('Total') }}</th>
                                        <th class="product-remove">{{ __('Remove') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($products) && $products)
                                        @foreach (Cart::instance('cart')->content() as $key => $cartItem)
                                            @php
                                                $product = $products->where('id', $cartItem->id)->first();
                                            @endphp

                                            @if (!empty($product))
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="{{ $product->original_product->url }}">
                                                            <img src="{{ RvMedia::getImageUrl($cartItem->options['image'], 'thumb', false, RvMedia::getDefaultImage()) }}"
                                                                alt="{{ $product->name }}" />
                                                        </a>
                                                    </td>
                                                    <td class="product-name" data-title="{{ __('Product') }}">
                                                        <a href="{{ $product->original_product->url }}"
                                                            title="{{ $product->name }}">{{ $product->name }}
                                                            @if ($product->isOutOfStock())
                                                                <span
                                                                    class="stock-status-label">({!! $product->stock_status_html !!})</span>
                                                            @endif
                                                        </a>
                                                        <p style="margin-bottom: 0">
                                                            <small>{{ $cartItem->options['attributes'] ?? '' }}</small>
                                                        </p>

                                                        @if (!empty($cartItem->options['options']))
                                                            {!! render_product_options_info($cartItem->options['options'], $product, true) !!}
                                                        @endif

                                                        @if (!empty($cartItem->options['extras']) && is_array($cartItem->options['extras']))
                                                            @foreach ($cartItem->options['extras'] as $option)
                                                                @if (!empty($option['key']) && !empty($option['value']))
                                                                    <p style="margin-bottom: 0;">
                                                                        <small>{{ $option['key'] }}: <strong>
                                                                                {{ $option['value'] }}</strong></small>
                                                                    </p>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="product-price" data-title="Price">
                                                        <div
                                                            class="product__price @if ($product->front_sale_price != $product->price) sale @endif">
                                                            <span>{{ format_price($cartItem->price) }}</span>
                                                            @if ($product->front_sale_price != $product->price)
                                                                <small><del>{{ format_price($product->price) }}</del></small>
                                                            @endif
                                                        </div>
                                                        <input type="hidden" name="items[{{ $key }}][rowId]"
                                                            value="{{ $cartItem->rowId }}">
                                                    </td>
                                                    <td class="product-quantity" data-title="{{ __('Quantity') }}">
                                                        <div class="quantity">
                                                            <input type="button" value="-" class="minus">
                                                            <input type="text" value="{{ $cartItem->qty }}"
                                                                title="Qty" class="qty" size="4"
                                                                name="items[{{ $key }}][values][qty]">
                                                            <input type="button" value="+" class="plus">
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal" data-title="{{ __('Total') }}">
                                                        {{ format_price($cartItem->price * $cartItem->qty) }}</td>
                                                    <td class="product-remove" data-title="{{ __('Remove') }}"><a
                                                            href="{{ route('public.cart.remove', $cartItem->rowId) }}"
                                                            class="remove-cart-button"><i class="ti-close"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="px-0">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                                    @if (!session()->has('applied_coupon_code'))
                                                        <div class="coupon field_form input-group form-coupon-wrapper">
                                                            <input type="text" name="coupon_code"
                                                                value="{{ old('coupon_code') }}"
                                                                class="form-control form-control-sm coupon-code"
                                                                placeholder="{{ __('Enter Coupon Code...') }}">
                                                            <div class="input-group-append">
                                                                <button
                                                                    class="btn btn-fill-out btn-sm btn-apply-coupon-code"
                                                                    type="button"
                                                                    data-url="{{ route('public.coupon.apply') }}">{{ __('Apply Coupon') }}</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (session('applied_coupon_code'))
                                                        <div class="mt-2 text-left">
                                                            <small><strong>{{ __('Coupon code: :code', ['code' => session('applied_coupon_code')]) }}</strong>
                                                                <a class="btn-remove-coupon-code text-danger"
                                                                    data-url="{{ route('public.coupon.remove') }}"
                                                                    href="javascript:void(0)"><i
                                                                        class="ti-close"></i></a></small>
                                                        </div>
                                                    @endif
                                                    <div class="coupon-error-msg text-left">
                                                        <small><span class="text-danger"></span></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="medium_divider"></div>
                        <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="border p-3 p-md-4">
                            <div class="heading_s1 mb-3">
                                <h6>{{ __('Cart Totals') }}</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>

                                        @if ($couponDiscountAmount > 0)
                                            <tr>
                                                <td class="cart_total_label">
                                                    {{ __('Coupon code discount amount') }}</td>
                                                <td class="cart_total_amount">
                                                    {{ format_price($couponDiscountAmount) }}</td>
                                            </tr>
                                        @endif
                                        @if ($promotionDiscountAmount)
                                            <tr>
                                                <td class="cart_total_label">{{ __('Discount promotion') }}</td>
                                                <td class="cart_total_amount">
                                                    {{ format_price($promotionDiscountAmount) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="cart_total_label">{{ __('Tax') }}</td>
                                            <td class="cart_total_amount">
                                                {{ format_price(Cart::instance('cart')->rawTax()) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">{{ __('Total') }}
                                                ({{ __('Shipping fees not included') }})</td>
                                            <td class="cart_total_amount">
                                                <strong>{{ format_price(Cart::instance('cart')->rawTotal() - $promotionDiscountAmount - $couponDiscountAmount) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-fill-out"
                                name="checkout">{{ __('Proceed To CheckOut') }}</button>
                        </div>
                    </div>
                </div>
            </form>

            @if (count($crossSellProducts) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="small_divider"></div>
                        <div class="divider"></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <div class="row shop_container grid">
                    <div class="col-12">
                        <div class="heading_s1">
                            <h3>{{ __('Customers who bought this item also bought') }}</h3>
                        </div>
                        <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20"
                            data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                            @foreach ($crossSellProducts as $crossSellProduct)
                                {!! Theme::partial('product-item-grid', ['product' => $crossSellProduct]) !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @else
            <p class="text-center">{{ __('Your cart is empty!') }}</p>
        @endif
    </div>
</div> --}}


<style>
    h1,
    h2,
    h3,
    div,
    span,
    p,
    a,
    i,
    button {
        /* color: var(--color-1st); */
    }

    .scrollup i {
        color: white;
    }
</style>

<section class="pb-20 pb-10 bg-gray-100 text-black">
    <div class="container">
        <p class="mx-auto my-3 text-gray-500 text-center"><span class="text-black">Cart</span> > Place Order > Pay >
            Order
            Complete</p>
        @if (Cart::instance('cart')->count() > 0)
            <form class="form--shopping-cart" method="post" action="{{ route('public.cart.update') }}">
                @csrf
                <div class="flex gap-6 flex-col md:flex-row text-black">
                    <div class="w-full flex flex-col gap-4">
                        @if (session()->has('success_msg'))
                            <div class="alert alert-success">
                                <span>{{ session('success_msg') }}</span>
                            </div>
                        @endif

                        @if (session()->has('error_msg'))
                            <div class="alert alert-warning">
                                <span>{{ session('error_msg') }}</span>
                            </div>
                        @endif

                        @if (isset($errors) && count($errors->all()) > 0)
                            <div class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {{-- <div
                            class="w-full text-sm bg-green-50 border-2 border-green-200 flex items-center justify-between p-3">
                            <div class="flex gap-2 items-center">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <p class="text-black">
                                    Buy <span class="font-semibold">$27.00</span> more to enjoy <span
                                        class="font-semibold">Free
                                        Standard Shipping!</span>
                                </p>
                            </div>
                            <p class="font-semibold flex gap-1 items-center cursor-pointer text-black">
                                <span>Add</span>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </p>
                        </div>
                        -- }}
                        {{-- <div class="bg-white flex justify-between p-3 shadow-md">
                            <label class="flex items-center gap-2 text-xl font-extrabold cursor-pointer">
                                <input type="checkbox" class="peer hidden" />
                                <i class="fa-solid fa-square-check !hidden peer-checked:!inline"></i>
                                <i class="fa-regular fa-square-check peer-checked:hidden"></i>
                                <p class="text-black">ALL ITEMS (2)</p>
                            </label>
                            <div class="flex items-center font-bold gap-1 text-sm">
                                <i class="fa-solid fa-list-check text-sm "></i>
                                <p>Select</p>
                            </div>
                        </div>
                        <div class="px-3 py-2 flex items-center justify-between bg-rose-50 shadow-sm text-sm">
                            <div class="flex flex-col gap-2">
                                <div class="font-semibold">Add-on items</div>
                                <p>Eligible to pick an Add-on item.</p>
                            </div>
                            <div>
                                <button class="bg-black py-1 px-5 text-center text-white">Pick</button>
                            </div>
                        </div> --}}

                        @if (isset($products) && $products)
                            @foreach (Cart::instance('cart')->content() as $key => $cartItem)
                                @php
                                    $product = $products->where('id', $cartItem->id)->first();
                                @endphp

                                @if (!empty($product))
                                    <div class="overflow-hidden !p-5 bg-white">
                                        <div class="flex flex-col">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                {{-- <input type="checkbox" class="peer hidden" />
                                                <i
                                                    class="fa-solid fa-square-check text-2xl !hidden peer-checked:!inline"></i>
                                                <i class="fa-regular fa-square-check text-2xl peer-checked:hidden"></i> --}}
                                                @if ($product->categories()->exists())
                                                    <div class="flex items-center gap-1 font-bold">
                                                        <i class="fa-solid fa-store text-black"></i>
                                                        <p class="text-black">
                                                            @foreach ($product->categories()->get() as $category)
                                                                <a href="{{ $category->url }}">{{ $category->name }}</a>
                                                                @if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <i class="fa fa-chevron-right text-black" aria-hidden="true"></i>
                                                @endif
                                            </label>

                                            <div class="flex items-center gap-3 flex-col md:flex-row">
                                                {{-- <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" class="peer hidden" />
                                                    <i
                                                        class="fa-solid fa-square-check text-xl !hidden peer-checked:!inline"></i>
                                                    <i
                                                        class="fa-regular fa-square-check text-xl peer-checked:hidden"></i>
                                                </label> --}}
                                                <img src="{{ RvMedia::getImageUrl($cartItem->options['image'], 'thumb', false, RvMedia::getDefaultImage()) }}"
                                                    alt="{{ $product->name }}"
                                                    class="max-h-[100px] max-w-[100px] object-contain" alt="">
                                                <div class="flex justify-between w-full flex-col gap-4">
                                                    <div class="flex flex-col">
                                                        <a href="{{ $product->original_product->url }}"
                                                            title="{{ $product->name }}"
                                                            class="w-full">{{ $product->name }}
                                                        </a>
                                                        @if ($product->isOutOfStock())
                                                            <span
                                                                class="stock-status-label">({!! $product->stock_status_html !!})</span>
                                                        @endif
                                                        <div class="flex justify-between">
                                                            <div
                                                                class="flex gap-1 font-semibold items-center flex-shrink-0">
                                                                {{-- <i class="fa fa-circle" aria-hidden="true"></i> --}}
                                                                {{ $cartItem->options['attributes'] ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <div class="font-bold">
                                                            <div
                                                                class="product__price @if ($product->front_sale_price != $product->price * $cartItem->qty) sale @endif">
                                                                <span>{{ format_price($cartItem->price * $cartItem->qty) }}</span>
                                                                @if ($product->front_sale_price != $product->price)
                                                                    <small><del>{{ format_price($product->price) }}</del></small>
                                                                @endif
                                                            </div>
                                                            <input type="hidden"
                                                                name="items[{{ $key }}][rowId]"
                                                                value="{{ $cartItem->rowId }}">
                                                        </div>
                                                        <div class="flex gap-5 items-center">
                                                            <div class="product-quantity"
                                                                data-title="{{ __('Quantity') }}">
                                                                <div class="quantity">
                                                                    <input type="button" value="-" class="minus">
                                                                    <input type="text" value="{{ $cartItem->qty }}"
                                                                        title="Qty" class="qty" size="4"
                                                                        name="items[{{ $key }}][values][qty]">
                                                                    <input type="button" value="+" class="plus">
                                                                </div>
                                                            </div>
                                                            {{-- <a href="#"> <i
                                                                    class="fas fa-search text-xs cursor-pointer"></i></a>
                                                            <a href="#"> <i
                                                                    class="fas fa-heart text-xs cursor-pointer"></i></a> --}}
                                                            <a href="{{ route('public.cart.remove', $cartItem->rowId) }}"
                                                                class="">
                                                                <i class="fas fa-trash text-xs cursor-pointer"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
            </form>

    </div>
    <div class="flex flex-col gap-8 flex-shrink-0">
        <div class="flex gap-8 flex-col md:sticky md:top-28">
            <div class="max-w-[360px] w-full bg-white p-4 flex flex-col gap-4 sticky">
                <p class="text-xl font-bold text-black">Order Summary</p>
                <div class="flex justify-between items-center">
                    <p class="text-md font-bold text-black">Estimated Price:</p>
                    <p class="text-xl font-bold text-black">
                        {{ format_price(Cart::instance('cart')->rawTotal() - $promotionDiscountAmount - $couponDiscountAmount) }}
                    </p>
                </div>
                {{-- <p class="text-right text-sm text-black">Reward <span class="text-orange-600">22</span>
                    OD Sports
                    Points</p>
                <button class="text-xl font-extrabold bg-black text-white px-6 py-3 w-full hover:bg-gray-600">
                    Checkout Now (2)
                </button> --}}
                @if (!session()->has('applied_coupon_code'))
                    <div class="coupon field_form input-group form-coupon-wrapper">
                        <input type="text" name="coupon_code" value="{{ old('coupon_code') }}"
                            class="form-control form-control-sm coupon-code"
                            placeholder="{{ __('Enter Coupon Code...') }}">
                        <div class="input-group-append">
                            <button class="btn btn-fill-out btn-sm btn-apply-coupon-code" type="button"
                                data-url="{{ route('public.coupon.apply') }}">{{ __('Apply Coupon') }}</button>
                        </div>
                    </div>
                @endif
                <button type="submit" class="btn btn-fill-out"
                    name="checkout">{{ __('Proceed To CheckOut') }}</button>
                <p class="text-xs text-gray-500">Apply a Coupon Code, <a href="#" class="font-semibold">OD Sports
                        Points</a>
                    to get free shipping</p>
            </div>
            <div class="max-w-[360px] w-full bg-white p-4 flex flex-col gap-4 sticky">
                <p class="text-xl font-bold text-black">We Accept</p>
                <div class="flex gap-5 text-3xl items-center flex-wrap">


                    @php
                        $paymentMethods = [
                            ['icon' => 'fa-brands fa-cc-visa'],
                            ['icon' => 'fa-brands fa-cc-mastercard'],
                            ['icon' => 'fa-brands fa-cc-stripe'],
                            ['icon' => 'fa-solid fa-money-bill-wave'],
                        ];
                    @endphp

                    @foreach ($paymentMethods as $paymentIcon)
                        <a href="#"><i class="{{ $paymentIcon['icon'] }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <span>{{ __('No products found') }}</span>
    </div>
    @endif
</section>

@if (isset($product))
    <section class="py-20 text-black">
        <div class="row container mx-auto shop_container grid mt-6">
            <div class="col-12">
                <div class="heading_s1">
                    <h3 class="text-center text-3xl font-bold">{{ __('Related Products') }}</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @php
                        $relatedProducts = get_related_products($product);
                    @endphp
                    @if (!empty($relatedProducts))
                        @foreach ($relatedProducts as $related)
                            {!! Theme::partial('product-item-grid', ['product' => $related]) !!}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
