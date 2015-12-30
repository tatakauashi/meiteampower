<?php

/** 
 * PRESENTATION PAGE COLUMNS 
 */

// Counting the PP column widgets
global $nirvana_column_counter;
$nirvana_column_counter = 0;

class ColumnsWidget extends WP_Widget
{ 	
  var $nirvanas; // theme options read in the constructor
  
  function ColumnsWidget() { 
    $widget_ops = array('classname' => 'ColumnsWidget', 'description' => 'Add columns in the presentation page' );
	$control_ops = array('width' => 350, 'height' => 350); // making widget window larger
	$this->WP_Widget('columns_widget', 'Cryout Column', $widget_ops, $control_ops);
	$this->nirvanas= nirvana_get_theme_options(); // reading theme options
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'image' => '', 'title' => '' , 'text' => '',  'link' => '',  'blank' => '' ) );
    $image = $instance['image'];
	$title = $instance['title'];
	$text = $instance['text'];
	$link = $instance['link'];
	$blank = $instance['blank'];?>
	<div>
		<p><label for="<?php echo $this->get_field_id('image'); ?>">Image: <input class="widefat slideimages" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_url($image); ?>" /></label><a class="upload_image_button button" href="#">Select / Upload Image</a></p>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Text: <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php echo esc_attr($text); ?></textarea></label></p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>">Link: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_url($link); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('blank'); ?>">Open in new Window: <input id="<?php echo $this->get_field_id('blank'); ?>" name="<?php echo $this->get_field_name('blank'); ?>" type="checkbox" <?php checked($blank, 1); ?> value="1" /></label></p>
	</div>
	
<?php  } // form() function

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['image'] = $new_instance['image'];
	$instance['title'] = $new_instance['title'];
	$instance['text'] = $new_instance['text'];
	$instance['link'] = $new_instance['link'];
	$instance['blank'] = $new_instance['blank'];
    return $instance;
  }
  
  function widget($args, $instance) { 
	$nirvana_nrcolumns = $this->nirvanas['nirvana_nrcolumns']; // getting the number of columns setting
	global $nirvana_column_counter; // global counter for incrementing further
	
	if($instance['image']) : 
		$nirvana_column_counter++; // incrementing counter only if widget has image
		$counter = $nirvana_column_counter; 
		$coldata = array(
			'colno' => (($counter%$nirvana_nrcolumns)?$counter%$nirvana_nrcolumns:$nirvana_nrcolumns),
			'counter' => $counter,
			'image' => esc_url($instance['image']),
			'link' => esc_url($instance['link']),
			'blank' => ($instance['blank']?'target="_blank"':''),
			'title' =>  $instance['title'],
			'text' => $instance['text'],
		);
		nirvana_singlecolumn_output($coldata);		
	endif; 
  }// widget() function
}// ColumnsWidget

add_action( 'widgets_init', create_function('', 'return register_widget("ColumnsWidget");') );

function nirvana_widget_scripts() {
	// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
         wp_enqueue_media();
      }
      else {
         wp_enqueue_script('media-upload');
         wp_enqueue_script('thickbox');
         wp_enqueue_style('thickbox');
      }
	wp_register_script('admin', get_template_directory_uri().'/admin/js/widgets.js');
	wp_enqueue_script('admin'); 
}

add_action ('admin_print_scripts-widgets.php','nirvana_widget_scripts');

?>