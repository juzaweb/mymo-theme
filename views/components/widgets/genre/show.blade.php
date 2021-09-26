<section id="mymo-advanced-widget-{{ $i }}">
    <h4 class="section-heading">
        <a href="{{ @$genre->url }}" title="{{ @$genre->title }}">
            <span class="h-text">{{ @$genre->title }}</span>
        </a>

        @if(@$home->{'genre' . $i}->child_genres)
            @php
                $child_genres = child_genres_setting($home->{'genre' . $i}->child_genres);
            @endphp
            <ul class="heading-nav pull-right hidden-xs">
                @foreach($child_genres as $child)
                    <li class="section-btn mymo_ajax_get_post" data-catid="{{ $child->id }}" data-showpost="12" data-widgetid="mymo-advanced-widget-{{ $i }}" data-layout="6col">
                        <span data-text="{{ $child->name }}"></span>
                    </li>
                @endforeach
            </ul>
        @endif
    </h4>

    <div id="mymo-advanced-widget-{{ $i }}-ajax-box" class="mymo_box">
        @if(!$genre->items->isEmpty())
            @foreach($genre->items as $item)
                <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-{{ $item->id }}">
                    @include('data.item')
                </article>
            @endforeach
        @endif

        <a href="{{ @$genre->url }}" class="see-more">@lang('theme::app.view_all') »</a>
    </div>
</section>
<div class="clearfix"></div>