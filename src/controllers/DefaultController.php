<?php
/**
 * Element Link plugin for Craft CMS 3.x
 *
 * Add a link to the CP edit page for Entries, Categories, and other Elements
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2019 Marion Newlevant
 */

namespace marionnewlevant\elementlink\controllers;

use marionnewlevant\elementlink\ElementLink;

use Craft;
use craft\web\Controller;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Marion Newlevant
 * @package   ElementLink
 * @since     1.0.0
 */
class DefaultController extends Controller
{
    // Public Methods
    // =========================================================================


    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/element-link/default/element-edit-url
     *
     * @return mixed
     */

    public function actionElementEditUrl()
    {
        $this->requireAcceptsJson();

        $elementId = (int)(Craft::$app->getRequest()->getBodyParam('elementId'));
        $elementType = Craft::$app->getRequest()->getBodyParam('elementType');
        $siteId = (int)(Craft::$app->getRequest()->getBodyParam('siteId'));
        
        $editUrl = ElementLink::$plugin->elementLinkService->editUrl($elementId, $elementType, $siteId);
        
        if ($editUrl)
        {
            $json = $this->asJson([
                'success' => true,
                'editUrl' => $editUrl,
            ]);
            return $json;

        }
        else
        {
            $json = $this->asJson([
                'success' => false,
                'error' => 'no cpEditUrl',
            ]);
            return $json;
        }
    }
}
