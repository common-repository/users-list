<?php
/*
Plugin Name:Users List Widget
Plugin URI: http://www.tatwa.com/
Description:Easily display all your WordPress usersname on wordpress website.
Version: 1.0
Author: Ashirbad Ray
Author URI: http://www.tatwa.com/
Text Domain: users_list_widget

*/
wp_register_style('userslistStylesheet', plugins_url('assets/css/style.css', __FILE__) );
	wp_enqueue_style('userslistStylesheet');
	
//Class For Creating Widget
class users_list_widget extends WP_Widget {

	// constructor
	function users_list_widget() {
		/* ... */
		  parent::WP_Widget(false, $name = __('Users List Widget', 'users_list_widget') );
	}

	// widget form creation
function form($instance) {

// Check values
if( $instance) {
	
     $title = esc_attr($instance['title']);
     $text = esc_attr($instance['text']);
	  
	 
} else {
     $title = '';
     

}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'users_list_widget'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />

</p>
 
<?php
}
	// widget update
	// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
	    return $instance;
}
	// widget display
	// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box">';

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }
?>
     <?php
	 $blogusers = get_users( array( 'fields' => array( 'display_name' ) ) );
// Array of stdClass objects.
?>
<ul class="users_list">
<?php
foreach ( $blogusers as $user ) {
	echo '<li>' . esc_html( $user->display_name ) . '</li>';
}
	 ?>
     </ul>
    </div>
<?php
   echo $after_widget;
}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("users_list_widget");'));