<?php

/**
 * This is the model class for table "{{park}}".
 *
 * The followings are the available columns in table '{{park}}':
 * @property integer $id
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property string $create_time
 * @property string $update_time
 * @property string $name_short
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string $description_short
 * @property string $description
 * @property string $mode
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $coords
 * @property string $subway_station
 * @property string $how_to_get
 * @property string $back
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $position
 * @property integer $status
 * @property integer $title
 * @property integer $class
 * @property integer $map_code
 * @property string $count_room
 * @property string $kitchen
 * @property string $docs
 */
class Park extends yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{park}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name_short, name, slug', 'required'],
			['create_user_id, update_user_id, position, status', 'numerical', 'integerOnly'=>true],
			['name_short, name, slug, mode, phone, email, address, meta_title, title, class', 'length', 'max'=>255],
			['image, coords', 'length', 'max'=>150],
			['slug', 'yupe\components\validators\YSLugValidator'],
			['slug', 'unique'],
			['description_short, description, subway_station, how_to_get, back, class, meta_keywords, meta_description, map_code, count_room, kitchen', 'safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, create_user_id, update_user_id, create_time, update_time, name_short, name, slug, image, description_short, description, mode, phone, email, address, coords, subway_station, how_to_get, back, meta_title, title, meta_keywords, meta_description, position, status, class, count_room, kitchen, docs', 'safe', 'on'=>'search'],
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
			'photos' => [self::HAS_MANY, 'ParkImage', 'park_id'],
			// 'pagesRoot' => [self::HAS_MANY, 'ParkPage', 'park_id', 'condition' => 'parent_id IS NULL AND status = :status', 'params' =>[':status' => ParkPage::STATUS_PUBLIC]],
			'pagesRoot' => [self::HAS_MANY, 'ParkPage', 'park_id', 'scopes'=>['root', 'published']],
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
			'name_short' => 'Короткое Название',
			'name' => 'Название',
			'slug' => 'Alias',
			'image' => 'Изображение',
			'description_short' => 'Короткое описание',
			'description' => 'Описание',
			'mode' => 'График работы',
			'phone' => 'Телефон',
			'email' => 'E-mail',
			'address' => 'Адрес',
			'coords' => 'Координаты на карте',
			'subway_station' => 'Станция метро',
			'how_to_get' => 'Как добраться',
			'back' => 'Цвет фона',
			'title' => 'Заголовок (H1)',
			'meta_title' => 'Title (SEO)',
			'meta_keywords' => 'Ключевые слова SEO',
			'meta_description' => 'Описание SEO',
			'position' => 'Сортировка',
			'status' => 'Статус',
			'class' => 'Класс',
			'map_code' => 'Код карты',
			'count_room' => 'Количество комнат',
			'kitchen' => 'Кухня',
			'docs' => 'Меню ресторана',
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
            'fileUpload' => [
                'class'         => 'yupe\components\behaviors\FileUploadBehavior',
                'attributeName' => 'docs',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => 'docx, doc, pdf, xlsx',
                'uploadPath'    => $module->uploadPathDocs,
                'deleteFileKey'     => 'delete-file3'
            ],
			'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
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
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('coords',$this->coords,true);
		$criteria->compare('subway_station',$this->subway_station,true);
		$criteria->compare('how_to_get',$this->how_to_get,true);
		$criteria->compare('back',$this->back,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status);
		$criteria->compare('class',$this->class);
		$criteria->compare('map_code',$this->map_code);
		$criteria->compare('count_room',$this->count_room);
		$criteria->compare('kitchen',$this->kitchen);
		$criteria->compare('docs',$this->docs);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position ASC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Park the static model class
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
        ];
    }

	public function getListPark()
	{
		$model = self::model()->published()->findAll();

		return CHtml::listData($model, 'id', 'name');
	}

	public function getTitle()
	{
		return $this->title ?: $this->name;
	}

    public function getDocumentUrl()
    {
        $module = Yii::app()->getModule('park');
        return '/uploads/'.$module->uploadPathDocs.'/'.$this->docs;
    }
}
