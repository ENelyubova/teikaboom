<?php

/**
 * Class StoreCategoryRepository
 */
class StoreCategoryRepository extends CApplicationComponent
{

    /**
     * @param $slug
     * @return StoreCategory
     */
    public function getByAlias($slug)
    {
        return StoreCategory::model()->published()->find(
            'slug = :slug',
            [
                ':slug' => $slug,
            ]
        );
    }
    /**
     * @param $slug
     * @return StoreCategory
     */
    public function getById($id)
    {
        return StoreCategory::model()->published()->findByPk($id);
    }

    /**
     *
     */
    public function getAllDataProvider()
    {
        return new CArrayDataProvider(
            StoreCategory::model()->published()->getMenuList(1), [
                'id' => 'id',
                'pagination' => false,
            ]
        );
    }

    /**
     *
     */
    public function getAllCategory()
    {
        $module = Yii::app()->getModule('store');

        $criteria = new CDbCriteria();
        $criteria->scopes = ['published', 'roots'];
        $criteria->order = 't.sort ASC';

        if(!empty($module->storecatId)){
            $ids = explode(',', $module->storecatId);
        }
        if(is_array($ids) and !empty($ids)) {
            $criteria->addInCondition('t.id', $ids);
        }

        return new CActiveDataProvider(
            'StoreCategory',
            [
                'criteria' => $criteria,
                'pagination' => false,
            ]
        );
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getByPath($path)
    {
        return StoreCategory::model()->published()->findByPath($path);
    }
}