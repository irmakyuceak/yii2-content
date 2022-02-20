<?php

namespace portalium\content\models;

use Yii;
use portalium\content\Module;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%content_category}}".
 *
 * @property int $id_category
 * @property string $name
 * @property string $slug
 * @property string $date_create
 * @property string $date_update
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => date("Y-m-d H:i:s"),
            ],
        ];
    }
    public static function tableName()
    {
        return '{{' . Module::$tablePrefix . 'category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['id_category'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getCategoryList()
    {
        $items = [];
        $categories = Category::find()->all();
        foreach ($categories as $category) {
            $items[$category->id_category] = $category->name;
        }
        return $items;
    }

    public function attributeLabels()
    {
        return [
            'id_category' => 'Id Category',
            'name' => 'Name',
            'slug' => 'Slug',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }
}
