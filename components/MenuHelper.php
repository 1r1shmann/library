<?php
namespace app\components;

use Yii;
use yii\bootstrap5\Nav;

class MenuHelper extends Nav
{

    public function renderItem($item): string
    {
        $allowed = true;

        if (isset($item['restricted']) && $item['restricted']) {
            $allowed = false;
            foreach ($item['restricted'] as $authitem) {
                if (is_array($authitem)) {
                    $a_item = array_shift($authitem);
                    $allowed = Yii::$app->user->can($a_item);
                    if ($allowed) {
                        break;
                    }
                } elseif (Yii::$app->user->can($authitem)) {
                    $allowed = true;
                    break;
                }
            }
        }
        if ($allowed === true) {
            return parent::renderItem($item);
        } else {
            return '';
        }
    }
    
    protected function renderDropdown(array $items, array $parentItem): string
    {
        foreach ($items AS $key => $item) {
            if (isset($item['restricted']) && $item['restricted']) {
                $delete = true;

                foreach ($item['restricted'] as $authitem) {
                    if (is_array($authitem)) {
                        $a_item = array_shift($authitem);
                        if (Yii::$app->user->can($a_item)) {
                            $delete = false;
                            break;
                        }
                    } elseif (Yii::$app->user->can($authitem)) {
                        $delete = false;
                        break;
                    }
                }
                if ($delete === true) {
                    unset($items[$key]);
                }
            }
        }

        return parent::renderDropdown($items, $parentItem);
    }
}
