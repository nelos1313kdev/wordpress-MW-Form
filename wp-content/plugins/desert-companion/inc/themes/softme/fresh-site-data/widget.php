<?php
$activate_theme_widget = array(
        'softme-sidebar-primary' => array(
            'search-1',
            'recent-posts-1',
            'archives-1',
        ),
		'softme-footer-widget-1' => array(
            'text-1',
        ),
		'softme-footer-widget-2' => array(
            'text-2',
        ),
		'softme-footer-widget-3' => array(
            'text-3',
        ),
		'softme-footer-widget-4' => array(
            'text-4',
        )
    );
    /* the default titles will appear */
	update_option('widget_text', array(
		1 => array('title' => '',
        'text'=>'<aside class="widget widget_block">
                            <h5 data-animation-box class="widget-title"><span data-animation-text class="overlay-anim-white-bg" data-animation="overlay-animation">About Us</span></h5>
                            <div class="wp-widget-group__inner-blocks">
                                <a href="index.html" class="custom-logo-link" rel="home" aria-current="page">
                                    <img width="190" height="33" src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/softme/assets/images/logo.png" class="custom-logo" alt="SoftMe">
                                </a>
                                <p class="dt-mt-5">We work with a passion of taking challenges and creating new ones in advertising sector.</p>
                                <a href="#" class="dt-btn dt-btn-primary dt-mt-2">
                                    <span class="dt-btn-text" data-text="Get a Quote">Get a Quote</span>
                                </a>
                                <div class="lets_start">
                                    <div class="icon">
                                        <i class="fas fa-bullhorn" aria-hidden="true"></i>
                                    </div>
                                    <div class="text">
                                        <a href="contact.html">Lets Start Talking</a>
                                    </div>
                                </div>
                            </div>
                        </aside>'),
		2 => array('',
        'text'=>'<aside class="widget widget_nav_menu">
        <h5 data-animation-box class="widget-title"><span data-animation-text class="overlay-anim-white-bg" data-animation="overlay-animation">Quick Links</span></h5>
        <div class="menu-quick-links-container">
            <ul id="menu-quick-links" class="menu">
                <li id="menu-item-493" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a href=#">About</a></li>
                <li id="menu-item-498" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-498"><a href="#">Our Team</a></li>
                <li id="menu-item-494" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-494"><a href="#">Service</a></li>
                <li id="menu-item-499" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-499"><a href="#">Portfolio</a></li>
                <li id="menu-item-495" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-495"><a href="#">Pricing</a></li>
                <li id="menu-item-500" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-500"><a href="#">Help</a></li>
                <li id="menu-item-496" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-496"><a href="#">Support</a></li>
                <li id="menu-item-501" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-501"><a href="#">Clients</a></li>
                <li id="menu-item-497" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-497"><a href="#">Contact</a></li>
            </ul>
        </div>
    </aside>'),	
		3 => array('title' => '',
        'text'=>'<aside class="widget widget_block">
        <h5 data-animation-box class="widget-title"><span data-animation-text class="overlay-anim-white-bg" data-animation="overlay-animation">Official Info</span></h5>
        <div class="wp-widget-group__inner-blocks">
            <ol class="list_none inf_list">
                <li>
                    <a href="#">
                        <i aria-hidden="true" class="text-primary dt-mr-2 fas fa-map-marker-alt"></i> <span>855 Kim Road, Broklyn Street,<br> New York USA</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i aria-hidden="true" class="text-primary dt-mr-2 fas fa-phone-alt"></i> <span>+1-888-452-1505</span>
                    </a>
                </li>
                <li>
                    <strong class="text-white dt-d-block dt-mt-3 dt-mb-1">Open Hours:</strong> Mon – Sat: 9:00 am – 5:00 pm,<br> Sunday: CLOSED
                </li>
            </ol>
        </div>
    </aside>'),	
		4 => array('title' => '',
        'text'=>'<aside class="widget widget_block">
        <h5 data-animation-box class="widget-title"><span data-animation-text class="overlay-anim-white-bg" data-animation="overlay-animation">Newsletter</span></h5>
        <div class="wp-widget-group__inner-blocks">
            <div class="subscribe-form">
                <p>Donec metus lorem, vulputate at sapien sit amet, auctor iaculis lorem. In vel hendrerit nisi.</p>
                <!-- Mailchimp for WordPress v4.8.7 - https://wordpress.org/plugins/mailchimp-for-wp/ -->
                <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-83" method="post" data-id="83" data-name="">
                    <div class="mc4wp-form-fields">
                        <div class="email-form-two">
                            <div class="form-group">
                                <input type="email" name="search-field" value="" placeholder="Email address" required="">
                                <button type="submit" class="as-btn submit-btn fa fa-paper-plane"></button>
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
	$MediaId = get_option('softme_media_id');
	set_theme_mod( 'custom_logo', $MediaId[0] );