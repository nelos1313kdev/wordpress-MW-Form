<?php
$activate_theme_widget = array(
        'cosmobit-sidebar-primary' => array(
            'search-1',
            'recent-posts-1',
            'archives-1',
        ),
		'cosmobit-footer-widget-1' => array(
            'text-1',
        ),
		'cosmobit-footer-widget-2' => array(
            'text-2',
        ),
		'cosmobit-footer-widget-3' => array(
            'search-1',
        ),
		'cosmobit-footer-widget-4' => array(
            'text-3',
        )
    );
    /* the default titles will appear */
	update_option('widget_text', array(  
		1 => array('title' => '',
        'text'=>'<aside id="text-2" class="widget widget_block">
                            <h5 class="widget-title">About Us</h5>
                            <div class="textwidget">
                                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis us nostrud exercitation amet, consectetur elit aboris nisi.</p>
                            </div>
                        </aside><aside class="widget widget_social">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </aside>'),		
		2 => array('',
        'text'=>'<aside id="nav_menu-2" class="widget widget_nav_menu">
                            <h5 class="widget-title">Services</h5>
                            <div class="menu-footer-menu-container">
                                <ul id="menu-footer-menu" class="menu">
                                    <li id="menu-item-13703" class="menu-item"><a href="#">Strategy and Planning</a></li>
                                    <li id="menu-item-13698" class="menu-item"><a href="#">Business Analysis</a></li>
                                    <li id="menu-item-13699" class="menu-item"><a href="#">Consumer Markets</a></li>
                                    <li id="menu-item-13700" class="menu-item"><a href="#">Corporate Finance</a></li>
                                    <li id="menu-item-13702" class="menu-item"><a href="#">Market Research</a></li>
                                </ul>
                            </div>
                        </aside>'),	
		3 => array('title' => '',
        'text'=>'<aside id="dt_mailchimp_widget-2" class="widget widget_block">
                            <h5 class="widget-title">Newsletter</h5>
                            <div class="subscribe-form">
                                <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                                <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-83" method="post" data-id="83" data-name="">
                                    <div class="mc4wp-form-fields">
                                        <div class="email-form-one">
                                            <div class="form-group">
                                                <input type="email" name="search-field" value="" placeholder="Email address" required="">
                                                <button type="submit" class="dt-btn submit-btn fa fa-paper-plane"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <label style="display: none !important;">Leave this field empty if you are human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off"></label>
                                    <input type="hidden" name="_mc4wp_timestamp" value="1656934898">
                                    <input type="hidden" name="_mc4wp_form_id" value="83">
                                    <input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1">
                                    <div class="mc4wp-response"></div>
                                </form><!-- / Mailchimp for WordPress Plugin -->
                            </div>
                            <!-- .mailchimp-wrapper -->
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
	$MediaId = get_option('cosmobit_media_id');
	set_theme_mod( 'custom_logo', $MediaId[0] );