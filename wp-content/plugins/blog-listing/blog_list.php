<?php
error_reporting(0);
/*  Copyright 2011  Matthew Van Andel  (email : matt@mattvanandel.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/* == NOTICE ===================================================================
 * Please do not alter this file. Instead: make a copy of the entire plugin,
 * rename it, and work inside the copy. If you modify this plugin directly and
 * an update is released, your changes will be lost!
 * ========================================================================== */



/*************************** LOAD THE BASE CLASS *******************************
 *******************************************************************************
 * The WP_List_Table class isn't automatically available to plugins, so we need
 * to check if it's available and load it if necessary.
 */
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class listCertificateEnquires extends WP_List_Table
{
    //changed
    public $postTable = "wp_posts";
    public $perPage = 20;

    function __construct()
    {
        global $status, $page;
        parent::__construct(
            array(
                'singular' => 'slide',
                //singular name of the listed records
                'plural' => 'slides',
                //plural name of the listed records
                'ajax' => false //does this table support ajax?
            )
        );

    }

    function column_default($item, $column_name)
    {
        global $wpdb;
        
        switch ($column_name) {

            case 'SNo': {
                    $current_page = $this->get_pagenum();
                    $sno = $item[$column_name] + ($current_page - 1) * $this->perPage;
                    return $sno;
                }
            case 'S_no': {
                    $current_page = $this->get_pagenum();
                    $sno = $item['SNo'] + ($current_page - 1) * $this->perPage;
                    return $sno;
                }
            case 'name':{
                return stripslashes(ucfirst($item['post_title']));
            }
            case 'excert':{
                return $item['post_excerpt'];
            }
            default:
                //return print_r($item,true); //Show the whole array for troubleshooting purposes
                return print_r($item,true);
        }
    }


    function get_columns()
    {
        $columns = array(
            // 'cb' => '<input type="checkbox" />',
            //Render a checkbox instead of text
            'SNo' => 'S.No.',
            'name' => 'Blog Name',
            'excert' => 'Blog Excert',
            'id' =>'Action'
        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'name' => array('name', true),
        );
        return $sortable_columns;
    }
    function column_id($item){
       
        $actions = array(
            'view'     => printf('<a href="?page=%s&action=%s&viewid=%s" style="color:#2929ec;">View</a>',$_REQUEST['page'],'view',$item['ID']),
        );
    }
    function getEditRecord($editid) {
        global $wpdb;
        $record = $wpdb->get_results("select * from ". $this->postTable." where ID = ". $editid);
        return $record;
    }

    function prepare_items()
    {
        global $wpdb;
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->process_bulk_action();

        $current_page = $this->get_pagenum();


        $list_start = ($current_page - 1) * $this->perPage;
        $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'post_title'; //If no sort, default to title
        $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
        $query = "SELECT SQL_CALC_FOUND_ROWS *, @id := @id + 1 as SNo 
        FROM `" . $this->postTable . "`, (SELECT @id := 0) as r 
        WHERE post_type = 'blog_post' 
        ORDER BY " . $orderby . " " . $order . " 
        LIMIT " . $list_start . ", " . $this->perPage;
        $data = $wpdb->get_results($query, ARRAY_A);
        $certificateEnquiryQuery = "SELECT COUNT(*) FROM `" . $this->postTable . "`  WHERE post_type = 'blog_post'";
        $total_items = $wpdb->get_var($wpdb->prepare($certificateEnquiryQuery, ''));

        $this->items = $data;
        $this->set_pagination_args(
            array(
                'total_items' => $total_items,
                //WE have to calculate the total number of items
                'per_page' => $this->perPage,
                //WE have to determine how many items to show on a page
                'total_pages' => ceil($total_items / $this->perPage) //WE have to calculate the total number of pages
            )
        );
    }

  
    public function no_items()
    {
        _e('No Blog listing found.');
    }
}
