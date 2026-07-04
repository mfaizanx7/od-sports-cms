{{-- Shared service page edit form. Variables: $pfx (prefix like 'event_'), $capCount, $lcCount, $hasImpact, $stratCount (optional for campaign) --}}
<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="page_title" class="form-control" value="{{ old('page_title', theme_option($pfx.'page_title')) }}"></div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_bg', 'value' => old('hero_bg', theme_option($pfx.'hero_bg'))])</div>
    <div class="form-group"><label>Hero Subtitle</label>
        <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', theme_option($pfx.'hero_subtitle')) }}"></div>
    <div class="form-group"><label>Hero Title Line 1</label>
        <input type="text" name="hero_title_1" class="form-control" value="{{ old('hero_title_1', theme_option($pfx.'hero_title_1')) }}"></div>
    <div class="form-group"><label>Hero Title Line 2</label>
        <input type="text" name="hero_title_2" class="form-control" value="{{ old('hero_title_2', theme_option($pfx.'hero_title_2')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Statement Section</div>
    <div class="form-group"><label>Statement Text</label>
        <textarea name="statement" class="form-control" rows="4">{{ old('statement', theme_option($pfx.'statement')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Capabilities / What We Handle ({{ $capCount }} cards)</div>
    <div class="form-group"><label>Section Heading — Part 1 (blue text)</label>
        <input type="text" name="cap_section_title_1" class="form-control" value="{{ old('cap_section_title_1', theme_option($pfx.'cap_section_title_1', 'WHAT WE')) }}"></div>
    <div class="form-group"><label>Section Heading — Part 2 (green text)</label>
        <input type="text" name="cap_section_title_2" class="form-control" value="{{ old('cap_section_title_2', theme_option($pfx.'cap_section_title_2', 'HANDLE')) }}"></div>
    @for($i = 1; $i <= $capCount; $i++)
    <div style="background: #0f172a; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <h5 style="color: #60a5fa; margin-bottom: 12px;">Card {{ $i }}</h5>
        <div class="form-group"><label>Title</label>
            <input type="text" name="cap_{{ $i }}_title" class="form-control" value="{{ old('cap_'.$i.'_title', theme_option($pfx.'cap_'.$i.'_title')) }}"></div>
        <div class="form-group"><label>Description</label>
            <textarea name="cap_{{ $i }}_desc" class="form-control">{{ old('cap_'.$i.'_desc', theme_option($pfx.'cap_'.$i.'_desc')) }}</textarea></div>
    </div>
    @endfor
</div>

@if(!empty($stratCount))
<div class="form-section">
    <div class="form-section-title">Strategy Section ({{ $stratCount }} cards)</div>
    <div class="form-group"><label>Section Heading &mdash; Part 1 (green text)</label>
        <input type="text" name="strat_section_title_1" class="form-control" value="{{ old('strat_section_title_1', theme_option($pfx.'strat_section_title_1', 'CREATIVE STRATEGY —')) }}"></div>
    <div class="form-group"><label>Section Heading &mdash; Part 2 (blue text)</label>
        <input type="text" name="strat_section_title_2" class="form-control" value="{{ old('strat_section_title_2', theme_option($pfx.'strat_section_title_2', 'WHAT A FULL CAMPAIGN INCLUDES')) }}"></div>
    @for($i = 1; $i <= $stratCount; $i++)
    <div style="background: #0f172a; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <h5 style="color: #60a5fa; margin-bottom: 12px;">Strategy {{ $i }}</h5>
        <div class="form-group"><label>Title</label>
            <input type="text" name="strat_{{ $i }}_title" class="form-control" value="{{ old('strat_'.$i.'_title', theme_option($pfx.'strat_'.$i.'_title')) }}"></div>
        <div class="form-group"><label>Description</label>
            <textarea name="strat_{{ $i }}_desc" class="form-control">{{ old('strat_'.$i.'_desc', theme_option($pfx.'strat_'.$i.'_desc')) }}</textarea></div>
    </div>
    @endfor
</div>
@endif

@if(!empty($hasImpact))
<div class="form-section">
    <div class="form-section-title">Proven Results Section</div>
    <div class="form-group"><label>Section Heading — Part 1 (blue text)</label>
        <input type="text" name="impact_title_1" class="form-control" value="{{ old('impact_title_1', theme_option($pfx.'impact_title_1', 'PROVEN')) }}"></div>
    <div class="form-group"><label>Section Heading — Part 2 (green text)</label>
        <input type="text" name="impact_title_2" class="form-control" value="{{ old('impact_title_2', theme_option($pfx.'impact_title_2', 'RESULTS')) }}"></div>
    <div class="form-group"><label>Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'impact_bg', 'value' => old('impact_bg', theme_option($pfx.'impact_bg'))])</div>
    <div class="form-group"><label>Results Description</label>
        <textarea name="impact_desc" class="form-control" rows="4">{{ old('impact_desc', theme_option($pfx.'impact_desc')) }}</textarea></div>
</div>
@endif

<div class="form-section">
    <div class="form-section-title">Who Is This For ({{ $lcCount }} items)</div>
    <div class="form-group"><label>Section Heading — Part 1 (green text)</label>
        <input type="text" name="lc_section_title_1" class="form-control" value="{{ old('lc_section_title_1', theme_option($pfx.'lc_section_title_1', 'WHO IS THIS')) }}"></div>
    <div class="form-group"><label>Section Heading — Part 2 (blue text)</label>
        <input type="text" name="lc_section_title_2" class="form-control" value="{{ old('lc_section_title_2', theme_option($pfx.'lc_section_title_2', 'FOR?')) }}"></div>
    @for($i = 1; $i <= $lcCount; $i++)
    <div class="form-group"><label>Item {{ $i }}</label>
        <input type="text" name="lifecycle_{{ $i }}" class="form-control" value="{{ old('lifecycle_'.$i, theme_option($pfx.'lifecycle_'.$i)) }}"></div>
    @endfor
</div>

<div class="form-section">
    <div class="form-section-title">CTA Section</div>
    <div class="form-group"><label>CTA Title Line 1</label>
        <input type="text" name="cta_title_1" class="form-control" value="{{ old('cta_title_1', theme_option($pfx.'cta_title_1')) }}"></div>
    <div class="form-group"><label>CTA Title Line 2</label>
        <input type="text" name="cta_title_2" class="form-control" value="{{ old('cta_title_2', theme_option($pfx.'cta_title_2')) }}"></div>
    <div class="form-group"><label>CTA Button Text</label>
        <input type="text" name="cta_btn" class="form-control" value="{{ old('cta_btn', theme_option($pfx.'cta_btn')) }}"></div>
</div>
