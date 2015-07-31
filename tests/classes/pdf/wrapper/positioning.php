<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper_Positioning
 * 
 * このテストケースでは以下の要件をテストします。
 *  (1) ラッパーに渡した引数リストのキーが被ラップメソッドの引数に正しく対応している。
 *  (2) (1)の引数を用いて被ラップメソッドが呼び出される。
 *  
 * テストケース中で用いる引数は、デフォルト値との区別をつけるため全てデフォルトとは異なる値を用いることとします。
 * 
 * @group App
 * @group AppClasses
 * @group AppClassesPdf
 * @group AppClassesPdfWrapper
 */
class Test_Pdf_Wrapper_Positioning extends \TestCase
{
	use Share_funcs;
	
	/**
	 * 紙面上の水平位置を指定するメソッド SetX($x, $rtloff) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetX($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetX'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetX');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetX')
		->with('arg1', 'arg2');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetX' => array(
				'x'      => 'arg1',
				'rtloff' => 'arg2', 
		))));
	}
	
	/**
	 * 紙面上の位置を2次元座標指定するメソッド SetXY($x, $y, $rtloff) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetXY($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetXY'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetXY');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetXY')
		->with('arg1', 'arg2', 'arg3');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetXY' => array(
				'x'      => 'arg1',
				'y'      => 'arg2',
				'rtloff' => 'arg3', 
		))));
	}
	
	/**
	 * 紙面上の垂直位置を指定するメソッド SetY($y, $resetx, $rtloff) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetY($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetY'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetY');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetY')
		->with('arg1', 'arg2', 'arg3');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetY' => array(
				'y'      => 'arg1',
				'resetx' => 'arg2',
				'rtloff' => 'arg3', 
		))));
	}
}