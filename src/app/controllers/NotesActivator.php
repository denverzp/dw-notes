<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\BaseController;

/**
 * Class NotesActivator.
 */
class NotesActivator extends BaseController
{
    public function handle()
    {
        (new NotesCustom($this->registry))->init();
        \flush_rewrite_rules();

        // create notes page on frontend
        $the_page_title = 'Notes';
        $the_page_name = 'notes';

        // the menu entry...
        \delete_option('dw_notes_page_title');
        \add_option('dw_notes_page_title', $the_page_title, '', 'yes');
        // the slug...
        \delete_option('dw_notes_page_name');
        \add_option('dw_notes_page_name', $the_page_name, '', 'yes');
        // the id...
        \delete_option('dw_notes_page_id');
        \add_option('dw_notes_page_id', '0', '', 'yes');

        $the_page = \get_page_by_title($the_page_title);

        if (!$the_page) {
            // Create post object
            $_p = [];
            $_p['post_title'] = $the_page_title;
            $_p['post_content'] = '[notes]';
            $_p['post_status'] = 'publish';
            $_p['post_type'] = 'page';
            $_p['comment_status'] = 'closed';
            $_p['ping_status'] = 'closed';
            $_p['post_category'] = [1]; // the default 'Uncategorised'

            // Insert the post into the database
            $the_page_id = wp_insert_post($_p);
        } else {
            // the plugin may have been previously active and the page may just be trashed...

            $the_page_id = $the_page->ID;

            //make sure the page is not trashed...
            $the_page->post_status = 'publish';
            $the_page_id = \wp_update_post($the_page);
        }

        \delete_option('dw_notes_page_id');
        \add_option('dw_notes_page_id', $the_page_id);
    }
}
