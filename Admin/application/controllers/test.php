<?php
/*
 * Created on 2012-9-28
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
       <?php        class Test extends CI_Controller
        {
                function __construct()
                {
                        parent::__construct();
                        $this->load->helper('url');
                }
 
                function index()
                {
                        $this->load->view('Copy/js.php');
                       // echo "111111111";
                }       
         }
        ?>
 