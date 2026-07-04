@extends('layouts.landing')

@section('content')

    @php
        $ordersHeroBg = theme_option('orders_hero_bg', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=2000&q=80');
        if (str_starts_with($ordersHeroBg, 'http://') || str_starts_with($ordersHeroBg, 'https://')) { $ordersHeroBgUrl = $ordersHeroBg; }
        elseif (file_exists(public_path($ordersHeroBg))) { $ordersHeroBgUrl = asset($ordersHeroBg); }
        else { $ordersHeroBgUrl = RvMedia::getImageUrl($ordersHeroBg); }
    @endphp
    <header class="em-hero" style="background-image: url('{{ $ordersHeroBgUrl }}');">
        <div class="em-container">
            <div class="em-hero-content">
                <h1 class="em-hero-title">{!! theme_option('orders_hero_title_1', 'Custom Merchandise') !!} <br>{!! theme_option('orders_hero_title_2', 'for Your Team or Event') !!}</h1>
                <p class="mt-4 text-xl opacity-90 max-w-2xl">{!! theme_option('orders_hero_desc', 'Need jerseys, event t-shirts, banners, or branded fan gear? Tell us what you need — we handle design, printing, and delivery anywhere in Pakistan.') !!}</p>
            </div>
        </div>
    </header>


    <section class="em-what-we-make" style="padding: 100px 0; background: #111;">
        <div class="em-container">
            <div class="section-header-center">
                <h2 style="color: #8ddf0d !important;">{!! theme_option('orders_whatwemake_title', 'WHAT WE MAKE') !!}</h2>
            </div>

            <div class="capabilities-grid">
                <div class="cap-card">
                    <h3>{!! theme_option('orders_card1_title', 'Apparel') !!}</h3>
                    <ul class="em-cap-list-simple">
                        <li>{!! theme_option('orders_card1_item1', 'Team jerseys and training kits') !!}</li>
                        <li>{!! theme_option('orders_card1_item2', 'Event t-shirts and race-day gear') !!}</li>
                        <li>{!! theme_option('orders_card1_item3', 'Hoodies, tracksuits, and casual wear') !!}</li>
                        <li>{!! theme_option('orders_card1_item4', 'Compression gear and running apparel') !!}</li>
                    </ul>
                </div>
                <div class="cap-card">
                    <h3>{!! theme_option('orders_card2_title', 'Event Branding') !!}</h3>
                    <ul class="em-cap-list-simple">
                        <li>{!! theme_option('orders_card2_item1', 'Pull-up banners and perimeter boards') !!}</li>
                        <li>{!! theme_option('orders_card2_item2', 'Start/finish arches and race structures') !!}</li>
                        <li>{!! theme_option('orders_card2_item3', 'Flags and fan-zone materials') !!}</li>
                        <li>{!! theme_option('orders_card2_item4', 'Sponsor backdrops and photo walls') !!}</li>
                    </ul>
                </div>
                <div class="cap-card">
                    <h3>{!! theme_option('orders_card3_title', 'Fan Merchandise') !!}</h3>
                    <ul class="em-cap-list-simple">
                        <li>{!! theme_option('orders_card3_item1', 'Caps, beanies, and headwear') !!}</li>
                        <li>{!! theme_option('orders_card3_item2', 'Tote bags and drawstring backpacks') !!}</li>
                        <li>{!! theme_option('orders_card3_item3', 'Water bottles and drinkware') !!}</li>
                        <li>{!! theme_option('orders_card3_item4', 'Lanyards and accessories') !!}</li>
                    </ul>
                </div>
                <div class="cap-card">
                    <h3>{!! theme_option('orders_card4_title', 'Custom Orders') !!}</h3>
                    <ul class="em-cap-list-simple">
                        <li>{!! theme_option('orders_card4_item1', 'Sponsor co-branding on any merchandise') !!}</li>
                        <li>{!! theme_option('orders_card4_item2', 'Club and academy uniform packs') !!}</li>
                        <li>{!! theme_option('orders_card4_item3', 'Full event merchandise packages') !!}</li>
                        <li>{!! theme_option('orders_card4_item4', 'Packaging design for product launches') !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="em-lifecycle" style="padding: 100px 0; background: #181818;">
        <div class="em-container">
            <div class="section-header-center">
                <h2 style="color: #8ddf0d !important;">{!! theme_option('orders_lifecycle_title_1', 'HOW IT') !!} {!! theme_option('orders_lifecycle_title_2', 'WORKS') !!}</h2>
            </div>

            <div class="em-lifecycle-grid">
                <div class="em-phase-card">
                    <h3 style="color: #8ddf0d !important;">{!! theme_option('orders_phase1_title', 'Tell Us What You Need') !!}</h3>
                    <p>{!! theme_option('orders_phase1_desc', 'Fill out the form below with your requirements, event name, quantity, design preferences, and deadline.') !!}</p>
                </div>
                <div class="em-phase-card">
                    <h3 style="color: #8ddf0d !important;">{!! theme_option('orders_phase2_title', 'We Design It') !!}</h3>
                    <p>{!! theme_option('orders_phase2_desc', 'Our design team creates mockups tailored to your team identity, colours, and event branding.') !!}</p>
                </div>
                <div class="em-phase-card">
                    <h3 style="color: #8ddf0d !important;">{!! theme_option('orders_phase3_title', 'You Approve It') !!}</h3>
                    <p>{!! theme_option('orders_phase3_desc', 'Review and approve the designs. We handle all revisions until you\'re happy.') !!}</p>
                </div>
                <div class="em-phase-card">
                    <h3 style="color: #8ddf0d !important;">{!! theme_option('orders_phase4_title', 'We Print & Deliver') !!}</h3>
                    <p>{!! theme_option('orders_phase4_desc', 'We manage production and delivery to your location across Pakistan.') !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-elevate" id="order-form" style="padding: 120px 0; background: #000;">
        <div class="container">
            @if(session('mail_error'))
                <div style="background:#2b0d0d;border:1px solid #ef4444;color:#ef4444;padding:16px 24px;border-radius:10px;margin-bottom:30px;font-weight:600;text-align:center;">
                    <i class="fas fa-exclamation-circle" style="margin-right:8px;"></i>{{ session('mail_error') }}
                </div>
            @endif
            @if(session('order_success'))
                <div style="background:#0d2b0d;border:1px solid #8ddf0d;color:#8ddf0d;padding:16px 24px;border-radius:10px;margin-bottom:30px;font-weight:600;text-align:center;">
                    <i class="fas fa-check-circle" style="margin-right:8px;"></i>{{ session('order_success') }}
                </div>
            @endif
            @isset($errors)
                @if($errors->any())
                    <div style="background:#2b0d0d;border:1px solid #ef4444;color:#ef4444;padding:16px 24px;border-radius:10px;margin-bottom:30px;">
                        <ul style="margin:0;padding-left:20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
            @endisset
            <form action="{{ route('public.custom-orders.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="elevate-box">
                    <div class="elevate-info">
                        <h2>{!! theme_option('orders_form_title_1', 'Ready to') !!} <br><span class="highlight">{!! theme_option('orders_form_title_2', 'Gear Up?') !!}</span></h2>
                        <p>{!! theme_option('orders_form_desc', "Whether you need 50 jerseys or a full event merchandise package — we'll handle everything from first sketch to final delivery.") !!}</p>
                        <ul class="check-list">
                            <li><i class="fas fa-check"></i> {!! theme_option('orders_form_benefit1', 'Low Minimum Order Quantities') !!}</li>
                            <li><i class="fas fa-check"></i> {!! theme_option('orders_form_benefit2', 'Nationwide Shipping in Pakistan') !!}</li>
                            <li><i class="fas fa-check"></i> {!! theme_option('orders_form_benefit3', 'Premium Technical Fabrics') !!}</li>
                        </ul>

                        <div style="margin-top: 40px;">
                            <p style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.5); margin-bottom: 16px;">Follow Us</p>
                            <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
                                <a href="{!! theme_option('global_social_facebook', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{!! theme_option('global_social_instagram', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{!! theme_option('global_social_youtube', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="{!! theme_option('global_social_tiktok', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                                <a href="{!! theme_option('global_social_linkedin', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="elevate-form od-contact-form">
                        <div style="margin-bottom: 28px;">
                            <span style="color: #8ddf0d; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px;">{!! theme_option('orders_form_mini_label', 'Custom Printing') !!}</span>
                            <h3 style="color: #fff; font-size: 1.6rem; font-weight: 800; margin: 6px 0 0; line-height: 1.3;">{!! theme_option('orders_form_sub_heading', 'Tell Us What You Need') !!}</h3>
                        </div>

                        <div class="od-form-row">
                            <div class="od-field-wrap">
                                <label class="od-label">Full Name <span style="color:#ef4444;">*</span></label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-user od-input-icon"></i>
                                    <input class="od-input" type="text" name="name" placeholder="{{ theme_option('orders_form_name', 'e.g. Ahmed Khan') }}" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="od-field-wrap">
                                <label class="od-label">Organization / Team</label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-users od-input-icon"></i>
                                    <input class="od-input" type="text" name="org" placeholder="{{ theme_option('orders_form_org', 'e.g. FC Lahore') }}" value="{{ old('org') }}">
                                </div>
                            </div>
                        </div>

                        <div class="od-form-row">
                            <div class="od-field-wrap">
                                <label class="od-label">Email Address <span style="color:#ef4444;">*</span></label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-envelope od-input-icon"></i>
                                    <input class="od-input" type="email" name="email" placeholder="{{ theme_option('orders_form_email', 'you@example.com') }}" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="od-field-wrap">
                                <label class="od-label">Phone Number</label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-phone od-input-icon"></i>
                                    <input class="od-input" type="text" name="phone" placeholder="{{ theme_option('orders_form_phone', '+92 300 0000000') }}" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>

                        <div class="od-form-row">
                            <div class="od-field-wrap">
                                <label class="od-label">Interest</label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-tag od-input-icon"></i>
                                    <select class="od-input od-select" name="interest">
                                        <option value="Team Jerseys" {{ old('interest') === 'Team Jerseys' ? 'selected' : '' }}>{!! theme_option('orders_form_select1', 'Team Jerseys') !!}</option>
                                        <option value="Event Banners" {{ old('interest') === 'Event Banners' ? 'selected' : '' }}>{!! theme_option('orders_form_select2', 'Event Banners') !!}</option>
                                        <option value="Fan Gear" {{ old('interest') === 'Fan Gear' ? 'selected' : '' }}>{!! theme_option('orders_form_select3', 'Fan Gear') !!}</option>
                                        <option value="Full Event Branding" {{ old('interest') === 'Full Event Branding' ? 'selected' : '' }}>{!! theme_option('orders_form_select4', 'Full Event Branding') !!}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="od-field-wrap">
                                <label class="od-label">Est. Quantity</label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-hashtag od-input-icon"></i>
                                    <input class="od-input" type="number" name="quantity" placeholder="{{ theme_option('orders_form_qty', 'e.g. 50') }}" value="{{ old('quantity') }}" min="1">
                                </div>
                            </div>
                        </div>

                        <div class="od-field-wrap" style="margin-bottom: 18px;">
                            <label class="od-label">Requirements <span style="color:#ef4444;">*</span></label>
                            <textarea class="od-input od-textarea" name="message" placeholder="{{ theme_option('orders_form_message', 'Tell us about colours, logos, deadlines...') }}" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="od-field-wrap" style="margin-bottom: 24px;">
                            <label class="od-label">{!! theme_option('orders_form_upload', 'Upload Logos / References') !!} <span style="color:rgba(255,255,255,0.35);font-size:10px;text-transform:none;letter-spacing:0;">(Optional)</span></label>
                            <label class="od-file-label" for="order-file-input">
                                <i class="fas fa-cloud-upload-alt" style="font-size:20px;color:#8ddf0d;flex-shrink:0;"></i>
                                <span id="od-file-text" style="font-size:13px;">Choose file or drop here</span>
                                <span style="margin-left:auto;font-size:11px;color:rgba(255,255,255,0.3);">JPG, PNG, PDF, AI, ZIP</span>
                            </label>
                            <input id="order-file-input" type="file" name="file" class="od-file-input" accept=".jpg,.jpeg,.png,.gif,.pdf,.ai,.eps,.svg,.zip">
                        </div>

                        <button type="submit" class="od-submit-btn">
                            <span>{{ strip_tags(theme_option('orders_form_btn', 'REQUEST A CUSTOM ORDER')) }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <p style="text-align:center;color:rgba(255,255,255,0.35);font-size:12px;margin-top:14px;margin-bottom:0;">
                            <i class="fas fa-lock" style="margin-right:5px;"></i>{!! theme_option('orders_form_trust_text', 'Free quote. No commitment required.') !!}
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <style>
        .em-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .em-hero { min-height: 60vh; background-size: cover; background-position: center; display: flex; align-items: center; position: relative; padding-top: 120px; padding-bottom: 80px; }
        .em-hero::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); }
        .em-hero-content { position: relative; z-index: 1; }
        .em-hero-subtitle { color: var(--accent-color); font-weight: 800; letter-spacing: 2px; text-transform: uppercase; display: block; text-align: center; }
        .em-hero-title { font-size: 4rem; color: #fff; line-height: 1.1; margin-top: 10px; text-transform: uppercase; }
        .em-text-blue { color: var(--primary-color); }
        .em-text-neon { color: var(--accent-color); }

        .section-header-center { text-align: center; margin-bottom: 50px; }
        .section-header-center h2 { font-size: 2.5rem; text-transform: uppercase; }

        .capabilities-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        .cap-card { background: #222; padding: 30px; border-radius: 12px; border-left: 4px solid var(--accent-color); transition: transform 0.3s; }
        .cap-card h3 { color: var(--accent-color); margin-bottom: 15px; font-size: 1.2rem; text-transform: uppercase; }

        .em-cap-list-simple { list-style: none; padding: 0; margin: 0; }
        .em-cap-list-simple li { color: #ccc; font-size: 0.95rem; margin-bottom: 10px; padding-left: 20px; position: relative; }
        .em-cap-list-simple li::before { content: '●'; position: absolute; left: 0; color: var(--primary-color); font-size: 0.8rem; }

        .em-lifecycle-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .em-phase-card { background: #222; padding: 40px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.05); text-align: center; }
        .em-phase-card h3 { font-size: 1.3rem; color: #8ddf0d !important; margin-bottom: 15px; }
        .em-phase-card p { color: rgba(255,255,255,0.7); line-height: 1.6; }

        .elevate-box { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; background: #111; padding: 80px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.1); }
        .elevate-info h2 { font-size: 3.5rem; line-height: 1.1; margin-bottom: 30px; text-transform: uppercase; }
        .elevate-info .highlight { color: var(--primary-color); }
        .elevate-info p { font-size: 1.2rem; color: #ccc; margin-bottom: 40px; line-height: 1.6; }

        .check-list { list-style: none; padding: 0; }
        .check-list li { display: flex; align-items: center; gap: 15px; color: #fff; margin-bottom: 15px; font-weight: 600; }
        .check-list i { color: var(--accent-color); }

        .od-form-row { display: flex; gap: 16px; margin-bottom: 18px; }
        .od-form-row .od-field-wrap { flex: 1; min-width: 0; }
        .od-textarea { height: 110px; resize: vertical; padding-top: 14px !important; }
        .od-file-label { display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.18); border-radius: 10px; padding: 14px 18px; cursor: pointer; transition: all 0.3s; color: rgba(255,255,255,0.45); }
        .od-file-label:hover { border-color: #8ddf0d; background: rgba(141,223,13,0.05); color: #8ddf0d; }
        .od-file-label:hover i { color: #8ddf0d; }
        .od-file-input { display: none; }
        @media (max-width: 600px) { .od-form-row { flex-direction: column; gap: 0; } }

        @media (max-width: 992px) {
            .elevate-box { grid-template-columns: 1fr; padding: 40px; }
        }
        @media (max-width: 768px) {
            .em-hero-title { font-size: 2.5rem; }
        }
    </style>

@if(session('order_success'))
<div id="od-order-toast" style="position:fixed;bottom:30px;right:30px;z-index:99999;">
    <div style="background:linear-gradient(135deg,#0a1a00,#0f2600);color:#fff;padding:18px 24px 18px 20px;border-radius:14px;font-family:'Inter',sans-serif;box-shadow:0 8px 32px rgba(0,0,0,.55);border:1px solid rgba(141,223,13,.35);display:flex;align-items:center;gap:14px;min-width:300px;max-width:360px;animation:odToastIn .4s ease forwards;">
        <div style="width:40px;height:40px;border-radius:50%;background:rgba(141,223,13,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-check" style="color:#8ddf0d;font-size:16px;"></i>
        </div>
        <div style="flex:1;">
            <p style="font-weight:700;color:#8ddf0d;margin:0 0 3px;font-size:14px;">Order Request Sent!</p>
            <p style="color:rgba(255,255,255,0.65);margin:0;font-size:12px;">We'll get back to you with a quote shortly.</p>
        </div>
        <button onclick="document.getElementById('od-order-toast').style.display='none'" style="background:none;border:none;color:rgba(255,255,255,0.35);cursor:pointer;font-size:20px;line-height:1;padding:0;flex-shrink:0;">&times;</button>
    </div>
</div>
<script>
setTimeout(function(){
    var t=document.getElementById('od-order-toast');
    if(t){t.style.animation='odToastOut .4s ease forwards';setTimeout(function(){t.style.display='none'},400);}
},5000);
</script>
@endif

<script>
document.getElementById('order-file-input').addEventListener('change', function() {
    var label = document.getElementById('od-file-text');
    if (this.files && this.files[0]) {
        label.textContent = this.files[0].name;
        label.style.color = '#8ddf0d';
    } else {
        label.textContent = 'Choose file or drop here';
        label.style.color = '';
    }
});
</script>

<style>
@keyframes odToastIn  { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
@keyframes odToastOut { from { opacity:1; transform:translateY(0); } to { opacity:0; transform:translateY(20px); } }
</style>

@endsection
