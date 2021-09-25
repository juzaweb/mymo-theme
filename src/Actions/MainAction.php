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

class MainAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addStyles']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addBodyClass']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addHeaderScript']);

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
            echo e(view('theme::data.header_script'));
        });
    }

    public function addStyles()
    {
        HookAction::enqueueFrontendScript('main', 'assets/js/main.js');
        HookAction::enqueueFrontendStyle('main', 'assets/css/main.css');
    }
}