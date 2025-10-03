<?php
wp_enqueue_script_module( '@cn/teamVerification' );

$context = [
    'ajaxurl'   => admin_url('admin-ajax.php'),
    'nonce'     => wp_create_nonce('team_verification_nonce'),
];

?>

<div class="team-verification"
     data-wp-interactive="teamVerification"
     data-wp-init="callbacks.init"
    <?php echo wp_interactivity_data_wp_context( $context ); ?>
>

    <div class="team-verification__container">

        <div class="team-verification__search">

            <form
                class="team-verification__form form__fields"
                data-wp-on--submit="actions.verification">

                <select class="team-verification__select form__select" data-wp-on--click="actions.getSelect">
                    <option class="team-verification__option" value="email"> <?php echo __( 'Email' , 'cn-team-verification' ); ?></option>
                    <option class="team-verification__option" value="telegram"><?php echo __( 'Telegram', 'cn-team-verification' ); ?></option>
                    <option class="team-verification__option" value="linkedin"><?php echo __( 'Linkedin', 'cn-team-verification' ); ?></option>
                    <option class="team-verification__option" value="x"><?php echo __( 'X', 'cn-team-verification' ); ?></option>
                </select>

                <input data-wp-bind--type="state.type"
                       class="team-verification__input--text form__field"
                       data-wp-bind--placeholder="state.requirements"
                       data-wp-on--input="actions.getValue"
                       required>

                <button type="submit" class="team-verification__button button"> <?php echo __( 'Сheck', 'cn-team-verification' ); ?> </button>

            </form>

        </div>

        <div class="team-verification__mistakes" data-wp-text="state.isMistake"></div>

        <div class="team-verification__result">

            <div class="team-verification__result--loader loader" data-wp-bind--hidden="!state.isLoading"></div>

            <div class="team-verification__result-card"></div>

            <div class="team-verification__result-error" data-wp-bind--hidden="!state.isError"><?php echo __( 'User not found', 'cn-team-verification' ); ?></div>

        </div>

    </div>

</div>