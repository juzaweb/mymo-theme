<div id="mymo-carousel-widget-3xx-{{ $key }}" class="wrap-slider">
    <div class="section-bar clearfix">
        <h3 class="section-title"><span>{{ $data['title'] ?? '' }}</span></h3>
    </div>

    <div id="mymo-carousel-widget-{{ $key }}" class="owl-carousel owl-theme">
        @if(!$genre->items->isEmpty())
            @foreach($genre->items as $item)
                <article class="thumb grid-item post-{{ $item->id }}">
                    {{ get_template_part($item, 'content') }}
                </article>
            @endforeach
        @endif
    </div>

    <script>
        jQuery(document).ready(function ($) {
            var owl = $("#mymo-carousel-widget-{{ $key }}");
            owl.owlCarousel({
                rtl: false,
                loop: true,
                margin: 4,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: false,
                navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                responsiveClass: true,
                responsive: {0: {items: 2}, 480: {items: 3}, 600: {items: 4}, 1000: {items: 6}}
            })
        });
    </script>
</div>