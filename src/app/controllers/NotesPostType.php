<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\NotesBaseController;

/**
 * Class NotesPostType
 * @package DWNotes\App
 */
class NotesPostType extends NotesBaseController
{
    public function init()
    {
        //pad taxonomy
        $labels = [
            'name' => _x('Pads', 'taxonomy general name', 'dw_notes'),
            'singular_name' => _x('Pad', 'taxonomy singular name', 'dw_notes'),
            'search_items' => __('Search Pads', 'dw_notes'),
            'all_items' => __('All Pads', 'dw_notes'),
            'parent_item' => __('Parent Pad', 'dw_notes'),
            'parent_item_colon' => __('Parent Pad:', 'dw_notes'),
            'edit_item' => __('Edit Pad', 'dw_notes'),
            'update_item' => __('Update Pad', 'dw_notes'),
            'add_new_item' => __('Add New Pad', 'dw_notes'),
            'new_item_name' => __('New Pad Name', 'dw_notes'),
            'menu_name' => __('Pads', 'dw_notes'),
        ];
        $args = [
            'hierarchical' => true, // make it hierarchical (like categories)
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'pad'],
        ];
        \register_taxonomy('pad', ['post'], $args);

        // notes custom type
        $labels = array(
            'name' => __('Notes', 'dw_notes'),
            'singular_name' => __('Notes', 'dw_notes'),
            'menu_name' => __('Notes', 'dw_notes'),
            'name_admin_bar' => __('Notes', 'dw_notes'),
            'add_new' => __('Add New', 'dw_notes'),
            'add_new_item' => __('Add new note', 'dw_notes'),
            'new_item' => __('New note', 'dw_notes'),
            'edit_item' => __('Edit note', 'dw_notes'),
            'view_item' => __('View note', 'dw_notes'),
            'all_items' => __('All notes', 'dw_notes'),
            'search_items' => __('Search notes', 'dw_notes'),
            'parent_item_colon' => __('Parent notes:', 'dw_notes'),
            'not_found' => __('No notes found.', 'dw_notes'),
            'not_found_in_trash' => __('No notes found in Trash.', 'dw_notes'),
        );

        $args = array(
            'labels' => $labels,
            'description' => __('A custom post type for notes.', 'dw_notes'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'dw-notes'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 20,
            'supports' => array('title', 'editor', 'author', 'thumbnail'),
            'taxonomies' => array('pad', 'post_tag'),
        );

        \register_post_type('dw_notes', $args);
    }
}
