<?php
/**
 * Element Link plugin for Craft CMS 3.x
 *
 * Add a link to the CP edit page for Entries, Categories, and other Elements
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2019 Marion Newlevant
 */

namespace marionnewlevant\elementlink;

use marionnewlevant\elementlink\assetbundles\ElementLink\ElementLinkAsset;

use Craft;
use craft\base\Plugin;

/**
 *
 * @author    Marion Newlevant
 * @package   ElementLink
 * @since     1.0.0
 *
 * @property  ElementLinkServiceService $elementLinkService
 */
class ElementLink extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * ElementLink::$plugin
     *
     * @var ElementLink
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * ElementLink::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        if (Craft::$app->getRequest()->getIsCpRequest() && !Craft::$app->getUser()->getIsGuest() && !Craft::$app->getRequest()->getIsAjax())
        {
            // Register our asset bundle
            Craft::$app->getView()->registerAssetBundle(ElementLinkAsset::class);
        }

        Craft::info(
            Craft::t(
                'element-link',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
