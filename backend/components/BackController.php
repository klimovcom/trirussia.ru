<?php
namespace backend\components;

use yii\console\Exception;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Class BackController
 * @package backend\controllers
 */
class BackController extends Controller
{
    /**
     * Deletes an existing Race model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    final public function actionDelete($id)
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try{
            $this->findModel($id)->delete();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::$app->session->addFlash('flash-error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }
}