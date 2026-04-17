<meta name="description" content="{{$description}}">
@isset($seo['is_tags'])
<meta name="keywords" content="{{$seo['meta_tags']??''}}">
@endisset

@isset($seo['og_tag'])
<!-- Open Graph Tags -->
<meta property="og:title" content="{{$seo['og']['title']??''}}">
<meta property="og:description" content="{{$seo['og']['description']??''}}">
<meta property="og:url" content="{{$seo['og']['url']??''}}">
<meta property="og:type" content="{{$seo['og']['type']??''}}">
<meta property="og:image" content="{{$seo['og']['image']??''}}">
{{-- <meta property="og:site_name" content="Your Website Name"> --}}
@endisset

@isset($seo['twitter_tag'])
<!-- Twitter Card Tags -->
<meta name="twitter:card" content="{{$seo['twitter']['card']??''}}">
<meta name="twitter:title" content="{{$seo['twitter']['title']??''}}">
<meta name="twitter:description" content="{{$seo['twitter']['description']??''}}">
<meta name="twitter:image" content="{{$seo['twitter']['image']??''}}">
<meta name="twitter:url" content="{{$seo['twitter']['url']??''}}">
{{-- <meta name="twitter:creator" content="@YourTwitterHandle"> --}}
@endisset

@isset($seo['is_canonicals'])
@foreach($seo['canonical'] as $cc=>$can)
    @if(isset($seo['canonical']) && is_array($seo['canonical']) && count($seo['canonical'])>0)
        @foreach($seo['canonical'] as $can)
            <link rel="canonical" href="{{($can)??''}}" />
        @endforeach
    @else
    <link rel="canonical" href="{{url('/')}}" />
    @endif
@endforeach
@endisset

@isset($seo['is_schema'])
{!! $schema??'' !!}
@endisset