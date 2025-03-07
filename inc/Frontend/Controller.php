<?php
declare(strict_types=1);

namespace Contributor\Frontend;

use Contributor\AbstractRender;

class Controller extends AbstractRender {
    /**
     * Register callbacks.
     *
     * @return void
     */
    public function register_callbacks(): void {
        add_filter( 'the_content', array( $this, 'filter_display_post_contributors' ) );
    }

    /**
     * Display the contributors on the frontend.
     *
     * @param string $content The content of the current post.
     */
    public function filter_display_post_contributors( string $content ) {
        // Bail early if it's not a single page.
        if ( ! is_single() ) {
            return $content;
        }

        $post_id = get_the_ID();
        $contributors = get_post_meta( $post_id, '_rt_contributors', true );
        if ( empty( $contributors ) ) {
            return $content;
        }
        $contributors_data = array();

        foreach ($contributors as $contributor_id) {
            $user = get_userdata( $contributor_id );
            if ( $user ) {
                $contributors_data[] = array(
                    'name' => esc_html( $user->display_name ),
                    'url'  => esc_url( get_author_posts_url( $contributor_id ) ),
                    'avatar' => get_avatar( $contributor_id, 32 ),
                );
            }
        }

        $contributors_html = $this->render_view('contributors-info-box', array( 'contributors' => $contributors_data ));

        return $content . $contributors_html;
    }
}
