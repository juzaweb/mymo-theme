<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Theme\Actions;

use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Juzaweb\Models\Taxonomy;
use Theme\Widgets\GenreMovie;
use Theme\Widgets\SliderMovie;

class MainAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addStyles']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addBodyClass']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addHeaderScript']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'registerAjaxs']);
        $this->addAction(Action::JUZAWEB_INIT_ACTION, [$this, 'registerTemplates']);
        $this->addAction(Action::WIDGETS_INIT, [$this, 'registerSidebars']);
        $this->addAction(Action::WIDGETS_INIT, [$this, 'registerWidgets']);
    }

    public function addBodyClass()
    {
        $this->addFilter('theme.body_class', function ($class) {
            return $class . ' home blog wp-embed-responsive mymothemes mymomovies mymo-corner-rounded';
        });
    }

    public function addHeaderScript()
    {
        $this->addAction('theme.header', function () {
            echo e(view('theme::components.header_script'));
        });
    }

    public function addStyles()
    {
        HookAction::enqueueFrontendScript('main', 'assets/js/main.js');
        HookAction::enqueueFrontendStyle('main', 'assets/css/main.css');
    }

    public function registerAjaxs()
    {
        HookAction::registerFrontendAjax('mymo_filter_form', [
            'callback' => [$this, 'getFilterForm'],
        ]);
    }

    public function getFilterForm()
    {
        $genres = Taxonomy::where('taxonomy', '=', 'genres')
            ->get(['id', 'name']);
        $countries = Taxonomy::where('taxonomy', '=', 'countries')
            ->get(['id', 'name']);
        $years = Taxonomy::where('taxonomy', '=', 'years')
            ->get(['id', 'name']);

        return view('theme::components.filter_form', [
            'genres' => $genres,
            'countries' => $countries,
            'years' => $years,
        ]);
    }

    public function registerTemplates()
    {
        HookAction::registerThemeTemplate('home', [
            'name' => trans('theme::app.home'),
            'view' => 'templates.home',
        ]);
    }

    public function registerSidebars()
    {
        HookAction::registerSidebar('home', [
            'label' => trans('theme::app.home'),
            'description' => trans('theme::app.home_page_sidebar'),
        ]);

        HookAction::registerSidebar('sidebar', [
            'label' => trans('theme::app.sidebar'),
            'description' => trans('theme::app.sidebar_page'),
        ]);
    }

    public function registerWidgets()
    {
        HookAction::registerWidget('slider_movie', [
            'label' => trans('theme::app.slider_movie'),
            'description' => trans('theme::app.slider_movie_description'),
            'widget' => new SliderMovie(),
        ]);

        HookAction::registerWidget('genre_movie', [
            'label' => trans('theme::app.genre_movie'),
            'description' => trans('theme::app.genre_movie_description'),
            'widget' => new GenreMovie(),
        ]);
    }
}
