<?php
error_reporting(0);
/**
 * Plugin Name: Blog Listing
 * Description: This plugin is used to render all the blogs added by users
 * Version: 1.0
 * Author: Maz
 * License: GPL2
 * 
 */

require_once("blog_list.php");

$blogList = new blogList();
class blogList
{
    public $editid;
    function __construct()
    {
        global $wpdb;
        add_action('admin_menu', array($this, 'blogListMenuPage'));
    }

    function blogListMenuPage()
    {
        add_menu_page('Blog Listing', 'Blog Listing', 'manage_options', 'blog-listing', array($this, 'list_page'), 'dashicons-format-chat', 5);
    }

    function addEditForm($mode)
    {
        if ($mode == "view") {
            global $wpdb;
            $objSelect = new listCertificateEnquires();
            $record = $objSelect->getEditRecord($_REQUEST["viewid"]);
        }
        ?>
        <div class="wrap">
            <div class="base_div">
                <div id="icon-users" class="icon32"><br /></div>
                <h2>Blog Details<a href="?page=blog-listing" style="margin-left: 20px;" class="add-new-h2">View All Blogs</a>
                </h2>

                <style>
                    #wpfooter {
                        display: none !important;
                    }

                    .button {
                        cursor: pointer;
                    }

                    .input[type="button"],
                    input[type="submit"],
                    input[type="reset"] {
                        cursor: pointer;
                    }

                    .brdclm {
                        color: #000;
                    }

                    .tbl {
                        background-color: none !imoportant;
                        border: none !imoportant;
                        ;
                        box-shadow: none !imoportant;
                        font-size: 14px;
                    }

                    .tbl tr td {
                        padding: 15px 10px;
                    }

                    tr:nth-child(odd) {
                        background-color: #f9f9f9;
                        padding-left: 15px
                    }

                    .clientresponse textarea {
                        width: 100%;
                        padding: 10px
                    }

                    #responseform {
                        width: 60%;
                    }

                    #response {
                        background-color: #0073aa;
                        margin-top: 10px;
                        border: none;
                        color: white;
                        padding: 10px;
                        border-radius: 5px;
                    }

                    .clientresponse {
                        display: none;
                    }

                    .error-reg {
                        color: #ff0000;
                    }
                </style>
                <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                <div class="wrap">
                    <div id="icon-users" class="icon32"><br /></div>
                    <br />
                    <table cellspacing="0" class="tbl" width="80%" style="background:#fff;border: 1px solid #c8c8c8; ">
                        <tr>
                            <td align="left" valign="middle" width="25%" style="padding-left:15px;color:#0073aa">
                                <div><b>Blog Name :</b></div>
                            </td>
                            <td align="left" valign="middle" width="80%">
                                <div>
                                    <?php echo stripslashes(ucfirst((isset($record[0]->post_title) && $record[0]->post_title != '') ? $record[0]->post_title : '--')); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle" width="25%" style="padding-left:15px;color:#0073aa">
                                <div><b>Blog Content :</b></div>
                            </td>
                            <td align="left" valign="middle" width="80%">
                                <div>
                                    <?php echo $record[0]->post_content; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle" width="25%" style="padding-left:15px;color:#0073aa">
                                <div><b>Blog Excerpt:</b></div>
                            </td>
                            <td align="left" valign="middle" width="80%">
                                <div>
                                    <textarea name="blog_excerpt"
                                        id="blog_excerpt"><?php echo esc_html($record[0]->post_excerpt); ?></textarea>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td align="left" valign="top" width="20%" style="padding-left:15px;color:#0073aa">
                                <div><b>Blog Publish Date :</b></div>
                            </td>
                            <td align="left" valign="middle" width="80%">
                                <div>
                                    <?php
                                    $blogPublish = $record[0]->post_date ? $record[0]->post_date : '--';
                                    echo (stripslashes(ucfirst($blogPublish))); ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#blog_excerpt'))
                        .then(editor => {
                            console.log(editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>

                <?php
    }
    function displayListing()
    {
        global $wpdb;
        $certificateEnquires = new listCertificateEnquires();
        $certificateEnquires->prepare_items();
        ?>
                <div class="wrap Event_post">
                    <div id="icon-users" class="icon32"><br /></div>
                    <h2>Blog Listing</h2>
                    <br>
                    <form id="movies-filter" method="get">
                        <?php $certificateEnquires->display(); ?>
                    </form>
                </div>
                <?php
    }

    function list_page()
    {
        if ($_REQUEST["action"] == "view") {
            $this->addEditForm("view");
            $this->editid = $_REQUEST["viewid"];
            return;
        } else {
            $this->displayListing();
            return;
        }

    }

}

?>