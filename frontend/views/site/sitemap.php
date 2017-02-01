<?php
use yii\helpers\Url;
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <?php foreach ($routes as $route): ?>
        <url>
            <loc><?= Url::to($route, true)?></loc>
        </url>
    <?php endforeach; ?>
    <?php foreach ($items as $item): ?>
        <url>
            <loc><?= Url::to($item->getViewUrl(), true) ?></loc>
        </url>
    <?php endforeach; ?>
</urlset>