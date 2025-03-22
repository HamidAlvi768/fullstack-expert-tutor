<?php

use app\components\Helper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tutor Wallet';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="p-5">

    <!-- HEADER -->
    <div class="row">
        <div class="w-100 bg-secondary text-dark p-5 rounded">
            <div class="text-center">
                <h1><?= $user->username ?></h1>
            </div>
        </div>
    </div>
    <!-- HEADER -->

    <div class="container">
        <div class="text-center" style="padding: 40px;">
            <p style="font-size: 2rem;">Coins <?= round($wallet->balance); ?></p>
            <a href="<?php echo Helper::baseUrl("/tutor/wallet/coins") ?>">Get Coins</a>
        </div>
    </div>

    <div class="container">
        <!-- List of referrals in a table -->
        <div class="referrals-list mt-4">
            <h3>Transactions</h3>
            <?php if (count($wallet->transactions) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wallet->transactions as $index => $transaction): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= Html::encode($transaction->transaction_type) ?></td>
                                <td><?= Html::encode($transaction->description) ?></td>
                                <td><?= $transaction->transaction_type=="credit"?"+".Html::encode($transaction->amount):"-".Html::encode($transaction->amount) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No referrals yet!</p>
            <?php endif; ?>
        </div>
    </div>

</div>