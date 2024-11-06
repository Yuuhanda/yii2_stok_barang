<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\BootstrapAsset;


BootstrapAsset::register($this);


AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
<?php

NavBar::begin([
    'brandLabel' => 'Office Invetory',
    'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        // Inventory Dropdown
        [
            'label' => 'Inventory',
            'items' => [
                ['label' => 'Master Inventory', 'url' => ['/item/index']],
                ['label' => 'Manage Unit', 'url' => ['/unit/index'], 'visible' => !Yii::$app->user->isGuest && 
            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)],
                ['label' => 'Bulk Upload History', 'url' => ['/docs/index'], 'visible' => !Yii::$app->user->isGuest && 
            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)],
                ['label' => 'Unit Usage Log', 'url' => ['/log/index']],
            ], 'visible' => !Yii::$app->user->isGuest,
        ],
        // Item Loaning Dropdown
        [
            'label' => 'Item Loaning',
            'items' => [
                ['label' => 'Unit Loaning', 'url' => ['/lending/index']],
                ['label' => 'Loaning List', 'url' => ['/lending/list']],
            ], 'visible' => !Yii::$app->user->isGuest && 
            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0),
        ],
        // Unit Damaged & In-Repair Dropdown
        [
            'label' => 'Damaged & In-Repair Unit',
            'items' => [
                ['label' => 'Damaged Unit', 'url' => ['/unit/damaged'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Unit In-Repair', 'url' => ['/unit/repair'], 'visible' => !Yii::$app->user->isGuest && 
            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 2)],
            ], 'visible' => !Yii::$app->user->isGuest
        ],
        // Single Links
        ['label' => 'Search & Edit Unit Data', 'url' => ['/unit/correction-search'], 'visible' => !Yii::$app->user->isGuest && 
            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)],
        ['label' => 'Warehouse', 'url' => ['/warehouse/index'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => 'Employee', 'url' => ['/employee/index'],'visible' => !Yii::$app->user->isGuest && 
            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)],
        [
            'label' => 'Admin List',
            'url' => ['/user/index'],
            'visible' => Yii::$app->user->identity && Yii::$app->user->identity->superadmin == 1, // Show if user is superadmin
        ],
        
        
        // User Login/Logout
        Yii::$app->user->isGuest
            ? ['label' => 'Login', 'url' => ['/site/login']]
            : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>',
    ],
]);

NavBar::end();
?>

</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy;Fikri A. Yuhanda - Prabubima Tech 2024 || Office Inventory Management Yii2 <?= date('Y') ?></div>
            <!--<div class="col-md-6 text-center text-md-end"><?php //echo Yii::powered() ?></div> -->
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
