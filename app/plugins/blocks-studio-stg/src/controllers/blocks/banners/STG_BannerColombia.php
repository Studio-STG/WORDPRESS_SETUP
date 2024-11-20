<?php

namespace STG\controllers\blocks\banners;

use StoutLogic\AcfBuilder\FieldsBuilder;
use STG\models\STG_Block;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class STG_BannerColombia
 *
 */
final class STG_BannerColombia extends STG_Block
{
    private string $path = 'banners';

    /**
     * Define the block slug
     */
    private string $slug = 'banner-colombia';

    /**
     * Define the block title
     */
    private string $title = 'Bloco de banner Colombia';

    /**
     * Define the block description
     */
    private string $description = 'Bloco de banner Colombia';

    /**
     * Define the block category
     */
    private array $category = [
        'slug'  => 'stg-blocks-banners',
        'title' => 'Blocos Banners STG',
        'icon'  => 'wordpress'
    ];

    /**
     * Define the block icon
     */
    private string $icon = 'wordpress';

    /**
     * Define the block keywords
     */
    private array $keywords = ['banner', 'block', 'stg', 'japão'];

    /**
     * Define the block mode
     *
     * Options: preview, edit, auto
     */
    private string $mode = 'edit';

    /**
     * Define the block alignment
     *
     * Options: wide, full, left, center, right
     */
    private string $align = 'wide';

    /**
     * Define the block post type
     */
    private array $posts = ['page', 'post'];

    /**
     * Define the block supports
     */
    private array $supports = [
        'align'           => ['full'],
        'mode'            => true,
        'jsx'             => true,
        'multiple'        => true,
        'anchor'          => true,
        'reusable'        => true,
        'customClassName' => true
    ];

    /**
     * Define the block assets
     */
    public function __construct()
    {
        parent::__construct(
            path:        $this->path,
            slug:        $this->slug,
            title:       $this->title,
            description: $this->description,
            category:    $this->category,
            icon:        $this->icon,
            keywords:    $this->keywords,
            mode:        $this->mode,
            align:       $this->align,
            supports:    $this->supports,
            posts:       $this->posts,
            assets:      $this->enqueue(),
            fields:      $this->fields()
        );
    }

    /**
     * Define the block fields
     */
    private function fields(): FieldsBuilder
    {
        $field = new FieldsBuilder($this->slug);

        $field
            ->addAccordion('accordion', [
                'label' => "Bloco - $this->title ",
            ])
                ->addGroup('content', ['label' => ''])
                    ->addAccordion('accordion_content', [
                        'label'        => 'Conteúdo',
                        'instructions' => 'Adicione o conteúdo referente ao bloco',
                    ])
                        ->addTab('tab_header', [
                            'placement' => 'top',
                            'label'     => 'Cabeçalho',
                        ])
                            ->addGroup('header', ['label' => ''])
                                ->addWysiwyg('title', [
                                    'label'        => 'Título',
                                    'media_upload' => 0,
                                    'tabs'         => 'visual',
                                ])
                                ->addWysiwyg('sub_title', [
                                    'label'        => 'Subtítulo',
                                    'media_upload' => 0,
                                ])
                            ->endGroup()

                        ->addTab('cards', [
                            'placement' => 'top',
                            'label'     => 'Cards',
                        ])
                            ->addRepeater('cards', [
                                'label'        => 'Cards',
                                'layout'       => 'block',
                                'button_label' => 'Adicionar Card',
                            ])
                                        ->addImage('image', [
                                            'label'        => 'Imagem',
                                            'preview_size' => 'thumbnail',
                                        ])
                                        ->addText('title', [
                                            'label' => 'Título',
                                        ])
                                        ->addTextarea('content', [
                                            'label' => 'Conteúdo',
                                        ])
                            ->endRepeater()
                    ->addAccordion('accordion_content_end')->endpoint()
                ->endGroup()

                ->addGroup('config', ['label' => ''])
                    ->addAccordion('accordion_config', [
                        'label'        => 'Configurações',
                        'instructions' => 'Adicione as configurações referentes ao bloco',
                    ])
                        ->addTab('tab_head', [
                            'placement' => 'top',
                            'label'     => 'Cabeçalho',
                        ])
                            ->addGroup('head', ['label' => ''])
                                ->addRange('padding_bottom', [
                                    'label'  => 'Espaçamento interno inferior',
                                    'min'    => 0,
                                    'max'    => 20,
                                    'step'   => 1,
                                    'append' => 'rem',
                                ])
                            ->endGroup()
                    ->addAccordion('accordion_config_end')->endpoint()
                ->endGroup()
            ->addAccordion('accordion_end')->endpoint();

        $field
            ->setLocation('block', '==', "acf/$this->slug");

        return $field;
    }

    /**
     * Define the block data
     *
     * Override this method to define the block data
     */
    public function data(): array
    {
        return get_fields();
    }

    /**
     * Enqueue the block assets
     */
    public function enqueue(): void
    {
        //
    }
}