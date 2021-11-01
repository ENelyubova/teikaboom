<?php

/**
 * Валидатор уникальности поля типа slug или alias
 *
 * @author Kucherov Anton <idexter.ru@gmail.com>
 * @link https://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.yupe.components.validators
 * @since 0.1
 *
 */
namespace yupe\components\validators;

use CDbCriteria;
use CUniqueValidator;

/**
 * Class YUniqueParkValidator
 * @package yupe\components\validators
 */
class YUniqueParkValidator extends CUniqueValidator
{
    /**
     * @param \CModel $object
     * @param string $attribute
     * @throws \CException
     */
    protected function validateAttribute($object, $attribute)
    {
        $criteria = new CDbCriteria();
        $criteria->mergeWith($this->criteria);
        $criteria->addCondition('park_id = :park_id');
        $criteria->params[':park_id'] = $object->park_id;

        $this->criteria = $criteria;

        return parent::validateAttribute($object, $attribute);
    }
}
