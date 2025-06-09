<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your WordPress site
 */
 class Corpiva_Post_Category_Control extends WP_Customize_Control
 {
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
							<?php
								printf( '<option value="%s" %s>%s</option>', 0, selected( $this->value(), '', false ), esc_html( 'All', 'corpiva' )  );
							?>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s">%s</option>', $cat->term_id, $cat->name);
									
									
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }