<?php

function wpjobusSendNotifications($td_post_id) {

  	$post_type_id = get_post_type($td_post_id);

    if($post_type_id == "job") {

        $item_location = "";
        $item_industry = "";

        $item_location = get_post_meta($td_post_id, 'job_location',true);
        $item_industry = get_post_meta($td_post_id, 'job_industry',true);

        $authors = get_users();

        // Check for results
        if (!empty($authors)) {

            // loop trough each author
            foreach ($authors as $author) {

                $location = 0;
                $category = 0;

                $td_user_id = $author->ID;
                $user_email = $author->user_email;

                $user_job_categories = get_user_meta( $td_user_id, 'user_job_categories_subcriptions' );
                $user_job_locations = get_user_meta( $td_user_id, 'user_job_locations_subcriptions' );

                if(!empty($user_job_locations)) { 
                    if (in_array($item_location, $user_job_locations[0])) {
                        $location = 1;
                    }
                }

                if(!empty($user_job_categories)) { 
                    if (in_array($item_industry, $user_job_categories[0])) {
                        $category = 1;
                    }
                }

                if($location == 1 AND $category == 1) {

                    // send email code here
                    global $redux_demo; 
                    $contact_email = $redux_demo['contact-email'];
                    $email = $contact_email;
                    $blog_title = get_bloginfo('name');
                    $link = home_url('/')."job/".$td_post_id;

                    $emailTo = $user_email;
                    $subject = "Job Notification from ".$blog_title; 
                    $body = "A new job has been added in '".$item_industry."' category in ".$item_location.". Link: ".$link." ";
                    $headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
                      
                    wp_mail($emailTo, $subject, $body, $headers);

                }

            }

        }

    } elseif($post_type_id == "company") {

        $item_location = "";
        $item_industry = "";

        $item_location = get_post_meta($td_post_id, 'company_location',true);
        $item_industry = get_post_meta($td_post_id, 'company_industry',true);

        $authors = get_users();

        // Check for results
        if (!empty($authors)) {

            // loop trough each author
            foreach ($authors as $author) {

                $location = 0;
                $category = 0;

                $td_user_id = $author->ID;
                $user_email = $author->user_email;

                $user_company_categories = get_user_meta( $td_user_id, 'user_company_categories_subcriptions' );
                $user_company_locations = get_user_meta( $td_user_id, 'user_company_locations_subcriptions' );

                if(!empty($user_company_locations)) { 
                    if (in_array($item_location, $user_company_locations[0])) {
                        $location = 1;
                    }
                }

                if(!empty($user_company_categories)) { 
                    if (in_array($item_industry, $user_company_categories[0])) {
                        $category = 1;
                    }
                }

                if($location == 1 AND $category == 1) {

                    // send email code here
                    global $redux_demo; 
                    $contact_email = $redux_demo['contact-email'];
                    $email = $contact_email;
                    $blog_title = get_bloginfo('name');
                    $link = home_url('/')."company/".$td_post_id;

                    $emailTo = $user_email;
                    $subject = "Company Notification from ".$blog_title; 
                    $body = "A new company has been added in '".$item_industry."' category in ".$item_location.". Link: ".$link." ";
                    $headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
                      
                    wp_mail($emailTo, $subject, $body, $headers);

                }

            }

        }

    } elseif($post_type_id == "resume") {

        $item_location = "";
        $item_industry = "";

        $item_location = get_post_meta($td_post_id, 'resume_location',true);
        $item_industry = get_post_meta($td_post_id, 'resume_industry',true);

        $authors = get_users();

        // Check for results
        if (!empty($authors)) {

            // loop trough each author
            foreach ($authors as $author) {

                $location = 0;
                $category = 0;

                $td_user_id = $author->ID;
                $user_email = $author->user_email;

                $user_resume_categories = get_user_meta( $td_user_id, 'user_resume_categories_subcriptions' );
                $user_resume_locations = get_user_meta( $td_user_id, 'user_resume_locations_subcriptions' );

                if(!empty($user_resume_locations)) { 
                    if (in_array($item_location, $user_resume_locations[0])) {
                        $location = 1;
                    }
                }

                if(!empty($user_resume_categories)) { 
                    if (in_array($item_industry, $user_resume_categories[0])) {
                        $category = 1;
                    }
                }

                if($location == 1 AND $category == 1) {

                    // send email code here
                    global $redux_demo; 
                    $contact_email = $redux_demo['contact-email'];
                    $email = $contact_email;
                    $blog_title = get_bloginfo('name');
                    $link = home_url('/')."resume/".$td_post_id;

                    $emailTo = $user_email;
                    $subject = "Resume Notification from ".$blog_title; 
                    $body = "A new resume has been added in '".$item_industry."' category in ".$item_location.". Link: ".$link." ";
                    $headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
                      
                    wp_mail($emailTo, $subject, $body, $headers);

                }

            }

        }

    }

}