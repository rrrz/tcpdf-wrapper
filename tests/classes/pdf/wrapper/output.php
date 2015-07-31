<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Wrapper_Output
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
class Test_Pdf_Wrapper_Output extends \TestCase
{
	use Share_funcs;
	
	/**
	 *  TCPDFオブジェクトからPDFソースを生成するメソッド Output($name, $dest) のラッパーのテスト
	 *
	 * @test
	 */
	public function Output($args = array())
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// TCPDFの被ラップメソッドのモックを作成
		$tcpdf = $this->getMock('TCPDF', array('Output'));
		
		// PdfクラスのTCPDF格納用プロパティへのアクセスを取得
		$prop_tcpdf = self::get_accessible_property('Pdf', 'tcpdf');
		
		// PdfオブジェクトのTCPDFをモックで置換
		$prop_tcpdf->setValue($pdf, $tcpdf);
		
		// PdfクラスのPDFソース格納用プロパティへのアクセスを取得
		$prop_pdf_source = self::get_accessible_property('Pdf', 'pdf_source');
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'Output');
		
		
		// ■指定した引数で被ラップ関数が呼ばれていることを確認
		
		// 被ラップメソッドが対応する引数で一度だけ呼ばれ、文字列'return_string'を返却するアサーションを追加
		$pdf->get_TCPDF()->expects($this->once())->method('Output')
			->with('arg1', 'arg2')
			->will($this->returnCallback(function(){ return 'return_string'; }));;
		
		// ラッパーに渡した引数配列と被ラップメソッドに渡された引数が正しく対応しており、被ラップメソッドが呼ばれていることを確認
		$result = $method->invokeArgs($pdf, array(array(
			'Output' => array(
				'name' => 'arg1',
				'dest' => 'arg2',
		))));
		
		// 返却値が'return_string'であることを確認
		$this->assertEquals('return_string', $result);
		
		// オブジェクト内のPDFソース格納用変数から値を取得
		$result = $prop_pdf_source->getValue($pdf);
		
		// configに格納された値が'return_string'であることを確認
		$this->assertEquals('return_string', $result);
	}
}