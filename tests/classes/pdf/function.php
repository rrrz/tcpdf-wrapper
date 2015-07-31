<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Function
 * 
 * @group Package
 * @group PackageTcpdfwrapper
 * @group PackageTcpdfwrapperClasses
 * @group PackageTcpdfwrapperClassesPdf
 */
class Test_Pdf_Function extends \TestCase
{
	use Share_funcs;
	
	/**
	 * 引数に渡す値を決定するメソッド get_argument($dotted_name, $args = array()) のテスト
	 * 
	 * [概要]
	 *  ・テスト用の被ラップメソッドを  TestMethod($arg1) としてデフォルト値'default'を定義する。
	 *  ・ラッパーの引数に'arg1'が格納されていればその値が、なければデフォルト値が選択されるることを確認する。
	 *  ・引数のドット区切パスの指定先が存在しなければnullが返却されることを確認する。
	 *
	 * @test
	 */
	public function get_argument()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'get_argument');
		
		// Pdfオブジェクトのconfigに設定値を直接定義する
		$pdf_config->setValue($pdf, array(
			'current' => array(
				'__args' => array(
					'TestMethod' => array(
						'arg1' => 'default'
		)))));
		
		
		// ■渡した引数が選択される
		
		// 引数に'original'を格納してメソッドを実行
		$result = $method->invokeArgs($pdf, array(
			'TestMethod.arg1',
			array(
				'TestMethod' => array(
					'arg1' => 'original',
		))));
		
		// 'original'が返却されることを確認
		$this->assertEquals('original', $result);
		
		
		// ■キー値でのメソッド名や引数名の指定が間違っていればデフォルト値が選択される
		
		// 間違ったメソッド名'IncorrectMethod'を格納してメソッドを実行
		$result = $method->invokeArgs($pdf, array(
			'TestMethod.arg1',
			array(
				'IncorrectMethod' => array(
					'arg1' => 'original',
		))));
		
		// 'default'が返却されることを確認
		$this->assertEquals('default', $result);
		
		// 間違った引数名'arg??'を格納してメソッドを実行
		$result = $method->invokeArgs($pdf, array(
			'TestMethod.arg1',
			array(
				'TestMethod' => array(
					'arg??' => 'original',
		))));
		
		// 'default'が返却されることを確認
		$this->assertEquals('default', $result);
		
		
		// ■ドット区切パスでの指定先が存在しなければnullが返却される
		
		// 間違ったパス'IncorrectMethod.arg1'を格納してメソッドを実行
		$result = $method->invokeArgs($pdf, array(
				'IncorrectMethod.arg1',
				array(
						'TestMethod' => array(
								'arg1' => 'original',
						))));
		
		// 'default'が返却されることを確認
		$this->assertNull($result);
	}
}