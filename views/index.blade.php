@extends('juzaweb::layouts.frontend')

@section('content')
    <div class="row container" id="wrapper">
        <div class="mymo-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-8 hidden-xs">
                        {{ get_config('title') }}
                    </div>
                    <div class="col-xs-4 text-right">
                        <a href="javascript:;" id="expand-ajax-filter">@lang('theme::app.filter_movies') <i id="ajax-filter-icon" class="hl-angle-down"></i></a>
                    </div>
                    <div id="alphabet-filter" style="float: right;display: inline-block;margin-right: 25px;"></div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div><!-- end panel-default -->

        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-12">

            <section>
                <div class="section-bar clearfix">
                    <h3 class="section-title">
                        <span>@lang('theme::app.posts')</span>
                    </h3>
                </div>

                <div class="mymo_box">
                    @if($posts->isNotEmpty())
                        @foreach($posts as $post)
                            {{ get_template_part($post, 'content') }}
                        @endforeach
                    @else
                        {{ get_template_part(null, 'content', 'none' ) }}
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="text-center">
                    {{ $posts->links() }}
                </div>

            </section>
        </main>

    </div>
@endsection
