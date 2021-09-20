@extends('juzaweb::layouts.frontend')

@section('content')
    {{ get_template_part($post, 'single') }}
@endsection