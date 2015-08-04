# TCPDF-Wrapper

* Version: 1.0

## Information

* PHP >= 5.4
* FuelPHP = 1.7/master

## Description

TCPDFの機能をラップし、以下の機能を提供します。

・MVCモデルに準拠したPDFの生成プロセス
・config内設定値の下層への継承 
・出力位置オフセット
・TCPDFメソッドの一括呼び出し
・毎実行時のデフォルトメソッド登録


## Install

(1) パッケージのインストール

■ gitリポジトリよりクローンする場合

	git clone https://github.com/rrrz/tcpdf-wrapper fuel/packages/tcpdf-wrapper
	
■ composerによりインストールする場合

composer.jsonに以下を追記

	"require": {
		"tcpdf-wrapper": "1.*"
	},
	{
		"type":"package",
		"package":{
			"name":"tcpdf-wrapper",
			"type":"fuel-package",
			"version":"1.0",
			"source":{
				"type":"git",
				"url":"https://github.com/rrrz/tcpdf-wrapper.git",
				"reference":"master"
			}
		}
		
		"require":{
			"tecnick.com/tcpdf": ">=6.0"
		}
	}

インストール

	composer.phar install
	composer.phar update

(2) configの設定

	vi fuel/app/config.php

		// オートローダに登録
		always_load => array(
			packages => 'tcpdf-wrapper',
		),
		
		// サニタイズ対象から除外
		'security' => array(
			'whitelisted_classes' => array(
				'Pdf',
			),
		),

## Usage

### Controller

	class Controller_Pdf extends Controller_Template
	{
		public function before(){}
	
		public function action_welcome()
		{
			// TCPDF-Wrapperオブジェクトの生成
			// ※ クラス名は "Pdf" となります。
			$pdf = new Pdf();
			
			// 印字に用いる情報の取得
			$model = null;
			// $model = Model_Xxx('first');
			
			// viewに渡すTCPDF-Wrapperオブジェクトと印字情報を格納
			$data = array('pdf' => $pdf);
			
			// viewのパスとデータを渡してviewファイル描画メソッドを実行
			$pdf->render('pdf/welcome', $data);
			
			// TCPDF-Wrapperオブジェクトに記録されたレイアウトをPDFに出力
			// ※ このとき同時にオブジェクト内にPDFソースがバッファされます。
			$pdf->Output();
			
			// バッファされたPDFソースを用いてHTTPレスポンスを作成
			return $pdf->forge_response();
		}
	}

### View

#### views/pdf/welcome.php

	// config/pdf.phpのviews/welcome以下に書かれたオフセット設定値にオフセット量を追加
	$pdf->set_offset( 0, 60 );
	
	// ページ設定と新規作成
	$pdf->apply(array(
		// 指定した引数がconfigの値より優先される
		'AddPage'          => array( 'orientation' => 'P', 'format'=> 'A4' ),
		'SetMargins'       => array( 'left'=> 10, 'top' => 10, 'right' => 10 ),
		
		// 引数なしで呼び出すとデフォルト値で実行される
		'setPrintHeader'   => array(),
		'setPrintFooter'   => array(),
	));
	
	// apply()の毎呼び出し時に事前に実行するTCPDFメソッドを登録
	$pdf->set_default(array(
		// メソッド実行ごとにフォントスタイルとサイズがリセットされる
		'SetFont' => array( 'style' => '', 'size' => 16 ),
	));
	
	// 植字
	$pdf->apply(array(
		'SetXY'       => array( 'x' => 60.0, 'y' => 30.0 ),
		'SetFontSize' => array( 'size' => 30 ),
		'Write'       => array( 'txt' => 'That\'s very Hogehuga.' ),
	));
	$pdf->apply(array(
		'SetXY'       => array( 'x' => 150.0, 'y' => 170.0 ),
		'Write'       => array( 'txt' => 'public domain' ),
	));
	
	// 図形描画
	$pdf->apply(array(
		'Line'  => array( 'x1' => 30, 'y1' => 30, 'x2' => 50, 'y2' => 50 ),
		'Curve' => array( 'x0' => 30, 'y0' => 30, 'x1' => 50, 'y1' => 30, 'x2' => 50, 'y2' => 50, 'x3' => 30, 'y3' => 80 ),
	));


	
### Config

パラメータの使用優先順位は以下の通りです。

	(package/tcpdf-wrapper/confg/pdf.php) < (app/config/pdf.php) < (ラッパーメソッドに渡した引数)

#### app/config/pdf.php

(1) 第1層目
■ 'global_offset'キーで全体オフセット量を定義します。
■ 'views'キーの下に各viewファイル別の設定値を、viewファイルのツリーと同構造で定義します。

(2) viewファイルを示すキーの直下
■ '__offset'キーで用紙別のオフセット量を定義します。
■ '__args'キー以下に、TCPDFのメソッドと同名のキーで配列を分け、それぞれの下に引数名と引数値をキーと値で定義します。
■ より下層のviewファイル名をキーで定義します。

※ 'global_offset'の全体オフセット値、 'views/..'で示されるviewファイルパス、 '__offet'および'__args'で示されるパラメータ情報とキーが衝突しなければ任意の設定情報をconfig内に定義しても問題ありません。

	return array(
		// 全体オフセット値
		// ※ viewファイルからset_global_offset($x, $y)により更新可能です。
		//   その際render()によりconfigの再読み込みが行われても、TCPDF-Wrapperオブジェクトが破棄されるまでリセットされません。
		'global_offset' => array(
			'x' => 0.0,
			'y' => 0.0,
		),
	
		'views' => array(
			'pdf' => array(
			
				// views/pdf/welcome.php の設定情報
				'welcome' => array(
				
					// 用紙別のオフセット値
					// ※ viewファイルからset_offset($x, $y)により更新可能です。
					'__offset' => array(
						'x' => 0.0,
						'y' => 0.0,
					),
					
					// 用紙別の各TCPDFメソッドの引数
					// ※ apply()による引数指定がない場合はこの値が用いられます。
					//   こことapply()引数のどちらにも引数指定がない場合は、package/tcpdf-wrapper/config/pdf.phpのデフォルト値が用いられます。
					'__args' => array(
						'AddPage' => array(
							'orientation' => 'L',
							'format'      => 'A1',
						),
						'Output' => array(
							'name' => 'welcome_to_the_world.pdf',
						),
						'SetFont' => array(
							'family'   => 'kozgopromedium',
							'style'    => '',
							'size'     => 11,
						),
						'SetFontSize' => array(
							'size' => 11,
						),
						'setPrintHeader' => array(
							'val' => false,
						),
						'setPrintFooter' => array(
							'val' => false,
						),
					),
					
					// views/pdf/welcome/here.php の設定値です
					// ※ これ以下の設定は上層のwelcome.phpまでの値をデフォルトとして引き継ぎます。
					'here' => array(),
				),
				// views/pdf/seeya.php の設定値です
				'seeya' => array(),
			),
		),
	);



## License

MIT License

