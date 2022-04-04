<?php
/**
 * Template for Blog Item Ten.
 *
 * @package RadiantThemes
 */

// POST FORMAT QUOTE.

$output                 .= '<article ID="blog-item-'.get_the_ID().'" class="style-one blog-item wow slideInUp">
				                    <div class="post-thumbnail">';
				        $output     .= '<img src="' . plugins_url( 'radiantthemes-addons/assets/images/Blank-Image-100x63.png' ) . '" alt="Blank Image" width="100" height="63">';
			$output     .= '<a class="placeholder" href="' . get_the_permalink() . '" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) . ');"></a>';            
				                    
				$output     .= '	</div>
		<a href="' . get_the_permalink() . '" class="post-button">
<span class="ti-angle-right"></span>
 </a>
 <div class="post-data">
	<div class="entry-main matchHeight" style="height: 65px;">
		<header class="entry-header">
		    	<span class="date">'.get_the_date( 'F j, Y' ).'</span>
			<h3 class="entry-title"><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a></h3>		</header>
			</div>
	<div class="post-meta">
		<span class="author">By  '. get_the_author() .'</span>
	
	</div>
	</div>
</article>
';
