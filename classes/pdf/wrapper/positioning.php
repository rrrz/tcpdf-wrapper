<?php
namespace Tcpdf_Wrapper;

/**
 * カーソル位置設置に関するメソッドのラッパー
 */
trait Pdf_Wrapper_Positioning
{
	/**
	 * 紙面上の水平位置を指定するメソッド SetX($x, $rtloff) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetX($args = array())
	{
		$x      = $this->get_argument('SetX.x'     , $args);
		$rtloff = $this->get_argument('SetX.rtloff', $args);
		
		$this->tcpdf->SetX($x, $rtloff);
	}
	
	/**
	 * 紙面上の位置を2次元座標指定するメソッド SetXY($x, $y, $rtloff) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetXY($args = array())
	{
		$x      = $this->get_argument('SetXY.x'     , $args);
		$y      = $this->get_argument('SetXY.y'     , $args);
		$rtloff = $this->get_argument('SetXY.rtloff', $args);
		
		$this->tcpdf->SetXY($x, $y, $rtloff);
	}
	
	/**
	 * 紙面上の垂直位置を指定するメソッド SetY($y, $resetx, $rtloff) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetY($args = array())
	{
		$y      = $this->get_argument('SetY.y'     , $args);
		$resetx = $this->get_argument('SetY.resetx', $args);
		$rtloff = $this->get_argument('SetY.rtloff', $args);
		
		$this->tcpdf->SetY($y, $resetx, $rtloff);
	}
}