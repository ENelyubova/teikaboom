<?php

/**
 * Class ProducerRepository
 */
class ProducerRepository extends CApplicationComponent
{

    /**
     * @param StoreCategory $category
     * @param CDbCriteria $mergeWith
     * @return array|mixed|null
     */
    /*public function getForCategory(StoreCategory $category, CDbCriteria $mergeWith)
    {
        $criteria = new CDbCriteria([
            'order' => 't.sort ASC',
            'join' => 'LEFT JOIN {{store_product}} AS products ON products.producer_id = t.id',
            'distinct' => true,
        ]);
        $criteria->addInCondition('products.category_id', [$category->id]);
        $criteria->mergeWith($mergeWith);

        return Producer::model()->findAll($criteria);
    }
    */
    public function getForCategory(StoreCategory $category, CDbCriteria $mergeWith)
    {
        $criteria = new CDbCriteria([
            'order' => 't.sort ASC',
        ]);
        $criteria->mergeWith($mergeWith);

        $categories = $category->getChildsArray();
        array_push($categories, $category->id);

        if (!empty($categories)) {
            $ids = array_column(Yii::app()
                ->db
                ->createCommand()
                ->select('pr.id')
                ->from('{{store_product}} p')
                ->join('{{store_producer}} pr', 'p.producer_id=pr.id')
                ->where(['in', 'category_id', $categories])
                ->group('pr.id')
                ->queryAll(), 'id');

            $criteria->addInCondition('t.id', $ids);
        }

        return Producer::model()->findAll($criteria);
    }
    /**
     * @return CActiveDataProvider
     */
    public function getAllDataProvider()
    {
        $module = Yii::app()->getModule('store');

        $criteria = new CDbCriteria();
        $criteria->scopes = ['published'];
        $criteria->order = 'sort';

        return new CActiveDataProvider(
            'Producer', [
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => (int)$module->itemsPerPage,
                    'pageVar' => 'page',
                ],
            ]
        );
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug)
    {
        return Producer::model()->published()->find('slug = :slug', [':slug' => $slug]);
    }
}