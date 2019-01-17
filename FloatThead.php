<?php

namespace pvsaintpe\floatthead;

use yii\helpers\Json;

/**
 * The yii2-floatThead is a Yii 2 wrapper for the jquery.floatThead
 * See more: http://mkoryak.github.io/floatThead/
 *
 * @author Thomas Geppert <bluezed.apps@gmail.com>
 */
class FloatThead extends \bluezed\floatThead\FloatThead
{
    /**
     * @var string - ID of the table that floatThead should be applied to
     */
    public $tableId;
    
    /**
     * @var array - Options that will be passed on to the plugin
     */
    public $options = [];
    
    /**
     * @var bool - Only registers the assets but will not apply the plugin to any table.
     *              NOTE: If this is used then the tableId and options have no effect!
     */
    public $registerOnly = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    /**
     * Registers the required assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        FloatTheadAsset::register($view);
        if (!$this->registerOnly) {
            $options = Json::encode($this->options);
            $view->registerJs('$("#'.$this->tableId.'").floatThead(' .$options .');', $view::POS_READY);
        }
    }
}