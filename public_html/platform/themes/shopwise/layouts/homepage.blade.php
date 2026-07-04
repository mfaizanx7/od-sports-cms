{!! Theme::partial('header') !!}

<style>
    .section.small_pt.pb-0, .section.product-blocks, .section.pt-0.small_pb, .section.bg_redon, .section.bg_default.small_pt.small_pb, .row.no-gutters {
        display: none;
    }
</style>

<main class="flex-1 container w-full mx-auto !px-0 ">
    {!! Theme::content() !!}
</main>

{!! Theme::partial('footer') !!}
