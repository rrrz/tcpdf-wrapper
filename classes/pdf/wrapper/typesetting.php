<?php
namespace Tcpdf_Wrapper;

/**
 * 植字に関するメソッドのラッパー
 */
trait Pdf_Wrapper_Typesetting
{
	/**
	 * カーソルを基準に矩形内に植字するメソッド Cell($w,$h, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function Cell($args = array())
	{
		$h                 = $this->get_argument('Cell.h'                 , $args);
		$w                 = $this->get_argument('Cell.w'                 , $args);
		$txt               = $this->get_argument('Cell.txt'               , $args);
		$border            = $this->get_argument('Cell.border'            , $args);
		$ln                = $this->get_argument('Cell.ln'                , $args);
		$align             = $this->get_argument('Cell.align'             , $args);
		$fill              = $this->get_argument('Cell.fill'              , $args);
		$link              = $this->get_argument('Cell.link'              , $args);
		$stretch           = $this->get_argument('Cell.stretch'           , $args);
		$ignore_min_height = $this->get_argument('Cell.ignore_min_height' , $args);
		$calign            = $this->get_argument('Cell.calign'            , $args);
		$valign            = $this->get_argument('Cell.valign'            , $args);
		
		$this->tcpdf->Cell($w,$h, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign);
	}
	
	/**
	 * カーソルを基準に植字するメソッド  のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function Write($args = array())
	{
		$h          = $this->get_argument('Write.h'          , $args);
		$txt        = $this->get_argument('Write.txt'        , $args);
		$link       = $this->get_argument('Write.link'       , $args);
		$fill       = $this->get_argument('Write.fill'       , $args);
		$align      = $this->get_argument('Write.align'      , $args);
		$ln         = $this->get_argument('Write.ln'         , $args);
		$stretch    = $this->get_argument('Write.stretch'    , $args);
		$firstline  = $this->get_argument('Write.firstline'  , $args);
		$firstblock = $this->get_argument('Write.firstblock' , $args);
		$maxh       = $this->get_argument('Write.maxh'       , $args);
		$wadj       = $this->get_argument('Write.wadj'       , $args);
		$margin     = $this->get_argument('Write.margin'     , $args);
		
		$this->tcpdf->Write($h, $txt, $link, $fill, $align, $ln, $stretch, $firstline, $firstblock, $maxh, $wadj, $margin);
	}
}