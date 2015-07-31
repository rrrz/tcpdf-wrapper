<?php
namespace Tcpdf_Wrapper;

/**
 * HTTP通信関係の機能
 */
trait Pdf_Http
{
	/**
	 * HTTPレスポンスの生成
	 * 
	 * @param  array  $args 被ラップメソッドの引数を格納した配列
	 * @return object       Responseオブジェクト
	 */
	public function forge_response($args = array())
	{
		$header = $this->create_header($args);
		
		$response = \Response::forge($this->pdf_source, 200, $header);
		
		return $response;
	}
	
	/**
	 * レスポンスヘッダの生成
	 * 
	 * @return object Responseオブジェクト
	 */
	protected function create_header($args)
	{
		$output_name = $this->get_argument('Output.name', $args);
		
		$header = array(
			'Content-Type'        => 'application/pdf',
			'Content-Disposition' => 'inline; filename="'.$output_name.'"',
			'Cache-Control'       => 'public, must-revalidate, max-age=0',
			'Last-Modified'       => gmdate('D, d M Y H:i:s').' GMT',
		);
		
		if (!isset($_SERVER['HTTP_ACCEPT_ENCODING'])){
			$header['Content-Length'] = strlen($this->pdf_source);
		}
		
		return $header;
	}
}

