<?php

namespace STG\models;

use StoutLogic\AcfBuilder\FieldBuilder;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class STG_Block
 *
 */
class STG_Block
{
    private string $path        = '';
    private string $slug        = '';
    private string $title       = '';
    private string $description = '';
    private array  $category    = [];
    private string $icon        = 'wordpress';
    private array  $keywords    = [];
    private string $mode        = 'preview';
    private string $align       = 'wide';
    private array  $supports    = [];
    private array  $posts       = ['post', 'page'];
    private mixed  $assets      = null;
    private mixed  $fields      = null;

    /**
     * STG_Block constructor.
     */
    function __construct(
        string $path = '',
        string $slug = '',
        string $title = '',
        string $description = '',
        array $category = [],
        string $icon = 'wordpress',
        array $keywords = [],
        string $mode = 'preview',
        string $align = 'wide',
        array $supports = [],
        array $posts = ['post', 'page'],
        mixed $assets = null,
        mixed $fields = null
    ) {
        $this->path        = $path;
        $this->slug        = $slug;
        $this->title       = $title;
        $this->description = $description;
        $this->category    = $category;
        $this->icon        = $icon;
        $this->keywords    = $keywords;
        $this->mode        = $mode;
        $this->align       = $align;
        $this->supports    = $supports;
        $this->posts       = $posts;
        $this->assets      = $assets;
        $this->fields      = $fields;

        if (!empty($this->slug)) {
            $this->categoryExists();
            $this->register();
        }

        if($this->fields) {
            acf_add_local_field_group($this->fields->build());
        }
    }

    /**
     * Ensure the block category exists, create if it doesn't
     */
    private function categoryExists(): void
    {
        if (empty($this->category)) {
            return;
        }

        add_filter('block_categories_all', function($categories) {
            $category_exists = false;

            foreach ($categories as $category) {
                if ($category['slug'] === $this->category['slug']) {
                    $category_exists = true;
                    break;
                }
            }

            if (!$category_exists) {
                $dashicon = isset($this->category['icon']) ? 'dashicons-' . $this->category['icon'] : null;

                $categories[] = [
                    'slug'  => $this->category['slug'],
                    'title' => ucfirst($this->category['title']),
                    'icon'  => $dashicon
                ];
            }

            return $categories;
        });
    }

    /**
     * Register the block
     */
    private function register(): void
    {
        acf_register_block_type([
            'name'                  => $this->slug,
            'title'                 => $this->title,
            'description'           => $this->description,
            'category'              => $this->category['slug'],
            'icon'                  => $this->icon,
            'keywords'              => $this->keywords,
            'mode'                  => $this->mode,
            'align'                 => $this->align,
            'supports'              => $this->supports,
            'enqueue_style'         => STG_PLUGIN_URL . "public/blocks/$this->path/$this->slug/style.css",
            'enqueue_script'        => STG_PLUGIN_URL . "public/blocks/$this->path/$this->slug/script.js",
            'enqueue_assets'        => $this->assets,
            'post_types'            => $this->posts,
            'render_callback'       => [$this, 'render'],
            'supports_inner_blocks' => false,
        ]);
    }

    /**
     * Render the block
     */
    public function render($block): void
    {
        echo BLADE->view("blocks.$this->path.$this->slug.index", [
            'data' => $this->data(),
            'block' => $block
        ]);
    }

    protected function data(): array
    {
        return [];
    }
}
