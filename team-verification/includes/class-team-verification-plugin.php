<?php

class CN_Team_Verification_Plugin {
    /**
     * Constructor.
     */
    public function __construct() {

        add_action( 'wp_enqueue_scripts', [ $this, 'add_module' ], 100 );
        add_action( 'wp_enqueue_scripts', [ $this, 'add_styles' ], 110 );
        add_action( 'wp_ajax_team_verification', [ $this, 'team_verification_ajax'] );
        add_action( 'wp_ajax_nopriv_team_verification', [ $this, 'team_verification_ajax'] );
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
        add_shortcode( 'team-verification', [ $this, 'shortcode'] );

    }

    /**
     * Loads the plugin's translated strings.
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'cn-team-verification', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages' );
    }

    /**
     * Register Team Verification Styles
     */
    public function add_styles() {
        $version = CN_ASSETS_VERSION_CSS;

        wp_enqueue_style( 'teamVerification', plugin_dir_url(__DIR__).'assets/css/style.css', [], $version );
    }

    /**
     * Register Team Verification JS
     */
    public function add_module() {

        $version = CN_ASSETS_VERSION_JS;

        wp_register_script_module(
            '@cn/teamVerification',
            plugin_dir_url(__DIR__) . 'assets/js/team-verification.js',
            ['@wordpress/interactivity'],
            $version
        );
    }

    /**
     * Team Verification AJAX
     *
     * @return void
     */
    public function team_verification_ajax() {

        $input      = sanitize_text_field($_GET['input']);
        $option     = sanitize_text_field($_GET['option']);
        $security   = sanitize_text_field($_GET['security']);

        wp_verify_nonce($security);

        if ($option === "email") {

            $userID = $this->verification_company($input, $option) ?: $this->email_verification($input);

        } else {

            $userID = $this->verification_company($input, $option) ?: $this->social_verification($input, $option);

        }

        if ( $userID === true ) {

            $html = $this->company_card_html( $input );

        } else {

            $html = $this->user_card_html( $userID );

        }

        wp_send_json_success( [ 'html' => $html ] );

    }

    /**
     * User card html
     *
     * @param $userID
     * @return false|string
     */
    public function user_card_html($userID ) {

        ob_start();

        get_template_part('template-parts/components/team-member-card', null, [
            'user_id' => $userID,
        ]);

        return ob_get_clean();

    }

    /**
     * Company card html
     *
     * @param $value
     * @return string
     */
    public function company_card_html( $value ) {

        return sprintf( __( 'This (%s) is the correct and primary email(social) of the crypto.news website', 'cn-team-verification' ), $value );

    }

    /**
     *  Email verification
     *
     * @param $input
     * @return false|int
     */
    public function email_verification( $input ) {

        $user = get_user_by( 'email', $input );

        if ( get_field( 'cn_team_verification_allow_verify', 'user_'.$user->ID ) ) {

            return $user->ID;

        }

        return false;

    }

    /**
     *  Verification Company
     *
     * @param $input
     * @param $option
     * @return false|int
     */
    public function verification_company( $input, $option ) {

        $data = get_field( 'cn_team_verification_'.$option, 'option' );

        if ( ! $data ) {

            return false;

        }

        $dataArray = array_map('trim', explode("\n", $data ) );

        if ( in_array( $input, $dataArray ) ) {

            return true;

        }

        return false;

    }

    /**
     *  Social Verification
     *
     * @param $input
     * @param $option
     * @return false|int
     */
    public function social_verification( $input, $option ) {

        $args = [
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key'   => 'cn_team_verification_'.$option,
                    'value' => $input,
                ],
                [
                    'key'   => 'cn_team_verification_allow_verify',
                    'value' => 1,
                ],
            ],
            'fields' => 'ID',
        ];

        $user_ids = get_users($args);

        if ( $user_ids[0] ) {

            return $user_ids[0];

        }

        return false;

    }

    /**
     * Shortcode
     *
     * @return string
     */
    public function shortcode() {

        ob_start();
        require_once  plugin_dir_path(__FILE__).'../pattern/team-verification.php';
        return ob_get_clean();

    }

}

new CN_Team_Verification_Plugin;