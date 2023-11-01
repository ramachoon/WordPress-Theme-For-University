<?php
class FadeBlock_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'hsuhk-fade-block-widget',  // Base ID
			'HSUHK Fade Block Widget',   // Name
			array( 'description' => 'A custom widget for HSUHK' ), // Widget description
			array( 'customize_selective_refresh' => true ), // Widget options
			'custom-category' // Widget category
		);
	}

	public $args = array(
		'before_title'  => '<div class="title mt-5 fs28 white wow fadeInUp">',
		'after_title'   => '</div>',
	);

	public function widget( $args, $instance ) {
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if ( ! empty( $instance['content'] ) ) {
			echo '<div class="txt fs18  wow fadeInUp">';
			echo  $instance['content'] ;
			echo '</div>';
		}
	}

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $content = !empty($instance['content']) ? $instance['content'] : '';

        ?>
        <p>
           <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
           <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e('Content:'); ?></label>
			<div class="custom-fade-editor">
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_attr($content); ?></textarea>
			</div>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['content'] = (!empty($new_instance['content'])) ? $new_instance['content'] : '';
        return $instance;
    }
}


/**
 * Add TinyMCE to multiple Textareas (usually in backend).
 */
add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);
function my_admin_print_footer_scripts() {
    ?><script type="text/javascript">/* <![CDATA[ */
		var active_editors = [];

		jQuery(document).ready(function($) {



			function init_editors() {
				$('.custom-fade-editor textarea').each(function(e)
				{
					var id = $(this).attr('id');
					if (!id)
					{
						id = 'customEditor-' + i++;
						$(this).attr('id',id);
					}
					if (active_editors.indexOf(id) === -1) {
						wp.editor.initialize(id, {
							tinymce: {
							wpautop: true,
								plugins : 'charmap colorpicker table compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
								toolbar1: 'bold italic underline strikethrough table | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv ',
								toolbar2: 'formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help'
							},
							quicktags: true,
							mediaButtons: true,
						});
						active_editors.push(id);
					}
				});
			}
			$(document).on('DOMNodeInserted', function(event) {
				setTimeout(() => {
					init_editors();
				}, 500);
			});
        });
    /* ]]> */</script><?php
}