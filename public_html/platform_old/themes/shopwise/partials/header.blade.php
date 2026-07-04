<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
        name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! BaseHelper::googleFonts(
        'https://fonts.googleapis.com/css2?family=' .
            urlencode(theme_option('primary_font', 'Poppins')) .
            ':wght@200;300;400;500;600;700;800;900&display=swap',
    ) !!}

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#000000',
                        secondary: '#000000',
                    }
                }
            }
        }
    </script>

    <style>
        .breadcrumb_section.bg_gray.page-title-mini {
            display: none;
        }

        :root {
            --color-1st: #000000;
            --color-2nd: #000000;
            --primary-font: '{{ theme_option(' primary_font', ' Poppins') }}',
                sans-serif;
        }

        /* Scrollbar for WebKit browsers */
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: gray;
        }

        .scrollbar-thin::-webkit-scrollbar-button {
            height: 0px;
            background-color: #ccc;
        }
        #google_translate_element{
        display:none;
        }


        /* Preloader styles */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis span {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: var(--color-1st);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis span:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis span:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis span:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis span:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }
    </style>

    {!! Theme::header() !!}
</head>

<body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif class="flex flex-col min-h-screen">
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    @if (theme_option('preloader_enabled', 'no') == 'yes')
        <!-- LOADER -->
        <div class="preloader">
            <div class="lds-ellipsis">
                <span></span>
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
        <div class="modal fade subscribe_popup" id="newsletter-modal"
            data-time="{{ (int) theme_option('newsletter_show_after_seconds', 10) * 1000 }}" data-backdrop="static"
            data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                        </button>
                        <div class="row no-gutters">
                            <div class="col-sm-5">
                                @if (theme_option('newsletter_image'))
                                    <div class="background_bg h-100"
                                        data-img-src="{{ RvMedia::getImageUrl(theme_option('newsletter_image')) }}">
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <div class="popup_content">
                                    <div class="popup-text">
                                        <div class="heading_s4">
                                            <h4>{{ __('Subscribe and Get 25% Discount!') }}</h4>
                                        </div>
                                        <p>{{ __('Subscribe to the newsletter to receive updates about new products.') }}
                                        </p>
                                    </div>
                                    <form method="post" action="{{ route('public.newsletter.subscribe') }}"
                                        class="newsletter-form">
                                        @csrf
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control rounded-0"
                                                placeholder="{{ __('Enter Your Email') }}">
                                        </div>

                                        @if (setting('enable_captcha') && is_plugin_active('captcha'))
                                            <div class="form-group">
                                                {!! Captcha::display() !!}
                                            </div>
                                        @endif

                                        <div class="chek-form text-left form-group">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="dont_show_again"
                                                    id="dont_show_again" value="">
                                                <label class="form-check-label"
                                                    for="dont_show_again"><span>{{ __("Don't
                                                                                                                                                            show this popup again!") }}</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block text-uppercase rounded-0" type="submit"
                                                style="background: #333; color: #fff;">{{ __('Subscribe') }}</button>
                                        </div>

                                        <div class="form-group">
                                            <div class="newsletter-message newsletter-success-message"
                                                style="display: none"></div>
                                            <div class="newsletter-message newsletter-error-message"
                                                style="display: none">
                                            </div>
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
        <div class="relative sticky top-0 bg-white z-50">
            <nav class="bg-white">
                <div class="flex flex-col lg:flex-row gap-3  py-2 items-center container justify-between m-auto">
                    <!-- Logo -->
                    <a class="text-4xl font-bold tracking-widest order-1 text-black" href="/">
                        <img src="{{ Storage::URL('general/final-ummatti-logo-06-3.webp') }}" class="max-h-[50px]"
                            alt="">
                    </a>

                    <!-- Icon buttons -->
                    <div class="flex gap-3 items-center justify-between order-2 lg:order-3">
                        @php
                            $icons = [
                                [
                                    'icon' => 'fa-regular fa-user',
                                    'link' => auth('customer')->check()
                                        ? route('customer.overview')
                                        : route('customer.login'),
                                ],
                                [
                                    'icon' => 'fa-solid fa-cart-shopping',
                                    'count' => Cart::instance('cart')->count(),
                                    'link' => '/cart',
                                    'customClass' => 'navcartlink',
                                ],
                                [
                                    'icon' => 'fa-regular fa-heart',
                                    'count' => auth('customer')->check()
                                        ? auth('customer')->user()->wishlist()->count()
                                        : Cart::instance('wishlist')->count(),
                                    'link' => route('public.wishlist'),
                                    'customClass' => 'navwishlistlink',
                                ],
                                //['icon' => 'fa-solid fa-robot'],
                                ['icon' => 'fa-solid fa-globe', 'customClass' => 'navlanglink'],
                            ];
                        @endphp

                        @foreach ($icons as $icon)
                            <a href="{{ $icon['link'] ?? '#!' }}"
                                role="{{ isset($icon['link']) ? 'link' : 'button' }}"
                                class="text-xl text-gray-600 {{ $icon['customClass'] ?? '' }}">
                                <i class="{{ $icon['icon'] }}"></i>
                                @isset($icon['count'])
                                    <span class="count">{{ $icon['count'] }}</span>
                                @endisset
                                @if (isset($icon['customClass']) && $icon['customClass'] == 'navlanglink')
                                    <span id="languageText" translate="no">EN</span>
                                @endif
                            </a>
                        @endforeach

                    </div>

                    <!-- Search bar -->
                    <div class="max-w-lg w-full order-3 lg:order-2">
                        <form action="{{ route('public.products') }}" method="GET"
                            class="flex items-center justify-between gap-2 border !border-black">
                            <input name="q" type="search"
                                class="focus-within:outline-none focus:outline-none bg-transparent w-full pl-2 text-sm text-black"
                                placeholder="Search" value="{{ request()->query('q') }}" />
                            <button type="submit" class="bg-black !text-white px-2 py-1">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Category Grid Section -->
            <section class="w-full shadow-md border-b m-auto text-black">
                <div class="flex md:gap-4 mx-auto container">
                    <a class="group flex items-center gap-1 flex-shrink-0 hover:bg-gray-100 cursor-pointer py-2 px-2 navcatlink"
                        id="navcatlink" href="{{ url('products') }}">
                        Categories
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

            <!-- Mega Menu -->
            <section class="bg-white hidden absolute z-30 m-auto h-[543px] w-full top-[6.5rem] megaMenu"
                id="megaMenu">
                <div class="grid grid-cols-2 container max-h-[543px] mx-auto w-full  py-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div
                            class="flex flex-col w-full gap-3 border-r pr-3 overflow-y-auto max-h-[515px] scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">

                            <a href="{{ url('products') }}" data-category="all"
                                class="flex items-center justify-between cursor-pointer gap-1 hover:bg-gray-100 p-2 text-sm text-black category">
                                ✨ See All <i class="fa-solid fa-chevron-right"></i>
                            </a>

                            @foreach ($categories as $category)
                                <a href="{{ $category->url }}" data-category="{{ strtolower($category->name) }}"
                                    class="flex items-center justify-between cursor-pointer gap-1 hover:bg-gray-100 p-2 text-sm text-black category">
                                    {{ $category->name }} <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            @endforeach
                        </div>

                        <div>
                            <h3 class="font-semibold pb-4 text-orange-700">
                                <i class="fas fa-grip-vertical"></i>
                                Shop By Category
                            </h3>
                            <div
                                class="grid grid-cols-3 gap-y-6 border-r max-w-full overflow-y-scroll overflow-x-hidden max-h-[490px] scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
                                @foreach ($categories as $category)
                                    <a href="{{ $category->url }}"
                                        class="flex items-center flex-col cursor-pointer gap-1 category"
                                        data-category="{{ strtolower($category->name) }}">
                                        <div
                                            class="w-16 h-16 hover:shadow-md hover:scale-110 transition-all transition-100 bg-gray-100 rounded-full overflow-hidden">
                                            <img src="{{ RvMedia::getImageUrl($category->image) }}"
                                                alt="{{ $category->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="text-xs text-center">{{ $category->name }}</div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-6 gap-y-6 border-r max-w-full overflow-y-scroll overflow-x-hidden max-h-[532px] scrollbar-thin"
                            style="align-items: start;">
                            @foreach ($products as $product)
                                <a href="{{ $product->url }}"
                                    class="flex items-center flex-col cursor-pointer gap-1 productMegaMenu max-h-[6rem]">
                                    <div
                                        class="w-16 h-16 hover:shadow-md hover:scale-110 transition-all transition-100 bg-gray-100 rounded-full overflow-hidden">
                                        <img src="{{ $product->image ? RvMedia::getImageUrl($product->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVexbIiWyTky-4BdgYOU0MNrSp3XrmchEtBA&s' }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="text-xs text-center">{{ $product->name }}</div>
                                    @if ($product->categories()->exists())
                                        <div class="hidden category-product">
                                            @foreach ($product->categories()->get() as $category)
                                                {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cart Popup -->

            <div class="cart hidden" id="cart">
                <section
                    class="bg-white hidden absolute z-30 m-auto max-h-[500px] w-[400px] right-7 top-12 cart shadow-md overflow-y-auto">
                    <!-- Cart content will be loaded via AJAX -->
                    <div class="p-8 flex flex-col items-center justify-center">
                        <i class="fa fa-spinner fa-spin text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-center">Loading cart...</p>
                    </div>
                </section>
            </div>


            {{-- language Popup --}}
            @php

                $languageLinks = [
                    [
                        'img_src' => 'https://flagcdn.com/w20/eg.png',
                        'language_name' => 'العربية',
                        'function_params' => ['ar', 'eg', 'العربية'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/pk.png',
                        'language_name' => 'اردو',
                        'function_params' => ['ur', 'pk', 'اردو'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/cn.png',
                        'language_name' => '中文',
                        'function_params' => ['zh-CN', 'cn', '中文'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/nl.png',
                        'language_name' => 'Nederlands',
                        'function_params' => ['nl', 'nl', 'Nederlands'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/gb.png',
                        'language_name' => 'English',
                        'function_params' => ['en', 'gb', 'English'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/fr.png',
                        'language_name' => 'Français',
                        'function_params' => ['fr', 'fr', 'Français'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/de.png',
                        'language_name' => 'Deutsch',
                        'function_params' => ['de', 'de', 'Deutsch'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/in.png',
                        'language_name' => 'हिंदी',
                        'function_params' => ['hi', 'in', 'हिंदी'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/it.png',
                        'language_name' => 'Italiano',
                        'function_params' => ['it', 'it', 'Italiano'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/pt.png',
                        'language_name' => 'Português',
                        'function_params' => ['pt', 'pt', 'Português'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/ru.png',
                        'language_name' => 'Русский',
                        'function_params' => ['ru', 'ru', 'Русский'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/se.png',
                        'language_name' => 'Svenska',
                        'function_params' => ['sv', 'se', 'Svenska'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/es.png',
                        'language_name' => 'Español',
                        'function_params' => ['es', 'es', 'Español'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/ae.png',
                        'language_name' => 'العربية',
                        'function_params' => ['ar', 'ae', 'العربية'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/kr.png',
                        'language_name' => '한국어',
                        'function_params' => ['ko', 'kr', '한국어'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/jp.png',
                        'language_name' => '日本語',
                        'function_params' => ['ja', 'jp', '日本語'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/tr.png',
                        'language_name' => 'Türkçe',
                        'function_params' => ['tr', 'tr', 'Türkçe'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/pl.png',
                        'language_name' => 'Polski',
                        'function_params' => ['pl', 'pl', 'Polski'],
                    ],
                    /*[
            'img_src' => 'https://flagcdn.com/w20/br.png',
            'language_name' => 'Português (Brasil)',
            'function_params' => ['pt-BR', 'br', 'Português (Brasil)'],
            ],*/
                    [
                        'img_src' => 'https://flagcdn.com/w20/th.png',
                        'language_name' => 'ไทย',
                        'function_params' => ['th', 'th', 'ไทย'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/vn.png',
                        'language_name' => 'Tiếng Việt',
                        'function_params' => ['vi', 'vn', 'Tiếng Việt'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/id.png',
                        'language_name' => 'Bahasa Indonesia',
                        'function_params' => ['id', 'id', 'Bahasa Indonesia'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/ua.png',
                        'language_name' => 'Українська',
                        'function_params' => ['uk', 'ua', 'Українська'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/us.png',
                        'language_name' => 'English (US)',
                        'function_params' => ['en', 'us', 'English (US)'],
                    ],
                    [
                        'img_src' => 'https://flagcdn.com/w20/sa.png',
                        'language_name' => 'العربية (السعودية)',
                        'function_params' => ['ar', 'sa', 'العربية (السعودية)'],
                    ],
                ];

            @endphp
            {{-- <div class="languageDropdown hidden" id="languageDropdown">
                <section
                    class="bg-white hidden absolute z-30 m-auto max-h-[500px] w-[140px] right-7 top-12 languageDropdown shadow-md overflow-y-auto">
                    <!-- Cart content will be loaded via AJAX -->
                    <div class="p-8 flex flex-col items-center justify-center">
                        <div class=" notranslate" translate="no" class="flex flex-col gap-2">
                            @foreach ($languageLinks as $link)
                            <a href="#" class="flex items-center gap-3 " onclick="selectLanguage({{ "'" . implode("'
                                ,'", $link['function_params']) . "'" }})">
                                <span class="flag flex-shrink-0">
                                    <img src="{{ $link['img_src'] }}" alt="{{ $link['language_name'] }}">
                                </span>
                                {{ $link['language_name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div> --}}
            <div class="languageDropdown hidden" id="languageDropdown">
                <section
                    class="bg-white hidden absolute z-30 m-auto max-h-[500px] w-[150px] right-7 top-[6.4rem] lg:top-12 languageDropdown rounded-lg shadow-md overflow-y-auto"
                    dir="ltr">
                    <div class="p-2 flex flex-col items-center justify-center">
                        <div class=" notranslate flex flex-col gap-2" translate="no" class="flex flex-col gap-2">
                            @foreach ($languageLinks as $link)
                                <a href="#" class="flex items-center gap-3 "
                                    onclick="selectLanguage({{ "'" .
                                        implode(
                                            "'
                                                                                                        ,'",
                                            $link['function_params'],
                                        ) .
                                        "'" }})">
                                    <span class="flag flex-shrink-0">
                                        <img src="{{ $link['img_src'] }}" alt="{{ $link['language_name'] }}">
                                    </span>
                                    {{ $link['language_name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </header>

    <!-- END HEADER -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Menu opener function
        const MenuOpener = (OpenBtnClass, MenuClass) => {
            let timeout;
            let isMenuVisible = false; // Track menu state for click

            // Hover open
            $(`${OpenBtnClass}, ${MenuClass}`).on("mouseenter", function() {
                clearTimeout(timeout);
                $(MenuClass).removeClass("hidden");
                isMenuVisible = true;
            });

            // Hover close
            $(`${OpenBtnClass}, ${MenuClass}`).on("mouseleave", function() {
                timeout = setTimeout(() => {
                    $(MenuClass).addClass("hidden");
                    isMenuVisible = false;
                }, 150);
            });

            // Click toggle
            $(OpenBtnClass).on("click", function(e) {
                e.preventDefault(); // Prevent link navigation if button is <a>
                clearTimeout(timeout);

                if (isMenuVisible) {
                    $(MenuClass).addClass("hidden");
                } else {
                    $(MenuClass).removeClass("hidden");
                }
                isMenuVisible = !isMenuVisible;
            });
        };


        // Slider navigation function
        const sliderLeftRightButtonFunc = (buttonLeft, buttonRight, slider) => {
            const sliderElement = document.getElementById(slider);
            const scrollLeftBtn = document.getElementById(buttonLeft);
            const scrollRightBtn = document.getElementById(buttonRight);

            if (!sliderElement || !scrollLeftBtn || !scrollRightBtn) return;

            scrollLeftBtn.addEventListener("click", () => {
                sliderElement.scrollBy({
                    left: -250,
                    behavior: "smooth"
                });
            });

            scrollRightBtn.addEventListener("click", () => {
                sliderElement.scrollBy({
                    left: 250,
                    behavior: "smooth"
                });
            });
        }

        // Initialize on document ready
        $(document).ready(function() {
            // Menu functionality
            MenuOpener(".navlanglink", ".languageDropdown")
            if (document.body.clientWidth >= 768) {
                MenuOpener(".navcatlink", ".megaMenu")
                MenuOpener(".navcartlink", ".cart")
            }

            // Slider functionality
            sliderLeftRightButtonFunc("category-nav-scroll-left", "category-nav-scroll-right",
                "nav-category-slider");

            // Hide preloader after page load
            @if (theme_option('preloader_enabled', 'no') == 'yes')
                setTimeout(() => {
                    $('.preloader').fadeOut();
                }, 1000);
            @endif
        });

        $(".category").mouseenter(function() {
            const hoveredCategory = $(this).data("category");

            if (hoveredCategory === "all") {
                $(".productMegaMenu").show();
                return;
            }

            $(".productMegaMenu").each(function() {
                const categories = $(this).find(".category-product").text().toLowerCase().split(',');

                const match = categories.some(cat => cat.trim() === hoveredCategory);

                if (match) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    </script>

    <script>
        // ... existing JavaScript ...

        // Function to refresh cart content
        function refreshCart() {
            $.ajax({
                url: "{{ route('public.ajax.cart') }}",
                type: 'GET',
                beforeSend: function() {
                    $('#cart').html(`
                    <section
                    class="bg-white absolute z-30 m-auto max-h-[500px] w-[400px] right-7 top-12 cart shadow-md overflow-y-auto">
                    <!-- Cart content will be loaded via AJAX -->
                    <div class="p-8 flex flex-col items-center justify-center">
                        <i class="fa fa-spinner fa-spin text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-center">Loading cart...</p>
                    </div>
                </section>
                `);
                },
                success: function(response) {
                    $('#cart').html(response.data.html);
                    $('.navcartlink .count').text(response.data.count);
                    initCartEvents();
                },
                error: function() {
                    $('#cart').html(`
                    <div class="p-8 flex flex-col items-center justify-center">
                        <i class="fa-solid fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                        <p class="text-red-500 text-center">Failed to load cart</p>
                        <button onclick="refreshCart()" class="mt-4 bg-gray-200 px-4 py-2 rounded text-sm">
                            Retry
                        </button>
                    </div>
                `);
                }
            });
        }

        function refreshWishlist() {
            $.ajax({
                url: "{{ route('public.ajax.wishlist') }}",
                type: 'GET',
                success: function(response) {
                    $('.navwishlistlink .count').text(response.data.count);
                }
            });
        }


        // Initialize cart events
        function initCartEvents() {
            // Remove item from cart
            $(document).on('click', '.remove-cart-button', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function() {
                        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function() {
                        refreshCart();
                        // Update cart count in header
                        const cartCount = parseInt($('.navcartlink span').text());
                        $('.navcartlink span').text(cartCount - 1);
                    },
                    error: function() {
                        alert('Failed to remove item from cart');
                    }
                });
            });

            // Update quantity
            $(document).on('change', '.item-quantity-input', function() {
                const rowId = $(this).data('rowid');
                const newQty = $(this).val();

                $.ajax({
                    url: "{{ route('public.cart.update') }}",
                    type: 'POST',
                    data: {
                        rowId: rowId,
                        qty: newQty,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        refreshCart();
                    },
                    error: function() {
                        alert('Failed to update quantity');
                    }
                });
            });

            // Checkbox handling
            $(document).on('change', '.js-checkbox', function() {
                const $container = $(this).closest('.custom-checkbox');
                const isChecked = $(this).prop('checked');

                $container.find('.js-checked-icon').toggleClass('hidden', !isChecked);
                $container.find('.js-unchecked-icon').toggleClass('hidden', isChecked);
            });
        }

        // Initialize on document ready
        $(document).ready(function() {
            // ... existing initialization ...

            // Load cart initially
            refreshCart();

            // Also refresh cart when cart icon is hovered
            $('.navcartlink').on('mouseenter', function() {
                refreshCart();
            });

            $(document).on('click', '.add-to-cart-button', function(event) {
                setTimeout(refreshCart, 600)
            })

            $(document).on('click', '.js-add-to-wishlist-button', () => {
                setTimeout(refreshWishlist, 600)
            })

            // console.log($(".add-to-cart-form"))

            // $('.add-to-cart-form').on('submit', function(e) {
            //     alert('hi')
            //     setTimeout(refreshCart, 600)
            // })

        });
    </script>

    <script>
        const countryToLang = {
            'US': 'en', // English
            'GB': 'en', // English
            'FR': 'fr', // French
            'DE': 'de', // German
            'ES': 'es', // Spanish
            'IT': 'it', // Italian
            'RU': 'ru', // Russian
            'CN': 'zh-CN', // Chinese (Simplified)
            'JP': 'ja', // Japanese
            'KR': 'ko', // Korean
            'SA': 'ar', // Arabic
            'EG': 'ar', // Arabic
            'AE': 'ar', // Arabic
            'IN': 'hi', // Hindi
            'PK': 'ur', // Urdu
            'PT': 'pt', // Portuguese (Portugal)
            //'BR': 'pt-BR',   // Portuguese (Brazil)
            'TR': 'tr', // Turkish
            'PL': 'pl', // Polish
            'NL': 'nl', // Dutch
            'SE': 'sv', // Swedish
            'TH': 'th', // Thai
            'VN': 'vi', // Vietnamese
            'ID': 'id', // Indonesian
            'UA': 'uk' // Ukrainian
        };


        let userLang = 'en'; // fallback language
        let pageDir = 'ltr'; // fallback direction

        // Check for saved language
        const savedLang = localStorage.getItem('selectedLang');
        if (savedLang) {
            userLang = savedLang;
        }

        // If no saved language, try IP-based detection
        if (!savedLang) {
            fetch('https://ipwhois.app/json/')
                .then(res => res.json())
                .then(data => {
                    const countryCode = data.country_code;
                    userLang = countryToLang[countryCode] || 'en';
                    setPageLanguage(userLang);
                })
                .catch(err => {
                    console.warn('Geo fetch failed:', err);
                    setPageLanguage(userLang);
                });
        } else {
            setPageLanguage(userLang);
        }

        function setPageLanguage(langCode) {
            const rtlLangs = ['ar', 'he', 'ur'];
            const dir = rtlLangs.includes(langCode) ? 'rtl' : 'ltr';
            document.documentElement.setAttribute('lang', langCode);
            // document.documentElement.setAttribute('dir', dir);

            loadTranslateScript();
        }

        function toggleDropdown() {
            document.getElementById("languageDropdown").classList.toggle("hidden");
        }

        function selectLanguage(code, flagCode, name) {
            document.getElementById("languageDropdown").classList.remove("active");

            const rtlLangs = ['ar', 'he', 'ur'];
            const dir = rtlLangs.includes(code) ? 'rtl' : 'ltr';
            document.documentElement.setAttribute('lang', code);
            // document.documentElement.setAttribute('dir', dir);

            localStorage.setItem('selectedLang', code);
            $("#languageText").text(code.toUpperCase())

            triggerTranslation(code);
        }

        //language text on refresh add the selected language if found in local storage
        window.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('selectedLang') || 'en';

            const rtlLangs = ['ar', 'he', 'ur'];
            const dir = rtlLangs.includes(savedLang) ? 'rtl' : 'ltr';

            document.documentElement.setAttribute('lang', savedLang);
            // document.documentElement.setAttribute('dir', dir);

            // Show the short uppercase language code
            document.getElementById("languageText").textContent = savedLang.toUpperCase();

            triggerTranslation(savedLang);
        });

        function loadTranslateScript() {
            const script = document.createElement('script');
            script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
            document.body.appendChild(script);
        }

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                autoDisplay: false
            }, 'google_translate_element');

            setTimeout(() => {
                triggerTranslation(userLang);
                hideTranslateUI();
            }, 2000);
        }

        function triggerTranslation(langCode) {
            const interval = setInterval(() => {
                const selects = document.querySelectorAll("select.goog-te-combo");
                if (selects.length > 0) {
                    const select = selects[selects.length - 1]; // use the last dropdown
                    if (select.value !== langCode) {
                        select.value = langCode;
                        select.dispatchEvent(new Event("change"));
                    }
                    clearInterval(interval);
                } else {
                    console.log('Waiting for Google Translate dropdown...');
                }
            }, 500);
        }

        function hideTranslateUI() {
            const hideStyles = document.createElement('style');
            hideStyles.textContent = `
            .goog-te-banner-frame, 
            .goog-te-menu-frame, 
            .skiptranslate, 
            .goog-te-combo, 
            .goog-te-gadget, 
            .goog-te-menu-value, 
            .goog-te-balloon-frame, 
            .goog-te-spinner-pos, 
            .goog-tooltip, 
            .goog-te-ftab, 
            .goog-te-footer {
                display: none !important;
                visibility: hidden !important;
                height: 0 !important;
                width: 0 !important;
                position: absolute !important;
                pointer-events: none !important;
            }
            body {
                top: 0 !important;
            }
            .goog-text-highlight {
                background: none !important;
                border: none !important;
                box-shadow: none !important;
            }
        `;
            document.head.appendChild(hideStyles);
        }

        // Close dropdown on outside click
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button') && !event.target.closest('.dropdown-button')) {
                document.getElementById("languageDropdown").classList.remove("active");
            }
        }
    </script>

    <div id="google_translate_element"></div>

    @yield('scripts')
    <script>
        window.addEventListener('load', function() {
        var style = document.createElement('style');
        style.innerHTML = `
            .skiptranslate iframe {
                visibility: hidden !important;
            }
        `;
        document.head.appendChild(style);
    });
    </script>
</body>

</html>
