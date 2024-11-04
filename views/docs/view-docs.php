<?php
use yii\helpers\Html;

/** @var array $sheetData */
/** @var string $fileName */

$this->title = 'View Document: ' . Html::encode($fileName);
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <?php if (!empty($sheetData[1])): // Display header row ?>
                    <?php foreach ($sheetData[1] as $headerCell): ?>
                        <th><?= Html::encode($headerCell) ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sheetData as $rowIndex => $row): ?>
                <?php if ($rowIndex === 1) continue; // Skip header row ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <td><?= Html::encode($cell) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
