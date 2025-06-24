<h2>テストデータ一覧</h2>
<ul>
<?php foreach ($items as $item): ?>
    <li><?php echo h("name: " . $item['TestItem']['name'] . " @@ date: " . $item['TestItem']['created']); ?></li>
<?php endforeach; ?>
</ul>
