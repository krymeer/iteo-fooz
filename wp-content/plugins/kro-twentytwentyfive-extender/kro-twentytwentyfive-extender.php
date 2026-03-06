<?php
/**
 * Plugin Name: KRO Twenty Twenty-Five Extender
 * Text Domain: kro-ttfe
 * Description: TBD
 * Version: 0.0.1
 * Author: Krzysztof Osada
 */
defined( 'ABSPATH' ) || exit;

class KRO_TwentyTwentyFive_Extender {
    const NAMESPACE  = 'kro-ttfe/v1';
    public static $plugin_url;

    public function __construct()
    {
        $this->plugin_url = plugin_dir_url( __FILE__ );
        add_action( 'init', [ $this, 'register_post_type' ] );
        add_action( 'init', [ $this, 'register_taxonomy' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function enqueue_styles() : void
    {
        wp_enqueue_style( 'kro-ttfe', "{$this->plugin_url}assets/css/kro-ttfe.min.css", [], 1772712462, 'screen' );
    }

    public function enqueue_scripts() : void
    {
        wp_enqueue_script( 'kro-ttfe', "{$this->plugin_url}assets/js/kro-ttfe.min.js", [], 1772712462, [ 'in_footer' => true ] );
        wp_enqueue_script( 'kro-ttfe-additional', "{$this->plugin_url}assets/js/scripts.js", [ 'kro-ttfe' ], 1772713773, [ 'in_footer' => true ] );
    }

    public function register_block_template() : void
    {
        $templates = [
            ( object )[
                'template_slug'        => 'single-book',
                'template_ext'         => 'html',
                'template_title'       => __( 'Single Book', 'kro-ttfe' ),
                'template_description' => __( 'Template for single books', 'kro-ttfe' ),
            ]
        ];

        foreach( $templates as $template )
        {
            $template_path = "{$this->plugin_dir}templates/{$template->template_slug}.{$template->template_ext}";

            if( file_exists( $template_path ) )
            {
                $template_content = file_get_contents( $template_path );

                register_block_template( "kro-ttfe//{$template->template_slug}", [
                    'title'       => $template->template_title,
                    'description' => $template->template_description,
                    'content'     => $template_content,
                    'post_types'  => [ 'book' ],
                    'plugin'      => 'kro-twentytwentyfive-extender',
                ] );
            }
        }
    }

    public function register_block_pattern() : void
    {
        $patterns = [
            ( object )[
                'pattern_slug'  => 'written-by',
                'pattern_ext'   => 'php',
                'pattern_title' => __( 'Written by', 'twentytwentyfive' ),
            ],
            ( object )[
                'pattern_slug'  => 'published-on',
                'pattern_ext'   => 'php',
                'pattern_title' => __( 'Published on', 'kro-ttfe' ),
            ]
        ];

        foreach( $patterns as $pattern )
        {
            $pattern_path = "{$this->plugin_dir}patterns/{$pattern->pattern_slug}.{$pattern->pattern_ext}";

            if( file_exists( $pattern_path ) )
            {
                ob_start();
                include $pattern_path;
                $pattern_content = ob_get_clean();
                register_block_pattern( "kro-ttfe/{$pattern->pattern_slug}", [
                        'title'   => $pattern->pattern_title,
                        'content' => $pattern_content
                    ]
                );
            }
        }
    }

    public function register_taxonomy() : void
    {
        register_taxonomy( 'book-genre', [ 'book' ], [
            'hierarchical'      => true,
            'labels'            => [
                'name'              => _x( 'Book Genres', 'taxonomy general name', 'kro-ttfe' ),
                'singular_name'     => _x( 'Book Genre', 'taxonomy singular name', 'kro-ttfe' ),
                'search_items'      => __( 'Search Genres', 'kro-ttfe' ),
                'all_items'         => __( 'All Genres', 'kro-ttfe' ),
                'parent_item'       => __( 'Parent Genre', 'kro-ttfe' ),
                'parent_item_colon' => __( 'Parent Genre:', 'kro-ttfe' ),
                'edit_item'         => __( 'Edit Genre', 'kro-ttfe' ),
                'update_item'       => __( 'Update Genre', 'kro-ttfe' ),
                'add_new_item'      => __( 'Add New Genre', 'kro-ttfe' ),
                'new_item_name'     => __( 'New Genre Name', 'kro-ttfe' ),
                'menu_name'         => __( 'Genres', 'kro-ttfe' ),
            ],
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => 'book-genre' ],
            'show_in_rest'      => true
        ] );
    }

    public function register_post_type() : void
    {
        register_post_type( 'book', [
            'public'          => true,
            'query_var'       => false,
            'hierarchical'    => false,
            'has_archive'     => 'library',
            'capability_type' => 'post',
            'menu_position'   => 10,
            'menu_icon'       => 'dashicons-book',
            'show_in_rest'    => true,
            'rewrite'         => [
                'slug' => 'library',
            ],
            'supports'        => [
                'revisions',
                'editor',
                'title',
                'author',
                'thumbnail',
                'excerpt',
                'comments'
            ],
            'labels'          => [
                'name'                  => _x( 'Books', 'Post type general name', 'kro-ttfe' ),
                'singular_name'         => _x( 'Book', 'Post type singular name', 'kro-ttfe' ),
                'menu_name'             => _x( 'Books', 'Admin Menu text', 'kro-ttfe' ),
                'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'kro-ttfe' ),
                'add_new'               => __( 'Add New', 'kro-ttfe' ),
                'add_new_item'          => __( 'Add New Book', 'kro-ttfe' ),
                'new_item'              => __( 'New Book', 'kro-ttfe' ),
                'edit_item'             => __( 'Edit Book', 'kro-ttfe' ),
                'view_item'             => __( 'View Book', 'kro-ttfe' ),
                'all_items'             => __( 'All Books', 'kro-ttfe' ),
                'search_items'          => __( 'Search Books', 'kro-ttfe' ),
                'parent_item_colon'     => __( 'Parent Books:', 'kro-ttfe' ),
                'not_found'             => __( 'No books found.', 'kro-ttfe' ),
                'not_found_in_trash'    => __( 'No books found in Trash.', 'kro-ttfe' ),
                'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'kro-ttfe' ),
                'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'kro-ttfe' ),
                'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'kro-ttfe' ),
                'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'kro-ttfe' ),
                'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'kro-ttfe' ),
                'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'kro-ttfe' ),
                'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'kro-ttfe' ),
                'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'kro-ttfe' ),
                'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'kro-ttfe' ),
                'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'kro-ttfe' ),
            ]
        ] );
    }
}

new KRO_TwentyTwentyFive_Extender();