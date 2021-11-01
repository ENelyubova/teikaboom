<?php

/**
 * This is the model class for table "{{masterclass}}".
 *
 * The followings are the available columns in table '{{masterclass}}':
 * @property integer $id
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property string $create_time
 * @property string $update_time
 * @property string $date
 * @property integer $theme_id
 * @property string $name_short
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string $price
 * @property string $duration
 * @property string $age
 * @property string $description_short
 * @property string $description
 * @property string $title
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $position
 * @property integer $status
 * @property string $data
 * @property string $park_id
 */
class Masterclass extends yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{masterclass}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, name_short, name, slug', 'required'),
			array('create_user_id, update_user_id, theme_id, park_id, position, status', 'numerical', 'integerOnly'=>true),
			array('name_short, name, slug, title, meta_title', 'length', 'max'=>255),
			array('image, duration, age', 'length', 'max'=>150),
			array('price', 'length', 'max'=>19),
			array('description_short, description, meta_keywords, meta_description, data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_user_id, update_user_id, create_time, update_time, date, theme_id, park_id, name_short, name, slug, image, price, duration, age, description_short, description, title, meta_title, meta_keywords, meta_description, position, status, data', 'safe', 'on'=>'search'),
		);
	}

	/**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('masterclass');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPath,
            ],
			'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'park' => [self::BELONGS_TO, 'Park', 'park_id'],
			'photos' => [self::HAS_MANY, 'MasterclassImage', 'masterclass_id'],
			'theme' => [self::BELONGS_TO, 'MasterclassTheme', 'theme_id'],
		);
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
			'date' => 'Дата проведения',
			'theme_id' => 'Тема мастер класса',
			'name_short' => 'Короткое Название',
			'name' => 'Название',
			'slug' => 'Alias',
			'image' => 'Изображение',
			'price' => 'Стоимость',
			'duration' => 'Продолжительность',
			'age' => 'Возрастная категория',
			'description_short' => 'Короткое описание',
			'description' => 'Описание',
			'title' => 'Заголовок (H1)',
			'meta_title' => 'Title (SEO)',
			'meta_keywords' => 'Ключевые слова SEO',
			'meta_description' => 'Описание SEO',
			'position' => 'Сортировка',
			'status' => 'Статус',
			'data' => 'Data',
			'park_id' => 'Парк',
		);
	}

	/**
     * @return bool
     */
    public function beforeSave()
    {
		$this->update_time = new CDbExpression('NOW()');
        $this->update_user_id = Yii::app()->getUser()->getId();
		$this->date = date('Y-m-d', strtotime($this->date));

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
            $this->create_user_id = $this->update_user_id;
        }

        return parent::beforeSave();
    }
/**
     *
     */
    public function afterFind()
    {
        $this->date = date('d-m-Y', strtotime($this->date));

        return parent::afterFind();
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
		if ($this->date) {
            $criteria->compare('date', date('Y-m-d', strtotime($this->date)));
        }
		$criteria->compare('theme_id',$this->theme_id);
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('park_id',$this->park_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 'date DESC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Masterclass the static model class
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
	
	public function getTitle()
	{
		return $this->title ?: $this->name;
	}
}
