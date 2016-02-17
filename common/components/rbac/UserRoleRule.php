<?php
namespace common\components\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;

class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        //Получаем массив пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', ($user == Yii::$app->user->id ? Yii::$app->user->identity : User::findOne($user)));

        if ($user) {

            $role = $user->role; //Значение из поля role базы данных

            if ($item->name === User::ROLE_ROOT) {
                return $role == User::ROLE_ROOT;
            } elseif ($item->name === User::ROLE_ADMIN) {
                return $role == User::ROLE_ROOT || $role == User::ROLE_ADMIN;
            } elseif ($item->name === User::ROLE_USER) {
                return $role == User::ROLE_ROOT || $role == User::ROLE_ADMIN || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}