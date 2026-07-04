<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo">
                    <img src="{{ asset('favicon.jpeg') }}" alt="OD Sports" style="max-height: 45px; display: block; filter: invert(1) hue-rotate(180deg); mix-blend-mode: screen;">
                </div>
                <p>Powering sports experiences on and off the field. We bring energy, professionalism, and passion to every project.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-nav">
                <h3>SERVICES</h3>
                <ul>
                    <li><a href="{{ route('public.services.event-management') }}">Event Management</a></li>
                    <li><a href="{{ route('public.services.media-production') }}">Media Production</a></li>
                    <li><a href="{{ route('public.services.sports-marketing') }}">Sports Marketing</a></li>
                    <li><a href="{{ route('public.services.campaign-design') }}">Campaign Design</a></li>
                    <li><a href="{{ route('public.services.influencer-marketing') }}">Influencer Marketing</a></li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3>SHOP</h3>
                <ul>
                    <li><a href="/products">Men's Apparel</a></li>
                    <li><a href="/products">Women's Apparel</a></li>
                    <li><a href="/products">Equipment</a></li>
                    <li><a href="/products">Accessories</a></li>
                    <li><a href="/products">New Arrivals</a></li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3>CONTACT US</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Sports Avenue, Stadium District, NY 10001</li>
                    <li><i class="fas fa-phone-alt"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> hello@odsports.com</li>
                    <li style="margin-top: 18px;">
                        <a href="https://wa.me/923201223359?text=Hi%20OD%20Sports%2C%20I%20would%20like%20to%20chat!" target="_blank" rel="noopener noreferrer" style="text-decoration: none; display: inline-flex; align-items: center; gap: 12px; background: rgba(37, 211, 102, 0.1); border: 1px solid rgba(37, 211, 102, 0.25); border-radius: 10px; padding: 10px 16px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(37,211,102,0.2)'; this.style.borderColor='rgba(37,211,102,0.5)';" onmouseout="this.style.background='rgba(37,211,102,0.1)'; this.style.borderColor='rgba(37,211,102,0.25)';">
                            <i class="fab fa-whatsapp" style="font-size: 26px; color: #25D366;"></i>
                            <span style="color: #fff; font-size: 13px; font-weight: 600;">Chat with us</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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

<script src="{{ asset('landing-assets/script.js') }}"></script>

</body>

</html>