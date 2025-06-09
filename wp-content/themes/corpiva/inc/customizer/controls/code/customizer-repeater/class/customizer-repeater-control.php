<?php if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class CORPIVA_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $add_field_label = array();
	private $customizer_repeater_title_control = false;
	private $customizer_repeater_subtitle_control = false;
	private $customizer_repeater_subtitle2_control = false;
	private $customizer_repeater_subtitle3_control = false;
	private $customizer_repeater_subtitle4_control = false;
	private $customizer_repeater_subtitle5_control = false;
	private $customizer_repeater_button_text_control = false;
	private $customizer_repeater_link_control = false;
	private $customizer_repeater_slide_align = false;
	private $customizer_repeater_bg_type = false;
	private $customizer_repeater_video_url_control = false;
	private $customizer_repeater_image_control = false;
	private $customizer_repeater_image2_control = false;
	private $customizer_repeater_icon_control = false;
	private $customizer_repeater_color_control = false;
	private $customizer_repeater_text_control = false;
	 public $customizer_repeater_text2_control = false;
	 public $customizer_repeater_button2_control = false;
	 public $customizer_repeater_link2_control = false;
	 public $customizer_repeater_link3_control = false;
	private $customizer_repeater_designation_control = false;
	private $customizer_repeater_shortcode_control = false;
	private $customizer_repeater_repeater_control = false;
	private $customizer_repeater_checkbox_control = false;
	
    private $customizer_icon_container = '';
    private $allowed_html = array();


	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->add_field_label = esc_html__( 'Add new field', 'corpiva' );
		if ( ! empty( $args['add_field_label'] ) ) {
			$this->add_field_label = $args['add_field_label'];
		}

		$this->boxtitle = esc_html__( 'Customizer Repeater', 'corpiva' );
		if ( ! empty ( $args['item_name'] ) ) {
			$this->boxtitle = $args['item_name'];
		} elseif ( ! empty( $this->label ) ) {
			$this->boxtitle = $this->label;
		}

		if ( ! empty( $args['customizer_repeater_image_control'] ) ) {
			$this->customizer_repeater_image_control = $args['customizer_repeater_image_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_image2_control'] ) ) {
			$this->customizer_repeater_image2_control = $args['customizer_repeater_image2_control'];
		}

		if ( ! empty( $args['customizer_repeater_icon_control'] ) ) {
			$this->customizer_repeater_icon_control = $args['customizer_repeater_icon_control'];
		}

		if ( ! empty( $args['customizer_repeater_color_control'] ) ) {
			$this->customizer_repeater_color_control = $args['customizer_repeater_color_control'];
		}

		if ( ! empty( $args['customizer_repeater_title_control'] ) ) {
			$this->customizer_repeater_title_control = $args['customizer_repeater_title_control'];
		}
		

		if ( ! empty( $args['customizer_repeater_subtitle_control'] ) ) {
			$this->customizer_repeater_subtitle_control = $args['customizer_repeater_subtitle_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_subtitle2_control'] ) ) {
			$this->customizer_repeater_subtitle2_control = $args['customizer_repeater_subtitle2_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_subtitle3_control'] ) ) {
			$this->customizer_repeater_subtitle3_control = $args['customizer_repeater_subtitle3_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_subtitle4_control'] ) ) {
			$this->customizer_repeater_subtitle4_control = $args['customizer_repeater_subtitle4_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_subtitle5_control'] ) ) {
			$this->customizer_repeater_subtitle5_control = $args['customizer_repeater_subtitle5_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_text_control'] ) ) {
			$this->customizer_repeater_text_control = $args['customizer_repeater_text_control'];
		}
		if ( ! empty( $args['customizer_repeater_text2_control'] ) ) {
            $this->customizer_repeater_text2_control = $args['customizer_repeater_text2_control'];
        }
		if ( ! empty( $args['customizer_repeater_button2_control'] ) ) {
            $this->customizer_repeater_button2_control = $args['customizer_repeater_button2_control'];
        }
		  if ( ! empty( $args['customizer_repeater_link2_control'] ) ) {
            $this->customizer_repeater_link2_control = $args['customizer_repeater_link2_control'];
        }
		 if ( ! empty( $args['customizer_repeater_link3_control'] ) ) {
            $this->customizer_repeater_link3_control = $args['customizer_repeater_link3_control'];
        }
		if ( ! empty( $args['customizer_repeater_designation_control'] ) ) {
			$this->customizer_repeater_designation_control = $args['customizer_repeater_designation_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_button_text_control'] ) ) {
			$this->customizer_repeater_button_text_control = $args['customizer_repeater_button_text_control'];
		}

		if ( ! empty( $args['customizer_repeater_link_control'] ) ) {
			$this->customizer_repeater_link_control = $args['customizer_repeater_link_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_checkbox_control'] ) ) {
			$this->customizer_repeater_checkbox_control = $args['customizer_repeater_checkbox_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_video_url_control'] ) ) {
			$this->customizer_repeater_video_url_control = $args['customizer_repeater_video_url_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_slide_align'] ) ) {
			$this->customizer_repeater_slide_align = $args['customizer_repeater_slide_align'];
		}
		
		if ( ! empty( $args['customizer_repeater_bg_type'] ) ) {
			$this->customizer_repeater_bg_type = $args['customizer_repeater_bg_type'];
		}

		if ( ! empty( $args['customizer_repeater_shortcode_control'] ) ) {
			$this->customizer_repeater_shortcode_control = $args['customizer_repeater_shortcode_control'];
		}

		if ( ! empty( $args['customizer_repeater_repeater_control'] ) ) {
			$this->customizer_repeater_repeater_control = $args['customizer_repeater_repeater_control'];
		}
		

		if ( ! empty( $id ) ) {
			$this->id = $id;
		}

		if ( file_exists( get_template_directory() . '/inc/customizer/controls/code/customizer-repeater/inc/icons.php' ) ) {
			$this->customizer_icon_container =  'inc/customizer/controls/code/customizer-repeater/inc/icons';
		}

		$allowed_array1 = wp_kses_allowed_html( 'post' );
		$allowed_array2 = array(
			'input' => array(
				'type'        => array(),
				'class'       => array(),
				'placeholder' => array()
			)
		);

		$this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
	}

	/*Enqueue resources for the control*/
	public function enqueue() {
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/fonts/font-awesome/css/all.min.css', array(), 999 );

		wp_enqueue_style( 'corpiva_customizer-repeater-admin-stylesheet', get_template_directory_uri() . '/inc/customizer/controls/code/customizer-repeater/css/admin-style.css', array(), 999 );

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'corpiva_customizer-repeater-script', get_template_directory_uri() . '/inc/customizer/controls/code/customizer-repeater/js/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), 999, true  );

		wp_enqueue_script( 'corpiva_customizer-repeater-fontawesome-iconpicker', get_template_directory_uri() . '/inc/customizer/controls/code/customizer-repeater/js/fontawesome-iconpicker.js', array( 'jquery' ), 999, true );

		wp_enqueue_style( 'corpiva_customizer-repeater-fontawesome-iconpicker-script', get_template_directory_uri() . '/inc/customizer/controls/code/customizer-repeater/css/fontawesome-iconpicker.min.css', array(), 999 );
	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
					       class="customizer-repeater-colector"
					       value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
					       class="customizer-repeater-colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
				<input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
				       class="customizer-repeater-colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			} ?>
			</div>
		<button type="button" class="button add_field customizer-repeater-new-field">
			<?php echo esc_html( $this->add_field_label ); ?>
		</button>
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			$exist_service=count($array);
			
				$corpiva_del_btn_id=$this->boxtitle;
			
			global $corpiva_limit;
			global $corpiva_type_with_id;
			echo sprintf("<input type='hidden' value='$exist_service' id='exist_corpiva_$corpiva_del_btn_id'/>");
			foreach($array as $icon){ 
			if($it<4)
			{
			$corpiva_limit="corpiva_limit";
			$corpiva_type_with_id='';
			}
			else
			{
			$corpiva_limit="corpiva_overlimit";	
			$corpiva_type_with_id=$corpiva_del_btn_id."_".$it;
			}

		
		?>
				<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ) ?>
					</div>
					<div class="customizer-repeater-box-content-hidden">
						<?php
						$choice = $image_url = $image_url2 = $icon_value = $title = $subtitle = $subtitle2 = $subtitle3 = $subtitle4 = $subtitle5 = $text = $text2 =  $link2 =  $link3 = $button_second = $link = $designation = $slide_align = $bg_type = $button = $open_new_tab = $shortcode = $repeater = $color = $video_url = '';
						if(!empty($icon->id)){
							$id = $icon->id;
						}
						if(!empty($icon->choice)){
							$choice = $icon->choice;
						}
						if(!empty($icon->image_url)){
							$image_url = $icon->image_url;
						}
						if(!empty($icon->image_url2)){
							$image_url2 = $icon->image_url2;
						}
						if(!empty($icon->icon_value)){
							$icon_value = $icon->icon_value;
						}
						if(!empty($icon->color)){
							$color = $icon->color;
						}
						if(!empty($icon->title)){
							$title = $icon->title;
						}
						
						if(!empty($icon->slide_align)){
							$slide_align = $icon->slide_align;
						}
						
						if(!empty($icon->bg_type)){
							$bg_type = $icon->bg_type;
						}
						
						if(!empty($icon->designation)){
							$designation = $icon->designation;
						}
						
						if(!empty($icon->subtitle)){
							$subtitle =  $icon->subtitle;
						}
						
						if(!empty($icon->subtitle2)){
							$subtitle2 =  $icon->subtitle2;
						}
						
						if(!empty($icon->subtitle3)){
							$subtitle3 =  $icon->subtitle3;
						}
						
						if(!empty($icon->subtitle4)){
							$subtitle4 =  $icon->subtitle4;
						}
						
						if(!empty($icon->subtitle5)){
							$subtitle5 =  $icon->subtitle5;
						}
						
						if(!empty($icon->text)){
							$text = $icon->text;
						}
						if(!empty($icon->text2)){
                            $text2 = $icon->text2;
                        }
						
						if(!empty($icon->button_second)){
                            $button_second = $icon->button_second;
                        }
						
						 if(!empty($icon->link2)){
                            $link2 = $icon->link2;
                        }
						
						if(!empty($icon->link3)){
                            $link3 = $icon->link3;
                        }
						
						if(!empty($icon->video_url)){
							$video_url = $icon->video_url;
						}
						
						if(!empty($icon->button)){
							$button = $icon->button_text;
						}
						if(!empty($icon->link)){
							$link = $icon->link;
						}
						if(!empty($icon->shortcode)){
							$shortcode = $icon->shortcode;
						}

						if(!empty($icon->social_repeater)){
							$repeater = $icon->social_repeater;
						}
						
						if(!empty($icon->open_new_tab)){
							$open_new_tab = $icon->open_new_tab;
						}
						
						
						if($this->customizer_repeater_bg_type == true){
							$this->bg_type($bg_type);
							
						}	
						
						if($this->customizer_repeater_title_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Title','corpiva' ), $this->id, 'customizer_repeater_title_control' ),
								'class' => 'customizer-repeater-title-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
							), $title);
						}
						
						if($this->customizer_repeater_subtitle_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle','corpiva' ), $this->id, 'customizer_repeater_subtitle_control' ),
								'class' => 'customizer-repeater-subtitle-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
							), $subtitle);
						}
						
						if($this->customizer_repeater_subtitle2_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 2','corpiva' ), $this->id, 'customizer_repeater_subtitle2_control' ),
								'class' => 'customizer-repeater-subtitle2-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle2_control' ),
							), $subtitle2);
						}
						
						if($this->customizer_repeater_subtitle3_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 3','corpiva' ), $this->id, 'customizer_repeater_subtitle3_control' ),
								'class' => 'customizer-repeater-subtitle3-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle3_control' ),
							), $subtitle3);
						}
						
						if($this->customizer_repeater_subtitle4_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 4','corpiva' ), $this->id, 'customizer_repeater_subtitle4_control' ),
								'class' => 'customizer-repeater-subtitle4-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle4_control' ),
							), $subtitle4);
						}
						
						if($this->customizer_repeater_subtitle5_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 5','corpiva' ), $this->id, 'customizer_repeater_subtitle5_control' ),
								'class' => 'customizer-repeater-subtitle5-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle5_control' ),
							), $subtitle5);
						}
						
						if($this->customizer_repeater_text_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Description','corpiva' ), $this->id, 'customizer_repeater_text_control' ),
								'class' => 'customizer-repeater-text-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
							), $text);
						}
						if($this->customizer_repeater_text2_control==true){
                            $this->input_control(array(
                                'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Button Label','corpiva' ), $this->id, 'customizer_repeater_text2_control' ),
                                'class' => 'customizer-repeater-text2-control '."$corpiva_limit".'',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_text2_control' ),
                            ), $text2);
                        }
						
						if($this->customizer_repeater_button2_control==true){
                            $this->input_control(array(
                                'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Button Label second','corpiva' ), $this->id, 'customizer_repeater_button2_control' ),
                                'class' => 'customizer-repeater-button2-control',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_button2_control' ),
                            ), $button_second);
                        }
						
						
						if($this->customizer_repeater_button_text_control){
							$this->input_control(array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__('Button Text',
							'corpiva'), $this->id, 'customizer_repeater_button_text_control'),
							'class' => 'customizer-repeater-button-text-control '."$corpiva_limit".'',
							'type' => apply_filters('corpiva_repeater_input_types_filter', '' , $this->id,
							'customizer_repeater_button_text_control'),
							), $button);
						}
						
						
						if($this->customizer_repeater_link_control){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Link','corpiva' ), $this->id, 'customizer_repeater_link_control' ),
								'class' => 'customizer-repeater-link-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
								'sanitize_callback' => 'esc_url_raw',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
							), $link);
						}
						
						if($this->customizer_repeater_link2_control){
                            $this->input_control(array(
                                'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'link','corpiva' ), $this->id, 'customizer_repeater_link2_control' ),
                                'class' => 'customizer-repeater-link2-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
                                //'sanitize_callback' => 'esc_url_raw',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link2_control' ),
                            ), $link2);
                        }
						
						if($this->customizer_repeater_link3_control){
                            $this->input_control(array(
                                'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'link 3','corpiva' ), $this->id, 'customizer_repeater_link3_control' ),
                                'class' => 'customizer-repeater-link3-control '."$corpiva_limit".' '."$corpiva_type_with_id".'',
                                //'sanitize_callback' => 'esc_url_raw',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link3_control' ),
                            ), $link3);
                        }
						
						if($this->customizer_repeater_checkbox_control == true){
							$this->testimonila_check($open_new_tab);
							
						}
					
						if($this->customizer_repeater_video_url_control){
							$this->input_control(array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__('Video Url',
							'corpiva'), $this->id, 'customizer_repeater_video_url_control'),
							'class' => 'customizer-repeater-video-url-control',
							'type'  => apply_filters('corpiva_customizer_repeater_video_url_control', 'textarea', $this->id, 'customizer_repeater_video_url_control' ),
							), $video_url);
						}
						
						if($this->customizer_repeater_slide_align == true){
							$this->slide_align($slide_align);
							
						}							
						
						if($this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true) {
							$this->icon_type_choice( $choice,$corpiva_limit );
						}
						if($this->customizer_repeater_image_control == true){
							$this->image_control($image_url, $choice, $corpiva_limit, $it+1, $corpiva_del_btn_id);
						}
						if($this->customizer_repeater_image2_control == true){
							$this->image_control2($image_url2, $choice, $corpiva_limit, $it+1, $corpiva_del_btn_id);
						}
						if($this->customizer_repeater_icon_control == true){
							$this->icon_picker_control($icon_value, $choice);
						}
						
					
						
						
						if($this->customizer_repeater_color_control == true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Color','corpiva' ), $this->id, 'customizer_repeater_color_control' ),
								'class' => 'customizer-repeater-color-control',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
								'sanitize_callback' => 'sanitize_hex_color'
							), $color);
						}
						
						
						if($this->customizer_repeater_shortcode_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Shortcode','corpiva' ), $this->id, 'customizer_repeater_shortcode_control' ),
								'class' => 'customizer-repeater-shortcode-control',
                                'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_shortcode_control' ),
							), $shortcode);
						}
						
						if($this->customizer_repeater_designation_control==true){
							$this->input_control(array(
								'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Designation','corpiva' ), $this->id, 'customizer_repeater_designation_control' ),
								'class' => 'customizer-repeater-designation-control',
								'type'  => apply_filters('corpiva_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_designation_control' ),
							), $designation);
						}
						
						if($this->customizer_repeater_repeater_control==true){
							$this->repeater_control($repeater, $corpiva_limit, $corpiva_type_with_id);
						} ?>

						<input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
							echo esc_attr( $id );
						} ?>">
						<button type="button" class="social-repeater-general-control-remove-field" <?php if ( $it == 0 ) {
							echo esc_attr('style="display:none;"');
						} ?>>
							<?php printf( __( 'Delete %s', 'corpiva' ), $this->boxtitle );	?>
						</button>

					</div>
				</div>

				<?php
				$it++;
			}
		} else { ?>
			<div class="customizer-repeater-general-control-repeater-container">
				<div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ) ?>
				</div>
				<div class="customizer-repeater-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true ) {
						$this->icon_type_choice();
					}
					if ( $this->customizer_repeater_image_control == true ) {
						$this->image_control();
					}
					if ( $this->customizer_repeater_image2_control == true ) {
						$this->image_control2();
					}
					if ( $this->customizer_repeater_icon_control == true ) {
						$this->icon_picker_control();
					}
					
					
					if($this->customizer_repeater_bg_type == true){
							$this->bg_type($bg_type);
							
						}
						
					if($this->customizer_repeater_color_control==true){
						$this->input_control(array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Color','corpiva' ), $this->id, 'customizer_repeater_color_control' ),
							'class' => 'customizer-repeater-color-control',
							'type'  => apply_filters('corpiva_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
							'sanitize_callback' => 'sanitize_hex_color'
						) );
					}
					if ( $this->customizer_repeater_title_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Title','corpiva' ), $this->id, 'customizer_repeater_title_control' ),
							'class' => 'customizer-repeater-title-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_subtitle_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle','corpiva' ), $this->id, 'customizer_repeater_subtitle_control' ),
							'class' => 'customizer-repeater-subtitle-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_subtitle2_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 2','corpiva' ), $this->id, 'customizer_repeater_subtitle2_control' ),
							'class' => 'customizer-repeater-subtitle2-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle2_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_subtitle3_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 3','corpiva' ), $this->id, 'customizer_repeater_subtitle3_control' ),
							'class' => 'customizer-repeater-subtitle3-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle3_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_subtitle4_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 4','corpiva' ), $this->id, 'customizer_repeater_subtitle4_control' ),
							'class' => 'customizer-repeater-subtitle4-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle4_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_subtitle5_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Subtitle 5','corpiva' ), $this->id, 'customizer_repeater_subtitle5_control' ),
							'class' => 'customizer-repeater-subtitle5-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle5_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_text_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Description','corpiva' ), $this->id, 'customizer_repeater_text_control' ),
							'class' => 'customizer-repeater-text-control',
							'type'  => apply_filters('corpiva_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
						) );
					}
					if ( $this->customizer_repeater_text2_control == true ) {
                        $this->input_control( array(
                            'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Button Label','corpiva' ), $this->id, 'customizer_repeater_text2_control' ),
                            'class' => 'customizer-repeater-text2-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_text2_control' ),
                        ) );
                    }
					
					if ( $this->customizer_repeater_button2_control == true ) {
                        $this->input_control( array(
                            'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Button Label Second','corpiva' ), $this->id, 'customizer_repeater_button2_control' ),
                            'class' => 'customizer-repeater-button2-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_button2_control' ),
                        ) );
                    }
					
					 if ( $this->customizer_repeater_link2_control == true ) {
                        $this->input_control( array(
                            'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'link','corpiva' ), $this->id, 'customizer_repeater_link2_control' ),
                            'class' => 'customizer-repeater-link2-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link2_control' ),
                        ) );
                    }
					
					 if ( $this->customizer_repeater_link3_control == true ) {
                        $this->input_control( array(
                            'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'link 3','corpiva' ), $this->id, 'customizer_repeater_link3_control' ),
                            'class' => 'customizer-repeater-link3-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link3_control' ),
                        ) );
                    }
					
					if($this->customizer_repeater_button_text_control){
							$this->input_control(array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__('Button Text',
							'corpiva'), $this->id, 'customizer_repeater_button_text_control'),
							'class' => 'customizer-repeater-button-text-control',
							'type' => apply_filters('corpiva_repeater_input_types_filter', '' , $this->id,
							'customizer_repeater_button_text_control'),
							));
						}
						
					if ( $this->customizer_repeater_link_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Link','corpiva' ), $this->id, 'customizer_repeater_link_control' ),
							'class' => 'customizer-repeater-link-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
						) );
					}
					
					if($this->customizer_repeater_checkbox_control == true){
							$this->testimonila_check();
							
						}
			
					if($this->customizer_repeater_video_url_control){
							$this->input_control(array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__('Video Url',
							'corpiva'), $this->id, 'customizer_repeater_video_url_control'),
							'class' => 'customizer-repeater-video-url-control',
							'type'  => apply_filters('corpiva_customizer_repeater_video_url_control', 'textarea', $this->id, 'customizer_repeater_video_url_control' ),
							));
						}
					
					if($this->customizer_repeater_slide_align == true){
							$this->slide_align($slide_align);
							
						}
						
						
					
					
					if ( $this->customizer_repeater_shortcode_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Shortcode','corpiva' ), $this->id, 'customizer_repeater_shortcode_control' ),
							'class' => 'customizer-repeater-shortcode-control',
                            'type'  => apply_filters('corpiva_repeater_input_types_filter', '', $this->id, 'customizer_repeater_shortcode_control' ),
						) );
					}
					
					
					if ( $this->customizer_repeater_designation_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('corpiva_repeater_input_labels_filter', esc_html__( 'Designation','corpiva' ), $this->id, 'customizer_repeater_designation_control' ),
							'class' => 'customizer-repeater-designation-control',
							'type'  => apply_filters('corpiva_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_designation_control' ),
						) );
					}
					
					if($this->customizer_repeater_repeater_control==true){
						$this->repeater_control();
					} ?>
					<input type="hidden" class="social-repeater-box-id">
					<button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'corpiva' ); ?>
					</button>
				</div>
			</div>
			<?php
		}
	}

	private function input_control( $options, $value='' ){
//print_r($options);
	?>
		<span class="customize-control-title <?php echo esc_html( $options['label'] ); ?>" 
		<?php if($options['class']== 'customizer-repeater-video-url-control') {echo esc_attr('style="display:none;"'); }?>
		
		><?php echo esc_html( $options['label'] ); ?></span>
		<?php
		if( !empty($options['type']) ){
			switch ($options['type']) {
				case 'textarea':?>
					<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?></textarea>
					<?php
                    break;
				case 'color': ?>
					<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
					<?php
					break;
			}
		} else { ?>
			<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"/>
			<?php
		}
	}
	
	
	private function testimonila_check($value='no', $class='', $corpiva_type_with_id=''){
		?>
	<div class="customize-control-title">
	<?php esc_html_e('Open link in new tab:','corpiva'); ?>
	<span class="switch">
		<input type="checkbox" name="custom_checkbox" value="yes" <?php if($value=='yes'){echo esc_attr('checked');}?> class="customizer-repeater-checkbox <?php echo esc_attr($class);?> <?php echo esc_attr($corpiva_type_with_id);?>">
	</span>
	</div>
	<?php
	}

	private function icon_picker_control($value = '', $show = '', $class=''){ ?>
		<div class="social-repeater-general-control-icon" <?php if( $show === 'customizer_repeater_image' || $show === 'customizer_repeater_none' ) { echo esc_attr('style="display:none;"'); } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Icon','corpiva'); ?>
            </span>
			<span class="description customize-control-description">
                <?php
                echo sprintf(
	                esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s.', 'corpiva' ),
	                sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__( 'http://fontawesome.io/icons/', 'corpiva' ) )
                ); ?>
            </span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value );} ?>" type="text">
				<span class="input-group-addon">
                    <i class="<?php echo esc_attr($value); ?>"></i>
                </span>
			</div>
            <?php get_template_part( $this->customizer_icon_container ); ?>
		</div>
		<?php
	}

		private function image_control($value = '', $show = '', $class='', $auto='', $sections=''){ 
		if($auto==1)
		{
			$auto="one";
		}

		if($auto==2)
		{
			$auto="two";
		}
		if($auto==3)
		{
			$auto="three";
		}
		if($auto==4)
		{
			$auto="four";
		}
		?>
		<div class="customizer-repeater-image-control" <?php if( $show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' ) { echo esc_attr('style="display:none;"'); } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Image','corpiva')?>
            </span>
			<input type="text" class="widefat custom-media-url <?php if($class="corpiva_overlimit") { echo esc_attr('corpiva-uploading-img');}?> <?php echo esc_attr($auto);?>" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-secondary customizer-repeater-custom-media-button <?php if($class="corpiva_overlimit") { echo esc_attr('corpiva-uploading-img-btn');}?> <?php echo esc_attr($auto);?>" value="<?php esc_attr_e( 'Upload Image','corpiva' ); ?>" />
		</div>
		<?php
	}

	private function image_control2($value = '', $show = '', $class='', $auto='', $sections=''){ 
		if($auto==1)
		{
			$auto="one";
		}

		if($auto==2)
		{
			$auto="two";
		}
		if($auto==3)
		{
			$auto="three";
		}
		if($auto==4)
		{
			$auto="four";
		}
		?>
		<div class="customizer-repeater-image2-control">
            <span class="customize-control-title">
                <?php esc_html_e('Image 2','corpiva')?>
            </span>
			<input type="text" class="widefat custom-media-url2 <?php if($class="corpiva_overlimit") { echo esc_attr('corpiva-uploading-img');}?> <?php echo esc_attr($auto);?>" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-secondary customizer-repeater-custom-media-button <?php if($class="corpiva_overlimit") { echo esc_attr('corpiva-uploading-img-btn');}?> <?php echo esc_attr($auto);?>" value="<?php esc_attr_e( 'Upload Image','corpiva' ); ?>" />
		</div>
		<?php
	}

	private function slide_align($value='left'){?>
	
	<span class="customize-control-title">
	<?php esc_html_e('Slide Align','corpiva'); ?>
	</span>
	<select class="customizer-repeater-slide-align">
		<option value="left" <?php selected($value,'left');?>>
		<?php esc_html_e('Left','corpiva') ?>
		</option>
		
		<option value="right" <?php selected($value,'right');?>>
		<?php esc_html_e('Right','corpiva') ?>
		</option>
		
		<option value="center" <?php selected($value,'center');?>>
		<?php esc_html_e('Center','corpiva') ?>
		</option>
		
		
	</select>
		
	<?php
	}
	
	private function bg_type($value='image'){?>
	
	<span class="customize-control-title">
	<?php esc_html_e('Background Type','corpiva'); ?>
	</span>
	<select class="customizer-repeater-bg-type">
		<option value="image" <?php selected($value,'image');?>>
		<?php esc_html_e('Image','corpiva') ?>
		</option>
		
		<option value="video" <?php selected($value,'video');?>>
		<?php esc_html_e('Video','corpiva') ?>
		</option>	
		
	</select>
		
	<?php
	}
	
	private function icon_type_choice($value='customizer_repeater_icon', $corpiva_limit=''){ ?>
		<span class="customize-control-title">
            <?php esc_html_e('Image type','corpiva');?>
        </span>
		<select class="customizer-repeater-image-choice  <?php echo esc_attr($corpiva_limit);?>">
			<option value="customizer_repeater_icon" <?php selected($value,'customizer_repeater_icon');?>><?php esc_html_e('Icon','corpiva'); ?></option>
			<option value="customizer_repeater_image" <?php selected($value,'customizer_repeater_image');?>><?php esc_html_e('Image','corpiva'); ?></option>
			<option value="customizer_repeater_none" <?php selected($value,'customizer_repeater_none');?>><?php esc_html_e('None','corpiva'); ?></option>
		</select>
		<?php
	}

	private function repeater_control($value = '', $corpiva_limit='', $corpiva_type_with_id=''){
		$social_repeater = array();
		$show_del        = 0; ?>
		<span class="customize-control-title"><?php esc_html_e( 'Social icons', 'corpiva' ); ?></span>
		<?php
		if(!empty($value)) {
			$social_repeater = json_decode( html_entity_decode( $value ), true );
		}
		if ( ( count( $social_repeater ) == 1 && '' === $social_repeater[0] ) || empty( $social_repeater ) ) { ?>
			<div class="customizer-repeater-social-repeater">
				<div class="customizer-repeater-social-repeater-container">
					<div class="customizer-repeater-rc input-group icp-container">
						<input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value ); } ?>" type="text">
						<span class="input-group-addon"></span>
					</div>
					<?php get_template_part( $this->customizer_icon_container ); ?>
					<input type="text" class="customizer-repeater-social-repeater-link team_linkdata_<?php echo $corpiva_limit;?> <?php echo esc_attr($corpiva_type_with_id);?>"
					       placeholder="<?php esc_attr_e( 'Link', 'corpiva' ); ?>">
					<input type="hidden" class="customizer-repeater-social-repeater-id" value="">
					<button class="social-repeater-remove-social-item" style="display:none">
						<?php esc_html_e( 'Remove Icon', 'corpiva' ); ?>
					</button>
				</div>
				<input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
			</div>
			<button class="social-repeater-add-social-item button-secondary "><?php esc_html_e( 'Add Icon', 'corpiva' ); ?></button>
			<?php
		} else { ?>
			<div class="customizer-repeater-social-repeater">
				<?php
				foreach ( $social_repeater as $social_icon ) {
					$show_del ++; ?>
					<div class="customizer-repeater-social-repeater-container">
						<div class="customizer-repeater-rc input-group icp-container">
							<input data-placement="bottomRight" class="icp icp-auto team_data_<?php echo esc_attr($corpiva_limit);?> <?php echo esc_attr($corpiva_type_with_id);?>" value="<?php if( !empty($social_icon['icon']) ) { echo esc_attr( $social_icon['icon'] ); } ?>" type="text">
							<span class="input-group-addon"><i class="<?php echo esc_attr( $social_icon['icon'] ); ?>"></i></span>
						</div>
						<?php get_template_part( $this->customizer_icon_container ); ?>
						<input type="text" class="customizer-repeater-social-repeater-link"
						       placeholder="<?php esc_attr_e( 'Link', 'corpiva' ); ?>"
						       value="<?php if ( ! empty( $social_icon['link'] ) ) {
							       echo esc_url( $social_icon['link'] );
						       } ?>">
						<input type="hidden" class="customizer-repeater-social-repeater-id"
						       value="<?php if ( ! empty( $social_icon['id'] ) ) {
							       echo esc_attr( $social_icon['id'] );
						       } ?>">
						<button class="social-repeater-remove-social-item"
						        style="<?php if ( $show_del == 1 ) {
							        echo esc_attr("display:none");
						        } ?>"><?php esc_html_e( 'Remove Icon', 'corpiva' ); ?></button>
					</div>
					<?php
				} ?>
				<input type="hidden" id="social-repeater-socials-repeater-colector"
				       class="social-repeater-socials-repeater-colector"
				       value="<?php echo esc_textarea( html_entity_decode( $value ) ); ?>" />
			</div>
			<button class="social-repeater-add-social-item button-secondary <?php echo esc_attr($corpiva_limit);?> <?php echo esc_attr($corpiva_type_with_id);?>"><?php esc_html_e( 'Add Icon', 'corpiva' ); ?></button>
			<?php
		}
	}
}


/**
  * Filter to modify input label in repeater control
  * You can filter by control id and input name
  */
 function corpiva_repeater_labels( $string, $id, $control ) {
	if ( $id === 'corpiva_slider_option' ) {
		if ( $control === 'customizer_repeater_link_control' ) {
			return esc_html__( 'Link 1','corpiva' );
		}
		
		if ( $control === 'customizer_repeater_link2_control' ) {
			return esc_html__( 'Link 2','corpiva' );
		}
		
		if ( $control === 'customizer_repeater_subtitle3_control' ) {
			return esc_html__( 'Button Label 3','corpiva' );
		}
	}
	
	
	return $string;
 }
 add_filter( 'corpiva_repeater_input_labels_filter','corpiva_repeater_labels', 10 , 3 );