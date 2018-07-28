<?php

namespace DW\Classes;

class NotesPostType extends NotesBaseController
{
    public function init()
    {
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
            'rewrite' => array('slug' => 'dw_notes'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 20,
            'supports' => array('title', 'editor', 'author', 'thumbnail'),
            'taxonomies' => array('category', 'post_tag'),
        );

        \register_post_type('dw_notes', $args);
    }
}
