@extends('core/base::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <h2>Website Content Management</h2>
            <p class="text-muted">Select a page below to edit its content.</p>
        </div>
    </div>

    <div class="row">
        @php
            $displayPages = [
                'homepage' => 'Homepage',
                'services_index' => 'Services Main',
                'services_event_management' => 'Event Management',
                'services_media_production' => 'Media Production',
                'services_sports_marketing' => 'Sports Marketing',
                'services_campaign_design' => 'Campaign Design',
                'services_influencer_marketing' => 'Influencer Marketing',
                'portfolio' => 'Portfolio',
                'blog' => 'Blog',
                'custom_orders' => 'Custom Orders',
                'about' => 'About Us',
                'global_settings' => 'Global Settings (Header & Footer)',
            ];
        @endphp

        @foreach($displayPages as $id => $title)
        <div class="col-12 mb-3">
            <div class="card shadow-sm border-0" style="background: #1e293b;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1" style="color: #60a5fa; font-weight: 600;">{{ $title }}</h5>
                        <p class="card-text mb-0" style="color: #94a3b8; font-size: 14px;">Manage content for the {{ $title }} page.</p>
                    </div>
                    <a href="{{ route('admin.website-content.edit', $id) }}" class="btn text-white" style="background: #3b82f6; border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-edit mr-1"></i> Edit Content
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    body { background: #0f172a; }
    h2 { color: #f1f5f9; }
    .text-muted { color: #64748b !important; }
    .card { transition: transform 0.2s, box-shadow 0.2s; border: 1px solid #334155 !important; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3) !important; }
    .btn:hover { background: #2563eb !important; }

    @media (max-width: 767px) {
        .container-fluid { padding-left: 10px !important; padding-right: 10px !important; }
        h2 { font-size: 20px !important; word-break: break-word; }
        .card-body.d-flex {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 12px;
        }
        .card-body.d-flex .btn {
            width: 100% !important;
            text-align: center !important;
            min-height: 44px;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
        .card-title { font-size: 15px !important; }
        .card-text { font-size: 13px !important; }
    }

    @media (max-width: 480px) {
        h2 { font-size: 18px !important; }
        .card-body { padding: 14px !important; }
    }
</style>
@endsection
