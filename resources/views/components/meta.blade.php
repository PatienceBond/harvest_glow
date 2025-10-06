@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'ogType' => 'website',
    'ogImage' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogUrl' => null,
])

@php
    $metaTitle = $title ?? 'HarvestGlow - Empowering farmers, Growing futures';
    $metaDescription = $description ?? 'Transforming agriculture through sustainable practices, innovative technology, and community-driven solutions that empower farmers and strengthen food security.';
    $metaKeywords = $keywords ?? 'agriculture, sustainable farming, food security, farmer empowerment, agricultural technology, community development, farming solutions, crop management, agricultural training';
    $ogImageUrl = $ogImage ?? asset('images/landing-farm.jpg');
    $ogTitleContent = $ogTitle ?? $metaTitle;
    $ogDescriptionContent = $ogDescription ?? $metaDescription;
    $ogUrlContent = $ogUrl ?? request()->url();
@endphp

<!-- Page-specific Meta Tags -->
<title>{{ $metaTitle }}</title>
<meta name="title" content="{{ $metaTitle }}" />
<meta name="description" content="{{ $metaDescription }}" />
<meta name="keywords" content="{{ $metaKeywords }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $ogType }}" />
<meta property="og:url" content="{{ $ogUrlContent }}" />
<meta property="og:title" content="{{ $ogTitleContent }}" />
<meta property="og:description" content="{{ $ogDescriptionContent }}" />
<meta property="og:image" content="{{ $ogImageUrl }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{ $ogUrlContent }}" />
<meta property="twitter:title" content="{{ $ogTitleContent }}" />
<meta property="twitter:description" content="{{ $ogDescriptionContent }}" />
<meta property="twitter:image" content="{{ $ogImageUrl }}" />
