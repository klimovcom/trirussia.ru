<?php

namespace product\controllers;

use product\models\ProductAttr;
use product\models\ProductAttrValue;
use product\models\ProductCategory;
use product\models\ProductOrder;
use product\models\ProductOrderItem;
use product\models\ProductProductAttrValue;
use Yii;
use product\models\Product;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `product` module
 */
class DefaultController extends Controller
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = ($action->id !== "yandex-money-check");
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $orderType = Yii::$app->request->get('sort');
        switch ($orderType) {
            case 'price_asc' :
                $order = ['price' => SORT_ASC];
                break;
            case 'price_desc' :
                $order = ['price' => SORT_DESC];
                break;
            case 'popularity' :
                $order = ['popularity' => SORT_DESC];
                break;
            default :
                $order = ['popularity' => SORT_DESC];
                break;
        }

        $categories = ProductCategory::find()->published()->all();
        $products = Product::find()->where(['category_id' => ArrayHelper::getColumn($categories, 'id')])->orderBy($order)->published()->all();
        $productsArray = ArrayHelper::index($products, null, 'category_id');

        $attrValues = ProductProductAttrValue::find()->where(['product_id' => ArrayHelper::getColumn($products, 'id')])->joinWith('value')->joinWith('attr')->orderBy(['product_attr.position' => SORT_ASC, 'product_attr_value.position' => SORT_ASC])->all();
        $attrValuesArray = ArrayHelper::index($attrValues, null, 'product_id');

        return $this->render('index', [
            'categories' => $categories,
            'productsArray' => $productsArray,
            'attrValuesArray' => $attrValuesArray,
            'sort' => $orderType,
        ]);
    }

    public function actionView($url) {
        $model = $this->loadProduct($url);

        $model->addStatisticsView();

        $attrValues = ProductProductAttrValue::find()->where(['product_id' => $model->id])->joinWith('value')->joinWith('attr')->orderBy(['product_attr.position' => SORT_ASC, 'product_attr_value.position' => SORT_ASC])->all();
        $attrArray = ArrayHelper::index(ProductAttr::find()->where(['id' => ArrayHelper::getColumn($attrValues, 'attr_id')])->all(), 'id');
        $attrValuesArray = ArrayHelper::index($attrValues, null, 'attr_id');

        return $this->render('view', [
            'model' => $model,
            'attrArray' => $attrArray,
            'attrValuesArray' => $attrValuesArray,
        ]);
    }

    public function actionCart() {
        $orderItems = Yii::$app->cart->getPositions();

        return $this->render('cart', [
            'orderItems' => $orderItems,
        ]);
    }

    public function actionAddProductToCart() {
        $id = (int) Yii::$app->request->post('product_id');
        $quantity = (int) Yii::$app->request->post('quantity');
        parse_str(Yii::$app->request->post('info'));

        $info = [];
        if (isset($product_attr) && is_array($product_attr)) {
            foreach ($product_attr as $value_id) {
                $value = ProductAttrValue::find()->where(['id' => $value_id])->one();
                $info[] = ['attr' => $value->attr->label, 'value' => $value->label];
            }
        }
        $serializedInfo = serialize($info);

        $orderItem = ProductOrderItem::find()->where(['product_id' => $id, 'info' => $serializedInfo])->one();
        if (!$orderItem) {
            $orderItem = new ProductOrderItem();
            $orderItem->product_id = $id;
            $orderItem->info = $serializedInfo;
            $orderItem->save();
        }

        Yii::$app->cart->put($orderItem, $quantity);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'count' => Yii::$app->cart->getCount(),
            'cost' => Yii::$app->cart->getCost(),
        ];
    }

    public function actionChangeCartPositionCount() {
        $id = (int) Yii::$app->request->post('id');
        $diff = (int) Yii::$app->request->post('diff');
        $orderItem = ProductOrderItem::find()->where(['id' => $id])->one();
        $position = Yii::$app->cart->getPositionById($id);
        if (!$orderItem || !$position) {
            throw new NotFoundHttpException();
        }
        $quantity = $position->getQuantity();

        if ($quantity + $diff >= 0) {
            Yii::$app->cart->put($orderItem, $diff);
            $quantity = $quantity + $diff;
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'quantity' => $quantity,
            'cost' => $position->getCost(),
            'total' => Yii::$app->cart->getCost(),
        ];
    }

    public function actionRemoveCartPosition() {
        $id = (int) Yii::$app->request->post('id');
        $position = Yii::$app->cart->getPositionById($id);
        if ($position) {
            Yii::$app->cart->removeById($id);
        }

        return Yii::$app->cart->getCost();
    }

    public function actionDelivery() {
        $model = new ProductOrder();
        $timeArray = ProductOrder::getTimeArray();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['payment', 'label' => $model->label]);
        }

        return $this->render('delivery', [
            'model' => $model,
            'timeArray' => $timeArray,
        ]);
    }

    public function actionPayment($label) {
        $model = $this->loadOrder($label);
        $yandexMoney = '41001650080726';

        return $this->render('payment', [
            'model' => $model,
            'yandexMoney' => $yandexMoney,
        ]);
    }

    public function actionYandexMoneyCheck() {
        $secret = 'vRWZxpgaEzsLOFz3WYFLh51l';
        $post = Yii::$app->request->post();
        $checkString = sha1(ArrayHelper::getValue($post, 'notification_type') . '&' . ArrayHelper::getValue($post, 'operation_id') . '&' . ArrayHelper::getValue($post, 'amount') . '&' . ArrayHelper::getValue($post, 'currency') . '&' . ArrayHelper::getValue($post, 'datetime') . '&' . ArrayHelper::getValue($post, 'sender') . '&' . ArrayHelper::getValue($post, 'codepro') . '&' . $secret . '&' . ArrayHelper::getValue($post, 'label'));

        if ($checkString !== ArrayHelper::getValue($post, 'sha1_hash')) {
            throw new NotFoundHttpException();
        }

        $order = ProductOrder::find()->where(['label' => ArrayHelper::getColumn($post, 'label')])->one();
        if (ArrayHelper::getValue($post, 'withdraw_amount') === $order->cost) {
            $order->status = ProductOrder::STATUS_PAID;
            $order->save();
        }
        return true;
    }

    public function loadOrder($label) {
        $model = ProductOrder::find()->where(['label' => $label])->andWhere(['status' => ProductOrder::STATUS_CREATED])->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

    public function loadProduct($url) {
        $model = Product::find()->where(['url' => $url])->published()->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

}
