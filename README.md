# Sigeo 🪶

![Logo](./docs/logo.png)
[![version](https://img.shields.io/badge/version-v0.0.1--beta-orange)](https://semver.org)

A stripped down version of Magento 2, in order to use it as a CMS like Wordpress (but with better multisite support).

## Todo

### 0.0.1
- [ ] Remove unnecessary Magento modules.
- [ ] Remove unnecessary vendor modules.
- [ ] Remove unnecessary files & folders in lib, dev ect.
- [ ] Deprecate and remove unnecessary code in existing modules. @TODO SIGEO-0.0.1: refactor

### 0.0.2
- [ ] Replace: Copyright © Magento, Inc. All rights reserved.
- [ ] Rename Magento to Sigeo

### 1.0.0-beta
- [ ] Add docker compose files
- [ ] PHP 8 support

## Modules disabled/removed
- [ ] Magento_AdminAnalytics
- [ ] Magento_Store
- [ ] Magento_AdobeIms
- [ ] Magento_AdobeImsApi
- [ ] Magento_AdvancedPricingImportExport
- [ ] Magento_Directory
- [ ] Magento_Amqp
- [ ] Magento_AmqpStore
- [ ] Magento_Config
- [ ] Magento_Theme
- [ ] Magento_Backend
- [ ] Magento_Variable
- [ ] Magento_Search
- [ ] Magento_Backup
- [ ] Magento_Eav
- [X] Magento_Customer
- [X] Magento_BundleImportExport
- [ ] Magento_CacheInvalidate
- [ ] Magento_AdminNotification
- [ ] Magento_Indexer
- [ ] Magento_Cms
- [ ] Magento_Security
- [ ] Magento_Authorization
- [ ] Magento_GraphQl
- [ ] Magento_StoreGraphQl
- [X] Magento_CatalogImportExport
- [X] Magento_Catalog
- [X] Magento_CatalogInventory
- [X] Magento_Rule
- [X] Magento_Payment
- [X] Magento_CatalogRuleGraphQl
- [X] Magento_CatalogRule
- [X] Magento_CatalogUrlRewrite
- [X] Magento_EavGraphQl
- [ ] Magento_Widget
- [X] Magento_Quote
- [X] Magento_SalesSequence
- [X] Magento_CheckoutAgreementsGraphQl
- [X] Magento_Bundle
- [ ] Magento_CmsGraphQl
- [ ] Magento_CmsUrlRewrite
- [ ] Magento_CmsUrlRewriteGraphQl
- [ ] Magento_CatalogGraphQl
- [X] Magento_User
- [X] Magento_Msrp
- [X] Magento_Sales
- [X] Magento_QuoteGraphQl
- [X] Magento_Checkout
- [X] Magento_Contact
- [ ] Magento_Cookie
- [ ] Magento_Cron
- [ ] Magento_Csp
- [X] Magento_CurrencySymbol
- [X] Magento_CatalogCustomerGraphQl
- [ ] Magento_Integration
- [X] Magento_Downloadable
- [X] Magento_CustomerGraphQl
- [X] Magento_CustomerImportExport
- [ ] Magento_Deploy
- [ ] Magento_Developer
- [X] Magento_Dhl
- [ ] Magento_AsynchronousOperations
- [ ] Magento_DirectoryGraphQl
- [ ] Magento_DownloadableGraphQl
- [X] Magento_CustomerDownloadableGraphQl
- [X] Magento_ImportExport
- [X] Magento_Captcha
- [X] Magento_BundleGraphQl
- [X] Magento_CatalogSearch
- [X] Magento_AdvancedSearch
- [ ] Magento_Elasticsearch
- [ ] Magento_Email
- [ ] Magento_EncryptionKey
- [X] Magento_Fedex
- [X] Magento_GiftMessage
- [X] Magento_GiftMessageGraphQl
- [X] Magento_GoogleAdwords
- [ ] Magento_GoogleAnalytics
- [ ] Magento_Ui
- [X] Magento_CatalogCmsGraphQl
- [ ] Magento_PageCache
- [X] Magento_GroupedProduct
- [X] Magento_GroupedImportExport
- [X] Magento_GroupedCatalogInventory
- [X] Magento_GroupedProductGraphQl
- [X] Magento_DownloadableImportExport
- [X] Magento_ConfigurableProduct
- [X] Magento_InstantPurchase
- [X] Magento_Analytics
- [ ] Magento_JwtFrameworkAdapter
- [ ] Magento_JwtUserToken
- [X] Magento_LayeredNavigation
- [X] Magento_LoginAsCustomer
- [X] Magento_LoginAsCustomerAdminUi
- [X] Magento_LoginAsCustomerApi
- [X] Magento_LoginAsCustomerAssistance
- [X] Magento_LoginAsCustomerFrontendUi
- [X] Magento_LoginAsCustomerGraphQl
- [X] Magento_LoginAsCustomerLog
- [X] Magento_LoginAsCustomerPageCache
- [X] Magento_LoginAsCustomerQuote
- [X] Magento_LoginAsCustomerSales
- [X] Magento_Marketplace
- [ ] Magento_MediaContent
- [ ] Magento_MediaContentApi
- [ ] Magento_MediaContentCatalog
- [ ] Magento_MediaContentCms
- [ ] Magento_MediaContentSynchronization
- [ ] Magento_MediaContentSynchronizationApi
- [ ] Magento_MediaContentSynchronizationCatalog
- [ ] Magento_MediaContentSynchronizationCms
- [ ] Magento_MediaGallery
- [ ] Magento_MediaGalleryApi
- [X] Magento_MediaGalleryCatalog
- [X] Magento_MediaGalleryCatalogIntegration
- [X] Magento_MediaGalleryCatalogUi
- [ ] Magento_MediaGalleryCmsUi
- [ ] Magento_MediaGalleryIntegration
- [ ] Magento_MediaGalleryMetadata
- [ ] Magento_MediaGalleryMetadataApi
- [ ] Magento_MediaGalleryRenditions
- [ ] Magento_MediaGalleryRenditionsApi
- [ ] Magento_MediaGallerySynchronization
- [ ] Magento_MediaGallerySynchronizationApi
- [ ] Magento_MediaGallerySynchronizationMetadata
- [ ] Magento_MediaGalleryUi
- [ ] Magento_MediaGalleryUiApi
- [ ] Magento_Robots
- [X] Magento_MessageQueue
- [X] Magento_CatalogRuleConfigurable
- [X] Magento_MsrpConfigurableProduct
- [X] Magento_MsrpGroupedProduct
- [X] Magento_Multishipping
- [ ] Magento_MysqlMq
- [X] Magento_NewRelicReporting
- [X] Magento_Newsletter
- [X] Magento_NewsletterGraphQl
- [X] Magento_OfflinePayments
- [X] Magento_SalesRule
- [ ] Magento_GraphQlCache
- [X] Magento_CardinalCommerce
- [X] Magento_PaymentGraphQl
- [X] Magento_Vault
- [X] Magento_Paypal
- [X] Magento_PaypalGraphQl
- [X] Magento_Persistent
- [X] Magento_ProductAlert
- [X] Magento_ProductVideo
- [X] Magento_CheckoutAgreements
- [X] Magento_QuoteAnalytics
- [X] Magento_QuoteBundleOptions
- [X] Magento_QuoteConfigurableOptions
- [X] Magento_QuoteDownloadableLinks
- [X] Magento_ConfigurableProductGraphQl
- [X] Magento_RelatedProductGraphQl
- [X] Magento_ReleaseNotification
- [ ] Magento_Sitemap
- [ ] Magento_Reports
- [ ] Magento_RequireJs
- [X] Magento_Review
- [X] Magento_ReviewAnalytics
- [X] Magento_ReviewGraphQl
- [ ] Magento_MediaStorage
- [ ] Magento_Rss
- [X] Magento_Elasticsearch6
- [X] Magento_ConfigurableProductSales
- [X] Magento_SalesAnalytics
- [X] Magento_SalesGraphQl
- [X] Magento_SalesInventory
- [X] Magento_OfflineShipping
- [X] Magento_ConfigurableImportExport
- [X] Magento_UrlRewrite
- [ ] Magento_Elasticsearch7
- [X] Magento_CustomerAnalytics
- [X] Magento_SendFriend
- [X] Magento_SendFriendGraphQl
- [X] Magento_Shipping
- [ ] Magento_RemoteStorage
- [ ] Magento_AwsS3
- [X] Magento_UrlRewriteGraphQl
- [ ] Magento_Webapi
- [ ] Magento_SwaggerWebapi
- [ ] Magento_SwaggerWebapiAsync
- [ ] Magento_Swatches
- [ ] Magento_SwatchesGraphQl
- [ ] Magento_SwatchesLayeredNavigation
- [X] Magento_Tax
- [X] Magento_TaxGraphQl
- [X] Magento_TaxImportExport
- [X] Magento_CompareListGraphQl
- [ ] Magento_ThemeGraphQl
- [ ] Magento_Translation
- [X] Magento_GoogleOptimizer
- [X] Magento_Ups
- [X] Magento_SampleData
- [X] Magento_CatalogUrlRewriteGraphQl
- [X] Magento_CatalogAnalytics
- [X] Magento_Usps
- [X] Magento_CatalogInventoryGraphQl
- [X] Magento_PaypalCaptcha
- [ ] Magento_VaultGraphQl
- [ ] Magento_Version
- [ ] Magento_Swagger
- [ ] Magento_WebapiAsync
- [ ] Magento_WebapiSecurity
- [X] Magento_Weee
- [X] Magento_WeeeGraphQl
- [X] Magento_CatalogWidget
- [X] Magento_Wishlist
- [X] Magento_WishlistAnalytics
- [X] Magento_WishlistGraphQl

## Modules refactored
- 