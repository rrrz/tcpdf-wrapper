<?php
namespace Tcpdf_Wrapper;

/**
 * 出力関係のラッパー
 */
trait Pdf_Wrapper_Output
{
	/**
	 * TCPDFオブジェクトからPDFソースを生成するメソッド Output($name, $dest) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 * @return string     PDFソース
	 */
	public function Output($args = array())
	{
		$name = $this->get_argument('Output.name', $args);
		$dest = $this->get_argument('Output.dest', $args);
	
		$this->pdf_source = $this->tcpdf->Output($name, $dest);
	
		return $this->pdf_source;
	}
}