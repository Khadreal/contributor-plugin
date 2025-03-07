<?php
declare(strict_types=1);

namespace Contributor\Admin;

use Contributor\AbstractRender;

/**
 * Admin related settings
 */
class Admin extends AbstractRender {

    /**
     * Register callbacks.
     *
     * @return void
     */
    public function register_callbacks(): void {
        add_action( 'add_meta_boxes', array( $this, 'action_add_contributors_meta' ) );
        add_action( 'save_post', array( $this, 'action_save_contributors' ) );
    }

    /**
     * Add contributors metabox
     */
    public function action_add_contributors_meta() {
        add_meta_box(
            'rt_contributors_metabox',
            'Contributors',
            array( $this, 'rt_render_contributors_metabox' ),
            'post',
            'side',
            'default'
        );
    }

    /**
     * Metabox rendering
     *
     * @param mixed $post Post data.
     *
     * @return void
     */
    public function rt_render_contributors_metabox( $post ): void {
        $users = get_users( array( 'role__in' => array( 'administrator', 'editor', 'author' ) ) );
        $selected_contributors = get_post_meta( $post->ID, '_rt_contributors', true ) ?: array();

        wp_nonce_field( 'rt_save_contributors', 'rt_contributors_nonce');

        $data = array(
            'users' => $users,
            'selected_contributors' => $selected_contributors,
        );

        echo $this->render_view( 'contributors-meta-box', $data ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Save contributors
     *
     * @param int $post_id Post ID.
     *
     * @return void
     */
    public function action_save_contributors( int $post_id ): void {
        if ( ! isset( $_POST[ 'pc_contributors_nonce' ] )
            || ! wp_verify_nonce( $_POST['pc_contributors_nonce'], 'rt_save_contributors' )
        ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $contributors = isset( $_POST['rt_contributors'] ) ? array_map('intval', $_POST['rt_contributors']) : array();

        update_post_meta( $post_id, '_rt_contributors', $contributors );
    }
}
