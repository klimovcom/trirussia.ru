<?php
namespace backend\controllers;

use distance\models\Distance;
use distance\models\DistanceCategory;
use metalguardian\fileProcessor\models\File;
use organizer\models\Organizer;
use post\models\Post;
use product\models\Product;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
use sport\models\Sport;
use user\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    /*'logout' => ['post'],*/
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $userCount = User::find()->count();
        $postCount = Post::find()->count();
        $raceCount = Race::find()->count();
        $productCount = Product::find()->count();

        $daysArray = [];
        $usersArray = [];
        $startDate = mktime(0, 0, 0, date('n'), date('j') - 6);
        for ($i = 0; $i < 7; $i++) {
            $date = strtotime('+' . $i . ' day', $startDate);
            $daysArray[$i] = date('Y-m-d', $date);
            $usersArray[$i] = User::find()->where(['>=', 'created_at', $date])->andWhere(['<', 'created_at', strtotime('+ 1 day', $date)])->count();
        }
        $days = json_encode($daysArray);
        $users = json_encode($usersArray);




        return $this->render('index', [
            'userCount' => $userCount,
            'postCount' => $postCount,
            'raceCount' => $raceCount,
            'productCount' => $productCount,
            'days' => $days,
            'users' => $users,

        ]);
    }


    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function getRaces(){
        return  (new \yii\db\Query())
            ->select('*')
            ->from('races')
            ->limit(10)
            ->offset(210)
            ->all(\Yii::$app->db_old);
    }

    static function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya');
        $str = strtolower(str_replace($rus, $lat, $str));
        $str = rtrim(preg_replace('/[^a-z0-9]+/', '-', $str), '-');
        return $str;
    }

    public function parseRaces(){

        $currencies = [
            'рублей' => 'рубли',
            'евро' => 'евро',
            'долларов' => 'доллары',
            'евро в день' => 'евро',
        ];
        $cnt = 0;
        foreach($this->getRaces() as $race){
            print "model #$cnt<br>";
            if (Race::find()->where(['id'=>$race['id']])->one()) continue;
            $model = new Race();
            $model->id = $race['id'];
            $model->author_id = 1;
            if ($race['date'] > 1)
                $model->start_date = $race['date'];
            if ($race['dateEnd'] > 1)
                $model->finish_date = $race['dateEnd'];
            if ($race['time'] > 1)
                $model->start_time = $race['time'];
            if ($race['country'])
                $model->country = $race['country'];
            $model->published = 1;
            if ($race['region'])
                $model->region = $race['region'];
            if ($race['name']){
                $model->label = $race['name'];
                $model->url = $model->id . '-' . $this->translit($model->label);
            }
            if ($race['type']){
                $sport = Sport::find()->where(['label' => $race['type']])->one();
                if ($sport){
                    print "assigning sport #".$sport->id."<br>";
                    $model->sport_id = $sport->id;
                }
            }
            $model->save(false);
            print "saved with id #".$model->id."<br>";
            if ($race['distance']){
                if (strpos($race['distance'], ',') !== false){
                    $race['distance'] = explode(',', $race['distance'])[0];
                }
                $distanceCategory = DistanceCategory::find()->where(['label' => $race['distance']])->one();
                if ($distanceCategory){
                    print "assigning distance #".$distanceCategory->label."<br>";
                    $distanceRef = new RaceDistanceCategoryRef();
                    $distanceRef->race_id = $model->id;
                    $distanceRef->distance_category_id = $distanceCategory->id;
                    $distanceRef->save(false);
                }


            }
            if ($race['otherdistance'])
                $model->special_distance = $race['otherdistance'];
            if ($race['currency']){
                $model->currency = $currencies[$race['currency']];
                print $model->currency . ' - ' . $race['currency']."<br>";
            } else {
                $model->currency = $currencies['рублей'];
                print $model->currency . ' - ' . $race['currency']."<br>";
            }
            if ($race['organizer']){
                $organizer = Organizer::find()->where(['label' => $race['organizer']])->one();
                if (!$organizer){
                    $organizer = new Organizer();
                    $organizer->label = $race['organizer'];
                    $organizer->save(false);
                }
                print "assigning organizer #".$organizer->label."<br>";
                $model->organizer_id = $organizer->id;
            }
            if ($race['website']){
                $model->site = $race['website'];
            }
            if ($race['excerpt']){
                $model->promo = $race['excerpt'];
            }
            if ($race['description']){
                $model->content = $race['description'];
            }
            if ($race['hashtag']){
                $model->instagram_tag = $race['hashtag'];
            }
            if ($race['facebook_event_id']){
                $model->facebook_event_id = $race['facebook_event_id'];
            }
            if ($race['imagelink'] && @getimagesize('http://www.trirussia.ru/' . $race['imagelink'])){
                $src = $race['imagelink'];

                $extension = explode('.', $src);
                $extension = end($extension);

                $baseName = explode('/', $src);
                $baseName = end($baseName);
                $baseName = explode('.', $baseName)[0];

                $file = new File();
                $file->extension = $extension;
                $file->base_name = $baseName;
                $file->save(false);
                print "assigning file #".$file->id."<br>";

                if (strpos($src, 'http') === false){
                    $src = 'http://www.trirussia.ru/' . $src;
                }

                if (!@getimagesize($src)) {
                    print 'no such photo: ';
                    print $src;
                } else {
                    if (!file_exists(__DIR__.'/../../backend/web/uploads/0/' . $file->id . '-' . $baseName . '.' . $extension))
                        copy($src, __DIR__.'/../../backend/web/uploads/0/' . $file->id . '-' . $baseName . '.' . $extension);
                    $model->main_image_id = $file->id;
                }

            }
            if ($race['favourite']){
                $model->featured;
            }
            $model->save(false);
            print "model saved:<br>";
            print '<pre>';
            var_dump($model->attributes);
            print '</pre>';
        }
    }
}
