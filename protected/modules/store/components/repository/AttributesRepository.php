<?php

/**
 * Class AttributesRepository
 */
class AttributesRepository extends CApplicationComponent
{
    /**
     * @param StoreCategory $category
     * @return Attribute[]
     */
    public function getForCategory(StoreCategory $category)
    {
        $criteria = new CDbCriteria([
            'condition' => 't.is_filter = 1 AND t.type != :type',
            'params' => [
                ':type' => Attribute::TYPE_TEXT,
            ],
            'join' => 'LEFT JOIN {{store_type_attribute}} ON t.id = {{store_type_attribute}}.attribute_id
                       LEFT JOIN {{store_type}} ON {{store_type_attribute}}.type_id = {{store_type}}.id
                       LEFT JOIN {{store_product}} AS products ON products.type_id = {{store_type}}.id
                       LEFT JOIN {{store_attribute_group}} `group` ON `group`.id = t.group_id',
            'distinct' => true,
            'order' => '`group`.position ASC, t.sort ASC',
        ]);

        $categories = $category->getChildsArray();

        if (!empty($categories)) {
            $categoriesCriteria = new CDbCriteria([
                'condition' => 'products.category_id = :category',
                'params' => [
                    ':category' => $category->id,
                ],
            ]);
            $categoriesCriteria->addInCondition('products.category_id', $categories, 'OR');
            $criteria->mergeWith($categoriesCriteria, 'AND');
        } else {
            $criteria->addCondition('products.category_id = :category');
            $criteria->params[':category'] = $category->id;
        }
        
        return Attribute::model()->findAll($criteria);
    }

    public function getNumberValueForCategory($attribute, $category, $select = 'max(number_value)')
    {
        $categories = $category->getChildsArray();
        $query = Yii::app()
            ->db
            ->createCommand()
            ->select($select)
            ->from('{{store_product_attribute_value}} as spav')
            ->leftJoin('{{store_product}} as sp', 'spav.product_id = sp.id')
            ->leftJoin('{{store_category}} as sc', 'sp.category_id = sc.id');

        if (!empty($categories)) {
            $query->where('sc.id IN(:idCategory) AND spav.attribute_id = :attributeId', [
                ':idCategory' => $categories,
                ':attributeId' => $attribute->id,
            ]);
        } else {
            $query->where('sc.id = :idCategory AND spav.attribute_id = :attributeId', [
                ':idCategory' => $category->id,
                ':attributeId' => $attribute->id,
            ]);
        }

        return $query->queryScalar();
    }

    public function getMaxNumberAttribute($attribute, $category)
    {
        return $this->getNumberValueForCategory($attribute, $category, 'max(number_value)');
    }

    public function getMinNumberAttribute($attribute, $category)
    {
        return $this->getNumberValueForCategory($attribute, $category, 'min(number_value)');
    }
}