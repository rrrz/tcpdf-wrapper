<?php
require_once(PKGPATH.'tcpdf-wrapper/tests/classes/share_funcs.php');

/**
 * test class Pdf_Http
 * 
 * @group App
 * @group AppClasses
 * @group AppClassesPdf
 */
class Test_Pdf_Http extends \TestCase
{
	use Share_funcs;
	
	/**
	 * レスポンスヘッダを生成するメソッド create_header($args) のテスト
	 * 
	 * [概要]
	 *  ・get_argument()により決定されたファイル名が使用される。
	 *  ・配列にヘッダ情報が格納される。
	 *  ・Content-Length情報が正しく格納される。
	 *  ・Last-Modifiedはテスト実行状況により誤差が生じるため割愛する。
	 *
	 * @test
	 */
	public function create_header()
	{
		// ■テストに用いる変数の準備
		
		// Pdfオブジェクトの生成
		$pdf = new Pdf();
		
		// PdfクラスのPDFソース格納用プロパティへのアクセスを取得
		$pdf_source = self::get_accessible_property('Pdf', 'pdf_source');
		
		// ラッパーメソッドのアクセス制限を解除して変数に取得
		$method = self::get_accessible_method('Pdf', 'create_header');
		
		// PdfオブジェクトのPDFソースに10バイト分の文字列を格納する
		$pdf_source->setValue($pdf, '0123456789');
		
		// 引数の配列にファイル名'test.pdf'を格納する
		$args = array(
			'Output' => array(
				'name' => 'test.pdf',
		));
		
		
		// ■引数とPDFソースに従ったヘッダが返却される
		
		// メソッドを実行
		$result = $method->invokeArgs($pdf, array($args));
		
		// Last-Modified以外の情報が正しく格納されていることを確認
		$this->assertArraySubset(array(
			'Content-Type'        => 'application/pdf',
			'Content-Disposition' => 'inline; filename="test.pdf"',
			'Cache-Control'       => 'public, must-revalidate, max-age=0',
			'Content-Length'      => 10,
		), $result);
		
	}
}