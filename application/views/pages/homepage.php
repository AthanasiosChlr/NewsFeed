<div class="container mt-5">
  <h1 class="mb-4">Latest News</h1>
  <div class="row">
    <?php if (!empty($news)): ?>
      <?php foreach ($news as $article): ?>
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
          <div class="card h-100">
            <?php if (!empty($article["image_url"])): ?>
              <img class="card-img-top fixed-image" src="<?= htmlspecialchars($article["image_url"], ENT_QUOTES, "UTF-8") ?>" alt="News image">
            <?php else: ?>
              <img class="card-img-top fixed-image" src="assets/images/default_image.png" alt="Default image">
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($article["title"], ENT_QUOTES, "UTF-8") ?></h5>
              <p class="card-text flex-fill"><?= htmlspecialchars(substr($article["description"], 0, 100) . "...", ENT_QUOTES, "UTF-8") ?></p>
              <a href="<?= htmlspecialchars($article["link"], ENT_QUOTES, "UTF-8") ?>" class="btn btn-primary mt-auto" target="_blank">Read More</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No news available.</p>
    <?php endif; ?>
  </div>
</div>