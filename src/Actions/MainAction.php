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

class MainAction extends Action
{
    public function handle()
    {
        $this->addAction('theme.call_action', [$this, 'addBodyClass']);
        $this->addAction('theme.call_action', [$this, 'addHeaderScript']);

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
}