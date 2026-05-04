<marquee behavior="scroll" style="margin:20px 0 5px 0; font-size:{{$meta['font_size']??'20'}}px" scrollamount="{{$meta['speed']??4}}" direction="left" onmouseover="stop()" onmouseout="start()">
    @if(isset($meta['img']))
        <img src="{{$meta['img']}}" alt="News Flash" class="news_img">
    @endif
    @if(isset($meta['arr']))
        @foreach($meta['arr'] as $item)
            @php
                $line = $item['text'] ?? null;
            @endphp
            @if($line !== '')
            <span style="display:inline-block;margin-right:2.5rem;">{{ $line }}</span>
            @endif
        @endforeach
    @endif
</marquee>