<?php
/**
 * Template for Case Studies Slider Style Two
 *
 * @package RadiantThemes
 */

		$terms            = get_the_terms( get_the_ID(), 'case-study-category' );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$ptype_name = $term->name;
			}
		}
		$output          .= '<div class="rt-case-study-box-item">';
                    $output          .= '<div class="holder matchHeight">';
                        
                        $output          .= '<div class="pic">';
                            $output          .= '<img src="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '" alt="Image" >';
                            $output          .= '<a class="placeholder" href="' . get_the_permalink() . '"></a>';
                        $output          .= '</div>';
                        

                        
                        $output          .= '<div class="data">';
                            $output          .= '<span class="date">' . get_the_date() . ' / '.$ptype_name.'</span>';
                            $output          .= '<h3 class="title"><a href="' . get_the_permalink() . '">'.substr(get_the_excerpt(), 0,70).'...</a></h3>';
                            
                        $output          .= '</div>';
                        
                    $output          .= '</div> ';  
                $output          .= '</div>';
		
		
