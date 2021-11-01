<?php

/**
 * This is the model class for table "{{slider}}".
 *
 * The followings are the available columns in table '{{slider}}':
 * @property integer $id
 * @property string $name
 * @property string $name_short
 * @property string $image
 * @property string $description_short
 * @property string $status
 * @property string $position
 * @property string $description
 * @property string $button_name
 * @property string $button_link
 * @property string $image_xs
 * @property string $image_big
 * @property string $category_id
 */
class Slider extends yupe\models\YModel
{

	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{slider}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name', 'required'],
			['name, name_short, image, button_name, button_link', 'length', 'max'=>255],
			['description_short,description, image_xs, image_big', 'safe'],
			['position, status, category_id', 'numerical', 'integerOnly' => true],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, name, name_short, image, description_short, status, position, description, button_name, button_link, image_xs, image_big, category_id', 'safe', 'on'=>'search'],
		];
	}

	public function behaviors()
    {
        $module = Yii::app()->getModule('slider');

        return [
            'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
            ],
            'imageXsUpload' => [
			    'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
			    'attributeName' => 'image_xs',
			    'minSize'       => $module->minSize,
			    'maxSize'       => $module->maxSize,
			    'types'         => $module->allowedExtensions,
			    'uploadPath'    => $module->uploadPath,
			    'deleteFileKey' => 'delete-file-xs'
			],
			'imageBigUpload' => [
			    'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
			    'attributeName' => 'image_big',
			    'minSize'       => $module->minSize,
			    'maxSize'       => $module->maxSize,
			    'types'         => $module->allowedExtensions,
			    'uploadPath'    => $module->uploadPath,
			    'deleteFileKey' => 'delete-file-big'
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
			'category' => array(self::BELONGS_TO, 'SliderCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                => 'ID',
			'category_id'       => 'Категория',
			'name'              => 'Название',
			'name_short'        => 'Короткое Название',
			'description_short' => 'Краткое описание',
			'image'             => 'Изображение',
			'status'            => 'Статус',
			'position'          => 'Сортировка',
			'description'       => 'Описание',
			'button_name'       => 'Название кнопки',
			'button_link'       => 'url для кнопки',
			'image_xs'          => 'Изображение для моб. устройств',
			'image_big'         => 'Изображение для мониторов > 1920',
		);
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

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name,true);
		$criteria->compare('name_short', $this->name_short,true);
		$criteria->compare('description_short', $this->description_short,true);
		$criteria->compare('image', $this->image,true);
		$criteria->compare('status', $this->status,true);
		$criteria->compare('position', $this->position,true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('button_name', $this->button_name, true);
		$criteria->compare('button_link', $this->button_link, true);
		$criteria->compare('image_xs', $this->image_xs);
		$criteria->compare('image_big', $this->image_big);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slider the static model class
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
}
