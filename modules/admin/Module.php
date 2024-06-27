<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $layout = 'admin';   // показываем modules/admin/views/layouts/admin.php (из layouts модуля admin)
    // public $layout = '/admin'; // так выводит views/layouts/admin.php (из основной layouts)

    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
