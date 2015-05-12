<?php

/*
> custom-link

*/
class Custom_Markup_Shortcodes {

	/* -----------------------------------*/
	/* 		Custom_ling
	/* -----------------------------------*/
	public static function link( $atts, $content = null ) {
		extract( shortcode_atts( array(
					'link' => '#',
					'image' => '',
					'text'  => 'Test text',
					'target' => '_self',
				), $atts ) );

		$link = esc_url ( $link );
		$target = esc_attr( $target );
		return '<div class="list-wrapper js__items--single-item offset in-place">
			<article class="post type-post status-publish format-standard hentry category-ukategorisert list-item with-thumb" >
				<div data-background="' . $image . '" class="background" style="background-image: url(' . $image . ');"></div>
				<div class="background--color"></div>
				<header class="entry-header">		
					<h2 class="entry-title h3">
						<a href="' . $link . '" class="js__items--link">' . do_shortcode( $content ) . '</a>
					</h2>
				</header>
			</article><!-- #post-## -->
		</div>';
	}

} // End Class Pure_ML
