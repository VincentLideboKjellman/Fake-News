<?php
declare (strict_types = 1);
?>
<main>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h1>
                    <?=$title?>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="/processing/news/create.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="title">News Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title...">
                        </div>
                        <div class="form-group">
                            <label for="content">News Content</label>
                            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php if (!$articles): ?>
        <div class="row mt-4">
            <div class="col">
                <h2>You have not created any news yet! Get started!</h2>
            </div>
        </div>
        <?php else: ?>
        <div class="row mt-4">
            <div class="col">
                <h2>Your articles:</h2>
            </div>
        </div>
        <?php endif;?>
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-12 col-md-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col"><h4><?= $_SESSION['user']['name']; ?></h4></div>
                                <div class="col d-flex justify-content-end"><a class="btn btn-warning " href="/processing/news/edit.php?id=<?= $article['id']; ?>">Edit article</a></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col"><?= $article['date']; ?></div>
                                <div class="col d-flex justify-content-end"><a class="btn btn-danger" href="/processing/news/delete.php?id=<?= $article['id']; ?>">Delete article</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                <?= $article['title']; ?>
                            </h4>
                            <p class="card-text">
                                <?= $article['content']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</main>