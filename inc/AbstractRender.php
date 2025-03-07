<?php
declare(strict_types=1);

namespace Contributor;

abstract class AbstractRender {

    /**
     * Render view
     *
     * @param string $template Template slug.
     * @param array  $data Data to pass to the template.
     */
    public function render_view( string $template, array $data = array() ) {
        $template_path =  constant( 'RT_CONTRIBUTOR_TEMPLATE_PATH' ) . '/' . $template . '.php';

        ob_start();

        include $template_path;

        return trim( ob_get_clean() );
    }
}
