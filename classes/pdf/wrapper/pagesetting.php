<?php
namespace Tcpdf_Wrapper;

/**
 * ページ設置に関するメソッドのラッパー
 */
trait Pdf_Wrapper_Pagesetting
{
	/**
	 * ページを作成するメソッド AddPage($orientation, $format, $keepmargins, $tocpage) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function AddPage($args = array())
	{
		$orientation = $this->get_argument('AddPage.orientation', $args);
		$format      = $this->get_argument('AddPage.format'     , $args);
		$keepmargins = $this->get_argument('AddPage.keepmargins', $args);
		$tocpage     = $this->get_argument('AddPage.tocpage'    , $args);
		
		$this->tcpdf->AddPage($orientation, $format, $keepmargins, $tocpage);
	}
	
	/**
	 * 印刷ヘッダの有無を指定するメソッド setPrintHeader($val) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function setPrintHeader($args = array())
	{
		$val = $this->get_argument('setPrintHeader.val', $args);
		
		$this->tcpdf->setPrintHeader($val);
	}
	
	/**
	 * 印刷フッタの有無を指定するメソッド setPrintFooter($val) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function setPrintFooter($args = array())
	{
		$val = $this->get_argument('setPrintFooter.val', $args);
		
		$this->tcpdf->setPrintFooter($val);
	}
	
	/**
	 * 余白を指定するメソッド SetMargins($left, $top, $right, $keepmargins) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetMargins($args = array())
	{
		$left        = $this->get_argument('SetMargins.left'       , $args);
		$top         = $this->get_argument('SetMargins.top'        , $args);
		$right       = $this->get_argument('SetMargins.right'      , $args);
		$keepmargins = $this->get_argument('SetMargins.keepmargins', $args);
		
		$this->tcpdf-> SetMargins($left, $top, $right, $keepmargins);
	}
	
	/**
	 * 余白（上）を指定するメソッド SetTopMargin($margin) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetTopMargin($args = array())
	{
		$margin = $this->get_argument('SetTopMargin.margin', $args);
		
		$this->tcpdf->SetTopMargin($margin);
	}
	
	/**
	 * 余白（左）を指定するメソッド SetLeftMargin($margin) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetLeftMargin($args = array())
	{
		$margin = $this->get_argument('SetLeftMargin.margin', $args);
		
		$this->tcpdf->SetLeftMargin($margin);
	}
	
	/**
	 * 余白（右）を指定するメソッド SetRightMargin($margin) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetRightMargin($args = array())
	{
		$margin = $this->get_argument('SetRightMargin.margin', $args);
		
		$this->tcpdf->SetRightMargin($margin);
	}
	
	/**
	 * 自動改ページ実行を指定するメソッド SetAutoPageBreak($auto, $margin) のラッパー
	 * 
	 * @param array $args 被ラップメソッドの引数を格納した配列
	 */
	protected function SetAutoPageBreak($args = array())
	{
		$auto   = $this->get_argument('SetAutoPageBreak.auto'  , $args);
		$margin = $this->get_argument('SetAutoPageBreak.margin', $args);
		
		$this->tcpdf->SetAutoPageBreak($auto, $margin);
	}
}