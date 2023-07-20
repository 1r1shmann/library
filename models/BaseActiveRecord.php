<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class BaseActiveRecord extends ActiveRecord
{

    protected $originalAttributes = array();

    /**
     * Флаг, указывающий, что модель должна сохраняться в базе данных только в том случае, если в модели произошли фактические изменения.
     *
     * @var bool
     */
    private $save_only_if_dirty = false;

    /**
     * Установите флаг, чтобы указать, что модель должна сохраняться в БД, только если модель грязная.
     * 
     * @param bool $enable
     *
     * @return \BaseActiveRecord
     */
    public function saveOnlyIfDirty($enable = true)
    {
        $this->save_only_if_dirty = $enable;

        return $this;
    }

    /**
     * Проверьте, не загрязнена ли модель.
     * 
     * @return bool true если модель грязная
     */
    public function isModelDirty()
    {
        $exclude = array(
            'last_modified_user_id',
            'last_modified_date',
        );

        foreach ($this->getAttributes() as $attrName => $attribute) {
            if (!in_array($attrName, $exclude) && $this->isAttributeDirty($attrName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Проверяет, является ли атрибут грязным.
     *
     * @param $attrName
     *
     * @return bool
     */
    public function isAttributeDirty($attrName)
    {
        if (!array_key_exists($attrName, $this->originalAttributes)) {
            return true;
        }

        return $this->getAttribute($attrName) !== $this->originalAttributes[$attrName];
    }

    /**
     * Сохраняет данные в массиве после поиска, поэтому при сохранении мы можем проверить, является ли значение грязным или нет.
     */
    public function afterFind()
    {
        $this->originalAttributes = $this->getAttributes();
        parent::afterFind();
    }

    public function save($runValidation = true, $attributeNames = null, $allow_overriding = false)
    {
        // Сохранение модели только если она грязная / вкл/выкл с помощью $this->save_only_if_dirty
        if ($this->save_only_if_dirty === true && $this->isModelDirty() === false) {
            return false;
        }
        $user_id = null;
        try {
            if (isset(Yii::$app->user->id)) {
                $user_id = Yii::$app->user->id;
            }
        } catch (Exception $e) {
            
        }

        if ($this->getIsNewRecord() || !isset($this->id)) {
            if (!$allow_overriding) {
                // Set creation properties
                if ($user_id === null) {
                    // Revert to the admin user
                    $this->created_user_id = 1;
                } else {
                    $this->created_user_id = $user_id;
                }
                if (!$allow_overriding || $this->created_date == '1900-01-01 00:00:00') {
                    $this->created_date = date('Y-m-d H:i:s');
                }
            }
        }

        try {
            if (!$allow_overriding) {
                // Set the last_modified_user_id and last_modified_date fields
                if ($user_id === null) {
                    // Revert to the admin user
                    // need this try/catch block here to make older migrations pass with this hook in place
                    $this->last_modified_user_id = 1;
                } else {
                    $this->last_modified_user_id = $user_id;
                }
            }
            if (!$allow_overriding || $this->last_modified_date == '1900-01-01 00:00:00') {
                $this->last_modified_date = date('Y-m-d H:i:s');
            }
        } catch (Exception $e) {
            
        }

        return parent::save($runValidation, $attributeNames);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->originalAttributes = $this->getAttributes();
        parent::afterSave($insert, $changedAttributes);
    }

    public function getOriginalAttributes()
    {
        return $this->originalAttributes;
    }
}
