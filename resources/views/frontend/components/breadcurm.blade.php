<!-- Breadscrumb Section -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                @if(isset($meta['heading']))<h2 class="breadcrumb-title">{{ ($meta['heading'])??'' }}</h2>@endif
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        @if(isset($meta['arr']))
                            @foreach($meta['arr'] as $i => $val1)
                                @if(array_key_last($meta['arr']) === $i)
                                    <li class="breadcrumb-item active" aria-current="page">{{ ($val1['title'])??'' }}</li>
                                @else
                                    <li class="breadcrumb-item"><a href="{{ url(($val1['link'])??'#') }}">{{ ($val1['title'])??'' }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ol>
                </nav>							
            </div>
        </div>
    </div>
</div>
<!-- /Breadscrumb Section -->