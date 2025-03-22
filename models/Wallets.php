<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wallets".
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $balance
 * @property string|null $currency
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Transactions[] $transactions
 * @property Users $user
 */
class Wallets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['balance'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['currency'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'balance' => 'Balance',
            'currency' => 'Currency',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery|TransactionsQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(WalletTransactions::class, ['wallet_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return WalletsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WalletsQuery(get_called_class());
    }
}
