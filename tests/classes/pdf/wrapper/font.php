<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper_Font
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
class Test_Pdf_Wrapper_Font extends \TestCase
{
	use Share_funcs;
	/**
	 * フォントを指定するメソッド SetFont($family, $style, $size, $fontfile, $subset, $out) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetFont()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetFont'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetFont');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetFont')
		->with('arg1', 'arg2', 'arg3', 'arg4', 'arg5', 'arg6');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetFont' => array(
				'family'   => 'arg1',
				'style'    => 'arg2',
				'size'     => 'arg3',
				'fontfile' => 'arg4',
				'subset'   => 'arg5',
				'out'      => 'arg6',
		))));
	}
	
	/**
	 * フォントサイズを指定するメソッド SetFontSize($size, $out) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetFontSize($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetFontSize'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetFontSize');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetFontSize')
		->with('arg1', 'arg2');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetFontSize' => array(
				'size' => 'arg1',
				'out'  => 'arg2',
		))));
	}
	
	/**
	 * 文字間隔を指定するメソッド setFontSpacing($spacing) のラッパーのテスト
	 *
	 * @test
	 */
	public function setFontSpacing($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('setFontSpacing'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'setFontSpacing');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('setFontSpacing')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'setFontSpacing' => array(
				'spacing' => 'arg1',
		))));
	}
	
	/**
	 * 文字の伸縮を指定するメソッド setFontStretching($perc) のラッパーのテスト
	 *
	 * @test
	 */
	public function setFontStretching($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('setFontStretching'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'setFontStretching');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('setFontStretching')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'setFontStretching' => array(
				'perc' => 'arg1',
		))));
	}
}