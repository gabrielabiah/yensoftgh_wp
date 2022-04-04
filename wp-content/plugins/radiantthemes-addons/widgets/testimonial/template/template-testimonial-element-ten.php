<?php
/**
 * Testimonial Template Style Ten
 *
 * @package Radiantthemes
 */

// START OF LAYOUT Nine.

$output .= '<div class="testimonial-item">';
                    $output .= '<div class="rt_testimonial-image-grid col-md-2 col-sm-3 col-xs-12">';
                        $output .= '<img src="' . get_the_post_thumbnail_url( get_the_ID() ) . '" alt="">';
                        $output .= '<h3 class="testimonial-name">'.esc_attr( get_the_title() ).'</h3>';
                        $output .= '<div class="testimonial-job">' . esc_attr( get_post_meta( get_the_ID(), '_testimonial_designation', true ) ) . '</div>';
                    $output .= '</div>';
                    $output .= '<div class="col-md-1 col-sm-1 col-xs-12">';
                        $output .= '<div class="quote_area">';
                            $output .= '<div class="midd"><i class="fa fa-quote-right" aria-hidden="true"></i></div>';
                        $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="col-md-8 col-sm-8 col-xs-12">';
                        $output .= '<div class="testimonial-content">' . esc_attr( get_the_content() ) . '</div>';
                    $output .= '</div>';
                $output .= '</div>';


   
        
