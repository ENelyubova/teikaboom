<?php

/**
 * Class NumberFilterWidget
 */
class NumberFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'number-filter';

    /**
     * @var
     */
    public $attribute;
    public $category;
    public $minDb = 0;
    public $maxDb = 1000;

    /**
     * @throws Exception
     */
    public function init()
    {
        if (is_string($this->attribute)) {
            $this->attribute = Attribute::model()->findByAttributes(['name' => $this->attribute]);
        }

        if (!($this->attribute instanceof Attribute) || $this->attribute->type != Attribute::TYPE_NUMBER) {
            throw new Exception('Атрибут не найден или неправильного типа');
        }

        if ($this->category) {
            $attributesRepository = new AttributesRepository();
            $this->maxDb = $attributesRepository->getMaxNumberAttribute($this->attribute, $this->category);
            $this->minDb = $attributesRepository->getMinNumberAttribute($this->attribute, $this->category);
        }

        parent::init();
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $this->render($this->view, [
            'attribute' => $this->attribute,
            'minDb' => $this->minDb,
            'maxDb' => $this->maxDb,
        ]);
    }
}
