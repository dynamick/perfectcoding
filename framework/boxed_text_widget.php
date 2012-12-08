<?php
/*
Plugin Name: Boxed Class Text Widgets
Plugin URI: http://www.dynamick.it
Description: A customized text widget to give custom classes on each widget area.
Author: Mick @ Dynamick
Version: 1.0
Author URI: http://www.dynamick.it
*/
     
    class boxedClassText extends WP_Widget {
        function boxedClassText() {
            parent::WP_Widget('boxedclasstext', $name = 'Boxed Text Widget');
        }
     
        function widget($args, $instance) {
            extract($args);
            $title          = apply_filters('widget_title', $instance['title']);
            $customClass    = apply_filters('widget_title', $instance['customClass']);
            $text           = $instance['text'];
 
            echo '<div class="'.$customClass.'">'."\n";
            echo    $before_widget;
            if ($title != "" ) echo    $before_title.$title.$after_title;
            echo    $text;
            echo    $after_widget;
            echo '</div>'."\n";
        }
 
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']          = strip_tags($new_instance['title']);
            $instance['customClass']    = strip_tags($new_instance['customClass']);
            $instance['text']           = $new_instance['text'];
            return $instance;
        }
 
        function form($instance) {
            if($instance) {
                $title          = esc_attr($instance['title']);
                $customClass    = esc_attr($instance['customClass']);
                $text           = esc_attr($instance['text']);
            } else {
                $title          = "";
                $customClass    = "";
                $text           = "";
            }
             
            echo '<p><label for="'.$this->get_field_id('title').'">'._e('Title:').'</label>';
            echo '<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></p>';
            echo '<p><label for="'. $this->get_field_id('customClass') .'">'._e('Custom Class:').'</label>';
            // echo '<input class="widefat" id="'.$this->get_field_id('customClass').'" name="'.$this->get_field_name('customClass').'" type="text" value="'.$customClass;.'" /></p>';
            echo '<select class="widefat" id="'.$this->get_field_id('customClass').'" name="'.$this->get_field_name('customClass').'" >';
			echo '<option value="inset-boxed" ' . ($customClass == 'inset-boxed' ? 'selected="selected"' : '') . '>Inset Boxed</option>';
			echo '<option value="white-boxed" ' . ($customClass == 'white-boxed' ? 'selected="selected"' : '') . '>White Boxed</option>';
			echo '</select></p>';
            echo '<p><label for="'.$this->get_field_id('text').'">'._e('Text:').'</label>';
            echo '<textarea class="widefat" id="'. $this->get_field_id('text').'" name="'.$this->get_field_name('text').'" rows="10">'.$text.'</textarea></p>';
             
        }
    }
 
    add_action('widgets_init', create_function('', 'return register_widget("boxedClassText");'));
?>