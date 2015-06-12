<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "markets".
 *
 * @property integer $market_id
 * @property string $name
 * @property string $domain
 * @property string $logo
 * @property string $theme
 * @property string $intro
 * @property integer $state
 * @property integer $city
 * @property string $city_name
 * @property string $area
 * @property string $address
 * @property string $zipcode
 * @property string $tel
 * @property integer $created
 * @property integer $updated
 * @property integer $status
 * @property integer $app_key
 * @property string $app_secret
 *
 * @property Orders[] $orders
 * @property Shops[] $shops
 * @property Store[] $stores
 */
class Markets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'markets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['market_id', 'state', 'city', 'city_name', 'area', 'address', 'zipcode', 'tel'], 'required'],
            [['market_id', 'state', 'city', 'created', 'updated', 'status', 'app_key'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['domain', 'logo', 'address'], 'string', 'max' => 200],
            [['theme'], 'string', 'max' => 50],
            [['intro'], 'string', 'max' => 500],
            [['city_name'], 'string', 'max' => 10],
            [['area', 'tel'], 'string', 'max' => 20],
            [['zipcode'], 'string', 'max' => 6],
            [['app_secret'], 'string', 'max' => 32],
            [['market_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'market_id' => 'ID',
            'name' => '名称',
            'domain' => '域名',
            'logo' => '店铺LOGO',
            'theme' => '装修模板',
            'intro' => '简介',
            'state' => '省份',
            'city' => '城市',
            'city_name' => '城市名',
            'area' => '地区',
            'address' => '联系地址',
            'zipcode' => '邮政编码',
            'tel' => '联系电话',
            'created' => '创建时间',
            'updated' => '最后更新',
            'status' => '状态',
            'app_key' => '来自CGB的app',
            'app_secret' => '来自CGB的app',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['market_id' => 'market_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shops::className(), ['market_id' => 'market_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Stores::className(), ['market_id' => 'market_id']);
    }
}
