<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper_Graphic
 * 
 * このテストケースでは以下の要件をテストします。
 *  (1) ラッパーに渡した引数リストのキーが被ラップメソッドの引数に正しく対応している。
 *  (2) (1)の引数を用いて被ラップメソッドが呼び出される。
 *  
 * テストケース中で用いる引数は、デフォルト値との区別をつけるため全てデフォルトとは異なる値を用いることとします。
 * 
 * @group Package
 * @group PackageTcpdfwrapper
 * @group PackageTcpdfwrapperClasses
 * @group PackageTcpdfwrapperClassesPdf
 * @group PackageTcpdfwrapperClassesPdfWrapper
 */
class Test_Pdf_Wrapper_Graphic extends \TestCase
{
	use Share_funcs;
	
	/**
	 * 曲線を描画するメソッド Curve($x0, $y0, $x1, $y1, $x2, $y2, $x3, $y3, $style, $line_style, $fill_color) のラッパーのテスト
	 *
	 * @test
	 */
	public function Curve($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('Curve'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'Curve');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('Curve')
		->with('arg1', 'arg2', 'arg3', 'arg4', 'arg5', 'arg6', 'arg7', 'arg8', 'arg9', 'arg10', 'arg11');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'Curve' => array(
				'x0'         => 'arg1',
				'y0'         => 'arg2',
				'x1'         => 'arg3',
				'y1'         => 'arg4',
				'x2'         => 'arg5',
				'y2'         => 'arg6',
				'x3'         => 'arg7',
				'y3'         => 'arg8',
				'style'      => 'arg9',
				'line_style' => 'arg10',
				'fill_color' => 'arg11',
		))));
	}

	/**
	 * 直線を描画するメソッド Line($x1, $y1, $x2, $y2, $style) のラッパーのテスト
	 *
	 * @test
	 */
	public function Line()
	{
		// ■テストに用いる変数の準備
	
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
	
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('Line'));
	
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
	
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
	
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'Line');
	
	
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
	
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('Line')
		->with('arg1', 'arg2', 'arg3', 'arg4', 'arg5');
	
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'Line' => array(
				'x1'    => 'arg1',
				'y1'    => 'arg2',
				'x2'    => 'arg3',
				'y2'    => 'arg4',
				'style' => 'arg5',
		))));
	}
}