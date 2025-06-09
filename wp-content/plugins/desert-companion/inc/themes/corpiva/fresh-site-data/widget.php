<?php
$activate_theme_widget = array(
        'corpiva-sidebar-primary' => array(
            'search-1',
            'recent-posts-1',
            'archives-1',
        ),
		'corpiva-footer-widget-1' => array(
            'text-1',
        ),
		'corpiva-footer-widget-2' => array(
            'text-2',
        ),
		'corpiva-footer-widget-3' => array(
            'search-1',
        ),
		'corpiva-footer-widget-4' => array(
            'text-3',
        )
    );
    /* the default titles will appear */
	update_option('widget_text', array(  
		1 => array('title' => '',
        'text'=>'<aside class="widget widget_block">
                            <div class="wp-widget-group__inner-blocks">
                                <h3><span class="font-normal">Ready To Start</span> Work With Us?</h3>
                                <p class="dt-mt-4 dt-mb-3">We work with a passion of taking challenges and creating new ones in advertising sector.</p>
                                <ol class="list_none inf_list">
                                    <li>
                                        <a href="#">
                                            <i aria-hidden="true" class="text-primary dt-mr-2 fal fa-phone-volume"></i> <span>+1-888-452-1505</span>
                                        </a>
                                    </li>
                                    <li>
                                        <i aria-hidden="true" class="text-primary dt-mr-2 far fa-clock"></i> <span>Mon – Sat: 9:00 am – 5:00 pm,<br> Sunday: <strong class="text-primary">CLOSED</strong>
                                    </span></li>
                                </ol>
                                <a href="#" class="dt-btn dt-btn-primary dt-mt-4"><span class="letter text-spin">&nbsp;</span><span class="letter text-spin">G</span><span class="letter text-spin">e</span><span class="letter text-spin">t</span><span class="letter text-spin">&nbsp;</span><span class="letter text-spin">a</span><span class="letter text-spin">&nbsp;</span><span class="letter text-spin">Q</span><span class="letter text-spin">u</span><span class="letter text-spin">o</span><span class="letter text-spin">t</span><span class="letter text-spin">e</span></a>
                            </div>
                        </aside>'),		
		2 => array('',
        'text'=>'<aside class="widget widget_nav_menu">
                            <h5 class="widget-title">Quick Links</h5>
                            <div class="menu-services-container">
                                <ul id="menu-services-menu" class="menu">
                                    <li class="menu-item"><a href="#">Company</a></li>
                                    <li class="menu-item"><a href="#">How it’s Work</a></li>
                                    <li class="menu-item"><a href="#">Service</a></li>
                                    <li class="menu-item"><a href="#">Case Studies</a></li>
                                    <li class="menu-item"><a href="#">Pricing</a></li>
                                    <li class="menu-item"><a href="#">Privacy Policy</a></li>
                                    <li class="menu-item"><a href="#">Support</a></li>
                                    <li class="menu-item"><a href="#">Press media</a></li>
                                    <li class="menu-item"><a href="#">Careers</a></li>
                                    <li class="menu-item"><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </aside>'),	
		3 => array('title' => '',
        'text'=>'<aside class="widget widget_block">
                            <h5 class="widget-title">Newsletter</h5>
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
	$MediaId = get_option('corpiva_media_id');
	set_theme_mod( 'custom_logo', $MediaId[0] );