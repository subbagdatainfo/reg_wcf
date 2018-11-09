<?php

namespace app\widget;

use Yii;
use yii\web\View;
use yii\helpers\Url;
use app\widget\AssetBundle;

/**
 * Load chart dari chartJS.
 */
class Chart extends \yii\base\Widget
{
    public $id;

    /**
    * @var string 
    * HTML Id of chart (div) container
    */
    public $html_id;
	
	public $options = [];

    public $data;

    public $categories;

    public function run()
    {
        echo '<div id="chart'.$this->html_id.'"></div>';
    }

    /**
     * Initializes the widget
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->html_id = $this->getId();

        $this->registerAssets();

        parent::init();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
            
        ChartAsset::register($view);

        $this->Script();
    }

    public function Script(){

        $view       = $this->getView();

        $view->registerJs("

            $.getJSON( '".Url::to(['chart/properties'])."?id=".$this->id."', function( data ) {
                var chart = c3.generate({
                    bindto: '#chart". $this->html_id ."',
                    data: {
                        columns: data['Data'],
                        type: 'bar'
                    },
                    axis: {
                        x: {
                            type: 'category',
                            categories: data['Categories'],
                            tick: {
                                rotate: 45,
                                multiline: false
                            },
                        }
                    },
                    bar: {
                        width: {
                            ratio: 1 // this makes bar width 50% of length between ticks
                        }
                        // or
                        //width: 100 // this makes bar width 100px
                    }
                });
            });

        ", \yii\web\View::POS_END);
    }

}
