<?php
class UlLiWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'hsuhk-ul-accordion-widget',  // Base ID
			'HSUHK UL Accordion List Widget',   // Name
			array( 'description' => 'A custom ul accordion list widget for HSUHK' ), // Widget description
			array( 'customize_selective_refresh' => true ), // Widget options
			'custom-category' // Widget category
		);
	}

	public $args = array(
		'before_title'  => '<div class="title mt-5 fs28 white wow fadeInUp">',
		'after_title'   => '</div>',
	);

	public function widget( $args, $instance ) {
        // Get the length from widget settings
        $length = ! empty( $instance['length'] ) ? absint( $instance['length'] ) : 0;
        $title = !empty($instance['title']) ? $instance['title'] : '';
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo '<div class="txt fs18  wow fadeInUp"><div class="faq">';


        // Output the widget content
        echo $args['before_widget'];
        echo '<ul>';
        for ( $i = 0; $i < $length; $i++ ) {
            echo '<li class="li li2 wow fadeInUp">';
			echo '<a class="fs18 bold" >';
			echo isset( $instance['title'.$i] ) ?  $instance['title'.$i] : "";
			echo '<i class="fa fa-angle-down" aria-hidden="true"></i><i class="fa fa-angle-up" aria-hidden="true"></i></a>';
			// echo '<div class="con">';
			echo isset( $instance['content'.$i] ) ?  $instance['content'.$i] : "";
			// echo '</div>';
			echo '</li>';
        }
        echo '</ul>';
        echo $args['after_widget'];
		echo '</div></div>';

	}

    // Widget backend form
    public function form( $instance ) {
        // Get the current length from widget settings
        $length = isset( $instance['length'] ) ? absint( $instance['length'] ) : 0;
        $title = !empty($instance['title']) ? $instance['title'] : '';
		
        ?>
		<p>
           <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
           <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>

            <input id="<?php echo $this->get_field_id( 'length' ); ?>" name="<?php echo $this->get_field_name( 'length' ); ?>" type="hidden" value="<?php echo $length; ?>">
			<button title-name="<?php echo esc_attr($this->get_field_name('title')); ?>" content-name="<?php echo esc_attr($this->get_field_name('content')); ?>" title-id="<?php echo esc_attr($this->get_field_id('title')); ?>" content-id="<?php echo esc_attr($this->get_field_id('content')); ?>" class="button-primary accordion-length-confirm" origin-length="<?php echo $length; ?>" data-id="<?php echo $this->get_field_id( 'length' ); ?>">Add new</button>
		</p>
			<?php
				for($i = 0; $i < $length; $i++) {
			?>
			
				<label for="<?php echo esc_attr($this->get_field_id('title'.$i)); ?>"><?php echo isset( $instance['title'.$i] ) ?  $instance['title'.$i] : "New List Item"; ?></label>
			<p>
				<input class="widefat sort" id="<?php echo esc_attr($this->get_field_id('title'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('title'.$i)); ?>" type="text" value="<?php echo isset( $instance['title'.$i] ) ?  $instance['title'.$i] : ""; ?>">
				<label for="<?php echo esc_attr($this->get_field_id('content'.$i)); ?>"><?php echo "Content ".($i + 1).":"; ?></label>
				<div class="custom-fade-editor">
					<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('content'.$i)); ?>"><?php echo isset( $instance['content'.$i] ) ?  esc_attr($instance['content'.$i]) : ""; ?></textarea>
				</div>
			</p>
			<?php
				}
			?>
        <?php
    }

    // Widget backend update
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['length'] = ! empty( $new_instance['length'] ) ? absint( $new_instance['length'] ) : 0;
		for($i = 0; $i < $instance['length']; $i++) {
			$instance['title'.$i] = ! empty( $new_instance['title'.$i] ) ? $new_instance['title'.$i] : '';
			$instance['content'.$i] = ! empty( $new_instance['content'.$i] ) ? $new_instance['content'.$i] : '';
		}
        return $instance;
    }
}


/**
 * Add TinyMCE to multiple Textareas (usually in backend).
 */
add_action('admin_print_footer_scripts','my_admin_print_footer_ul_li_scripts',99);
function my_admin_print_footer_ul_li_scripts() {
    ?><script type="text/javascript">/* <![CDATA[ */
		var active_editors = [];
		jQuery(document).ready(function($) {
			$(document).on('click', '.accordion-length-confirm', function () {
				let inputId = $(this).attr('data-id');
				const originLength = parseInt($(this).attr('origin-length'));
				let length = parseInt($("#" + inputId).val()) + 1;
				let contentName = $(this).attr("content-name");
				let lastIndex = contentName.lastIndexOf(']');
				contentName = contentName.slice(0, lastIndex);
				let contentId = $(this).attr("content-id");
				let titleName = $(this).attr("title-name");
				lastIndex = titleName.lastIndexOf(']');
				titleName = titleName.slice(0, lastIndex);
				let titleId = $(this).attr("title-id");
				if (originLength < length) {
					for(let i = originLength; i < length; i++) {
						$(".so-content").append(`
						<p>
							<label for="`+titleId+i+`">Title `+ (i + 1) +`:</label>
							<input class="widefat" id="`+titleId+i+`" name="`+titleName+i+`]" type="text" value="">
							<br>
							<label for="`+contentId+i+`">Content `+ (i + 1) +`:</label>
							<div class="custom-fade-editor">
								<textarea class="widefat" id="` + contentId + i + `" name="`+contentName+i+`]"></textarea>
							</div>
						</p>`);
					}
				} else {
					for(let i = length; i < originLength; i++) {
						$("#"+titleId+i).parent().parent().remove();
					}
				}

				$(this).attr('origin-length', length);
			});
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
								plugins : 'charmap colorpicker compat3x directionality fullscreen hr table image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
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
				}, 700);
			});
        });
    /* ]]> */</script><?php
}