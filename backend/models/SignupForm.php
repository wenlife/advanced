<?php
namespace backend\models;

use common\models\Adminuser;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $name;
    public $email;
    public $secode;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['secode', 'filter', 'filter' => 'trim'],
            ['secode', 'required'],
            ['secode', 'string', 'max' => 4],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => 'This email address has already been taken.'],

            ['name', 'string', 'max' => 100],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new Adminuser();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->name = $this->name;
            $user->status = 0;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }else{
            return null;
        }

    }
}
