<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 8/22/16
 * Time: 8:26 AM
 */
use \seo\models\Seo;
use yii\helpers\Html;
?>
<meta name="author" content="<?= Seo::getAuthorMeta(); ?>">
<meta name="keywords" content="<?= Seo::getKeywordsMeta();?>">
<meta name="description" content="<?= Seo::getDescriptionMeta();?>">
<meta property="og:title" content="<?= Seo::getPageTitleMeta();?>">
<meta property="og:url" content="<?= Seo::getUrlMeta(); ?>">
<meta property="og:image" content="<?= Seo::getImageMeta();?>">
<meta property="og:image:type" content="<?= Seo::getImageTypeMeta();?>">
<meta property="og:image:width" content="<?= Seo::getImageWidthMeta();?>">
<meta property="og:image:height" content="<?= Seo::getImageHeightMeta();?>">

<?= Seo::getScript(); ?>

<title><?= Seo::getPageTitleMeta();?></title>
