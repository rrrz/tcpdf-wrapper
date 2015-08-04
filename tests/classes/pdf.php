<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf
 * 
 * @group Package
 * @group PackageTcpdfwrapper
 * @group PackageTcpdfwrapperClasses
 */
class Test_Pdf extends \TestCase
{
	use Share_funcs;


	/**
	 * パラメータ情報のみを抽出するメソッド get_exact_params($path = '') のテスト
	 *
	 * [概要]
	 *  ・パスで指定された階層のviewのパラメータ情報のみが返却される
	 *
	 * @test
	 */
	public function get_exact_params()
	{
		// ■テストに用いる変数の準備
	
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
	
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'get_exact_params');
	
		// Pdfクラスのconfig格納用プロパティへのアクセスを取得
		$pdf_config = self::get_accessible_property('Pdf', 'config');
	
		// Pdfオブジェクトのconfigにviewファイルの個別設定値を直接定義する
		$pdf_config->setValue($pdf, array(
			'master' => array(
				'views' => array(
					'level_1' => array(
						'__offset' => array(
							'x' => 0.0,
						),
						'__args' => array(
							'TCPDF' => array(
								'format1' => 'A0',
							),
						),
						'level_2' => array(
							'__offset' => array(
								'x' => 20.0,
							),
						),
					),
				),
			),
		));
	
	
		// ■指定されたviewファイルだけのパラメータがロードされる
	
		// 1階層目のパスを用いてメソッドを実行
		$result = $method->invokeArgs($pdf, array('master.views.level_1'));
	
		// デフォルト値が取得されていることを確認
		$this->assertEquals(array(
				'__offset' => array(
						'x' => 0.0,
				),
				'__args' => array(
						'TCPDF' => array(
								'format1' => 'A0',
						),
				),
		), $result);
	
	
		// 2階層目のパスを用いてメソッドを実行
		$result = $method->invokeArgs($pdf, array('master.views.level_1.level_2'));
	
		// デフォルト値が取得されていることを確認
		$this->assertEquals(array(
				'__offset' => array(
						'x' => 20.0,
				),
				'__args' => array(),
		), $result);
	}
	
	/**
	 * 継承関係の解決された設定値を取得するメソッド get_resolved_params($view_path = '') のテスト
	 * 
	 * [概要]
	 *  ・パスで指定されたconfigファイル内の定義値を、階層内で下層を優先にマージする。
	 *  ・何も定義されていなくても'defalut'キー以下に定義されたデフォルト値が最も低い優先度で読み込まれる。
	 *
	 * @test
	 * @depends get_exact_params
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

	/**
	 * Configファイル内の設定値のロードするメソッド load_config($view_path = '') のテスト
	 *
	 * [概要]
	 *  ・パス無しでの実行（インスタンス生成時）ではデフォルト値が読み込まれる
	 *  ・パスを指定して実行すると指定したviewの設定値が反映される
	 *
	 * @test
	 * @depends get_exact_params
	 * @depends get_resolved_params
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
	 * デフォルトメソッドを登録するメソッド set_default($args = array()) のテスト
	 *
	 * [概要]
	 *  ・デフォルトメソッド格納用変数に、元々登録されているものとのマージを格納する
	 *
	 * @test
	 */
	public function set_default()
	{
		// ■テストに用いる変数の準備
	
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
	
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'set_default');
	
		// Pdfクラスのデフォルトメソッド格納用プロパティへのアクセスを取得
		$default_exec = self::get_accessible_property('Pdf', 'default_exec');
	
		// ■メソッドの実行により情報が格納されていることを確認
		
		// メソッドの実行 ・・・ (1)
		$pdf->set_default(array(
			'1st_method' => array(
				'arg1' => 1,
				'arg2' => 2,
			),
		));
		
		// 格納内容の取得
		$data = $default_exec->getValue($pdf);
		
		// (1)で格納された値が入っていることを確認
		$this->assertEquals(array(
			'1st_method' => array(
				'arg1' => 1,
				'arg2' => 2,
		)), $data);
		
	
		// ■メソッドの実行により元々存在する情報と新たな情報がマージされていることを確認
		
		// メソッドの実行 ・・・ (2)
		$pdf->set_default(array(
			'2nd_method' => array(
				'arg3' => 3,
				'arg4' => 4,
			),
		));
		
		// 格納内容の取得
		$data = $default_exec->getValue($pdf);
		
		// (2)で格納された値が入っていることを確認
		$this->assertEquals(array(
			'1st_method' => array(
				'arg1' => 1,
				'arg2' => 2,
			),
			'2nd_method' => array(
				'arg3' => 3,
				'arg4' => 4,
			),
		), $data);
	}

	/**
	 * 被ラップメソッドを実行するメソッド apply($args = array()) のテスト
	 * 
	 * [概要]
	 *  ・被ラップメソッドの実行前にデフォルトメソッドが呼び出される
	 *  ・引数で指定したメソッドが全て実行される
	 *
	 * @test
	 */
	public function apply()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'apply');
		
		// ラッパーメソッドのモックを作成
		$pdf = $this->getMock('Pdf', array('SetFont', 'Cell'));
	
	
		// ■指定した引数でラッパーが呼ばれていることを確認
		
		// ラッパーが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->expects($this->once())->method('SetFont')->with(array(
			'SetFont' => array('arg_setfont'),
		));
		$pdf->expects($this->once())->method('Cell')->with(array(
			'Cell'    => array('arg_cell'),
		));
	
		// ラッパーがそれぞれ一回ずつ呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetFont' => array('arg_setfont'),
			'Cell'    => array('arg_cell'),
		)));
	}

	/**
	 * viewに記述されたレイアウトメソッドを実行するメソッド render($view_path = '', $data = array()) のテスト
	 * 
	 * [概要]
	 *  ・実行直前のconfig,viewへのパス,デフォルトメソッドが復元される
	 *  ・viewへのパスが指定されていることをチェックする
	 *
	 * @test
	 */
	public function render()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'render');
		
		// Pdfクラスのviewパス格納用プロパティへのアクセスを取得
		$current_path = self::get_accessible_property('Pdf', 'current_path');
		
		// Pdfクラスのデフォルトメソッド格納用プロパティへのアクセスを取得
		$default_exec = self::get_accessible_property('Pdf', 'default_exec');
		
		// 現在のviewへのパスを模擬的に設定
		$current_path->setValue($pdf, 'views/current');
		
		// 現在のviewに対するデフォルトメソッドを模擬的に設定
		$default_exec->setValue($pdf, array(
			'SetFont' => array('arg_setfont'),
			'Cell'    => array('arg_cell'),
		));
		
		
		// ■viewへのパスを指定しなかった場合
		
		// メソッドを実行
		$result = $method->invokeArgs($pdf, array());
		
		// 結果がfalseであることを確認
		$this->assertFalse($result);
		
		
		// ■viewへのパスを指定した場合
		
		// メソッドを実行
		$result = $method->invokeArgs($pdf, array('', array('pdf'=>$pdf)));
		
		// viewへのパスが実行前と同じであることを確認
		$this->assertEquals('views/current', $current_path->getValue($pdf));
		
		// デフォルトメソッドが実行前と同じであることを確認
		$this->assertEquals(array(
			'SetFont' => array('arg_setfont'),
			'Cell'    => array('arg_cell'),
		), $default_exec->getValue($pdf));
	}
}