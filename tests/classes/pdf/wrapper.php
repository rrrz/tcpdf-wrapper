<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper
 * 
 * @group Package
 * @group PackageTcpdfwrapper
 * @group PackageTcpdfwrapperClasses
 * @group PackageTcpdfwrapperClassesPdf
 */
class Test_Pdf_Wrapper extends \TestCase
{
	use Share_funcs;
	
	/**
	 * 実行する被ラップメソッドを優先度に従ってソートするメソッド get_orderd_methods($unorderd_methods = array()) のテスト
	 * 
	 * [概要]
	 *  ・引数で渡したメソッド名のリストが定義されている優先順位に従ってソートされる。
	 *  ・ソート後に返却された配列に含まれるのは渡したリストに含まれるメソッドのみである。
	 *
	 * @test
	 */
	public function get_orderd_methods()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'get_orderd_methods');
		
		
		// ■渡したリストがソートされる
		
		// 優先度に従わない並び順でメソッドリストを定義する
		$unordered_methods = array(
			'SetY',
			'Curve',
			'SetAutoPageBreak',
			'Line',
			'SetFont',
			'Write',
			'Cell',
			'SetX',
			'AddPage',
		);
		
		// メソッドを実行
		$result = $method->invokeArgs($pdf, array($unordered_methods));
		
		// 返却値のキー番号を振りなおす(PHP5.6時点のarray_merge()の仕様では順番は変わらないようです)
		$result = array_merge($result);
		
		// 並び替えが行われていることを確認
		$this->assertEquals(array(
			'SetAutoPageBreak',
			'AddPage',
			'SetFont',
			'SetY',
			'SetX',
			'Cell',
			'Write',
			'Line',
			'Curve',
		), $result);
	}
}