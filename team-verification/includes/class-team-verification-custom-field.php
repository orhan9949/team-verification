<?php

class Team_Verification_Custom_Fields {
    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'acf/init', [ $this, 'register_team_verification_custom_fields' ] );
    }

    /**
     * Register Cryptocurrency Custom Fields.
     */
    public function register_team_verification_custom_fields() {
        acf_add_local_field_group( [
            'key'                    => 'group_team_verification',
            'title'                  => __( 'Team Verification', 'team-verification' ),
            'fields'                 => [
                [
                    'key'            => 'field_team_verification_allow_verify',
                    'label'          => __( 'Allow to verify', 'team-verification' ),
                    'name'           => 'team_verification_allow_verify',
                    'type'           => 'true_false',
                    'default_value'  => 0,
                    'ui'             => 1,
                    'ui_on_text'     => __( 'Yes', 'team-verification' ),
                    'ui_off_text'    => __( 'No', 'team-verification' ),
                ],
                [
                    'key'               => 'field_team_verification_linkedin',
                    'label'             => __( 'Linkedin', 'team-verification' ),
                    'name'              => 'team_verification_linkedin',
                    'type'              => 'text',
                    'required'          => 0,
                    'instructions'      => __( 'Please enter your Linkedin nickname as in the example. Example: cryptodotnews', 'team-verification' ),
                    'conditional_logic' => [
                        [
                            [
                                'field'     => 'field_team_verification_allow_verify',
                                'operator'  => '==',
                                'value'     => '1',
                            ],
                        ],
                    ],
                ],
                [
                    'key'               => 'field_team_verification_x',
                    'label'             => __( 'X', 'team-verification' ),
                    'name'              => 'team_verification_x',
                    'type'              => 'text',
                    'instructions'      => __( 'Please enter your X nickname as in the example. Example: cryptodotnews', 'team-verification' ),
                    'conditional_logic' => [
                        [
                            [
                                'field'     => 'field_team_verification_allow_verify',
                                'operator'  => '==',
                                'value'     => '1',
                            ],
                        ],
                    ],
                ],
                [
                    'key'               => 'field_team_verification_telegram',
                    'label'             => __( 'Telegram', 'team-verification' ),
                    'name'              => 'team_verification_telegram',
                    'type'              => 'text',
                    'instructions'      => __( 'Please enter your Telegram nickname as in the example. Example: cryptodotnews', 'team-verification' ),
                    'conditional_logic' => [
                        [
                            [
                                'field'     => 'field_team_verification_allow_verify',
                                'operator'  => '==',
                                'value'     => '1',
                            ],
                        ],
                    ],
                ],

            ],
            'menu_order'            => 0,
            'label_placement'       => 'left',
            'instruction_placement' => 'field',
            'location'              => [
                [
                    [
                        'param'     => 'user_form',
                        'operator'  => '==',
                        'value'     => 'edit',
                    ]
                ]
            ],
        ] );
    }

}

new Team_Verification_Custom_Fields;