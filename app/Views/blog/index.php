<h1 class="mb-4 text-3xl font-bold">Recent posts</h1>
<?php foreach ($posts as $post): ?>
    <article class="mb-4 max-w-4/5">
        <h2 class="text-lg font-bold">
            <?= htmlspecialchars($post['title']) ?>
        </h2>
        <p class="mb-2 text-xs tracking-wider uppercase text-slate-700">Author: <?= htmlspecialchars($post['author']) ?></p>
        <p><?= nl2br(htmlspecialchars(substr($post['content'], 0, 150))) ?>...</p>
    </article>
<?php endforeach ?>