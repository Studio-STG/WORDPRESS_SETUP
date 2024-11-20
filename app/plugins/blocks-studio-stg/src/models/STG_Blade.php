<?php

namespace STG\models;

use Jenssegers\Blade\Blade;
use Jenssegers\Blade\Container;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class STG_Blade
 *
 * Manages the Blade template engine instance.
 */
class STG_Blade
{
    private Blade $blade;
    private Container $container;
    private static ?STG_Blade $instance = null;

    /**
     * Returns the singleton instance of the class.
     *
     * @return STG_Blade Instance of the class.
     */
    public static function getInstance(): STG_Blade
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Private constructor to configure Blade and container.
     */
    private function __construct()
    {
        $views = STG_PLUGIN_DIR . 'src/views';
        $cache = STG_PLUGIN_DIR . 'public/cache';

        if (!file_exists($cache) && !mkdir($cache, 0755, true) && !is_dir($cache)) {
            error_log(sprintf('Directory "%s" could not be created', $cache));
        }

        $this->container = new Container();
        Container::setInstance($this->container);

        $this->blade = new Blade(
            $views,
            $cache,
            $this->container
        );
    }

    /**
     * Renders a Blade view with optional data.
     *
     * @param string $view Name of the view to render.
     * @param array $data Optional data to pass to the view.
     * @return string Rendered view output or an error message.
     */
    public function view(string $view, array $data = []): string
    {
        try {
            return $this->blade->render($view, $data);
        } catch (\Exception $e) {
            return 'Error rendering view: ' . $e->getMessage();
        }
    }

    /**
     * Registers a custom Blade directive.
     *
     * @param string $name Name of the directive.
     * @param callable $handler Handler function for the directive.
     */
    public function directive(string $name, callable $handler): void
    {
        $this->blade->compiler()->directive($name, $handler);
    }
}
