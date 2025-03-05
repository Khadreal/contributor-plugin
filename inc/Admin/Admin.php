<?php
declare(strict_types=1);

namespace Contributor\Admin;

/**
 * Admin related settings
 */
class Admin {

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
     */
    public function rt_render_contributors_metabox( $post ) {
        $users = get_users( array( 'role__in' => array( 'administrator', 'editor', 'author' ) ) );
        $selected_contributors = get_post_meta( $post->ID, '_rt_contributors', true ) ?: array();

        wp_nonce_field( 'rt_save_contributors', 'rt_contributors_nonce');

        echo $this->render_view( 'contributors', array(
            'users' => $users,
            'selected_contributors' => $selected_contributors
        ) );
    }

    /**
     * Save contributors
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

    /**
     * Render view
     *
     * @param string $template Template slug.
     * @param array $data Data to pass to the template.
     *
     *
    */
    private function render_view( string $template, array $data = [] ) {
        $template_path =  constant( 'RT_CONTRIBUTOR_TEMPLATE_PATH' ) . '/' . $template . '.php';

        ob_start();

        include $template_path;

        return trim( ob_get_clean() );
    }
}
