<?php
/**
 * Fuel-Tcpdf_Wrapper
 *
 * @package    Fuel-Tcpdf_Wrapper
 * @version    1.0
 * @author     Takeshige Nii
 * @license    MIT License
 * @copyright  2015 rz
 * @link       http://rrr-z.jp/
 */

\Autoloader::add_core_namespace('Tcpdf_Wrapper');

\Autoloader::add_classes(array(
	'Tcpdf_Wrapper\\Pdf'                          => __DIR__.'/classes/pdf.php',
	'Tcpdf_Wrapper\\Pdf_Function'                 => __DIR__.'/classes/pdf/function.php',
	'Tcpdf_Wrapper\\Pdf_Http'                     => __DIR__.'/classes/pdf/http.php',
	'Tcpdf_Wrapper\\Pdf_Offset'                   => __DIR__.'/classes/pdf/offset.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper'                  => __DIR__.'/classes/pdf/wrapper.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper_Font'             => __DIR__.'/classes/pdf/wrapper/font.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper_Graphic'          => __DIR__.'/classes/pdf/wrapper/graphic.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper_Output'           => __DIR__.'/classes/pdf/wrapper/output.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper_Pagesetting'      => __DIR__.'/classes/pdf/wrapper/pagesetting.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper_Positioning'      => __DIR__.'/classes/pdf/wrapper/positioning.php',
	'Tcpdf_Wrapper\\Pdf_Wrapper_Typesetting'      => __DIR__.'/classes/pdf/wrapper/typesetting.php',
));

// Ensure the Fuel-Tcpdf_Wrapper config is loaded for Temporal
\Config::load('pdf', true);
