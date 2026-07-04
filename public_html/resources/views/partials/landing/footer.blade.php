<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-nav">
                <h3 style="color: var(--primary-color);">CONTACT US</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> {!! theme_option('global_company_address', 'Blue Area, Islamabad') !!}</li>
                    <li><i class="fas fa-phone-alt"></i> {!! theme_option('global_company_phone', '+92 320 1223359') !!}</li>
                    <li><i class="fas fa-envelope"></i> {!! theme_option('global_company_email', 'hello@odsports.com') !!}</li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3 style="color: var(--primary-color);">SERVICES</h3>
                <ul>
                    <li><a href="{{ route('public.services.event-management') }}">Event Management</a></li>
                    <li><a href="{{ route('public.services.media-production') }}">Media Production</a></li>
                    <li><a href="{{ route('public.services.sports-marketing') }}">Sports Marketing</a></li>
                    <li><a href="{{ route('public.services.campaign-design') }}">Campaign Design</a></li>

                    <li><a href="{{ route('public.services.influencer-marketing') }}">Influencer Marketing</a></li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3 style="color: var(--primary-color);">COMPANY</h3>
                <ul>
                    <li><a href="{{ route('public.about') }}">About Us</a></li>
                    <li><a href="{{ route('public.portfolio') }}">Portfolio</a></li>
                    <li><a href="{{ route('public.index') }}#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-brand">
                <div class="logo">
                    <img src="{{ asset(theme_option('global_site_logo', 'favicon.jpeg')) }}" alt="OD Sports" style="max-height: 45px; display: block; filter: invert(1) hue-rotate(180deg); mix-blend-mode: screen;">
                </div>
                <p>{!! theme_option('global_footer_slogan', 'Sport. Strategy. Story.') !!}</p>
                <div class="social-links">
                    <a href="{!! theme_option('global_social_facebook', '#') !!}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{!! theme_option('global_social_instagram', '#') !!}"><i class="fab fa-instagram"></i></a>
                    <a href="{!! theme_option('global_social_youtube', '#') !!}"><i class="fab fa-youtube"></i></a>
                    <a href="{!! theme_option('global_social_tiktok', '#') !!}"><i class="fab fa-tiktok"></i></a>
                    <a href="{!! theme_option('global_social_linkedin', '#') !!}"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div style="margin-top: 18px;">
                    <a href="https://wa.me/923012650123?text=Hi%20OD%20Sports%2C%20I%20would%20like%20to%20chat!" target="_blank" rel="noopener noreferrer" style="text-decoration: none; display: inline-flex; align-items: center; gap: 12px; background: rgba(37, 211, 102, 0.1); border: 1px solid rgba(37, 211, 102, 0.25); border-radius: 10px; padding: 10px 16px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(37,211,102,0.2)'; this.style.borderColor='rgba(37,211,102,0.5)';" onmouseout="this.style.background='rgba(37,211,102,0.1)'; this.style.borderColor='rgba(37,211,102,0.25)';">
                        <i class="fab fa-whatsapp" style="font-size: 26px; color: #25D366;"></i>
                        <span style="color: #fff; font-size: 13px; font-weight: 600;">Chat with us</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom" style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
            <p>{!! theme_option('global_footer_copyright', '© 2025 OD Sports — Part of Optimize Digital. All rights reserved.') !!}</p>
        </div>
    </div>
</footer>

