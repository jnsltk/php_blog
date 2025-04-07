<article class="mb-4 max-w-4/5">
    <h1 class="mb-2 text-2xl font-bold">
        <?= htmlspecialchars($post['title']) ?>
    </h1>
    <div class="flex items-center gap-2 mb-4">
        <p class="text-xs tracking-wider uppercase text-slate-700">Author: <?= htmlspecialchars($post['author']) ?></p>
        <div class="h-3 border-r-2 border-slate-400"></div>
        <p class="text-xs tracking-wider uppercase text-slate-700">Created: <?= htmlspecialchars($post['date_created']) ?></p>
    </div>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</article>