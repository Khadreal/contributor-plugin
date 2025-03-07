<?php
defined( 'ABSPATH' ) || exit;

$data = isset( $data ) ? $data : [];
?>

<ul style="margin:0; padding:0; list-style:none;">
    <?php foreach ( $data['users'] as $user ) :
        $checked = in_array( $user->ID, (array) $data['selected_contributors'] , true ) ? 'checked' : '';
    ?>
    <li>
        <label>
            <input type="checkbox" name="rt_contributors[]" value="<?php esc_attr( $user->ID ); ?>" <?php esc_attr( $checked ); ?> >
            <?php echo esc_html($user->display_name); ?>
        </label>
    </li>

    <?php endforeach;  ?>
</ul>