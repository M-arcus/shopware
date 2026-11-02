# Unpushed PR branches

Local branches with a fix that is not pushed to the fork yet and has no PR.
Checked on 2026-10-22 against `shopware/trunk` `a3ba3b696be`: the visibility filter and persister branches are still based on `e4d1ec6e269` (2026-10-19), 62 trunk commits behind, and both merge with trunk without conflicts (trunk touched the visibility filter's `RELEASE_INFO-6.7.md` and `sw-product` snippet files, the persister files not).
The #21580, #21657, #20384, #20382 and #20366 branches were pushed on 2026-10-19 and are PRs #21778, #21777, #21775 (merged), #21774 and #21773 (merged) now, see [Fixed in this session](#fixed-in-this-session).
Added on 2026-10-22: the oldest easy issues #8815, #9685, #13369 and #14244, each on its own branch from `a3ba3b696be` with one local commit; all four issues were still open, unassigned and without a PR when the fixes were made.
Added on 2026-10-23: six fixes from the [sales channel scaling audit](#sales-channel-scaling-audit-100-sales-channels), each in its own worktree under `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/` with one local commit and without an issue; every fixed code path also exists in the release v6.7.15.1.
All six were pushed to `origin` and opened as PRs #22012 to #22017 on 2026-10-23, see [Fixed in this session](#fixed-in-this-session).
On 2026-10-25: #9685 and #14244 are PRs #21956 and #21957 now, see [Fixed in this session](#fixed-in-this-session); #13369 (`fix/core-notification-cleanup-task`) is still not pushed.
On 2026-11-01 (upstream refresh against `shopware/shopware`): PRs #21773, #21774, #21775, #21777 and #21778 are merged; issues #8815, #9685, #20366, #20382, #20384, #21580, #21600 and #21657 are closed; #13369, #14244 and #21063 are still open; PR #21957 and PRs #22012 to #22017 are still open.
On 2026-11-02 (PR state refresh by branch): PRs #22288 (`fix/core-cache-uncompress-detect-format`), #22233 (`fix/admin-dashboard-cancelled-orders`), #22289 (`fix/admin-media-list-duplicate-items`) and #22341 (`fix/storefront-product-slider-arrow-hover`) are open; PR #22296 (`test/storefront-analytics-json-ld-major`) merged as `f6a763a1f3a`, moved to [Fixed in this session](#fixed-in-this-session); `fix/storefront-cms-text-full-width` (#21958, `e086660e107`) has no PR yet; the other rows have no PR.
On 2026-11-01 (#7845 update): PR check by branch for the rows below: `fix/storefront-product-slider-arrow-hover` is PR #22341 (open), `fix/admin-dashboard-cancelled-orders` PR #22233 (open), `fix/admin-media-list-duplicate-items` PR #22289 (open), `fix/core-cache-uncompress-detect-format` PR #22288 (open), `test/storefront-analytics-json-ld-major` PR #22296 (merged 2026-10-30 as `f6a763a1f3a`); the other branches have no PR.
On 2026-11-01 (#22322 update): PR states of the rows below rechecked by branch, unchanged (#22233, #22289, #22288, #22341 open; #22296 merged); #22322 is still open without a PR.
On 2026-11-01 (#17601 update): PR states rechecked by branch, unchanged (#22233, #22289, #22288, #22341 open); #17601 is still open, unassigned, without a PR.
On 2026-11-01 (#21984 update): PR states rechecked by branch, unchanged (#22233, #22289, #22288, #22341, #21957 open); the #22220, #21766 and #21984 branches have no PR; #21984 is still open, unassigned, without a PR.

| Issue | Status on trunk | Fixed by | First release | PR text |
|---|---|---|---|---|
| [#16448](https://github.com/shopware/shopware/issues/16448) Product slider arrows show no hover frame | Still open on trunk `88fa9800975`; `border: 0` in `_product-slider.scss` removes the border the base slider hover colours. Checked 2026-10-30: unclaimed, no PR; browser check with injected CSS only (before/after screenshots), no compiled theme. Image slider clipping not confirmed. | `bf03f0179ef` on `fix/storefront-product-slider-arrow-hover` (pushed, PR [#22341](https://github.com/shopware/shopware/pull/22341) open) | not released | `/home/thinkpad/claude-scratchpad/shopware/issue-16448/pr-text.md` |
| (no issue, feature) Visibility filter in the Admin product list | Not on trunk; new "Visibility" filter in the product list. | `24d0272de95` on `feat/admin-product-list-visibility-filter` | not released | [PR text](#pr-text-visibility-filter) |
| (no issue) Login fails with a duplicate key when the old context token is gone | Still open on trunk; `SalesChannelContextPersister::replace()` falls back to an INSERT that collides with the customer's existing context row. Local fix: hand the new token to the existing row. | `c96aba2359e` on `fix/context-persister-replace-duplicate-key` (worktree `/home/thinkpad/claude-scratchpad/shopware/context-persister-replace`) | not released | none yet |
| [#13369](https://github.com/shopware/shopware/issues/13369) Missing Cleanup Task Runner for Old Notifications | Still open on trunk; nothing deletes rows from `notification`. Local fix: daily scheduled task `notification.cleanup` deletes notifications older than the new system config `core.notification.entryLifetimeSeconds` (migration default 30 days, `-1` keeps all) in batches of 500; task added to the telemetry allowlist; RELEASE_INFO entry. Integration, migration and unit tests green, PHPStan/cs clean. Not run in the dev shop (would need `scheduled-task:register`). The RELEASE_INFO entry conflicts with the #14244 branch (both at the end of `## Core`). | `0c36fb5697e` on `fix/core-notification-cleanup-task` | not released | /home/thinkpad/claude-scratchpad/shopware/issue-13369/pr-text.md |
| [#8121](https://github.com/shopware/shopware/issues/8121) As an admin, I want to set maximum discount for a promotion | **2026-10-25:** open, unassigned, no PR; label `testing/acceptance`. The feature exists on trunk (`PromotionDiscountDefinition` `maxValue`, capped in `DiscountPercentageCalculator`, covered by integration tests); only the acceptance test is missing. New spec `tests/acceptance/tests/Checkout/CheckoutWithPromotionMaxDiscount.spec.ts`: API creates a 1500 product and a 10% code promotion, the Admin sets *Maximum discount value* 100 on the discounts tab, the confirm/finish pages and the order show the capped discount. The max value is in the default currency and is converted by the currency factor (ATS sales channel uses US$, factor 1.17085 → −US$117.09 instead of −US$150.00), so the spec computes the expected discount from the factor. Passes against the dev shop (twice); a copy without saving the max value fails with −US$150.00. ESLint and Prettier clean; ATS 12.24.1 installed by `npm ci` in the worktree, Chromium via `npx playwright install chromium`; test data cleaned up (0 leftovers). | `65780c14dab` on `test/acceptance-promotion-max-discount` (not pushed) (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-8121/wt`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-8121/pr-text.md |
| (no issue) Dashboard statistics count cancelled orders | Still open on trunk `5b995146c76`; `OrderAmountService::load()` (route `/api/_admin/dashboard/order-amount`) has no order state filter, so the *Orders* chart counts cancelled orders and *Turnover* counts cancelled orders with a paid transaction. Local fix: join `state_machine_state` on `order.state_id`, skip technical name `cancelled`. Two new cases in the integration `OrderAmountServiceTest` (fail without the fix); integration (also with `V6_8_0_0=1`) and unit tests green, PHPStan and php-cs-fixer clean. No RELEASE_INFO entry. Same change runs as a vendor patch in bdrf-shop-v2. | `736687efdd7` on `fix/admin-dashboard-cancelled-orders` (pushed, PR [#22233](https://github.com/shopware/shopware/pull/22233) open) | not released | /home/thinkpad/claude-scratchpad/shopware/fix-admin-dashboard-cancelled-orders/pr-text.md |
| [#8984](https://github.com/shopware/shopware/issues/8984) Customer number cannot be customised in Admin | **2026-10-29:** open, unassigned, no PR; still on trunk `0365bd00d68` (customer info card shows the number as text in edit mode). Local fix: `mt-text-field` in edit mode with new Twig blocks `..._customer_number_content/_editor`. Jest green (fails without fix), ESLint/Prettier clean, browser before/after done. | `2080601ed99` on `fix/admin-customer-number-edit` (not pushed) (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-8984/shopware`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-8984/pr-text-8984.md |
| [#18322](https://github.com/shopware/shopware/issues/18322) Google Shopping template returns lowest bulk price | **2026-10-29:** open, unassigned, no PR. Local fix: Admin Google Shopping and agentic Google feed templates use `calculatedPrices.first`; migration `Migration1793274576UseFirstTierPriceInGoogleFeedTemplates` updates unmodified stored templates of both (fixtures `issue-18322/`), guard moved out of the #12852 migration test. Migration tests 13 green, agentic export integration test green, PHPStan/cs clean, browser preview 15.00 → 20.00. Test data kept in ddev `db` (user, 2026-10-29): /home/thinkpad/claude-scratchpad/shopware/issue-18322/test-data-18322.md. | `1cf577ebc3e` on `fix/core-google-feed-minimum-tier-price` (not pushed) (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-18322/shopware`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-18322/pr-text-18322.md |
| [#13909](https://github.com/shopware/shopware/issues/13909) Visual Duplication of media under certain conditions | **2026-10-30:** open, unassigned, no PR. Root cause: `sw-media-list-selection-v2` keyed items by URL and stored the drag position on the shared media object, so the same media added twice shared key and position; dragging the first copy moved the last one. Local fix: `listItems` computed with URL+occurrence keys and per-entry drag data. Jest 6/6 (2 new, failed before), 306 related green, ESLint/Prettier clean; browser before/after (slider in an unsaved layout, not saved). | `582d8a63f79` on `fix/admin-media-list-duplicate-items` (pushed, PR [#22289](https://github.com/shopware/shopware/pull/22289) open) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-13909/pr-text-13909.md |
| [#14894](https://github.com/shopware/shopware/issues/14894) CacheValueCompressor static properties are set too late | **2026-10-30:** open, unassigned, no PR. Boot-order claim not reproducible in core; the issue's screenshot (500, `zstd_uncompress(): it was not compressed by zstd` from `SwagCommercial::boot()`) comes from a cache entry written in another format (SwagCommercial 6.10.15 boots after `Framework`, checked in bdrf-shop-v2). Local fix: `CacheValueCompressor::uncompress()` detects zstd/zlib/plain instead of trusting the config. New unit test (failed before; zstd cases skipped locally, no zstd extension on host or ddev), CacheStore/Framework/SystemConfig unit tests green, PHPStan/CS clean. Conflicts with the test file added by open PR #18746. | `e69a5936d6b` on `fix/core-cache-uncompress-detect-format` (pushed, PR [#22288](https://github.com/shopware/shopware/pull/22288) open) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-14894/pr-text-14894.md |
| [#14481](https://github.com/shopware/shopware/issues/14481) IDs in svg result in not-Valid HTML (partial, relates only) | **2026-10-30:** open, unassigned, no PR, maintainer routed it to the framework team. The reported duplicate ids come from header/footer ESI fragments, each rendered with its own icon cache; not fixed here. Local fix covers the bug from sstieler's comment: icons inside `<template>` (add-to-cart alert, pseudo modal back button, stock-adjusted alert) registered in the icon cache, so a later visible copy (cart success alert checkmark with offcanvas auto-open off) only referenced the hidden defs and stayed invisible. `sw_icon_cache_disable()`/`sw_icon_cache_enable()` now pause/resume instead of clearing; the three templates pause around their icons; RELEASE_INFO entry. Checks: 3 IconCacheTwigFilter unit tests (fail before, pass after), cs-fixer, PHPStan, ludtwig 0.14.0; cart page render before/after in `/home/thinkpad/claude-scratchpad/shopware/issue-14481/evidence/`. Not committed. Test data: two `cart` rows, cleanup SQL in `/home/thinkpad/claude-scratchpad/shopware/issue-14481/test-data-14481.md` | uncommitted on `fix/storefront-template-icon-cache` (from `8abb3c3f60c`), worktree `/home/thinkpad/claude-scratchpad/shopware/issue-14481/wt` | not released | `/home/thinkpad/claude-scratchpad/shopware/issue-14481/pr-text-14481.md` |
| [#22220](https://github.com/shopware/shopware/issues/22220) Duplicate mail template attachment when sending order documents from Administration | **2026-11-01:** open, no PR, still on trunk `88fa9800975`. The send-document modal passed the template media as `mediaIds` while `MailAttachmentsBuilder` (lines 59-67) attaches the template media of the context language again, and `onSendDocument` already sends the request in the order language, so the builder path covers the order language. Local fix: the modal no longer loads `media.media` and no longer sends `mediaIds`; unused `EntityCollection` import removed. The existing "should send an email without an error" spec asserts the exact payload without `mediaIds` (31/31 Jest green), ESLint clean. Review loop (2026-11-01, 1 round): no valid findings, commit not amended. Checked: `MailService::getMediaUrls()` turns `mediaIds` into URL attachments (`MailFactory` `addAttachmentUrl`), a path `MailAttachmentsBuilder::deduplicateAttachments()` (binary attachments only) does not cover, so the duplicate is real. With the old `index.js` restored the spec fails on the extra `"mediaIds"` payload key, with the fix 31/31 pass, ESLint and Prettier clean. The `media` entry in the spec's mail template fixture stays: it is what makes the spec fail without the fix. **2026-11-02:** the same pattern in the `sw-mail-template-detail` test send is now fixed in the same commit: it sends only media that is not saved on the template yet (`getUnsavedMailTemplateMedia()`), saved media comes from `loadTemplate()` in core. New spec fails without the fix, Jest `sw-mail-template` 86/86, ESLint and Prettier clean, no new `.vm` access. PR text recreated. No browser check: the duplicate shows only in the sent mail, not in the Admin UI (the dev shop also has no order document or template media). No RELEASE_INFO entry. | `500a4ba0be9` (amended, was `bc98c0148f8`, which is pushed: needs a force push) on `fix/22220-duplicate-mail-template-attachment` (amend not pushed) (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-21`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-22220/pr-text.md |
| [#21766](https://github.com/shopware/shopware/issues/21766) `CachedDefaultCategoryLevelLoader` ignores the criteria in its cache key | **2026-11-01:** open on trunk `88fa9800975`, unassigned, no PR. Local fix: `getCacheKey` adds `'criteria' => Hasher::hash($criteria)` to the key parts, so levels loaded with different criteria no longer share an entry. Rework: the branch was based on an old unrelated commit (it carried the mail-sender staging commits) and is now one commit on `88fa9800975`; the legacy `changelog/_unreleased` file is dropped (trunk uses RELEASE_INFO, a cache key fix needs no entry); commit message `fix(core): ...` with body `- closes #21766`. Unit test `testDifferentCriteriaUseDifferentCacheEntries` had no assertions (risky) and its `expects()` on a stub is ignored; it now asserts the three returned collections, fails without the fix (4 failures) and passes with it (`CachedDefaultCategoryLevelLoaderTest` 7 tests, 51 assertions), php-cs-fixer and PHPStan clean. Review loop: round 1 three valid findings fixed, round 2 no findings. Not visible in Admin or Storefront (cache key only), so no screenshots. Comment on the issue about a second missing input (request context) not addressed. | `5414c27a416` on `bug/21766-include-criteria-in-the-cacheddefa` (not pushed) (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-11`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-21766/pr-text-21766.md |
| [#21984](https://github.com/shopware/shopware/issues/21984) Filtering on a custom field key named `extensions` reads the wrong JSON key | **2026-11-01:** open on trunk `88fa9800975`, unassigned, no PR. `str_replace('extensions.', '', …)` in `EntityDefinitionQueryHelper::getFieldAccessor()`/`resolveAccessor()` and `CriteriaPartResolver::resolveField()` also stripped the key inside JSON paths, so `customFields.extensions.foo` read `$.foo`. Local fix: `getFieldAccessor()` strips only a leading `extensions.` per entity level (recursion rebuilds the path per association); both resolver loops skip `extensions` parts and stop at the first non-association field without resolver, so JSON keys named like an association (`customFields.products`) no longer join it. Test stub `StaticDefinitionInstanceRegistry::getAccessorBuilder()` now returns a builder from its container when one is set (needed to test `CustomFieldsAccessorBuilder` without extending the `@final` stub). Legacy `changelog/_unreleased` file dropped, no RELEASE_INFO entry (plain bug fix). Review loop (2026-11-01, 3 rounds): round 1 two valid (added code comments; JSON key named like an association still joined, new test case failed with `products` joined before the fix), round 2 one valid (PHPStan `class.extendsFinalByPhpDoc` on the anonymous registry subclasses), round 3 no findings. Checks in ddev with the files copied into the main checkout and restored: DAL + `Core/Test` unit tests 1455 green, PHPStan clean, php-cs-fixer clean; DAL integration (`EntityExtensionTest`, `Dbal`, `Search`) 311 run, 7 errors that also fail on trunk (`db_test` lacks `customer_group.price_basis`). Not visible in Admin or Storefront (SQL accessor only), so no screenshots. Commit amended. PR text (2026-11-02) names the wider join change in its Impact block; no RELEASE_INFO entry. | `8bfe7b27f21` on `bug/21984-fix-custom-field-key-named-extensi` (not pushed) (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-10`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-21984/pr-text-21984.md |
| [#21958](https://github.com/shopware/shopware/issues/21958) CMS text element loses full width when vertical alignment is set | **2026-11-01:** open on trunk `88fa9800975`, unassigned, no PR. `.cms-element-text.has-vertical-alignment` is a flex container, so `.cms-element-alignment` shrank to its content. Local fix: `width: 100%` for `.cms-element-alignment` in `_cms-element.scss` (SCSS, not the Twig `w-100`). Review loop: 2 rounds, 1 nit fixed (explanatory comment removed), round 2 no findings; amended into the commit. Stylelint exit 0 (run with `--config-basedir` pointing at the main checkout's storefront `node_modules`). Browser check 2026-11-02: the dev shop returned 500 (`Unknown column 'customer_group.price_basis'`); `database:migrate --all` ran on the shared ddev DB (4 migrations, user-approved). The compiled theme on trunk does not contain the fix, so the "after" state is the rule injected as CSS on the home page: alignment div 363 px before, 1871 px after (container 1873 px). Screenshot: `/home/thinkpad/claude-scratchpad/shopware/issue-21958/before-after-injected-css.jpg`. Style only, no PHP test. | `e086660e107` on `fix/storefront-cms-text-full-width` (not pushed) (worktree `/home/thinkpad/claude-scratchpad/shopware/sh-8/wt`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-21958/pr-text.md (drafted 2026-11-02, no PR yet; commit subject and `- closes #21958` body unchanged) |
| [#22322](https://github.com/shopware/shopware/issues/22322) Seven to-many associations are always null because of mistyped entity properties | **2026-11-01:** open on trunk `88fa9800975`, unassigned, no PR. Properties, getters and setters typed with a class the DAL never assigns, so the swallowed `TypeError` left the association null. Local fix: types corrected for `language.mailTemplateTranslations`, `.mailHeaderFooterTranslations`, `.deliveryTimeTranslations`, `.mailTemplateTypeTranslations`, `sales_channel.documentBaseConfigSalesChannels`, `number_range_type.numberRangeSalesChannels` (the issue's unchecked sixth row, confirmed) and `cms_page.homeSalesChannels`; the new test also found `ImportExportLogDefinition` without `getCollectionClass()`, so `user.importExportLogEntries` and `import_export_profile.importExportLogs` were null too (added). No deprecation layer possible (a native property cannot take both types): `.bc-exclude.php` entries and RELEASE_INFO-6.7 entry, like #7297/#13633. New integration test `EntityToManyAssociationTypeTest` walks every definition of the DAL and the sales channel registry (fails without the fix), unit `SalesChannelEntityTest` adjusted; PHPStan and php-cs-fixer clean. Review loop: 3 valid findings fixed (explanatory test comments removed, guard against an empty walk, sales channel registry covered), move of the check into `DefinitionValidator`/`dal:validate` declined (user, 2026-11-02: test only). **2026-11-02:** PR text drafted (current template: closes line in section 1, empty "Additional notes" dropped, checklist ticked); its Admin API reproduce steps (`POST /api/search/language` with `deliveryTimeTranslations`) were not run, the dev shop serves the main checkout. Next: `git push -u origin bug/22322-fix-seven-to-many-associations-tha`, then `gh pr create`. No screenshots: not visible in Admin or Storefront (the Admin loads `importExportLogs` but renders nothing from it); hydration verified with a throwaway read test. Pre-existing trunk failures, not from this fix: 4 `ImportExportTest` media URL cases, `SalesChannelEntityTest::testDeprecatedGetterThrowsWhenMajorIsActive`, `NumberRangeControllerTest` deprecated preview, `IncrementRedisStorageTest` (no redis ext). | `1e9481581b1` on `bug/22322-fix-seven-to-many-associations-tha` (not pushed) (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-13`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-22322/pr-text.md |
| [#7845](https://github.com/shopware/shopware/issues/7845) Sorting by custom field inside a TermsAggregation fails with Elasticsearch | **2026-11-01 (rework):** open on trunk `88fa9800975`, unassigned, no PR. `CriteriaParser::parseTermsAggregation()` built the composite sort source from the raw accessor, so a `TranslatedField` (custom fields, `name`) sorted on `customFields.sales` instead of `customFields.<languageId>.sales` and every bucket was empty. Fix: resolve the field with `EntityDefinitionQueryHelper::getField()` and mirror `buildFieldSort()`: language-prefix the accessor with the context language, and for a language fallback chain (no `useForSorting` optimization) use the `translated_field_sorting` / `numeric_translated_field_sorting` script as the composite source; the script building moved from `createTranslatedSorting()` into `getTranslatedSortingScript()`. Changelog entry (`issue: 7845`) mentions both. Tests: `testAggregationSortingByTranslatedField` (5 cases, single language: system language and a second context language) and `testAggregationSortingByTranslatedFieldWithLanguageChain` (string custom field, numeric custom field, `metaTitle`); the chain cases failed before the rework fix, `tests/unit/Elasticsearch/Framework/DataAbstractionLayer/` 106/106 green; PHPStan (one `@phpstan-ignore-next-line` for the DSL script shape, same as `parseStatsAggregation()`) and php-cs-fixer clean. Review loop: round 1 one valid finding (chain context dropped every document without a value in the context language, since composite sources skip missing values) fixed test-first, rounds 2 and 3 no findings; amended into the commit. Open notes (older than this fix): `getTranslatedFieldName()` assumes `customFields` is the first accessor part (association custom fields such as `manufacturer.customFields.x` get a wrong accessor); `numeric_translated_field_sorting` returns `Double.MIN_VALUE` (smallest positive, not most negative) for missing values in descending order. Not checked: the numeric fallback script is a composite `terms` source without `value_type`, so OpenSearch may order its values as strings (no OpenSearch locally). Not visible in Admin or Storefront (DAL/Elasticsearch aggregation only, local ddev has no OpenSearch), so no screenshots. | `d5f964a174f` on `bug/7845-fix-sorting-by-custom-field-in-term` (not pushed) (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-17`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-7845/pr-text-7845.md |
| [#22167](https://github.com/shopware/shopware/issues/22167) Captcha failure without `errorRoute` on POST-only route causes uncaught MethodNotAllowedException (HTTP 500) | **2026-11-01:** open on trunk `88fa9800975`, priority/low, no PR. `ErrorController::onCaptchaFailure()` forwarded the `_route` fallback with GET, so a POST-only route threw `MethodNotAllowedException`. Local fix: catch it and forward to `frontend.home.page` (rethrow if home itself fails); `StorefrontController::forwardToRoute()` now restores the router context method in a `finally` (it stayed `GET` after the exception). Unit tests: 2 new in `ErrorControllerTest`, 1 new in `StorefrontControllerTest` (fails without the fix, `GET` instead of `POST`); 32 tests green, php-cs-fixer and PHPStan clean. Review loop: 2 rounds (added comment removed, router context leak fixed). No browser before/after: the ddev shop serves the main checkout only, not this worktree, and no captcha form with a POST-only `_route` is set up. | `185c0e2d231` on `bug/fix-uncaught-methodnotallowedexception-h` (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-9`), commit body `- closes #22167` | not released | none yet |
| [#17601](https://github.com/shopware/shopware/issues/17601) Active filter properties are only prioritized within the current pagination page in category layout configuration | **2026-11-01:** open on trunk `88fa9800975`, unassigned, no PR. The product listing element config (filter tab) loaded one page of properties and only re-sorted that page, so active properties on later pages stayed there. Local fix: `loadFilterableProperties()` loads the active properties with their own query (`equalsAny id`) and the inactive ones with a second query (`not equalsAny id`) that continues after them; one combined list (active, then inactive, each by name) paged with the normal limit (Admin API has no offset, so the inactive slice is cut from one or two pages); `propertiesTotal` is the sum of both totals; toggling *filter by properties* and restoring the inherited filter config reload the list instead of re-sorting the current page. Jest: 5 new DOM specs in `config.spec/filter.spec.js` (mock in `fixtures.js` honours id filters and paging), 28/28 green; the restore spec fails without the fix. ESLint (within the suppression counts) and Prettier clean. Review loop: round 1 five findings (4 valid, fixed: restore path untested, explanatory comments removed; 1 invalid: the eslint-disable description is required by `require-description`), round 2 no findings; amended into the commit. Out of scope: overlapping loads (fast paging/search) can resolve out of order, same race on trunk. Browser check (category Home, layout tab, listing element Filter tab, unsaved): 8 test property groups added (9 filterable), property 07 activated on page 2. Before (trunk build): page 1 shows no active property. After (`index.js` copied into the main checkout, Admin rebuilt): page 1 starts with property 07, page 2 shows 05, 06, 08; then the main checkout file was restored and the Admin rebuilt from trunk. Screenshots in `/home/thinkpad/claude-scratchpad/shopware/issue-17601/screenshots/`. Test data kept, cleanup SQL in `/home/thinkpad/claude-scratchpad/shopware/issue-17601/test-data-17601.md`. Also out of scope: unlinking the inherited filter config does not reload the grid, so the toggles stay stale until the switch is flipped (same on trunk). No RELEASE_INFO entry. | `6386bfabce8` on `bug/17601-prioritize-active-filter-propertie` (not pushed) (worktree `/home/thinkpad/PhpstormProjects/shopware-SH-22`) | not released | `/home/thinkpad/claude-scratchpad/shopware/issue-17601/pr-text.md` |

# Sales channel scaling audit (100+ sales channels)

Audit from 2026-10-23 of every place in the code base that assumes only a few sales channels exist, for a shop with more than 100 sales channels and performance problems.
Checked against `shopware/trunk` `b53810069bb`.
The full report with all findings, fix ideas, mitigations without code changes and the rejected candidates is `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/report.md`.

The audit read trunk, which is newer than any release, so check each finding against the version the shop runs before relying on it.
Two data points from the git history: the sales channel ids in every cheapest price row came with #13206 (2025-11-03) and first shipped in v6.7.5.0, while `SeoUrlPersister::findCanonicalPaths()` has had no sales channel filter since 2019, so it applies to every version.
The shop runs 6.7.15.x: checked against the tag v6.7.15.1, every fixed code path and every open finding below exists in that release unchanged.
Profiling data from the shop (for example Tideways) shows which findings actually matter there.
The fixes below only reach the shop with a release that contains them.

## Fixes on local branches

Each fix is in its own worktree under `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/`, branched with `--no-track` from `shopware/trunk`, one commit per branch, pushed to `origin` and opened as PRs on 2026-10-23.
The first three branches start at `b53810069bb`, the later three at `9f14f565c49`.
PHP tests ran against an own test database `msc_test` on the ddev MySQL, so `db_test` stayed untouched.

| Finding | Local fix | Branch and worktree | Tests and lint |
|---|---|---|---|
| (no issue) `system:update` recompiles themes quadratically: `UpdateSubscriber.php:84` merges the compiled theme ids with `+=`, which drops every id whose list key already exists, so every theme after the first is compiled again from each of its sales channels | Merge the ids with the spread operator; the "covered randomly" `@codeCoverageIgnore` around the skip check is gone, because the new test covers it | `215bfa54d2f` on `fix/theme-update-subscriber-recompile`, PR [#22015](https://github.com/shopware/shopware/pull/22015), in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-theme-recompile` | New `tests/unit/Storefront/Theme/Subscriber/UpdateSubscriberTest.php` (4 tests) fails before (shared theme compiled twice) and passes after; PHPStan/cs clean |
| (no issue) `SeoUrlPersister::findCanonicalPaths()` loads the canonical URLs of all sales channels on every persist call, which is O(N²) per SEO URL batch | Filter by the sales channel ids of the URLs being persisted (`IS NULL` for URLs without a sales channel), so callers that pass URLs of several channels keep working | `c7afda438f5` on `fix/seo-canonical-paths-sales-channel`, PR [#22016](https://github.com/shopware/shopware/pull/22016), in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-seo-canonical` | New integration test "updating one sales channel leaves the others alone"; SEO unit tests (253), SEO integration folders and the customer group / `SeoActionController` / updater tests green; PHPStan/cs clean |
| (no issue) Admin lists silently cut off at 25 (newsletter: 100) sales channels | `Criteria(1, null)` for the default visibilities of a new product, the mail header/footer conflict check, the listing visibility modal, the live search select and the newsletter recipient filter; `sw-seo-url` and `sw-seo-url-template-card` load a selected sales channel by id when it is not in the first page | `accd800cfe0` on `fix/admin-sales-channel-list-limits`, PR [#22017](https://github.com/shopware/shopware/pull/22017), in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-admin-visibility` | 7 new Jest tests, each fails before; 100 suites / 1020 tests in the touched modules green; ESLint and Prettier clean |
| (no issue) Pre-existing bug: `SeoUrlPersister::doUpdateSeoUrls()` uses the last URL's sales channel for obsoleting, retargeting and the deleted flag, so callers that persist URLs of several sales channels in one call (`CustomerGroupRegistrationSeoUrlSubscriber.php:223`, `CustomerGroupSubscriber.php:203`; `SeoActionController` persists one sales channel per call and is not affected) lose the previous URL of every channel but the last and leave their new URLs flagged as deleted | Group the URLs by sales channel and run the existing per-channel logic once per group, with one `SeoUrlUpdateEvent` for the whole call | `de847063a55` on `fix/seo-persister-obsolete-per-sales-channel`, PR [#22013](https://github.com/shopware/shopware/pull/22013), in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-seo-obsolete` | Two new integration tests fail on trunk and pass after; two legacy unit tests now give their URLs one shared sales channel; SEO, customer group and `SeoActionController` tests green; PHPStan/cs clean |
| (no issue) Editing one sales channel's SEO URL template regenerates the SEO URLs of every sales channel for the whole catalog | The subscriber puts the changed template's sales channel (or the default template) into `SeoUrlTemplateIndexingMessage`; the handler calls the new `@internal` `SeoUrlUpdater::updateForTemplate()`, which only regenerates the sales channels using that template; messages queued without the scope still regenerate everything | `0d8677ed454` on `fix/seo-template-change-sales-channel-scope`, PR [#22012](https://github.com/shopware/shopware/pull/22012), in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-seo-template-scope` | Two new integration tests (own template, default template) fail on trunk and pass after; new unit tests for subscriber, handler and message; SEO unit (256) and integration tests green; PHPStan/cs clean |

Expected merge conflicts: the admin list branch touches `sw-product-detail/index.js` and its spec, which `feat/admin-open-product-in-storefront` also changes, and the two `SeoUrlPersister` branches both change the start of `doUpdateSeoUrls()`.

## Found on the way

- The `SeoUrlPersister` multi-channel bug, now fixed on `fix/seo-persister-obsolete-per-sales-channel`, see the table above.
- "Log in as customer" requests one token per sales channel on purpose: #19877 (2026-09-02, closes #13729) moved the token generation to modal open, because a token request inside the click made Mobile Safari drop the new tab.
  Only customers without a bound sales channel trigger it: with "Bind customers to Sales Channel" (`core.systemWideLoginRegistration.isCustomerBoundToSalesChannel`, off by default) the modal is already limited to `customer.boundSalesChannelId`, but the setting only binds customers who register after it is switched on.
  Decision on 2026-10-23: the code stays as it is.
- `AppSeoUrlTest` (8 errors, 1 failure) and `RegisterControllerTest` (5 failures) fail on the fresh `msc_test` database because it has no storefront sales channel; the result is identical on unchanged trunk, so it is environmental.

## Open findings (not fixed)

Ranked by impact on a shop with about 100 sales channels; file references and fix ideas are in the report.

- Every Storefront product load unserializes `product.cheapest_price`, which stores all sales channel ids in every variant × rule row (`CheapestPriceUpdater.php:262`, `CheapestPriceContainer.php:292`).
- Every product, category or landing page save generates SEO URLs once per sales channel × language (`SeoUrlUpdater.php:92-117`).
- Themes are compiled once per sales channel even when channels share a theme: admin theme save inside the request (`ThemeService.php:163`), every plugin/app lifecycle event (`ThemeLifecycleHandler.php:71`), `theme:compile` (`ThemeCompileCommand.php:96`).
- Writes to currency, payment, shipping, tax, country, customer group or language drop the cached context of every sales channel (`CacheInvalidationSubscriber.php:398-424`); system config and navigation caches are invalidated globally too.
- "Log in as customer" sends one token request per sales channel (`sw-customer-imitate-customer-modal/index.js:127`); deliberate since #19877 and kept, see above.
- Elasticsearch product indexing joins visibilities × tags (`ElasticsearchProductDefinition.php:419`) and adds one nested doc plus one field per channel to every product document.
- Pre-rollout readiness checks render three Storefront pages per sales channel in one request; `sitemap:generate` and the product export task scale linearly and run sequentially.

# Potential issues to fix (SH-3, checked 2026-11-01)

Full list also in `/home/thinkpad/PhpstormProjects/shopware/pot.md`. Nothing here is fixed or claimed yet; each candidate was open, unassigned and without a linked PR when checked.

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
- **2026-11-01:** fixed locally as `185c0e2d231` on `bug/fix-uncaught-methodnotallowedexception-h`, see [Unpushed PR branches](#unpushed-pr-branches).

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
- **2026-11-02:** fixed locally (`1e9481581b1`, not pushed), see [Unpushed PR branches](#unpushed-pr-branches); sixth row confirmed and fixed, plus `ImportExportLogDefinition`.

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
- **2026-11-01:** fixed locally as `d5f964a174f` on `bug/7845-fix-sorting-by-custom-field-in-term`, see [Unpushed PR branches](#unpushed-pr-branches).

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

The issues dropped as already fixed are recorded in [Open issues already fixed on trunk, without a link](#open-issues-already-fixed-on-trunk-without-a-link).

# Open issues already fixed on trunk, without a link

Checked against `shopware/trunk` on 2026-09-25. Entries marked **checked in the browser** or **checked on the CLI** were reproduced in the local shop (2026-09-27); the others were checked by reading the current code and the fixing commit. At that time each issue was open, had no linked or cross-referenced PR, and no comment saying it was fixed. Status on 2026-10-05: #11156, #13541, #14246 and #17666 were closed after the short note was posted, all other listed issues are still open, unassigned and without a linked PR; the note is posted on 25 issues, not yet on #8520, #9638 and #9639 (column "Notified", checked 2026-10-05). Checked again on 2026-10-19: no further issue was closed, the other 24 are still open. Checked again on 2026-10-22: still no further issue closed, the same 24 are open. Added 2026-10-01: #8102, #8130, #8520, #9638, #9639, #10099, #10512, #10702, #14246 and #14328 came from checking the 220 oldest open issues that are unassigned, have no linked PR and no `extension/…` label against `shopware/trunk` (`135daff4b87`) by reading the code and the fixing commit; none was checked in the browser. Not added because they're only likely or partly done: [#6989](https://github.com/shopware/shopware/issues/6989) (looks like a duplicate of the fixed #12824, needs a browser check), [#10601](https://github.com/shopware/shopware/issues/10601) (only the opt-in `--useBatchImport` exists), [#9162](https://github.com/shopware/shopware/issues/9162) (merge queue is a repository setting, not code), [#11682](https://github.com/shopware/shopware/issues/11682), [#14125](https://github.com/shopware/shopware/issues/14125), [#10600](https://github.com/shopware/shopware/issues/10600), [#11041](https://github.com/shopware/shopware/issues/11041).

| Issue | Status on trunk | Fixed by | First release | Short note | Notified |
|---|---|---|---|---|---|
| [#7383](https://github.com/shopware/shopware/issues/7383) Technical name in modal for change category layout | Partly fixed, **checked in the browser**: the modal's buttons read "Cancel" / "Save" (`global.default.cancel`). The layouts still render as checkboxes, but they behave as a single choice (ticking a second one unticks the first); only the control's look is left, a UX decision. | [75041bd1e5a](https://github.com/shopware/shopware/commit/75041bd1e5a) most likely (snippet housekeeping; it predates the report, so the report probably came from an older release) | v6.6.10.0 (if 75041bd1e5a is the fix) | The Cancel button now uses `global.default.cancel` and reads "Cancel", maybe thanks to the snippet housekeeping in 75041bd1e5a (no public PR), that would only be a partial fix, the layout choice still uses checkboxes, although only one layout can be selected | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/7383#issuecomment-5856769390) |
| [#8102](https://github.com/shopware/shopware/issues/8102) Enable tests with SystemConfig modification in SaaS | Fixed. The acceptance-test skips "Cache invalidation does not happen immediately on SaaS" (added in c98becd9b5d, #5931) are gone; `tests/acceptance` has no such skip any more, so the system-config tests (BasicConsentBanner*) run again. Checked by reading trunk (2026-10-01). | [9fd0ec3a40c](https://github.com/shopware/shopware/commit/9fd0ec3a40c) ([#13687](https://github.com/shopware/shopware/pull/13687)) | v6.7.6.0 | I think #13687 (9fd0ec3a40c) solved this, the SaaS cache-invalidation skips were removed and the system-config tests run again | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/8102#issuecomment-5934335266) |
| [#8130](https://github.com/shopware/shopware/issues/8130) Add eslint with CI job | Fixed. `.github/workflows/acceptance.yml` has the job `acceptance-code-style`, which runs `npm run lint` in `tests/acceptance`; `acceptance-check` requires it. Checked by reading trunk (2026-10-01). | [6c9726b285a](https://github.com/shopware/shopware/commit/6c9726b285a) ([#17653](https://github.com/shopware/shopware/pull/17653)) | v6.7.13.0 | I think #17653 (6c9726b285a) covers this, the acceptance tests are linted in CI by the `acceptance-code-style` job | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/8130#issuecomment-5931925925) |
| [#8417](https://github.com/shopware/shopware/issues/8417) Anchor links trigger onpopstate event in storefront listing plugin | Fixed, **checked in the browser** on the search results listing: a hash-only change and going back fire no listing request, while a sorting change and going back still reload the listing. The last comment (2025-12-09, "still an issue on 6.7.5.x") predates the fix. | [00111d51fee](https://github.com/shopware/shopware/commit/00111d51fee) (#14539) | v6.7.8.0 | Anchor links shouldn't reload the listing anymore, `listing.plugin.js` now ignores popstate events that only change the hash, I think #14539 (00111d51fee) is what fixed it | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/8417#issuecomment-5856289096) |
| [#8461](https://github.com/shopware/shopware/issues/8461) Shipping address editing CTAs broken on mobile viewport | Obsolete. The modal with "Edit / Select / Add address" CTAs was replaced by the address manager; editing sits in a per-address dropdown (`address-manager-item.html.twig`). The reporter only gave the version as "6.6", so they may have been on a release before the address manager. | [7dbb3e26e62](https://github.com/shopware/shopware/commit/7dbb3e26e62) (#5874) | v6.6.10.0 | Since #5874 (7dbb3e26e62), the modal with the Edit, Select and Add address buttons no longer exists, the address manager replaced it and editing sits in a dropdown on each address, so this is possibly resolved | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/8461#issuecomment-5856731086) |
| [#8520](https://github.com/shopware/shopware/issues/8520) CMS pages are very strongly cached | Fixed by removal. `CachedCategoryRoute` and `CachedNavigationRoute` no longer exist; `CategoryRoute` only adds HTTP-cache tags through `CacheTagCollector` (the issue's option 2, as mitelg's comment says). Left over: `SalesChannelCmsPageLoader` still tags only product ids, so dynamic CMS elements add their own tags. Checked by reading trunk (2026-10-01). | [beb2bbb1769](https://github.com/shopware/shopware/commit/beb2bbb1769) ([#6646](https://github.com/shopware/shopware/pull/6646)) | v6.7.0.0 | With 6.7 the Cached*Routes were removed (beb2bbb1769, #6646), only the HTTP cache is left, so I think this can be closed | no |
| [#8975](https://github.com/shopware/shopware/issues/8975) Product Base Slider does not seem to be responsive on 6.6.10.2 | Probably fixed. `product-slider.plugin.js` now measures the full-width `.cms-element-product-slider` instead of the content-sized slider element, which could be narrow during initialization and produce one slide per view. The fixing PR targeted the minimal box layout (#7746), so this is a likely match, not a confirmed one. | [9eda5a36286](https://github.com/shopware/shopware/commit/9eda5a36286) (#17054) | v6.7.12.0 | Maybe #17054 (9eda5a36286) solved this, the product slider now takes its width from the full CMS element, so it should no longer fall back to one slide on every breakpoint | [yes, 2026-09-30](https://github.com/shopware/shopware/issues/8975#issuecomment-5908965008) |
| [#9053](https://github.com/shopware/shopware/issues/9053) Notification after upload should say the file has been uploaded | Superseded, **checked in the browser**: uploading 6 files in the media module shows the `sw-upload-status` snackbar ("Uploading files (0/6)" … "Upload completed"); the old "File has been saved." notification no longer appears. | [a16e9d516b1](https://github.com/shopware/shopware/commit/a16e9d516b1) (#13689) | v6.7.6.0 | The old "File has been saved." notification is gone, uploads now show their progress in a snackbar ("Uploading files (x/y)", then "Upload completed"), and I think #13689 (a16e9d516b1) resolved this with that change | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/9053#issuecomment-5856728652) |
| [#9381](https://github.com/shopware/shopware/issues/9381) Themes detail page: inconsistent padding in cards | Fixed, **checked in the browser**: all theme detail cards use 24px content padding, fields start 25px inside the card edge. | [a3a8cb97c02](https://github.com/shopware/shopware/commit/a3a8cb97c02) (#19713) | not released yet | With #19713 (a3a8cb97c02), I think, the cards on the theme detail page switched to the default card padding, which should fix this | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/9381#issuecomment-5856723039) |
| [#9638](https://github.com/shopware/shopware/issues/9638) Admin Extension SDK: Iframe full height | Implemented. `sw-extension-sdk-module` passes `full-screen` to `sw-iframe-renderer`, whose `--full-screen` modifier renders the iframe absolutely positioned at 100% height. The issue is a re-import of an older UserVoice request. Checked by reading trunk (2026-10-01). | [24e630dee16](https://github.com/shopware/shopware/commit/24e630dee16) (NEXT-30469) | v6.6.1.0 | I think this exists since 6.6.1.0 (24e630dee16): SDK modules render their iframe full height | no |
| [#9639](https://github.com/shopware/shopware/issues/9639) Admin Extension SDK: Hide page header | Implemented. App modules can pass `displaySmartBar` (next to `displaySearchBar`); `sw-page` hides the whole head area when both are false (`showHeadArea`). Relies on the matching meteor-admin-sdk option. Checked by reading trunk (2026-10-01). | [5a5f3514a9e](https://github.com/shopware/shopware/commit/5a5f3514a9e) (NEXT-34803) | v6.6.2.0 | I think this exists since 6.6.2.0 (5a5f3514a9e): with `displaySmartBar` and `displaySearchBar` false the page header is hidden | no |
| [#10099](https://github.com/shopware/shopware/issues/10099) Subcategories cannot be dropped into non-expandable subcategories | Fixed. `sw-category-tree` sets `allow-drop-into-folder`; hovering a tree item for 1.2 s drops into it, also into categories without children (`sw-tree`, `sw-tree-item`). PR #19760 says "closes #3723", so this duplicate stayed open. Checked by reading trunk (2026-10-01). | [35d1baeced2](https://github.com/shopware/shopware/commit/35d1baeced2) ([#19760](https://github.com/shopware/shopware/pull/19760)) | v6.7.15.0 | I think #19760 (35d1baeced2) fixed this, categories can be dropped into empty categories now | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/10099#issuecomment-5934386729) |
| [#10424](https://github.com/shopware/shopware/issues/10424) CLI command media:delete-unused does not use a limiter | Fixed, **checked on the CLI** with 5 unused test media: `media:delete-unused --limit=2` processed them in batches of 2 (0 → 2 → 4 → 5, 36–40 MiB) and deleted all 5. `UnusedMediaPurger::getUnusedMediaIds()` pages with a cursor. | [db7a2e60af7](https://github.com/shopware/shopware/commit/db7a2e60af7) (#14865) | v6.7.8.0 | I think #14865 (db7a2e60af7) took care of this one, instead of collecting every ID first, `UnusedMediaPurger` now pages through media with a cursor and loads `--limit` IDs per batch | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/10424#issuecomment-5856721230) |
| [#10512](https://github.com/shopware/shopware/issues/10512) Price field support in plugin config | Implemented long before the issue: `config.xsd` allows `<type>price</type>`, which `sw-form-field-renderer` renders as `sw-price-field`. Only the developer docs list of supported types lacks `price`. Checked by reading trunk (2026-10-01). | [fedf0f578e8](https://github.com/shopware/shopware/commit/fedf0f578e8) (NEXT-18901) | v6.4.8.0 | `price` is a supported config.xml type since 6.4.8.0 (fedf0f578e8), it's just missing in the docs list | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/10512#issuecomment-5934411333) |
| [#10702](https://github.com/shopware/shopware/issues/10702) <sw-media-upload-v2> in theme config can not be cleared | Fixed. `DatabaseConfigLoader` uses `array_key_exists('value', …)` instead of `isset`, so a cleared (null) media field overrides the theme.json default. PR #16720 links #16672, which has the same repro. Checked by reading trunk (2026-10-01). | [7864036b092](https://github.com/shopware/shopware/commit/7864036b092) ([#16720](https://github.com/shopware/shopware/pull/16720)) | v6.7.11.0 | I think #16720 (7864036b092) fixed this, a cleared value now overrides the theme.json default | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/10702#issuecomment-5934426594) |
| [#11009](https://github.com/shopware/shopware/issues/11009) Problems with GoogleReCaptchaV3 in create account if phone number is wrong | Fixed, **checked in the browser** (2026-09-30) with reCAPTCHA v3 on dummy keys and a guest registration with the report's phone number and an invalid token: trunk shows the form again with "There was an error with the captcha verification.", with 3717d32855d reverted the same request ends in the 403 `CaptchaException` from the report. Screenshots: /home/thinkpad/claude-scratchpad/shopware/screenshots/11009-trunk-captcha-form-error.jpg, /home/thinkpad/claude-scratchpad/shopware/screenshots/11009-reverted-captcha-403.jpg. When the registration form comes back with a validation error, the reCAPTCHA v3 check fails on the second submit; `GoogleReCaptchaV3::shouldBreak()` now returns `false` and `validate()` returns a violation, so the failure is shown as a form error instead of the error page. | [3717d32855d](https://github.com/shopware/shopware/commit/3717d32855d) (#17733) | v6.7.14.0 | Possibly resolved by #17733 (3717d32855d), reCAPTCHA failures now show up as a form error, so a wrong phone number should no longer end on the error page | [yes, 2026-09-30](https://github.com/shopware/shopware/issues/11009#issuecomment-5908916482) |
| [#11156](https://github.com/shopware/shopware/issues/11156) Assets missing when using Storefront Watcher (theme ID with leading zero) | Fixed for the watcher. The vite watcher sets `$app-css-relative-asset-path` from the quoted theme ID, so the asset URL no longer depends on the unquoted `$theme-id` from `ThemeCompiler::dumpVariables()`. Compiling keeps leading zeros too; only an all-digit theme ID would still be mangled there (about 1 in 3.4 million). **Closed** on 2026-09-29 by r-langenfeld after the short note was posted. | [058b9f46491](https://github.com/shopware/shopware/commit/058b9f46491) (#16486) | v6.7.11.0 | For the watcher, #16486 (058b9f46491) possibly fixed this, the vite watcher builds the asset path from the quoted theme ID, which keeps a leading zero | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/11156#issuecomment-5856738440) |
| [#12535](https://github.com/shopware/shopware/issues/12535) Missing inheritance switch for sw-switch-field in config.xml | Fixed. `hasMapInheritanceSupport()` no longer lists `sw-switch-field`, so `sw-inherit-wrapper` gets the label and renders the switch. Checked in the browser: the switch is shown in sales channel scope, unlinking enables the field, and toggling it works. The fixing PR closes #13118, not this issue. | [fffd39229bc](https://github.com/shopware/shopware/commit/fffd39229bc) (#13185) | v6.7.5.0 | Because `hasMapInheritanceSupport()` no longer lists `sw-switch-field`, `sw-inherit-wrapper` now renders the inheritance switch, I think #13185 (fffd39229bc) fixed this, even though the PR closed #13118 instead of this issue | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/12535#issuecomment-5856734665) |
| [#12960](https://github.com/shopware/shopware/issues/12960) Navigation dropdown: misconfigured subcategory separators when navMedia is present | Fixed, **checked in the browser** with a test category (navigation media plus 7 subcategories): the flyout uses 3 columns (`col-4`), separators only before the 2nd and 3rd item of each row, rows 2 and 3 start without one. Template: `loop.index0 % columnCount` with 3 or 4 columns. | [3d025bf724c](https://github.com/shopware/shopware/commit/3d025bf724c) (#14510) | v6.7.8.0 | The flyout now sets its separators from the column count, 3 with navigation media and 4 without (`loop.index0 % columnCount`), I think #14510 (3d025bf724c) fixed this | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/12960#issuecomment-5856705704) |
| [#13104](https://github.com/shopware/shopware/issues/13104) Snippet field in app configuration results to incorrect styling | Fixed. `sw-snippet-field` got an input wrapper that places the translation (globe) icon inside the field and a `.mt-field` margin override, matching the Meteor fields; the report shows the icon below the input. | [8cb446d2b6d](https://github.com/shopware/shopware/commit/8cb446d2b6d) (#16035) | v6.7.10.0 | I think #16035 (8cb446d2b6d) fixed this, `sw-snippet-field` now keeps its translation icon inside the field like the Meteor inputs, instead of below it | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/13104#issuecomment-5860318865) |
| [#13541](https://github.com/shopware/shopware/issues/13541) `manage-stale-prs` errors in forks | Fixed for the reported workflow: the job only runs when `github.repository == 'shopware/shopware'`. Still open from the comment: scheduled jobs in `01-pr-issue-labeler.yml`, `npm-audit-check.yml` and the failure reporters of `nightly.yml` / `nightly-major.yml` have no repository guard. **Closed** on 2026-09-27 by staabm after the short note was posted. | [6f8d7652209](https://github.com/shopware/shopware/commit/6f8d7652209) (#19123) | CI only (commit in v6.7.14.0) | `manage-stale-prs` only runs when `github.repository == 'shopware/shopware'`, so #19123 (6f8d7652209) possibly fixed the reported workflow, other scheduled workflows still run in forks | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/13541#issuecomment-5856742123) |
| [#14101](https://github.com/shopware/shopware/issues/14101) Saving additional fields (date) for variants is not possible | Not reproducible in the reported flow, **checked in the browser** (2026-10-01) on fresh installs of v6.7.5.1 (the reported version), 6.7.8.0, 6.7.9.1, 6.7.10.0 and 6.7.15.0, plus trunk (2026-09-27): a date custom field (date and time, and date only) set on a variant is kept after saving and a reload and stored in `product_translation.custom_fields`, in English and in Deutsch, with and without a value on the parent. Still open in all of these versions: a variant whose date was saved only in the default language shows the field **empty** in another content language, although the variant's `translated` value has the date; up to 6.7.10.0 the field is editable without an inheritance icon, in 6.7.15.0 it is shown as inherited from the parent (which has no date). That may be what the reporter saw. #15905 (`f545ed3c370`, v6.7.10.0) does not change it. Test project: `shopware-bisect` (worktree `/home/thinkpad/claude-scratchpad/shopware/bisect-14101`). | not fixed (the reported flow works; the language display bug is still open) | — | I can't reproduce this on 6.7.5.1 or later, setting a date on a variant and saving keeps it. What I do see: if the variant's date was saved in one content language, the field is empty in another language. Could you check in which content language you set and viewed the date? | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/14101#issuecomment-5934469461) |
| [#14246](https://github.com/shopware/shopware/issues/14246) remove GitLab CI config | Done. `.gitlab/` is gone from trunk, and there is no `.gitlab-ci.yml` either. Checked by reading trunk (2026-10-01). **Closed** on 2026-10-01 by mitelg after the short note was posted. | [dc33532a908](https://github.com/shopware/shopware/commit/dc33532a908) ([#19345](https://github.com/shopware/shopware/pull/19345)) | v6.7.14.0 | The `.gitlab` folder was removed in #19345 (dc33532a908) | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/14246#issuecomment-5934459316) |
| [#14328](https://github.com/shopware/shopware/issues/14328) Deprecated: Using null as an array offset is deprecated, use an empty string instead | Fixed. `DefaultCategoryLevelLoader::addVisibilityCounts()` skips categories without a parent (`if ($parentId === null) { continue; }`) before `$counts[$parentId] ??= 0;`, the line in the issue's screenshot. Checked by reading trunk (2026-10-01). | [88712c1e5a6](https://github.com/shopware/shopware/commit/88712c1e5a6) ([#15773](https://github.com/shopware/shopware/pull/15773)) | v6.7.9.0 | I think #15773 (88712c1e5a6) fixed this, null parent ids are skipped before they're used as array offsets | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/14328#issuecomment-5934507874) |
| [#14473](https://github.com/shopware/shopware/issues/14473) File uploads not possible: file extensions not extendable | Fixed. `sw-media-upload-v2` passes backend-derived MIME types for the configured `private_allowed_extensions` (`extensionMimeTypesByExtension`) to `checkByExtension()`. The fixing PR closed the duplicate #16163 instead. | [04967a7df2b](https://github.com/shopware/shopware/commit/04967a7df2b) (#17939) | v6.7.13.0 | The Administration gets the MIME types of the configured `private_allowed_extensions` from the backend and checks uploads against them, that change came with #17939 (04967a7df2b), which possibly fixed this, although the PR closed the duplicate #16163 | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/14473#issuecomment-5856745170) |
| [#15537](https://github.com/shopware/shopware/issues/15537) Wishlist count not updated correctly with several browser tabs | Fixed, **checked in the browser** (guest, two tabs): adding a product in a tab loaded before another tab's add keeps both products in `localStorage` and shows the right count. Not covered: the other, already open tab keeps its old count until reload (would need a `storage` event listener, an improvement). The fixing PR closed the duplicate #14671. | [ac5eddb87d8](https://github.com/shopware/shopware/commit/ac5eddb87d8) (#17443) | v6.7.12.0 | Products added in another tab are kept now, because the guest wishlist re-reads `localStorage` before each add or remove, a tab that is already open still shows its old count until it is reloaded, I think #17443 (ac5eddb87d8) fixed this, the PR closed the duplicate #14671 | [yes, 2026-09-27](https://github.com/shopware/shopware/issues/15537#issuecomment-5856753569) |
| [#17666](https://github.com/shopware/shopware/issues/17666) Deprecation for StatesUpdater service wrongly triggered on plain setup | Fixed. The `StatesUpdater` service definition has no service-level `deprecated()` any more, so injecting it into `ProductIndexer`, `RepairDigitalProductStatesSubscriber` and the demodata `ProductGenerator` no longer logs the deprecation; it is only raised when `StatesUpdater::update()` is called. Checked by reading trunk (2026-09-30). **Closed** on 2026-10-01 by shyim after the short note was posted. | [39062633e1f](https://github.com/shopware/shopware/commit/39062633e1f) (#17878) | v6.7.13.0 | I think #17878 (39062633e1f) fixed this, the service-level deprecation was removed, so the notice now only shows up when `StatesUpdater::update()` is really called | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/17666#issuecomment-5934526553) |
| [#19647](https://github.com/shopware/shopware/issues/19647) SeoUrlPersister::updateCanonicalSeoUrls() promotes a second canonical row for the entity being written | Fixed. `updateCanonicalSeoUrls()` only promotes a history row `AND NOT EXISTS` a canonical row for the same language, sales channel, foreign key and route, which is the guard suggested in the issue; the fresh canonical from the `REPLACE` blocks the second promotion. Checked by reading trunk (2026-09-30). | [98af3d004eb](https://github.com/shopware/shopware/commit/98af3d004eb) (#20397) | not released yet | I think #20397 (98af3d004eb) fixed this, the canonical promotion now skips entities that already have a canonical row, which is the check suggested here | [yes, 2026-10-01](https://github.com/shopware/shopware/issues/19647#issuecomment-5931859362) |
| [#21327](https://github.com/shopware/shopware/issues/21327) Administration: sw-tagged-field is practically unusable | Fixed. Same bug as #20751: multi-select values in rule and product stream conditions wrap now (PR title "wrap multi-select values in rule conditions"), so all entered tags are visible and removable. ngocblue already wrote on the issue (2026-10-28) that #22004 fixed it on trunk. Checked by reading trunk `88fa9800975` (2026-11-01). | [c25a7c90eb3](https://github.com/shopware/shopware/commit/c25a7c90eb3) ([#22004](https://github.com/shopware/shopware/pull/22004)) | not released yet | I think #22004 (c25a7c90eb3) fixed this, multi-select values in conditions wrap now, so all entered values can be seen and removed | no |
| [#21511](https://github.com/shopware/shopware/issues/21511) reCAPTCHA v3 shows "Input should not be empty" with ACCESSIBILITY_TWEAKS (same as #15187) | Fixed on 6.7 only. Trunk's `googleReCaptchaV3.html.twig` uses `data-validation="grecaptcha"` (#15212, closes #15187). The report is for 6.6: `v6.6.10.30` and `shopware/6.6.x` (`aa56d99adf2`, 2026-10-30) still render `data-validation="required"` with ACCESSIBILITY_TWEAKS, so this needs a 6.6 backport. Checked by reading both branches (2026-11-01). | [4cb28656170](https://github.com/shopware/shopware/commit/4cb28656170) ([#15212](https://github.com/shopware/shopware/pull/15212)), 6.7 only | v6.7.9.0 (6.6 not fixed) | #15212 (4cb28656170) fixed this for 6.7.9.0, 6.6.x up to 6.6.10.30 still renders `data-validation="required"`, so it would need a backport | no |
| [#21596](https://github.com/shopware/shopware/issues/21596) ACL role editor shows language and locale as granted, but integrations assigned to the role are missing language:read and locale:read | Fixed by own PR #20845 (merged 2026-09-28, before the issue was opened): new roles preselect the default privileges and store them, the grid shows the stored state with regular checkboxes, and `Migration1790281406RestoreIntegrationDefaultPrivileges` adds the missing `language:read`, `locale:read`, `log_entry:create`, `message_queue_stats:read` to integration roles. Reported on 6.7.15.1, which does not contain it. Checked by reading trunk (2026-11-01). | [8a77af1da21](https://github.com/shopware/shopware/commit/8a77af1da21) ([#20845](https://github.com/shopware/shopware/pull/20845)) | not released yet | I think #20845 (8a77af1da21) fixed this, new roles store `language:read` and `locale:read` now and a migration adds them to existing integration roles, it's not in 6.7.15.1 yet | no |
| [#22118](https://github.com/shopware/shopware/issues/22118) Selected values in dynamic product group conditions are not fully visible | Fixed. Same bug as #20751 and #21327: multi-select values in rule and product stream conditions wrap now. ngocblue already wrote on the issue (2026-10-28) that #22004 fixed it on trunk. Checked by reading trunk `88fa9800975` (2026-11-01). | [c25a7c90eb3](https://github.com/shopware/shopware/commit/c25a7c90eb3) ([#22004](https://github.com/shopware/shopware/pull/22004)) | not released yet | I think #22004 (c25a7c90eb3) fixed this, the selected values wrap now and the field grows with them | no |
| [#21209](https://github.com/shopware/shopware/issues/21209) Status Link in the Confirmation Email for Guest Orders | Fixed long before the issue. `OrderRoute::checkGuestAuth()` compares the email with `strtolower()` and the ZIP code with `strtoupper()`, as mstegmeyer suggested in the comments. Reporter's version unknown; older versions are still case-sensitive. Checked by reading trunk (2026-11-01). | [d43cbeeacc4](https://github.com/shopware/shopware/commit/d43cbeeacc4) ([#8860](https://github.com/shopware/shopware/pull/8860)) | v6.7.1.0 | Since 6.7.1.0 (#8860, d43cbeeacc4) the guest order check compares email and ZIP code case-insensitively, so this should be fixed | no |

## Fixed in this session

Fixes made on local branches in this session. Status checked on 2026-10-22: 6.7.16.0 is branched off but not released yet (the newest release is v6.7.15.1), so PRs merged up to the branch-off are planned for 6.7.16.0 and later ones for 6.7.17.0; rows with an open PR are pushed to the fork unless they say "not pushed", rows marked "dropped" were given up in favor of another PR or because they were not needed (patches of deleted branches in /home/thinkpad/claude-scratchpad/shopware/dropped-branches/). The open PRs carry the label `milestone/6.7.17.0`.
PR states refreshed on 2026-10-28 against `shopware/trunk` `6ef38361a0e`: #21086, #21779, #22014 (merged 2026-10-26), #21777 and #21774 (merged 2026-10-23); #20906 closed without merge; #21957, #21413, #21417 and #21741 conflicted with trunk again and were merged with trunk and pushed the same day; the other own PRs are still open. Later on 2026-10-28, #21741 failed `lint` on trunk's new `sw-test-rules/no-vm-access` rule (#21729); #22017 and #21956 would fail on their next run. Follow-up commits for all three, not pushed.

On 2026-10-29, trunk `efaeedfbd2f` (contains #22183, the rate limiter test fix) was merged into #21741 (`769d0ab9da7`), #21956 (`e871a8ca3fd`) and #21417 (`ae25eb83cd1`, blank line before the next RELEASE_INFO heading amended in), all pushed. #21741 Jest 379/379, #21956 Jest 6/6, ESLint clean apart from the known local TS errors; #21417 PHPUnit not run, the ddev DB of this shop was not running. #22017 got a change request from jleifeld (review 5694978396): a criteria without limit is capped at `shopware.api.max_limit` 500, so `Criteria(1, null)` still fails above 500 sales channels. Follow-up commit `c2e8300041b`, not pushed: id lookups (new product default visibilities, mail header/footer check) request ids in chunks of 500, the listing visibility modal requests only the current page, live search and newsletter filter use `sw-entity-single-select` / `sw-entity-multi-id-select`; the old `fetchSalesChannels()` / `salesChannelFilters` loading stays as on trunk (user decision). Jest 131/131, the changed tests fail against the pushed sources, ESLint and Prettier clean. PR text updated in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/admin-sales-channel-list-limits/pr-text.md`. Afterwards, on request, the newsletter filter was switched from `sw-entity-multi-id-select` to Meteor's `mt-entity-select` (registered locally in the component, the Admin registers it nowhere else); follow-up commit `e323e9189c1`, not pushed. The live search keeps `sw-entity-single-select` (user decision). Then, on request, the chunk loops of `c2e8300041b` were replaced with the Admin default: `criteria.setIds()` in the three id lookups (the API drops the limit for an `ids` request, checked in the dev shop: `setIds` with limit 1 or 501 returns all 108 sales channels, an `equalsAny` filter with limit 1 returns 1, limit 501 without ids is rejected); one line each against trunk; follow-up commit `fc477a355e1`, not pushed. Jest 131/131, the three tests fail on trunk. **Browser check 2026-10-29** (worktree dev server on port 5300, 108 test channels, nothing saved): new product gets 30 of 30 default visibilities (built Admin without the fix: 25), the listing visibility modal names rows 26 to 30, the live search finds and selects "MSC test 99", the mail header/footer warning lists all 30, the SEO template card and the product SEO tab show the headless hint / disabled SEO path for "MSC test 11". Two problems: (1) `mt-entity-select` in the newsletter filter sorts its server search by name and does not page search results, so "MSC test 99" (term matches 106 channels, it is on page 3 by name) cannot be found by typing; without a term, scrolling pages correctly. (2) The new-product Sales Channels select stays empty although the product has 30 visibilities, with and without the fix: `sw-entity-multi-select` copies `entityCollection` on create and only has a shallow watcher, `sw-product-detail` pushes the default visibilities into the same collection after an async fetch; calling `refreshCurrentCollection()` shows them. Not from this PR. PR text step 1 now points to the visibility modal. On request, problem (1) was solved by going back to `sw-entity-multi-id-select` (follow-up commit `9bbf364ca30`, reverts `e323e9189c1`, not pushed): "MSC test 99" is the first hit and the filter applies; problem (2) gets its own fix later on a separate branch from trunk (user decision). On request, the four follow-up commits `c2e8300041b`, `e323e9189c1`, `fc477a355e1` and `9bbf364ca30` were squashed into `ad466d7f77b` "fix(administration): load sales channels by ids or lazily, not unlimited" (same tree); trunk `8a07eb5d429` merged in `37166440a27` (clean, Jest 131/131, ESLint clean, lint counts at baseline) and pushed to origin on 2026-10-29. The PR description still needs the updated text from `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/admin-sales-channel-list-limits/pr-text.md`.

On 2026-10-29, the unpushed branches were rebased onto `shopware/trunk` `0365bd00d68` (old -> new head): `feat/admin-product-list-visibility-filter` `38a29b1d3c1` -> `1a332b156e7`, `fix/core-notification-cleanup-task` (#13369) `b3761d7824c` -> `91d6f204a0b`, `fix/context-persister-replace-duplicate-key` `13d483f7498` -> `69ac3bb9820`, `test/acceptance-promotion-max-discount` (#8121) `4474e717bf9` -> `792727490b0`. The release-note fixes from the dropped merge commits were restored into the commits that add the entries; each branch's change against trunk is line for line the same as before. Visibility filter: Jest 41/41, ESLint clean; #13369: PHPUnit 21 tests, PHPStan clean; context persister: integration 27, PHPStan clean; #8121: acceptance test not run. Map: `/home/thinkpad/claude-scratchpad/shopware/rebase-2026-10-29-map.md`. Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-setids-*-2026-10-29.jpg`. Jest 16/16 in `sw-newsletter-recipient`, ESLint and Prettier clean.

| Issue | Status on trunk | Fixed by | First release | PR text |
|---|---|---|---|---|
| (no issue) Jest Storefront (major) red on every PR | **2026-11-02:** merged as PR [#22296](https://github.com/shopware/shopware/pull/22296) on 2026-10-30, merge commit `f6a763a1f3a`. #21007 (`40af29daa52`) enables `JSON_LD_DATA` in the major lane; the 5 analytics event tests (add-to-cart, remove-from-wishlist) now render the JSON-LD script in their fixtures. Analytics tests 318/318 in both modes, full Storefront suite in major mode 1516 passed, ESLint clean. | `50e99b5d5f4` (PR head) | not released | /home/thinkpad/claude-scratchpad/shopware/storefront-analytics-json-ld-major/pr-text.md |
| [#9365](https://github.com/shopware/shopware/issues/9365) Selecting a layout should use radio buttons | **2026-10-30 (2):** marcelbrode's 2nd review (global registration, drop local `components`, UPGRADE-6.8 entry, `selectItem` nit, root margin/gap) done in `ac675b0eaec` (not pushed); spacing back to trunk (20px), new screenshots; reply draft /home/thinkpad/claude-scratchpad/shopware/issue-9365/pr-reply-22225-marcelbrode-review-2.md. PR [#22225](https://github.com/shopware/shopware/pull/22225) open. **2026-10-30:** review by marcelbrode asked for Meteor `MtRadioGroup`; follow-up `dc90b33e3c5` uses `mt-radio-group-root`/`-custom-item`/`-indicator` (grid) and `-item` (list), registered locally like `MtCollapsible`; copied radio SCSS removed. Jest 16 + sw-cms 800 green, ESLint (one false-positive `label-has-for` warning), Stylelint, Prettier clean; browser: click, arrow keys, list label click OK. Reply draft /home/thinkpad/claude-scratchpad/shopware/issue-9365/pr-reply-22225-marcelbrode-mt-radio-group.md. **2026-10-29:** open, unassigned, no PR. Local fix: `sw-cms-layout-modal` grid and list view use radios (list: radio in name cell, data-grid selection off); `gridPreSelection`/`selectInGrid` deprecated. Jest 16 green, ESLint/Stylelint/Prettier clean, browser before/after done (admin build caught an undefined `square` mixin and a hidden radio, both fixed). | `2eee8ad219c`, `dc90b33e3c5` (not pushed) on `fix/admin-cms-layout-modal-radio` (not pushed) (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-9365/shopware`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-9365/pr-text-9365.md |
| [#15901](https://github.com/shopware/shopware/issues/15901) Element settings - Selects clearable that shouldn't be | PR [#22222](https://github.com/shopware/shopware/pull/22222) open. **2026-10-29:** open, unassigned, no PR. Local fix: `:hide-clearable-button="true"` on 33 required `mt-select`s (boxLayout, displayMode, navigationArrows/Dots, galleryPosition, form type) and no clear button on the product slider assignment type; alignment selects stay clearable. New template spec; all 70 CMS element suites green, ESLint/Prettier clean, browser before/after done. | `557232a0824` on `fix/admin-cms-element-selects-not-clearable` (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-15901/shopware`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-15901/pr-text-15901.md |
| [#19734](https://github.com/shopware/shopware/issues/19734) Administration Update Modal CSS issues | PR [#22224](https://github.com/shopware/shopware/pull/22224) open. **2026-10-29:** open, unassigned, no PR. Mostly hidden on trunk since the update rework #19666 dropped `variant="small"`; still reproducible with the small modal width and German labels (buttons stacked, no gap). Local fix: footer actions flex row with gap, checkbox margin rule targets `.mt-field--checkbox`. Stylelint clean, browser before/after done. | `a77afd87fa5` on `fix/admin-update-modal-footer-spacing` (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-19734/shopware`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-19734/pr-text-19734.md |
| (no issue, feature) Detect rules with identical conditions | **2026-10-28:** PR [#20906](https://github.com/shopware/shopware/pull/20906) closed by M-arcus on 2026-10-26, not merged: the feature goes to FroshTools instead ([FriendsOfShopware/FroshTools#501](https://github.com/FriendsOfShopware/FroshTools/pull/501)). Before: **2026-10-25:** open PR [#20906](https://github.com/shopware/shopware/pull/20906) (since 2026-09-25, labels `milestone/6.7.17.0`, `waiting-on/author`, no review). GitHub reported a merge conflict in `RELEASE_INFO-6.7.md`; trunk `197b0fcc10e` merged in `68b7cee3028` (worktree `/home/thinkpad/claude-scratchpad/shopware/pr-20906/wt-merge-trunk`). The two entries ("Rules with identical conditions are detected", "Rule Builder shows rules with identical conditions") landed in the released 6.7.16.0 section and were moved to `## Core` and `## Administration` of 6.7.17.0; section check ok. `blocks-list.json` (changed on both sides) merged cleanly, valid JSON. PHPStan clean on the PR files (PHPUnit/Jest not rerun: Shopware ddev stopped; no other PR file changed on trunk). Pushed, PR mergeable again. Feature: rules get a read-only `configHash` checksum of their conditions (`RuleConfigurationNormalizer`, `RuleConfigHashUpdater` in `rule.indexer`, migration `Migration1790338905AddConfigHashToRule`); Admin shows a duplicate hint on the rule detail page and a "Potential duplicates" filter in the rule list. | `7395a1d9d8a`, trunk merge `68b7cee3028` on `feat/rule-find-duplicates` ([#20906](https://github.com/shopware/shopware/pull/20906)) | not merged (PR closed) | in the PR |
| [#14244](https://github.com/shopware/shopware/issues/14244) FileSaver persistFileToMedia Unable to save title and alt text | **2026-11-01:** issue still open; PR [#21957](https://github.com/shopware/shopware/pull/21957) still open, not merged. **2026-10-28:** GitHub reported a merge conflict in `RELEASE_INFO-6.7.md` again; trunk `6ef38361a0e` merged in `1a60bc246a3` (blank line added before trunk's next heading, section check ok, FileSaverTest unit 12 + integration 21 green), pushed, mergeable. **2026-10-25:** open PR [#21957](https://github.com/shopware/shopware/pull/21957) (milestone/6.7.17.0). GitHub reported a merge conflict in `RELEASE_INFO-6.7.md`; trunk `197b0fcc10e` merged in `ccb9b59984b` (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-14244/wt-merge-trunk`), blank line added before trunk's next heading, section check ok, PHPStan clean on the PR files (PHPUnit not rerun: Shopware ddev stopped; no PR file changed on trunk). Pushed, PR mergeable again. Before: still open on trunk; `MediaFile` has no title or alt, so callers need a second media update. Local fix: optional `$title` and `$alt` on `MediaFile` (with getters), written in the single update of `FileSaver::persistFileToMedia()` only when set; RELEASE_INFO entry. Unit and integration tests fail before (one `media.written` event, title and alt read back), PHPStan/cs clean. The RELEASE_INFO entry conflicts with the #13369 branch. | `3dd62cd9b0a`, trunk merge `ccb9b59984b` on `fix/core-media-file-title-alt` ([#21957](https://github.com/shopware/shopware/pull/21957)) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-14244/pr-text.md |
| [#20344](https://github.com/shopware/shopware/issues/20344) Anchored `preg_match()` patterns across `src/` omit the PCRE `D` modifier | **2026-10-22:** issue closed on 2026-10-22 (nfortier-shopware); the last per-domain PRs [#21671](https://github.com/shopware/shopware/pull/21671) (2026-10-21) and [#21178](https://github.com/shopware/shopware/pull/21178) (2026-10-22) are merged. **Dropped** (2026-10-16: [#20932](https://github.com/shopware/shopware/pull/20932) closed by nfortier-shopware, the work continues in the per-domain PRs [#21177](https://github.com/shopware/shopware/pull/21177), [#21179](https://github.com/shopware/shopware/pull/21179), [#21180](https://github.com/shopware/shopware/pull/21180), [#21181](https://github.com/shopware/shopware/pull/21181), [#21182](https://github.com/shopware/shopware/pull/21182), [#21591](https://github.com/shopware/shopware/pull/21591) and the PHPStan rule [#21178](https://github.com/shopware/shopware/pull/21178)). Before: Still open on trunk, fix in open PR [#20932](https://github.com/shopware/shopware/pull/20932) (approved by mitelg, then changes requested by SpiGAndromeda on 2026-10-02; the follow-ups up to `f137c78acb1` are pushed). Since 2026-10-02 nfortier-shopware has open PRs that add `D` per domain ([#21177](https://github.com/shopware/shopware/pull/21177), [#21179](https://github.com/shopware/shopware/pull/21179), [#21180](https://github.com/shopware/shopware/pull/21180), [#21181](https://github.com/shopware/shopware/pull/21181), [#21182](https://github.com/shopware/shopware/pull/21182)) and the PHPStan rule [#21178](https://github.com/shopware/shopware/pull/21178), which overlap with #20932; covered by unit tests that failed before: the sales channel file family and path segments (`"..\n"` passed the `..` guard), the system config domain and zip codes checked against a country pattern reject a trailing newline. After review (keulinho), every site from the audit list got `D` too: OpenAI and Google feed validators, migration and theme create commands, installer locales, Storybook query keys, admin search prefix terms and the test namespace check. The SVG sanitizer trims and the SCSS hex compare-back were replaced by `D`; the `trim()` in `FieldSerializer` and `ThemeConfigTool` stays, it normalizes the value that is used afterwards. 2026-10-16: trunk merged into `fix/core-regex-trailing-newline` (`123198b6ba4`, not pushed); trunk already has the fix via #21181/#21591, so the 11 conflicts went to trunk's side and duplicate tests were dropped (`20932-dropped-duplicates.patch`); the PR now only adds `testItRejectsParentSegmentWithTrailingNewline`; title/description kept as is (user's choice). | dropped, was `9d841367310` + `3faafc435c5` on `fix/core-regex-trailing-newline` ([#20932](https://github.com/shopware/shopware/pull/20932), closed) | — | [PR text](#pr-text-20344) |
| [#21063](https://github.com/shopware/shopware/issues/21063) Asset fallback URLs retain the first request host in long-running workers | **2026-11-01:** issue still open; PR [#21185](https://github.com/shopware/shopware/pull/21185) was closed without merge on 2026-10-28. **2026-10-22:** still open; [#21185](https://github.com/shopware/shopware/pull/21185) is still open with changes requested. Still open on trunk, local fix dropped (2026-10-05) in favor of [#21185](https://github.com/shopware/shopware/pull/21185) (wakqasahmed, review pending), which was opened for the same issue before mine was pushed; covered by unit tests that failed before: a reused `FallbackUrlPackage`, the `@TestBundle` package from `AssetPackageService` and a reused `ThemeAssetPackage` kept `first.example` for a second request on `second.example`, now each resolves the current request; an explicit CDN URL stays unchanged. Sibling fixed in the same commit: `FilesystemFactory` froze the public filesystem URL (media URLs) the same way, now `FallbackPublicUrlGenerator` resolves it per call (`FilesystemFactoryTest`, `LocalFactoryTest`, `FallbackPublicUrlGeneratorTest` failed before); RELEASE_INFO entry added. No browser check, it needs one long-running worker serving two hosts (FrankenPHP). | dropped, was `832cfb169da` on `fix/core-asset-fallback-url-per-request`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/0001-fix-core-resolve-fallback-asset-and-media-URLs-from-.patch | — | [PR text](#pr-text-21063) |
| [#21124](https://github.com/shopware/shopware/issues/21124) Logging decorators retain buffered records after reset() | **2026-10-22:** issue closed on 2026-10-06 with the merge of [#21183](https://github.com/shopware/shopware/pull/21183) ([9ee3c4c9b10](https://github.com/shopware/shopware/commit/9ee3c4c9b10)). Still open on trunk; my PR [#21192](https://github.com/shopware/shopware/pull/21192) was closed on 2026-10-05 as a duplicate of [#21183](https://github.com/shopware/shopware/pull/21183) (wakqasahmed, approved), which forwards `reset()` the same way; `ExcludeFlowEventHandler`, `ErrorCodeLogLevelHandler` and `ExcludeExceptionHandler` forward `reset()` to a resettable inner handler, like Monolog's `HandlerWrapper`. Covered by unit tests with a real `FingersCrossedHandler` (the info record from before the reset was flushed before), plus a non-resettable inner handler. `DoctrineSQLHandler` wraps nothing, so no sibling. | dropped, was `34707f4671f` on `fix/core-log-handlers-forward-reset` ([#21192](https://github.com/shopware/shopware/pull/21192), closed) | 6.7.16.0 (via #21183, not released yet) | [PR text](#pr-text-21124) |
| [#21214](https://github.com/shopware/shopware/issues/21214) [Administration] Product detail only shows the first 25 custom field sets (regression from #17134) | **2026-10-22:** still open, approved by jleifeld (2026-10-14), not merged yet. Still open on trunk, fix in open PR [#21291](https://github.com/shopware/shopware/pull/21291). Since [ae923b7596](https://github.com/shopware/shopware/commit/ae923b7596) (#17134) `sw-product-detail` loads its sets through `customFieldDataProviderService.getCustomFieldSets('product')`, whose default limit is 25, instead of its own `new Criteria(1, null)`; [3de64b0f6a](https://github.com/shopware/shopware/commit/3de64b0f6a) (#20738) passed `null` again for 7 other callers but missed this one. The other 21 callers (rule, promotion, media, settings modules, …) were always capped at 25. Per the user's decision the shared default is now unlimited: `DEFAULT_LIMIT = null` (`src/app/service/custom-field.service.js:5`), so every page loads all sets; the sales channel page keeps its explicit 100. The service spec now expects no default limit (failed before: `Received: 25`); 176 Jest tests of the service and the product, rule, promotion, media and sales channel pages pass. First version (`6a68cedc2fc`, product page only) was replaced by amending. Not checked in the browser (extension not connected at the time, and the shop has 1 custom field set). | `9a400eeb67f` on `fix/admin-product-detail-all-custom-field-sets` ([#21291](https://github.com/shopware/shopware/pull/21291)) | open PR (milestone/6.7.17.0) | [PR text](#pr-text-21214) |
| (no issue) Internal links in rich text get `rel="noreferrer noopener"` and lose the referrer | **2026-10-22:** still open, no review yet. Fix in open PR [#21334](https://github.com/shopware/shopware/pull/21334). No upstream issue or PR (searched "noreferrer" and "noopener"). The default Admin text editor writes `target="_self"` on every link (since NEXT-2604, 2019), and HTMLPurifier's default `HTML.TargetNoreferrer`/`HTML.TargetNoopener` add both rels to any link with a `target`; since NEXT-15172 (2021) that is stored on save. **Checked in the browser** (2026-10-07): a product description link to another product page was stored with `rel="noreferrer noopener"`, and after clicking it `document.referrer` was empty; with the fix, saving again removed the rel and the next page got the product page as referrer. `HtmlSanitizer` now turns off both purifier options, and the new `@internal` `LinkTargetRelAttrTransform` adds `noreferrer noopener` only for `_blank` or named targets; `_self`, `_parent` and `_top` stay without rel. Unit tests (5 sanitizer cases failed before), the integration test for `_blank` passes unchanged. Config-only alternative tested on trunk: `HTML.TargetNoreferrer: false` in the `basic` set gives every target link `rel="noopener"`, also new-tab links to other sites. After review (2026-10-07, not committed): a set that turns off `HTML.TargetNoreferrer` or `HTML.TargetNoopener` is still honored, now only for new-window links. Earlier decisions all limit the rels to new-tab or external links: NEXT-7435 (`f7a8955a50c`, `88dbaed0ef1`), NEXT-9410 (`e9d9f14b604`), [#2283](https://github.com/shopware/shopware/pull/2283) / NEXT-19859 (`2672ce6a48b`); none put them on same-window links. Cleanup script for stored content: `/home/thinkpad/claude-scratchpad/shopware/rel-noreferrer/clean-same-window-link-rel.php` (tested locally). | `9cac81c9d40` + `1c585d51f4f` (comments removed) on `fix/core-html-sanitizer-same-window-link-rel` ([#21334](https://github.com/shopware/shopware/pull/21334)) | open PR (milestone/6.7.17.0) | [PR text](#pr-text-same-window-link-rel) |
| (no issue, feature) Visibility filter in the Admin product list | New feature on request. "Visibility" filter (`visibility-filter`, 30/20/10/not assigned, **single select** via the new generic filter type `single-select-filter` / `sw-single-select-filter`, user request 2026-10-08) right after "Sales Channels"; `normalizeVisibilityFilters()` in `sw-product-list` wraps visibility + sales channel in one AND multi filter in `getList()` (separate top-level filters did NOT match the same visibility row, caught by the API check) and turns "not assigned" into `NOT EXISTS` for the selected channels (or `visibilities.id` null), badge count unchanged. API re-check: 8 cases OK. Jest tests (new `sw-product-list.visibility-filter.spec.ts` + `getList` test), 8 Admin API cases on demo data all correct, browser check on a branch build (single select: "Hide in listings and search" 2 products, + Storefront 1, badge 2). RELEASE_INFO entry (Administration). Demo data left: 12 products + 2 manufacturers (`test-data-visibility-filter.txt`). | `24d0272de95` on `feat/admin-product-list-visibility-filter` (not pushed) | not pushed | [PR text](#pr-text-visibility-filter) |
| [#21414](https://github.com/shopware/shopware/issues/21414) DAL: deleting a tree reports only the root and the deepest level as deleted | **2026-10-28 (review):** nfortier-shopware (approved) asked to drop `static` from `mergeAffected` ([r4403889218](https://github.com/shopware/shopware/pull/21417#discussion_r4403889218)); follow-up commit `d9a0ac5f7c9`, trunk merge `7d4e90b0d15` (trunk `1c67070d782`), pushed 2026-10-28, makes it a private instance method, `flatPrimaryKeys` stays static as on trunk. **2026-10-28:** GitHub reported a merge conflict in `RELEASE_INFO-6.7.md` again; PR head `4ba835f120a` contains `68b523d7454`; trunk `6ef38361a0e` merged in `5e3fa18a527` (worktree `/home/thinkpad/claude-scratchpad/shopware/pr-21417/wt`; blank line added before trunk's next heading; section check ok; EntityForeignKeyResolverTest unit 4 + integration 6 green), pushed, mergeable. **2026-10-23:** PR head `a76cd763bd2` (GitHub merged trunk, contains `62e935ed640`), fast-forwarded locally. CodeRabbit review: (1) `mergeAffected()` deduped with `array_unique(…, SORT_REGULAR)`, which merges hex ids that are equal as numbers (`00…01` vs `1e00…00`); now dedups by exact string, composite keys by `serialize()`, first occurrence kept. New unit test `testNestedCascadesKeepKeysThatAreEqualAsNumbers` fails before (level-two id lost). (2) RELEASE_INFO entry split into one sentence per line. Follow-up commit `68b523d7454` (not pushed); unit 4 + integration 6 pass, CS + PHPStan clean. **2026-10-22:** no review yet. Pushed: `1f0d8e5cf16` (RELEASE_INFO entry moved to 6.7.17.0). GitHub reported a merge conflict, trunk merged locally in `62e935ed640` (git merged without conflict; blank line added before trunk's next heading; EntityForeignKeyResolverTest 6 passes, section check ok), not pushed. Before: Fix in open PR [#21417](https://github.com/shopware/shopware/pull/21417). Own issue, found while reviewing #21086. `EntityForeignKeyResolver` combined per-entity results with `array_merge` (`fetch()`, `fetchAssociation()`), so later levels replaced earlier ones; now `mergeAffected()` appends and dedups per entity. Tests in `EntityForeignKeyResolverTest` (resolver: all 3 levels; repository delete: all 4 ids) fail before (only deepest level / root + level 3); DAL Dbal/Write integration+unit, Sync, category/media/product delete tests green. RELEASE_INFO entry (Core). | `adaf5ecce03` + `1f0d8e5cf16`, trunk merges `62e935ed640` + `a76cd763bd2`, review follow-up `68b523d7454` (not pushed), on `fix/core-cascade-delete-reports-all-tree-levels` ([#21417](https://github.com/shopware/shopware/pull/21417)) | open PR (milestone/6.7.17.0) | [PR text](#pr-text-21414) |
| [#21600](https://github.com/shopware/shopware/issues/21600) GARAN label rendering causes an additional product lookup per storefront line item | **2026-11-01:** issue closed on 2026-10-26; [#21665](https://github.com/shopware/shopware/pull/21665) merged on 2026-10-23. **2026-10-22:** issue still open, [#21665](https://github.com/shopware/shopware/pull/21665) still open. **Dropped** (2026-10-15: [#21614](https://github.com/shopware/shopware/pull/21614) closed by socrec in favor of their [#21665](https://github.com/shopware/shopware/pull/21665) (open)). Before: The user's shop patch (reuse `lineItem.product` on order lines) saves nothing on stock Shopware: no core loader adds `lineItems.product`, and cart line items carry no product. Instead (user asked for the smallest version, no new class): `TemplateDataSubscriber::preloadGaranLabelProducts()` (`StorefrontRenderEvent`) collects the product IDs of cart/offcanvas/checkout register/confirm/finish/order detail/edit order/order history/overview line items and calls the `@internal` `GaranLabelTwigFilter::preloadProducts()`, which only notes the IDs; the first `loadProduct()` loads pending + requested IDs in one search and memoizes them in a `WeakMap<Context, …>` (no query when no label renders, e.g. the cart widget on `frontend.checkout.info`). No public signature or template change. Unit tests green (182). Checked in the browser (2026-10-14, guest cart, 6 products): product searches trunk → fix: cart 6 → 1, offcanvas 6 → 1, checkout register 6 → 1, confirm 6 → 1, finish 6 → 1, account overview 6 → 1, order history 6 → 1, cart widget 0 → 0 (`/home/thinkpad/claude-scratchpad/shopware/21600-query-counts.md`); labels unchanged, screenshots `/home/thinkpad/claude-scratchpad/shopware/screenshots/21600-before.jpg` / `-after.jpg`. Not checked in the browser yet. | dropped, was `b5bdd4889c6` on `fix/storefront-garan-label-reuse-line-item-product` ([#21614](https://github.com/shopware/shopware/pull/21614), closed) | — | `/home/thinkpad/claude-scratchpad/shopware/pr-texts/21600-body.md` |
| [#21522](https://github.com/shopware/shopware/issues/21522) Registration form: VAT ID pattern taken from shipping address instead of billing address, blocks registration | **2026-10-22:** issue still open, [#19897](https://github.com/shopware/shopware/pull/19897) still open (approved). **Dropped** (2026-10-19: [#21735](https://github.com/shopware/shopware/pull/21735) closed in favor of the bigger VAT ID PR [#19897](https://github.com/shopware/shopware/pull/19897) (open), on request of mstegmeyer). Before: Still open on trunk, fix in open PR; CI 2026-10-16: one job failed for infra reasons (npm ECONNRESET, missing imagick on the runner, or a flaky update test), trunk (`973a82f5194`) merged on 2026-10-16 to trigger a new run, not pushed yet. Root cause: #15433 (`0fb3bfaff85`) moved the server to the billing country, the client kept the shipping-first ownership from NEXT-37997 (`828fe3893a6`). **Checked in the browser** (billing BE, shipping DE): before `DE\d{9}` and a valid BE VAT ID rejected, after `BE\d{10}` and valid. Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21522/21522-before.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21522/21522-after.png`. | dropped, was `5b012405d18` + trunk merge `f25e5029128` on `fix/storefront-vat-id-billing-country` ([#21735](https://github.com/shopware/shopware/pull/21735), closed) | — | [PR text](#pr-text-21522) |
| (no issue, sibling of [#21619](https://github.com/shopware/shopware/issues/21619)) Admin pages keep the previous entity when only the route id changes | **2026-10-28 (lint):** `lint` failed after the trunk merge: trunk #21729 (`c2ee631c74d`) added `sw-test-rules/no-vm-access`, and the PR's new tests had 144 `wrapper.vm` uses over the baseline in 24 specs. Follow-up commit `e3485243728`, trunk merge `ec828ffc599` (trunk `1c67070d782`), pushed 2026-10-28 rewrites them to assert rendered output, repository/router mocks and emits; all 24 specs at the baseline, ESLint 0 errors, Jest 375/375, rewritten fix tests still fail without the fix. `sw-settings-document-detail.spec.js` is now 999 lines (error limit 1000). **2026-10-28:** merge conflict in `sw-settings-number-range-detail.spec.js`: trunk (#20433) gave `createWrapper()` the parameters `getNumberRangePatternCollisions` and `numberRange`, this PR `route` and `get`. Resolved in `1b8002db5af` (worktree `/home/thinkpad/claude-scratchpad/shopware/pr-21741/wt`) with one options object `createWrapper({ route, get, getNumberRangePatternCollisions, numberRange })`; all calls of both sides adapted, no hunk dropped. Jest spec 14 green, Prettier clean; ESLint not run (hard-linked `node_modules` lack `@eslint-community/eslint-plugin-eslint-comments`, which trunk's config needs). Pushed, mergeable. **2026-10-22:** still open, changes requested by jleifeld (2026-10-20, r4322204289, r4322259934, r4322268307: per-entity state of the previous order, user and payment method is not reset); addressed in `6b2342e95e4` (those resets) and `454953d2524` (the same kind of resets in 13 other views, 14 new Jest tests), both pushed; replies: /home/thinkpad/claude-scratchpad/shopware/pr-21741/review-replies-2026-10-20.md. Before: Fix in open PR [#21741](https://github.com/shopware/shopware/pull/21741); CI 2026-10-19: Jest meta test and lint failed on the new `sw-settings-custom-field-set-detail.spec.ts` (page still in `src/meta/baseline.ts`, TS errors on the untyped JS component), fixed in local follow-up `feae6e0dc0a` (spec as `.js`, baseline entry removed; not pushed). No upstream issue or PR. 24 components fixed (order state cards, order address selection, customer addresses, promotion conditions, 15 detail pages reading the route id, 5 pages with an `if (!id)` guard); 3 triage hits needed no change (language detail reloads in `updated()`, tax rule and feature set values cards remount). Jest: 24 suites, 323 tests. **Checked in the browser** (currency, delivery time: URL switch kept the old entity before, loads the new one after). Screenshots in `/home/thinkpad/claude-scratchpad/shopware/issue-21619/siblings/`. Triage: `/home/thinkpad/claude-scratchpad/shopware/issue-21619/sibling-triage.md`. | `691faff5e67`, `77cea6ef65a`, `a717073fbb3`, `ae1f7bf970f`, `f2622974d3d`, trunk merge `226d89cb825`, `feae6e0dc0a`, `6b2342e95e4`, `454953d2524` on `fix/admin-reload-on-id-change` ([#21741](https://github.com/shopware/shopware/pull/21741)) | open PR (milestone/6.7.17.0) | [PR text](#pr-text-21619-siblings) |
| (no issue) Cloning an order breaks versioning of the source order (`fk.order_delivery.order_id`) | **2026-10-29:** mitelg [asked](https://github.com/shopware/shopware/pull/21739#discussion_r4412029792) for a named argument; follow-up commit `fc06de2b352` (`CascadeDelete(cloneRelevant: false)`). mstegmeyer [r4412896747](https://github.com/shopware/shopware/pull/21739#discussion_r4412896747): refund positions too, fixed in follow-up `904cdd59d7e` (local, not pushed); [r4412896761](https://github.com/shopware/shopware/pull/21739#discussion_r4412896761): ship with #22179, PR text now says "Depends on #22179", reply draft `/home/thinkpad/claude-scratchpad/shopware/order-version-500/pr-reply-21739-mstegmeyer.md` (worktree `/home/thinkpad/claude-scratchpad/shopware/order-version-500/wt-order-version`). **2026-10-22:** still open, no review yet. Fix in open PR [#21739](https://github.com/shopware/shopware/pull/21739). Found while testing #21619 (the test clone made order 10000 unopenable). `OrderAddressDefinition::orderDeliveries` has clone-relevant `CascadeDelete()` since `b658573d9f7` (NEXT-37900), so a version of the source order copies the clone's delivery. Fix: `CascadeDelete(false)`. Integration test clones an order and versions the source; VersioningTest (33), OrderRepositoryTest/OrderAddressServiceTest/DefinitionValidatorTest (54) and RecalculationServiceTest (40) pass. Sibling scan of clone-relevant associations in the order aggregate: line item → delivery/refund positions double paths checked, no cross-order copy. Findings: `/home/thinkpad/claude-scratchpad/shopware/order-version-500/findings.md`. Not covered: the clone itself still produces an order that shares ids with the source (separate issue). | `23c3af021c1` on `fix/core-order-version-foreign-deliveries` ([#21739](https://github.com/shopware/shopware/pull/21739)) | open PR (milestone/6.7.17.0) | [PR text](#pr-text-order-version) |
| (no issue) Cloning an order creates an order tied to its source | **Dropped** (2026-10-19: not needed, local branch deleted). Before: Investigation: `/home/thinkpad/claude-scratchpad/shopware/order-version-500/order-clone-findings.md` (the generic DAL clone copies FKs verbatim and dedupes nothing; same class for product cover/canonical variant and category order). Fix (option b, on request): orders get `CloneProtection`, the root check moved from `VersionManager::cloneEntity()` to `clone()` so `createVersion()` keeps working. Tests: unit `VersionManagerTest` (24), integration `OrderRepositoryTest`/`VersioningTest`/`RecalculationServiceTest` (77), entity protection + API controller (34 + 22). RELEASE_INFO entry under API. Decided 2026-10-16: the 403 applies right away in 6.7, no v6.8 feature flag (the clone only produced corrupt orders). Not done: the generic remap (option a) for other entities. | dropped, was `3235436eaf5` (rebased) on `fix/core-reject-order-clones`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/reject-order-clones.patch | — | [PR text](#pr-text-order-clone) |
| (no issue) `system:update` compiles themes quadratically with many sales channels | Still open on trunk, fix in open PR [#22015](https://github.com/shopware/shopware/pull/22015) (opened 2026-10-23, no review yet). `UpdateSubscriber.php:84` merges the compiled theme ids with `+=`, so every theme after the first is compiled again from each of its sales channels. Local fix: spread merge; new unit test fails before. Based on `b53810069bb`. | `215bfa54d2f` on `fix/theme-update-subscriber-recompile` (worktree `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-theme-recompile`) | not released | /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/theme-update-subscriber-recompile/pr-text.md |
| (no issue) SEO URL persisting reads the canonical URLs of every sales channel | **2026-10-30:** GitHub suggestion commit `f05ab888306` broke the file (unquoted SQL, every CI job red); repaired in `55d4944b58a` (not pushed) with a test for URLs without sales channel; reply draft /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/pr-reply-22016-vienthuong-null-only-condition.md. Still open on trunk, fix in open PR [#22016](https://github.com/shopware/shopware/pull/22016) (opened 2026-10-23, no review yet). `SeoUrlPersister::findCanonicalPaths()` has no sales channel filter (O(N²) per batch). Local fix: filter by the sales channels of the persisted URLs; new integration test. Based on `b53810069bb`; conflicts with the next row in `doUpdateSeoUrls()`. | `c7afda438f5` on `fix/seo-canonical-paths-sales-channel` (worktree `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-seo-canonical`) | not released | /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/seo-canonical-paths-sales-channel/pr-text.md |
| (no issue) SEO URLs of several sales channels in one persist call lose their previous URLs | **2026-10-30:** vienthuong asked about the overwritten `salesChannelId` argument; worktree fast-forwarded to `6dc3e1d2bdf`, follow-up `e6802724823` (not pushed) passes the grouped id explicitly; reply draft /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/pr-reply-22013-vienthuong-sales-channel-arg.md. Still open on trunk, fix in open PR [#22013](https://github.com/shopware/shopware/pull/22013) (opened 2026-10-23, no review yet). `doUpdateSeoUrls()` uses the last URL's sales channel for obsoleting, retargeting and the deleted flag. Local fix: persist per sales channel group; two integration tests fail before. Based on `9f14f565c49`; conflicts with the previous row. | `de847063a55` on `fix/seo-persister-obsolete-per-sales-channel` (worktree `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-seo-obsolete`) | not released | /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/seo-persister-obsolete-per-sales-channel/pr-text.md |
| (no issue) Changing one sales channel's SEO URL template regenerates every sales channel | Still open on trunk, fix in open PR [#22012](https://github.com/shopware/shopware/pull/22012) (opened 2026-10-23). `SeoUrlTemplateIndexingMessage` carries no sales channel. Local fix: the message carries the changed template's scope and the new `@internal` `SeoUrlUpdater::updateForTemplate()` only regenerates the sales channels using it; two integration tests fail before. Based on `9f14f565c49`. **2026-10-30:** review by rittou ([r4419936771](https://github.com/shopware/shopware/pull/22012#discussion_r4419936771)): restoring a sales channel's template inheritance (template row set to `null`) left its SEO URLs stale, because the scope check skipped sales channels without an own template. Follow-up commit `529763fddf9` regenerates the sales channel whose own template changed in any case; new integration test fails before; SEO tests, PHPStan and cs green. **Committed locally, not pushed yet**; reply draft `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/seo-template-change-sales-channel-scope/pr-reply-22012-rittou-restore-inheritance.md`. | `0d8677ed454`, trunk merge `2ab5af841ce` (from GitHub), `529763fddf9` (local) on `fix/seo-template-change-sales-channel-scope` (worktree `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-seo-template-scope`) | not released | /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/seo-template-change-sales-channel-scope/pr-text.md |
| (no issue) Admin lists cut off at 25 (newsletter filter: 100) sales channels | **2026-10-28 (lint):** trunk #21729 (`c2ee631c74d`) added `sw-test-rules/no-vm-access`; the PR's new tests had 23 `wrapper.vm` uses over the baseline in 7 specs, so the next CI run would fail `lint`. Follow-up commit `cbc938e9073`, trunk merge `575b0bb8c78` (trunk `1c67070d782`), pushed 2026-10-28 rewrites them; the merge with trunk is at the baseline in all 7. Still open on trunk, fix in open PR [#22017](https://github.com/shopware/shopware/pull/22017) (opened 2026-10-23, no review yet). new products only get 25 default visibilities, and the SEO tab, SEO templates, mail header/footer conflict check, listing visibility modal, live search and newsletter filter miss channels. Local fix: unlimited criteria, lazy load of the selected channel in the two SEO components; 7 Jest tests fail before. Based on `b53810069bb`; conflicts with `feat/admin-open-product-in-storefront` in `sw-product-detail`. **Original state checked in the browser** on 2026-10-23 with 30 temporary headless test channels (kept in the dev shop until `php /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/browser-check/test-sales-channels.php cleanup`): new product gets 25 of 30 default channels, live search offers 25 of 33 and finds no missing channel even after scrolling or searching, the SEO tab and SEO template card treat a channel outside the first 25 as a storefront, the listing visibility modal shows rows without names; with 105 test channels the newsletter filter offers 100 of 108 and finds no "MSC test 40" while "MSC test 41" is found; the mail header/footer conflict check lists only 25 of 30 reassigned channels (11, 12, 16, 18, 21 missing, confirmed by a manual Save). **Fix checked in the browser** on 2026-10-23 with the Administration dev server running from the worktree (`ADMIN_PORT=5300`, API proxied to the ddev shop, main checkout untouched): all 7 cases behave correctly (30 default visibilities, 108 live search options incl. "MSC test 11", headless banner and disabled SEO path for "MSC test 11", named rows in the listing modal, all 30 channels in the header/footer warning, "MSC test 40" in the newsletter filter). Screenshots (after): `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-product-defaults-after.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-live-search-after.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-seo-templates-channel-11-after.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-product-seo-channel-11-after.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-listing-visibility-modal-after.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-mail-header-footer-warning-after.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-newsletter-filter-channel-40-after.png`. Screenshots (before): `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-newsletter-filter-channel-40-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-newsletter-filter-channel-41-correct.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-product-defaults-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-live-search-list-end-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-live-search-no-result-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-seo-templates-channel-10-correct.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-seo-templates-channel-11-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-product-seo-channel-10-correct.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-product-seo-channel-11-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/sales-channel-limits-listing-visibility-modal-before.png`. | `accd800cfe0` on `fix/admin-sales-channel-list-limits` (worktree `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-admin-visibility`) | not released | /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/admin-sales-channel-list-limits/pr-text.md |

## PR texts

Commit message and PR text per fix, written with `/mm-pr-text`. For the fixes that already have a PR, the text is the PR description on GitHub and the commit message is the commit subject.

<a id="pr-text-20344"></a>

### #20344 Anchored `preg_match()` patterns across `src/` omit the PCRE `D` modifier

Commit message:
```
fix(core): reject input with a trailing newline in regex validations
```

Release notes: Not needed. These are input validation bug fixes without an API or configuration change.

PR text:
````markdown
<!--
Thank you for contributing to Shopware! Please fill out this description template to help us process your pull request.

Please make sure to fulfil our contribution guidelines (https://developer.shopware.com/docs/resources/guidelines/code/contribution?category=shopware-platform-dev-en/contribution).

Do your changes need to be documented?
Please create a second pull request at https://github.com/shopware/docs
-->

### 1. Why is this change necessary?

Several input checks match anchored patterns without the PCRE `D` modifier. Without `D`, `$` also matches before a final newline, so each check accepts its input plus one trailing `\n`.

The clearest case is `SalesChannelFileRequestPathResolver`. It rejects the path segment `..` with a string comparison, but its allowlist regex accepts `"..\n"`. The zip code check has the same gap: a zip code that matches the country pattern plus `\n` is accepted and stored with the address. The system config domain check in `ConfigurationService` also accepts a domain with a trailing newline.

### 2. What does this change do, exactly?

These checks now use the `D` modifier:

- `SalesChannelFileRequestPathResolver`: the file family and path segment allowlists
- `ConfigurationService::getConfiguration()`: the domain check
- `CustomerZipCodeValidator`: the country zip code pattern, next to the optional `i` modifier

The two `SvgContentValidator` sites from the issue's audit list need no change, since both strip or collapse whitespace before they match.

### 3. Describe each step to reproduce the issue or behaviour.

1. Resolve the sales channel file path `"..\n/ucp.json"`, or the file family `"agentic\n"`. Before: the allowlist regex accepts the value. After: it is rejected as an invalid path or file family.
2. Validate the zip code `"12345\n"` for a country with a zip code pattern and the zip code check enabled. Before: it passes. After: it fails with a violation.
3. Call `ConfigurationService::getConfiguration()` with the domain `"core.basicInformation\n"`. Before: the domain check accepts it. After: it throws `SystemConfigException::invalidDomain()`.

### 4. Please link to the relevant issues (if any).

- part of #20344

Still open from the audit list:

- `OpenAiProductExportValidator` and `GoogleProductExportValidator`: they check rendered feed output, and stricter matching could flag existing feeds
- `CreateMigrationCommand`, `ThemeCreateCommand`, the installer's `ShopConfigurationController` and `StorybookService`
- `AdminSearcher` and `ProductAdminSearchIndexer`
- `FeatureFlagExtension`
- the ECS or PHPStan rule the issue proposes

### 5. Checklist

- [ ] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [ ] I have read the contribution requirements and fulfilled them
````

Screenshots: none

<a id="pr-text-21063"></a>

### #21063 Asset fallback URLs retain the first request host in long-running workers

Commit message:
```
fix(core): resolve fallback asset and media URLs from the current request

- closes #21063
```

Release notes: RELEASE_INFO-6.7.md Core entry (new `FilesystemFactory::PUBLIC_URL_GENERATOR` option for custom filesystem factories).

PR text:
````markdown
### 1. Why is this change necessary?

When one long-running worker (e.g. FrankenPHP) serves several storefront domains and no asset URL is configured, asset URLs keep the host of the worker's first request. A visitor on the second domain gets JavaScript, theme and font URLs pointing to the first domain, which the browser can block through CORS.

`FallbackUrlPackage` resolves an empty base URL from the request once, in its constructor, and hands the result to Symfony's `UrlPackage`. The asset packages are shared services, so that first host sticks for every later request. Two places inherit the problem:

- `AssetPackageService::create()` builds the bundle packages (`@Storefront`, `@Administration`, plugins) with `new UrlPackage($package->getUrl($targetPath), …)`, which freezes the resolved URL as well. This is where the core JavaScript bundle URL comes from.
- `ThemeAssetPackage` calls the parent constructor without its `RequestStack`, so its fallback reads `$_SERVER` instead of the current request.

Media URLs have the same problem. Without a configured `url`, `FilesystemFactory` sets the public filesystem's `public_url` from `$_SERVER` when the shared service is built, so `MediaUrlGenerator` and remote thumbnails keep the first host as well.

### 2. What does this change do, exactly?

When a long-running worker serves several domains, asset, theme and media URLs without a configured base URL now use the host of the current request instead of the worker's first request. Configured asset or CDN URLs stay as they are, and setups without long-running workers see no difference. Custom filesystem adapters can opt in through the new `FilesystemFactory::PUBLIC_URL_GENERATOR` option (see the release notes).

### 3. Describe each step to reproduce the issue or behaviour.

1. Reuse one `FallbackUrlPackage` with an empty base URL for two main requests:
   ```php
   $requestStack = new RequestStack();
   $requestStack->push(Request::create('https://first.example'));
   $package = new FallbackUrlPackage([''], new EmptyVersionStrategy(), $requestStack);
   $package->getUrl('test');

   $requestStack->pop();
   $requestStack->push(Request::create('https://second.example'));
   $package->getUrl('test');
   ```
   - Before: the second call returns `https://first.example/test`.
   - After: it returns `https://second.example/test`.
2. The same applies to `@Storefront` bundle URLs from `AssetPackageService`, to `ThemeAssetPackage`, and to `publicUrl()` of the public filesystem (media URLs) created by `FilesystemFactory`.
3. With an explicit asset URL such as `https://cdn.example`, both calls return the CDN URL, before and after.

In a real setup: run FrankenPHP with one worker, request domain A and then domain B. Before, both pages contain asset and media URLs of domain A; after, each page uses its own domain.

### 4. Please link to the relevant issues (if any).

- closes #21063

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [x] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [ ] I have read the contribution requirements and fulfilled them
````

Screenshots: none (needs a long-running worker serving two hosts)

<a id="pr-text-21124"></a>

### #21124 Logging decorators retain buffered records after reset()

Commit message:
```
fix(core): forward reset to the inner log handler

- closes #21124
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

In a long-running worker, the production logger's `FingersCrossedHandler` keeps buffered records across requests. `ExcludeFlowEventHandler`, `ErrorCodeLogLevelHandler` and `ExcludeExceptionHandler` wrap `monolog.handler.main`, but they inherit the empty `AbstractHandler::reset()`. When Symfony resets services between requests, the reset stops at these decorators and never reaches the buffer, so records and memory pile up.

### 2. What does this change do, exactly?

In long-running workers, buffered log records are now cleared when Symfony resets services between requests. Records from an earlier request are no longer written out with a later error and no longer pile up in memory.

### 3. Describe each step to reproduce the issue or behaviour.

1. Wrap a `FingersCrossedHandler` (action level error) in one of the decorators.
2. Log an info record, call `reset()` on the decorator, then log an error record.
   - Before: the error flushes both records, the info record from before the reset included.
   - After: only the error record is written.

### 4. Please link to the relevant issues (if any).

- closes #21124

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [ ] I have read the contribution requirements and fulfilled them
````

Screenshots: none

<a id="pr-text-21214"></a>

### #21214 [Administration] Product detail only shows the first 25 custom field sets (regression from #17134)

Commit message:
```
fix(administration): load all custom field sets of an entity

- closes #21214
```

Release notes: not needed, a bug fix with no change for external developers (`customFieldDataProviderService` is `@private`).

PR text:
````markdown
### 1. Why is this change necessary?

Since 6.7.14 the product detail page shows only the first 25 custom field sets assigned to products; any further sets are silently missing from the Specifications tab. #17134 replaced the page's own criteria (`new Criteria(1, null)`) with `customFieldDataProviderService.getCustomFieldSets('product')`, which loads 25 sets by default and never fetches the next page. #20738 added a `limit` argument and passes `null` for some pages, but the product page and about 20 others (rules, promotions, media, the settings modules, …) still get only 25 sets.

### 2. What does this change do, exactly?

Every Administration page that shows custom fields loads all custom field sets assigned to its entity again, so shops with more than 25 sets see all of them. Callers that pass their own limit keep it.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create 26 or more custom field sets assigned to "Products", each with at least one custom field.
2. Open any product in the Administration and go to Specifications.
   - Before: only 25 sets are shown; the `search/custom-field-set` request has `"limit": 25` and the response `total` is higher.
   - After: all sets are shown; the request has no limit.
3. The same applies to other entities, e.g. 26 sets assigned to "Rules" on a rule detail page.

### 4. Please link to the relevant issues (if any).

- closes #21214

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [ ] I have read the contribution requirements and fulfilled them
````

Screenshots: none

<a id="pr-text-same-window-link-rel"></a>

### (no issue) Internal links in rich text get `rel="noreferrer noopener"` and lose the referrer

Commit message:
```
fix(core): keep the referrer on same-window links in sanitized HTML
```

Follow-up commit `1c585d51f4f`: `refactor(core): remove comments from the link target rel transform`. Review fix (not committed yet): the `HTML.TargetNoreferrer` / `HTML.TargetNoopener` options of a sanitizer set are still honored and now only affect new-window links.

Release notes: not needed, a bug fix; the new transform class is `@internal`.

PR text:
````markdown
### 1. Why is this change necessary?

Links in sanitized rich text (product, category and manufacturer descriptions, CMS text elements, snippets) get `rel="noreferrer noopener"` even when they open in the same window. The default Administration text editor writes `target="_self"` on every link. HTMLPurifier then adds both rels to any link that has a `target` attribute, whatever its value.

On a same-window link, `noreferrer` adds no security. It does strip the `Referer` header and `document.referrer` from the next page, so analytics tools lose the previous page for every internal click from such text.

Both rels only take effect when a link opens a new browsing context, so leaving them off same-window links changes nothing for security. The sanitizer config can't fix this on its own: `HTML.TargetNoreferrer: false` also removes `noreferrer` from new-tab links to other sites. Stopping the editor from writing `target="_self"` wouldn't fix links that are already stored or that arrive through the API or imports.

Shopware's own templates already add these rels only to links that open a new tab or leave the shop:
- NEXT-7435 added `rel="noopener"` to `target="_blank"` links in the Storefront and the Administration ([f7a8955a50c](https://github.com/shopware/shopware/commit/f7a8955a50c), [88dbaed0ef1](https://github.com/shopware/shopware/commit/88dbaed0ef1)).
- NEXT-9410 added `rel="noreferrer noopener"` to the manufacturer link, which opens in a new tab ([e9d9f14b604](https://github.com/shopware/shopware/commit/e9d9f14b604)).
- #2283 (NEXT-19859, [2672ce6a48b](https://github.com/shopware/shopware/commit/2672ce6a48b)) added `rel="noopener noreferrer"` to the flyout navigation only when the category links to an external URL.

No issue or PR decided to add them to same-window links. That comes from HTMLPurifier's defaults.

### 2. What does this change do, exactly?

Sanitized HTML now gets `rel="noreferrer noopener"` only on links that can open a new browsing context: `_blank` or a named window. Links with `target="_self"`, `_parent` or `_top` keep the referrer. Text that was stored with the old rels loses them the next time it goes through the sanitizer, on save or, for CMS text and snippets, on render. The `HTML.TargetNoreferrer` and `HTML.TargetNoopener` options of a sanitizer set still work and now only affect links that open a new window.

### 3. Describe each step to reproduce the issue or behaviour.

1. With the default text editor (`METEOR_TEXT_EDITOR` off), open a product in the Administration. In its description, link some text to another Storefront page, leave "Open link in new tab" off, and save.
2. Open the product page in the Storefront and inspect the link.
   - Before: `<a target="_self" href="…" rel="noreferrer noopener">`
   - After: `<a target="_self" href="…">`
3. Click the link, then run `document.referrer` in the console of the page it opens.
   - Before: empty string
   - After: the URL of the product page
4. A link with "Open link in new tab" on still gets `rel="noreferrer noopener"`, before and after.

### 4. Please link to the relevant issues (if any).

none

### 5. Checklist

- [ ] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [ ] I have read the contribution requirements and fulfilled them
````

No screenshots: the change is only visible in the markup and in `document.referrer`, both shown in the steps above. PR text file: `/home/thinkpad/claude-scratchpad/shopware/rel-noreferrer/pr-text.md`.

<a id="pr-text-visibility-filter"></a>

### (no issue) Visibility filter in the Admin product list

Commit message:
```
feat(administration): add a visibility filter to the product list
```

Release notes: entry added to `RELEASE_INFO-6.7.md` (6.7.16.0, Administration, "Product list visibility filter").

PR text:
````markdown
### 1. Why is this change necessary?

The product list can be filtered by sales channel, but not by how a product is visible there, and not by products that are missing from a sales channel. Merchants who want to find products that are hidden in listings, only reachable by link, or not assigned to a sales channel yet have to open products one by one.

### 2. What does this change do, exactly?

The product list gets a "Visibility" filter to choose one of "Visible", "Hide in listings", "Hide in listings and search" or "Not assigned". It applies to the sales channels selected in the "Sales Channels" filter, or to any sales channel if none is selected; "Not assigned" then finds products missing from all selected sales channels, or products without any sales channel. Filter panels in extensions can use the new filter type `single-select-filter` for the same kind of single choice.

### 3. Describe each step to reproduce the issue or behaviour.

1. Have products with different visibilities, e.g. one "Hide in listings" in Storefront, one only in another sales channel, one without any sales channel.
2. Open Catalogues > Products, open the filters and select "Not assigned" under "Visibility".
   - Only products without any sales channel are listed.
3. Additionally select "Storefront" under "Sales Channels".
   - Products not assigned to Storefront are listed, including those visible in other sales channels.
4. Select "Visible" instead of "Not assigned".
   - Only products with "Visible" in Storefront are listed; a product that is visible in another sales channel but hidden in Storefront is not.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

none
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/visibility-filter-before.png` (filters before: no "Visibility"), `/home/thinkpad/claude-scratchpad/shopware/screenshots/visibility-filter-after-options.png` (the new single-select filter with its options), `/home/thinkpad/claude-scratchpad/shopware/screenshots/visibility-filter-after-link-only.jpg` ("Hide in listings and search": 2 products, one per channel), `/home/thinkpad/claude-scratchpad/shopware/screenshots/visibility-filter-after-link-only-storefront.jpg` (+ "Storefront": 1 product, filter badge 2).

<a id="pr-text-21414"></a>

### #21414 DAL: deleting a tree reports only the root and the deepest level as deleted

Commit message:
```
fix(core): report every level of a deleted tree as deleted

- closes #21414
```

Release notes: entry added to `RELEASE_INFO-6.7.md` (6.7.16.0, Core, "Deleting a tree reports every level as deleted").

PR text:
````markdown
### 1. Why is this change necessary?

Deleting an entity whose cascade reaches the same entity on several levels, for example a category with nested child categories, deletes every row but reports only the root and the deepest level as deleted. The levels in between get no write result, no `EntityDeletedEvent` and no `*.deleted` webhook, and they are missing from the `deleted` part of the sync response, so consumers such as apps, the Admin search index and cache invalidation never hear about them.

`EntityForeignKeyResolver` collects the affected rows per entity name and combined the levels with `array_merge`. With string keys, the list of a later level replaced the earlier one, so only the last non-empty level was kept and `EntityWriter` created cascade delete commands only for those rows.

### 2. What does this change do, exactly?

Deleting a tree, for example a category, media folder or flow sequence with several levels, now reports every removed row as deleted, so each of them triggers its `*.deleted` webhook and appears in the sync response's `deleted` list.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create a category tree with three levels below the root: root → level 1 → level 2 → level 3.
2. Delete the root category, e.g. `DELETE /api/category/<root id>`.
3. Check the `category.deleted` webhook payload (or `getDeletedPrimaryKeys('category')` of the written event).
   - Before: only the root and level 3 are listed, although all four categories are deleted.
   - After: all four categories are listed.

### 4. Please link to the relevant issues (if any).

- closes #21414
````

Screenshots: none (API behaviour; the webhook payload and sync response are the evidence).

<a id="pr-text-21522"></a>

### #21522 Registration form: VAT ID pattern taken from shipping address instead of billing address, blocks registration

Commit message:
```
fix(storefront): validate the VAT ID against the billing country

- closes #21522
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21522/pr-text-21522.md`):
````markdown
### 1. Why is this change necessary?

Business customers whose billing country isn't the shop's default can get stuck on the registration form: the browser rejects a valid VAT ID and the form doesn't submit, although the Store API would accept it.

The form has two `CountryStateSelect` instances, one for the billing address and one for the shipping address, and both write the `pattern` and required state of the single `#vatIds` field. Since #15433 the server validates the VAT ID against the billing country, but the plugin still let the shipping instance own the field (the logic from NEXT-37997, when the server preferred the shipping country). The shipping instance runs `initSelects()` after the billing one, so after a server-side error (e.g. e-mail already registered) the hidden shipping address with the default country overwrites the billing pattern. With "Shipping and billing address do not match" checked, the shipping country wins as well.

### 2. What does this change do, exactly?

The VAT ID field on the registration form now always follows the billing country, the same country the server validates against. Changing the shipping country, or ticking "Shipping and billing address do not match", no longer changes the VAT ID pattern or its required state.

### 3. Describe each step to reproduce the issue or behaviour.

Setup: enable "Show selection between company and customer account" and enable "Check VAT ID format" for Belgium and Germany.

1. Open `/account/register`, choose account type "Commercial", billing country Belgium and enter `BE0123456789` as VAT ID.
2. Tick "Shipping and billing address do not match" and leave the shipping country on Germany.
   - Before: the VAT ID field gets the pattern `DE\d{9}` and shows "The VAT Reg.No. you have entered does not have the correct format."; the form can't be submitted.
   - After: the field keeps the Belgian pattern `BE\d{10}` and stays valid.
3. Untick it again, submit with an e-mail address that is already registered, fix the e-mail on the re-rendered page and submit again.
   - Before: the VAT ID field now validates against the default country and blocks the second submit.
   - After: the VAT ID still validates against Belgium.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #21522
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21522/21522-before.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21522/21522-after.png`.

<a id="pr-text-21619-siblings"></a>

### (sibling of #21619) Admin pages keep the previous entity when only the route id changes

Commit messages (five commits, subject only, no issue of their own):
```
fix(administration): reload order, customer and promotion views when the entity changes
fix(administration): reload snippet, custom field, custom entity and document details when the route changes
fix(administration): reload detail pages when switching between two entities
fix(administration): reload settings detail pages when the route id changes
fix(administration): remove the previous order's version when switching orders
```

PR title: `fix(administration): reload detail views when the entity id changes`

Release notes: none needed (plain bug fixes).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21619/siblings/pr-text-siblings.md`):
````markdown
### 1. Why is this change necessary?

Many Administration pages and views load their entity only when they're created. Vue Router keeps a page mounted when only the `:id` of its route changes, and child views keep their instance when the parent page swaps the entity. So after switching from one entity to another without leaving the page (global search, a link, a URL or hash change, browser back/forward), the page header or URL shows the new entity while the form still edits the previous one. Saving then writes to the previous entity.

This is the same pattern as #21619 (order documents card). Affected:

- Order details: the payment, delivery and order state cards keep the previous order's transitions and last change, and the address selections list the previous customer's addresses.
- Customer addresses tab and promotion conditions (exclusions) keep the previous customer's or promotion's data.
- Detail pages that read `$route.params.id` without watching it: newsletter recipient, payment method, delivery time, listing sorting, number range, user, SSO user, role, country, custom field set (and its field list), custom entity, snippet, document config, tax provider.
- Detail pages whose id watcher only reloaded when switching to "create" (`if (!this.xId)`): customer group, product feature set, tax, currency, salutation.

On top of that, switching from one order to another left the previous order's draft version in the database: `sw-order-detail` creates a version for the open order and deletes it only when the page is left.

### 2. What does this change do, exactly?

These pages and views now reload when the entity id changes while they stay open, so the form always shows and saves the entity in the URL. When another order is opened, the previous order's draft version is deleted, as it is when leaving the order page. Where a save already moves the route to the new entity's id and reloads by hand (snippet, document config, role, tax, currency, salutation, product feature set, custom entity), the entity is still loaded only once.

The language detail page and the tax rule and feature set values cards were checked and needed no change: they already reload (`updated()`) or remount under `v-if="isLoading"`.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open `/admin#/sw/settings/currency/detail/<id of CHF>`.
2. Change the URL to `/admin#/sw/settings/currency/detail/<id of CZK>` without reloading.
   - Before: the form still shows "Swiss francs" / `CHF`.
   - After: the form shows "Czech koruna" / `CZK`.
3. Same with two delivery times under `/admin#/sw/settings/delivery/time/detail/<id>`.
   - Before: the form keeps the first delivery time.
   - After: the form shows the second one.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- relates #21619
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21619/siblings/currency-before-czk-url.jpg`, `/home/thinkpad/claude-scratchpad/shopware/issue-21619/siblings/currency-after-czk-url.jpg`.

<a id="pr-text-order-version"></a>

### (no issue) Cloning an order breaks versioning of the source order

Commit message:
```
fix(core): keep deliveries of other orders out of an order version
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/order-version-500/pr-text-order-version.md`):
````markdown
### 1. Why is this change necessary?

After an order has been cloned through the API (`POST /api/_action/clone/order/<id>`), the source order can no longer be opened in the Administration and no documents can be created for it. Creating the order version fails with a 500:

```
SQLSTATE[23000]: 1452 Cannot add or update a child row: a foreign key constraint fails (`order_delivery`, CONSTRAINT `fk.order_delivery.order_id` ...)
```

The generic clone keeps the copied delivery's `shipping_order_address_id` pointing at the source order's address. `OrderAddressDefinition::orderDeliveries` carries `CascadeDelete()`, which is clone-relevant by default, so versioning the source order walks `order.addresses[].orderDeliveries` and copies the clone's delivery into the new version as well. That delivery belongs to an order that isn't part of the version, and the insert fails. The flag was changed from `RestrictDelete` to `CascadeDelete()` in NEXT-37900 to make deleting an order work, not for cloning.

### 2. What does this change do, exactly?

Creating a version of an order (opening it in the Administration, generating documents, editing it) only copies the order's own deliveries again, so orders whose address is referenced by another order's delivery can be opened and edited. Deleting an order still deletes the deliveries that reference its addresses.

### 3. Describe each step to reproduce the issue or behaviour.

1. Take an existing order and clone it: `POST /api/_action/clone/order/<order id>` with `{"overwrites": {"orderNumber": "clone-1", "deepLinkCode": "<any unique 32 chars>"}}`.
2. Open the source order in the Administration (or `POST /api/_action/version/order/<order id>`).
   - Before: the request fails with the `fk.order_delivery.order_id` error above, and the order detail page stays empty.
   - After: the version is created and the order opens normally.

### 4. Please link to the relevant issues (if any).

None, found while testing #21619 locally.
````

Screenshots: none (API behaviour).

<a id="pr-text-order-clone"></a>

### (no issue) Cloning an order creates an order tied to its source

Commit message:
```
fix(core): reject cloning orders
```

Release notes: `RELEASE_INFO-6.7.md`, 6.7.16.0, API, "Orders can no longer be cloned". No UPGRADE entry.

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/order-version-500/pr-text-order-clone.md`):
````markdown
### 1. Why is this change necessary?

Cloning an order (`POST /api/_action/clone/order/{id}`, `EntityRepository::clone()`, or the extension SDK's `repositoryClone`) creates an order that is still tied to its source. The generic DAL clone copies foreign keys as they are and reaches some rows twice, so the copy:

- keeps the source's `billing_address_id`, `primary_order_delivery_id` and `primary_order_transaction_id`,
- gets two deliveries, one of them shipped to the source order's address,
- gets delivery positions and a refund position that point at the source's line items,
- even adds rows to the source: a refund position on the source refund and extra delivery positions on the source line items.

Afterwards the clone can't be versioned (so it can't be opened in the Administration), versioning the source can fail as well, and deleting the source silently removes parts of the clone. Nothing in Shopware itself clones orders; the reorder flow builds a new cart instead.

Protecting `order` with a `CloneProtection` wasn't possible so far, because the protection was checked inside the shared clone routine that `createVersion()` uses too, which would have broken order editing.

### 2. What does this change do, exactly?

Cloning an order is rejected with `403 FRAMEWORK__CLONE_PROTECTED`. Creating versions of an order, which the Administration uses to edit orders, keeps working: a `CloneProtection` on an entity is now only checked when the entity itself is cloned, not when a version of it is created. The existing protections on `user` and `integration` behave as before, because those entities can't be versioned.

Cloning a tag no longer copies its order assignments, as orders are now skipped as a clone-protected association.

A RELEASE_INFO entry explains the change for API consumers.

### 3. Describe each step to reproduce the issue or behaviour.

1. `POST /api/_action/clone/order/<order id>` with `{"overwrites": {"orderNumber": "clone-1", "deepLinkCode": "<any unique 32 chars>"}}`.
   - Before: a new order is created whose delivery, positions and addresses still point at the source order. Opening the clone in the Administration fails with `fk.order_delivery.shipping_order_address_id`.
   - After: the request is answered with `403 FRAMEWORK__CLONE_PROTECTED` and no order is created.
2. Open and edit an order in the Administration.
   - Before and after: works.

### 4. Please link to the relevant issues (if any).

None, found while testing #21619 locally. Related: the versioning fix for orders whose address is referenced by another order's delivery (`fix(core): keep deliveries of other orders out of an order version`).
````

Screenshots: none (API behaviour).

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-20366/20366-order-menu-320-200pct-before-after.jpg`.

On 2026-10-28, trunk `1c67070d782` was merged into the unpushed branches without a PR, not pushed: `test/acceptance-promotion-max-discount` (#8121) `4474e717bf9`, `fix/core-notification-cleanup-task` (#13369) `b3761d7824c` (worktree `/home/thinkpad/claude-scratchpad/shopware/issue-13369/wt`, RELEASE_INFO blank line fixed), `fix/context-persister-replace-duplicate-key` `13d483f7498`, `feat/admin-product-list-visibility-filter` `26669cc9458` (worktree `/home/thinkpad/claude-scratchpad/shopware/product-list-visibility-filter/wt`, RELEASE_INFO entry moved from the released 6.7.16.0 to 6.7.17.0 `## Administration`).
The visibility filter branch then failed trunk's lint gate (67 `sw-test-rules/no-vm-access` in `sw-product-list.spec.js`, baseline 65; `max-lines` 550 > 500 in `sw-product-list/index.js`); follow-up commit `38a29b1d3c1` (not pushed) moves the filter option and the filter conversion into `sw-product-list/visibility-filter.ts` and tests the active filter number through the rendered filter panel, ESLint 0 errors, Jest 41/41.
