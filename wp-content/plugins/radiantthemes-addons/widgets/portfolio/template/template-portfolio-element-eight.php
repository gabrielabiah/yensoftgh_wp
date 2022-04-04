<?php
/**
 * Template for Portfolio Style Eight
 *
 * @package RadiantThemes
 */

if ( $settings['radiant_portfolio_filter'] ) {

	$output = '<div class="rt-portfolio-box-filter element-eight  filter-style-' . esc_attr( $settings['radiant_portfolio_filter_style'] ) . ' text-' . esc_attr( $settings['radiant_portfolio_filter_alignment'] ) . ' ' . esc_attr( $hidden_filter ) . '">';
	// $output .= '<button class="matchHeight current-menu-item" data-filter="*"><span>' . esc_html__( 'All Groups', 'radiantthemes-addons' ) . '</span></button>';

	$taxonomy     = 'portfolio-category';
	$orderby      = 'name';
	$show_count   = 0;     // 1 for yes, 0 for no
	$pad_counts   = 0;     // 1 for yes, 0 for no
	$hierarchical = 1;     // 1 for yes, 0 for no
	$title        = '';
	$empty        = 1;
	$depth        = 1;

	$args = array(
		'taxonomy'     => $taxonomy,
		'orderby'      => $orderby,
		'show_count'   => $show_count,
		'pad_counts'   => $pad_counts,
		'hierarchical' => $hierarchical,
		'title_li'     => $title,
		'hide_empty'   => $empty,
		'include'      => $settings['radiant_portfolio_category'],
		'depth'        => $depth,
	);
	$cats = get_categories( $args );

	$counter = 1;
	foreach ( $cats as $cat ) {
		$term_id    = $cat->term_id;
		$ptype_name = $cat->name;
		$ptype_des  = $cat->description;
		$ptype_slug = $cat->slug;
		$term_link  = get_term_link( $cat );

		if ( 1 == $counter ) {
			$output .= '<button class="matchHeight current-menu-item" data-filter=".';
		} else {
			$output .= '<button class="matchHeight" data-filter=".';
		}

		$output .= $ptype_slug;
		$output .= '"><span>';
		$output .= $ptype_name;
		$output .= '</span></button>';
		$counter++;
	}

	$output .= '</div>';
	$output .= '<div class="rt-portfolio-box element-eight row isotope " data-portfolio-box-align="left">';

	// WP_Query arguments.
	global $wp_query;

	$radiant_portfolio_max_posts = ( $settings['radiant_portfolio_max_posts'] ? $settings['radiant_portfolio_max_posts'] : -1 );

	$args     = array(
		'post_type'      => 'portfolio',
		'posts_per_page' => esc_attr( $radiant_portfolio_max_posts ),
		'orderby'        => esc_attr( $settings['radiant_portfolio_looping_order'] ),
		'order'          => esc_attr( $settings['radiant_portfolio_looping_sort'] ),
	);
	$my_query = null;
	$my_query = new WP_Query( $args );
	if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) :
			$my_query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio-category' );

			// include file with color sanitization functions.
			if ( ! function_exists( 'sanitize_hex_color' ) ) {
				include_once ABSPATH . 'wp-includes/class-wp-customize-manager.php';
			}

			// fetch and sanitize the colors.
			$background_color = sanitize_hex_color( get_post_meta( get_the_id(), 'radiant_pc_primary_color', true ) );

			$output .= '<!-- rt-portfolio-box-item -->';
			if ( 'two' == $settings['radiant_portfolio_row_posts'] ) {
				$output .= '<div class="rt-portfolio-box-item col-lg-6 col-md-6 col-sm-6 col-xs-12 ';
			} elseif ( 'three' == $settings['radiant_portfolio_row_posts'] ) {
				$output .= '<div class="rt-portfolio-box-item col-lg-4 col-md-4 col-sm-6 col-xs-12 ';
			} elseif ( 'four' == $settings['radiant_portfolio_row_posts'] ) {
				$output .= '<div class="rt-portfolio-box-item col-lg-3 col-md-3 col-sm-6 col-xs-12 ';
			}
			if ( $terms ) {
				foreach ( $terms as $term ) {
					$output .= $term->slug . ' ';
				}
			}
			$output             .= '">';
			$output             .= '<div class="holder">';
				$output         .= '<div class="pic" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . ');"></div>';
				$output         .= '<div class="data">';
				$output         .= '<div class="overlay" style="background-color: ' . $background_color . ';"></div>';
					$output     .= '<div class="holder">';
						$output .= '<h4 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
						$output .= '<h5 class="categories">';
						$cats    = get_the_terms( get_the_ID(), 'portfolio-category' );
			foreach ( $cats as $cat ) {
				$term_id    = $cat->term_id;
				$ptype_name = $cat->name;
				$ptype_des  = $cat->description;
				$ptype_slug = $cat->slug;
				$term_link  = get_term_link( $cat );
				$output    .= '<span>';
				$output    .= $ptype_name;
				$output    .= '</span>';
			}
						$output .= '</h5>';

					$output .= '</div>';
				$output     .= '</div>';
				$output     .= '<div class="action-buttons">';
			if ( $settings['radiant_portfolio_add_link'] ) {
				$output .= '<a class="portfolio-link" href="' . get_the_permalink() . '"><i class="fa fa-link"></i></a>';
			}
			if ( $settings['radiant_portfolio_add_zoom'] ) {
				$output .= '<a class="portfolio-zoom fancybox" href="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '"><i class="fa fa-search"></i></a>';
			}
				$output .= '</div>';
			$output     .= '</div>';
			$output     .= '</div>';
			$output     .= '<!-- rt-portfolio-box-item -->';


		endwhile;
	}
	$output .= '</div>';

} else {
	$j = 0;
	$k = 1;
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
	$output  = '<!-- rt-portfolio-box -->';
	$output .= '<div class="rt-portfolio-box element-eight row isotope">';
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

			// include file with color sanitization functions.
			if ( ! function_exists( 'sanitize_hex_color' ) ) {
				include_once ABSPATH . 'wp-includes/class-wp-customize-manager.php';
			}

			// fetch and sanitize the colors.
			$background_color = sanitize_hex_color( get_post_meta( get_the_id(), 'radiant_pc_primary_color', true ) );

			$output .= '<!-- rt-portfolio-box-item -->';
			if ( 'two' == $settings['radiant_portfolio_row_posts'] ) {
				$output .= '<div class="rt-portfolio-box-item col-lg-6 col-md-6 col-sm-6 col-xs-12 ';
			} elseif ( 'three' == $settings['radiant_portfolio_row_posts'] ) {
				$output .= '<div class="rt-portfolio-box-item col-lg-4 col-md-4 col-sm-6 col-xs-12 ';
			} elseif ( 'four' == $settings['radiant_portfolio_row_posts'] ) {
				$output .= '<div class="rt-portfolio-box-item col-lg-3 col-md-3 col-sm-6 col-xs-12 ';
			}
			if ( $terms ) {
				foreach ( $terms as $term ) {
					$output .= $term->slug . ' ';
				}
			}
			$output             .= '">';
			$output             .= '<div class="holder">';
				$output         .= '<div class="pic" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . ');"></div>';
				$output         .= '<div class="data">';
				$output         .= '<div class="overlay" style="background-color: ' . $background_color . ';"></div>';
					$output     .= '<div class="holder" style="background-color: ' . $background_color . ';">';
						$output .= '<h4 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
						$output .= '<h5 class="categories">';
						$cats    = get_the_terms( get_the_ID(), 'portfolio-category' );
			foreach ( $cats as $cat ) {
				$term_id    = $cat->term_id;
				$ptype_name = $cat->name;
				$ptype_des  = $cat->description;
				$ptype_slug = $cat->slug;
				$term_link  = get_term_link( $cat );
				$output    .= '<span>';
				$output    .= $ptype_name;
				$output    .= '</span>';
			}
			$output .= '</h5>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="action-buttons">';
			if ( $settings['radiant_portfolio_add_link'] ) {
				$output .= '<a class="portfolio-link" href="' . get_the_permalink() . '"><i class="fa fa-link"></i></a>';
			}
			if ( $settings['radiant_portfolio_add_zoom'] ) {
				$output .= '<a class="portfolio-zoom fancybox" href="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '"><i class="fa fa-search"></i></a>';
			}
				$output .= '</div>';
			$output     .= '</div>';
			$output     .= '</div>';
		endwhile;
	}
	$output .= '</div>';
}
