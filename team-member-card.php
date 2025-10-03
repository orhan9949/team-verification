<?php

/**
 * Team Memeber Card.
 */

$user_id = $args['user_id'] ?? false;

 if ( false == $user_id ) {
    return;
}

$user = get_userdata( $args['user_id'] );

$name          = $user->user_firstname . ' ' . $user->user_lastname;
$color         = get_field( 'user_color', 'user_' . $user_id );
$position      = get_field( 'user_position', 'user_' . $user_id );
$photo         = get_field( 'user_photo_transparent', 'user_' . $user_id );
$external_link = get_field( 'user_external_link', 'user_' . $user_id );

$link = get_author_posts_url( $user_id );

if ( $external_link ) {
    $link = $external_link['url'];
}
?>

<div class="team-member-card">

    <div class="team-member-card__media" style="background-color: <?php echo $color; ?>">

        <?php if ( $photo ) : ?>

            <img src="<?php echo $photo['url']; ?>" class="team-member-card__photo" alt="<?php echo $name; ?>" loading="lazy">

        <?php else : ?>

            <?php echo get_avatar( $user_id, '320', '', $name, [
                'class' => 'team-member-card__photo'
            ] ); ?>

        <?php endif; ?>

    </div><!-- .team-member-card__media -->

    <p class="team-member-card__name">
        <?php echo $name; ?>
    </p>

    <?php if ( $position ) : ?>

        <p class="team-member-card__position">
            <?php echo $position; ?>
        </p>

    <?php endif; ?>

    <a href="<?php echo $link; ?>" class="team-member-card__link">
        <?php printf( __( 'Read more about %s', 'base' ), $name ); ?>
    </a>

    <div class="team-member-card__social">

        <?php if ( $telegram_link = get_user_meta($user->ID, 'telegram' , true) ) : ?>

            <?php get_template_part( 'template-parts/components/social-link', null, [
                'show_label' => false,
                'icon'       => 'telegram',
                'link'       => $telegram_link,
                'label'      => __( 'Telegram', 'base' ),
                'style'      => 'outline'
            ] ); ?>

        <?php endif; ?>

        <?php if ( $linkedin_link = get_user_meta($user->ID, 'linkedin' , true) ) : ?>

            <?php get_template_part( 'template-parts/components/social-link', null, [
                'show_label' => false,
                'icon'       => 'linkedin',
                'link'       => $linkedin_link,
                'label'      => __( 'LinkedIn', 'base' ),
                'style'      => 'outline'
            ] ); ?>

        <?php endif; ?>

        <?php if ( $twitter_link = get_user_meta($user->ID, 'twitter' , true) ) : ?>

            <?php get_template_part( 'template-parts/components/social-link', null, [
                'show_label' => false,
                'icon'       => 'twitter',
                'link'       => 'https://x.com/' . $twitter_link,
                'label'      => __( 'Twitter', 'base' ),
                'style'      => 'outline'
            ] ); ?>

        <?php endif; ?>

        <?php if ( $facebook_link = get_user_meta($user->ID, 'facebook' , true) ) : ?>

            <?php get_template_part( 'template-parts/components/social-link', null, [
                'show_label' => false,
                'icon'       => 'facebook',
                'link'       => $facebook_link,
                'label'      => __( 'Facebook', 'base' ),
                'style'      => 'outline'
            ] ); ?>

        <?php endif; ?>

    </div><!-- .team-member-card__social -->

</div><!-- .team-member-card -->