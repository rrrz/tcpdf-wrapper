<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf
 * 
 * @group App
 * @group AppClasses
 * @group AppClassesPdf
 */
class Test_Pdf extends \TestCase
{
	use Share_funcs;
	
	/**
	 * Configファイル内の設定値のロードするメソッド load_config($view_path = '') のテスト
	 * 
	 * [概要]
	 *  ・パス無しでの実行（インスタンス生成時）ではデフォルト値が読み込まれる
	 *  ・パスを指定して実行すると指定したviewの設定値が反映される
	 *
	 * @test
	 */
	public function load_config()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'load_config');
		
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
		
		// Pdfオブジェクトのconfigにviewファイルの個別設定値を直接定義する
		$pdf_config->setValue($pdf, array(
			'master' => array(
				'global_offset' => array(
				'x' => 1000.0,
				'y' => 2000.0,
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
					),
				),
				'views' => array(	
					'test_index' => array(
						'__offset' => array(
							'x' => 100.0,
							'y' => 200.0,
						),
						'__args' => array(
							'TCPDF' => array(
								'orientation' => 'value1',
								'unit'        => 'value2',
								'format'      => 'value3',
								'unicode'     => 'value4',
								'encoding'    => 'value5',
		)))))));
		
		
		// ■viewファイルへのパスに応じてconfigがロードされる
		
		// パスを用いずにメソッドを実行
		$method->invokeArgs($pdf, array());
		
		// configの内容を取得
		$result = $pdf_config->getValue($pdf);
		
		// デフォルト値が取得されていることを確認
		$this->assertArraySubset(array(
			'global_offset' => array(
				'x' => 1000.0,
				'y' => 2000.0,
			),
			'current' => array(
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
		)))), $result);
		
		// パス'test_index'を用いてメソッドを実行
		$method->invokeArgs($pdf, array('test_index'));

		// configの内容を取得
		$result = $pdf_config->getValue($pdf);
		
		// デフォルト値が取得されていることを確認
		$this->assertArraySubset(array(
			'current' => array(
				'__offset' => array(
					'x' => 100.0,
					'y' => 200.0,
				),
				'__args' => array(
					'TCPDF' => array(
						'orientation' => 'value1',
						'unit'        => 'value2',
						'format'      => 'value3',
						'unicode'     => 'value4',
						'encoding'    => 'value5',
		)))) ,$result);
	}
	
	/**
	 * 継承関係の解決された設定値を取得するメソッド get_resolved_params($view_path = '') のテスト
	 * 
	 * [概要]
	 *  ・パスで指定されたconfigファイル内の定義値を、階層内で下層を優先にマージする。
	 *  ・何も定義されていなくても'defalut'キー以下に定義されたデフォルト値が最も低い優先度で読み込まれる。
	 *
	 * @test
	 */
	public function get_resolved_params()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'get_resolved_params');
		
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
		
		// Pdfオブジェクトのconfigにviewファイルの個別設定値を直接定義する
		$pdf_config->setValue($pdf, array(
			'master' => array(
				'default' => array(
					'__offset' => array(
						'x' => 0.0,
						'y' => 0.0,
					),
					'__args' => array(
						'TCPDF' => array(
							'format1' => 'A0',
							'format2' => 'B0',
							'format3' => 'C0',
							'format4' => 'D0',
						),
					),
				),
				'views' => array(	
					'level_1' => array(
						'__offset' => array(
							'x' => 1.0,
						),
						'__args' => array(
							'TCPDF' => array(
								'format1' => 'A1',
								'format2' => 'B1',
							),
						),
						'level_2' => array(
							'__offset' => array(
								'x' => 2.0,
							),
							'__args' => array(
								'TCPDF' => array(
									'format1' => 'A2',
									'format3' => 'C2',
								),
							),
						),
					),
				),
			),
		));
		
		
		// ■viewファイルへのパスに応じてconfigがロードされる
		
		// パスを用いずにメソッドを実行
		$result = $method->invokeArgs($pdf, array());
		
		// デフォルト値が取得されていることを確認
		$this->assertEquals(array(
			'__offset' => array(
				'x' => 0.0,
				'y' => 0.0,
			),
			'__args' => array(
				'TCPDF' => array(
					'format1' => 'A0',
					'format2' => 'B0',
					'format3' => 'C0',
					'format4' => 'D0',
				),
			),
		), $result);
		
		
		// 1階層目のパスを用いてメソッドを実行
		$result = $method->invokeArgs($pdf, array('level_1'));
		
		// デフォルト値が取得されていることを確認
		$this->assertEquals(array(
			'__offset' => array(
				'x' => 1.0,
				'y' => 0.0,
			),
			'__args' => array(
				'TCPDF' => array(
					'format1' => 'A1',
					'format2' => 'B1',
					'format3' => 'C0',
					'format4' => 'D0',
				),
			),
		), $result);
		

		// 2階層目のパスを用いてメソッドを実行
		$result = $method->invokeArgs($pdf, array('level_1/level_2'));
		
		// デフォルト値が取得されていることを確認
		$this->assertEquals(array(
			'__offset' => array(
				'x' => 2.0,
				'y' => 0.0,
			),
			'__args' => array(
				'TCPDF' => array(
					'format1' => 'A2',
					'format2' => 'B1',
					'format3' => 'C2',
					'format4' => 'D0',
				),
			),
		), $result);
	}
}