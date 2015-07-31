<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper_Pagesetting
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
class Test_Pdf_Wrapper_Pagesetting extends \TestCase
{
	use Share_funcs;
	
	/**
	 * ページを作成するメソッド AddPage($orientation, $format, $keepmargins, $tocpage) のラッパーのテスト
	 *
	 * @test
	 */
	public function AddPage($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('AddPage'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'AddPage');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('AddPage')
		->with('arg1', 'arg2', 'arg3', 'arg4');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'AddPage' => array(
				'orientation' => 'arg1',
				'format'      => 'arg2',
				'keepmargins' => 'arg3',
				'tocpage'     => 'arg4' ,
		))));
	}
	
	/**
	 * 自動改ページ実行を指定するメソッド SetAutoPageBreak($auto, $margin) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetAutoPageBreak($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetAutoPageBreak'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetAutoPageBreak');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetAutoPageBreak')
		->with('arg1', 'arg2');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetAutoPageBreak' => array(
				'auto'  => 'arg1',
				'margin'=> 'arg2',
		))));
	}
	
	/**
	 * 余白を指定するメソッド SetMargins($left, $top, $right, $keepmargins) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetMargins($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetMargins'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetMargins');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetMargins')
		->with('arg1', 'arg2', 'arg3', 'arg4');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetMargins' => array(
				'left'        => 'arg1',
				'top'         => 'arg2',
				'right'       => 'arg3',
				'keepmargins' => 'arg4',
		))));
	}
	
	/**
	 * 印刷フッタの有無を指定するメソッド setPrintFooter($val) のラッパーのテスト
	 *
	 * @test
	 */
	public function setPrintFooter($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('setPrintFooter'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'setPrintFooter');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('setPrintFooter')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'setPrintFooter' => array(
				'val' => 'arg1',
		))));
	}
	
	/**
	 * 印刷ヘッダの有無を指定するメソッド setPrintHeader($val) のラッパーのテスト
	 *
	 * @test
	 */
	public function setPrintHeader($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('setPrintHeader'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'setPrintHeader');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('setPrintHeader')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'setPrintHeader' => array(
				'val' => 'arg1',
		))));
	}
	
	/**
	 * 余白（左）を指定するメソッド SetLeftMargin($margin) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetLeftMargin($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetLeftMargin'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetLeftMargin');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetLeftMargin')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetLeftMargin' => array(
				'margin' => 'arg1',
		))));
	}
	
	/**
	 * 余白（右）を指定するメソッド SetRightMargin($margin) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetRightMargin($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetRightMargin'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetRightMargin');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetRightMargin')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetRightMargin' => array(
				'margin' => 'arg1',
		))));
	}
	
	/**
	 * 余白（上）を指定するメソッド SetTopMargin($margin) のラッパーのテスト
	 *
	 * @test
	 */
	public function SetTopMargin($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('SetTopMargin'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'SetTopMargin');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれるアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('SetTopMargin')
		->with('arg1');
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$method->invokeArgs($pdf, array(array(
			'SetTopMargin' => array(
				'margin' => 'arg1',
		))));
	}
}