@component('juzaweb::widgets.input', [
    'label' => trans('theme::app.title'),
    'name' => 'title',
    'value' => $data['title'] ?? ''
])@endcomponent

@component('juzaweb::widgets.select_taxonomy', [
    'name' => 'genres[]',
    'value' => $data['genres'] ?? [],
    'post_type' => 'movies',
    'multiple' => true,
    'label' => trans('theme::app.genre'),
])@endcomponent
