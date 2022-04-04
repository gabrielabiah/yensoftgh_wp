<?php
/**
 * Testimonial Template Style Nine
 *
 * @package Radiantthemes
 */

// START OF LAYOUT Nine.


$output .= '<div class="testi-nine">
            <div class="item">
                <div class="shadow-effect">
                    <div class="quote_slide"><i class="fa fa-quote-left" aria-hidden="true"></i></div>';
                    $output .='<p>'. esc_attr( get_the_content() ) .'</p>';
                    $output .='<div class="testimonial-img">';
                   
                    $output .= '<img src="' . get_the_post_thumbnail_url( get_the_ID() ) . '" alt="img" />';
                    $output .='</div>
                </div>
            </div>
            <div class="testimonial-name">';
  $output .= esc_attr( get_the_title() ) . '</div>
        </div>';       
        
