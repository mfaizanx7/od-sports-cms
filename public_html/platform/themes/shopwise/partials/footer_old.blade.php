<footer class="bg-gray-100 pt-16 pb-10">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 text-xs container  mx-auto">
        <div class="flex flex-col justify-between gap-3 text-gray-500">
            <div class="grid grid-cols-2 md:grid-cols-3 flex-1">
                @php
                    $footerPrimaryLinks = [
                        [
                            'name' => "Company INFO",
                            'links' => ["About Ummati", "Fashion Blogger", "Social Responsibility", "Careers"]
                        ],
                        [
                            'name' => "HELP & SUPPORT",
                            'links' => ["Shipping Info", "Returns", "Refund", "How to Order", "How to Track", "Size Guide", "Ummati VIP"]
                        ],
                        [
                            'name' => "Customer Care",
                            'links' => ["Contact us", "Payment Method", "Bonus Point", "Klarna"]
                        ]
                    ];
                    
                    $footerSecondaryLinks = [
                        "Privacy Center",
                        "Privacy & Cookie Policy",
                        "Manage Cookies",
                        "Terms & Conditions",
                        "Marketplace IP Rules",
                        "IP Notice",
                        "Imprint",
                        "Ad Choice"
                    ];
                @endphp
                
                @foreach ($footerPrimaryLinks as $section)
                <div class="w-fit mb-6 md:mb-0">
                    <h3 class="font-semibold mb-3 text-black">{{ $section['name'] }}</h3>
                    <ul class="space-y-2">
                        @foreach ($section['links'] as $link)
                        <li>
                            <a href="#" class="hover:text-black transition-all transition-100">{{ $link }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            <div class="flex flex-col mt-4 md:mt-0">
                <p>©2009-2025 Ummati All Rights Reserved</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach ($footerSecondaryLinks as $link)
                    <a href="#"
                        class="pr-2 border-r border-gray-300 hover:text-black transition-all transition-100">{{ $link }}</a>
                    @endforeach
                    <a href="#" class="pr-2 gap-2 flex items-center hover:text-black transition-all transition-100">
                        <span>Pakistan</span>
                        <i class="fa-solid fa-location-dot"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col gap-6">
            <div class="flex gap-12 flex-col md:flex-row">
                <div class="flex flex-col gap-4">
                    <h3 class="font-bold">FIND US ON</h3>
                    <div class="flex gap-5 text-2xl items-center flex-wrap text-black">
                        @foreach ([
                            'fa-brands fa-facebook-f',
                            'fa-brands fa-instagram',
                            'fa-brands fa-twitter',
                            'fa-brands fa-youtube',
                            'fa-brands fa-pinterest-p',
                            'fa-brands fa-snapchat',
                            'fa-brands fa-tiktok',
                            'fa-brands fa-linkedin-in'
                        ] as $icon)
                        <a href="#"><i class="{{ $icon }}"></i></a>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <h3 class="font-bold">APP</h3>
                    <div class="flex gap-5 text-2xl items-center flex-wrap text-black">
                        @foreach ([
                            'fa-brands fa-apple',
                            'fa-brands fa-android'
                        ] as $icon)
                        <a href="#"><i class="{{ $icon }}"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div>
                <p class="font-bold p-2 text-black">Sign up for Ummati style news</p>
                <div class="inline-flex flex-col gap-5 w-full">
                    <div class="flex items-center justify-between gap-2 border bg-white">
                        <input type="email" placeholder="Your Email"
                            class="focus:outline-none bg-transparent w-full pl-2 text-sm"
                            required />
                        <button class="bg-black text-white  py-2 font-bold text-base px-2">
                            Subscribe
                        </button>
                    </div>
                    <div class="flex items-center justify-between gap-2 border bg-white">
                        <input type="tel" placeholder="Your Phone Number"
                            class="focus:outline-none bg-transparent w-full pl-2 text-sm" />
                        <button class="bg-black text-white  py-2 font-bold text-base px-2">
                            Subscribe
                        </button>
                    </div>
                    <div class="flex items-center justify-between gap-2 border bg-white">
                        <input type="text" placeholder="WhatsApp Account"
                            class="focus:outline-none bg-transparent w-full pl-2 text-sm" />
                        <button class="bg-black text-white  py-2 font-bold text-base px-2">
                            Subscribe
                        </button>
                    </div>
                </div>
                <p class="py-8 text-xs text-gray-500">
                    By clicking the SUBSCRIBE button, you are agreeing to our <a href="#" class="text-blue-600">Privacy
                        & Cookie Policy</a>
                </p>
            </div>
            
            <div class="flex flex-col gap-4">
                <h3 class="font-bold">WE ACCEPT</h3>
                <div class="flex gap-5 text-2xl items-center flex-wrap text-black">
                    @foreach ([
                        'fa-brands fa-cc-visa',
                        'fa-brands fa-cc-mastercard',
                        'fa-brands fa-cc-amex',
                        'fa-brands fa-cc-discover',
                        'fa-brands fa-cc-paypal',
                        'fa-brands fa-cc-stripe',
                        'fa-brands fa-google-pay',
                        'fa-brands fa-apple-pay',
                        'fa-brands fa-amazon-pay',
                        'fa-brands fa-cc-diners-club',
                        'fa-brands fa-cc-jcb',
                        'fa-solid fa-building-columns',
                        'fa-solid fa-wallet',
                        'fa-solid fa-money-bill-wave'
                    ] as $icon)
                    <a href="#"><i class="{{ $icon }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    @if (is_plugin_active('ecommerce') && EcommerceHelper::isCartEnabled())
    <div id="remove-item-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Warning') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to remove this product from cart?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-fill-out" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-fill-line confirm-remove-item-cart">{{ __('Yes, remove it!') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>
</footer>

<script>
    window.trans = {
        "No reviews!": "{{ __('No reviews!') }}",
        "Days": "{{ __('Days') }}",
        "Hours": "{{ __('Hours') }}",
        "Minutes": "{{ __('Minutes') }}",
        "Seconds": "{{ __('Seconds') }}",
    };

    window.siteUrl = "{{ route('public.index') }}";
</script>

{!! Theme::footer() !!}

@if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg))
    <script type="text/javascript">
        window.onload = function () {
            @if (session()->has('success_msg'))
                window.showAlert('alert-success', '{{ session('success_msg') }}');
            @endif

            @if (session()->has('error_msg'))
                window.showAlert('alert-danger', '{{ session('error_msg') }}');
            @endif

            @if (isset($error_msg))
                window.showAlert('alert-danger', '{{ $error_msg }}');
            @endif

            @if (isset($errors))
                @foreach ($errors->all() as $error)
                    window.showAlert('alert-danger', '{!! $error !!}');
                @endforeach
            @endif
        };
    </script>
@endif