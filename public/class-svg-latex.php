<?php
class SVG_Latex {
	var $latex;
	var $bg_hex;
	var $fg_hex;
	var $size;
	var $zoom = 1;
	var $url;
	var $error;
	function __construct( $latex, $bg_hex = 'ffffff', $fg_hex = '000000', $size = 0 ) {
		$this->latex  = (string) $latex;
		$this->bg_hex = $this->sanitize_hex( $bg_hex );
		$this->fg_hex = $this->sanitize_hex( $fg_hex );
		$this->size   = (int) $size;
	}
	function set_zoom( $zoom ) {
		$this->zoom = $zoom;
	}
	function sanitize_hex( $color ) {
		if ( 'transparent' == $color )
			return 'T';
		// Fix for 3 letter hex codes
		if ( 3 == strlen( $color ) )
			$color = $color[0] . $color[0] . $color[1] . $color[1]. $color[2] . $color[2];
		$color = substr( preg_replace( '/[^0-9a-f]/i', '', (string) $color ), 0, 6 );
		if ( 6 > $l = strlen( $color ) )
			$color .= str_repeat('0', 6 - $l );
		return $color;
	}
	function wrapper( $wrapper = false ) {}
	function url() {
		if ( ! empty( $_GET['pb-latex-zoom'] ) ) {
			// Undocumented zoom parameter increases image resolution
			// @see https://github.com/Automattic/jetpack/issues/7392
			$this->zoom = (int) $_GET['pb-latex-zoom'];
        }
        
        if ( defined( 'ESCRIPT_LATEX_URL' ) ) {
            $url = ESCRIPT_LATEX_URL;
        }else{
            $url = ( is_ssl() ? 'https' : 'http' ) . '://s0.wp.com/latex.php';
		}
		$this->url = add_query_arg(
			urlencode_deep( array(
				'latex' => $this->latex,
				'bg' => $this->bg_hex,
				'fg' => $this->fg_hex,
				's' => $this->size,
				'zoom' => $this->zoom,
			) ),
                $url
		);
		return $this->url;
	}
}