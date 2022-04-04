<?php
/**
 * Template for Blog Item Fourteen.
 *
 * @package RadiantThemes
 */

// POST FORMAT QUOTE.
$category_detail = get_the_category( get_the_id() );
		$result          = '';
		foreach ( $category_detail as $item ) :
			$category_link = get_category_link( $item->cat_ID );
			$result       .= '<a href = "' . esc_url( $category_link ) . '">' . $item->name . '</a>';
		endforeach;

$output   .= '
<article class="style-one blog-item">
<div class="holder">';

$output .= '<div class="category-list">'.$result.'</div>';

				                    $output .='<div class="post-thumbnail">';
				        $output     .= '<img src="' . plugins_url( 'radiantthemes-addons/assets/images/Blank-Image-100x63.png' ) . '" alt="Blank Image" width="100" height="63">';
			$output     .= '<a class="placeholder" href="' . get_the_permalink() . '" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) . ');"></a>';            
				                    
				$output     .= '	</div>
				
		<div class="post-btn"><a href="' . get_the_permalink() . '" class="post-button">
<span class="ti-angle-right"></span>
 </a></div>
 <div class="post-data matchHeight">
	<div class="entry-main">
		<header class="entry-header">';

		    	$output .='<span class="date">'.get_the_date( 'F j, Y' ).'</span>';
	    	
			$output .='<h3 class="entry-title"><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a></h3>		</header>
			</div>';
  
	$output .='<div class="post-meta">';
		$output .='<span class="author">'.esc_html__( ' By ', 'radiantthemes-addon' ). get_the_author() .'</span>';
	$output .='</div>';
 

	$output .='</div>';
	$output .='</div>';
	$output .='</article>';

