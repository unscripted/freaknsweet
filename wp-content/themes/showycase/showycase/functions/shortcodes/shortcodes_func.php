<?php

// Creats shortcodes TinyMCE's editor button & plugin
add_action('init', 'scbutton'); 

function scbutton() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_tinymce_plugin');  
     add_filter('mce_buttons', 'register_button');  
   }  
} 



function register_button($buttons) {  
   array_push($buttons, 'separator', 'pt_shortcodes' );  
   return $buttons;  
}



function add_tinymce_plugin($plugin_array) {  
   $plugin_array['pt_shortcodes'] = PT_SHORTCODES . '/editor_plugin.js';  
   return $plugin_array;  
} 

?>