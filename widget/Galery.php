<?php

/**
 * @link http://dokumentasi.local-server.link/
 * @copyright Copyright (c) 2015 PT. Buka Media Teknologi
 * @license http://www.bukapeta.co.id/license/
 */

namespace app\widget;

use yii;
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\Widget;

/**
 * This is just an example.
 */
class Galery extends Widget
{

    public $data;

    public function run()
    {
        $view = $this->getView();

        GaleryAssets::register($view);
    }
}

