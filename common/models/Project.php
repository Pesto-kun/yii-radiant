<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "project".
 *
 * @property \MongoId|string $_id
 * @property string $title
 * @property string $description
 * @property integer $author_id
 * @property integer $created
 * @property integer $updated
 * @property integer $status
 * @property integer $responsible_id
 * @property array $participants
 *
 * @property User $author
 * @property User $responsible
 */
class Project extends \yii\mongodb\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_ARCHIVE = 2;

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'description',
            'author_id',
            'created',
            'updated',
            'status',
            'responsible_id',
            'participants'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['author_id', 'created', 'updated', 'status', 'responsible_id'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['participants'], 'each', 'rule' => ['integer']],
//            [['participants'], 'each', 'filter' => ['intval']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'title' => 'Название проекта',
            'description' => 'Описание проекта',
            'author_id' => 'Автор',
            'created' => 'Дата созадния',
            'updated' => 'Дата обновления',
            'status' => 'Статус',
            'responsible_id' => 'Ответсвенный',
            'participants' => 'Участники',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor() {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible() {
        return $this->hasOne(User::className(), ['id' => 'responsible_id']);
    }

    public function beforeSave($insert) {

        $this->updated = time();
        if($this->isNewRecord) {
            $this->created = $this->updated;
        }

        return parent::beforeSave($insert);
    }

    static public function getStatusOptions() {
        return [
            self::STATUS_ACTIVE => 'Активно',
            self::STATUS_DELETED => 'Удалено',
            self::STATUS_ARCHIVE => 'В архиве',
        ];
    }

    static public function getStatusName($status) {
        $statuses = self::getStatusOptions();
        return isset($statuses[$status]) ? $statuses[$status] : null;
    }
}
