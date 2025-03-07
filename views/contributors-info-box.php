<?php
defined( 'ABSPATH' ) || exit;

$data = isset( $data ) ? $data : array();
?>

<div class="pc-contributors-box" style="border:1px solid #ddd; padding:10px; margin-top:20px;">
    <h4><?php esc_html_e( 'Contributors', 'rt-contributors' ); ?></h4>
    <?php foreach ( $data['contributors'] as $contributor_id ) :
        $user_info = get_userdata( $contributor_id );
        $avatar = get_avatar( $contributor_id, 32 );
        $author_link = get_author_posts_url( $contributor_id );
    ?>

    <?php endforeach; ?>
</div>
