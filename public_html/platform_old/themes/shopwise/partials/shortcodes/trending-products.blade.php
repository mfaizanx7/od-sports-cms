<!-- START SECTION SHOP -->
{{-- <div class="section small_pt small_pb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <h4>{!! BaseHelper::clean($title) !!}</h4>
                    </div>
                    <div class="view_all">
                        <a href="{{ route('public.products') }}" class="text_default"><i class="linearicons-power"></i> <span>{{ __('View All') }}</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <trending-products-component url="{{ route('public.ajax.trending-products') }}"></trending-products-component>
        </div>
    </div>
</div> --}}
<!-- END SECTION SHOP -->

<div class=" pt-14 pb-20">

<h2 class="text-center text-3xl font-bold pb-6">Recommend</h2>

<trending-products-component url="{{ route('public.ajax.trending-products') }}"></trending-products-component>
</div>
