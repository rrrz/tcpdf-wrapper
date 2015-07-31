<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Offset
 * 
 * @group App
 * @group AppClasses
 * @group AppClassesPdf
 */
class Test_Pdf_Offset extends \TestCase
{
	use Share_funcs;
	
	/**
	 * オフセットを適用するメソッド offset($args = array()) のテスト
	 * 
	 * [概要]
	 *  ・座標を指定するキーをもつ値のみオフセットされる
	 *
	 * @test
	 */
	public function offset()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'offset');
		
		// Pdfオブジェクトのconfigにオフセット値を直接定義する
		$pdf_config->setValue($pdf, array(
			'global_offset' => array('x' => 110, 'y' => 220),
			'current' => array(
				'__offset' => array('x' => -10, 'y' => -20)
		)));
		

		// ■渡したパラメータがオフセットされる
		
		// 座標を示すキーを含んだ、オフセット対象の配列を作成する
		$positions = array(
				
			// オフセットされるキー
			'coodinate' => array(
				'x'  => 0,
				'x0' => 100,
				'x1' => 1000,
				'x2' => -100,
				'x3' => -1000,
				'y'  => 0,
				'y0' => 200,
				'y1' => 2000,
				'y2' => -200,
				'y3' => -2000,
					
				// 下の階層もオフセット対象になる
				'deeper' => array(
					'x' => 10,
					'y' => 20,
				),
			),
				
			// オフセットされないキー
			'exempt' => array(
				0    => 0,
				'1'  => 0,
				'xx' => 0,
				'xy' => 0,
				'X'  => 0,
			),
		);
		
		// メソッドの実行
		$result = $method->invokeArgs($pdf, array($positions));
		
		// オフセットされていることを確認
		$this->assertEquals(array(
				
			// オフセットされたキー
			'coodinate' => array(
				'x'  => 100,
				'x0' => 200,
				'x1' => 1100,
				'x2' => 0,
				'x3' => -900,
				'y'  => 200,
				'y0' => 400,
				'y1' => 2200,
				'y2' => 0,
				'y3' => -1800,
					
				// 下の階層もオフセットされている
				'deeper' => array(
					'x' => 110,
					'y' => 220,
				),
			),
				
			// オフセットされなかったキー
			'exempt' => array(
				0    => 0,
				'1'  => 0,
				'xx' => 0,
				'xy' => 0,
				'X'  => 0,
			),
		), $result);
	}
	
	/**
	 * viewファイルからオフセット量追加するメソッド set_offset($x = 0.0, $y = 0.0) のテスト
	 * 
	 * [概要]
	 *  ・viewファイルに応じて決定されたオフセット値を変化させる
	 *
	 * @test
	 */
	public function set_offset()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'set_offset');
		
		// Pdfオブジェクトのconfigにオフセット値を直接定義する
		$pdf_config->setValue($pdf, array(
			'current' => array(
				'__offset' => array('x' => -10, 'y' => -20)
		)));
		

		// ■渡したパラメータがオフセットされる
		
		// メソッドの実行
		$method->invokeArgs($pdf, array(110, 220));
		
		// 実行後のconfigファイルを取得する
		$result = $pdf_config->getValue($pdf);
		
		$this->assertEquals(array(
			'current' => array(
				'__offset' => array('x' => 100, 'y' => 200)
		)), $result);
	}
	
	/**
	 * viewファイルから全体オフセット量追加するメソッド set_global_offset($x = 0.0, $y = 0.0) のテスト
	 * 
	 * [概要]
	 *  ・viewファイルに応じて決定された全体オフセット値を変化させる
	 *
	 * @test
	 */
	public function set_global_offset()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'set_global_offset');
		
		// Pdfオブジェクトのconfigにオフセット値を直接定義する
		$pdf_config->setValue($pdf, array(
			'global_offset' => array('x' => -10, 'y' => -20)
		));
		

		// ■渡したパラメータがオフセットされる
		
		// メソッドの実行
		$method->invokeArgs($pdf, array(110, 220));
		
		// 実行後のconfigファイルを取得する
		$result = $pdf_config->getValue($pdf);
		
		$this->assertEquals(array(
			'global_offset' => array('x' => 100, 'y' => 200)
		), $result);
	}
}