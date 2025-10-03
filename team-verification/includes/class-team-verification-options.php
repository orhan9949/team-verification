<?php

/**
 * Verification Options.
 */

class Team_Verification_Options {
    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'acf/init', [ $this, 'add_options_page' ] );
        add_action( 'acf/init', [ $this, 'register_custom_fields' ] );
    }

    /**
     * Add options page.
     */
    public function add_options_page() {
        acf_add_options_sub_page( [
            'page_title'  => __( 'Verification Options', 'team-verification' ),
            'menu_title'  => __( 'Verification Options', 'team-verification' ),
            'menu_slug'   => 'team-verification-options',
            'capability'  => 'manage_options',
            'redirect'    => false,
            'icon_url'    => 'dashicons-format-chat',
            'parent_slug' => 'options-general.php'
        ] );
    }

    /**
     * Register custom fields.
     */
    public function register_custom_fields() {
        acf_add_local_field_group( [
            'key'              => 'group_team_verification_options',
            'title'            => __( 'Links Options', 'team-verification' ),
            'fields'           => [
                [
                    'key'            => 'field_team_verification_email',
                    'label'          => __( 'Email', 'team-verification' ),
                    'name'           => 'team_verification_email',
                    'type'           => 'textarea',
                    'rows'           => 10,
                    'placeholder'    => 'sales@crypto.news',
                    'instructions'   => __( 'Please enter Email as in the example. Example: sales@crypto.news', 'team-verification' )
                ],
                [
                    'key'            => 'field_team_verification_telegram',
                    'label'          => __( 'Telegram', 'team-verification' ),
                    'name'           => 'team_verification_telegram',
                    'type'           => 'textarea',
                    'rows'           => 10,
                    'placeholder'    => 'cryptodotnews',
                    'instructions'   => __( 'Please enter your Telegram nickname as in the example. Example: cryptodotnews', 'team-verification' )
                ],
                [
                    'key'            => 'field_team_verification_x',
                    'label'          => __( 'X', 'team-verification' ),
                    'name'           => 'team_verification_x',
                    'type'           => 'textarea',
                    'rows'           => 10,
                    'placeholder'    => 'cryptodotnews',
                    'instructions'   => __( 'Please enter your X nickname as in the example. Example: cryptodotnews', 'team-verification' )
                ],
                [
                    'key'            => 'field_team_verification_linkedin',
                    'label'          => __( 'Linkedin', 'team-verification' ),
                    'name'           => 'team_verification_linkedin',
                    'type'           => 'textarea',
                    'rows'           => 10,
                    'placeholder'    => 'cryptodotnews',
                    'instructions'   => __( 'Please enter your Linkedin nickname as in the example. Example: cryptodotnews', 'team-verification' )
                ],

            ],
            'menu_order'            => 510,
            'label_placement'       => 'top',
            'instruction_placement' => 'field',
            'location'              => [
                [
                    [
                        'param'     => 'options_page',
                        'operator'  => '==',
                        'value'     => 'team-verification-options',
                    ]
                ]
            ],
        ] );
    }
}

new Team_Verification_Options;