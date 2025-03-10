<?php
defined( 'ABSPATH' ) || exit;

$data = isset( $data ) ? $data : array();
?>

<div class="rt-contributors-box" style="border:1px solid #ddd; padding:10px; margin-top:20px;">
    <h4><?php esc_html_e( 'Contributors', 'rt-contributors' ); ?></h4>
    <ul style="list-style:none; font-size:16px; ">
    <?php foreach ( $data['contributors'] as $contributor ) :
    ?>
        <li style="margin-bottom: 8px;">
            <?php echo wp_kses_post( $contributor['avatar'] ); ?>
            <a href="<?php echo esc_url( $contributor['url'] ); ?>">
                <?php echo esc_html( $contributor['name'] ); ?>
            </a>
        </li>

    <?php endforeach; ?>
    </ul>
</div>
