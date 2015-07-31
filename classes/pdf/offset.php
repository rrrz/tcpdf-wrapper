<?php
namespace Tcpdf_Wrapper;

/**
 * オフセット関係の機能
 */
trait Pdf_Offset
{	
	/**
	 * オフセットの適用
	 * 
	 * 引数を格納する配列をスキャンし、2次元座標を示すキーの格納値のすべてに加算処理を行う
	 * 
	 * @param array $args 被ラップメソッド名のキーで区分けされた引数リスト
	 * @return array      オフセット適用後の引数リスト
	 */
	protected function offset($args = array())
	{
		array_walk_recursive($args, function(&$val, $key){
			
			if (in_array($key, array('x', 'x0', 'x1', 'x2', 'x3')) && $key){
				
				$val += \Arr::get($this->config, 'current.'.self::$key_offset.'.x'      , 0.0);
				$val += \Arr::get($this->config, 'global_offset.x', 0.0);
				
			} elseif (in_array($key, array('y', 'y0', 'y1', 'y2', 'y3')) && $key){
				
				$val += \Arr::get($this->config, 'current.'.self::$key_offset.'.y'      , 0.0);
				$val += \Arr::get($this->config, 'global_offset.y', 0.0);
			}
		});
		
		return $args;
	}
	
	/**
	 * viewファイルからのオフセット量追加
	 * 
	 * @param real $x 水平方向のオフセット量
	 * @param real $y 垂直方向のオフセット量
	 */
	public function set_offset($x = 0.0, $y = 0.0)
	{
		\Arr::set($this->config, 'current.__offset.x', \Arr::get($this->config, 'current.'.self::$key_offset.'.x') + $x);
		\Arr::set($this->config, 'current.__offset.y', \Arr::get($this->config, 'current.'.self::$key_offset.'.y') + $y);
	}
	
	/**
	 * viewファイルからの全体オフセット量追加
	 * 
	 * このメソッドによる変更はインスタンスが破棄されるまで有効です
	 * 
	 * @param real $x 水平方向のオフセット量
	 * @param real $y 垂直方向のオフセット量
	 */
	public function set_global_offset($x = 0.0, $y = 0.0)
	{
		\Arr::set($this->config, 'global_offset.x', \Arr::get($this->config, 'global_offset.x') + $x);
		\Arr::set($this->config, 'global_offset.y', \Arr::get($this->config, 'global_offset.y') + $y);
	}
}

