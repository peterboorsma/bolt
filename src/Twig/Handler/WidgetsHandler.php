<?php

namespace Bolt\Twig\Handler;

use Bolt\Helpers\Html;
use Bolt\Helpers\Str;
use Bolt\Legacy\Content;
use Maid\Maid;
use Silex;

/**
 * Bolt specific Twig functions and filters for HTML
 *
 * @internal
 */
class WidgetsHandler
{
    /** @var \Silex\Application */
    private $app;

    /**
     * @param \Silex\Application $app
     */
    public function __construct(Silex\Application $app)
    {
        $this->app = $app;
    }

    /**
     * Return the number of widgets in the queue for a given type / location.
     *
     * @param string $location Location (e.g. 'dashboard_aside_top')
     * @param string $type     Either 'frontend' or 'backend'
     *
     * @return integer
     */
    public function countWidgets($location, $type)
    {
        return $this->app['asset.queue.widget']->countItemsInQueue($location, $type);
    }

    /**
     * Gets a list of the registered widgets.
     *
     * @return array
     */
    public function getWidgets()
    {
        return $this->app['asset.queue.widget']->getQueue();
    }

    /**
     * Check if a type / location has widgets in the queue.
     *
     * @param string $location Location (e.g. 'dashboard_aside_top')
     * @param string $type     Either 'frontend' or 'backend'
     *
     * @return boolean
     */
    public function hasWidgets($location, $type)
    {
        return $this->app['asset.queue.widget']->hasItemsInQueue($location, $type);
    }

    /**
     * Renders a particular widget type on the given location.
     *
     * @param string $location Location (e.g. 'dashboard_aside_top')
     * @param string $type     Either 'frontend' or 'backend'
     *
     * @return \Twig_Markup|string
     */
    public function widgets($location, $type)
    {
        return $this->app['asset.queue.widget']->render($location, $type);
    }
}
