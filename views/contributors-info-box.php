<?php
defined( 'ABSPATH' ) || exit;

$data = isset( $data ) ? $data : array();
?>

<div class="rt-contributors-box" style="border:1px solid #ddd; padding:10px; margin-top:20px;">
    <h4><?php esc_html_e( 'Contributors', 'rt-contributors' ); ?></h4>
    <?php foreach ( $data['contributors'] as $contributor ) :
    ?>
        <li>
            <?php echo esc_html( $contributor['avatar'] ); ?>
            <a href="<?php echo esc_url( $contributor['url'] ); ?>">
                <?php echo esc_html( $contributor['name'] ); ?>
            </a>
        </li>

    <?php endforeach; ?>
</div>
