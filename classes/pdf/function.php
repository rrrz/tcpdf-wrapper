<?php
namespace Tcpdf_Wrapper;

/**
 * パッケージ内機能
 */
trait Pdf_Function
{
	/**
	 * 引数に渡す値の決定
	 *
	 * ラッパーの仮引数の配列に被ラップメソッドの引数が定義されていればそれを用い、定義されていなければconfigのデフォルト値を読み込む。
	 *
	 * @param string $dotted_name config内に定義されたメソッド名から始まるドット区切りで指定された引数名 (例： 'Cell.align')
	 * @param array  $args        ラッパーに渡された被ラップメソッドの仮引数リスト
	 * @return mixed              引数の値
	 */
	protected function get_argument($dotted_name, $args = array())
	{
		$value = \Arr::get($args, $dotted_name, \Arr::get($this->config, 'current.'.self::$key_args.'.'.$dotted_name));
	
		return $value;
	}
}