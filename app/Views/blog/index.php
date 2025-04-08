<h1 class="mb-8 text-3xl font-bold">Recent posts</h1>
<?php foreach ($posts as $post): ?>
    <article class="mb-8 max-w-4/5">
        <h2 class="mb-2 text-lg font-bold">
            <a class="transition-colors duration-300  hover:text-blue-700" href="<?= BASE_URL . "?url=blog/posts/" . $post['id'] ?>">
                <?= htmlspecialchars($post['title']) ?>
            </a>
        </h2>
        <div class="flex items-center gap-2 mb-4">
            <p class="text-xs tracking-wider uppercase text-slate-700">Author: <?= htmlspecialchars($post['author']) ?></p>
            <div class="h-3 border-r-2 border-slate-400"></div>
            <p class="text-xs tracking-wider uppercase text-slate-700">Created: <?= htmlspecialchars($post['date_created']) ?></p>
        </div>
        <p><?= nl2br(htmlspecialchars(substr($post['content'], 0, 150))) ?>...</p>
    </article>
<?php endforeach ?>