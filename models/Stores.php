<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $store_id
 * @property integer $market_id
 * @property string $name
 * @property integer $cid
 * @property string $logo
 * @property string $intro
 * @property string $theme
 * @property integer $created
 * @property integer $state
 * @property integer $city
 * @property string $address
 * @property integer $updated
 * @property integer $status
 * @property string $commission_rate
 *
 * @property Orders[] $orders
 * @property Shops[] $shops
 * @property Markets $market
 * @property StoreComment[] $storeComments
 * @property StoreCounter $storeCounter
 * @property StoreRate $storeRate
 */
class Stores extends \yii\db\ActiveRecord {

    const STATUS_PENDING = 0;
    const STATUS_OK = 1;
    const STATUS_FAIL = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'cid', 'market_id', 'name', 'state', 'city'], 'required'],
            [['store_id', 'market_id', 'cid', 'created', 'state', 'city', 'updated', 'status'], 'integer'],
            [['commission_rate'], 'number'],
            [['name'], 'string', 'max' => 20],
            [['logo', 'address'], 'string', 'max' => 200],
            [['intro'], 'string', 'max' => 500],
            [['theme'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => '商家',
            'market_id' => '运营中心',
            'name' => '商家名',
            'cid' => '类目',
            'logo' => '品牌图标',
            'intro' => '简介',
            'theme' => '模板',
            'created' => '创建时间',
            'state' => '省份',
            'city' => '城市',
            'address' => '联系地址',
            'updated' => '最后更新',
            'status' => '状态',
            'commission_rate' => '提成比例',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['store_id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(StoreShops::className(), ['store_id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarket()
    {
        return $this->hasOne(Markets::className(), ['market_id' => 'market_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreComments()
    {
        return $this->hasMany(StoreComment::className(), ['store_id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreCounter()
    {
        return $this->hasOne(StoreCounter::className(), ['store_id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreRate()
    {
        return $this->hasOne(StoreRate::className(), ['store_id' => 'store_id']);
    }

    public static function statusList()
    {
        return [
            self::STATUS_PENDING => '待审核',
            self::STATUS_OK => '通过',
            self::STATUS_FAIL => '未通过',
        ];
    }

    public function cidFunc($model)
    {
        return ItemCats::findOne($model->cid)->name;
    }

    public function cidFilter()
    {
        $cats = ItemCats::findAll(['parent_cid' => 0]);
        $data = array();
        foreach ($cats as $v)
        {
            $cats2 = ItemCats::findAll(['parent_cid' => $v->cid]);
            $data[$v->name] = \yii\helpers\ArrayHelper::map($cats2, 'cid', 'name');
        }
        return $data;
    }

    public function statusFunc($model)
    {
        return $this->statusList()[$model->status];
    }
    public function statusFilter()
    {
        return $this->statusList();
    }

}
