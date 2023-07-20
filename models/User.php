<?php
namespace app\models;

use app\models\BaseActiveRecord;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $active
 * @property int $global_firm_rights
 * @property string|null $title
 * @property string $qualifications
 * @property string $role
 * @property string|null $code
 * @property string|null $password
 * @property string|null $salt
 * @property int $last_modified_user_id
 * @property string $last_modified_date
 * @property int $created_user_id
 * @property string $created_date
 * @property int|null $last_specialty_id
 * @property int $is_doctor
 * @property int|null $contact_id
 * @property int|null $last_division_id
 * @property int $is_clinical
 * @property int $is_consultant
 * @property int $is_surgeon
 * @property int $has_selected_firms
 * @property int|null $doctor_grade_id
 * @property string|null $registration_code
 * @property int $OrgID
 * @property string|null $SS
 * @property string|null $patronimic_name
 * @property string|null $temppswrd
 * @property string|null $uuid
 * @property string|null $session_id
 *
 * @property Contact $contact
 * @property Organization $org
 */
class User extends BaseActiveRecord implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname', 'username', 'password'], 'required'],
            [['reg_date', 'last_login_date', 'created_date', 'last_modified_date'], 'safe'],
            [['created_user_id', 'last_modified_user_id'], 'integer'],
            [['nickname', 'username'], 'string', 'max' => 25],
            [['password', 'password_reset_token', 'avatar'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['created_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_user_id' => 'id']],
            [['last_modified_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['last_modified_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Никнейм',
            'username' => 'Логин',
            'password' => 'Пароль',
            'password_reset_token' => 'Токен сброса пароля',
            'avatar' => 'Аватарка',
            'reg_date' => 'Дата регистрации',
            'last_login_date' => 'Последний логин'
        ];
    }

    public function getAuthKey()
    {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        
    }

    public static function findByUsername($username)
    {
        return User::find()->where(['username' => $username])->one();
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
