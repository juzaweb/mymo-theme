@extends('juzaweb::layouts.frontend')

@section('content')
    <div class="container">
        {{ get_template_part($post, 'single') }}
    </div>
@endsection