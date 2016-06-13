<?php
namespace frontend\widgets\auth;
use yii\authclient\widgets\AuthChoice;
use yii\authclient\widgets\AuthChoiceItem;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Class Auth
 * @package frontend\widgets\auth
 */
class Auth extends AuthChoice {

    /**
     * Outputs client auth link.
     * @param ClientInterface $client external auth client instance.
     * @param string $text link text, if not set - default value will be generated.
     * @param array $htmlOptions link HTML options.
     * @throws InvalidConfigException on wrong configuration.
     */
    public function clientLink($client, $text = null, array $htmlOptions = [])
    {
        $text = Html::tag(
            'button',
            '<i class="fa fa-facebook-square fa-lg"></i>&nbsp;&nbsp;Войти через Facebook',
            ['class' => 'btn-secondary btn-lg ' . $client->getName()]
        );

        $viewOptions = $client->getViewOptions();
        if (empty($viewOptions['widget'])) {
            if ($this->popupMode) {
                if (isset($viewOptions['popupWidth'])) {
                    $htmlOptions['data-popup-width'] = $viewOptions['popupWidth'];
                }
                if (isset($viewOptions['popupHeight'])) {
                    $htmlOptions['data-popup-height'] = $viewOptions['popupHeight'];
                }
            }
            echo Html::a($text, $this->createClientUrl($client), $htmlOptions);
        } else {
            $widgetConfig = $viewOptions['widget'];
            if (!isset($widgetConfig['class'])) {
                throw new InvalidConfigException('Widget config "class" parameter is missing');
            }
            /* @var $widgetClass Widget */
            $widgetClass = $widgetConfig['class'];
            if (!(is_subclass_of($widgetClass, AuthChoiceItem::className()))) {
                throw new InvalidConfigException('Item widget class must be subclass of "' . AuthChoiceItem::className() . '"');
            }
            unset($widgetConfig['class']);
            $widgetConfig['client'] = $client;
            $widgetConfig['authChoice'] = $this;
            echo $widgetClass::widget($widgetConfig);
        }
    }

    /**
     * Renders the main content, which includes all external services links.
     */
    protected function renderMainContent()
    {
        foreach ($this->getClients() as $externalService) {
            $this->clientLink($externalService);
        }
    }

}