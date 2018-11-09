<?php

namespace app\widget;

use Yii;
use yii\web\View;
use app\widget\AssetBundle;

class ChartAsset extends AssetBundle
{
    public function init()
    {
        $this->jsOptions['position'] = View::POS_END;

        $this->setSourcePath('@app/widget/assets/chart');

        $this->setupAssets('css', [
            'c3.min',
        ]);

        $this->setupAssets('js', [
            'c3.min',
            'd3',
        ]);

        parent::init();
    }
}
