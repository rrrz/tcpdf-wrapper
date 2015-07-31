<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper_Typesetting
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
class Test_Pdf_Wrapper_Typesetting extends \TestCase
{
	use Share_funcs;
	
	/**
	 * カーソルを基準に矩形内に植字するメソッド Cell($w,$h, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign) のラッパーのテスト
	 *
	 * @test
	 */
	public function Cell($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('Cell'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'Cell');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('Cell')
		->with('arg1', 'arg2', 'arg3', 'arg4', 'arg5', 'arg6', 'arg7', 'arg8', 'arg9', 'arg10', 'arg11', 'arg12');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'Cell' => array(
				'w'                 => 'arg1',
				'h'                 => 'arg2',
				'txt'               => 'arg3',
				'border'            => 'arg4',
				'ln'                => 'arg5',
				'align'             => 'arg6',
				'fill'              => 'arg7',
				'link'              => 'arg8',
				'stretch'           => 'arg9',
				'ignore_min_height' => 'arg10',
				'calign'            => 'arg11',
				'valign'            => 'arg12',
		))));
	}
	
	/**
	 * カーソルを基準に植字するメソッド  のラッパーのテスト
	 *
	 * @test
	 */
	public function Write($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('Write'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'Write');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('Write')
		->with('arg1', 'arg2', 'arg3', 'arg4', 'arg5', 'arg6', 'arg7', 'arg8', 'arg9', 'arg10', 'arg11', 'arg12');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'Write' => array(
				'h'          => 'arg1',
				'txt'        => 'arg2',
				'link'       => 'arg3',
				'fill'       => 'arg4',
				'align'      => 'arg5',
				'ln'         => 'arg6',
				'stretch'    => 'arg7',
				'firstline'  => 'arg8',
				'firstblock' => 'arg9',
				'maxh'       => 'arg10',
				'wadj'       => 'arg11',
				'margin'     => 'arg12',
		))));
	}
}