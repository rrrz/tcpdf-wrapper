<?php
namespace Tcpdf_Wrapper;

require_once(VENDORPATH.'tecnick.com/tcpdf/tcpdf.php');

/**
 * PDF生成クラス
 */
class Pdf
{
	use Pdf_Function;
	use Pdf_Http;
	use Pdf_Offset;
	use Pdf_Wrapper;
	use Pdf_Wrapper_Graphic;
	use Pdf_Wrapper_Font;
	use Pdf_Wrapper_Output;
	use Pdf_Wrapper_Pagesetting;
	use Pdf_Wrapper_Positioning;
	use Pdf_Wrapper_Typesetting;
	
	
	/**
	 * Configファイルの名前（拡張子抜き）
	 */
	protected static $config_filename = 'pdf';
	
	/**
	 * config内パラメータ情報のキー
	 */
	protected static $key_offset = '__offset';
	protected static $key_args   = '__args';
	
	/**
	 * Configファイル
	 * 
	 * 第一層のキーで以下のように分類されています
	 *  (1)'master': config/pdf.phpの内容を改変することなく全て格納
	 *  (2)'current': (1)の配列で'default'以下に定義されたデフォルト値と、'views'以下で個別の各view階層に定義された設定値との継承関係の解決されたマージ
	 */
	protected $config = array();
	
	/**
	 * @var object TCPDFオブジェクト
	 */
	protected $tcpdf = null;
	
	/**
	 * @var string PDFソース
	 */
	protected $pdf_source = null;
	
	/**
	 * 現在呼び出しているviewのパス
	 */
	protected $current_path = array();
	
	/**
	 * 呼び出し先viewのパスを管理するスタック
	 */
	protected $call_stack = array();
	
	/**
	 * 同一view内においてデフォルトで実行するメソッド
	 */
	protected $default_exec = array();


	/**
	 * コンストラクタ
	 */
	public function __construct($args = array())
	{
		\Config::load(self::$config_filename, true);
	
		$this->config['master'] = \Config::get(self::$config_filename, array());
		
		$this->load_config();
		
		$this->create_TCPDF($args);
	}

	/**
	 * TCPDFオブジェクトの生成
	 * 
	 * @param array $args TCPDFのコンストラクタ引数を格納した配列
	 */
	public function create_TCPDF($args = array())
	{
		$orientation = $this->get_argument('TCPDF.orientation', $args);
		$unit =        $this->get_argument('TCPDF.unit'       , $args);
		$format =      $this->get_argument('TCPDF.format'     , $args);
		$unicode =     $this->get_argument('TCPDF.unicode'    , $args);
		$encoding =    $this->get_argument('TCPDF.encoding'   , $args);
		
		$this->tcpdf = new \TCPDF( $orientation, $unit, $format, $unicode, $encoding );
		
		return $this->tcpdf;
	}

	/**
	 * TCPDFオブジェクトの取得
	 * 
	 * @return object TCPDFオブジェクト
	 */
	public function get_TCPDF()
	{
		return $this->tcpdf;
	}
	
	/**
	 * viewに記述されたレイアウトメソッドの実行
	 * 
	 * @param string $view_path スラッシュまたはドット区切りのviewファイルへのパス(例： 'views/pdf/welcome', 'views.pdf.welcome')
	 * @param array  $data      viewファイルに渡すデータを格納した配列
	 * @return bool             viewファイルへのパスが渡されなかった場合にはfalse
	 */
	public function render($view_path = '', $data = array())
	{
		if (!$view_path){ return false; }
		
		// 呼び出し元のパスとデフォルトメソッドをスタックに退避
		array_push($this->call_stack, array('path' => $this->current_path, 'default_exec' => $this->default_exec));
		
		// 読み込むviewのパスを正規化して保存
		$view_path = str_replace('.', '/', $view_path);
		
		$this->current_path = $view_path;
		
		// 読み込むviewのconfigをロード
		$this->load_config($view_path);
		
		// viewのレンダ
		render($view_path, $data);
		
		// 呼び出し元viewのデータ復元
		$caller = array_pop($this->call_stack);
		
		$this->current_path = $caller['path'];
		$this->default_exec = $caller['default_exec'];
		
		// 呼び出し元viewのconfigをロード
		$this->load_config($this->current_path);
		
		return true;
	}
	
	/**
	 * 被ラップメソッドを実行する
	 * 
	 * @param array $args 被ラップメソッド名のキーで区分けされた引数リスト
	 */
	public function apply($args = array())
	{
		// オフセットの適用
		$args = $this->offset($args);
		
		// デフォルト実行メソッドの呼び出し
		foreach ($this->default_exec as $method_name => $method_args){
			$this->$method_name($method_args);
		}
		
		// 被ラップメソッドの実行順序を調整
		$ordered_methods = $this->get_orderd_methods(array_keys($args));
		
		// 被ラップメソッドの実行
		foreach ($ordered_methods as $method_name){
			$this->$method_name(array($method_name => $args[$method_name]));
		}
	}
	
	/**
	 * デフォルトメソッドを登録する
	 * 
	 * viewページ内において、apply()による被ラップメソッドの実行前に毎回呼び出されるメソッドを登録する
	 * 
	 * @param array $args 被ラップメソッド名のキーで区分けされた引数リスト
	 */
	public function set_default($args = array())
	{
		$this->default_exec = \Arr::merge($this->default_exec, $args);
	}


	/**
	 * Configファイル内の設定値のロード
	 *
	 * @param string $view_path viewファイルへのパス
	 */
	protected function load_config($view_path = '')
	{
		$config_default = \Arr::get($this->config, 'master.default');
		
		if ($view_path){
			
			// viewファイルの個別設定を読み込み
			$this->config['current'] = $this->get_resolved_params($view_path);
	
		} else {
			
			// configのデフォルト値を読み込み
			$this->config['current'] = $config_default;
			
			// 全体オフセット量をデフォルト値で初期化
			$this->config['global_offset'] = \Arr::get($this->config, 'master.global_offset');
		}
	}

	/**
	 * 継承関係の解決された設定値を取得
	 *
	 * @param string $view_path viewファイルへのパス
	 * @return array            configファイルのviewノード以下の設定値を格納した配列
	 */
	protected function get_resolved_params($view_path = '')
	{
		$path_elems = explode('/', $view_path);
	
		$params = array();
	
		// viewファイルごとのconfigを深層から上に向かって繰り返しマージ
		while (!empty($path_elems)){
	
			$path = implode('.', $path_elems);
	
			$params_mergee = $this->get_exact_params('master.views.'.$path);
	
			$params = \Arr::merge($params_mergee, $params);
	
			array_pop($path_elems);
		}
		
		// デフォルト値とのマージにより定義されていない個別設定値を補完
		$params_mergee = $this->get_exact_params('master.default');
	
		$params = \Arr::merge($params_mergee, $params);
	
		return $params;
	}
	
	/**
	 * パラメータ情報のみを抽出
	 * 
	 * @param  string $path パラメータ格納先の親パス
	 * @return array        パラメータ情報
	 */
	protected function get_exact_params($path = '')
	{
		$params = array();
		
		$params[self::$key_offset] = \Arr::get($this->config, $path.'.'.self::$key_offset, array());
		$params[self::$key_args]   = \Arr::get($this->config, $path.'.'.self::$key_args, array());
		
		return $params;
	}
}

