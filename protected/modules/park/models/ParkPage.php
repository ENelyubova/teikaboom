<?php

/**
 * This is the model class for table "{{park_page}}".
 *
 * The followings are the available columns in table '{{park_page}}':
 * @property integer $id
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property string $create_time
 * @property string $update_time
 * @property integer $park_id
 * @property string $name_short
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string $description_short
 * @property string $description
 * @property string $title
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $position
 * @property integer $status
 * @property integer $parent_id
 * @property integer $view
 *
 * The followings are the available model relations:
 * @property Park $park
 */
class ParkPage extends yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{park_page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['park_id, name_short, name, slug', 'required'],
			['create_user_id, update_user_id, park_id, position, status, parent_id', 'numerical', 'integerOnly'=>true],
			['name_short, name, slug, meta_title, title, view', 'length', 'max'=>255],
			['image', 'length', 'max'=>150],
			['slug', 'yupe\components\validators\YSLugValidator'],
			['slug', 'yupe\components\validators\YUniqueParkValidator'],
			['description_short, description, meta_keywords, meta_description', 'safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, create_user_id, update_user_id, create_time, update_time, park_id, name_short, name, slug, image, description_short, description, meta_title, title, meta_keywords, meta_description, position, status, parent_id, view', 'safe', 'on'=>'search'],
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			'park' => [self::BELONGS_TO, 'Park', 'park_id'],
			'photos' => [self::HAS_MANY, 'ParkPageImage', 'park_page_id'],
			'children' => [self::HAS_MANY, 'ParkPage', 'parent_id'],
            'parentPage' => [self::BELONGS_TO, 'ParkPage', 'parent_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_user_id' => 'Create User',
			'update_user_id' => 'Update User',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'park_id' => 'Парк',
			'name_short' => 'Короткое Название',
			'name' => 'Название',
			'slug' => 'Alias',
			'image' => 'Изображение',
			'description_short' => 'Короткое описание',
			'description' => 'Описание',
			'title' => 'Заголовок (H1)',
			'meta_title' => 'Title (SEO)',
			'meta_keywords' => 'Ключевые слова SEO',
			'meta_description' => 'Описание SEO',
			'position' => 'Сортировка',
			'status' => 'Статус',
			'parent_id' => 'Родитель',
			'view' => 'Шаблон страницы',
		);
	}

	public function behaviors()
    {
		$module = Yii::app()->getModule('park');

        return [
            'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
            ],
			'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
			'customField' => [
                'class' => 'yupe\components\behaviors\CustomFieldBehavior',
                'attributeName' => 'data',
            ],
        ];
    }

	/**
     * @return bool
     */
    public function beforeSave()
    {
        $this->update_time = new CDbExpression('NOW()');
        $this->update_user_id = Yii::app()->getUser()->getId();

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
            $this->create_user_id = $this->update_user_id;
        }

        return parent::beforeSave();
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('park_id',$this->park_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status);
		$criteria->compare('view',$this->view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position ASC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ParkPage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getStatusList()
	{
		return [
			self::STATUS_PUBLIC   => 'Опубликован',
			self::STATUS_MODERATE => 'На модерации',
		];
	}

	public function getStatusName()
	{
		$data = $this->getStatusList();
		if (isset($data[$this->status])) {
			return $data[$this->status];
		}
		return null;
	}
	public function scopes()
    {
        return [
            'published' => [
                'condition' => 'status  = :status',
                'params' => [
                    ':status' => self::STATUS_PUBLIC
                ]
            ],
            'root' => [
                'condition' => 'parent_id IS NULL'
            ],
        ];
    }

	/**
     * @return string
     */
    public function getParkName()
    {
        return ($this->park === null) ? '---' : $this->park->name;
    }

    /**
     * @return string
     */
    public function getParentName()
    {
        return ($this->parentPage === null) ? '---' : $this->parentPage->name;
    }

	/**
     * Возвращает отформатированный список в соответствии со вложенность страниц.
     *
     * @param null|int $parentId
     * @param int $level
     * @param null|array|CDbCriteria $criteria
     * @return array
     */
    public function getFormattedList($parentId = null, $level = 0, $criteria = null)
    {
        if (empty($parentId)) {
            $parentId = null;
        }

        $models = $this->findAllByAttributes(['parent_id' => $parentId], $criteria);

        $list = [];

        foreach ($models as $model) {

            $model->name = str_repeat('&emsp;', $level) . $model->name;

            $list[$model->id] = $model->name;

            $list = CMap::mergeArray($list, $this->getFormattedList($model->id, $level + 1, $criteria));
        }

        return $list;
    }

	public function getTitle()
	{
		return $this->title ?: $this->name;
	}
}
