<!-- START SECTION SHOP -->
{{-- <div class="section pt-0 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <h4>{!! isset($title) ? BaseHelper::clean($title) : null !!}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <flash-sale-products-component url="{{ route('public.ajax.get-flash-sales') }}"></flash-sale-products-component>
        </div>
    </div>
</div> --}}
<!-- END SECTION SHOP -->

<style>
    #super-deals-slider::-webkit-scrollbar {
        display: none;
    }
</style>



<div class="bg-cover bg-no-repeat my-10 py-6 rounded-md"
    style="background-image: url('{{ Storage::URL('gradientHotDealsBg.webp') }}');">
    <div class="flex justify-between pb-6 px-4">
        <h2 class="text-left text-3xl font-bold ">🔥 Super Deals</h2>
        <div class="text-xl hidden md:block text-black">
            Save big now! <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
    <div class="relative">
        <!-- Scrollable Container -->
        {{-- <flash-sale-products-component url="{{ route('public.ajax.get-flash-sales') }}"></flash-sale-products-component> --}}
        <flash-sale-products-component url="{{ route('public.ajax.trending-products') }}"></flash-sale-products-component>
    </div>
</div>
