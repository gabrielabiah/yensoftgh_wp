<?php
/**
 * Template ihover Style One.
 *
 * @package Radiantthemes
 */
 
$output .= '<div class="holder">';
$output .= '<div class="pic">';
$output .= wp_get_attachment_image( $settings['ihover_image']['id'], 'full' );
$output .= '</div>';
$output .= '<div class="data">';
$output .= '<div class="table">';
$output .= '<div class="table-cell">';
$output .= '<h2>' . esc_attr( $settings['title'] ) . '</h2>';
$output .= '<p>' . esc_attr( $settings['ihover_content'] ) . '</p>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';