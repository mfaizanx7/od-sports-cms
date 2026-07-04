<?php

// OD Sports - Additional Pages Content Management
// NOTE: Only use simple field types (text, textarea, mediaImage) to avoid translation-loop timeouts.
// Do NOT use 'editor' type here as it triggers the IntlFormatter/translation system on every request.

app()->booted(function () {

    $pages = [
        'homepage'                      => 'Page: Homepage',
        'services_event_management'     => 'Service: Event Management',
        'services_media_production'     => 'Service: Media Production',
        'services_sports_marketing'     => 'Service: Sports Marketing',
        'services_custom_printing'      => 'Service: Custom Printing',
        'services_campaign_design'      => 'Service: Campaign Design',
        'services_influencer_marketing' => 'Service: Influencer Marketing',
        'portfolio'                     => 'Page: Portfolio',
        'about'                         => 'Page: About Us',
        'custom_orders'                 => 'Page: Custom Orders',
    ];

    foreach ($pages as $id => $title) {
        theme_option()->setSection([
            'title'      => $title,
            'desc'       => 'Manage content for ' . $title,
            'id'         => 'opt-text-subsection-' . $id,
            'subsection' => true,
            'icon'       => 'fas fa-file-alt',
        ]);

        // Hero Background Image
        theme_option()->setField([
            'id'         => $id . '_hero_bg',
            'section_id' => 'opt-text-subsection-' . $id,
            'type'       => 'mediaImage',
            'label'      => 'Hero Background Image',
            'attributes' => [
                'name'  => $id . '_hero_bg',
                'value' => null,
            ],
        ]);

        // Main Heading
        theme_option()->setField([
            'id'         => $id . '_heading',
            'section_id' => 'opt-text-subsection-' . $id,
            'type'       => 'text',
            'label'      => 'Main Heading',
            'attributes' => [
                'name'    => $id . '_heading',
                'value'   => null,
                'options' => ['class' => 'form-control'],
            ],
        ]);

        // Description / Subheading
        theme_option()->setField([
            'id'         => $id . '_description',
            'section_id' => 'opt-text-subsection-' . $id,
            'type'       => 'textarea',
            'label'      => 'Description / Subheading',
            'attributes' => [
                'name'    => $id . '_description',
                'value'   => null,
                'options' => ['class' => 'form-control'],
            ],
        ]);
    }
});
