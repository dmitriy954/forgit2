<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/flowers.css',
		'css/cart.css',
		'css/styleadjunct.css',
		'css/kabinet.css',
		'css/index.css',
		'css/mp.css',
		'css/font-awesome.min.css'
		
    ];
    public $js = [
	  'js/mp.js' ,
	 
	  
	   
	   
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
	public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
