<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $user_id
 * @property string $username
 * @property string $nickname
 * @property integer $status
 * @property string $logins
 * @property string $last_login
 * @property integer $created
 *
 * @property Orders[] $orders
 * @property StoreComment[] $storeComments
 * @property Wishlist[] $wishlists
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface 
{
    public $authKey;
    
    public $token;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'created'], 'required'],
            [['user_id', 'status', 'logins', 'last_login', 'created'], 'integer'],
            [['username', 'nickname'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'username' => '用户名',
            'nickname' => 'Nickname',
            'status' => '状态',
            'logins' => '登录次数',
            'last_login' => '最后登录',
            'created' => '创建时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Stores::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreComments()
    {
        return $this->hasMany(StoreComment::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishlists()
    {
        return $this->hasMany(Wishlist::className(), ['user_id' => 'user_id']);
    }

    public function getAvatar() {
        return "http://i.Themeforest.com/avatar?u=" . $this->username;
    }
    
    public static function authenticate($user)
    {
        if (isset($user['user_id']) && $user['user_id'] > 0)
        {
            $model = Users::findIdentity($user['user_id']);
            if ( ! $model)
            {
                $model = new Users();
                $model->user_id = $user['user_id'];
                $model->created = time();
                $model->status  = 1;
            }
            $model->username = $user['username'];
//            $model->nickname = $user['nickname'];
            $model->logins  += 1;
            $model->last_login = time();
            
            if ($model->save() && $model->status == 1)
            {
                return $model;
            }
            else
            {
                //var_dump($model->errors);die;
            }
        }
        
        return FALSE;
    }
    
    
    public function getAuthKey()
    {
        return $this->authKey;        
    }

    public function getId()
    {
        return $this->user_id;        
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;        
    }

    public static function findIdentity($id)
    {
        $user = Users::findByCondition(['user_id' => $id], TRUE);
        
        return $user;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $oauth = new \app\components\OAuth();
        $user = $oauth->getUser($token);
        
        return Users::authenticate($user);
    }

    public static function loginByAuthorizCode($code)
    {
        $oauth = new \app\components\OAuth();
        $oauth->getAccessToken('code', array('code' => $code));
        if (isset($oauth->access_token))
        {
            $user = Yii::$app->user->loginByAccessToken($oauth->access_token);
            if ($user)
            {
                Yii::$app->session->set('token', $oauth->access_token);
            }
            return $user;
        }
        
        return FALSE;
    }

    public function getInviterCode(){
        return $this->id+76543210;
    }
}
