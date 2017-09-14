<?php 

function fubix_custom_styles() {

	wp_enqueue_style(
		'custom-style',
		get_template_directory_uri() . '/css/custom-styles.css'
	);

	global $redux_demo; 
    $wpcrown_main_color = $redux_demo['color-main'];
    $wpcrown_main_color_hover = $redux_demo['color-main-hover'];
    $wpcrown_color_second = $redux_demo['color-second'];
    $wpcrown_color_second_hover = $redux_demo['color-second-hover'];

    $wpcrown_opt_colors = $redux_demo['opt-colors'];

    if($wpcrown_opt_colors) {

        // Main Color
        if(!empty($wpcrown_main_color)) {

            $custom_css_main_color = "
                    a, #navbar .main_menu .menu li.current_page_item .sub-menu a:hover, 
                    #navbar .main_menu .menu li.current_page_item .children a:hover, 
                    #navbar .main_menu .menu li.current-menu-item  .children a:hover, .main_menu ul li ul.children li a:hover, .main_menu ul li ul.sub-menu li a:hover, .main_menu ul li ul.children li.current_page_item a, .main_menu ul li ul.children li.current-menu-item a, .main_menu .menu li.current_page_item .sub-menu a:hover, .main_menu .menu li.current-menu-item  .sub-menu a:hover, .main_menu .menu li.current_page_item .children a:hover, .main_menu .menu li.current-menu-item  .children a:hover, .geo-location-button .on .fa, .geo-location-button .fa:hover, ul.custom-tabs li a.current, h4.trigger:hover, h4.trigger.active:hover, h4.trigger.active,#navbar .main_menu .menu li .sub-menu li.current_page_item a, #navbar .main_menu .menu li .children li.current_page_item a, #navbar .main_menu .menu li .children li.current_page_item a:hover, #navbar .main_menu .menu li .children li .current-menu-item a:hover, new-recipe a.btn, #print-button:hover .fa, .main_menu ul li a, .main_menu ul li ul li a, .main_menu ul li a .fa, .top_menu.account-menu ul li.first a, .top_menu.account-menu ul li.last a, a.pending-posts:hover, a.pending-posts:hover .fa, .featured-item-content-title, .featured-item-content-tagline, .widget a, .widget a:visited, .widget ul li a, .my-account-header-title .resume-section-subtitle span, .my-account-header-settings-link, .my-account-companies-link, .my-account-header-settings-link a, .my-account-job-single-feature .make-featured .fa, .my-account-company-single-feature .make-featured .fa, .my-account-company-single-publish .fa, a.button-ag-full, .my-account-job-single-edit a .fa, .my-account-company-single-edit a .fa, .my-account-header-settings-link .fa, .my-account-companies-link .fa, .my-account-company-single-title a, .my-account-job-single-title a, .resume-contact-info span a, #resume-menu .container ul li a, #company-menu .container ul li a, #job-menu .container ul li a, .job-company-desc h1, #resume-menu .container a .fa, #company-menu .container a .fa, #job-menu .container a .fa, .register-block-blue h2, .register-block-blue h2 .fa, .my-account-header-settings-link, .my-account-companies-link, .my-account-header-subscriptions-link, .my-account-header-settings-link .fa, .my-account-companies-link .fa, .my-account-header-subscriptions-link .fa { 
                        color: {$wpcrown_main_color};
                    }

                    #contact-form #contactName:focus, #contact-form #author:focus, #contact-form #email:focus, #contact-form #url:focus, #contact-form #subject:focus, #contact-form #commentsText:focus, #contact-form #humanTest:focus { 
                    border: 1px solid {$wpcrown_main_color};
                    }

                    .main_menu ul li:hover > a, .main_menu .menu li.current_page_item a, .main_menu .menu li.current-menu-item a { 
                        color: {$wpcrown_main_color};
                    }

                    h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { 
                        color: {$wpcrown_main_color} !important;
                    }

                    #comp-team-submit-clear, #comp-reset, a.button-ag-full, .resume-download-file a, .submit-loading { 
                        background-color: {$wpcrown_main_color};
                    }

                    #comp-team-submit-clear, #comp-reset, a.button-ag-full, .resume-download-file a, .submit-loading, #promo-ad a.btn, input[type='submit'], .woocommerce span.onsale, .woocommerce-page span.onsale, .products li a.button, .woocommerce div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, #top-cart .button, form.cart .button-alt, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .bbp-submit-wrapper button.button, .woocommerce .quantity .minus, .woocommerce-page .quantity .minus, .woocommerce #content .quantity .minus, .woocommerce-page #content .quantity .minus, .woocommerce .quantity .plus, .woocommerce-page .quantity .plus, .woocommerce #content .quantity .plus, .woocommerce-page #content .quantity .plus, form.cart .plus, form.cart .minus, .product-quantity .plus, .product-quantity .minus, .woocommerce .quantity input.qty, .woocommerce-page .quantity input.qty, .woocommerce #content .quantity input.qty, .woocommerce-page #content .quantity input.qty, form.cart input.qty, form.cart input.qty, .product-quantity input.qty, .pricing-plans a.btn, #edit-submit, .ads-tags a, #navbar .btn-navbar, .block-recipe-info-hover-link span, button.recipe-search-go-btn { 
                        background-color: {$wpcrown_main_color};
                    }

                    .ads-tags a:hover { 
                        background-color: {$wpcrown_main_color} !important;
                    }

                    .author-list-link-profile a { 
                        border: solid 1px {$wpcrown_main_color};
                    }

                    #thumbs-wrapper-feat-recipes a:hover > .image-thin-border > .image-big-border, #thumbs-wrapper-feat-recipes a.selected > .image-thin-border > .image-big-border, #thumbs a:hover > .image-thin-border > .image-big-border, #thumbs a.selected > .image-thin-border > .image-big-border { 
                        border-color: {$wpcrown_main_color};
                    }

                    ";
            wp_add_inline_style( 'custom-style', $custom_css_main_color );

        }

        // Main Hover Color
        if(!empty($wpcrown_main_color_hover)) {

            $custom_css_main_hover_color = "
                    a:hover, a:active, a:hover, footer.comment-meta a:hover, a:hover, .top_menu.account-menu ul li a:hover, .widget a:hover, .socket a:hover, .widget ul li a:hover, .top_menu.new-posts-menu ul li ul li a:hover, .new-posts-menu ul li ul.sub-menu li:hover .fa, .top_menu.new-posts-menu ul li ul li a:hover, #companies-block-list-ul li a:hover .company-list-name, .my-account-header-settings-link:hover, .my-account-header-settings-link:hover .fa, .my-account-companies-link:hover, .my-account-companies-link:hover .fa, .my-account-job-single-feature .make-featured:hover, .my-account-company-single-feature .make-featured:hover, .my-account-company-single-publish:hover, .my-account-job-single-feature .make-featured:hover .fa, .my-account-company-single-feature .make-featured:hover .fa, .my-account-company-single-publish:hover .fa, .my-account-job-single-edit a:hover, .my-account-company-single-edit a:hover, .my-account-job-single-edit a:hover .fa, .my-account-company-single-edit a:hover .fa, .resume-contact-info span a:hover { 
                        color: {$wpcrown_main_color_hover};
                    }

                    #comp-team-submit-clear, #comp-reset, input[type='submit'], a.button-ag-full { 
                        -webkit-box-shadow: 0 2px 0 {$wpcrown_main_color_hover}; 
                        box-shadow: 0 3px 0 {$wpcrown_main_color_hover}; 
                    }

                    h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, ul#homepage-posts-block.tabs-search li a:hover .fa, ul#homepage-posts-block.tabs-search li a:hover, ul#homepage-posts-block.tabs-search li.active a .fa, ul#homepage-posts-block.tabs-search li.active a,ul#homepage-posts-block.tabs li a:hover .fa, ul#homepage-posts-block.tabs li a:hover, ul#homepage-posts-block.tabs li.active a .fa, ul#homepage-posts-block.tabs li.active a { 
                        color: {$wpcrown_main_color_hover} !important; 
                    }

                    #comp-team-submit-clear:hover, #comp-reset:hover, a.button-ag-full:hover, .resume-download-file a:hover { 
                        background-color: {$wpcrown_main_color_hover}; 
                    }

                    #promo-ad a.btn:hover, input[type='submit']:hover, .products li a.button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover, #top-cart .button:hover, form.cart .button-alt:hover, .woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .bbp-submit-wrapper button.button:hover, .woocommerce .quantity .minus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page #content .quantity .minus:hover,.woocommerce .quantity .plus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce-page #content .quantity .plus:hover, form.cart .plus:hover, form.cart .minus:hover, .product-quantity .plus:hover, .product-quantity .minus:hover, .pricing-plans a.btn:hover, #edit-submit:hover, #navbar .btn-navbar:hover, button.recipe-search-go-btn:hover {
                        background: {$wpcrown_main_color_hover}; 
                    }

                    .author-list-link-profile a:hover {
                        background: {$wpcrown_main_color_hover}!important; 
                        border: solid 1px {$wpcrown_main_color_hover};
                    }

                    ";
            wp_add_inline_style( 'custom-style', $custom_css_main_hover_color );

        }

        // Second Color
        if(!empty($wpcrown_color_second)) {

            $custom_css_second_color = "
                    .save-resume-block .draft-resume-button input, .save-resume-block .draft-resume-button .submit-loading, .wpjobus-stat-circle, .socket, #blog .ui-slider-horizontal .ui-slider-handle, #blog .ui-slider .ui-slider-range, .education-period-circle, .company-services-icon, .register-block-green #comp-reset { 
                        background-color: {$wpcrown_color_second};
                    }

                    footer .widget .block-title, .resume-section-title, .resume-section-title .fa, .button-ag span.button-inner, .new-posts-menu .button-ag span.button-inner .fa, .button-ag, .banner-hello, .resume-author-name, .main-skills-item-title, .main-skills-item-title-language, .main-skills-item-title-language .fa, .work-experience-org-name, .work-experience-job-type, .resume-contact-info .fa, .company-services-title, #single-company .work-experience-job-type a, .register-block-green h2, .register-block-green h2 .fa, ul#homepage-posts-block.tabs li a:hover .fa, ul#homepage-posts-block.tabs li a:hover, ul#homepage-posts-block.tabs li.active a .fa, ul#homepage-posts-block.tabs li.active a { 
                        color: {$wpcrown_color_second};
                    }

                    .education-period-circle::after, .education-period-circle::before { 
                        border-left: solid 1px {$wpcrown_color_second};
                    }

                    .job-experience-holder .one_fourth { 
                        border-top: solid 1px {$wpcrown_color_second};
                    }

                    ";
            wp_add_inline_style( 'custom-style', $custom_css_second_color );

        }

        // Second Hover Color
        if(!empty($wpcrown_color_second_hover)) {

            $custom_css_second_hover_color = "
                    .save-resume-block .draft-resume-button input:hover, .new-posts-menu ul li:hover .button-ag span.button-inner, .register-block-green #comp-reset:hover { 
                        background-color: {$wpcrown_color_second_hover};
                    }

                    .new-posts-menu ul li:hover .button-ag { 
                        background-color: {$wpcrown_color_second_hover};
                    }

                    #single-company .work-experience-job-type a:hover { 
                        color: {$wpcrown_color_second_hover};
                    }

                    .register-block-green #comp-reset, .save-resume-block .draft-resume-button input { 
                        -webkit-box-shadow: 0 2px 0 {$wpcrown_color_second_hover};
                        box-shadow: 0 3px 0 {$wpcrown_color_second_hover};
                    }

                    ";
            wp_add_inline_style( 'custom-style', $custom_css_second_hover_color );

        }

    }

    if ( !current_user_can( 'manage_options' ) ) {

    	$custom_style_admin = "

	            #wpadminbar { display: none; }

	            ";
	    wp_add_inline_style( 'custom-style', $custom_style_admin );

    }

}
add_action( 'wp_enqueue_scripts', 'fubix_custom_styles' );

