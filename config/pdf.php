<?php

/**
 * デフォルト値
 */
return array(
	'global_offset' => array(
		'x' => 0.0,
		'y' => 0.0,
	),
		
	'default' => array(
		'__offset' => array(
			'x' => 0.0,
			'y' => 0.0,
		),
		'__args' => array(
			'TCPDF' => array(
				'orientation' => 'P',
				'unit'        => 'mm',
				'format'      => 'A4',
				'unicode'     => true,
				'encoding'    => 'utf-8',
			),
			
			'AddPage' => array(
				'orientation' => 'P',
				'format'      => 'A4',
				'keepmargins' => false,
				'tocpage'     => false ,
			),
			'Cell' => array(
				'w'                 => 10,
				'h'                 => 10,
				'txt'               => '',
				'border'            => 0,
				'ln'                => 0,
				'align'             => '',
				'fill'              => false,
				'link'              => '',
				'stretch'           => 0,
				'ignore_min_height' => false,
				'calign'            => 'T',
				'valign'            => 'M',
			),
			'Curve' => array(
				'x0'         => 0,
				'y0'         => 0,
				'x1'         => 0,
				'y1'         => 0,
				'x2'         => 0,
				'y2'         => 0,
				'x3'         => 0,
				'y3'         => 0,
				'style'      => '',
				'line_style' => array(),
				'fill_color' => array(),
			),
			'Line' => array(
				'x1'    => 0,
				'y1'    => 0,
				'x2'    => 0,
				'y2'    => 0,
				'style' => array(),
			),
			'Output' => array(
				'name' => 'doc.pdf',
				'dest' => 'S'
			),
			'SetAutoPageBreak' => array(
				'auto'  => true,
				'margin'=> 0,
			),
			'SetFont' => array(
				'family'   => 'kozgopromedium',
				'style'    => '',
				'size'     => 11,
				'fontfile' => '',
				'subset'   => 'default',
				'out'      => true,
			),
			'SetFontSize' => array(
				'size' => 11,
				'out'  => true,
			),
			'setFontSpacing' => array(
				'spacing' => 0,
			),
			'setFontStretching' => array(
				'perc' => 100,
			),
			'SetMargins' => array(
				'left'        => 10,
				'top'         => 10,
				'right'       => -1,
				'keepmargins' => false,
			),
			'SetLeftMargin' => array(
				'margin' => 10,
			),
			'setPrintHeader' => array(
				'val' => false,
			),
			'setPrintFooter' => array(
				'val' => false,
			),
			'SetRightMargin' => array(
				'margin' => -1,
			),
			'SetTopMargin' => array(
				'margin' => 10,
			),
			'SetX' => array(
				'x'      => 0,
				'rtloff' => false, 
			),
			'SetXY' => array(
				'x'      => 0,
				'y'      => 0,
				'rtloff' => false, 
			),
			'SetY' => array(
				'x'      => 0,
				'resetx' => true,
				'rtloff' => false, 
			),
			'Write' => array(
				'h'          => 11,
				'txt'        => '',
				'link'       => '',
				'fill'       => false,
				'align'      => '',
				'ln'         => false,
				'stretch'    => 0,
				'firstline'  => false,
				'firstblock' => false,
				'maxh'       => 0,
				'wadj'       => 0,
				'margin'     => '',
			),
		),
	),
	
	'views' => array(
		'pdf' => array(
			
		),
	),
);
