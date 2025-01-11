# An extension to customize the display of promotions in the checkout for Shopware 6

With the extension, the _display of promotions in_ the _checkout can be customized_.

For example, it is possible to _select an alternative image at_ the _promotion to be displayed in the checkout instead of_ the _marketing icon_.

In addition, a _description can be entered that is displayed below_ the _name of the promotion_ and, for example, _states the restrictions of the promotion again_.

Furthermore, you can _select within_ the _configuration of the extension whether the name of the promotion should be truncated to 60 characters as in the Shopware 6 standard_ and _if so, you can alternatively select a higher value for the truncating_.

## Possible configurations
- select if the name of the promotion should be truncated
- select the number of characters from which the name should be truncated

## How to install the extension
### via console (recommended)
1. Download the latest _SschreierCustomizingDisplayPromotionsInCheckout-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierCustomizingDisplayPromotionsInCheckout_.
3. Move the folder to the project folder _custom/plugins/_ .
4. Connect to the console via ssh:

```
bin/console plugin:refresh
bin/console plugin:install --activate SschreierCustomizingDisplayPromotionsInCheckout
```

### via composer
1. Add the repository URL to the composer.json of the project
```
"repositories": [
    ...,
    {
        "type": "vcs",
        "url": "https://github.com/sschreier/SschreierCustomizingDisplayPromotionsInCheckout"
    }
],
```

2. Connect to the console via ssh and install the plugin source code via the command
```
composer require sschreier/sschreiercustomizingdisplaypromotionsincheckout
bin/console plugin:refresh
bin/console plugin:install --activate SschreierCustomizingDisplayPromotionsInCheckout
```

### via zip upload
1. Download the latest _SschreierCustomizingDisplayPromotionsInCheckout-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierCustomizingDisplayPromotionsInCheckout_.
3. Zip the folder to _SschreierCustomizingDisplayPromotionsInCheckout.zip_.
4. Upload the zip in the Shopware Administration.
5. Install & Activate the extension.

#### extension update (zip)
1. Download the latest _SschreierCustomizingDisplayPromotionsInCheckout-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierCustomizingDisplayPromotionsInCheckout_.
3. Zip the folder to _SschreierCustomizingDisplayPromotionsInCheckout.zip_.
4. Upload the zip in the Shopware Administration.
5. Update the extension.

## Images

### default

![default](https://www.sebastianschreier.de/plugins/SschreierCustomizingDisplayPromotionsInCheckout/SschreierCustomizingDisplayPromotionsInCheckout-Image6.jpg)

### alternative image and description for a promotion in the shopping cart

![alternative image and description for a promotion in the shopping cart](https://www.sebastianschreier.de/plugins/SschreierCustomizingDisplayPromotionsInCheckout/SschreierCustomizingDisplayPromotionsInCheckout-Image1.jpg)

### alternative image and description for a promotion on the checkout register page

![alternative image and description for a promotion on the checkout register page](https://www.sebastianschreier.de/plugins/SschreierCustomizingDisplayPromotionsInCheckout/SschreierCustomizingDisplayPromotionsInCheckout-Image2.jpg)

### alternative image and description for a promotion on the confirm page

![alternative image and description for a promotion on the confirm page](https://www.sebastianschreier.de/plugins/SschreierCustomizingDisplayPromotionsInCheckout/SschreierCustomizingDisplayPromotionsInCheckout-Image3.jpg)

### extension configuration

![extension configuration](https://www.sebastianschreier.de/plugins/SschreierCustomizingDisplayPromotionsInCheckout/SschreierCustomizingDisplayPromotionsInCheckout-Image4.jpg)

### alternative image and description for a promotion within the custom fields of a promotion

![alternative image and description for a promotion within the custom fields of a promotion](https://www.sebastianschreier.de/plugins/SschreierCustomizingDisplayPromotionsInCheckout/SschreierCustomizingDisplayPromotionsInCheckout-Image5.jpg)
