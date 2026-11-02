# Potential issues to fix

Source: open issues of [shopware/shopware](https://github.com/shopware/shopware), checked against `shopware/trunk` on 2026-11-01.
Screened: 1262 open issues fetched, 655 passed the base filter, about 270 were checked in detail against trunk.
Result: 21 verified candidates plus 1 speculative one, not the 25 asked for.
Round 5 loosened the criteria to medium effort and small design choices; it added 7 verified keeps and 1 speculative one.
The remaining filtered issues are mostly proposals, epics, tooling work, feature requests or code outside this repo (Commercial, B2B, plugins, Meteor).
Most drops were already fixed on trunk, lived in external packages (Meteor, SwagCommercial, plugins) or needed a product decision.

## Candidates

### 1. [#21420](https://github.com/shopware/shopware/issues/21420): Product export issues five statements per product when a main category is configured

Bug · no priority · opened 2026-10-08

- File: `src/Core/Content/ProductExport/Service/ProductExportGenerator.php:152`, `src/Core/Content/Category/Service/CategoryBreadcrumbBuilder.php` (`getMainCategoryFromProduct()`)
- Problem: the in-memory shortcut needs `categoryIds` on the product, but the export criteria never loads it, so every product runs extra queries.
- Fix: load `categoryIds` in the export criteria, or resolve the main category from the preloaded `mainCategories.category` association.
- Effort: 1-3 lines plus a PHPUnit test asserting the query count does not scale with the product count.
- Caveat: that `categoryIds` makes the shortcut hit is not confirmed by a test run yet.

### 2. [#21958](https://github.com/shopware/shopware/issues/21958): CMS text element loses full width when vertical alignment is set

Bug · priority/low · opened 2026-10-22

- File: `src/Storefront/Resources/app/storefront/src/scss/component/_cms-element.scss:274-277`, `src/Storefront/Resources/views/storefront/element/cms-element-text.html.twig:7`
- Problem: `.has-vertical-alignment` is a flex container, so `.cms-element-alignment` shrinks to its content and horizontal text alignment breaks.
- Fix: add `w-100` to the alignment div in the Twig, or `.cms-element-alignment { width: 100%; }` in the SCSS.
- Effort: one-line Twig class or three-line SCSS, style only, no PHP test.

### 3. [#22167](https://github.com/shopware/shopware/issues/22167): Captcha failure without `errorRoute` on POST-only route causes uncaught MethodNotAllowedException (HTTP 500)

Bug · priority/low · opened 2026-10-28

- File: `src/Storefront/Controller/ErrorController.php:100-104`
- Problem: the `_route` fallback is forwarded with GET, so a POST-only route throws `MethodNotAllowedException`.
- Fix: catch `MethodNotAllowedException` around `forwardToRoute()`, or use the `_route` fallback only when it matches via GET, else fall back to `frontend.home.page`.
- Effort: about 5 lines plus a unit test.
- Caveat: which fallback to use is a small product decision.

### 4. [#21984](https://github.com/shopware/shopware/issues/21984): Filtering on a custom field key named `extensions` reads the wrong JSON key

Bug · no priority · opened 2026-10-23

- File: `src/Core/Framework/DataAbstractionLayer/Dbal/EntityDefinitionQueryHelper.php:282` and `:411`, `src/Core/Framework/DataAbstractionLayer/Dbal/FieldResolver/CriteriaPartResolver.php:246`
- Problem: all three sites call `str_replace('extensions.', '', ...)`, which also strips `extensions.` inside `customFields.extensions.foo`.
- Fix: strip the segment only at entity-field level (a leading `extensions.`), not after a JSON field.
- Effort: three sites plus a PHPUnit or integration test; the logic is slightly subtle.

### 5. [#21766](https://github.com/shopware/shopware/issues/21766): `CachedDefaultCategoryLevelLoader` ignores the criteria in its cache key

Bug · no priority · opened 2026-10-19

- File: `src/Core/Content/Category/Service/CachedDefaultCategoryLevelLoader.php:107-130` (`getCacheKey`)
- Problem: the key uses only root id, depth, sales channel id and language id; the criteria only reaches `CategoryLevelLoaderCacheKeyEvent`, and no subscriber exists in `src`.
- Fix: add a hash of the criteria to the key parts.
- Effort: about two lines plus a unit test.
- Caveat: a comment on the issue mentions a second missing input (request context), which widens the scope.

### 6. [#21812](https://github.com/shopware/shopware/issues/21812): `PluginService::getTranslations()` fallback cases have no test assertions

Improvement · no priority · opened 2026-10-21

- File: `tests/unit/Core/Framework/Plugin/PluginServiceTest.php` (source: `src/Core/Framework/Plugin/PluginService.php:232`)
- Problem: two cases are untested: no system-language translation falls back to en-GB, and with neither the first locale is used.
- Fix: add two unit tests with the `getPluginServiceForLocales()` helper, asserting `$upsert[0]['translations']`.
- Effort: two tests, test only, no source change.

### 7. [#22322](https://github.com/shopware/shopware/issues/22322): Seven to-many associations are always null because of mistyped entity properties

Bug · needs-triage · opened 2026-10-30

- File: `src/Core/System/Language/LanguageEntity.php:156,158,162,174` (setters 218, 622, 642, 682), `src/Core/System/SalesChannel/SalesChannelEntity.php:184` (setter 789), `src/Core/Content/Cms/CmsPageEntity.php:56,212`
- Problem: properties, getters and setters are typed with the wrong collections (for example `MailTemplateCollection`), so the DAL assignment throws a swallowed `TypeError` and the association stays null.
- Fix: correct the property, getter and setter types, and add a deprecation note for the changed setter signatures.
- Effort: medium, BC-sensitive, three to five files plus an integration test that walks all definitions.
- Caveat: the issue's sixth row targets `NumberRangeTypeEntity`, which was not checked.

### 8. [#10787](https://github.com/shopware/shopware/issues/10787): A11y tweaks in base-slider.plugin.js

Improvement · priority/low · opened 2025-06-25

- File: `src/Storefront/Resources/app/storefront/src/plugin/slider/base-slider.plugin.js:239` (`_initAccessibilityTweaks`, line 218)
- Problem: the selector `'a, button, img'` skips `input` and `select`, so those stay tabbable inside hidden slides.
- Fix: extend the selector to `'a, button, img, input, select'`.
- Effort: one-line change plus a Jest test.

### 9. [#14470](https://github.com/shopware/shopware/issues/14470): Helper in `Criteria` to check for a specific filter by class and name

Improvement · no priority · opened 2026-01-21

- File: `src/Core/Framework/DataAbstractionLayer/Search/Criteria.php:216`, callers in `src/Core/Content/Seo/SeoUrl/SalesChannel/SalesChannelSeoUrlDefinition.php:23,26`
- Problem: only `hasEqualsFilter($field)` exists, so other filter types cannot be checked by name.
- Fix: add `hasFilter(string $filterClass, string $field): bool`, deprecate `hasEqualsFilter`, switch the two callers.
- Effort: small, plus a unit test and a deprecation/release note.

### 10. [#16655](https://github.com/shopware/shopware/issues/16655): CMS Designer sidebar blocks are randomly sorted

Bug · priority/low · opened 2026-05-06

- File: `src/Administration/Resources/app/administration/src/module/sw-cms/component/sw-cms-sidebar/index.ts:314-322` (`cmsBlocksBySelectedBlockCategory`)
- Problem: the computed property filters the block registry and applies no sort.
- Fix: sort the filtered result in both return branches with `localeCompare` on the translated label (`this.$tc(block.label)`, fallback `block.name`).
- Effort: small plus a Jest test.
- Caveat: the sort key (translated label or internal name) is a minor choice.

### 11. [#7845](https://github.com/shopware/shopware/issues/7845): Sorting by custom field inside a TermsAggregation fails with Elasticsearch

Improvement · no priority · opened 2025-03-24

- File: `src/Elasticsearch/Framework/DataAbstractionLayer/CriteriaParser.php:326-328` (`parseTermsAggregation`)
- Problem: the sorting accessor is never language-prefixed for a `TranslatedField` (customFields), unlike `buildFieldSort()` around lines 1170-1177, so the composite sort source is empty.
- Fix: resolve the field with `$this->helper->getField(...)` and apply `getTranslatedFieldName($accessor, $context->getLanguageId())` for a `TranslatedField`, mirroring `buildFieldSort`.
- Effort: small plus a unit test.

### 12. [#13956](https://github.com/shopware/shopware/issues/13956): Refactor test suite to use `StorefrontAccountOrder.orderExpandButton`

Improvement · no priority · opened 2025-12-10

- File: `tests/acceptance/tests/Product/ProductImagesInTheStorefront.spec.ts:88-89`
- Problem: a TODO and the old `.order-hide-btn` locator are still there; `DownloadDigitalProductFromOrder.ts:15-16` is already migrated.
- Fix: replace line 89 with `await ShopCustomer.presses(StorefrontAccountOrder.orderExpandButton);` and delete the TODO.
- Effort: trivial, test only.

### 13. [#16485](https://github.com/shopware/shopware/issues/16485): Support Google Cloud Storage uniform bucket-level access

Improvement · no priority · opened 2026-04-28

- File: `src/Core/Framework/Adapter/Filesystem/FilesystemFactory.php` (`resolveFilesystemConfig`, `setAllowedValues('visibility', [...])` near line 133), `src/Core/Framework/DependencyInjection/Configuration.php:83-133`
- Problem: any visibility other than `public` or `private` is rejected, so flysystem-google's `noPredefinedVisibility` cannot be used.
- Fix: allow `noPredefinedVisibility` and handle `Config::OPTION_VISIBILITY` for it.
- Effort: small to medium plus a test in `FilesystemFactoryTest`.
- Caveat: check that the `public_url` logic does not break.

### 14. [#18755](https://github.com/shopware/shopware/issues/18755): Implement `destroy()` in core storefront plugins that register listeners outside their instance

Improvement · no priority · opened 2026-07-28

- File: `src/Storefront/Resources/app/storefront/src/plugin/` (for example `quantity-selector/quantity-selector.plugin.js`, `variant-switch/variant-switch.plugin.js`, `forms/form-ajax-submit.plugin.js`)
- Problem: about 67 plugin files call `addEventListener`, but only four (base-slider, gallery-slider, cookie-configuration, form-cms-handler) implement `destroy()`.
- Fix: pick one or a few plugins from the issue's priority list, store the bound handler references and remove them in `destroy()`.
- Effort: small per plugin plus a Jest spec; the issue allows doing it incrementally.

### 15. [#22220](https://github.com/shopware/shopware/issues/22220): Duplicate mail template attachment when sending order documents from Administration

Bug · needs-triage · opened 2026-10-29

- File: `src/Administration/Resources/app/administration/src/module/sw-order/component/sw-order-send-document-modal/index.js:215-229` (`onSendDocument`), `src/Core/Content/Mail/Service/MailService.php:321,441-458`, `src/Core/Content/Mail/Service/MailAttachmentsBuilder.php:59-67`
- Problem: the modal passes the template media as `mediaIds`, and core attaches the template media again, so `terms-and-conditions.pdf` arrives twice.
- Fix: stop sending the template media from the modal (`mediaIds: []`), or deduplicate across the URL path and the builder path.
- Effort: small plus a Jest spec.
- Caveat: static reading only, not reproduced; confirm the builder attaches the template media in the order language first.

### 16. [#17601](https://github.com/shopware/shopware/issues/17601): Active filter properties are only prioritized within the current pagination page

Bug · priority/low · opened 2026-06-19

- File: `src/Administration/Resources/app/administration/src/module/sw-cms/elements/product-listing/config/index.js:78-87,383-413`
- Problem: the paginated search sorts by name first, then moves whitelisted properties to the top of that page only.
- Fix: load the whitelisted properties in a separate query shown first, query the rest with `Criteria.not('AND', [Criteria.equalsAny('id', whitelist)])`, and adjust `propertiesTotal`.
- Effort: medium plus Jest specs.
- Caveat: paging semantics when the whitelist exceeds the page limit need a small decision.

### 17. [#13458](https://github.com/shopware/shopware/issues/13458): Make `TABLES_WITHOUT_DEFINITION` extendable for `dal:validate`

Improvement · priority/low · opened 2025-11-11

- File: `src/Core/Framework/DataAbstractionLayer/DefinitionValidator.php:104,309`, `src/Core/Framework/DependencyInjection/data-abstraction-layer.php:234`
- Problem: custom non-entity tables are reported as "Table X has no configured definition" and cannot be ignored.
- Fix: inject an extra list of ignored tables (container parameter or tag), merge it into the `in_array` check at line 309.
- Effort: small to medium plus a unit test.
- Caveat: the mechanism is open in the issue; a parameter is the cheapest. Check whether a release note is needed.

### 18. [#10801](https://github.com/shopware/shopware/issues/10801): Run a single health check in isolation

Improvement · priority/low · opened 2025-06-25

- File: `src/Core/Framework/SystemCheck/Command/SystemCheckCommand.php:38-70`, `src/Core/Framework/Api/Controller/HealthCheckController.php:59-65`, `src/Core/Framework/SystemCheck/SystemChecker.php:29`
- Problem: only all checks can be run, which makes debugging one check awkward.
- Fix: add an optional check name to `SystemChecker::check()` filtering on `BaseCheck::name()`, a `--check` option on the command and a `check` query parameter on the route; unknown names give an error.
- Effort: small to medium plus unit tests.
- Caveat: open PRs #22176 and #21782 add checks and may conflict in `SystemChecker`; the route behaviour changes, so check RELEASE_INFO.

### 19. [#14585](https://github.com/shopware/shopware/issues/14585): Unified use of the `$prefix` variable

Task · priority/low · opened 2026-01-28

- File: `src/Storefront/Resources/app/storefront/src/scss/component/_product-slider.scss:28`, `component/_gallery-slider.scss:337,357,373,390`, `component/_loader.scss:13`, `layout/_cookie-permission.scss:38`, `skin/shopware/component/_product-box.scss:8`
- Problem: hardcoded `--bs-` custom properties break when the Bootstrap prefix changes; sibling partials already use `$prefix`.
- Fix: replace with `var(--#{$prefix}...)`.
- Effort: small, five SCSS files; run `composer stylelint` and a storefront build.
- Caveat: skip the Twig inline styles (`cms-element-image-gallery.html.twig`, `breadcrumb.html.twig`) unless a global variable is wanted.

### 20. [#7760](https://github.com/shopware/shopware/issues/7760): Get rid of `QueryBuilderDataExtractor` usages in tests

Improvement · priority/low · opened 2025-03-20

- File: `tests/integration/Core/Framework/DataAbstractionLayer/Dbal/FieldResolver/ManyToOneAssociationFieldResolverTest.php`, `tests/unit/Core/Framework/DataAbstractionLayer/Dbal/CriteriaQueryBuilderTest.php`, `tests/unit/Core/System/UsageData/EntitySync/DispatchEntitiesQueryBuilderTest.php`, helper `src/Core/Test/Stub/Doctrine/QueryBuilderDataExtractor.php`
- Problem: the helper reads private DBAL `QueryBuilder` fields via reflection and can break on DBAL updates.
- Fix: assert on `getSQL()` and `getParameters()`, then delete the helper and its test.
- Effort: medium, about 15 call sites; test only, no release note.
- Caveat: SQL string assertions can be brittle.

### 21. [#7605](https://github.com/shopware/shopware/issues/7605): A11y: add a skip link for filters

Improvement · priority/low · opened 2025-03-14

- File: `src/Storefront/Resources/views/storefront/component/skip-to-content.html.twig:12-42`, `base.html.twig:31-34`, `element/cms-element-sidebar-filter.html.twig:29`, `component/product/listing.html.twig:29`, snippets `storefront.en.json:62` and `storefront.de.json:62`
- Problem: keyboard users must tab through every filter (WCAG 2.4.1).
- Fix: add a `skipToFilter` flag and block to the skip-link component, an id on the listing wrapper, and en/de snippets (formal "Sie" in de); enable only on listing and search pages.
- Effort: medium, Twig and snippets only, no PHP integration test; run `composer ludtwig:storefront` and a keyboard check in the browser.
- Caveat: wording and target need a small a11y decision.

### 22. [#17042](https://github.com/shopware/shopware/issues/17042): mod_pagespeed breaks the admin ("setting getter-only property '$i18n'") — speculative

Bug · no priority · opened 2026-05-27

- File: `src/Administration/Resources/app/administration/src/app/adapter/view/vue.adapter.ts:275-280`
- Problem: `$i18n` is defined on `globalProperties` with only a getter and no `configurable: true`.
- Fix: add `configurable: true` and a no-op `set(){}`, the same pattern as line 258.
- Effort: one line plus a Jest test.
- Caveat: nobody has reproduced the error; triage asks to confirm the root cause first.

## Dropped (examples)

- Already fixed on trunk: [#9053](https://github.com/shopware/shopware/issues/9053), [#10424](https://github.com/shopware/shopware/issues/10424), [#14473](https://github.com/shopware/shopware/issues/14473), [#9381](https://github.com/shopware/shopware/issues/9381), [#13104](https://github.com/shopware/shopware/issues/13104), [#12960](https://github.com/shopware/shopware/issues/12960), [#8461](https://github.com/shopware/shopware/issues/8461), [#21327](https://github.com/shopware/shopware/issues/21327), [#12535](https://github.com/shopware/shopware/issues/12535), [#21511](https://github.com/shopware/shopware/issues/21511), [#21596](https://github.com/shopware/shopware/issues/21596), [#19647](https://github.com/shopware/shopware/issues/19647), [#22118](https://github.com/shopware/shopware/issues/22118), [#21209](https://github.com/shopware/shopware/issues/21209).
- Defect lives outside this repo (Meteor, SwagCommercial, plugins, recipe repo): [#21358](https://github.com/shopware/shopware/issues/21358), [#19695](https://github.com/shopware/shopware/issues/19695), [#21519](https://github.com/shopware/shopware/issues/21519), [#21513](https://github.com/shopware/shopware/issues/21513), [#22275](https://github.com/shopware/shopware/issues/22275), [#22273](https://github.com/shopware/shopware/issues/22273), [#22098](https://github.com/shopware/shopware/issues/22098).
- Needs a product or design decision: [#21361](https://github.com/shopware/shopware/issues/21361), [#18322](https://github.com/shopware/shopware/issues/18322), [#21517](https://github.com/shopware/shopware/issues/21517), [#17631](https://github.com/shopware/shopware/issues/17631), [#16342](https://github.com/shopware/shopware/issues/16342), [#22070](https://github.com/shopware/shopware/issues/22070), [#21811](https://github.com/shopware/shopware/issues/21811).
- Open PR touches the code: [#22160](https://github.com/shopware/shopware/issues/22160) and [#22162](https://github.com/shopware/shopware/issues/22162) (PR [#20486](https://github.com/shopware/shopware/pull/20486)).
