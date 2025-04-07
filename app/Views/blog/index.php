<?php foreach ($posts as $post): ?>
    <article>
        <h2>
            <?= htmlspecialchars($post['title']) ?>
        </h2>
        <small>By: <?= htmlspecialchars($post['author']) ?></small>
        <p><?= nl2br(htmlspecialchars(substr($post['content'], 0, 150))) ?>...</p>
    </article>
<?php endforeach ?>