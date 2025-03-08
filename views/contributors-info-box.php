<?php
defined( 'ABSPATH' ) || exit;

$data = isset( $data ) ? $data : array();
error_log(print_r($data['contributors'], true));
?>

<div class="rt-contributors-box" style="border:1px solid #ddd; padding:10px; margin-top:20px;">
    <h4><?php esc_html_e( 'Contributors', 'rt-contributors' ); ?></h4>
    <?php foreach ( $data['contributors'] as $contributor ) :
    ?>
        <li>
            <?php echo $contributor['avatar']; ?>
            <a href="<?php echo $contributor['url']; ?>">
                <?php echo $contributor['name']; ?>
            </a>
        </li>

    <?php endforeach; ?>
</div>
