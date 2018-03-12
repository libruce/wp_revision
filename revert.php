<?php

require_once("wp-load.php");
ini_set('max_execution_time', 0);
global $wpdb;
$myrows = $wpdb->get_results( "SELECT * FROM wp_posts WHERE post_type ='post' AND post_parent = 0 AND post_modified > '2018-03-10' " );

foreach($myrows as $row){
  var_dump($row->ID);
  $revisions = wp_get_post_revisions($row->ID);
  foreach($revisions as $r){
    if($r->post_date < '2018-03-10'){
        wp_restore_post_revision($r->ID);
        var_dump('retored' . $r->ID);
        break;  
    } 
  }
}
