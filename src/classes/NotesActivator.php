<?php

namespace DWNotes\Classes;

/**
 * Fired during plugin activation.
 *
 * @see       ditsweb.com
 * @since      1.0.0
 *
 * @author     ditsweb <dits.web.2017@gmail.com>
 */
class NotesActivator
{
    /**
     * Short Description. (use period).
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
	    (new NotesPostType())->init();
	    flush_rewrite_rules();

    }
}
