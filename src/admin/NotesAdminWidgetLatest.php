<?php

namespace DWNotes\Admin;

use DWNotes\App\Engine\View;
use DWNotes\App\Engine\BaseController;

/**
 * Class NotesAdminWidgetLatest.
 */
class NotesAdminWidgetLatest extends BaseController
{
    private $limit = 5;

    public function add_widget()
    {
        \wp_add_dashboard_widget('dw_notes_admin_widget_latest', 'Latest Notes', [$this, 'handler']);
    }

    public function handler()
    {
	    $latest_notes = \wp_get_recent_posts([
            'numberposts' => $this->limit,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'dw_notes',
            'post_status' => 'draft, publish, future, pending, private',
        ]);

        $view = new View('admin/templates/dw-notes-admin-widget-latest.tmpl');

        echo $view->render(compact('latest_notes'));
    }
}
