<?php
namespace Tcpdf_Wrapper;

/**
 * ラッパーメソッド群の管理
 */
trait Pdf_Wrapper
{
	/**
	 * メソッドの実行優先順序
	 * 
	 * ここに定義されていないメソッドはapply()で実行されません
	 */
	protected $call_priority = array(
		'setPrintHeader',
		'setPrintFooter',
		'SetMargins',
		'SetTopMargin',
		'SetLeftMargin',
		'SetRightMargin',
		'SetAutoPageBreak',
		'AddPage',
		'SetFont',
		'SetFontSize',
		'setFontSpacing',
		'setFontStretching',
		'SetXY',
		'SetY',
		'SetX',
		'Cell',
		'Write',
		'Line',
		'Curve',
	);
	
	/**
	 * 実行する被ラップメソッドを優先度に従ってソートする
	 * 
	 * @param  array $unorderd_methods ソートされていないメソッドリスト
	 * @return array                   ソートされたメソッドリスト
	 */
	protected function get_orderd_methods($unorderd_methods = array())
	{
		// AND演算後も第一引数に渡された配列の順序は保存される
		return array_intersect($this->call_priority, $unorderd_methods);
	}
}