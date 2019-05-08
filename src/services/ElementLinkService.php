<?php
/**
 * Element Link plugin for Craft CMS 3.x
 *
 * Add a link to the CP edit page for Entries, Categories, and other Elements
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2019 Marion Newlevant
 */

namespace marionnewlevant\elementlink\services;

use marionnewlevant\elementlink\ElementLink;

use Craft;
use craft\base\Component;

/**
 * ElementLinkService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Marion Newlevant
 * @package   ElementLink
 * @since     1.0.0
 */
class ElementLinkService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Return the cpEditUrl of an element.
     *
     * From any other plugin file, call it like this:
     *
     *     ElementLink::$plugin->elementLinkService->editUrl()
     *
     * @return mixed
     */
    public function editUrl(int $elementId, string $elementType, int $siteId)
    {
        $element = Craft::$app->elements->getElementById($elementId, $elementType, $siteId);
        if ($element)
        {
            return $element->cpEditUrl;
        }
        return null;
    }
}
