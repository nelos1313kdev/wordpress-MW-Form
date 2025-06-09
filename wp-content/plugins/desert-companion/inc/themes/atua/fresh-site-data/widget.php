<?php
$activate_theme_widget = array(
        'atua-sidebar-primary' => array(
            'search-1',
            'recent-posts-1',
            'archives-1',
        ),
		'atua-footer-widget-1' => array(
            'text-1',
        ),
		'atua-footer-widget-2' => array(
            'text-2',
        ),
		'atua-footer-widget-3' => array(
            'search-1',
        ),
		'atua-footer-widget-4' => array(
            'text-3',
        )
    );
    /* the default titles will appear */
	update_option('widget_text', array(  
		1 => array('title' => '',
        'text'=>'<aside id="text-2" class="widget widget_block">
                            <h5 class="widget-title">About Us</h5>
                            <div class="wp-widget-group__inner-blocks">
                                <h3><span class="font-normal">Ready To Start</span> Work With Us?</h3>
                                <p class="dt-mt-3">Felis consequat magnis est fames sagittis ultrices placerat sodales porttitor quisque.</p>
                                <a href="#" class="dt-btn dt-btn-primary dt-mt-2">
                                    <span class="dt-btn-text" data-text="Get a Quote">Get a Quote</span>
                                </a>
                            </div>
                        </aside><aside class="widget widget_social">
                            <ul>
                                <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://linkedin.com/"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="https://www.behance.net/"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </aside>'),		
		2 => array('',
        'text'=>'<aside class="widget widget_nav_menu">
                            <h5 class="widget-title">Quick Links</h5>
                            <div class="menu-services-container">
                                <ul id="menu-services-menu" class="menu">
                                    <li class="menu-item"><a href="#">Appointment</a></li>
                                    <li class="menu-item"><a href="#">Price Plans</a></li>
                                    <li class="menu-item"><a href="#">Investment Strategy</a></li>
                                    <li class="menu-item"><a href="#">Financial Advices</a></li>
                                    <li class="menu-item"><a href="#">Strategy Growth</a></li>
                                    <li class="menu-item"><a href="#">Services</a></li>
                                    <li class="menu-item"><a href="#">Business Planning</a></li>
                                </ul>
                            </div>
                        </aside>'),	
		3 => array('title' => '',
        'text'=>'<aside class="widget widget_block">
                            <h5 class="widget-title">Opening Hours</h5>
                            <div class="dt_business_hour">
                                <div class="dt_business_schedule no">
                                    <span class="dt_business_day">Week Days</span>
                                    <span class="dt_business_time">10:00 - 17:00</span>
                                </div>
                                <div class="dt_business_schedule no">
                                    <span class="dt_business_day">Saturday</span>
                                    <span class="dt_business_time">10:00 - 15:00 </span>
                                </div>
                                <div class="dt_business_schedule ">
                                    <span class="dt_business_day">Sunday</span>
                                    <span class="dt_business_time">Day Off</span>
                                </div>
                                <div class="dt_business_btn dt-mt-4">
                                    <a href="#" class="dt-btn dt-btn-primary">
                                        <span class="dt-btn-text" data-text="Contact us">Contact us</span>
                                    </a>
                                </div>
                            </div>
                        </aside>'),	
        ));
		 update_option('widget_categories', array(
			1 => array('title' => 'Categories'), 
			2 => array('title' => 'Categories')));

		update_option('widget_archives', array(
			1 => array('title' => 'Archives'), 
			2 => array('title' => 'Archives')));
			
		update_option('widget_search', array(
			1 => array('title' => 'Search'), 
			2 => array('title' => 'Search')));	
		
    update_option('sidebars_widgets',  $activate_theme_widget);
	$MediaId = get_option('atua_media_id');
	set_theme_mod( 'custom_logo', $MediaId[0] );