<?php
namespace Tcpdf_Wrapper;

/**
 * フォントに関するメソッドのラッパー
 */
trait Pdf_Wrapper_Font
{
	/**
	 * フォントを指定するメソッド SetFont($family, $style, $size, $fontfile, $subset, $out) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetFont($args = array())
	{
		$family   = $this->get_argument('SetFont.family'  , $args);
		$style    = $this->get_argument('SetFont.style'   , $args);
		$size     = $this->get_argument('SetFont.size'    , $args);
		$fontfile = $this->get_argument('SetFont.fontfile', $args);
		$subset   = $this->get_argument('SetFont.subset'  , $args);
		$out      = $this->get_argument('SetFont.out'     , $args);
		
		$this->tcpdf->SetFont($family, $style, $size, $fontfile, $subset, $out);
	}
	
	/**
	 * フォントサイズを指定するメソッド SetFontSize($size, $out) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetFontSize($args = array())
	{
		$size = $this->get_argument('SetFontSize.size', $args);
		$out  = $this->get_argument('SetFontSize.out' , $args);
		
		$this->tcpdf->SetFontSize($size, $out);
	}
	
	/**
	 * 文字間隔を指定するメソッド setFontSpacing($spacing) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function setFontSpacing($args = array())
	{
		$spacing = $this->get_argument('setFontSpacing.spacing', $args);
		
		$this->tcpdf->setFontSpacing($spacing);
	}
	
	/**
	 * 文字の伸縮を指定するメソッド setFontStretching($perc) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function setFontStretching($args = array())
	{
		$perc = $this->get_argument('setFontStretching.perc', $args);
		
		$this->tcpdf->setFontStretching($perc);
	}
}