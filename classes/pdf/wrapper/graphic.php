<?php
namespace Tcpdf_Wrapper;

/**
 * 線や図形に関するメソッドのラッパー
 */
trait Pdf_Wrapper_Graphic
{
	/**
	 * 曲線を描画するメソッド Curve($x0, $y0, $x1, $y1, $x2, $y2, $x3, $y3, $style, $line_style, $fill_color) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function Curve($args = array())
	{
		$x0         = $this->get_argument('Curve.x0'        , $args);
		$y0         = $this->get_argument('Curve.y0'        , $args);
		$x1         = $this->get_argument('Curve.x1'        , $args);
		$y1         = $this->get_argument('Curve.y1'        , $args);
		$x2         = $this->get_argument('Curve.x2'        , $args);
		$y2         = $this->get_argument('Curve.y2'        , $args);
		$x3         = $this->get_argument('Curve.x3'        , $args);
		$y3         = $this->get_argument('Curve.y3'        , $args);
		$style      = $this->get_argument('Curve.style'     , $args);
		$line_style = $this->get_argument('Curve.line_style', $args);
		$fill_color = $this->get_argument('Curve.fill_color', $args);
		
		$this->tcpdf->Curve($x0, $y0, $x1, $y1, $x2, $y2, $x3, $y3, $style, $line_style, $fill_color);
	}
	
	/**
	 * 直線を描画するメソッド Line($x1, $y1, $x2, $y2, $style) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function Line($args = array())
	{
		$x1    = $this->get_argument('Line.x1'   , $args);
		$y1    = $this->get_argument('Line.y1'   , $args);
		$x2    = $this->get_argument('Line.x2'   , $args);
		$y2    = $this->get_argument('Line.y2'   , $args);
		$style = $this->get_argument('Line.style', $args);
		
		$this->tcpdf->Line($x1, $y1, $x2, $y2, $style);
	}
}