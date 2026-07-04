<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! BaseHelper::googleFonts('https://fonts.googleapis.com/css2?family=' . urlencode(theme_option('primary_font', 'Poppins')) . ':wght@200;300;400;500;600;700;800;900&display=swap') !!}

        <style>
            :root {
                --color-1st: {{ theme_option('primary_color', '#FF324D') }};
                --color-2nd: {{ theme_option('secondary_color', '#1D2224') }};
                --primary-font: '{{ theme_option('primary_font', 'Poppins') }}', sans-serif;
            }
        </style>

        {!! Theme::header() !!}
    </head>
    <body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    @if (theme_option('preloader_enabled', 'no') == 'yes')
        <!-- LOADER -->
        <div class="preloader">
            <div class="lds-ellipsis">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- END LOADER -->
    @endif

    <div id="alert-container"></div>

    @if (is_plugin_active('newsletter') && theme_option('enable_newsletter_popup', 'yes') === 'yes')
        <div data-session-domain="{{ config('session.domain') ?? request()->getHost() }}"></div>
        <!-- Home Popup Section -->
        <div class="modal fade subscribe_popup" id="newsletter-modal" data-time="{{ (int)theme_option('newsletter_show_after_seconds', 10) * 1000 }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                        </button>
                        <div class="row no-gutters">
                            <div class="col-sm-5">
                                @if (theme_option('newsletter_image'))
                                    <div class="background_bg h-100" data-img-src="{{ RvMedia::getImageUrl(theme_option('newsletter_image')) }}"></div>
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <div class="popup_content">
                                    <div class="popup-text">
                                        <div class="heading_s4">
                                            <h4>{{ __('Subscribe and Get 25% Discount!') }}</h4>
                                        </div>
                                        <p>{{ __('Subscribe to the newsletter to receive updates about new products.') }}</p>
                                    </div>
                                    <form method="post" action="{{ route('public.newsletter.subscribe') }}" class="newsletter-form">
                                        @csrf
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control rounded-0" placeholder="{{ __('Enter Your Email') }}">
                                        </div>

                                        @if (setting('enable_captcha') && is_plugin_active('captcha'))
                                            <div class="form-group">
                                                {!! Captcha::display() !!}
                                            </div>
                                        @endif

                                        <div class="chek-form text-left form-group">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="dont_show_again" id="dont_show_again" value="">
                                                <label class="form-check-label" for="dont_show_again"><span>{{ __("Don't show this popup again!") }}</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block text-uppercase rounded-0" type="submit" style="background: #333; color: #fff;">{{ __('Subscribe') }}</button>
                                        </div>

                                        <div class="form-group">
                                            <div class="newsletter-message newsletter-success-message" style="display: none"></div>
                                            <div class="newsletter-message newsletter-error-message" style="display: none"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Screen Load Popup Section -->
    @endif

    <!-- START HEADER -->
    <header class="header_wrap @if (theme_option('enable_sticky_header', 'yes') == 'yes') fixed-top header_with_topbar @endif">
        <!-- Navbar -->
        <div class="relative sticky top-0 z-50">

            @include('partials.landing.navbar')

            <!-- Category Grid Section -->
            <section class="w-full shadow-md border-b m-auto text-black">
                <div class="flex md:gap-4 mx-auto container">
                    <a class="group flex items-center gap-1 flex-shrink-0 hover:bg-gray-100 cursor-pointer py-2 px-2 navcatlink"
                        id="navcatlink" href="{{ url('products') }}">
                        Categoriessss
                        <i
                            class="fa-solid fa-chevron-down transform transition-transform duration-300 group-hover:rotate-180"></i>
                    </a>
                    <div class="flex overflow-x-auto scroll-smooth w-full" id="nav-category-slider"
                        style="
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                ">
                        @foreach ($categories as $category)
                            <a href="{{ $category->url }}"
                                class="flex-shrink-0 hover:bg-gray-100 cursor-pointer py-2 px-2 navcatlink flex items-center category"
                                data-category="{{ strtolower($category->name) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-5 pl-2 ">
                        <button id="category-nav-scroll-left" class="z-10 hidden md:block">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button id="category-nav-scroll-right" class=" z-10 hidden md:block">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </section>
    <!-- END HEADER -->
