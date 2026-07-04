@extends('layouts.landing')

@section('title', theme_option('blog_page_title', 'Blog - OD Sports'))

@section('content')
@php
    $resolveImg = function($val) {
        if (!$val) return '';
        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) return $val;
        if (file_exists(public_path($val))) return asset($val);
        return RvMedia::getImageUrl($val);
    };
    $blogHeroBg = theme_option('blog_hero_bg', 'https://images.unsplash.com/photo-1504016798967-59a258e9386d?auto=format&fit=crop&w=2000&q=80');
    $blogHeroBgUrl = $resolveImg($blogHeroBg);
@endphp

    <header class="em-hero" style="background-image: url('{{ $blogHeroBgUrl }}');">
        <div class="em-container">
            <div class="em-hero-content">
                <h1 class="em-hero-title" style="font-size: 38px; line-height: 1.3; font-weight: 800;">{!! theme_option('blog_hero_title', 'News, Insights & Stories <br>from Pakistan\'s Sports Scene') !!}</h1>
            </div>
        </div>
    </header>

    <section style="padding: 40px 20px 60px; background: #0a0a0a;">
        <div style="max-width: 1200px; margin: 0 auto;">

            @if($posts->count() > 0)

                <div style="margin-bottom: 36px;">
                    <span style="color: #8ddf0d; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; display: block; margin-bottom: 8px;">{!! theme_option('blog_posts_mini_label', 'OD SPORTS') !!}</span>
                    <h2 style="color: #fff; font-size: 2.2rem; font-weight: 800; margin: 0; line-height: 1.2;">{!! theme_option('blog_posts_title_1', 'LATEST') !!} <span style="color: #3b82f6;">{!! theme_option('blog_posts_title_2', 'BLOGS') !!}</span></h2>
                </div>

                <div class="blog-posts-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-bottom: 60px; align-items: start;">
                    @foreach($posts as $post)
                    @php
                        $rawDesc = $post->getAttributes()['description'] ?? '';
                        $sepPos  = strpos($rawDesc, '||');
                        $postCat = $sepPos !== false ? trim(substr($rawDesc, 0, $sepPos)) : null;
                        $postExcerpt = $sepPos !== false ? trim(substr($rawDesc, $sepPos + 2)) : $rawDesc;
                        $postImgUrl = $post->image ? $resolveImg(\RvMedia::getImageUrl($post->image)) : '';
                    @endphp
                        <div style="background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; display: block;">
                            @if($postImgUrl)
                                <div style="overflow: hidden;">
                                    <img src="{{ $postImgUrl }}" alt="{{ $post->getAttributes()['name'] ?? $post->name }}" style="width: 100%; height: auto; display: block;">
                                </div>
                            @endif
                            <div style="padding: 24px;">
                                @if($postCat)
                                    <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 10px;">{{ $postCat }}</span>
                                @endif
                                <h3 style="color: #fff; font-size: 18px; font-weight: 700; margin: 0 0 8px; line-height: 1.4;">{{ $post->getAttributes()['name'] ?? $post->name }}</h3>
                                <div style="color: #64748b; font-size: 12px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Written by: <strong style="color: #fff;">{{ optional($post->author)->name ?? 'OD Sports' }}</strong></span>
                                </div>
                                @if($postExcerpt)
                                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin: 0;">{{ $postExcerpt }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 50px; text-align: center;">
                    {{ $posts->links() }}
                </div>
            @endif

            <div style="margin-bottom: 30px;">
                <h2 style="color: var(--accent-color, #8ddf0d); font-size: 1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">{!! theme_option('blog_portfolio_section_subtitle', 'From Our Portfolio') !!}</h2>
                <h3 style="color: #8ddf0d !important; font-size: 2rem; font-weight: 800;">{!! theme_option('blog_portfolio_section_title_1', 'Stories Behind the') !!} <span style="color: #8ddf0d !important;">{!! theme_option('blog_portfolio_section_title_2', 'Projects') !!}</span></h3>
            </div>

            <div class="blog-stories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 30px;">
                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden; position: relative;">
                        <img src="{{ $resolveImg(theme_option('portfolio_1_img', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_1_category', 'Event Management | Marketing | Media') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_1_title', 'ISLAMABAD MARATHON & IRU') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery1_desc', "Since 2022, we've supported IRU through four editions of the Islamabad Marathon. Our digital strategies helped transform a local run into Pakistan's most recognised marathon.") !!}</p>
                    </div>
                </a>

                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="{{ $resolveImg(theme_option('portfolio_2_img', 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_2_category', 'Media Production | Digital Marketing') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_2_title', 'MARGALLA TRAIL RUNNERS') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery2_desc', "Official media partner since 2024. We craft immersive narratives that capture the grit and spirit of trail athletes in Pakistan's most demanding terrains.") !!}</p>
                    </div>
                </a>

                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="{{ $resolveImg(theme_option('portfolio_3_img', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_3_category', 'Event Management | Media Production') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_3_title', 'YOURPACE BY INDRIVE') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery3_desc', "An inDrive initiative for underprivileged children. We managed end-to-end coverage including documentation, branding, and full programme documentary production.") !!}</p>
                    </div>
                </a>

                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="{{ $resolveImg(theme_option('portfolio_4_img', 'https://images.unsplash.com/photo-1571008887538-b36bb32f4571?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_4_category', 'Digital Marketing | Media | Coverage') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_4_title', 'TWIN CITY & NIGHT RUN') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery4_desc', "Full digital and media campaigns for Islamabad's popular urban races. Coordinated content campaigns including graphics, memes, and live updates.") !!}</p>
                    </div>
                </a>

                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="{{ $resolveImg(theme_option('portfolio_5_img', 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_5_category', 'Sports Photography | Videography') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_5_title', 'IRC RUNNING SERIES') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery5_desc', 'End-to-end event coverage across three race editions including professional photography, drone videography, and participant testimonial production.') !!}</p>
                    </div>
                </a>

                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="{{ $resolveImg(theme_option('portfolio_6_img', 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_6_category', 'Social Media | Content Production') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_6_title', 'TABARAK RUNS CROSS-PAKISTAN') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery6_desc', 'Documenting the historic 1,600km run from Hasan Abdal to Karachi. Capture of launch event, key visuals, and real-time social media content.') !!}</p>
                    </div>
                </a>

                <a href="{{ route('public.portfolio') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; display: block;">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="{{ $resolveImg(theme_option('portfolio_7_img', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=600')) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div style="padding: 24px;">
                        <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">{!! theme_option('portfolio_7_category', 'Social Strategy | Content | PR') !!}</span>
                        <h3 style="color: #8ddf0d !important; font-size: 18px; font-weight: 700; margin: 10px 0 8px; line-height: 1.4;">{!! theme_option('portfolio_7_title', 'SHEHROZE KASHIF 14X8000ER') !!}</h3>
                        <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('portfolio_gallery7_desc', "Social media strategy and content creation for Shehroze Kashif's historic endeavour to summit all 14 peaks above 8,000 metres.") !!}</p>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <section id="gear" class="gear">
        <div class="container">
            <div class="section-header left-align">
                <h2 style="color: var(--accent-color) !important;">{!! theme_option('blog_gears_title_1', 'FEATURED') !!} <span class="highlight">{!! theme_option('blog_gears_title_2', 'GEARS') !!}</span></h2>
                <p>{!! theme_option('blog_gears_subtitle', 'Professional grade equipment and apparel for serious athletes.') !!}</p>
            </div>
            <div class="product-grid">
                @forelse($featuredProducts as $product)
                <div class="product-card">
                    @if($loop->first)
                        <span class="product-badge new">{!! theme_option('blog_gears_badge_new', 'NEW') !!}</span>
                    @elseif($product->sale_price && $product->sale_price < $product->price)
                        <span class="product-badge sale">{!! theme_option('blog_gears_badge_sale', 'SALE') !!}</span>
                    @endif
                    <div class="product-img">
                        @php
                            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                            $rawImg = !empty($images[0]) ? $images[0] : '';
                        if ($rawImg) {
                            if (str_starts_with($rawImg, 'http://') || str_starts_with($rawImg, 'https://')) { $imgUrl = $rawImg; }
                            elseif (file_exists(public_path($rawImg))) { $imgUrl = asset($rawImg); }
                            else { $imgUrl = RvMedia::getImageUrl($rawImg); }
                        } else {
                            $imgUrl = 'https://via.placeholder.com/400x400?text=' . urlencode($product->name);
                        }
                        @endphp
                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                        <div class="category">{{ strtoupper(optional($product->categories->first())->name ?? 'GEAR') }}</div>
                        <h4>{{ $product->name }}</h4>
                        <div class="price">
                            ${{ number_format($product->sale_price ?: $product->price, 0) }}
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="old-price">${{ number_format($product->price, 0) }}</span>
                            @endif
                        </div>
                    </div>
                    <button class="add-to-cart add-to-cart-button" data-id="{{ $product->id }}" data-url="{{ route('public.cart.add-to-cart') }}">{!! theme_option('blog_gears_add_to_cart', 'ADD TO CART') !!} <i class="fas fa-shopping-cart"></i></button>
                </div>
                @empty
                <div class="product-card" style="grid-column: 1/-1; text-align:center; padding:40px;">
                    <p>{!! theme_option('blog_gears_empty_message', 'No featured products available yet. Check back soon!') !!}</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
