<?php
/**
 * Template for Portfolio Style Twelve
 *
 * @package RadiantThemes
 */
if ( empty( $settings['radiant_portfolio_category'] ) ) {
	$portfolio_category = '';
} else {
	$portfolio_category = array(
		array(
			'taxonomy' => 'portfolio-category',
			'terms'    => $settings['radiant_portfolio_category'],
		),
	);
	$hidden_filter      = 'hidden';
}
$output .= '<div class="rt-portfolio-box element-twelve">';
// WP_Query arguments.
global $wp_query;
$args     = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => esc_attr( $settings['radiant_portfolio_max_posts'] ),
	'orderby'        => esc_attr( $settings['radiant_portfolio_looping_order'] ),
	'order'          => esc_attr( $settings['radiant_portfolio_looping_sort'] ),
	'tax_query'      => $portfolio_category,
);
$my_query = null;
$my_query = new WP_Query( $args );
if ( $my_query->have_posts() ) {
	while ( $my_query->have_posts() ) :
		$my_query->the_post();
		$terms = get_the_terms( get_the_ID(), 'portfolio-category' );



		$output .= '<div class="rt-grid">';
    $output .= '<div class="rt-image-box"><a href="' . get_the_permalink() . '">';
    $output     .= get_the_post_thumbnail( get_the_ID(), 'large' );
    $output .= '</a></div>';
    $output .= '<div class="rt-bottom-left">';
      $output .= '<div class="radiant_lifestyle_trans_bg">';

        $output .= '<div class="radiant-masonory-category">';
         $cats    = get_the_terms( get_the_ID(), 'portfolio-category' );
		foreach ( $cats as $cat ) {
			$term_id    = $cat->term_id;
			$ptype_name = $cat->name;
			$ptype_des  = $cat->description;
			$ptype_slug = $cat->slug;
			$term_link  = get_term_link( $cat );
			$output    .= '<p>';
			$output    .= $ptype_name;
			$output    .= '</p>';
			}
        $output .= '</div>';
        $output .= '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
       $output .= '</div>';

    $output .= '</div>';

  $output .= '</div>';
endwhile;
}
$output .= '</div>';


