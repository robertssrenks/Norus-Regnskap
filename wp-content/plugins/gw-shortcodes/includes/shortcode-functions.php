<?php
/**
 * This file has all the main shortcode functions
 * @package Symple Shortcodes Plugin
 * @since 1.0
 * @author Goldenworks : http://goldenworks.eu
 * @copyright Copyright (c) 2013, Goldenworks
 * @link http://goldenworks.eu
 * @License: GNU General Public License version 2.0
 * @License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


add_filter('widget_text', 'do_shortcode');



/* Fix Shortcodes */
if( !function_exists('gw_fix_shortcodes') ) {
	function gw_fix_shortcodes($content){   
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'gw_fix_shortcodes');
}



/* Clear floats */
if( !function_exists('gw_clearboth') ) {
	function gw_clearboth() {
	   return '<div class="clearboth"></div>';
	}
	add_shortcode( 'clearboth', 'gw_clearboth' );
}



/* New row shortcode */
if( !function_exists('gw_new_row') ) {
	function gw_new_row( $atts, $content = null ) {
	   return '<div class="row">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('new_row', 'gw_new_row');
}



/* One half shortcode */
if( !function_exists('gw_one_half') ) {
	function gw_one_half( $atts, $content = null ) {
	   return '<div class="col-md-6">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'gw_one_half');
}



/* One third shortcode */
if( !function_exists('gw_one_third') ) {
	function gw_one_third( $atts, $content = null ) {
	   return '<div class="col-md-4">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'gw_one_third');
}


/* One fourth shortcode */
if( !function_exists('gw_one_fourth') ) {
	function gw_one_fourth( $atts, $content = null ) {
	   return '<div class="col-md-3">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'gw_one_fourth');
}


/* One fifth offset shortcode */
if( !function_exists('gw_one_fifth_offset') ) {
	function gw_one_fifth_offset( $atts, $content = null ) {
	   return '<div class="col-md-2 col-md-offset-1">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fifth_offset', 'gw_one_fifth_offset');
}


/* One fifth shortcode */
if( !function_exists('gw_one_fifth') ) {
	function gw_one_fifth( $atts, $content = null ) {
	   return '<div class="col-md-2">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fifth', 'gw_one_fifth');
}


/* One fourth shortcode */
if( !function_exists('gw_one_fourth') ) {
	function gw_one_fourth( $atts, $content = null ) {
	   return '<div class="col-md-3">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'gw_one_fourth');
}


/* Two third shortcode */
if( !function_exists('gw_two_third') ) {
	function gw_two_third( $atts, $content = null ) {
	   return '<div class="col-md-8">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'gw_two_third');
}


/* Three fourth shortcode */
if( !function_exists('gw_three_fourth') ) {
	function gw_three_fourth( $atts, $content = null ) {
	   return '<div class="col-md-9">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'gw_three_fourth');
}


/* Underlined header shortcode */
if( !function_exists('gw_hline') ) {
	function gw_hline( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'color'      => ''
		), $atts));
		
		$gw_color = '';
		
		if($color) {
			$gw_color = 'style="border-bottom:1px solid ' . $color . '"';	
		}
		
	   return '<div class="hline" ' . $gw_color . '>' . do_shortcode($content) . '</div>';
	}
	add_shortcode('hline', 'gw_hline');
}



/* Custom list shortcode */
if( !function_exists('gw_custom_list') ) {
	function gw_custom_list( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'indent'      => '',
			'align'		  => ''
		), $atts));	
		
		//indent
		if ($indent) { 
			$style = ' style="margin-left: '.$indent.';"'; 
		} else { 
			$style = ''; 
		}
		
		//right alignment
		if ($align == 'right') { 
			$gw_align = 'cl-right'; 
		} else { 
			$gw_align = ''; 
		}		
			
		$output ='';
		$output .= '<div class="custom-list ' . $gw_align . '" ' . $style . '><ul>' . do_shortcode($content) . '</ul></div><br />';
		
		return $output;
		
	}
	add_shortcode('custom_list', 'gw_custom_list');
}



/* list item shortcode */
if( !function_exists('gw_list_item') ) {
	function gw_list_item( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'icon'            => '',
			'align'	     	  => '',
			'iconcolor'	      => ''
			
		), $atts));	
			
		$output ='';
		
		$gw_iconcolor = '';
		
		if($iconcolor) {
			$gw_iconcolor = ' style="color:' . $iconcolor . ';"';
		}
		
		
		if($align == 'right') {
			$output .= '<li>' . do_shortcode($content) . '<i class="' . $icon . '"></i></li>';
		} else {
			$output .= '<li><i class="' . $icon . '" ' . $gw_iconcolor . '></i>' . do_shortcode($content) . '</li>';	
		}
		
		return $output;
	}
	add_shortcode('list_item', 'gw_list_item');
}


/* Smallbox shortcode */
if( !function_exists('gw_smallbox') ) {
	function gw_smallbox( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'color'      => '',
			'background'      => ''
		), $atts));
		
	
		if($background) {
			$gw_background = 'background:' . $background . ';';
		}
		if($color) {
			$gw_color = 'color:' . $color . ';';
		}		
				
		return '<div class="smallbox" style="' . $gw_background . $gw_color . '">' . do_shortcode($content) . '</div>';
		
	}
	add_shortcode('smallbox', 'gw_smallbox');
}


/* Normalbox shortcode */
if( !function_exists('gw_normalbox') ) {
	function gw_normalbox( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'color'      => '',
			'background'      => ''
		), $atts));
		
		$gw_background = '';
		$gw_color = '';
				
		if($background) {
			$gw_background = 'background:' . $background . ';';
		}
		if($color) {
			$gw_color = 'color:' . $color . ';';
		}		
				
		return '<div class="normalbox" style="' . $gw_background . $gw_color . '">' . do_shortcode($content) . '</div>';
		
	}
	add_shortcode('normalbox', 'gw_normalbox');
}



/* Iconbox shortcode */
if( !function_exists('gw_iconbox') ) {
	function gw_iconbox( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'color'  		    => '',
			'background'      	=> '',
			'icon'				=> ''
		), $atts));
		
		$gw_background = '';
		$gw_color = '';		
		$gw_icon = '';
				
		if($background) {
			$gw_background = 'background:' . $background . ';';
		}
		if($color) {
			$gw_color = 'color:' . $color . ';';
		}
		if($icon) {
			$gw_icon = '<i class="' . $icon . ' ibox"></i>';
		}				
				
		return '<div class="iconbox" style="' . $gw_background . $gw_color . '">' . $gw_icon  . do_shortcode($content) . '</div>';
		
	}
	add_shortcode('iconbox', 'gw_iconbox');
}




/* Iconbox shortcode */
if( !function_exists('gw_iconblock') ) {
	function gw_iconblock( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'color'  		    => '',
			'icon'				=> '',
			'title'				=> '',
			'url'				=> ''
		), $atts));
		
		$gw_background = '';
		$gw_color = '';		
		$gw_icon = '';
		
		if($color) {
			$gw_background = 'style="background:' . $color . ';"';
			$gw_color = 'style="color:' . $color . ';"';			
		}
		if($icon) {
			$gw_icon = '<i class="' . $icon . ' iblock"></i>';
		}			

		
		$output = '<div class="iconblock" ' . $gw_background . '>';
			
			if($url) {
				$output .= '<div class="ib-icon"><a href="' . $url . '" ' . $gw_color . '>' . $gw_icon . '</a></div>';
			}
			else {
				$output .= '<div class="ib-icon" ' . $gw_color . '>' . $gw_icon . '</div>';
			}
			
			if($title) {
				
				if($url) {
					$output .= '<h5 class="ib-title"><a href="' . $url . '">' . $title . '</a></h5>'; 
				} else {
					$output .= '<h5 class="ib-title ibt">' . $title . '</h5>'; 					
				}
				
			}
		
		$output .= '</div>';
		
		return $output;		
		
	}
	add_shortcode('iconblock', 'gw_iconblock');
}





/* Title line shortcode */
if( !function_exists('gw_titleline') ) {
	function gw_titleline( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'title'      => ''
		), $atts));
			
		return '<div class="title-line-wrapper"><div class="title-line">' . $title . '</div></div><div class="clearboth"></div>';
		
	}
	add_shortcode('titleline', 'gw_titleline');
}




/* Hand drawn icon service block shortcode */
if( !function_exists('gw_iservice') ) {
	function gw_iservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'title'     => '',
			'icon'      => ''		
		), $atts));

		$output = '<div class="iservice-block">';
		
			/* if icon exists */		
			if ( $icon ) { 
				$output .= '<img src="' . $icon . '" alt="' . $title . '" class="isb-img">'; 
			}
	
			$output .= '<div class="isb-content">';
				
				/* if title exists */
				if ( $title ) { 
					$output .= '<h5>' . $title . '</h5>'; 
				}
				
				$output .= do_shortcode($content);
				
			$output .= '</div>';	
			
		$output .= '</div>';				
		
		return $output;
		
		
	}
	add_shortcode('iservice', 'gw_iservice');
}


/* Center aligned big icons service block shortcode */
if( !function_exists('gw_biservice') ) {
	function gw_biservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'icon'      => '',
			'url'		=> '',
			'color'		=> ''
		), $atts));


		$gw_color = '';
		$gw_skincolor = '';
		
		if($color) {
			if($color == 'skin') {
				$gw_skincolor = ' skin-color';
			} else {
				$gw_color = 'style="color:' . $color . '"';					
			}
		}


		$output = '<div class="biservice-block">';
		
			/* if icon exists */		
			if ( $icon ) {
				
				if( $url ) {
					$output .= '<div class="bis-icon"><a href="' . $url . '" class="' . $gw_skincolor . '"><i class="fa ' . $icon . '" ' . $gw_color . '></i></a></div>';
				} else {
					$output .= '<div class="bis-icon ' . $gw_skincolor . '"><i class="fa ' . $icon . '" ' . $gw_color . '></i></div>';	
				}
				
			}
	
			$output .= '<div class="biservice-content">';

				$output .= do_shortcode($content);
				
			$output .= '</div>';	
			
		$output .= '</div>';				
		
		return $output;
		
		
	}
	add_shortcode('biservice', 'gw_biservice');
}


/* Left aligned normal icons service block shortcode */
if( !function_exists('gw_liservice') ) {
	function gw_liservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'icon'      	=> '',
			'iconcolor'		=> ''
		), $atts));


		$gw_iconcolor = '';
		
		if($iconcolor) {
			$gw_iconcolor = ' style="color:' . $iconcolor . ';"';
		}
		
		
		$output = '';
		
		$output = '<div class="liservice-block">';
		
			/* if icon exists */		
			if ( $icon ) { 
				$output .= '<div class="lis-icon"><i class="' . $icon . '" ' . $gw_iconcolor . '></i></div>';
			}
	
			$output .= '<div class="liservice-content">';

				$output .= do_shortcode($content);
				
			$output .= '</div>';	
			
		$output .= '</div>';				
		
		return $output;
		
		
	}
	add_shortcode('liservice', 'gw_liservice');
}



/* Left aligned normal icons (minimalistic)service block shortcode */
if( !function_exists('gw_ilservice') ) {
	function gw_ilservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'icon'      	=> '',
			'iconcolor'		=> ''
					
		), $atts));

		
		$gw_iconcolor = '';
		
		if($iconcolor) {
			$gw_iconcolor = ' style="color:' . $iconcolor . ';"';
		}
		
		$output = '';
		
		$output = '<div class="ilservice-block">';
		
			/* if icon exists */		
			if ( $icon ) { 
				$output .= '<div class="ils-icon"><i class="' . $icon . '" ' . $gw_iconcolor . '></i></div>';
			}
	
			$output .= '<div class="ilservice-content">';

				$output .= do_shortcode($content);
				
			$output .= '</div>';	
			
		$output .= '</div>';				
		
		return $output;
		
		
	}
	add_shortcode('ilservice', 'gw_ilservice');
}



/*  service block shortcode */
if( !function_exists('gw_siservice') ) {
	function gw_siservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'icon'      	=> '',
			'width'			=> '',
			'height'		=> '',
			'color'		=> '',
			'borderbottom'	=> '',
			'borderleft'	=> ''
		), $atts));

		
		$gw_width = '';
		$gw_height = '';
		$gw_iconcolor = '';
		$gw_borderleft = '';
		$gw_borderbottom = '';
				

		if($width) { $gw_width = 'style="width:' . $width . ';" '; }
		if($height) { $gw_height = 'style="height:' . $height . ';" '; }		
		if($borderbottom == 'false') { $gw_borderbottom = " no-bottom-border"; }
		if($borderleft == 'false') { $gw_borderleft = " no-left-border"; }
		if($color) { $gw_color = ' style="border:2px solid ' . $color . '; color:' . $color . ';"'; }
		
		
		$output = '';
		
		$output = '<div class="siservice-block ' . $gw_borderleft . '" ' . $gw_width . '>';
		
			
			/* if icon exists */		
			if ( $icon ) { 
				$output .= '<div class="sis-icon" ' . $gw_color . '><i class="' . $icon . '"></i></div>';
			}
			
			
			$output .= '<div class="siservice-content" ' . $gw_height . '>';

				$output .= do_shortcode($content);
				
			$output .= '</div>';
			
		
			$output .= '<div class="siservice-bottom-line ' . $gw_borderbottom . '"></div>';
				
		$output .= '</div>';
		
		return $output;
		
	}
	add_shortcode('siservice', 'gw_siservice');
}



/* Rectangular icon service shortcode */
if( !function_exists('gw_riservice') ) {
	function gw_riservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'title'     			=> '',
			'icon'      			=> '',
			'icon_color'			=> '',
			'icon_background'		=> '',
			'text_color'			=> ''		
		), $atts));


		$gw_text_color = '';
		$gw_icon_color = '';
		$gw_icon_background = '';
		
		if($text_color) { $gw_text_color = 'color:' . $text_color . ';'; }
		if($icon_color) { $gw_icon_color = 'color:' . $icon_color . ';'; }
		if($icon_background) { $gw_icon_background = 'background:' . $icon_background . ';'; }		

		$output = '';
		$output .= '<div class="riservice-block" style="' . $gw_text_color . '">';
		
			/* if icon exists */		
			if ( $icon ) {
				$output .= '<div class="ris-icon" style=" ' . $gw_icon_color . $gw_icon_background . '"><i class="' . $icon . '"></i></div>'; 
			}
	
			$output .= '<div class="ris-content">';
				
				/* if title exists */
				if ( $title ) { 
					$output .= '<h3>' . $title . '</h3>'; 
				}
				
				$output .= do_shortcode($content);
				
			$output .= '</div>';	
			
		$output .= '</div><div class="clearboth"></div>';				
		
		return $output;
		
		
	}
	add_shortcode('riservice', 'gw_riservice');
}







/* Rectangular icon service shortcode */
if( !function_exists('gw_smartservice') ) {
	function gw_smartservice( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'title'     			=> '',
			'icon'      			=> '',
			'icon_color'			=> '',
			'icon_background'		=> '',
			'text_color'			=> '',
			'height'				=> '',
			'background'			=> ''		
		), $atts));
		
		
		$gw_text_color = '';
		$gw_icon_color = '';
		$gw_icon_background = '';
		$gw_background = '';
		$gw_height = '';
		
		if($text_color) { $gw_text_color = 'color:' . $text_color . ';'; }
		if($icon_color) { $gw_icon_color = 'color:' . $icon_color . ';'; }
		if($icon_background) { $gw_icon_background = 'background:' . $icon_background . ';'; }	
		if($background) { $gw_background = 'background:' . $background . ';'; }
		if($height) { $gw_height = 'height:' . $height . ';'; }
				
		
		$output = '';
		$output .= '<div class="smartservice-block" style="' . $gw_text_color . $gw_background . $gw_height . '">';
		
		/* if icon exists */		
		if ( $icon ) {
			$output .= '<div class="smartservice-icon" style=" ' . $gw_icon_color . $gw_icon_background . '"><i class="' . $icon . '"></i></div>'; 
		}
		
			$output .= '<div class="smartservice-content">';
			
				/* if title exists */
				if ( $title ) { 
					$output .= '<h4>' . $title . '</h4>'; 
				}			
			
				$output .= do_shortcode($content);
			$output .= '</div>';
			
					
		$output .= '</div>';
		
		return $output;
		
		
	}
	add_shortcode('smartservice', 'gw_smartservice');
}






		

/* Modal lightbox shortcode */
if( !function_exists('gw_modal_lightbox') ) {
	function gw_modal_lightbox( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'title'     => '',
			'id'      	=> '',
			'effect'	=> '',
			'text'		=> '',
			'ctext'		=> '',
			'icon'		=> '',
			'border'	=> ''
		), $atts));		
		
		//wp_enqueue_style( 'modalc' );
		wp_enqueue_script('classie-js');
		wp_enqueue_script('modalEffects-js');
		
		/* start border case */
		if(!$border) {
			$border = 'false';	
		}
		
		$border_output = '';
		if($border == 'true') {
			$border_output = 'md-border';	
		}		
		/* end border case */		
		
		
		/* start icon case */
		if(!$icon) {
			$icon = 'true';	
		}
		
		$icon_output = '';
		
		if($icon == 'true') {
			$icon_output = '<span>&#xf08e;</span>';	
		}
		/* end icon case */
		
		/* start text case */				
		if(!$text) {
			$text = __('more popup', 'framework');	
		}
				
		if(!$ctext) {
			$ctext = __('Close window', 'framework');	
		}
		/* end text case */
		
				
		/*if the effect is not defined, we are using effect number 9 as default */	
		if(!$effect) {
			$effect = 9; 
		}		
		
		$output = '<button class="md-trigger ' . $border_output . '" data-modal="' . $id . '">' . $icon_output . $text . '</button>';

		$output .= '<div class="md-modal md-effect-'.$effect.'" id="' . $id . '">';
			
			$output .= '<div class="md-content">';
				
				if($title) { $output .= '<h3>' . $title . '</h3>'; }
				
				$output .= '<div>' . do_shortcode($content) . '<button class="md-close">' . $ctext . '</button></div>';
		
			$output .= '</div>';
		
		$output .= '</div>';
	
		return $output;
		
	}
	add_shortcode('modal_lightbox', 'gw_modal_lightbox');
}




/* Button shortcode */
if( !function_exists('gw_button') ) {
	function gw_button( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'url'      => '',
			'color'	   => '',
			'title'	   => '',
			'target'   => '',
			'icon'	   => '',
			'shadow'   => ''
		), $atts));	
		
		$gw_title = '';
		$gw_target = '';
		$gw_icon = '';
		
		
		if(!$color) { $color = 'skin'; }
		
		if($title) { $gw_title = 'title="'. $title . '"'; }
		
		if($target == 'blank') { $gw_target = ' target="_blank"'; }
		
		if($icon) { $gw_icon = '<i class="' . $icon . '"></i>'; }
		
		if($shadow == 'true') {
			$output = '<a href="' . $url . '" class="gw-btn gwb-' . $color . '" ' . $gw_title . $gw_target . '>' . do_shortcode($content) . $gw_icon . '</a>';						
		} else {
			$output = '<a href="' . $url . '" class="gw-btn gwb-' . $color . ' gwb-noshadow" ' . $gw_title . $gw_target . '>' . do_shortcode($content) . $gw_icon . '</a>';			
		}

		return $output;
				
	}
	add_shortcode('button', 'gw_button');
}		
		


	
/* Intro shortcode */
if( !function_exists('gw_intro') ) {
	function gw_intro( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'textalign'      => '',
			'textcolor'		 => ''
		), $atts));
		
		$gw_textalign = '';
		$gw_textcolor = '';
		
		if($textalign == 'left') { $gw_textalign = ' gw-alignleft'; }
		if($textalign == 'right') { $gw_textalign = ' gw-alignright'; }
		if($textalign == 'center') { $gw_textalign = ' gw-aligncenter'; }
		
		if($textcolor) {
			$gw_textcolor = 'style = "color:' . $textcolor . ';"';
		}
		
		$output = '<span class="intro ' . $gw_textalign . '" ' . $gw_textcolor . '>' . do_shortcode($content) . '</span><div class="clearboth"></div>';
		
		return $output;
		
	}
	add_shortcode('intro', 'gw_intro');
}	
		


/* Spacing shortcode */
if( !function_exists('gw_spacing') ) {
	function gw_spacing( $atts ) {
		extract( shortcode_atts( array(
			'size'	=> '20px',
			'class'	=> '',
		  ),
		  $atts ) );
		  
	 	return '<hr class="gw-spacing clearboth '. $class .'" style="height: '. $size .'" />';
	 
	}
	add_shortcode( 'spacing', 'gw_spacing' );
}



/* Divider shortcode */
if( !function_exists('gw_divider') ) {
	function gw_divider( $atts ) {
	 	return '<hr class="gw-divider clearboth" />';
	}
	add_shortcode( 'divider', 'gw_divider' );
}



/* pullquote left shortcode */
if( !function_exists('gw_pullquote_left') ) {
	function gw_pullquote_left( $atts, $content = null ) {
	   return '<span class="pullquote-left">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('pullquote_left', 'gw_pullquote_left');
}



/* pullquote right shortcode */
if( !function_exists('gw_pullquote_right') ) {
	function gw_pullquote_right( $atts, $content = null ) {
	   return '<span class="pullquote-right">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('pullquote_right', 'gw_pullquote_right');
}


/* dropcap shortcode */
if( !function_exists('gw_dropcap') ) {
	function gw_dropcap( $atts, $content = null ) {
	   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('dropcap', 'gw_dropcap');
}


/* highlighted text shortcode */
if( !function_exists('gw_highlight') ) {
	function gw_highlight( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color'			=> '',
			'background'	=> '',
		  ),
		  $atts ) );
		  
		  $gw_color = '';
		  $gw_background = '';
		  
		  if($color) { $gw_color = 'color:' . $color . ';'; }
		  if($background) { $gw_background = 'background:' . $background . ';'; }		  
		  		  		  
		
	   return '<span class="gw-highlight" style="' . $gw_color . $gw_background . '">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('highlight', 'gw_highlight');
}


/* social media icon wrapper shortcode */
if( !function_exists('gw_socialmedia') ) {
	function gw_socialmedia( $atts, $content = null ) {
		  
	   return '<ul class="sm-icons">' . do_shortcode($content) . '</ul>';
	 
	}
	add_shortcode( 'socialmedia', 'gw_socialmedia' );
}



/* social media icon shortcode */
if( !function_exists('gw_socialmedia_icon') ) {
	function gw_socialmedia_icon( $atts ) {
		extract( shortcode_atts( array(
			'title'					=> '',
			'tooltip_position'		=> '',
			'url'					=> '',
			'icon'					=> ''
		  ),
		  $atts ) );
		  
		  
		if(!$tooltip_position) {
			$tooltip_position = 'top';			   
		}
		
		$output = '<li><a href="' . $url . '" data-toggle="tooltip" title="' . $title . '" data-placement="' . $tooltip_position . '"><img src="' . $icon . '" alt="' . $title . '" /></a></li>';
		
		return $output;
	 
	}
	add_shortcode( 'socialmedia_icon', 'gw_socialmedia_icon' );
}



/* border list wrapper shortcode */
if( !function_exists('gw_borderlist') ) {
	function gw_borderlist( $atts, $content = null ) {
		  
	   return '<ul class="border-list">' . do_shortcode($content) . '</ul>';
	 
	}
	add_shortcode( 'borderlist', 'gw_borderlist' );
}


/* border list item shortcode */
if( !function_exists('gw_borderlist_item') ) {
	function gw_borderlist_item( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'					=> '',
			'url'					=> ''
		  ),
		  $atts ) );		
		  
		$output = '<li><a href="' . $url . '">' . $title . '</a></li>';
	 
		return $output;
			 
	}
	add_shortcode( 'borderlist_item', 'gw_borderlist_item' );
}


/* call to action shortcode */
if( !function_exists('gw_cta') ) {
	function gw_cta( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'background'			=> '',
			'border'				=> '',
			'left_border'			=> '',
			'color'					=> '',
			'padding'				=> ''
		  ),
		  $atts ) );	
		  
		  
		  $gw_border = '';
		  $gw_background = '';
		  $gw_left_border = '';	
		  $gw_color = '';  
		  $gw_padding = '';
		  		  
		  if($border) { 
		  	  $gw_border = 'border:1px solid '.$border.';'; 
		  }
		  if($background) { 
		  	  $gw_background = 'background:'.$background.';'; 
		  }
		  if($left_border) { 
		  	  $gw_left_border = 'border-left:5px solid '.$left_border.' !important;'; 
		  }
		  if($padding) { 
		  	  $gw_padding = 'padding:'.$padding.';'; 
		  }
		  		  
		  
		  $output = '<div class="clearboth"></div><section class="cta" style="' . $gw_border . $gw_background . $gw_left_border . $gw_padding . '">' . do_shortcode($content) . '</section>';
	 
		return $output;
			 
	}
	add_shortcode( 'cta', 'gw_cta' );
}



/* colored text shortcode */
if( !function_exists('gw_textcolor') ) {
	function gw_textcolor( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color'					=> ''
		  ),
		  $atts ) );		
		  
		  $gw_color = '';
		  $gw_skincolor = '';
		  		  
		  
		  if(($color) && ($color != 'skin')) { 
		  	  $gw_color = ' style="color:'. $color .' "';
		  }
		  
		  if($color == 'skin') { 
		  	  $gw_skincolor = ' class="skin-color"';
		  }		  
		  
		  $output = '<span ' . $gw_skincolor . $gw_color .'>' . do_shortcode($content) . '</span>';
	 
		return $output;
			 
	}
	add_shortcode( 'textcolor', 'gw_textcolor' );
}



/* toggle content shortcode */
if( !function_exists('gw_toggle_content') ) {
	function gw_toggle_content( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'      => '',
		), $atts));
		
		wp_enqueue_script('gw_toggle');		
		
		$output = '';
		$output .= '<h5 class="toggle"><a href="#">' .$title. '</a></h5>';
		$output .= '<div class="toggle-content">';
			$output .= '<div class="block">';
			$output .= do_shortcode($content);
			$output .= '</div>';
		$output .= '</div><div class="clearboth"></div>';
		
	   return $output;
	}
	add_shortcode('toggle', 'gw_toggle_content');
}



/* accordion shortcode */
if( !function_exists('gw_accordion') ) {
	function gw_accordion( $atts, $content = null  ) {
		
		// Enqueue scripts
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('gw_accordion');
		
		// Display accordion	
		return '<div class="gw-accordion">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'accordion', 'gw_accordion' );
}



/* accordion section */
if( !function_exists('gw_accordion_section') ) {
function gw_accordion_section( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'title' => 'Title'
	), $atts ) );
	  
   		return '<h5 class="gw-accordion-title"><a href="#">'. $title .'</a></h5><div>' . do_shortcode($content) . '</div>';
	}

	add_shortcode( 'accordion_section', 'gw_accordion_section' );
}



/* tabs shortcode */
if( !function_exists('gw_tabgroup') ) {
	function gw_tabgroup( $atts, $content = null ) {
		
		//Enque scripts
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('gw_tabs');
		
		// Display Tabs
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		//preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		preg_match_all( '/tab title="([^\"]+)" icon="([^\"]+)"/i' , $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }	// tab name 1, tab name 2
		
		$tab_icons = array();
		if( isset($matches[2]) ){ $tab_icons = $matches[2]; }	// tab icon 1, tab icon 2		
		

		$output = '';		

		if( count($tab_titles) ){
			$output .= '<div id="gw-tab-'. rand(1, 100) .'" class="gw-tabs">';
			$output .= '<ul class="ui-tabs-nav">'; 
			
			foreach( $tab_titles as $key => $tab ){

				$the_tab = $tab_titles[$key];
				$the_icon = $tab_icons[$key];			
				
				$output .= '<li><a href="#gw-tab-'. sanitize_title( $tab[0] ) .'"><i class="'  . $the_icon[0] . '"></i>' . $the_tab[0] . '</a></li>';

			}
			$output .= '</ul>';
			$output .= do_shortcode( $content );
			$output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		return $output;
	}
	add_shortcode( 'tabgroup', 'gw_tabgroup' );
}


/* tab item shortcode */
if( !function_exists('gw_tab') ) {
	function gw_tab( $atts, $content = null ) {
		$defaults = array(
			'title' 	=> 'Tab',
			'class' 	=> '',
			'icon'		=> ''
		);
	
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div class="clearboth"></div><div id="gw-tab-'. sanitize_title( $title ) .'" class="tab-content '. $class .'">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'tab', 'gw_tab' );
}



/* teaser shortcode */
if( !function_exists('gw_teaser') ) {
	function gw_teaser( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'      => '',
			'image'      => '',
			'icon'		 => '',
			'url'		 => ''	
		), $atts));
		
		
		$gw_icon = '';
		if($icon) {
			$gw_icon = '<i class="' . $icon . '"></i>';	
		}
		
		
		$output = '';
				
		$output .= '<div class="teaser-block">';
		
		if($image) {
			$output .= '<img src="' . $image . '" alt="' . $title . '" class="teaser-img">';
		}
		if($title) {
			if($url) {
				$output .= '<h5 class="teaser-title"><a href="' . $url . '">' . $title . $gw_icon . '</a></h5>';
			} else {
				$output .= '<h5 class="teaser-title teaser-nolink">' . $title . $gw_icon . '</h5>';
			}
		}		
		
		$output .= '</div>';		
		
		return $output;		
	}
	add_shortcode( 'teaser', 'gw_teaser' );
}



/* header shortcode */
if( !function_exists('gw_header') ) {
	function gw_header( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'    	     => '',
			'image'     	 => '',
			'color'			 => '',
			'margin_left'	 => ''
		), $atts));
		
		
		$gw_color = '';
		if($color) { 
			$gw_color = 'style="color:' . $color . ';"'; 
		}
		
		$gw_margin_left = '';
		if($margin_left) { 
			$gw_margin_left = 'style="padding-left:' . $margin_left . ';"'; 
		}		
		
		$output = '<div class="header-section" ' . $gw_color . '>';
		
			$output .= '<div class="hs-content" ' . $gw_margin_left . '>' . do_shortcode( $content ) . '</div>';
			
			if($image) {
				$output .= '<img src="' . $image . '" alt="' . $title . '" class="header-img" />';	
			}

		$output .= '</div><div class="clearboth"></div>';	
		
		return $output;		
	}
	add_shortcode( 'header', 'gw_header' );
}



/* percent block shortcode */
if( !function_exists('gw_percentblock') ) {
	function gw_percentblock( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'width'      => '50%'
		), $atts));		  
		
	   return '<div class="percent-block" style="width:' . $width . '">' . do_shortcode($content) . '</div>';
	 
	}
	add_shortcode( 'percentblock', 'gw_percentblock' );
}



/* process box shortcode */
if( !function_exists('gw_processbox') ) {
	function gw_processbox( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'icon'      	=> '',
			'title'      	=> '',
			'url'			=> '',
			'arrow'			=> ''			
		), $atts));		  
		
		$output = '';
		
		$gw_icon = '';
		$gw_title = '';	
		$gw_arrow = '';
					
		if($icon) {
			$gw_icon = '<div class="pb-icon"><i class="' . $icon . '"></i></div>';	
		}
		
		if($title) {
			if($url) {
				$gw_title = '<h4><a href="' . $url . '">' . $title . '</a></h4>';
			} else {
				$gw_title = '<h4>' . $title . '</h4>';				
			}
		}
		
		if($arrow == 'true') {
			$gw_arrow = '<div class="pb-arrow"></div>';	
		}	
		
		$output .= '<div class="processbox">' . $gw_icon . $gw_title . do_shortcode($content) . '</div>' . $gw_arrow . '';	
	   
		return $output;		   
	 
	}
	add_shortcode( 'processbox', 'gw_processbox' );
}




/* process service shortcode */
if( !function_exists('gw_process_service') ) {
	function gw_process_service( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'icon'      	=> '',
			'number'      	=> '',
			'color'      	=> ''					
		), $atts));		  
		
		
		$gw_icon = '';
		$gw_number = '';		
		$gw_color_border = '';	
		$gw_color_background = '';			

		if($color) {
			$gw_color_border = 'style="border:1px solid ' . $color . '"';
			$gw_color_background = 'style="background:' . $color . '"';
			$gw_color_icon = 'style="color:' . $color . '"';						
		}
		if($number) {
			$gw_number = '<div class="sp-number" ' . $gw_color_background . '>' . $number . '</div>';	
		}
				

		$output = '';
				
		$output .= '<div class="process-service">';
			if($icon) { 
				$output .= '<div class="sp-icon" ' . $gw_color_border . '><i class="' . $icon . '" ' . $gw_color_icon . '></i>' . $gw_number . '</div>'; 
			}
			$output .= '<div class="process-content">';
				$output .= do_shortcode($content);			
			$output .= '</div>';
			
		$output .= '</div>';
	   
		return $output;		   
	 
	}
	add_shortcode( 'process_service', 'gw_process_service' );
}



/* testimonial slider shortcode */
if( !function_exists('gw_testimonial_slider') ) {
	function gw_testimonial_slider( $atts, $content = null ) {  
	
		wp_enqueue_script('gw_testimonial_call');
		//wp_enqueue_style('flexsliderc');		
				
		$output = '';
		
		$output = '<div class="testimonial-slider">';
			$output .= '<div class="flexslider">';
				$output .= '<ul class="slides">';				
				
					$output .= do_shortcode($content);
		
				$output .= '</ul>';			
			$output .= '</div>'; /* end of .flexslider */
		$output .= '</div>'; /* end of .slides */
		
		return $output;	
	 
	}
	add_shortcode( 'testimonial_slider', 'gw_testimonial_slider' );
}



/* testimonial slide item shortcode */
if( !function_exists('gw_tslide') ) {
	function gw_tslide( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image'     	 => '',
			'name'   	     => '',
			'position'       => ''					
		), $atts));		  		
		
		/* if no image is defined we apply a css fix class */
		$misc_fix = '';
		
		if(!$image) {
			$misc_fix = 'tmisc-fix"';	
		}
		
		$output = '';
		
		$output = '<li>';
			
			$output .= '<div class="testimonial-block">';
				
				$output .= do_shortcode($content);
				
				
				$output .= '<div class="testimonial-details">';				
						
					if($image) { $output .= '<img src="' . $image . '" alt="' . $name . '" class="testimonial-img" />'; }
					
					$output .= '<div class="testimonial-misc ' . $misc_fix . '">';
					
						if($name) { $output .= '<span class="tname">' . $name . '</span>'; }
						
						if($position) { $output .= '<span class="tposition">' . $position . '</span>'; }
											
					$output .= '</div>'; /* end of .testimonial-misc */
					
				$output .= '</div>'; /* end of .testimonial-details */
				
				
			
			$output .= '</div>'; /* end of .testimonial-block */			
											
		$output .= '</li>';						
		
		
		return $output;	
	 
	}
	add_shortcode( 'tslide', 'gw_tslide' );
}



/* testimonial section shortcode */
if( !function_exists('gw_testimonial_section') ) {
	function gw_testimonial_section( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image'     	 => '',
			'name'   	     => '',
			'position'       => ''					
		), $atts));		  		
		
		/* if no image is defined we apply a css fix class */
		$misc_fix = '';
		
		if(!$image) {
			$misc_fix = 'tmisc-fix';	
		}
		
		$output = '';
		
			
			$output = '<div class="testimonial-section">';
				
				$output .= do_shortcode($content);
				
				
				$output .= '<div class="testimonial-details">';				
						
					if($image) { $output .= '<img src="' . $image . '" alt="' . $name . '" class="testimonial-img" />'; }
					
					$output .= '<div class="testimonial-misc ' . $misc_fix . '">';
					
						if($name) { $output .= '<span class="tname">' . $name . '</span>'; }
						
						if($position) { $output .= '<span class="tposition">' . $position . '</span>'; }
											
					$output .= '</div>'; /* end of .testimonial-misc */
					
				$output .= '</div>'; /* end of .testimonial-details */
				
				
			
			$output .= '</div>'; /* end of .testimonial-section */			
																

		return $output;	
	 
	}
	add_shortcode( 'testimonial_section', 'gw_testimonial_section' );
}



/* content slider shortcode */
if( !function_exists('gw_content_slider') ) {
	function gw_content_slider( $atts, $content = null ) {  
		extract(shortcode_atts(array(
			'width'     	 => ''				
		), $atts));	
		
		
		$gw_width = '';
		if($width) {
			$gw_width = ' style="width:' . $width . ';"';	
		}			
	
		wp_enqueue_script('gw_contentslider_call');
		//wp_enqueue_style('flexsliderc');		
				
		$output = '';
		
		$output = '<div class="content-slider" ' . $gw_width . '>';
			$output .= '<div class="flexslider">';
				$output .= '<ul class="slides">';				
				
					$output .= do_shortcode($content);
		
				$output .= '</ul>';			
			$output .= '</div>'; /* end of .flexslider */
		$output .= '</div>'; /* end of .slides */
		
		return $output;	
	 
	}
	add_shortcode( 'content_slider', 'gw_content_slider' );
}



/* content slide item shortcode */
if( !function_exists('gw_cslide') ) {
	function gw_cslide( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image'     	 => '',
			'title'   	     => ''				
		), $atts));		  		
		
		
		$output = '';
		
		$output = '<li>';
			
			$output .= '<div class="contentslider-block">';
				
				if($image) { $output .= '<img src="' . $image . '" alt="' . $title . '" />'; }
				
			$output .= '</div>'; /* end of .contentslider-block */			
											
		$output .= '</li>';						
		
		
		return $output;	
	 
	}
	add_shortcode( 'cslide', 'gw_cslide' );
}



/* pricing table shortcode */
if( !function_exists('gw_pricing_table') ) {
	function gw_pricing_table( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'coin' 	    			=> '$',
			'featured'				=> '',
			'featured_text'			=> '',			
			'plan'					=> '',
			'cost'					=> '',
			'per'					=> '',
			'button_url'			=> '',
			'button_text'			=> '',
			'button_target'			=> '',
			'width'					=> '',
			'height'				=> '',			
			'class'					=> '',
			'border_right'			=> '',
			'border_left'			=> '',
			'top_margin'			=> '',
			'color'					=> ''	
		), $atts));		  		
		
		
		$gw_width = '';
		
		$gw_height = '';
		
		$gw_top_margin = '';				
		
		$gw_target = '';
		
		$gw_border_left = '';	
			
		$gw_border_right = '';
		
		$featured_class = '';
		
		$gw_color = '';
		
		if($width) { $gw_width = 'width:' . $width . ';'; }
		if($height) { $gw_height = 'height:' . $height . ';'; }		
		if($top_margin) { $gw_top_margin = 'margin-top:' . $top_margin . ';'; }
		
		if($button_target == 'blank') { $gw_target = ' target="_blank"'; }
		
		if($featured == 'true') {
			$featured_class = ' pt-featured';
		}
		if($border_right == 'false') {
			$gw_border_right = ' no-border-right';
		}
		if($border_left == 'false') {
			$gw_border_left = ' no-border-left';
		}		
		if($color) {
			$gw_color = 'style="background:' . $color . ';"';
		}			
		
		$output = '';
		
		$output = '<div class="pricing-table ' . $featured_class . ' ' . $gw_border_right . ' ' . $gw_border_left . '" style="' . $gw_width . $gw_height . $gw_top_margin . '">';

			/* pricing table plan */		
			if($featured == 'true') { 
				$output .= '<div class="pt-plan" '.$gw_color.'><h4>'. $plan .'</h4><span class="pt-featured-text">'. $featured_text . '</span></div>'; 
			} else {
				if($plan) { $output .= '<div class="pt-plan" '.$gw_color.'><h4>'. $plan . '</h4></div>'; }
			}
			
			
			/* pricing table cost */
			$output .= '<div class="pt-cost-wrapper">';
			
				if($coin) { $output .= '<span class="pt-coin">' . $coin . '</span>'; }
				
				if($cost) { $output .= '<span class="pt-cost">' . $cost . '</span>'; }
				
				$output .= '<div class="clearboth"></div>'; 

				if($per) { $output .= '<span class="pt-per">' . $per . '</span>'; }

			$output .= '</div>';	
					
			
			/* pricing table content */
			$output .= '<div class="pt-content">';
			
				$output .= do_shortcode($content);
			
			$output .= '</div>';
			
			
			/* pricing table button */
			if($button_text) {
			$output .= '<div class="pt-button">';
				
				$output .= '<a href="' . $button_url . '" class="gw-btn gwb-red gwb-darkgray gwb-noshadow" ' . $gw_target . $gw_color . '>' . $button_text . '</a>';
				
			$output .= '</div>';										
			}
			
		$output .= '</div>';
		
		
		return $output;	
	 
	}
	add_shortcode( 'pricing_table', 'gw_pricing_table' );
}


/* table list shortcode */
if( !function_exists('gw_table_list') ) {
	function gw_table_list( $atts, $content = null ) {
		
		return '<div class="table-list"><ul>' . do_shortcode($content) .'</ul></div>';
		
	}
	add_shortcode('table_list', 'gw_table_list');
}


/* list item shortcode */
if( !function_exists('gw_tlist_item') ) {
	function gw_tlist_item( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'parity' 	   	 => ''			
		), $atts));		
		
		$gw_parity = '';
		
		if($parity) { $gw_parity = ' class="'.$parity.'"'; }		
		
		return '<li ' . $gw_parity . '>' . do_shortcode($content) . '</li>';
			
	}
	add_shortcode('tlist_item', 'gw_tlist_item');
}



/* google maps shortcode */
if( !function_exists('gw_googlemap') ) {
	function gw_googlemap($atts, $content = null) {
		
		extract(shortcode_atts(array(
				'title'		=> '',
				'location'	=> '',
				'width'		=> '',
				'height'	=> '300',
				'zoom'		=> 8,
				'align'		=> '',
				'class'		=> '',
		), $atts));
		
		// load scripts
		wp_enqueue_script('gw_googlemap');
		wp_enqueue_script('gw_googlemap_api');
		
		
		$output = '<div class="clearboth"></div><div id="map_canvas_'.rand(1, 100).'" class="googlemap '. $class .'" style="height:'.$height.'px;width:100%">';
			$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
			$output .= '<input class="location" type="hidden" value="'.$location.'" />';
			$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
			$output .= '<div class="map_canvas"></div>';
		$output .= '</div>';
		
		return $output;
	   
	}
	add_shortcode("googlemap", "gw_googlemap");
}



/* social media icons shortcode */
if( !function_exists('gw_socialmedia_share') ) {
	function gw_socialmedia_share( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' 	   	 => ''			
		), $atts));		
		
		$output = '<div class="social-wrapper">';
		
		$output .= '<h5>' . $title . '</h5>';
		
		$output .= '<ul>
			<li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="twitter" href="http://twitter.com/home?status=' . get_permalink() . '" rel="external"><i class="fa fa-twitter"></i></a></li>
			<li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '" rel="external"><i class="fa fa-facebook"></i></a></li>
			<li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_permalink() . '&amp;title=' . str_replace( ' ', '%20', get_the_title()) . '"><i class="fa fa-linkedin"></i></a></li>
			<li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="google plus" href="https://plus.google.com/share?url=' . get_permalink() . '" rel="external"><i class="fa fa-google-plus"></i></a></li>
			<li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="email" href="http://www.freetellafriend.com/tell/?heading=Share+This+Article&amp;bg=1&amp;option=email&amp;url=' . get_permalink() . '"><i class="fa fa-envelope-o"></i></a></li>                                
		</ul>';		
			
		$output .= '</div>';
		
		return $output;
		
	}
	add_shortcode('socialmedia_share', 'gw_socialmedia_share');
}


/* content bar shortcode */
if( !function_exists('gw_contentbar') ) {
	function gw_contentbar( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'bgcolor' 	   	 => '',
			'textcolor'		 => ''	
		), $atts));
		
		$gw_bgcolor = '';
		$gw_textcolor = '';	

		if($bgcolor) { $gw_bgcolor = 'background-color:' . $bgcolor . ';'; }
		if($textcolor) { $gw_textcolor = 'color:' . $textcolor . ';'; }			
		
		$output = '';
		$output .= '</div></div>';
		$output .= '<div class="contentbar" style="' . $gw_bgcolor . $gw_textcolor . '">' . do_shortcode($content) . '</div>';

		$output .= '<div class="container"><div class="content">';	
		return $output;
			
	}
	add_shortcode('contentbar', 'gw_contentbar');
}



/* content bar section */
if( !function_exists('gw_contentbar_section') ) {
	function gw_contentbar_section( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'bgcolor' 	   	 => '',
			'bgimg' 	   	 => '',
			'textcolor'		 => ''			
		), $atts));
		
		$gw_bgcolor = '';

		$gw_textcolor = '';

		if($bgcolor) { $gw_bgcolor = 'background-color:' . $bgcolor . ';'; }
		if($textcolor) { $gw_textcolor = 'color:' . $textcolor . ';'; }			
		

		$output = '<section class="contentbar-section" style="' . $gw_bgcolor . $gw_textcolor . '">';
		
		if($bgimg) { $output .= '<img src="' . $bgimg . '" alt="" class="contentbar-img">'; }
		
		$output .= '<div class="container">' . do_shortcode($content) . '</div>';

		$output .= '</section>';
		
		return $output;
			
	}
	add_shortcode('contentbar_section', 'gw_contentbar_section');
}



/* easypiechart slide item shortcode */
if( !function_exists('gw_skillchart') ) {
	function gw_skillchart( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'percent'     	 	=> '',
			'title'   	     	=> '',
			'border_right'	 	=> '',
			'color1'		 	=> '',
			'color2'		 	=> '',
			'color3'		 	=> '',
			'color4'		 	=> '',									
			'trackcolor'		=> '#e4e4e4'				
		), $atts));		  		
		
		wp_enqueue_script('easypiechart-js');
		wp_enqueue_script('easypiechart-call');
		
		$output = '';
		
		if($color1) { 
			$easypiechart_data1 = array('epc_color' => $color1, 'epc_trackcolor' => $trackcolor); 
	        wp_localize_script('easypiechart-call', 'easypiechart_data1', $easypiechart_data1);	
			

			$output = '<div class="piechart-wrapper">';
				
				$output .= '<span class="chart1 skilBg" data-percent="' . $percent . '">';
					$output .= '<span class="percent"></span>';
				$output .= '</span>';					
				if($title) { $output .= '<h5>' . $title . '</h5>'; }
				
				$output .= do_shortcode($content);
				
				if($border_right == 'true') { $output .= '<div class="piechart-border"></div>'; }
				
			$output .= '</div>';
			
			return $output;	
							
		}
		if($color2) { 
			$easypiechart_data2 = array('epc_color' => $color2, 'epc_trackcolor' => $trackcolor);
	        wp_localize_script('easypiechart-call', 'easypiechart_data2', $easypiechart_data2);	
			
			
			$output = '<div class="piechart-wrapper">';
				
				$output .= '<span class="chart2 skilBg" data-percent="' . $percent . '">';
					$output .= '<span class="percent"></span>';
				$output .= '</span>';					
				if($title) { $output .= '<h5>' . $title . '</h5>'; }
				
				$output .= do_shortcode($content);
				
				if($border_right == 'true') { $output .= '<div class="piechart-border"></div>'; }
				
			$output .= '</div>';
			
			return $output;	
							
		}
		
		if($color3) {
			$easypiechart_data3 = array('epc_color' => $color3, 'epc_trackcolor' => $trackcolor);
	        wp_localize_script('easypiechart-call', 'easypiechart_data3', $easypiechart_data3);		
			
			
			$output = '<div class="piechart-wrapper">';
				
				$output .= '<span class="chart3 skilBg" data-percent="' . $percent . '">';
					$output .= '<span class="percent"></span>';
				$output .= '</span>';					
				if($title) { $output .= '<h5>' . $title . '</h5>'; }
				
				$output .= do_shortcode($content);
				
				if($border_right == 'true') { $output .= '<div class="piechart-border"></div>'; }
				
			$output .= '</div>';
			
			return $output;					
		}
		
		if($color4) { 
			$easypiechart_data4 = array('epc_color' => $color4, 'epc_trackcolor' => $trackcolor);
	        wp_localize_script('easypiechart-call', 'easypiechart_data4', $easypiechart_data4);	
			
		
			$output = '<div class="piechart-wrapper">';
				
				$output .= '<span class="chart4 skilBg" data-percent="' . $percent . '">';
					$output .= '<span class="percent"></span>';
				$output .= '</span>';					
				if($title) { $output .= '<h5>' . $title . '</h5>'; }
				
				$output .= do_shortcode($content);
				
				if($border_right == 'true') { $output .= '<div class="piechart-border"></div>'; }
				
			$output .= '</div>';
			
			return $output;						
		}
	 
	}
	add_shortcode( 'skillchart', 'gw_skillchart' );
}


/* skillbar shortcode */
if( !function_exists('gw_skillbar') ) {
	function gw_skillbar( $atts  ) {		
		extract( shortcode_atts( array(
			'title' => '',
			'percentage' => '',
			'color' => '',
			'show_percent' => 'true'
		), $atts ) );
		
		// Enqueue scripts
		wp_enqueue_script('gw_skillbar');
		
		$output = '';
		
		if ( $title ) { 
			$output .= '<div class="skillbar-title">'. $title .'</div>'; 
		}		
		$output .= '<div class="skillbar-wrapper clearboth" data-percent="' . $percentage . '%">';
			
			$output .= '<div class="skillbar-bar" style="background: ' . $color . ';"></div>';
			
			if ( $show_percent == 'true' ) {
				$output .= '<div class="skillbar-percent" data-percent="'. $percentage .'%">' . $percentage . '%</div>';
			}
			
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'skillbar', 'gw_skillbar' );
}


/* team section shortcode */
if( !function_exists('gw_teamsection') ) {
	function gw_teamsection( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image' 	   	 => '',
			'name' 	 	  	 => '',
			'url'			 => '',
			'position'		 => '',
			'twitter'		 => '',
			'facebook'		 => '',
			'linkedin'		 => '',
			'googleplus'	 => '',
			'dribbble'		 => '',
			'forrst'		 => ''											
		), $atts));
		

		$output = '<section class="team-section">';
			$output .= '<div class="row">';
			
			if($image) { /* image exists so we create a layout with image */
					
				$output .= '<div class="col-md-5">';
					$output .= '<img src="' . $image . '" alt="' . $name . '" />';			
				$output .= '</div>';

				$output .= '<div class="col-md-7 ts-margin">';
					if($name) { 
						if($url) {
							$output .= '<h3 class="ts-name"><a href="' . $url . '"><strong>' . $name . '</strong></a></h3>';
						} else {
							$output .= '<h3 class="ts-name"><strong>' . $name . '</strong></h3>';
						}
					}
					if($position) { $output .= '<span class="ts-position">' . $position . '</span>'; }				
					
					$output .= do_shortcode($content);
					
					if($twitter || $facebook || $linkedin || $googleplus || $dribbble || $forrst) {
						$output .= '<ul class="ts-list">';
							if($twitter) { $output .= '<li><a href="' . $twitter . '">' . __('twitter', 'framework') . '</a></li>'; }
							if($facebook) { $output .= '<li><a href="' . $facebook . '">' . __('facebook', 'framework') . '</a></li>'; }
							if($linkedin) { $output .= '<li><a href="' . $linkedin . '">' . __('linkedin', 'framework') . '</a></li>'; }
							if($googleplus) { $output .= '<li><a href="' . $googleplus . '">' . __('google+', 'framework') . '</a></li>'; }	
							if($dribbble) { $output .= '<li><a href="' . $dribbble . '">' . __('dribbble', 'framework') . '</a></li>'; }
							if($forrst) { $output .= '<li><a href="' . $forrst . '">' . __('forrst', 'framework') . '</a></li>'; }																											
						$output .= '</ul>';
					}						
								
				$output .= '</div>';
				
			} else { /* image doesn't exist, we display a different layout */
				
				$output .= '<div class="col-md-12">';
					if($name) { 
						if($url) {
							$output .= '<h3 class="ts-name"><a href="' . $url . '"><strong>' . $name . '</strong></a></h3>';
						} else {
							$output .= '<h3 class="ts-name"><strong>' . $name . '</strong></h3>';
						}
					}
					if($position) { $output .= '<span class="ts-position">' . $position . '</span>'; }				
					
					$output .= do_shortcode($content);
					
					if($twitter || $facebook || $linkedin || $googleplus || $dribbble || $forrst) {
						$output .= '<ul class="ts-list">';
							if($twitter) { $output .= '<li><a href="' . $twitter . '">' . __('twitter', 'framework') . '</a></li>'; }
							if($facebook) { $output .= '<li><a href="' . $facebook . '">' . __('facebook', 'framework') . '</a></li>'; }
							if($linkedin) { $output .= '<li><a href="' . $linkedin . '">' . __('linkedin', 'framework') . '</a></li>'; }
							if($googleplus) { $output .= '<li><a href="' . $googleplus . '">' . __('google+', 'framework') . '</a></li>'; }
							if($dribbble) { $output .= '<li><a href="' . $dribbble . '">' . __('dribbble', 'framework') . '</a></li>'; }
							if($forrst) { $output .= '<li><a href="' . $forrst . '">' . __('forrst', 'framework') . '</a></li>'; }																									
						$output .= '</ul>';
					}
					
								
				$output .= '</div>';					
			}
												
			$output .= '</div>';					
			
			
		$output .= '</section><div class="clearboth"></div>';
		
		return $output;
			
	}
	add_shortcode('teamsection', 'gw_teamsection');
}


/* team block shortcode */
if( !function_exists('gw_teamblock') ) {
	function gw_teamblock( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image' 	   	 => '',
			'name' 	 	  	 => '',
			'url'			 => '',
			'position'		 => '',
			'twitter'		 => '',
			'facebook'		 => '',
			'linkedin'		 => '',
			'googleplus'	 => '',
			'dribbble'		 => '',
			'forrst'		 => ''												
		), $atts));
		

		$output = '<section class="teamblock">';
			
			if($image) {
				$output .= '<img src="' . $image . '" alt="' . $name . '" class="teamblock-img" />';			
			}
			
			if($name) { 
				if($url) {
					$output .= '<h4 class="td-name"><a href="' . $url . '">' . $name . '</a></h4>';
				} else {
					$output .= '<h4 class="td-name">' . $name . '</h4>';
				}
			}
			if($position) { $output .= '<span class="ts-position">' . $position . '</span>'; }				
			
			$output .= do_shortcode($content);
				
			$output .= '<div class="clearboth"></div>';
									
			if($twitter || $facebook || $linkedin || $googleplus || $dribbble || $forrst) {
				$output .= '<div class="ts-list td-list">';
					if($twitter) { $output .= '<span><a href="' . $twitter . '">' . __('twitter', 'framework') . '</a></span>'; }
					if($facebook) { $output .= '<span><a href="' . $facebook . '">' . __('facebook', 'framework') . '</a></span>'; }
					if($linkedin) { $output .= '<span><a href="' . $linkedin . '">' . __('linkedin', 'framework') . '</a></span>'; }
					if($googleplus) { $output .= '<span><a href="' . $googleplus . '">' . __('google+', 'framework') . '</a></span>'; }
					if($dribbble) { $output .= '<span><a href="' . $dribbble . '">' . __('dribbble', 'framework') . '</a></span>'; }
					if($forrst) { $output .= '<span><a href="' . $forrst . '">' . __('forrst', 'framework') . '</a></span>'; }					
				$output .= '</div>';
			}						
							
	
		$output .= '</section>';
		
		return $output;
			
	}
	add_shortcode('teamblock', 'gw_teamblock');
}



/* team entry shortcode */
if( !function_exists('gw_teamentry') ) {
	function gw_teamentry( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image' 	   	 => '',
			'name' 	 	  	 => '',
			'url'			 => '',
			'color'			 => '',
			'position'		 => '',
			'twitter'		 => '',
			'facebook'		 => '',
			'linkedin'		 => '',
			'googleplus'	 => '',
			'dribbble'		 => '',
			'forrst'		 => ''
		), $atts));
		

		$output = '<section class="teamentry">';
			
			
			if($image) {
				$output .= '<div class="te-placeholder"><img src="' . $image . '" alt="' . $name . '" class="teamblock-img" /></div>';
			} else {
				$output .= '<div class="te-placeholder"></div>';
			}
			
			$output .= '<div class="te-content">';
			
				if($name) { 
					if($url) {
						$output .= '<h4 class="td-name"><a href="' . $url . '">' . $name . '</a></h4>';
					} else {
						$output .= '<h4 class="td-name">' . $name . '</h4>';
					}
				}
				if($position) {
					if($color) {
						$output .= '<span class="te-position" style="background:' . $color . ';">' . $position . '</span>';
					} else {
						$output .= '<span class="te-position">' . $position . '</span>';					
					}
				}
				
				$output .= do_shortcode($content);
					
				if($twitter || $facebook || $linkedin || $googleplus || $dribbble || $forrst) {
					$output .= '<ul class="ts-list td-list">';
						if($twitter) { $output .= '<li><a href="' . $twitter . '">' . __('twitter', 'framework') . '</a></li>'; }
						if($facebook) { $output .= '<li><a href="' . $facebook . '">' . __('facebook', 'framework') . '</a></li>'; }
						if($linkedin) { $output .= '<li><a href="' . $linkedin . '">' . __('linkedin', 'framework') . '</a></li>'; }
						if($googleplus) { $output .= '<li><a href="' . $googleplus . '">' . __('google+', 'framework') . '</a></li>'; }
						if($dribbble) { $output .= '<li><a href="' . $dribbble . '">' . __('dribbble', 'framework') . '</a></li>'; }
						if($forrst) { $output .= '<li><a href="' . $forrst . '">' . __('forrst', 'framework') . '</a></li>'; }																											
					$output .= '</ul>';
				}
			
			$output .= '</div>';
								

		$output .= '</section>';
		
		return $output;
			
	}
	add_shortcode('teamentry', 'gw_teamentry');
}



/* banner shortcode */
if( !function_exists('gw_banner') ) {
	function gw_banner( $atts  ) {		
		extract( shortcode_atts( array(
			'title' => '',
			'percentage' => '',
			'color' => '',
			'show_percent' => 'true'
		), $atts ) );
		
		// Enqueue scripts
		wp_enqueue_script('gw_skillbar');
		
		$output = '';
		
		if ( $title ) { 
			$output .= '<div class="skillbar-title">'. $title .'</div>'; 
		}		
		$output .= '<div class="skillbar-wrapper clearboth" data-percent="' . $percentage . '%">';
			
			$output .= '<div class="skillbar-bar" style="background: ' . $color . ';"></div>';
			
			if ( $show_percent == 'true' ) {
				$output .= '<div class="skillbar-percent" data-percent="'. $percentage .'%">' . $percentage . '%</div>';
			}
			
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'banner', 'gw_banner' );
}



/* lightbox shortcode */
if( !function_exists('gw_lightbox') ) {
	function gw_lightbox( $atts  ) {		
		extract( shortcode_atts( array(
			'title' 			=> '',
			'url' 				=> '',
			'thumbnail' 		=> '',
			'align'				=> ''
		), $atts ) );
		
		
		$gw_align = '';
		
		if($align == 'left') {
			$gw_align = 'alignleft';
		} elseif($align == 'right') {
			$gw_align = 'alignright';
		}

		
		$output  = '';
		$output .= '<span class="' . $gw_align . '">';
			$output .= '<a href="' . $url . '" class="magnific-popup"><img src="' . $thumbnail . '" alt="' . $title . '" /></a>';	
		$output .= '</span>';		
		
		return $output;

	}
	add_shortcode( 'lightbox', 'gw_lightbox' );
}




/* banner shortcode */
if( !function_exists('gw_portraitblock') ) {
	function gw_portraitblock( $atts  ) {		
		extract( shortcode_atts( array(
			'title' 			=> '',
			'url' 				=> '',
			'thumbnail' 		=> '',
			'excerpt'			=> ''
		), $atts ) );
		
		

		$output  = '';
		$output .= '<div class="portraitblock">';
			
			if($thumbnail) {
				$output .= '<img src="' . $thumbnail . '" alt="' . $title . '" />';
			}
				
			if($title) {
				if($url) {
					$output .= '<h5 class="portraitblock-title"><a href="' . $url . '">' . $title . '</a></h5>';
					
					$output .= '<div class="portraitblock-over">';	
						$output .= '<h4><a href="' . $url . '">' . $title . '</a></h4>';
						$output .= '<p>' . $excerpt . '</p>';
					$output .= '</div>';
					
				} else {
					$output .= '<h5 class="portraitblock-title">' . $title . '</h5>';
					
					$output .= '<div class="portraitblock-over">';	
						$output .= '<h4><a href="' . $url . '">' . $title . '</a></h4>';
						$output .= '<p>' . $excerpt . '</p>';
					$output .= '</div>';					
				}

			}
			
		$output .= '</div>';		
		
		return $output;

	}
	add_shortcode( 'portraitblock', 'gw_portraitblock' );
}






/* sidebar anywhere shortcode */
if( !function_exists('gw_gwsidebar') ) {
	function gw_gwsidebar( $atts ) {
		extract( shortcode_atts( array(
			'name'		=> ''
		), $atts ) );
		
		ob_start();
		dynamic_sidebar($name);
		$html = '<ul class="content-widgets">' . ob_get_contents() . '</ul>';
		ob_end_clean();
		return $html;
	}
	
	add_shortcode( 'gwsidebar', 'gw_gwsidebar' );
}


/* latest entries from normal blog */
if( !function_exists('gw_latest_blog') ) {
	function gw_latest_blog( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'qty'     		=> 4,
			'section' 		=> '',
			'columns'		=> ''
		), $atts));	  
		
		
		global $more, $post;
		$output = '';
		
		
		$loop = new WP_Query( array( 'category_name' => $section, 'posts_per_page' => $qty, 'post_status' => 'publish' ) );

		/* 2 or 3 columns masonry layout fullwidth */
		if($columns == "2" || $columns == "3") { 
			
			wp_enqueue_script('masonry-js');
			wp_enqueue_script('masonry-call-js');			
			
			$output .= '<div class="blog-masonry">';
			$output .= '<div class="gutter-sizer"></div>';			
		}
		
		/* 2 columns masonry layout sidebar */
		if($columns == "2s") {
			wp_enqueue_script('masonry-js');
			wp_enqueue_script('masonry-call-js');
			
			$output .= '<div class="blog-masonry tb4">';
			$output .= '<div class="gutter-sizer"></div>';			
		}
		
		
		while ( $loop->have_posts() ) : $loop->the_post();

			$category = get_the_category();
			$posttype = get_post_format();

			
			if($columns == "2") {
				$output .= 'aaa<div class="xd-2 masonry-item">'; 
			}
			if($columns == "3") {
				$output .= '<div class="xd-3 masonry-item">'; 
			}	
			if($columns == "2s") {
				$output .= '<div class="xd-3 masonry-item">'; 
			}					
			
			
			$output .= '<article class="entry-block ebs">';
			
			
				if($posttype == 'quote') { /* we have a quote post */
					
					
					/* get quote post details */
					$quote = get_post_meta($post->ID, 'q_text', true);
					$quote_name = get_post_meta($post->ID, 'q_author', true);
								
					/* post date, categories, comments, author */
					$output .= '<div class="entry-misc entry-misc-quote">';
						$output .= '<span><i class="fa fa-clock-o"></i>' . get_the_date('F j, Y') . '</span>';
						$output .= '<span><i class="fa fa-file-o"></i><a href="'. get_category_link($category[0]->term_id ) . '">' . $category[0]->cat_name . '</a></span>';
						$output .= '<span><i class="fa fa-comments-o"></i><a href="' . get_permalink() . '#comments">' . get_comments_number('0', '1', '%') . __(' comments', 'framework') . '</a></span>';
						$output .= '<span><i class="fa fa-user"></i><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() .'</a></span>';
					$output .= '</div>';
					
					/* quote body */
					$output .= '<a class="entry-quote" href="' . get_permalink() . '">';
						$output .= '<span class="quote-content">' . esc_html($quote) . '</span>';
	       				if($quote_name) {
							$output .= '<span class="quote-name">' . esc_html($quote_name) . '</span>';
						}
						$output .= '<span class="qquote"></span>';
					$output .= '</a>';


					
				} elseif($posttype == 'link') { /* we have a link post */
					
					/* get link post details */
					$link = get_post_meta($post->ID, 'linkurl', true);					
			
					$output .= '<div class="post-link">';
						$output .= '<h3><a href="' . esc_html($link) . '">' . get_the_title() . '</a></h3>';
						$output .= '<span>-' . esc_html($link) . '-</span>';
						$output .= '<span class="plink"></span>';
					$output .= '</div>';

					
				} elseif($posttype == 'aside') { /* we have a link post */
					
					/* post date, categories, comments, author */
					$output .= '<div class="entry-misc entry-misc-quote">';
						$output .= '<span><i class="fa fa-clock-o"></i>' . get_the_date('F j, Y') . '</span>';
						$output .= '<span><i class="fa fa-file-o"></i><a href="'. get_category_link($category[0]->term_id ) . '">' . $category[0]->cat_name . '</a></span>';
						$output .= '<span><i class="fa fa-comments-o"></i><a href="' . get_permalink() . '#comments">' . get_comments_number('0', '1', '%') . __(' comments', 'framework') . '</a></span>';
						$output .= '<span><i class="fa fa-user"></i><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() .'</a></span>';
					$output .= '</div>';					
					
					$output .= '<div class="clearboth"></div>';
					
					
					/* aside post body */
					$output .= '<div class="aside-body">';
						$output .= get_the_content();
					$output .= '</div>';
					
							
				} else { /* we have either a video post or a normal post */
					
					/* get video post details */		
					$video = get_post_meta($post->ID, 'myvideo', true);					
					
					if($posttype == 'video') {
	
						$output .= '<div class="video-wrapper">';
							$output .= '<div class="video-content">';
								$output .= stripslashes(htmlspecialchars_decode($video));
							$output .= '</div>';
						$output .= '</div>';					
	
					}				
				
	
					/* display the thumbnail, if exists */
					if(has_post_thumbnail()) {
						
						$output .= '<div class="port-viewer">';
							
							$output .= get_the_post_thumbnail($post->ID, 'post-thumb');
							
							$output .= '<div class="port-mask pm-align">';
						
								$output .= '<div class="post-buttons">';
								
									$output .= '<div class="port-link"><a href="' . get_permalink($post->ID) . '"><i class="fa fa-arrow-right"></i></a></div>';
									
								$output .= '</div>';
									
							$output .= '</div>';
								
						$output .= '</div>';		
									
						$output .= '<div class="clearboth"></div>';	
				
					}			
				
					/* display post title */
					$output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				
					/* post date, categories, comments, author */
					$output .= '<div class="entry-misc">';
						$output .= '<span><i class="fa fa-clock-o"></i>' . get_the_date('F j, Y') . '</span>';
						$output .= '<span><i class="fa fa-file-o"></i><a href="'. get_category_link($category[0]->term_id ) . '">' . $category[0]->cat_name . '</a></span>';
						$output .= '<span><i class="fa fa-comments-o"></i><a href="' . get_permalink() . '#comments">' . get_comments_number('0', '1', '%') . __(' comments', 'framework') . '</a></span>';
						$output .= '<span><i class="fa fa-user"></i><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() .'</a></span>';
					$output .= '</div>';
					
					/* display post content */
					$more = 0;
					
					if(get_the_content('', TRUE)) {
						$output .= '<div class="pcontent-shortcode">';
							$output .= apply_filters('the_content', get_the_content(__('continue reading', 'framework')));
							$output .= str_replace(']]>', ']]&gt;', $content);
						$output .= '</div>';						
					}				
					
					
					
				} /* end of post type case */
			
			
			$output .= '</article>';
			
			
			if($columns == "2" || $columns == "3" || $columns == "2s") { /* close the .xd2/3 */
				$output .= '</div>'; 
			}			
			
		
		endwhile; wp_reset_query();
		
		
		if($columns == "2" || $columns == "3" || $columns == "2s") { /* close the .blog-masonry */
			$output .= '</div>';		
		}		
		
		
		return $output;
		
	}
	
	add_shortcode('latest_blog', 'gw_latest_blog');	
}



/* latest entries from blog with date over image */
if( !function_exists('gw_latest_blog_alt') ) {
	function gw_latest_blog_alt( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'qty'     		=> 3,
			'section' 		=> ''
		), $atts));	  
		
		
		global $more, $post;
		$output = '';


		$loop = new WP_Query( array( 'category_name' => $section, 'posts_per_page' => $qty, 'post_status' => 'publish' ) );


		$output .= '<div class="row">';
		
		while ( $loop->have_posts() ) : $loop->the_post();

			$category = get_the_category();
			$posttype = get_post_format();
			

			$output .= '<div class="col-md-4">';
				
				$output .= '<article class="entry-block bcolumn-block">';
					
					
					if(has_post_thumbnail() ) { /* display post thumbnail if present */
						$output .= '<div class="port-viewer">';
							$output .= get_the_post_thumbnail($post->ID, 'post-columns');
							$output .= '<a class="port-mask pm-align" href="' . get_permalink() . '"></a>';
						$output .= '</div>';
						$output .= '<div class="clearboth"></div>';       
					}
					
					/* post title */
					$output .= '<h4 class="column-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';				
						
						
					if(has_post_thumbnail() ) { 
						$output .= '<div class="entry-misc">' . get_the_date('F j, Y') . '</div>';
					} else {
						$output .= '<div class="entry-misc em-noimg">' . get_the_date('F j, Y') . '</div>';
						$output .= '<div class="clearboth"></div>';
					}	
					
					/* post content */
					$output .=  excerpt('26');
					$output .= '<div class="clearboth"></div>';
					$output .= '<a href="' . get_permalink() . '" class="more-link">' . __('continue reading', 'framework') . '</a>';						
					
					
				$output .= '</article>';
				
			$output .= '</div>'; /* end of .col-md-4 */
			
			endwhile; wp_reset_query();			
			
			$output .= '</div>'; /* end of .row */

		return $output;
		
		
		
	}
	
	add_shortcode('latest_blog_alt', 'gw_latest_blog_alt');	
}



/* latest entries from portfolio grid */
if( !function_exists('gw_latest_portg') ) {
	function gw_latest_portg( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'qty'     		=> 4,
			'section' 		=> '',
			'columns'		=> ''			
		), $atts));	             
	
		global $post;
		$output = '';
		$videoport = '';
		
		$loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $qty, 'portfolio_category' => $section ) );
	
		$output = '';
		
		if($columns == "3") {
			
		$output .= '<div class="content pxd3-parent">';
		
		} else {
		
        $output .= '<div class="content pxd4-parent">';
		
		}
		
        	$output .= '<ul id="portfolio-container" class="portfolio-wrapper">';
		
			while ( $loop->have_posts() ) : $loop->the_post();
			
				$portfolio_thumb = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				$video_link = get_post_meta($loop->post->ID, "video_link", true);
				
				if (strlen(get_the_title()) > 28) { $short_title = substr(get_the_title(), 0, 28) . '...'; } else { $short_title = get_the_title(); }
				
				if($columns == "3") {
					
				$output .= '<li class="pxd-3 portfolio-item">';
				
				} else {
					
				$output .= '<li class="pxd-4 portfolio-item">';
				
				}
					
					$output .= '<article class="entry-portfolio ep-grid">';
						
						if(has_post_thumbnail() ) { /* display post thumbnail if present */
						
							$output .= '<div class="port-viewer pv-grid">';
								
								$output .= get_the_post_thumbnail($post->ID, 'port-thumb');						
																
								$output .= '<div class="port-overlay po-sc">';
									/*
									if($video_link) {
										$output .= '<div class="port-gridzoom"><a href="' . $video_link . '" class="magnific-popup mfp-iframe"><img src="' . get_template_directory_uri() .'/images/video_icon.png" alt="' . __('video', 'framework') . '" /></a></div>';
									} else {
										$output .= '<div class="port-gridzoom"><a href="' . wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) . '" class="magnific-popup"><img src="' . get_template_directory_uri() .'/images/plus_icon.png" alt="' . __('zoom', 'framework') . '" /></a></div>';
									} */                                
									$output .= '<div class="clearboth"></div>';
									$output .= '<h4><a href="' . get_permalink() . '">' . $short_title . '</a></h4>';
									$output .= '<div class="ep-cat">' . substr(custom_taxonomies_terms_links(), 0, -2) . '</div>';
								
								$output .= '</div>';	
								
							$output .= '</div>';
						
						}
						
						
						$output .= '<div class="clipfix">&nbsp;</div>';
						 
					
					$output .= '</article>';
				
				$output .= '</li>';
			
			endwhile; wp_reset_query();	
			
			
			$output .= '</ul>';

		$output .= '</div>'; /* end of .content */

		return $output;
		
	}
	
	add_shortcode('latest_portg', 'gw_latest_portg');	
}



/* latest entries from portfolio classic */
if( !function_exists('gw_latest_portc') ) {
	function gw_latest_portc( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'qty'     		=> 4,
			'section' 		=> '',
			'columns'		=> ''			
		), $atts));	             
	
		global $post;
		$output = '';
		$videoport = '';
		
		$loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $qty, 'portfolio_category' => $section ) );
	
		$output = '';
		
		if($columns == "3") {
			
		$output .= '<div class="content pxd3-parent">';
		
		} else {
		
        $output .= '<div class="content pxd4-parent">';
		
		}
		
        	$output .= '<ul id="portfolio-container" class="portfolio-wrapper">';
		
			while ( $loop->have_posts() ) : $loop->the_post();
			
				$portfolio_thumb = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				$video_link = get_post_meta($loop->post->ID, "video_link", true);
				
				if (strlen(get_the_title()) > 28) { $short_title = substr(get_the_title(), 0, 28) . '...'; } else { $short_title = get_the_title(); }
				
				if($columns == "3") {
					
				$output .= '<li class="pxd-3 portfolio-item">';
				
				} else {
					
				$output .= '<li class="pxd-4 portfolio-item">';
				
				}
					
					$output .= '<article class="entry-portfolio">';
						
						if(has_post_thumbnail() ) { /* display post thumbnail if present */
						
							$output .= '<div class="port-viewer">';
								
								$output .= get_the_post_thumbnail($post->ID, 'port-thumb');						
																
								$output .= '<div class="port-mask pm-align">';
									
									$output .= '<div class="port-buttons">';
									
									if($video_link) {
										$output .= '<div class="port-zoom"><a href="' . $video_link . '" class="magnific-popup mfp-iframe"><i class="fa fa-play"></i></a></div>';
									} else {
										$output .= '<div class="port-zoom"><a href="' . wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) . '" class="magnific-popup"><i class="fa fa-plus"></i></a></div>';
									}   
									$output .= '<div class="port-link"><a href="' . get_permalink() . '"><i class="fa fa-arrow-right"></i></a></div>';
									
									$output .= '</div>'; /* end of .port-buttons */
									
								$output .= '</div>'; /* end of .port-mask .pm-align */

							$output .= '</div>'; /* end of .port-viewer */
						
							$output .= '<div class="clearboth"></div>'; 
						}
						

						/* title and categories */
						if( function_exists('zilla_likes') ) {
								 
						$output .= '<div class="entry-port-title">';
							$output .= '<h4 class="news-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
							$output .= '<div class="ep-cat">' . substr(custom_taxonomies_terms_links(), 0, -2) . '</div>';
						$output .= '</div>';
						$output .= '<div class="port-zilla">' . do_shortcode('[zilla_likes]') . '</div>';
						
						} else {
						
						$output .= '<div class="entry-port-title ept-full">';
							$output .= '<h4 class="news-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
							$output .= '<div class="ep-cat">' . substr(custom_taxonomies_terms_links(), 0, -2) . '</div>';
						$output .= '</div>';
													
						}
                            
					
					$output .= '</article>';
				
				$output .= '</li>';
			
			endwhile; wp_reset_query();	
			
			
			$output .= '</ul>';

		$output .= '</div>'; /* end of .content */

		return $output;
		
	}
	
	add_shortcode('latest_portc', 'gw_latest_portc');	
}


?>