<?php
/**
 * Template Style Six for Team
 *
 * @package RadiantThemes

 */
$output .= '<div class="team-item-seven">';
                $output .= '<div class="rt_team_area">';
                    $output .= '<div class="rt_img_bx"><img src="'. get_the_post_thumbnail_url( get_the_ID(), 'large' ) . '" alt="' . get_the_title() . '" >';

                    $output .= '</div>';
                    $output .= '<div class="rt_team_detail_bx">';
                        $output .= '<a href="">';
                            $output .= '<h3>' . get_the_title() . '</h3>';
                        $output .= '</a>';
                         $terms   = get_the_terms( get_the_ID(), 'profession' );
			             if ( ! empty( $terms ) ) {
				         foreach ( $terms as $term ) {
					     $output .= '<p >' . $term->name . '</p>';
				         }
			             }						
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
 