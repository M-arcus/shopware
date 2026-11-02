# Merged PRs, fixed issues and finished branches

Moved from `issues.md` on 2026-10-29: rows whose own PR is merged, rows whose issue was fixed on trunk by another merged PR (the local branch was dropped), their PR texts, and notes about merged PRs.
PR states checked on 2026-10-29 with `gh pr list --author M-arcus`.
Upstream states refreshed on 2026-11-01 with `gh api repos/shopware/shopware/issues/<n>` and `pulls/<n>`: the rows below are unchanged except where marked **2026-11-01**; #17747 and #20364 are still open as issues.

Release column refreshed on 2026-11-02 against the tag `v6.7.16.0` (cut from `6.7.16.x`, branched from trunk at `c683815ddf7` on 2026-10-19): `git merge-base --is-ancestor <commit> v6.7.16.0`.
Commits in the tag read `6.7.16.0 (released 2026-11-02)`; PRs merged to trunk after the branch point read `6.7.17.0 (milestone, not released yet)`.
The "What's Changed" list on the GitHub release page is the 6.7.15.0 list (223 identical PRs, footer `compare/v6.7.14.2...v6.7.15.0`), so none of the 6.7.16.0 PRs appear in it.

## Fixed in this session (merged)

| Issue | Status on trunk | Fixed by | First release | PR text |
|---|---|---|---|---|
| [#8815](https://github.com/shopware/shopware/issues/8815) SEO: Product page: Add title="" tag to tab-urls | **2026-10-23:** merged as [#21955](https://github.com/shopware/shopware/pull/21955) on 2026-10-23. Before: still open on trunk; the *Description* and *Reviews* tab links in `cms-element-product-description-reviews.html.twig` have no `title` (the cross-selling tabs on the same page do). Local fix: both links get `title="{{ '…'\|trans\|striptags }}"`; rendered markup checked on `/Canonical-Test/CANON-P` (`title="Description"`, `title="Reviews"`), ludtwig clean. | `c9bf9add2cb` on `fix/storefront-product-tab-link-title` ([#21955](https://github.com/shopware/shopware/pull/21955), merged as `b53810069bb`) | not released | /home/thinkpad/claude-scratchpad/shopware/issue-8815/pr-text.md |
| [#14054](https://github.com/shopware/shopware/issues/14054) Erroneous inheritance switch for checkboxes | Fixed on trunk, merged as [#20924](https://github.com/shopware/shopware/pull/20924) on 2026-10-06, issue closed; **checked in the browser**: under "All Sales Channels" the checkbox has no inheritance switch any more, with a sales channel selected it still has one. | [c8de858a3bb](https://github.com/shopware/shopware/commit/c8de858a3bb) ([#20924](https://github.com/shopware/shopware/pull/20924)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-14054) |
| [#14969](https://github.com/shopware/shopware/issues/14969) Administration: deleting a sales channel opens modal for new sales channel creation | **Fixed on trunk** by [#20923](https://github.com/shopware/shopware/pull/20923) (merged 2026-09-28, issue closed); **checked in the browser**: after deleting a sales channel the dashboard opens without the "Add Sales Channel" modal and the menu reloads. | [8f7e1ff27ba](https://github.com/shopware/shopware/commit/8f7e1ff27ba) ([#20923](https://github.com/shopware/shopware/pull/20923)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-14969) |
| [#10500](https://github.com/shopware/shopware/issues/10500) 500 error when visiting /admin in subfolder-saleschannel | **Fixed on trunk** by [#20926](https://github.com/shopware/shopware/pull/20926) (merged 2026-09-29, issue closed); **checked with curl**: `/<subfolder>/admin` and `/<subfolder>/api/...` return 404 instead of 500, store-api and the root Administration are unchanged. | [10c22c46e80](https://github.com/shopware/shopware/commit/10c22c46e80) ([#20926](https://github.com/shopware/shopware/pull/20926)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-10500) |
| [#14623](https://github.com/shopware/shopware/issues/14623) PriceDefinitionFieldSerializer decode / QuantityPriceDefintion::fromArray looses referencePriceDefinition info | **Fixed on trunk** by [#20922](https://github.com/shopware/shopware/pull/20922) (merged 2026-09-28, issue closed); covered by unit tests of `fromArray()` and the serializer round trip. | [053f476010d](https://github.com/shopware/shopware/commit/053f476010d) ([#20922](https://github.com/shopware/shopware/pull/20922)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-14623) |
| [#17746](https://github.com/shopware/shopware/issues/17746) Product list filter is lost after returning from variant bulk editing | Fixed on trunk, merged as [#20925](https://github.com/shopware/shopware/pull/20925) on 2026-10-06, issue closed (before the merge: review pending; gweiermann's edge case with a stale filter after a detour through another module is fixed in the pushed follow-up `5cabc848921`); **checked in the browser**: after variant bulk editing, the product's back arrow returns to the filtered product list. | [91805c62c9d](https://github.com/shopware/shopware/commit/91805c62c9d) ([#20925](https://github.com/shopware/shopware/pull/20925)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-17746) |
| [#20497](https://github.com/shopware/shopware/issues/20497) Category SEO keywords exceeding 255 characters are not handled gracefully | **Fixed on trunk** by [#20928](https://github.com/shopware/shopware/pull/20928) (merged 2026-09-29, issue closed); covered by integration tests (256 characters are rejected with a violation on the field, 255 are stored) and Jest tests, **checked in the browser**: typing 300 characters into the category keywords or the media alt text stops at 255 with a `255/255` counter, empty fields show `0/255`; before, the input took all characters and saving showed "This value is too long. It should have 255 characters or less." instead of a 500. The same applies to meta title and description of categories and landing pages, whose existing `maxlength` attribute never reached the input. | [b578add4802](https://github.com/shopware/shopware/commit/b578add4802) ([#20928](https://github.com/shopware/shopware/pull/20928)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20497) |
| [#20736](https://github.com/shopware/shopware/issues/20736) Category breadcrumbs are missing in the "Item in category" rule condition | **2026-10-22:** issue closed on 2026-10-09 by larskemper's [#21259](https://github.com/shopware/shopware/pull/21259) (merged 2026-10-09, [e07cac93a94](https://github.com/shopware/shopware/commit/e07cac93a94), entity descriptions in the rule configuration); jozsefdamokos' [#21145](https://github.com/shopware/shopware/pull/21145) was closed unmerged on 2026-10-08. Before: Still open on trunk, local fix dropped (2026-09-30) because the issue was assigned to jozsefdamokos (Shopware), whose fix is in open PR [#21145](https://github.com/shopware/shopware/pull/21145) (review pending); **checked in the browser**: two categories named the same show `Home / CmTestLadies / CmTestJackets` and `Home / CmTestGents / CmTestJackets` below the name. Regression from #17458, which moved the condition to the generic component. | dropped, was `2e581a00745` on `fix/admin-rule-category-breadcrumb`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/0001-fix-administration-show-category-breadcrumbs-in-rule.patch | 6.7.16.0 (via #21259, not released yet) | [PR text](#pr-text-20736) |
| [#20595](https://github.com/shopware/shopware/issues/20595) Store API saves product reviews without a rating when points is missing or null | Fixed on trunk, merged as [#20934](https://github.com/shopware/shopware/pull/20934) on 2026-10-15, issue closed; after review (larskemper, 2026-10-06) `product_review` also marks `externalUser` and `points` as required in the DAL with 6.8, so Admin and Sync API writes need both (`7566fcd375b`, not pushed; the acceptance-test-suite's `createProductReview()` sends no `externalUser`); covered by integration tests: a review without `points` or with `"points": null` now answers `400` on `/points`. No UI check, the Storefront form always sends a rating. Follow-up `b50a769e76b` (not pushed) for mitelg's review: RELEASE_INFO-6.7.md (6.7.16.0, Core) announces the 6.8 requirement; V6_8 migration `Migration1791369987ProductReviewExternalUserNotNull` fills `external_user` NULLs with the customer's first name (or '') and makes the column NOT NULL, `points` stays nullable in the DB (user's choice); migration test fails without the migration; UPGRADE-6.8.md updated. Follow-ups for mitelg/Pierre02 (2026-10-14, not pushed): `dd608932e15` `FloatField` min/max; `41c84e64e91` reviews without rating become `0` points (V6_8 migration `Migration1791982235ProductReviewPointsNotNull`, `NOT NULL`), `RatingAverageUpdater` ignores `0`, 6.8 `points` range 1–5; reply + section-2 suggestion in `/home/thinkpad/claude-scratchpad/shopware/pr-reply-20934-mitelg-points.md`. `d1b98f5d170` (not pushed): both V6_8 review migrations moved to `updateDestructive()` for blue-green (mitelg r4271531244); reply in `pr-reply-20934-mitelg-destructive.md`. | [95d382677f7](https://github.com/shopware/shopware/commit/95d382677f7) ([#20934](https://github.com/shopware/shopware/pull/20934)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20595) |
| [#20264](https://github.com/shopware/shopware/issues/20264) Administration: trailing whitespace is underlined as part of the link | **Fixed on trunk** by [#21035](https://github.com/shopware/shopware/pull/21035) (nguyenquocdaile, merged 2026-10-02, issue closed); local fix dropped (2026-09-30) in favor of it; **checked in the browser**: the product quick links underline only their text with a 6px gap before the arrow, and the measurement hint reads `Sales Channel settings.` without the underlined space. Note: another contributor opened [#21035](https://github.com/shopware/shopware/pull/21035) (2026-09-30) for the same issue, it also touches `sw-product-category-form` and the measurement form. | dropped, was `72763752818` on `fix/admin-link-trailing-whitespace`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/0001-fix-administration-keep-template-whitespace-out-of-u.patch | — | [PR text](#pr-text-20264) |
| [#20287](https://github.com/shopware/shopware/issues/20287) Placeholder image of products without images not centered in category view | **Fixed on trunk** by [#20933](https://github.com/shopware/shopware/pull/20933) (merged 2026-09-29, issue closed); **checked in the browser**: in a 284px product box the placeholder moved from 0px left / 104px right to 52px on both sides. | [501a9c95602](https://github.com/shopware/shopware/commit/501a9c95602) ([#20933](https://github.com/shopware/shopware/pull/20933)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20287) |
| [#17613](https://github.com/shopware/shopware/issues/17613) Administration: Close button is misaligned in notifications | **Fixed on trunk** by [#21081](https://github.com/shopware/shopware/pull/21081) (merged 2026-10-01, issue closed); **checked in the browser**: a growl with a long URL no longer widens the 400px banner, the close button moved from 77px outside to 11px inside. The notification center had the same overflow (428px in 358px) and got the same fix. | [cfceb8df787](https://github.com/shopware/shopware/commit/cfceb8df787) ([#21081](https://github.com/shopware/shopware/pull/21081)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-17613) |
| no issue, sibling of [#20595](https://github.com/shopware/shopware/issues/20595): a required birthday is not enforced by the Store API | **Fixed on trunk** by [#20931](https://github.com/shopware/shopware/pull/20931) (merged 2026-09-28); covered by an integration test: with `core.loginRegistration.birthdayFieldRequired` active, a registration without birthday answers `400` with `VIOLATION::IS_BLANK_ERROR` on `/birthdayDay`, `/birthdayMonth` and `/birthdayYear`. | [81a69ce87cc](https://github.com/shopware/shopware/commit/81a69ce87cc) ([#20931](https://github.com/shopware/shopware/pull/20931)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-birthday) |
| [#10406](https://github.com/shopware/shopware/issues/10406) Premium Theme update notifications are empty | **Fixed on trunk** by [#21088](https://github.com/shopware/shopware/pull/21088) (merged 2026-10-01, issue closed); covered by a Jest test with a real vue-i18n instance: before the fix the warning read `Theme "" is assigned to: `, after it the theme name and assignments are filled in. No browser check, it needs a failing extension deactivation during an update. | [135daff4b87](https://github.com/shopware/shopware/commit/135daff4b87) ([#21088](https://github.com/shopware/shopware/pull/21088)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-10406) |
| [#9148](https://github.com/shopware/shopware/issues/9148) Multi edit: document names missing in i.e. French | **Fixed on trunk** by [#20936](https://github.com/shopware/shopware/pull/20936) (merged 2026-09-30, issue closed); covered by Jest tests and **checked in the browser**: document types without a name in the content language showed an empty label, now they show the translated fallback. The same gap was in the order's send-document modal and the document card, both fixed. In the bulk edit with a French content language, the 10 document checkboxes had empty labels before and show the English names after. | [ac9ea84db0e](https://github.com/shopware/shopware/commit/ac9ea84db0e) ([#20936](https://github.com/shopware/shopware/pull/20936)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-9148) |
| [#9366](https://github.com/shopware/shopware/issues/9366) Missing chevron on category select | **Fixed on trunk** by [#21082](https://github.com/shopware/shopware/pull/21082) (merged 2026-10-01, issue closed); **checked in the browser**: the category field in "Visibility & structure" shows a 10px chevron 17px from the edge like the tags select below it, pointing down while closed, a click opens the tree and focuses the input, a second click closes it. | [66fedc2cabd](https://github.com/shopware/shopware/commit/66fedc2cabd) ([#21082](https://github.com/shopware/shopware/pull/21082)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-9366) |
| [#20918](https://github.com/shopware/shopware/issues/20918) Cookie bar reappears on every page after tapping "Only technically required" on touch devices | **Fixed on trunk** by [#21021](https://github.com/shopware/shopware/pull/21021) (merged 2026-10-01, issue closed); local fix dropped (2026-09-30) in favor of it; covered by a Jest test: on a touch device the button's `touchstart` was prevented, so the click never came. No browser check, touch mode can't be emulated with the available tools and desktop already used `click`. Note: Shopware opened [#21021](https://github.com/shopware/shopware/pull/21021) (joberthel, 2026-09-29) with the same approach (`click` instead of `touchstart`). | dropped, was `8f7711cbdd5` on `fix/storefront-cookie-permission-touch`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/0001-fix-storefront-store-the-cookie-consent-when-denying.patch | — | [PR text](#pr-text-20918) |
| [#20854](https://github.com/shopware/shopware/issues/20854) Migration1752750234AddIndexToOrderTransactionCreateAndUpdate can fail with "Cannot drop index" (MySQL bug 118151) | Fixed on trunk, merged as [#21087](https://github.com/shopware/shopware/pull/21087) on 2026-10-08, issue closed; covered by a migration test: with MySQL answering error 1553 while `restrict_fk_on_non_standard_key` is on, all three order index migrations failed, now they relax the guard, retry and restore it. The order address and line item migrations had the same raw `CREATE INDEX`. Follow-up `0b194c4339c` (not pushed) for the review (mitelg/nfortier): the test trait `NonStandardFkGuardTestTrait` became the static `NonStandardFkGuardTestHelper` (doubles via `MockBuilder` like `AssertingEventDispatcher`, `Assert::` asserts); the three guard tests pass and still fail without the fix. Then `04fe433302f` (call-count expectations, for the PHPUnit 13 job that fails on "no expectations configured" notices) and, after nfortier changed his mind (r4217696267), `17c7af3c153`: the helper became the abstract `NonStandardFkGuardMigrationTestCase` with stubs (`static::createStub`), which the three tests extend; tests pass with `--fail-on-notice` and fail without the fix (both not pushed). | [ac2a2cbe2e2](https://github.com/shopware/shopware/commit/ac2a2cbe2e2) ([#21087](https://github.com/shopware/shopware/pull/21087)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20854) |
| [#18838](https://github.com/shopware/shopware/issues/18838) App sidebar not resizable when an app iframe is open in main content | **Fixed on trunk** by [#21089](https://github.com/shopware/shopware/pull/21089) (merged 2026-10-01, issue closed); **checked in the browser** with a resizable test sidebar and an iframe over the main content: during the drag the iframe gets `pointer-events: none`, so the document keeps the mouse events, afterwards it is `auto` again. | [ca900bc277a](https://github.com/shopware/shopware/commit/ca900bc277a) ([#21089](https://github.com/shopware/shopware/pull/21089)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-18838) |
| [#20364](https://github.com/shopware/shopware/issues/20364) Filter products header cutoff | **2026-11-01:** issue still open upstream. **2026-10-22:** issue still open, no PR references it. **Fixed on trunk** by [#21084](https://github.com/shopware/shopware/pull/21084) (merged 2026-10-01), but the issue is still open (checked 2026-10-05): the PR description says `closes #20365` while the commit says `closes #20364`, so the squash merge closed #20365 instead. Needs on GitHub: close #20364, reopen #20365; **checked in the browser** with a 320px offcanvas and enlarged title text (Chrome has no text-only zoom): at 56px the fixed 80px header cut the two-line title at top and bottom, now it grows to 84px (108px at 72px), and at the default size it stays 80px with title and close button at the same spot. | [f3b0c20057b](https://github.com/shopware/shopware/commit/f3b0c20057b) ([#21084](https://github.com/shopware/shopware/pull/21084)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20364) |
| [#20365](https://github.com/shopware/shopware/issues/20365) Long category names cutoff in offcanvas menu and breadcrumbs | **Fixed on trunk** by [#21083](https://github.com/shopware/shopware/pull/21083) (merged 2026-10-05, issue closed; it had already been closed by mistake on 2026-10-01 by the merge of [#21084](https://github.com/shopware/shopware/pull/21084), the fix for #20364); **checked in the browser** with the category `Supercalifragilisticexpialigetisch` and 32px link text: the breadcrumb in 288px went from 612px content to 288px, the offcanvas link from 628px to 400px, at the default size both look unchanged and the menu icon keeps its width. | [b1abddb5f7b](https://github.com/shopware/shopware/commit/b1abddb5f7b) ([#21083](https://github.com/shopware/shopware/pull/21083)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20365) |
| [#20711](https://github.com/shopware/shopware/issues/20711) A throwing worker event listener kills messenger:consume with exit 1 | **Fixed on trunk** by [#20996](https://github.com/shopware/shopware/pull/20996) (merged 2026-10-01, issue closed); covered by unit tests: a failing statistics write or a missing `message_queue` increment gateway escaped from the subscriber before, now both are logged as warnings and the handled message still counts. The telemetry subscriber already goes through `Meter`, which catches transport failures. | [84cdcbe9e87](https://github.com/shopware/shopware/commit/84cdcbe9e87) ([#20996](https://github.com/shopware/shopware/pull/20996)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20711) |
| [#20408](https://github.com/shopware/shopware/issues/20408) Review stars overlap with product names in listing boxes | **Fixed on trunk** by [#20929](https://github.com/shopware/shopware/pull/20929) (merged 2026-09-28, the issue was reopened by the bot only for the 6.6 backport [#21022](https://github.com/shopware/shopware/pull/21022)); **checked in the browser** with an approved 5-star review and the root font size at 300% (emulates text-only zoom, stars scale to 50px): the stars wrapped into three rows and were drawn over the product name because the rating block kept its 25px height, now the block grows to 216px and they end 10px above the name, the default size stays at 25px. | [60a7ce54ef0](https://github.com/shopware/shopware/commit/60a7ce54ef0) ([#20929](https://github.com/shopware/shopware/pull/20929)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20408) |
| [#17961](https://github.com/shopware/shopware/issues/17961) Administration: keyboard navigation highlight is overridden by mouse pointer position and can move outside the visible container | Fixed on trunk, merged as [#21090](https://github.com/shopware/shopware/pull/21090) on 2026-10-16, issue closed; covered by Jest tests and **checked in the browser** in Chrome: 25 ArrowDown presses in the rule condition type select (103 items, 248px list) keep the highlight inside the visible list every time. The Safari pointer part is covered by a test only, a resting pointer can't be emulated here. | [973a82f5194](https://github.com/shopware/shopware/commit/973a82f5194) ([#21090](https://github.com/shopware/shopware/pull/21090)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-17961) |
| [#18852](https://github.com/shopware/shopware/issues/18852) Deleting media from the Media Library leaves orphaned product.cover reference | **2026-10-28:** **Fixed on trunk** by [#21086](https://github.com/shopware/shopware/pull/21086) (merged 2026-10-26, [2bb45b60941](https://github.com/shopware/shopware/commit/2bb45b60941)); the issue is closed. Before: **2026-10-22:** still open, approved by umutdogan4291 (2026-10-22), the review decision still shows "changes requested". Pushed for the 2026-10-20 reviews: `6792e31e147` (`isDeletedInQueue()` uses `WriteCommandQueue::getCommandsForEntity()`, umutdogan4291), `5f2ff2c7548` (nfortier-shopware's `EntityWriterTest` unit test with fixtures, three integration tests removed), `44599457637` (RELEASE_INFO entry moved to 6.7.17.0 for `release-info/section`); replies: /home/thinkpad/claude-scratchpad/shopware/pr-21086/review-replies-2026-10-20.md. GitHub reported a merge conflict, trunk merged locally in `f292439dbd5` (git merged without conflict; the entry got a blank line before trunk's next heading; DAL write unit tests 61 and MediaRepositoryTest 19 pass, section check ok), not pushed. Before: Still open on trunk, fix in open PR [#21086](https://github.com/shopware/shopware/pull/21086) (review pending); covered by an integration test: deleting the cover's media through `media.repository` left `product.coverId` pointing to the removed `product_media` before, now it is `null`. DAL write, delete, set-null, versioning and product/category repository tests pass. `coverProducts` is the only set-null without a database constraint. Follow-up `414e76f3273` + `3a9582cbd4f` (rector fix, user, pushed) for umutdogan4291's review (r4218728778): the cascade set-null step also queued updates for rows deleted in the same operation (deleting a product with a cover cascades its `product_media`, then set its own `cover`), so the write result reported the product as updated (no `product.deleted` webhook, Sync `deleted.product: []`, variant missing). Now `addDeleteCascadeCommands` queues all cascade deletes before their set-nulls and `addSetNullOnDeletesCommands` skips primaries already deleted in the queue. New tests (repository delete, Sync API delete, parent with variant cover) fail without the follow-up; DAL write integration/unit, MediaRepositoryTest and product delete tests green. Analysis with 3 agents + real runs (rolled-back transaction): only product→product_media→`product.cover` hits the set-null case in core; same bug class via `addReverseInheritedCommands` in Sync requests (`[delete product, delete its product_price/product_media/…]` reported the product under `data`, trunk and PR); moved to its own branch `fix/core-sync-deleted-product-reported-as-update` (`eff9c5d454a`, see its row), removed from this branch by the user Not this bug, found on the way (trunk, separate issue): deleting a category with 3 child levels emits delete events only for the root and the deepest level, because `EntityForeignKeyResolver` merges results per entity with `array_merge` (`:215`, `:391`) and later depths overwrite earlier ones; affects all tree entities (category, media_folder, flow_sequence, rule_condition, nested line items). 2026-10-16: trunk merged into `fix/core-set-null-for-cascaded-deletes` (`8be0d5db3c1`, not pushed, no conflicts locally); umutdogan's step 4 = sync case, now in #21413 → corrected body `pr-texts/21086-body.md`, reply `pr-reply-21086-umutdogan-step4.md`. 2026-10-16: #21413 (sync case) merged with trunk too (`28049a41b29`, not pushed, no conflicts locally). | `4592e24cb9b` + `6792e31e147`, `5f2ff2c7548`, `44599457637`, trunk merge `f292439dbd5` (not pushed) on `fix/core-set-null-for-cascaded-deletes` ([#21086](https://github.com/shopware/shopware/pull/21086)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-18852) |
| [#20369](https://github.com/shopware/shopware/issues/20369) Available addresses search input cutoff | **Fixed on trunk** by [#21085](https://github.com/shopware/shopware/pull/21085) (merged 2026-10-05, issue closed); **checked in the browser** with the template's markup and the compiled theme (the account page needs a customer login, which I didn't do): at 288px with 200% text the search input shrank to 38px next to the "Add address" button, now it takes its own 288px line, at the default size and on wide screens nothing changes. Ludtwig was not available locally. | [e4b23536e89](https://github.com/shopware/shopware/commit/e4b23536e89) ([#21085](https://github.com/shopware/shopware/pull/21085)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20369) |
| [#20870](https://github.com/shopware/shopware/issues/20870) Company logo upload in document settings never completes | **Fixed on trunk** by [#20995](https://github.com/shopware/shopware/pull/20995) (merged 2026-09-30, issue closed); covered by a Jest test and **checked in the browser**: a PNG picked in the invoice settings was uploaded right away, the preview showed it, saving stored `logoId` and the media has its 141-byte file in the Document folder. The test logo was removed afterwards. | [9a3309d505b](https://github.com/shopware/shopware/commit/9a3309d505b) ([#20995](https://github.com/shopware/shopware/pull/20995)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20870) |
| [#20920](https://github.com/shopware/shopware/issues/20920) Documents card: after deleting the last document, the empty state shows a non-functional icon-only button | Fixed on trunk, merged as [#21091](https://github.com/shopware/shopware/pull/21091) on 2026-10-06, issue closed. Partly fixed on trunk by [#20266](https://github.com/shopware/shopware/pull/20266) (the dead button is gone, but the card showed "No documents found", the search bar and no create button), fixed locally, covered by Jest tests for both delete paths (the card's own delete and the `sw-entity-listing` delete used without `DOCUMENT_GENERATION_REWORK`) and **checked in the browser** with a test order: right after deleting the only invoice the card shows "No documents created yet" with "Create new document". | [8bf33fcab25](https://github.com/shopware/shopware/commit/8bf33fcab25) ([#21091](https://github.com/shopware/shopware/pull/21091)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20920) |
| [#20342](https://github.com/shopware/shopware/issues/20342) `Uuid::isValid()` accepts a trailing newline | **Fixed on trunk** by [#20930](https://github.com/shopware/shopware/pull/20930) (merged 2026-09-28, issue closed); covered by a unit test: 32 hex characters plus `\n` were accepted before, now they are rejected, all other Uuid tests pass. `VALID_PATTERN` itself stays unchanged because routes use it as a requirement. | [649580573d4](https://github.com/shopware/shopware/commit/649580573d4) ([#20930](https://github.com/shopware/shopware/pull/20930)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20342) |
| [#8029](https://github.com/shopware/shopware/issues/8029) Readded default Margin in CMS Blocks | **Fixed on trunk** by [#20935](https://github.com/shopware/shopware/pull/20935) (merged 2026-09-28, issue closed); covered by a Jest test and **checked in the browser**: a layout block stored with empty top and bottom margins keeps them when opened in the layout editor and after saving (`NULL` in `cms_block`), the text-on-image background default is still filled. The test layout was removed. | [0e48b90588f](https://github.com/shopware/shopware/commit/0e48b90588f) ([#20935](https://github.com/shopware/shopware/pull/20935)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-8029) |
| [#20974](https://github.com/shopware/shopware/issues/20974) DAL: exact total is wrong when the criteria limit is 1 (to-many filter or search term) | **Fixed on trunk** by [#21093](https://github.com/shopware/shopware/pull/21093) (merged 2026-10-05, issue closed); covered by integration tests that failed before: with a limit of 1 the exact total counted 4 joined rows instead of 2 products for a to-many filter and 1 instead of 2 for a search term, the next-pages total had the same problem (4 instead of 2); limit 2 was already right. DAL search integration suite (182 tests) and the Dbal unit tests pass. | [ebaf3f95176](https://github.com/shopware/shopware/commit/ebaf3f95176) ([#21093](https://github.com/shopware/shopware/pull/21093)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20974) |
| [#14902](https://github.com/shopware/shopware/issues/14902) UninstallContext->keepUserData comment incorrectly explains actual logic | **Fixed on trunk** by [#21092](https://github.com/shopware/shopware/pull/21092) (merged 2026-10-01, issue closed); docblock only: `keepUserData()` said migrations are removed when it returns true. It now describes the flag as the user's choice to keep the plugin's data: when false, the plugin should remove its data in `uninstall()`, and Shopware also removes the plugin's `migration` entries, system config, custom entities/fields and theme (`PluginLifecycleService::uninstallPlugin()`, Storefront `PluginLifecycleSubscriber`). No test (comment-only change). | [7a4eb64f9cb](https://github.com/shopware/shopware/commit/7a4eb64f9cb) ([#21092](https://github.com/shopware/shopware/pull/21092)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-14902) |
| [#19100](https://github.com/shopware/shopware/issues/19100) Administration: Theme compilation completed notification is sent twice | **2026-10-28:** **Fixed on trunk** by [#21779](https://github.com/shopware/shopware/pull/21779) (merged 2026-10-26, [13071807706](https://github.com/shopware/shopware/commit/13071807706)); the issue is closed. Before: **2026-10-22:** still open, approved by marcelbrode (2026-10-22). Pushed: CI fix `c9a505beb3f`, `41ea37b422b` (RELEASE_INFO entry moved to 6.7.17.0 for `release-info/section`), trunk merge `19462b7c7c9`, `cb22abdb5bb` for taltholtmann's review r4348458773 (the getter is now `isNotifyOnCompletion()`, so the messenger serializer keeps the flag in the queued message; the round trip test was removed again on request); reply: /home/thinkpad/claude-scratchpad/shopware/pr-21779/review-replies-2026-10-22.md. Before: Still open on trunk, fix in open PR [#21779](https://github.com/shopware/shopware/pull/21779) (2026-10-19); CI 2026-10-19: the new notification test still mocked the old dependency rows that trunk #21641 replaced, fixed in local follow-up `c9a505beb3f` (not pushed); `release-info/section` fails because the PR has milestone 6.7.17.0 and trunk has no 6.7.17.0 section yet, the entry moves there once [#21767](https://github.com/shopware/shopware/pull/21767) is merged; `compileThemeById()` dispatches one `CompileThemeMessage` per theme/sales channel mapping and `CompileThemeHandler` notified the completion for each; identical texts since #17732 dropped the sales channel name. Only the last message of the batch now notifies (`notifyOnCompletion` flag). Sibling fixed in the same commit: `ThemeLifecycleHandler::recompileAllActiveThemes()` (extension activate/deactivate), via the new optional `$notifyOnAsyncCompletion` parameter of `ThemeService::compileTheme()` (`#[NewOptionalParameter]`, RELEASE_INFO + UPGRADE-6.8 entries). Tests: `ThemeServiceTest`, `CompileThemeHandlerTest`, `ThemeLifecycleHandlerTest` (failed before). | `df8520692df` + `c9a505beb3f`, `41ea37b422b`, trunk merge `19462b7c7c9`, `cb22abdb5bb` on `fix/storefront-theme-compile-notification-once` ([#21779](https://github.com/shopware/shopware/pull/21779)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-19100) |
| [#20316](https://github.com/shopware/shopware/issues/20316) [Admin] In the "Create new global rule" modal, update the input field's step value from 0.01 to 1. | **Fixed on trunk** by [#21094](https://github.com/shopware/shopware/pull/21094) (merged 2026-10-05, issue closed); `sw-rule-modal` priority now `:step="1" :min="0" number-type="int"` like the rule detail page. Sibling fixed: payment method position (`:step="1" number-type="int"`). False positives: tax provider priority (disabled), shipping/property positions (already `:step="1"`). Jest specs failed before. Browser: 3 clicks 0.03 -> 3; payment position 4 -> 6. | [d0a0a79dac8](https://github.com/shopware/shopware/commit/d0a0a79dac8) ([#21094](https://github.com/shopware/shopware/pull/21094)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20316) |
| [#21108](https://github.com/shopware/shopware/issues/21108) Order detail page change to twig block breaks <div> closure | **Fixed on trunk** by [#21189](https://github.com/shopware/shopware/pull/21189) (merged 2026-10-05, issue closed); regression from [#20959](https://github.com/shopware/shopware/pull/20959) (2026-09-30, not released yet): the header `</div>` sat inside `sw_order_detail_header_label_manual_order`, so overriding that block or `sw_order_detail_header_title` left the element unclosed. The Jest test that rendered the template with an override was dropped on review ([r4182093663](https://github.com/shopware/shopware/pull/21189#discussion_r4182093663)); the merged PR only changes the template. The local follow-up `55979034536` is superseded by the pushed test removals `c2dd6628f59` and `c27cf7294a8`. Sibling scan of all Admin templates: 5 more misnested blocks, all already in v6.7.15.0, left out (extensions may rely on them). No browser check, the rendered markup without overrides is unchanged. | [44bf9856bbe](https://github.com/shopware/shopware/commit/44bf9856bbe) ([#21189](https://github.com/shopware/shopware/pull/21189)) | 6.7.16.0 (milestone, not released yet) | [PR text](#pr-text-21108) |
| [#21134](https://github.com/shopware/shopware/issues/21134) Storefront: Mixed usage of legal terms Datenschutz | **2026-10-19:** [#21225](https://github.com/shopware/shopware/pull/21225) (marcelbrode) is merged too ([94840225f87](https://github.com/shopware/shopware/commit/94840225f87)), issue closed on 2026-10-06. Merged as [#21188](https://github.com/shopware/shopware/pull/21188) (2026-10-05) and the issue was closed, but marcelbrode reopened it the same day and opened [#21225](https://github.com/shopware/shopware/pull/21225) (review pending) for the parts left out here: the Admin snippets (`sw-cms`, `sw-extension`) and the label in `loginRegistration.xml`; `storefront.de.json` used "Datenschutzbestimmungen" 9 times and "Datenschutzhinweise" twice, now only "Datenschutzhinweise". Snippet-only change, `composer translation:lint` passes. Not changed: the Admin config label in `loginRegistration.xml`, which is outside the Storefront. | [b93ebdfa0e5](https://github.com/shopware/shopware/commit/b93ebdfa0e5) ([#21188](https://github.com/shopware/shopware/pull/21188)), rest in [94840225f87](https://github.com/shopware/shopware/commit/94840225f87) ([#21225](https://github.com/shopware/shopware/pull/21225)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-21134) |
| [#17747](https://github.com/shopware/shopware/issues/17747) Plugin refresh does one transaction per plugin and N+1 language lookups in PluginService | **2026-11-01:** PR [#21186](https://github.com/shopware/shopware/pull/21186) merged on 2026-10-29; issue still open upstream, the one-transaction-per-plugin part is not done. **2026-10-22:** still open, changes requested by SpiGAndromeda (2026-10-20: `@throws` on the wrong method, the lookup test cannot tell the language ids apart, no test for a locale without a language); addressed in `731741e4761` (pushed); reply: /home/thinkpad/claude-scratchpad/shopware/pr-21186/review-replies-2026-10-21.md. Before: Still open on trunk, partly fixed (the N+1 language lookups only, "relates") in open PR [#21186](https://github.com/shopware/shopware/pull/21186) (review pending); after review (mitelg) the lookup uses `searchIds()` instead of loading the language entity (`cb78f330470`, not pushed); `PluginService::getLanguageIdForLocale()` caches the language id per locale for one `refreshPlugins()` call. Covered by a unit test: two plugins with en-GB and de-DE label and description, 8 language searches before, 2 after. The one-transaction-per-plugin part is left open. 2026-10-16: nfortier's `StaticEntityRepository::of()` suggestion `8e384f3e672` + trunk merge `2f1634bf260` on `fix/core-plugin-refresh-language-lookup` (not pushed); `cd96b1c9bd7` ResetInterface + `kernel.reset` for mitelg r4183059649 (not pushed); replies in `pr-reply-21186.md`. | `87676124d06` + `cb78f330470`, `731741e4761` on `fix/core-plugin-refresh-language-lookup` ([#21186](https://github.com/shopware/shopware/pull/21186)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-17747) |
| [#21141](https://github.com/shopware/shopware/issues/21141) ZUGFeRD/XRechnung cancellation invoice with a promotion is rejected (BR-CL-20) | Fixed on trunk, merged as [#21187](https://github.com/shopware/shopware/pull/21187) on 2026-10-07, issue closed; `ZugferdDocument::withDiscountItem()` writes no reason code when the discount is a charge (positive price), allowances keep `95`. Covered by a unit test (charge with a `ReasonCode` 95 before, none after, `Reason` text kept); all 164 document unit tests pass. Not validated with the KoSIT validator locally. | [8262cb07aed](https://github.com/shopware/shopware/commit/8262cb07aed) ([#21187](https://github.com/shopware/shopware/pull/21187)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-21141) |
| [#20343](https://github.com/shopware/shopware/issues/20343) `ApiController::deleteVersion` route requirements name no placeholder | Fixed on trunk, merged as [#21191](https://github.com/shopware/shopware/pull/21191) on 2026-10-06, issue closed (before the merge: changes requested by nfortier-shopware; the review comments are addressed in `a993456948d`, trunk merged in `aff7d14cbff`, both pushed); `api.deleteVersion` requires 32-hex `versionId` and `entityId` (an invalid id now matches no route, checked with `router:match`), and the dead `'version' => '\d+'` key is gone from four `ApiController` routes, the two `CustomerGroupRegistrationActionController` routes and the generated entity routes of `ApiRouteLoader`. After review (no reflection, check all routes instead): the per-controller reflection tests were replaced by `RouteRequirementsTest`, an integration test over every registered route; it also found the same dead `version` key on all 8 generated entity routes in `ApiRouteLoader` (2040 routes), removed too. `ApiControllerVersionTest::testDeleteVersionWithAMalformedIdIsNotRouted` pins the 404 (400 before). The integration test `ApiControllerVersionTest::testDeleteVersion` fails on trunk as well, unrelated. Not changed: the misleading `invalidVersionId($versionId)` in the `$entityId` check. | [6110e2eea5c](https://github.com/shopware/shopware/commit/6110e2eea5c) ([#21191](https://github.com/shopware/shopware/pull/21191)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20343) |
| [#19024](https://github.com/shopware/shopware/issues/19024) Administration: rented extension deactivation modal never opens on single card toggle | Fixed on trunk, merged as [#21190](https://github.com/shopware/shopware/pull/21190) on 2026-10-06, issue closed; after review (mstegmeyer) the card and the bulk deactivation in `sw-extension-my-extensions-listing` show the fee warning only for an active subscription, a cancelled rent (with `expirationDate`) is deactivated right away (`acf1920453b`, not pushed); `sw-extension-card-bought` checked the long-gone `this.license`, so a rented extension was deactivated without the fees warning. Now it reads `extension.storeLicense.variant`, and the modal bindings use `extension.label` and `!!extension.storeLicense`. Covered by Jest tests (rented: modal shown with name and license, no deactivation call, failed before; bought: deactivated right away). No other stale `license`/`label` references in `sw-extension`. **Checked in the browser** with `MyPlugin` and a rent license set on its card via JS (no rented store extension locally): old build deactivates at once, fix opens the fee warning modal. | [a0349bbf137](https://github.com/shopware/shopware/commit/a0349bbf137) ([#21190](https://github.com/shopware/shopware/pull/21190)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-19024) |
| [#21253](https://github.com/shopware/shopware/issues/21253) CMS video element always uses preload="auto", even when a cover is shown | Fixed on trunk, merged as [#21289](https://github.com/shopware/shopware/pull/21289) on 2026-10-07, issue closed. `cms-element-video.html.twig` hard-coded `preload="auto"` since the element was added ([00b6fba3e89](https://github.com/shopware/shopware/commit/00b6fba3e89), #14239), while `utilities/video.html.twig` already uses `none` with a cover and `metadata` otherwise. Now `auto` only when the video autoplays, `none` when a cover is shown, `metadata` otherwise (`src/Storefront/Resources/views/storefront/element/cms-element-video.html.twig:31-33`). Twig-only, so no PHP test (AGENTS.md); proven with a throwaway render of the trunk and fixed template over 5 configurations: before always `auto`; after cover → `none`, cover + autoplay setting → `none` (no autoplay attribute since a cover suppresses it), no cover → `metadata`, autoplay → `auto`, cover enabled without cover media → `metadata`; `poster`/`autoplay` attributes unchanged. ludtwig v0.13.0 clean. Sibling scan: no other Storefront `<video>` hard-codes `preload`. **Checked in the browser** on a test landing page (approved test data: `small.mp4` with a cover, video element with "show cover", no autoplay; IDs in `/home/thinkpad/claude-scratchpad/shopware/test-data-21253.json`): trunk renders `preload="auto"` and downloads the mp4 (176 KB, 5.58 s buffered) without a click; the fix renders `preload="none"`, only the cover is requested, and clicking play still loads and plays the video. | [9e8c39fc944](https://github.com/shopware/shopware/commit/9e8c39fc944) ([#21289](https://github.com/shopware/shopware/pull/21289)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-21253) |
| [#20273](https://github.com/shopware/shopware/issues/20273) Administration: Advanced Pricing select button can be toggled even if inheritance is active | Fixed on trunk, merged as [#21290](https://github.com/shopware/shopware/pull/21290) on 2026-10-08, issue closed. On a variant's empty advanced-pricing state the "Use advanced prices from parent product" `mt-switch` stayed enabled while inherited, unlike the rule select next to it (`isInherited || …`) and the inherit-wrapper fields elsewhere. Now `:disabled="isInherited || !acl.can('product.editor')"` (`sw-product-detail-context-prices.html.twig:327`); the chain icon still removes and restores the inheritance. Sibling: the identical switch in `sw-product-detail-cross-selling.html.twig:84` fixed the same way (same PR, same issue intent). Jest tests for both (inherited: disabled, failed before with `Received: undefined`; inheritance removed: enabled). Scan of all Admin switches/checkboxes bound to an inheritance flag found only these two. **Checked in the browser** on variant `SW10000.1` (no own advanced prices): the old build (2026-10-03, same template as trunk) has the switch enabled while inherited; an Admin build of this branch (2026-10-06 19:47) has it disabled, and clicking the chain icon removes the inheritance and enables it (not saved). | [87938ac9eb3](https://github.com/shopware/shopware/commit/87938ac9eb3) ([#21290](https://github.com/shopware/shopware/pull/21290)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20273) |
| (no issue) Duplicating a product keeps a variant's own canonical product, pointing at the original | Fixed on trunk, merged as [#21292](https://github.com/shopware/shopware/pull/21292) on 2026-10-09. No upstream issue or PR. The parent clone resets `canonicalProductId` since [#13292](https://github.com/shopware/shopware/pull/13292) (local branch `reset-canonical-product-id-on-product-clone`, merged), but `duplicateVariant()` copied each variant's stored value, so a variant with its own canonical (set via API, import or plugin) kept pointing at the original's variant. Found in the browser on 2026-09-25: the copy `SW10001.1` still has `canonical_product_id` = `CANON-P.2` of the original, and its storefront page rendered `<link rel="canonical" href="…/Canonical-Test/CANON-P.2">`. Now the variant clone also overwrites `canonicalProductId: null` (`sw-product-clone-modal/index.js:136`), so variants inherit the copy's (reset) canonical. Jest test on `duplicateVariant()` (failed before: only `canonicalProductId` missing). Sibling scan: the clone modal is the only place that clones products. After-state not checked in the browser (needs an Admin rebuild and another duplicate). | [e1500abcdf5](https://github.com/shopware/shopware/commit/e1500abcdf5) ([#21292](https://github.com/shopware/shopware/pull/21292)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-clone-variant-canonical) |
| [#21174](https://github.com/shopware/shopware/issues/21174) Advanced Pricing matrix has to small input fields | Fixed on trunk, merged as [#21293](https://github.com/shopware/shopware/pull/21293) on 2026-10-16, issue closed. Follow-up of #20570 / [1431cc2c475](https://github.com/shopware/shopware/commit/1431cc2c475). In non-compact mode `sw-price-field` renders the currency suffix; the advanced-pricing page hid it in grid cells with `.sw-field__addition { display: none }`, but since [80fab68ed8f](https://github.com/shopware/shopware/commit/80fab68ed8f) (#7015, 6.7.0.0) the fields are `mt-number-field` with `.mt-field__addition`, so the rule is dead and the 50px suffix halves each input. Now `.mt-field__addition` is hidden (`sw-product-detail-context-prices.scss:75`); the dead `.sw-field__addition` selectors were dropped in follow-up `0e0fcb3905d` after sydinh's review (r4217393201, r4217398162): no legacy field renders it in either grid. Sibling: the same dead rule in the variants grid's inline edit (`sw-products-variants-overview.scss:60-61`) fixed the same way. **Checked in the browser** (product SW10000, unsaved "Always valid" rule, compact off; the "after" is the same selectors injected into the page, no Admin rebuild): advanced pricing inputs 49px → 85-98px (267.35 needed 75px, 224.574 86px); variant inline edit 49px → 86px. Style-only, no test (AGENTS.md); stylelint clean. Scan: variant modal and currencies modal pass `disable-suffix`; the shipping price matrix never hid the suffix (by design, not this bug). | [f08788f3db6](https://github.com/shopware/shopware/commit/f08788f3db6) ([#21293](https://github.com/shopware/shopware/pull/21293)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-21174) |
| [#21057](https://github.com/shopware/shopware/issues/21057) Import/Export Activity: Content Is Cut Off (duplicate: [#21257](https://github.com/shopware/shopware/issues/21257)) | Fixed on trunk, merged as [#21294](https://github.com/shopware/shopware/pull/21294) on 2026-10-09, issue closed. The activity card puts `sw-import-export-activity` (a plain `div` around the `sw-entity-listing`) into the card's CSS-grid content; a grid item's default `min-width: auto` lets it grow to the table's width, so the card shows only the first columns and the sticky actions column with the ⋯ menu sits outside it. Now `.sw-import-export-activity { min-width: 0 }` (`sw-import-export-activity.scss:4`), fixing the import and the export tab. **Checked in the browser** with one approved test export (profile `default_variant_configuration_settings`) and the profile cell text lengthened in the DOM: before the component was 1393px wide in a 958px card, actions at x=1812-1900 (card ends at 1465); with the rule injected it is 958px, the grid scrolls (958 of 1393px) and the actions column is at 1377-1465. Style-only, no test; stylelint clean. Scan of all `<template #grid>` slots: 23 put a `sw-data-grid`/`sw-entity-listing` in directly (its root has `overflow: hidden`, so it already shrinks), the wrapped ones extend `sw-entity-listing`; only this component wraps a grid in a plain `div` (default card slots not covered). Test data left: 1 export log + file. | [f6959bfef8f](https://github.com/shopware/shopware/commit/f6959bfef8f) ([#21294](https://github.com/shopware/shopware/pull/21294)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-21057) |
| [#20362](https://github.com/shopware/shopware/issues/20362) Header icon number text misaligned/insufficient contrast | Fixed on trunk, merged as [#21296](https://github.com/shopware/shopware/pull/21296) on 2026-10-09, issue closed. Shopware's badge skin (`skin/shopware/component/_badge.scss`) gives `.badge` a fixed `height: 20px; line-height: 20px` (and `.badge-lg` 28px); text zoom enlarges the font but not the box, so the cart/wishlist count spills out of the badge and its white text lands on the white header. Now `height: auto` with `line-height: max(20px, 1.25em)` (`max(28px, 1.25em)` for `.badge-lg`, the order status badge of #20371), so the box stays 20px/28px at the default size and grows with the text. **Checked in the browser** in a 320px popup (Chrome has no text-only zoom, so root font size 200%; badge markup injected, wishlist is disabled locally; the "after" uses the fix's CSS injected): cart badge with "12" before 20px box at y 203-223 with 29px text at y 198-227, after 30px box at y 203-233 containing the text at 203-232; default size unchanged (20px, same positions); `.badge-lg` "Cancelled" at 200% 28px box with 29px text before, 30px after, unchanged at 100%. scssphp 1.12 (theme compiler) passes `max()` through unchanged. Style-only, no test; stylelint clean. Scan for rules with the same px `height` and `line-height`: `.list-price-badge`, `.filter-boolean-label`, `.filter-range-unit`, `.filter-range-divider` have the same pattern but no issue (separate PR if wanted). | [1e6eb9bbd3e](https://github.com/shopware/shopware/commit/1e6eb9bbd3e) ([#21296](https://github.com/shopware/shopware/pull/21296)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20362) |
| [#20380](https://github.com/shopware/shopware/issues/20380) Product Reviews causes horizontal scrolling | Fixed on trunk, merged as [#21297](https://github.com/shopware/shopware/pull/21297) on 2026-10-09, issue closed. The rating filter labels in `review-widget.html.twig` ("Excellent (1)" … "Poor (0)") carry `text-nowrap` since the review widget was added (cf83f9f9052); with enlarged text at 320px they are wider than the 300px reviews offcanvas, so its whole body scrolls horizontally. The filter renders above the review list, the write form and the login form, also with 0 reviews, which matches all three screenshots of the issue. Now the labels may wrap (`review-widget.html.twig:94`). **Checked in the browser** in a 320px popup with root font size 200% (Chrome has no text-only zoom), trunk template vs fix: offcanvas body 285/307 (scrolls 22px, checkboxes and percentages cut at the left edge) → 285/285, no scroll; at the default size the five labels have identical sizes with and without `text-nowrap`. Twig-only, no PHP test (AGENTS.md); ludtwig clean. Scan: no other `text-nowrap` in Storefront templates. Write form while logged in not checked (no customer login). | [451fa0973eb](https://github.com/shopware/shopware/commit/451fa0973eb) ([#21297](https://github.com/shopware/shopware/pull/21297)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20380) |
| [#20378](https://github.com/shopware/shopware/issues/20378) Product description causes horizontal scrolling | Fixed on trunk, merged as [#21298](https://github.com/shopware/shopware/pull/21298) on 2026-10-09, issue closed. Long words in the product description (e.g. the property value "paleturquoise" or `"Aerodynamic` in the title) can't break, so with enlarged text at 320px the description offcanvas scrolls sideways; the properties table grows to its longest word. Now `.product-detail-description { overflow-wrap: anywhere; }` (`page/product-detail/_tabs.scss:10`, same pattern as the merged #20365 fix), which covers the title, the text and the included properties table. **Checked in the browser** in a 320px popup with root font size 200% and the issue's demo texts injected into the real offcanvas markup (no demo data locally), trunk CSS vs the rule injected: offcanvas body 285/382 (table right edge at 402) → 285/285; at the default size all title/table cells keep their sizes (85/175px columns, same line counts), and at 1920px nothing changes. A narrower variant (title, text and value cells only) kept the labels whole but broke the values into fragments and shifted the columns at the default size, so the container rule was kept. Style-only, no test; stylelint clean. | [f67fa583a9e](https://github.com/shopware/shopware/commit/f67fa583a9e) ([#21298](https://github.com/shopware/shopware/pull/21298)) | 6.7.16.0 (released 2026-11-02) | [PR text](#pr-text-20378) |
| (no issue) Sync request reports a product deleted earlier in the request as updated | **2026-10-28:** GitHub reported a merge conflict in `RELEASE_INFO-6.7.md` again; trunk `6ef38361a0e` merged in `f7fbc76836d` (worktree `/home/thinkpad/claude-scratchpad/shopware/pr-21413/wt`; `EntityWriter.php`, changed on both sides, merged cleanly; blank line added before trunk's next heading; section check ok; SyncServiceTest 11 green, PHPStan clean), pushed, mergeable. **2026-10-22:** still open, approved by umutdogan4291 (2026-10-22). Pushed: `ac174484514` (`isDeletedInQueue()` uses `getCommandsForEntity()`, like #21086), `745702ae636` (RELEASE_INFO entry moved to 6.7.17.0). GitHub reported a merge conflict, trunk merged locally in `d40f530938c` (git merged without conflict; blank line added before trunk's next heading; SyncServiceTest 11 and DAL write unit tests 58 pass, section check ok), not pushed. Before: Fix in open PR [#21413](https://github.com/shopware/shopware/pull/21413). Found while analysing #21086 (trunk bug). Later deletes in the same sync (product_price, product_media, cross-sellings, manufacturer, …) queued reverse-inherited or set-null updates for the already deleted product; last command wins, so it was reported under `data`. `EntityWriter::isDeletedInQueue()` skips both kinds of updates for rows deleted in the queue. 2 tests in `SyncServiceTest` fail on trunk; DAL write integration/unit, Sync, MediaRepositoryTest and product inheritance/delete tests green. Cherry-picked from `da69fcc36a6` (PR #21086 branch) plus the helper and the root-level set-null guard; overlaps with #21086's `414e76f3273` (same helper), so whichever merges second needs a small rebase. | `eff9c5d454a` + `ac174484514`, `745702ae636`, trunk merge `d40f530938c` (not pushed) on `fix/core-sync-deleted-product-reported-as-update` ([#21413](https://github.com/shopware/shopware/pull/21413)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-sync-deleted-product) |
| [#21619](https://github.com/shopware/shopware/issues/21619) Order detail: documents card keeps showing the documents of the previous order after switching to another order | **2026-10-22:** fixed on trunk, [#21734](https://github.com/shopware/shopware/pull/21734) merged on 2026-10-20 ([471e5fd7837](https://github.com/shopware/shopware/commit/471e5fd7837)), issue closed. Before: Still open on trunk, fix in open PR [#21734](https://github.com/shopware/shopware/pull/21734); CI 2026-10-16: one job failed for infra reasons (npm ECONNRESET, missing imagick on the runner, or a flaky update test), trunk (`973a82f5194`) merged on 2026-10-16 to trigger a new run, not pushed yet. **Checked in the browser** (2026-10-16, orders 10000/10001 with one invoice each): switching the URL from order 10000 to 10001 kept invoice 1002 before, shows 1003 after (and back). Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21619/21619-before.jpg`, `/home/thinkpad/claude-scratchpad/shopware/issue-21619/21619-after.jpg`. The first attempt failed because the order clone used as test data broke order versioning (`fk.order_delivery.order_id`, a cloned delivery kept pointing at the original order's address; trunk bug since `b658573d9f7`, see `/home/thinkpad/claude-scratchpad/shopware/order-version-500/findings.md`), so no order detail page loaded; test data removed again, versioning works again. Sibling scan: 18 + 6 components with the same stale-data pattern, fixed on the separate branch `fix/admin-reload-on-id-change` (triage `/home/thinkpad/claude-scratchpad/shopware/issue-21619/sibling-triage.md`). | `033456e5449` + trunk merge `d8ac2f35be3` on `fix/admin-order-documents-order-switch` ([#21734](https://github.com/shopware/shopware/pull/21734)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-21619) |
| [#21625](https://github.com/shopware/shopware/issues/21625) Sitemap omits out-of-stock variants that inherit "Clearance sale" from their parent | **2026-10-22:** fixed on trunk, [#21736](https://github.com/shopware/shopware/pull/21736) merged on 2026-10-20 ([c8fb5f1c927](https://github.com/shopware/shopware/commit/c8fb5f1c927)), issue closed. Before: Still open on trunk, fix in open PR [#21736](https://github.com/shopware/shopware/pull/21736). Backend only (sitemap via CLI), covered by integration tests. Sibling scan of raw SQL on inherited product columns: no other hit (`/home/thinkpad/claude-scratchpad/shopware/issue-21625/sibling-triage.md`). | `bceb133cc5f` on `fix/core-sitemap-inherited-closeout` ([#21736](https://github.com/shopware/shopware/pull/21736)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-21625) |
| [#21633](https://github.com/shopware/shopware/issues/21633) Admin: Profile Search Settings: Wrong Input Matching | **2026-10-22:** fixed on trunk, [#21737](https://github.com/shopware/shopware/pull/21737) merged on 2026-10-20 ([d4d324d363c](https://github.com/shopware/shopware/commit/d4d324d363c)), issue closed. Before: Still open on trunk, fix in open PR [#21737](https://github.com/shopware/shopware/pull/21737); CI 2026-10-16: one job failed for infra reasons (npm ECONNRESET, missing imagick on the runner, or a flaky update test), trunk (`973a82f5194`) merged on 2026-10-16 to trigger a new run, not pushed yet. **Checked in the browser**: 78 checkboxes with 2 ids before, 78 ids after; clicking "Customers" unchecked "Orders" before. Sibling: snippet detail translation fields (same commit), also checked in the browser. Screenshots in `/home/thinkpad/claude-scratchpad/shopware/issue-21633/`. | `b4fb79ebf0e` (both commits squashed) + trunk merge `a16610f21a6` on `fix/admin-search-preferences-checkbox-ids` ([#21737](https://github.com/shopware/shopware/pull/21737)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-21633) |
| [#21415](https://github.com/shopware/shopware/issues/21415) Profile form: account type falls back to "Private" after a validation error, hiding company/VAT ID fields and their error messages | **2026-10-22:** issue closed on 2026-10-21 by mstegmeyer's [#21813](https://github.com/shopware/shopware/pull/21813) (merged, [df2a16db518](https://github.com/shopware/shopware/commit/df2a16db518), keeps the submitted profile data after a validation error). **Dropped** (2026-10-19: not needed, local branch deleted). Before: Still open on trunk, fix not pushed. **Checked in the browser** (US VAT check enabled temporarily): before Private, company hidden and empty, VAT error hidden; after Commercial, "ACME 21415", VAT error visible. Follow-up commit `b00b7700189` (on request): salutation, title, names, VAT ID and birthday keep the submitted values too, **checked in the browser** with title and birthday fields enabled temporarily. Screenshots in `/home/thinkpad/claude-scratchpad/shopware/issue-21415/` (`21415-*`, `21415-other-fields-*`). | dropped, was `0723166a5a9` (2 commits, rebased) on `fix/storefront-profile-keep-submitted-account-type`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/profile-keep-submitted-account-type-21415.patch | — | [PR text](#pr-text-21415) |
| [#21688](https://github.com/shopware/shopware/issues/21688) RefreshHttpCacheMessage serializes the complete server parameter bag | **2026-10-22:** fixed on trunk by BrocksiNet's [#21783](https://github.com/shopware/shopware/pull/21783) (merged 2026-10-21, [c0fe9817a99](https://github.com/shopware/shopware/commit/c0fe9817a99), keeps environment variables out of the HTTP cache refresh message); the issue is still open, assigned to BrocksiNet. **Dropped** (2026-10-19: not wanted, local branch deleted). Before: Still open on trunk, fix not pushed. `CacheStore` passes only `HTTP_*` (without `Authorization`) and the request keys the rebuilt request needs; a request rebuilt from the message has the same URI. Unit test failed without the fix (`DATABASE_URL` in the message); cache adapter unit tests 311 pass. Sibling scan: other `server->all()` uses are in-process (sub-requests, ESI, asset fallback), nothing else is serialized. Backend only. | dropped, was `4d28cc8df6d` (rebased) on `fix/core-http-cache-refresh-server-bag`, patch: /home/thinkpad/claude-scratchpad/shopware/dropped-branches/http-cache-refresh-server-bag-21688.patch | 6.7.17.0 (via #21783, not released yet) | [PR text](#pr-text-21688) |
| [#21657](https://github.com/shopware/shopware/issues/21657) Null error when migrating orders | **2026-10-28:** **Fixed on trunk** by [#21777](https://github.com/shopware/shopware/pull/21777) (merged 2026-10-23, [dda4da47a90](https://github.com/shopware/shopware/commit/dda4da47a90)); the issue is closed. Before: Still open on trunk, fix in open PR [#21777](https://github.com/shopware/shopware/pull/21777) (opened 2026-10-19, approved by tamvt on 2026-10-22). Both `OrderStockSubscriber` line item queries skip `referenced_id IS NULL`. Three integration tests (add such a line item, remove a product reference, cancel an order with such a line item) failed with the issue's `TypeError`, pass now; stock tests 55. Sibling scan: no other code builds stock changes from raw line item rows. | `8654dfce5f9` on `fix/core-order-stock-missing-product-reference` ([#21777](https://github.com/shopware/shopware/pull/21777)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-21657) |
| [#20384](https://github.com/shopware/shopware/issues/20384) Quantity input number cutoff | **Fixed on trunk** by [#21775](https://github.com/shopware/shopware/pull/21775) (merged 2026-10-22, [a3ba3b696be](https://github.com/shopware/shopware/commit/a3ba3b696be)); the issue is still open (assigned to marcelbrode), the 6.6.x backport [#21930](https://github.com/shopware/shopware/pull/21930) is open (checked 2026-10-22). Option chosen by the user: quantity takes the room it needs. `.quantity-selector-group` no longer wraps, input `min-width: 2ch`, buy widget quantity column `min-width: min-content` with the buy button `flex: 1 0 10em`, line item quantity wrapper `min-width: min-content`, label `flex-grow: 1` (xs only). **Checked in the browser** (320px popup, root font 200%): PDP input 2px→20px at 100%, 21px→40px at 200%; cart/confirm/offcanvas plus no longer wraps; 375/576/768/1024/1440 unchanged except PDP input at 375px 20px (as before). Remaining horizontal scroll on cart pages at 200% comes from the local test product number (one long word). 3ch was tried first and dropped: it pushed the group 8px past its column at 1024px. Style/Twig only, stylelint and ludtwig clean. | `0c38143817f` on `fix/storefront-quantity-input-text-zoom` ([#21775](https://github.com/shopware/shopware/pull/21775)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-20384) |
| [#20382](https://github.com/shopware/shopware/issues/20382) Change Address modal triggers horizontal scrolling | **2026-10-28:** **Fixed on trunk** by [#21774](https://github.com/shopware/shopware/pull/21774) (merged 2026-10-23, [5fbfc0daced](https://github.com/shopware/shopware/commit/5fbfc0daced)); the issue is closed. Before: Still open on trunk, fix in open PR [#21774](https://github.com/shopware/shopware/pull/21774) (opened 2026-10-19, approved by marcelbrode on 2026-10-22, who added `853033e978c` with `overflow-wrap` on the address class; mergeable after #21773, checked 2026-10-22). Tab buttons `flex-wrap` + `flex: 1 1 0`, add button `mw-100`, address box `min-width: 0` with `overflow-wrap: anywhere` for the address, badge `px-3 px-sm-4` (also in the account address book item). **Checked in the browser**: modal body 273/483 → 273/273 at 320px/200%; at 100% (320/375/768) no overflow, tabs one row, now equal width. Conflicts with the #20366 branch in `_address.scss` (same block). Style/Twig only, stylelint and ludtwig clean. | `e00a3dc7c47` + `853033e978c` (marcelbrode) on `fix/storefront-address-modal-text-zoom` ([#21774](https://github.com/shopware/shopware/pull/21774)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-20382) |
| [#20366](https://github.com/shopware/shopware/issues/20366) Ellipsis menu options are cutoff | **Fixed on trunk** by [#21773](https://github.com/shopware/shopware/pull/21773) (merged 2026-10-22, [a5a0350c4f9](https://github.com/shopware/shopware/commit/a5a0350c4f9)); the issue is still open (assigned to marcelbrode), the 6.6.x backport [#21931](https://github.com/shopware/shopware/pull/21931) is open (checked 2026-10-22). Address item menus (address book + address manager) and the order context menu get `width: max-content`, `min-width: min(10rem, 100vw - 2rem)`, `max-width: calc(100vw - 2rem)` and wrapping items. **Checked in the browser**: at 320px/200% address menu 512px → 256px, order menu 448px → 256px; at 100% and 1024px widths unchanged (257/225px). Address book page still scrolls at 200% because of the address cards (fixed by the #20382 branch). Not covered: order item labels ("Shipping status", "Payment") overlap their values at 200%. Sibling scan of all Storefront dropdowns: currency/language (short items), navbar (desktop), filters (no dropdown items), account widget (offcanvas on mobile). Conflicts with the #20382 branch in `_address.scss`. Style only, stylelint clean. | `bc35c9d9c51` on `fix/storefront-ellipsis-menu-text-zoom` ([#21773](https://github.com/shopware/shopware/pull/21773)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-20366) |
| (no issue) Dynamic product groups modal loads all visibilities of 500 products | **2026-11-02:** PR [#22014](https://github.com/shopware/shopware/pull/22014) merged on 2026-10-26 (`63e6e920356`, milestone 6.7.17.0). Before: still open on trunk, fix in open PR [#22014](https://github.com/shopware/shopware/pull/22014) (opened 2026-10-23, no review yet). the unused `visibilities.salesChannel` association loads every sales channel per product. Local fix: drop it; Jest test fails before. Based on `9f14f565c49`. | `3d4d7454aa5` on `fix/admin-dynamic-product-groups-payload` (worktree `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-admin-dynamic-groups`) | 6.7.17.0 (milestone, not released yet) | /home/thinkpad/claude-scratchpad/shopware/many-sales-channels/admin-dynamic-product-groups-payload/pr-text.md |
| [#9685](https://github.com/shopware/shopware/issues/9685) Remove mt-empty-state customization in the sw-settings-message-stats | **2026-11-01:** issue closed on 2026-10-30; PR [#21956](https://github.com/shopware/shopware/pull/21956) merged on 2026-10-30, row moved to `merged.md` on 2026-11-02. **2026-10-28 (lint):** trunk #21729 (`c2ee631c74d`) added the ESLint rule `sw-test-rules/no-vm-access` with per-file counts in `eslint-suppressions.json`; the PR's spec had 1 `wrapper.vm` use too many, so the next CI run would fail `lint`. Follow-up commit `8b2a0b7ef60`, trunk merge `59c856fb599` (trunk `1c67070d782`), pushed 2026-10-28 asserts the passed `getStats` mock instead; the merge with trunk is at the baseline (2). **2026-10-25:** open PR [#21956](https://github.com/shopware/shopware/pull/21956), mergeable, no review yet. Before: still open on trunk; the *Refresh data* button is rendered next to `mt-empty-state` as a workaround from #8698, although meteor 5.8.0 has a `button` slot. Local fix: button in the slot, workaround class removed; Jest test fails before, spec 9 green. **Checked in the browser**: button 72px below the text outside the empty state before, 24px inside it after, refresh reloads the stats. Screenshots: /home/thinkpad/claude-scratchpad/shopware/issue-9685/before-empty-state.png, /home/thinkpad/claude-scratchpad/shopware/issue-9685/after-empty-state.png | `4dbcafd66d2` on `fix/admin-message-stats-empty-state-button` ([#21956](https://github.com/shopware/shopware/pull/21956)) | 6.7.17.0 (milestone, not released yet) | /home/thinkpad/claude-scratchpad/shopware/issue-9685/pr-text.md |
| [#21580](https://github.com/shopware/shopware/issues/21580) Admin search exhausts memory: EntityScoreQueryBuilder recurses forever on circular SearchRanking associations | **2026-11-01:** issue closed and PR [#21778](https://github.com/shopware/shopware/pull/21778) merged on 2026-10-30, row moved to `merged.md` on 2026-11-02. **2026-10-28:** PR [#21778](https://github.com/shopware/shopware/pull/21778) approved by BrocksiNet, head `b51ae8d5004`. Non-blocking review ask: cover a direct self-reference and a many-to-many cycle. Added `testSelfReferencingAssociationsAreNotFollowed` (parent/children on the same definition) and `testCircularManyToManyAssociationsAreNotFollowedBackToADefinitionOnThePath` (entry ↔ tag via a mapping definition) to `EntityScoreBuilderTest`; worktree `/home/thinkpad/claude-scratchpad/shopware/pr-21778/wt`. Both run out of memory on trunk's builder (endless recursion); with the fix both pass; a variant that checks the mapping instead of the target definition makes the many-to-many test run out of memory. File 20 tests green, CS and PHPStan clean. Follow-up commit `eef545ca5f3` (not pushed). Still open on trunk, fix in open PR [#21778](https://github.com/shopware/shopware/pull/21778) (opened 2026-10-19, no review yet, checked 2026-10-22). Recursion bug is old; reachable since #19399 (DAL fallback of the admin search). Path guard in `EntityScoreQueryBuilder` via a private helper (public signature unchanged). Integration test with two definitions pointing at each other ran forever without the fix (stopped after 120 s), passes now; a second association to the same entity is still followed. EntityScoreBuilderTest 18, related tests 11. Sibling scan: only this class walks `SearchRanking` associations. Backend only, no browser check. | `d3cea07bd0b` on `fix/core-search-ranking-cycle` ([#21778](https://github.com/shopware/shopware/pull/21778)) | 6.7.17.0 (milestone, not released yet) | [PR text](#pr-text-21580) |

## Sales channel scaling audit (merged)

| Finding | Local fix | Branch and worktree | Tests and lint |
|---|---|---|---|
| (no issue) The dynamic product groups modal of a sales channel loads up to 500 products with all their visibilities and full sales channels, but only uses the product ids | Drop the unused `visibilities.salesChannel` association | `3d4d7454aa5` on `fix/admin-dynamic-product-groups-payload`, PR [#22014](https://github.com/shopware/shopware/pull/22014) (merged 2026-10-26 as [63e6e920356](https://github.com/shopware/shopware/commit/63e6e920356), 6.7.17.0), in `/home/thinkpad/claude-scratchpad/shopware/many-sales-channels/wt-admin-dynamic-groups` | New Jest test fails before; 27 suites / 391 tests in `sw-sales-channel` green; ESLint and Prettier clean |

## Notes

On 2026-10-28, PHPUnit unit failed in every PR (incl. #21741, #21417, #22017, #21956): CI resolves dependencies without a lock file and got `symfony/rate-limiter` v7.4.22 (commit `4c70bcab8a` rounds `retryAfter` up), so `RateLimiterTest` got 61 instead of the hard-coded `time() + 60` seconds.
Fix PR [#22183](https://github.com/shopware/shopware/pull/22183) (`fix/rate-limiter-test-retry-after`, worktree `/home/thinkpad/claude-scratchpad/shopware/rate-limiter-retry-after/wt`) takes the expected retry time from `$limiter->consume(0)->getRetryAfter()`; passes with v7.4.18 and v7.4.22.

## PR texts

<a id="pr-text-14054"></a>

### #14054 Erroneous inheritance switch for checkboxes

Existing PR: [#20924](https://github.com/shopware/shopware/pull/20924) (OPEN | fix(administration): hide checkbox inheritance switch in default scope)

Commit message:
```
fix(administration): hide checkbox inheritance switch in default scope
```

PR text:
````markdown
### 1. Why is this change necessary?

Plugin config pages show an inheritance switch next to `type="checkbox"` fields even when "All Sales Channels" is selected. That scope has no parent, so the switch has nothing to link to.

### 2. What does this change do, exactly?

`getMeteorElementBind()` in `sw-system-config` now passes `inheritedValue` only when `mapInheritance.isInheritField` is true, and `null` otherwise. `mapInheritanceSlotPropsToMeteorProps()` already does the same for custom fields. 

### 3. Describe each step to reproduce the issue or behaviour.

1. Add a checkbox to a plugin's `config.xml`:
   ```xml
   <input-field type="checkbox">
       <name>mycooltest</name>
       <label>My cool Test</label>
   </input-field>
   ```
2. Install and activate the plugin, then open Extensions > My extensions > Configure.
3. With "All Sales Channels" selected:
   - Before: the checkbox has a link icon (inheritance switch).
   - After: no icon, same as the text field above it.
4. Select a sales channel: the checkbox shows the inheritance switch and inherits the default value, as before.

Before: 
<img width="1516" height="784" alt="image" src="https://github.com/user-attachments/assets/954ef455-0476-4172-b77b-c87c118ad062" />

After:
All saleschannels:
<img width="1516" height="784" alt="image" src="https://github.com/user-attachments/assets/e1846066-0847-4070-a43e-fd7b95d507e2" />

Storefront Sc:
<img width="1516" height="784" alt="image" src="https://github.com/user-attachments/assets/89d5e4f7-8b73-4ab7-be80-e64a56dcd89f" />

### 4. Please link to the relevant issues (if any).

- closes #14054
- relates #19383 <- it's not fixed here, but treated as expected, I think we need to adjust when either one gets merged.

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [x] I have read the contribution requirements and fulfilled them
````

<a id="pr-text-14969"></a>

### #14969 Administration: deleting a sales channel opens modal for new sales channel creation

Existing PR: [#20923](https://github.com/shopware/shopware/pull/20923) (OPEN | fix(administration): reload sales channel menu after deletion)

Commit message:
```
fix(administration): reload sales channel menu after deletion
```

PR text:
````markdown
### 1. Why is this change necessary?

After deleting a sales channel, the Administration goes to the dashboard and opens the "Add Sales Channel" modal right away.

`sw-sales-channel-detail-base` emits `sw-sales-channel-detail-base-sales-channel-change` after a successful delete. The Vue compat migration (9fbfa6a7375) created that event to replace `$root.$emit('sales-channel-change')`, which the menu handled with `loadEntityData`. In the same migration, `sw-sales-channel-menu` subscribed `openSalesChannelModal` to the new event, which was the handler of the former `on-add-sales-channel` event. The list page's add button later got its own `sw-sales-channel-list-add-new-channel` event (#8599), so today the delete path is the only emitter.

### 2. What does this change do, exactly?

`sw-sales-channel-menu` now handles `sw-sales-channel-detail-base-sales-channel-change` with `loadEntityData` (in both `on` and `off`). After a deletion the menu reloads its sales channels and no modal opens. `sw-sales-channel-list-add-new-channel` still opens the modal.

I think the extensions need to be notified that `sw-sales-channel-detail-base-sales-channel-change` no longer opens the modal. It's `sw-sales-channel-list-add-new-channel` now.

### 3. Describe each step to reproduce the issue or behaviour.

1. Administration > Sales Channels > open any sales channel.
2. Click "Delete Sales Channel" and confirm.
3. Before: you land on the dashboard with the "Add Sales Channel" modal open.
   After: you land on the dashboard without a modal, and the deleted sales channel is gone from the menu.
4. Sales Channels list > "Add Sales Channel" still opens the modal.

Before:
<img width="1516" height="784" alt="image" src="https://github.com/user-attachments/assets/91e4b2e0-1333-4af8-a24e-537265c07614" />

After:
<img width="1516" height="784" alt="image" src="https://github.com/user-attachments/assets/3a7cde95-4eb2-4703-8589-6e9676270141" />

### 4. Please link to the relevant issues (if any).

- closes #14969

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [x] I have read the contribution requirements and fulfilled them
````

<a id="pr-text-10500"></a>

### #10500 500 error when visiting /admin in subfolder-saleschannel

Existing PR: [#20926](https://github.com/shopware/shopware/pull/20926) (OPEN | fix(storefront): return 404 for admin below virtual domain paths)

Commit message:
```
fix(storefront): return 404 for admin below virtual domain paths
```

PR text:
````markdown
### 1. Why is this change necessary?

If a sales channel domain has a path, such as `shop.com/de`, then `shop.com/de/admin` and `shop.com/de/api/...` return a 500. They should return a 404.

`RequestTransformer::isSalesChannelRequired()` compares the raw path `/de/admin` with the registered API prefixes. The comparison fails, so the request is turned into a sales channel request for `/admin`. Because it now carries a sales channel ID, `SalesChannelRequestContextResolver` doesn't resolve an API `Context` for the Administration route, and the controller fails.

### 2. What does this change do, exactly?

- `RouteScopeCompilerPass` now also collects the route prefixes of the scopes that implement `ApiContextRouteScopeDependant` into a new container parameter, `shopware.routing.api_context_route_prefixes`. Those are the Administration and Admin API scopes: the admin path, `api` and `sw-domain-hash.html`.
- `RequestTransformer` receives this list as an optional constructor argument. When it has found the sales channel's virtual base URL, it checks the path below it. If that path starts with one of these prefixes, the request is returned without the sales channel transform and the router answers with 404.

### 3. Describe each step to reproduce the issue or behaviour.

1. Give a sales channel a domain with a path, for example `https://shop.test/de`.
2. Open `https://shop.test/de/admin` and `https://shop.test/de/api/_info/version`.
   - Before: 500. The first fails with the `TypeError` above; the Admin API route has no context either.
   - After: 404.
3. Check that the rest still works:
   - `https://shop.test/de/store-api/context` answers as before (401 without an access key).
   - `https://shop.test/de/` renders the Storefront.
   - `https://shop.test/admin` opens the Administration.

### 4. Please link to the relevant issues (if any).

- closes #10500

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [x] I have read the contribution requirements and fulfilled them
````

<a id="pr-text-14623"></a>

### #14623 PriceDefinitionFieldSerializer decode / QuantityPriceDefintion::fromArray looses referencePriceDefinition info

Existing PR: [#20922](https://github.com/shopware/shopware/pull/20922) (OPEN | fix(core): keep reference price when decoding quantity price definitions)

Commit message:
```
fix(core): keep reference price when decoding quantity price definitions
```

PR text:
````markdown
### 1. Why is this change necessary?

`PriceDefinitionFieldSerializer::encode()` stores the whole `QuantityPriceDefinition`, including its `referencePriceDefinition`. `decode()` builds the object with `QuantityPriceDefinition::fromArray()`, which restores price, tax rules, quantity, list and regulation price, but not the reference price definition.

So every DAL read of a price definition field (for example `order_line_item.priceDefinition`) returns the definition without its reference price. When the entity is written back, for example when an order version is merged, the stored data loses it too. The calculated price still has the reference price, so the storefront is unaffected, but the price definition data is lost.

### 2. What does this change do, exactly?

`QuantityPriceDefinition::fromArray()` restores the `ReferencePriceDefinition` when `referencePriceDefinition` has a purchase unit, a reference unit and a unit name. Incomplete data is ignored.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create an order with a line item whose `priceDefinition` is a `QuantityPriceDefinition` with a `referencePriceDefinition` (for example via the Admin API).
2. Read the line item back.
   - Before: `priceDefinition.referencePriceDefinition` is `null`, and after an order version merge it is also gone from `order_line_item.price_definition`.
   - After: the reference price definition is kept.

### 4. Please link to the relevant issues (if any).

- closes #14623

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [x] I have read the contribution requirements and fulfilled them
````

<a id="pr-text-17746"></a>

### #17746 Product list filter is lost after returning from variant bulk editing

Existing PR: [#20925](https://github.com/shopware/shopware/pull/20925) (OPEN | fix(administration): keep list filters on the back arrow after a detour)

Commit message:
```
fix(administration): keep list filters on the back arrow after a detour
```

PR text:
````markdown
### 1. Why is this change necessary?

If you filter the product list, open a product, edit its variants with the bulk edit and then use the back arrow of the product, you land on the unfiltered product list. `sw-page` builds the back arrow from `history.state.back`, but only uses it when the previous page is the parent route (`meta.parentPath`). After the bulk edit, the previous page is the bulk edit, so the back arrow falls back to `{ name: parentPath }` without the listing's query (search term, filters, page, sorting).

### 2. What does this change do, exactly?

- `sw-page` remembers the last full path of every route it renders (a module-level map, updated by a `$route.fullPath` watcher, so query changes on the listing are included). Routes with params, such as detail pages, are not remembered, because they may belong to another entity (for example `sw.property.option.detail` has the parent `sw.property.detail`). The paths are stored per administration user, since logging out and in again does not reload the page.
- `routerBack` still prefers the previous page when it is the parent route. Otherwise it uses the remembered path of the parent route, and only then the bare route name.

### 3. Describe each step to reproduce the issue or behaviour.

1. Administration > Catalogues > Products, search for a term (or apply a filter).
2. Open a product with variants, go to the Variants tab, select variants and click the bulk edit action.
3. Leave the bulk edit with its back arrow, then use the back arrow of the product.
   - Before: the product list shows all products.
   - After: the product list shows the previous search/filter result.

Before:
<img width="910" height="471" alt="image" src="https://github.com/user-attachments/assets/bd8c6c45-4a4d-457d-af1d-2afa2117331d" />

After:
<img width="941" height="459" alt="image" src="https://github.com/user-attachments/assets/4e9b6b74-8e78-479e-8c83-0c27046877df" />

### 4. Please link to the relevant issues (if any).

- closes #17746

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [ ] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [ ] This change has comments for package types, values, functions, and non-obvious lines of code
- [x] I have read the contribution requirements and fulfilled them
````

<a id="pr-text-20497"></a>

### #20497 Category SEO keywords exceeding 255 characters are not handled gracefully

Commit messages (two commits on the branch):
```
fix(core): validate the length of seo fields instead of widening columns
fix(administration): limit seo fields and media alt text to 255 characters
```

Release notes: Not needed. This is a narrow bug fix: values over 255 characters could not be stored before either, they now get a validation error instead of a database error.

PR text:
````markdown
### 1. Why is this change necessary?

The category SEO tab accepts keywords longer than 255 characters. Saving them fails with a 500 (`SQLSTATE[22001]: String data, right truncated: 1406 Data too long for column 'keywords'`), and the Administration shows no error, so it looks as if the category was saved.

`keywords`, `meta_title` and `meta_description` of `category_translation` and `landing_page_translation`, and `alt` of `media_translation`, are `VARCHAR(255)` columns. Their definitions use `LongTextField`, which has no length limit, so the DAL passes any length on to the database.

### 2. What does this change do, exactly?

These fields are now `StringField`s, whose default max length is 255:

- `CategoryTranslationDefinition`: `metaTitle`, `metaDescription`, `keywords`
- `LandingPageTranslationDefinition`: `metaTitle`, `metaDescription`, `keywords`
- `MediaTranslationDefinition`: `alt`

A value over 255 characters now gets a write validation error on the field instead of a database error, and the Administration lists it in the error summary of the page. Up to 255 characters are stored as before. The columns stay unchanged.

In the Administration, the inputs now stop at 255 characters and show a character counter:

- The category SEO form and the landing page SEO form pass `:max-length="255"` to meta title, meta description and keywords. Meta title and description already had `maxlength="255"`, but `mt-text-field` and `mt-textarea` take the limit as the `maxLength` prop, so the plain attribute ended up on the wrapper `div` and limited nothing.
- The media sidebar passes `:max-length="255"` to the alt text field.
- The Meteor counter counts `String(modelValue)`, so an empty `null` value would show `4/255`. The text fields therefore get `?? ''`; the `StringField` stores an empty string as `null`, so nothing changes in the data.

`ProductTranslationDefinition` already uses `StringField` for `metaTitle` and `metaDescription`. Product `keywords` is a `MEDIUMTEXT` column and stays a `LongTextField`.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a category in the Administration and go to the SEO tab.
2. Type 300 characters into "Keywords" and save.
   - Before: the field takes all characters and the request fails with a 500 and code `1406`. The Administration shows no error, and after a reload the old value is back.
   - After: typing stops at 255 characters and the counter shows `255/255`. Empty fields show `0/255`.
3. Send a keyword value over 255 characters through the API: the write fails with "This value is too long. It should have 255 characters or less." on the field, nothing is stored.
4. Enter 255 characters and save: the value is stored.

The same applies to meta title and description of categories and landing pages, and to the media alt text in the media sidebar.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

closes #20497

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

Screenshots:
Retaken on 2026-09-30 on trunk cd11367d9af: "before" is trunk with the merged fix reverted (for #9148: plain trunk), "after" is trunk (for #9148: trunk plus the PR commit).
- Before (trunk with #20928 reverted: the field takes all 299 typed characters, no counter): /home/thinkpad/claude-scratchpad/shopware/screenshots/20497-before-category-keywords.jpg
- After, category keywords: /home/thinkpad/claude-scratchpad/shopware/screenshots/20497-after-category-keywords.jpg
- After, media alt text: /home/thinkpad/claude-scratchpad/shopware/screenshots/20497-after-media-alt.jpg

<a id="pr-text-20736"></a>

### #20736 Category breadcrumbs are missing in the "Item in category" rule condition

Commit message:
```
fix(administration): show category breadcrumbs in rule conditions
```

Release notes: Not needed. This is a narrow Administration bug fix with no external contract change.

PR text:
````markdown
### 1. Why is this change necessary?

Since #17458 moved the "Item in category" rule condition to the generic condition component, the category selection shows only the category name. The breadcrumb below each option is gone. With several categories of the same name, for example "Jackets" below "Ladies", "Gents" and "Kids", admins can't tell which one they pick.

### 2. What does this change do, exactly?

- `sw-condition-generic` fills the `result-description-property` slot of the select for category fields and sets `description-position` to `bottom`, so every option shows its breadcrumb below the name again, as the old category condition did.
- The `generic-condition` mixin gets two helpers: `isCategoryField()` (true when `field.config.entity` is `category`) and `getCategoryBreadcrumb()`, which joins `category.breadcrumb` with ` / ` and falls back to the name when there is no breadcrumb.

Fields of other entities render as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create the categories "Ladies > Jackets" and "Gents > Jackets".
2. Create a rule and add the condition "Item in category" with "At least one" and "Is one of".
3. Search for "Jackets" in the category selection.
   - Before: both options read "Jackets".
   - After: below the names they show `Home / Ladies / Jackets` and `Home / Gents / Jackets`.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

closes #20736

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

Screenshots (Test rule "Item in category", categories CmTestLadies/CmTestJackets and CmTestGents/CmTestJackets, dropdown searched for "CmTestJackets"):
- Before (two identical results): /home/thinkpad/claude-scratchpad/shopware/screenshots/20736-before-category-results.jpg
- After (breadcrumb below each result): /home/thinkpad/claude-scratchpad/shopware/screenshots/20736-after-category-results.jpg

<a id="pr-text-20595"></a>

### #20595 Store API saves product reviews without a rating when points is missing or null

Commit message:
```
fix(core): require a rating when saving a product review
```

Release notes: Needed and already in the commit: a `RELEASE_INFO-6.7.md` entry "Product reviews require a rating", because headless Store API clients that skip `points` now get a `400`.

PR text:
````markdown
### 1. Why is this change necessary?

`POST /store-api/product/{productId}/review` saves a review without a rating when `points` is missing or `null`. `ProductReviewSaveRoute::validate()` checks `points` only with `GreaterThanOrEqual(1)` and `LessThanOrEqual(5)`, and Symfony's comparison constraints accept `null`. `product_review.points` is nullable, so the review is stored with `points = NULL`.

The Storefront form always sends a rating. Headless frontends and direct Store API calls can leave it out.

### 2. What does this change do, exactly?

- `points` gets `NotBlank()` next to its range constraints. A request without it, or with `"points": null`, now answers `400` with `VIOLATION::IS_BLANK_ERROR` on `/points`, like `title` and `content`.
- The Store API schema (`StoreApi/paths/product.json`) lists `points` as required again and describes it as a rating from 1 to 5. #20739 had removed it from `required` to document the old behaviour.
- `RELEASE_INFO-6.7.md` has an entry for headless frontends.

### 3. Describe each step to reproduce the issue or behaviour.

1. Log in a customer through `POST /store-api/account/login` and keep the `sw-context-token`.
2. Save a review without points:
   ```
   curl -X POST 'https://<shop>/store-api/product/<productId>/review' \
     -H 'sw-access-key: <access key>' \
     -H 'sw-context-token: <context token>' \
     -H 'Content-Type: application/json' \
     -d '{"title":"Solid table","content":"Sturdy, easy to assemble and it looks exactly like the photos."}'
   ```
   - Before: `204 No Content`, and the stored review has `points = NULL`.
   - After: `400` with a violation on `/points`, and no review is stored.
3. Send `"points": null`: same result as step 2.

### 4. Please link to the relevant issues (if any).

closes #20595

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

<a id="pr-text-20264"></a>

### #20264 Administration: trailing whitespace is underlined as part of the link

Commit message:
```
fix(administration): keep template whitespace out of underlined links
```

Release notes: Not needed. This is a style-only Administration bug fix with no external contract change.

PR text:
````markdown
### 1. Why is this change necessary?

Some links in the product detail page underline a trailing space. The card quick links on the General tab, such as the advanced pricing link, underline the space between their text and the arrow icon. On the Specifications tab the measurement hint underlines the space after "Sales Channel settings", before the period.

The build collapses the template newlines between the link text and the icon into a space. That space sits inside the underlined link.

### 2. What does this change do, exactly?

- `sw-internal-link` uses Twig whitespace control (`{%- endblock -%}`, `{%- block … -%}`) around the slot and icon blocks, so no space is rendered between text and icon. Inline links get a `6px` left margin on the icon instead.
- `.sw-card__quick-link` in `global.scss` is an inline flex container with a `6px` gap, so the space between text and arrow is no longer part of the underline.
- The advanced pricing link in product bulk edit gets the `sw-card__quick-link` class.
- The advanced visibility link in `sw-product-category-form` moves its inline `style="text-align: right; display: block"` to the SCSS file as `display: flex; justify-content: flex-end`, so it stays right-aligned with the new flex layout.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a product in the Administration and look at the quick links on the General tab.
   - Before: the underline runs past the text into the space before the arrow.
   - After: only the text is underlined, and the arrow sits 6px after it.
2. Open the Specifications tab and look at the measurement hint.
   - Before: the space between "Sales Channel settings" and the period is underlined.
   - After: it reads `Sales Channel settings.` with no underlined space.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

closes #20264

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

Screenshots (Product "Canonical Test", "Set visibility for selected Sales Channels" quick link, 3x enlarged):
- Before (underline continues under the trailing space up to the arrow): /home/thinkpad/claude-scratchpad/shopware/screenshots/20264-before-quick-link.jpg
- After (underline ends with the text, gap before the arrow): /home/thinkpad/claude-scratchpad/shopware/screenshots/20264-after-quick-link.jpg

<a id="pr-text-20287"></a>

### #20287 Placeholder image of products without images not centered in category view

Commit message:
```
fix(storefront): center the image placeholder in product boxes
```

Release notes: Not needed. This is a style-only Storefront bug fix with no external contract change.

PR text:
````markdown
### 1. Why is this change necessary?

In category listings, a product without images shows a placeholder that sits at the left edge of the image area, while real product images are centered.

`.product-image-placeholder` has a `max-width` of 180px and relied on flex centering from the image link. Since #6605 that link no longer wraps the image, so nothing centers the placeholder.

### 2. What does this change do, exactly?

`.product-image-placeholder` in `_product-box.scss` gets `margin: 0 auto`, so it centers itself inside the image wrapper.

### 3. Describe each step to reproduce the issue or behaviour.

1. Remove all images from a product.
2. Clear the cache and open a category that lists the product.
   - Before: the placeholder sits at the left. In a 284px product box it has 0px space on the left and 104px on the right.
   - After: the placeholder is centered, with 52px on both sides.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

closes #20287

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

Screenshots (Home listing, two products without images, product box 284px wide):
Retaken on 2026-09-30 on trunk cd11367d9af: "before" is trunk with the merged fix reverted (for #9148: plain trunk), "after" is trunk (for #9148: trunk plus the PR commit).
- Before (placeholder flush left, 0px left / 104px right): /home/thinkpad/claude-scratchpad/shopware/screenshots/20287-before-placeholder.jpg
- After (centered, 52px on both sides): /home/thinkpad/claude-scratchpad/shopware/screenshots/20287-after-placeholder.jpg
- Full pages: /home/thinkpad/claude-scratchpad/shopware/screenshots/20287-before-full.jpg, /home/thinkpad/claude-scratchpad/shopware/screenshots/20287-after-full.jpg

<a id="pr-text-17613"></a>

### #17613 Administration: Close button is misaligned in notifications

Commit message:
```
fix(administration): wrap long notification messages
```

Release notes: Not needed; this is a CSS bug fix in the Administration with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

When a notification message contains a long URL, for example the cURL error of a failed app registration, the close button ends up outside the notification. The browser has no place to break the URL, so the message widens the growl's `mt-banner` beyond its 400px and pushes the close button out. The notification center has the same overflow: a message like that renders 428px wide inside a 358px item.

### 2. What does this change do, exactly?

- `sw-notifications.scss`: `.mt-banner__message` gets `overflow-wrap: anywhere`, so long URLs break inside the banner.
- `sw-notification-center-item.scss`: `.sw-notification-center-item__message` gets the same rule.

I checked the result in the browser. With a long URL in the message, the banner keeps its 400px width, and the close button sits 11px inside the banner instead of 77px outside it. The notification center wraps the message the same way.

### 3. Describe each step to reproduce the issue or behaviour.

1. In the Administration, trigger an error notification whose message contains a long URL, for example by installing an app whose registration fails with a cURL SSL error (as described in the issue).
2. Look at the growl notification, then open the notification center.
   - Before: the message stretches the notification and the close button sits outside it. The notification center item overflows too.
   - After: the URL wraps inside the notification and the close button stays inside the box.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #17613

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

Screenshots (Growl with a long URL, created with the notification store):
- Before (URL does not wrap, close button 401px outside the viewport): /home/thinkpad/claude-scratchpad/shopware/screenshots/17613-before-growl.jpg
- After (URL wraps, close button inside the banner): /home/thinkpad/claude-scratchpad/shopware/screenshots/17613-after-growl.jpg

<a id="pr-text-birthday"></a>

### no issue, sibling of #20595: a required birthday is not enforced by the Store API

Commit message:
```
fix(core): enforce a required birthday in the Store API
```

Release notes: Needed and already in the commit (`RELEASE_INFO-6.7.md`, API section), because headless frontends must now send the birthday when the setting is active.

PR text:
````markdown
### 1. Why is this change necessary?

A shop can make the birthday mandatory at registration ("Show birthday field" plus "Birthday field required"). The Store API doesn't enforce that setting: a registration or profile change without a birthday succeeds, and the customer is saved without one.

When the setting is active, `CustomerProfileValidationFactory` adds only range constraints (`GreaterThanOrEqual`, `LessThanOrEqual`) to `birthdayDay`, `birthdayMonth` and `birthdayYear`. Symfony's comparison constraints treat a missing value as valid, so a request without the three fields passes validation. `RegisterRoute` and `ChangeCustomerProfileRoute` then skip the birthday because the values aren't numeric.

The Storefront form marks the birthday selects as required, so this only affects Store API clients such as headless frontends.

### 2. What does this change do, exactly?

When `core.loginRegistration.showBirthdayField` and `core.loginRegistration.birthdayFieldRequired` are both active, `CustomerProfileValidationFactory` now adds `NotBlank` to `birthdayDay`, `birthdayMonth` and `birthdayYear` in front of the existing range constraints. A missing field is rejected with `VIOLATION::IS_BLANK_ERROR` on its pointer. Shops without the setting are not affected.

The factory builds the validation for both registration and profile changes, so `POST /store-api/account/register` and `POST /store-api/account/change-profile` behave the same.

`RELEASE_INFO-6.7.md` gets an entry, because headless frontends now have to send the birthday when the setting is active.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Settings > Login / registration, enable "Show birthday field" and "Birthday field required".
2. Send `POST /store-api/account/register` with valid registration data but without `birthdayDay`, `birthdayMonth` and `birthdayYear`.
   - Before: the registration succeeds and the customer has no birthday.
   - After: the request is rejected with `400` and `VIOLATION::IS_BLANK_ERROR` on `/birthdayDay`, `/birthdayMonth` and `/birthdayYear`.
3. Send the same request with a complete birthday: the registration succeeds as before.

### 4. Please link to the relevant issues (if any).

No issue of its own. Found while fixing #20595, which had the same pattern (range constraints without `NotBlank`) for review points.

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

<a id="pr-text-10406"></a>

### #10406 Premium Theme update notifications are empty

Commit message:
```
fix(administration): pass parameters to update deactivation messages
```

Release notes: Not needed; this is an Administration bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

When the update wizard cannot deactivate an extension, the warning leaves out the details the user needs. For a theme that is still assigned to a sales channel, the theme name and the list of assignments are empty, so the user cannot tell what to unassign before the update. `sw-settings-shopware-updates-wizard` passes the message parameters as the fourth argument of `$t` (`$t(key, null, null, params)`), and vue-i18n 10 ignores that argument. The dependency warning has the same problem: the extension name and the names of its dependants stay empty.

### 2. What does this change do, exactly?

- `sw-settings-shopware-updates-wizard` passes the parameters as the second argument of `$t` for `sw-extension.errors.messageDeactivationFailedThemeAssignment` (`themeName`, `assignments`) and `sw-extension.errors.messageDeactivationFailedDependencies` (`dependency`, `dependantNames`).
- The two `// @ts-expect-error` comments that suppressed the type error on the old calls are removed.

### 3. Describe each step to reproduce the issue or behaviour.

1. Install and activate a theme extension and assign it to a Storefront sales channel.
2. Go to Settings > System > Shopware Updates with an update available (see the issue for a local setup with `SW_RECOVERY_NEXT_VERSION`).
3. Click "Start update", let it deactivate incompatible extensions, tick the backup checkbox and start the update.
   - Before: the warning shows an empty theme name and no assignments.
   - After: the warning names the theme and its sales channel assignments.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #10406

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

Screenshots (Theme assignment warning rendered in the Administration with the old and the new $t() call (a real update with a failing deactivation is not reproducible locally)):
- Before (theme "" and empty assignments): /home/thinkpad/claude-scratchpad/shopware/screenshots/10406-before-warning.jpg
- After (theme name and assignments filled in): /home/thinkpad/claude-scratchpad/shopware/screenshots/10406-after-warning.jpg

<a id="pr-text-9148"></a>

### #9148 Multi edit: document names missing in i.e. French

Commit message:
```
fix(administration): show translated document type names
```

Release notes: Not needed; this is an Administration bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

In the order bulk edit, the document checkboxes under "Send: Documents" have no labels when the content language, for example French, has no document type translations. `sw-bulk-edit-order-documents` uses the raw `name` of each document type, which is empty without a translation in the content language. The delete and download siblings in the same bulk edit already fall back to `translated.name`. The same gap exists in the order detail: the send-document modal shows an empty type, and the document card falls back to an empty `documentType.name` when a document has no `typeName`.

### 2. What does this change do, exactly?

Each label now uses `translated.name` and falls back to `name`, like `sw-bulk-edit-order-documents-delete-documents` and `sw-bulk-edit-order-documents-download-documents`:

- `sw-bulk-edit-order-documents.html.twig`: checkbox label `document.translated?.name ?? document.name`.
- `sw-order-send-document-modal.html.twig`: type `document.documentType.translated?.name ?? document.documentType.name`.
- `sw-order-document-card/index.js`: the fallback without `typeName` uses `document.documentType?.translated?.name` before `document.documentType?.name`.

### 3. Describe each step to reproduce the issue or behaviour.

1. Add a content language without document type translations, for example French, and switch the Administration content language to it.
2. Go to Orders > Overview, select some orders and click the bulk edit action.
3. Look at the checkboxes under "Send: Documents".
   - Before: the checkboxes have no labels.
   - After: the checkboxes show the document type names in the fallback language.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #9148

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

Screenshots (order bulk edit, "Send: Documents", content language French without document type translations):
Retaken on 2026-09-30 on trunk cd11367d9af: "before" is trunk with the merged fix reverted (for #9148: plain trunk), "after" is trunk (for #9148: trunk plus the PR commit).
- Before (10 checkboxes without labels): /home/thinkpad/claude-scratchpad/shopware/screenshots/9148-before-bulk-edit.jpg
- After (labels fall back to the English names): /home/thinkpad/claude-scratchpad/shopware/screenshots/9148-after-bulk-edit.jpg
- Full pages: /home/thinkpad/claude-scratchpad/shopware/screenshots/9148-before-full.jpg, /home/thinkpad/claude-scratchpad/shopware/screenshots/9148-after-full.jpg

<a id="pr-text-9366"></a>

### #9366 Missing chevron on category select

Commit message:
```
fix(administration): show a dropdown chevron on the category tree field
```

Release notes: Not needed; this is an Administration UI fix. The new Twig block `sw_category_tree_field_input_expand_indicator` is additive and changes no existing contract.

PR text:
````markdown
### 1. Why is this change necessary?

The category field in the product's "Visibility & structure" card has no chevron, so it does not look like a dropdown, unlike the tags select below it. Only the input itself opens the tree, which leaves a small click target. `sw-category-tree-field` renders its own input and never got the expand indicator that `sw-select-base` shows.

### 2. What does this change do, exactly?

- `sw-category-tree-field.html.twig`: new block `sw_category_tree_field_input_expand_indicator` with an `mt-icon` (`regular-chevron-up-xs`, size `var(--scale-size-10)`), the same indicator `sw-select-base` uses. It gets `is--collapsed` while the tree is closed.
- `sw-category-tree-field/index.js`: new method `toggleDropdown`, called on a click on the chevron. It opens the tree and focuses the search input, or closes the tree when it is open. It does nothing when the field is disabled.
- `sw-category-tree-field.scss`: places the chevron at the right edge, rotates it 180° while collapsed so it points down, and uses the default cursor when the field is disabled.

I checked it in the browser: the category field shows a 10px chevron 17px from the edge, like the tags select below it. It points down while the tree is closed, a click opens the tree and focuses the input, and a second click closes it.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a product in Catalogues > Products.
2. Look at the category field in the "Visibility & structure" card.
   - Before: the field has no chevron, and only the input opens the tree.
   - After: the field shows a down-pointing chevron like the tags select, and clicking it opens or closes the tree.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #9366

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

Screenshots (Product "Canonical Test", "Visibility & structure" card, trunk vs fix build):
- Before (no chevron in the category field, the Tags field below has one): /home/thinkpad/claude-scratchpad/shopware/screenshots/9366-before-category-field.jpg
- After (chevron like the Tags field): /home/thinkpad/claude-scratchpad/shopware/screenshots/9366-after-category-field.jpg

<a id="pr-text-20918"></a>

### #20918 Cookie bar reappears on every page after tapping "Only technically required" on touch devices

Commit message:
```
fix(storefront): store the cookie consent when denying on touch devices
```

Release notes: none needed, a Storefront bug fix with no change to a public API or extension contract.

PR text:
````markdown
### 1. Why is this change necessary?

On touch devices, tapping "Only technically required" hides the cookie bar, but the bar comes back on every following page. Only `cookie-preference` gets written, `cookie-config-hash` is missing.

`CookiePermissionPlugin::_registerEvents()` listened to `touchstart` instead of `click` when `DeviceDetection.isTouchDevice()` was true. `_handleDenyButton()` calls `event.preventDefault()`, and on a `touchstart` that suppresses the click the browser would synthesize afterwards. `CookieConfiguration` handles the same button (`.js-cookie-permission-button`) only through its delegated `click` listener, so `_handlePermission()` never ran and no `cookie-config-hash` was stored. On the next page load `CookieConfiguration` finds a preference without a hash for the current language and shows the bar again. With a mouse, both plugins get the click and everything works. So on touch devices, refusing optional cookies was harder than accepting them.

### 2. What does this change do, exactly?

`CookiePermissionPlugin` now always registers `_handleDenyButton` for `click`, and the unused `DeviceDetection` import is gone. `preventDefault()` on the click doesn't stop propagation, so the delegated listener of `CookieConfiguration` still runs and writes `cookie-config-hash` on the first tap.

I checked the other `touchstart` handlers in the Storefront. The backdrop and navbar handlers don't call `preventDefault()`, so their click still fires. The offcanvas cart trigger does prevent `touchstart`, but no other listener needs its click.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open the Storefront in a fresh session on a touch device, or with touch emulation in the browser dev tools, with the default cookie bar enabled.
2. Tap "Only technically required". The bar disappears.
3. Reload or open another page.
4. Before: the bar shows again. The cookies contain `cookie-preference=1` but no `cookie-config-hash`. A second tap fixes it.
   After: the bar stays hidden, and both `cookie-preference` and `cookie-config-hash` are set after the first tap.

### 4. Please link to the relevant issues (if any).

- closes #20918

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

<a id="pr-text-20854"></a>

### #20854 Migration1752750234AddIndexToOrderTransactionCreateAndUpdate can fail with "Cannot drop index" (MySQL bug 118151)

Commit message:
```
fix(core): guard order index migrations against MySQL bug 118151
```

Release notes: none needed, the migrations only get the existing retry and no public API, configuration or extension contract changes.

PR text:
````markdown
### 1. Why is this change necessary?

`Migration1752750234AddIndexToOrderTransactionCreateAndUpdate` can fail during an update with `Cannot drop index '<unknown key name>'` (MySQL bug #118151). The reporter hit it while upgrading from MySQL 8.0 to 9.7 and from 6.5 to 6.7.

The migration runs a raw `CREATE INDEX` through `$connection->executeStatement()`. With `restrict_fk_on_non_standard_key` on, MySQL can reject that statement with error 1553 because of the bug. `MigrationStep::executeDdlStatement()` exists for exactly this case, but these migrations don't use it. `Migration1752750171AddIndexToOrderAddressCreateAndUpdate` and `Migration1752750086AddIndexToOrderLineItemCreateAndUpdate` have the same raw `CREATE INDEX`.

### 2. What does this change do, exactly?

The order transaction, order address and order line item index migrations now create their index through `executeDdlStatement()`. `NonStandardFkGuard` runs the statement. If MySQL answers error 1553 while `restrict_fk_on_non_standard_key` is `ON`, it turns the variable off for the session, retries once and turns it back on. Without the variable (MariaDB, MySQL < 8.4) the error is rethrown as before.

The other raw index DDL in `V6_7` targets `media`, `seo_url` and `refresh_token`. Nobody reported the bug for those tables, so I left them out.

### 3. Describe each step to reproduce the issue or behaviour.

1. Use MySQL 8.4 or newer with `restrict_fk_on_non_standard_key = ON` and an `order_transaction` schema that triggers bug #118151, for example a shop upgraded from 6.5 and from MySQL 8.0.
2. Run the 6.7 migrations (`bin/console system:update:finish` or `bin/console database:migrate --all`).
3. Before: `Migration1752750234AddIndexToOrderTransactionCreateAndUpdate` stops with `Cannot drop index '<unknown key name>'`.
   After: the index is created and the migration run continues. The same applies to the order address and order line item migrations.

### 4. Please link to the relevant issues (if any).

- closes #20854

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

<a id="pr-text-18838"></a>

### #18838 App sidebar not resizable when an app iframe is open in main content

Commit message:
```
fix(administration): keep app iframes from blocking sidebar resizing
```

Release notes: none needed, an Administration bug fix with no change to a public API or extension contract.

PR text:
````markdown
### 1. Why is this change necessary?

An app sidebar can't be resized while another app renders an iframe in the main content, for example the Copilot sidebar next to the Image Editor. The drag stops as soon as the pointer moves over the iframe.

`sw-sidebar-renderer` tracks the drag with `mousemove` and `mouseup` listeners on `document`. Its `.is-resizing` styles set `pointer-events: none` only inside the sidebar, which covers the sidebar's own iframe. An iframe in the main content still receives the pointer and keeps the mouse events in its own document, so `handleSidebarResize` and `stopSidebarResize` don't get them.

### 2. What does this change do, exactly?

`startSidebarResize` adds the class `sw-sidebar-renderer-is-resizing` to `document.body`, and `stopSidebarResize` removes it. While the class is set, every `iframe` on the page has `pointer-events: none`, so the document gets the whole drag. On mouse release the iframes react to the pointer again.

I also looked at the dragdrop directive, the colorpicker and the data grid column resize, which listen on `document`/`window` `mousemove` as well. They drag inside their own component on pages without app iframes, so they don't have this problem.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open an app that renders an iframe in the Administration main content, for example the Image Editor.
2. Open a resizable app sidebar next to it, for example Copilot.
3. Drag the sidebar's resize handle across the iframe.
4. Before: the drag stops once the pointer is over the iframe, and the sidebar width is stuck.
   After: the sidebar follows the pointer across the iframe, and the iframe reacts to the pointer again after the mouse is released.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #18838

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

Screenshots (GIFs; resizable test sidebar and an app iframe laid over the main content, handle dragged to the left across the iframe):
- Before (the sidebar stays at 512px, the iframe swallows the drag): /home/thinkpad/claude-scratchpad/shopware/screenshots/18838-before-sidebar-resize-over-iframe.gif
- After (the sidebar follows the drag from 400px to 620px, `pointer-events` of the iframe is `auto` again afterwards): /home/thinkpad/claude-scratchpad/shopware/screenshots/18838-after-sidebar-resize-over-iframe.gif

<a id="pr-text-20364"></a>

### #20364 Filter products header cutoff

Commit message:
```
fix(storefront): let the filter offcanvas header grow with larger text
```

Release notes: none needed, a Storefront style fix with no change to a public API, theme variable or extension contract.

PR text:
````markdown
### 1. Why is this change necessary?

With text-only zoom at 200% on a 320px viewport, the "Filter products" offcanvas cuts off its header title. The title wraps to two lines, but `.filter-panel-offcanvas-header` has a fixed `height: 80px` with `padding: 25px`, so the header can't grow and the title is clipped at the top and bottom.

### 2. What does this change do, exactly?

In `_filter-panel.scss`, `.filter-panel-offcanvas-header` now uses `min-height: 80px` instead of `height: 80px`, drops the vertical padding (`padding: 0 25px`) and sets `flex-shrink: 0`. The header keeps 80px at the default text size, and the title and close button stay where they were: the 47px close button used to overflow into the vertical padding, so keeping that padding with a minimum height would have grown the header to 97px, while `align-items: center` keeps both items on the same 40px line without it. With larger text the header grows with the title and doesn't shrink.

I found no other header or title selector with a fixed px height in the Storefront SCSS.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, go to Preferences > General > Zoom, keep the default zoom at 100% and check "Zoom text only".
2. Open the Storefront homepage of a shop with at least one product, with a 320px wide viewport.
3. Zoom the text to 200% and click "Filter products".
4. Before: the two-line header title is cut off at the top and bottom.
   After: the header grows so the whole title fits. At the default text size it looks the same as before.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #20364

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

Screenshots (Listing filter offcanvas narrowed to 320px, title at 56px (text zoom)):
- Before (two-line title cut 44px at top and bottom of the 80px header): /home/thinkpad/claude-scratchpad/shopware/screenshots/20364-before-filter-header.jpg
- After (header grows to 168px): /home/thinkpad/claude-scratchpad/shopware/screenshots/20364-after-filter-header.jpg

<a id="pr-text-20365"></a>

### #20365 Long category names cutoff in offcanvas menu and breadcrumbs

Commit message:
```
fix(storefront): wrap long category names in navigation and breadcrumb
```

Release notes: none needed, a Storefront style fix with no change to a public API, theme variable or extension contract.

PR text:
````markdown
### 1. Why is this change necessary?

A long category name without spaces, such as `Supercalifragilisticexpialigetisch`, is cut off in the offcanvas menu and in the breadcrumb on narrow viewports with larger text. The name runs past the edge of the offcanvas and of the page.

Breadcrumb items (`.breadcrumb-item`) and the children of `.navigation-offcanvas-link` are flex items. Flex items default to `min-width: auto`, so they can't shrink below their longest word, and a single long word never breaks.

### 2. What does this change do, exactly?

- `_breadcrumb.scss`: `.breadcrumb-item` gets `min-width: 0` and `overflow-wrap: anywhere`.
- `_navigation-offcanvas.scss`: `.navigation-offcanvas-link` gets `overflow-wrap: anywhere`, and its direct children get `min-width: 0`. `.navigation-offcanvas-link-icon` gets `flex-shrink: 0` so the icon keeps its width.

Long names now break inside the available width. At the default text size the menu and breadcrumb look unchanged.

I also checked the main navigation. Its link overflows at a forced 288px, but it only shows from `lg` up, so it doesn't apply here. The flyout, the sidebar category navigation and the footer weren't rendered with my local shop data, so I couldn't check them.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, go to Preferences > General > Zoom, keep the default zoom at 100% and check "Zoom text only".
2. Create a category named `Supercalifragilisticexpialigetisch`.
3. Open the Storefront homepage with a 320px wide viewport and zoom the text to 200%.
4. Open the offcanvas menu, then open the category page.
5. Before: the category name runs past the edge of the offcanvas menu and of the breadcrumb.
   After: the name wraps inside the offcanvas and inside the breadcrumb, and the menu icon keeps its size.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #20365

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

Screenshots (Test category "Supercalifragilisticexpialigetisch", link text at 32px):
- Before breadcrumb (overflows the 288px box): /home/thinkpad/claude-scratchpad/shopware/screenshots/20365-before-breadcrumb.jpg
- After breadcrumb (wraps inside): /home/thinkpad/claude-scratchpad/shopware/screenshots/20365-after-breadcrumb.jpg
- Before offcanvas menu (cut off at 400px): /home/thinkpad/claude-scratchpad/shopware/screenshots/20365-before-offcanvas.jpg
- After offcanvas menu (wraps): /home/thinkpad/claude-scratchpad/shopware/screenshots/20365-after-offcanvas.jpg

<a id="pr-text-20711"></a>

### #20711 A throwing worker event listener kills messenger:consume with exit 1

Commit message:
```
fix(core): keep message queue statistics failures from stopping workers
```

Release notes: none needed; `MessageQueueStatsSubscriber` is `@internal`, the new `LoggerInterface` constructor argument is wired in the DI config, and the fix changes no external contract.

PR text:
````markdown
### 1. Why is this change necessary?

Symfony's `Worker` catches exceptions only around the bus dispatch. Listeners on `WorkerMessageHandledEvent` and `WorkerMessageFailedEvent` run in `ack()`, outside that `try/catch`, so an exception there ends `messenger:consume` with exit code 1.

`MessageQueueStatsSubscriber` does two unguarded things in that window:

- `handle()` calls `IncrementGatewayRegistry::get(IncrementGatewayRegistry::MESSAGE_QUEUE_POOL)`, which throws `IncrementException::gatewayNotFound()` when no gateway is registered for the `message_queue` pool. Without the `v6.8.0.0` flag this happens on every handled message.
- `StatsService::registerMessage()` writes to the database through `MySQLStatsRepository`. A lost connection, a failover or a `max_connections` spike after a successful handler kills the worker.

The message itself was processed fine, but the worker stops and orchestrators report a crash. `onMessageSent()` goes through the same `handle()` on `SendMessageToTransportsEvent`, so a missing gateway also breaks the request that dispatches the message.

### 2. What does this change do, exactly?

- `MessageQueueStatsSubscriber::onMessageHandled()` wraps `statsService->registerMessage()` in a `try/catch (\Throwable)` and logs a warning.
- `MessageQueueStatsSubscriber::handle()` wraps the gateway lookup and the `increment()`/`decrement()` call the same way. This covers `onMessageHandled()`, `onMessageFailed()` and `onMessageSent()`.
- The subscriber gets `logger` injected in `message-queue.php`.

This is the same pattern `TelemetryFlushListener` already uses. The handled message still counts when the statistics write fails.

I checked the siblings. `MessageQueueTelemetrySubscriber` and `ScheduledTaskMetricsSubscriber` emit through `Meter`, which already catches transport failures, so they stay unchanged. `RetryWebhookMessageFailedSubscriber`, `BufferedFlowExecutionTriggersListener` and `CompileThemeFailedSubscriber` also run in the unguarded worker window. They run business logic, though, and swallowing their errors would hide real failures, so I left them out of this PR.

### 3. Describe each step to reproduce the issue or behaviour.

Missing increment pool:

1. Keep the `v6.8.0.0` feature flag inactive.
2. Configure the environment so no incrementer is registered for the `message_queue` pool.
3. Run `bin/console messenger:consume async -vv` and dispatch any message.
   - Before: the message is handled, then `IncrementException::gatewayNotFound()` escapes and `echo $?` prints `1`.
   - After: the worker logs "Failed to update the message queue increment statistics" as a warning and keeps consuming.

Database failure:

1. Run `bin/console messenger:consume async -vv` with message stats enabled.
2. Dispatch a message and cut the database connection after the handler returns, before `ack()` runs (restart MySQL or exhaust `max_connections`).
   - Before: the worker exits with code 1 and a stack trace into `MySQLStatsRepository`.
   - After: the worker logs "Failed to register the message queue statistics" as a warning and keeps running.

### 4. Please link to the relevant issues (if any).

- closes #20711

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

<a id="pr-text-20408"></a>

### #20408 Review stars overlap with product names in listing boxes

Commit message:
```
fix(storefront): keep review stars from overlapping product names
```

Release notes: none needed; a local SCSS fix in the product box that changes no theme or extension contract.

PR text:
````markdown
### 1. Why is this change necessary?

The rating block in product boxes (`.product-rating`) has a fixed `height: 25px`. With text zoom, as in the 200% text-only zoom from the issue, the stars grow but the block does not. They overflow into the product name below and cover it.

### 2. What does this change do, exactly?

In `_product-box.scss`, `.product-rating` uses `min-height: 25px` instead of `height: 25px`. At the default size the block stays 25px high. With larger text it grows and pushes the product name down.

In the browser, with an approved 5-star review and the root font size set to 300% (Chrome has no text-only zoom; this scales the rem-based stars to 50px like Firefox's text zoom), the stars wrap into three rows and are drawn over the product name, because the rating block keeps its fixed 25px height. Now the block grows with the stars (216px here) and they end 10px above the name.

`.product-price-unit` has a similar fixed `height: 36px` with `overflow: hidden` and would clip at 200% text zoom. It is a different layout and belongs with #20389 and #20372, so it is not changed here.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, enable Settings > General > Zoom > "Zoom text only" with the default zoom at 100%.
2. Create a product, write a 5-star review for it and approve the review in the Administration.
3. Open a product listing with the viewport at 320px and zoom the text to 200%.
   - Before: the review stars overlap the product name.
   - After: the product name starts below the stars.

<!-- screenshot -->
Before:

<!-- screenshot -->
After:

### 4. Please link to the relevant issues (if any).

- closes #20408

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

Screenshots (root font size 300%, listing on Home):
Retaken on 2026-09-30 on trunk cd11367d9af: "before" is trunk with the merged fix reverted (for #9148: plain trunk), "after" is trunk (for #9148: trunk plus the PR commit).
- Before: /home/thinkpad/claude-scratchpad/shopware/screenshots/20408-before-rating-300.jpg (full page: 20408-before-full-300.jpg)
- After: /home/thinkpad/claude-scratchpad/shopware/screenshots/20408-after-rating-300.jpg (full page: 20408-after-full-300.jpg)

<a id="pr-text-17961"></a>

### #17961 Administration: keyboard navigation highlight is overridden by mouse pointer position and can move outside the visible container

Commit message:
```
fix(administration): keep keyboard selection in select result lists
```

Release notes: none needed; a local Admin bug fix in `sw-select-result` and `sw-select-result-list` that changes no public API.

PR text:
````markdown
### 1. Why is this change necessary?

Keyboard navigation in `sw-select-result-list` has two problems.

- `sw-select-result` takes the highlight on `mouseenter`. When the arrow keys scroll the list under a pointer that is not moving, the browser fires `mouseenter` on the item that is now under the pointer. That item takes the highlight away from the keyboard, so it jumps back after a moment (visible in Safari in the issue).
- `updateScrollPosition()` searches the whole document for `.sw-select-result-list__content` instead of using its own list. It scrolls by one item height per key press and skips the check when `offsetTop` is 0, so the highlight can move outside the visible part of the list.

### 2. What does this change do, exactly?

- `sw-select-result.html.twig` binds `onMouseEnter` to `mousemove` instead of `mouseenter`, so only a real pointer movement changes the highlight. `onMouseEnter()` returns early when the item is already active, so moving the pointer inside one item does not set the index again.
- `sw-select-result-list` `updateScrollPosition()` takes the active item from its own `popoverContent` ref and calls `scrollIntoView({ block: 'nearest' })` on it.

`sw-select-option` also switches the highlight on `mouseenter`, but it has been deprecated since 6.1 and no template uses it, so it is unchanged.

In Chrome, 25 ArrowDown presses in the rule condition type select (103 items, 248px list) keep the highlight inside the visible list every time.

### 3. Describe each step to reproduce the issue or behaviour.

1. Go to Settings > Rule Builder and create a rule.
2. Open the condition type select.
3. Press ArrowDown repeatedly.
   - Before: the highlight moves below the visible part of the list.
   - After: the list scrolls with the highlight, which stays visible.
4. Leave the mouse pointer resting over the list and press ArrowDown until the list scrolls.
   - Before: the item under the pointer takes the highlight back.
   - After: the highlight stays on the item chosen with the keyboard until the mouse moves.

<!-- screenshot -->
Before:

<!-- screenshot -->
After:

### 4. Please link to the relevant issues (if any).

- closes #17961

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

Screenshots (Rule condition type select, 25x ArrowDown):
- Before (highlighted "Customer surname" cut off below the list): /home/thinkpad/claude-scratchpad/shopware/screenshots/17961-before-keyboard-highlight.jpg
- After (highlighted item fully inside the list): /home/thinkpad/claude-scratchpad/shopware/screenshots/17961-after-keyboard-highlight.jpg

<a id="pr-text-18852"></a>

### #18852 Deleting media from the Media Library leaves orphaned product.cover reference

Commit message:
```
fix(core): set null references of entities removed by cascade deletes
```

Release notes: needed and already in the commit: `RELEASE_INFO-6.7.md` entry "Set null on delete also applies to cascaded deletes", because extensions now get `SetNullOnDelete` handling and write results for entities removed through `CascadeDelete`.

PR text:
````markdown
### 1. Why is this change necessary?

Deleting a media from the Media Library leaves `product.coverId` pointing to a `product_media` row that no longer exists.

`media.productMedia` has `CascadeDelete`, so deleting the media also deletes its `product_media` rows. `product_media.coverProducts` has `SetNullOnDelete(false)`: the `product.product_media_id` column has no foreign key constraint, and the DAL has to clear it. `EntityWriter` resolves `SetNullOnDelete` only for the entity that is deleted directly (the media), not for the entities removed by its cascade (the product media). The cover is cleared only when the product media is deleted directly, for example when the cover is removed in the product.

The product keeps a cover id to a missing record and the Administration shows no cover.

### 2. What does this change do, exactly?

`EntityWriter::addDeleteCascadeCommands()` now calls `addSetNullOnDeletesCommands()` for every definition affected by the cascade, with the keys removed by the cascade. The set-null commands for associations without a database constraint are queued and their write results are dispatched, the same as for a direct delete. Deleting a media now sets `product.coverId` to `null` for products that used it as the cover.

The `@param` of `addSetNullOnDeletesCommands()` now also allows the plain id list returned by the cascade lookup.

In core, `coverProducts` is the only `SetNullOnDelete` without a database constraint. The database already clears the others.

`RELEASE_INFO-6.7.md` gets an entry because extensions now receive set-null write results for entities removed by a cascade.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create a product, assign a cover image and save.
2. Open the Media Library and delete the media used as the cover.
3. Check the product in the database: `SELECT HEX(product_media_id) FROM product WHERE id = UNHEX('<product id>');`
   - Before: `product_media_id` still holds the id of the deleted product media.
   - After: `product_media_id` is `NULL`.

### 4. Please link to the relevant issues (if any).

- closes #18852

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

<a id="pr-text-20369"></a>

### #20369 Available addresses search input cutoff

Commit message:
```
fix(storefront): let the address search wrap below the add button
```

Release notes: none needed; a local layout fix (one class in `addresses-base.html.twig` plus SCSS) that keeps all Twig blocks and changes no theme or extension contract.

PR text:
````markdown
### 1. Why is this change necessary?

On the account address page, the address search input and the "Add address" button share one flex row in `addresses-base.html.twig`. The row cannot wrap and the button does not shrink, so on narrow screens with enlarged text the input gets squeezed. At 288px with 200% text it shrank to 38px, too small to show its placeholder, and it is unclear what the field is for.

### 2. What does this change do, exactly?

- The row in `addresses-base.html.twig` gets `flex-wrap`.
- `.address-manager-list-search` in `_address.scss` gets `flex: 1 1 8rem`. The input fills the space next to the button and moves to its own line only when less than 8rem is left.

In the browser, with the template's markup and the compiled theme at 288px and 200% text, the input now takes its own 288px line. At the default text size and on wide screens the layout is unchanged.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, enable Settings > General > Zoom > "Zoom text only" with the default zoom at 100%.
2. Log in as a customer and open Account > Addresses.
3. Set the viewport to 320px and zoom the text to 200%.
   - Before: the search input is squeezed next to the "Add address" button and its placeholder is cut off.
   - After: the search input moves to its own full-width line above the addresses.

<!-- screenshot -->
Before:

<!-- screenshot -->
After:

### 4. Please link to the relevant issues (if any).

- closes #20369

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

Screenshots (Account address page of a test customer (logged in with "Log in as customer"), address block narrowed to 288px, text at 200%):
- Before (search input shrinks to 38px, button overflows): /home/thinkpad/claude-scratchpad/shopware/screenshots/20369-before-address-search.jpg
- After (search input on its own 288px line): /home/thinkpad/claude-scratchpad/shopware/screenshots/20369-after-address-search.jpg

<a id="pr-text-20870"></a>

### #20870 Company logo upload in document settings never completes

Commit message:
```
fix(administration): upload the document company logo
```

Release notes: Not needed. This is an Administration bug fix and no external contract changes.

PR text:
````markdown
<!--
Thank you for contributing to Shopware! Please fill out this description template to help us process your pull request.

Please make sure to fulfil our contribution guidelines (https://developer.shopware.com/docs/resources/guidelines/code/contribution?category=shopware-platform-dev-en/contribution).

Do your changes need to be documented?
Please create a second pull request at https://github.com/shopware/docs
-->

### 1. Why is this change necessary?

Uploading a company logo in the document settings never finishes. The notification stays at "Uploading file (0%)", an empty media entity shows up in the media library, and saving the document configuration stores `logoId = null`.

The logo field renders `sw-media-compact-upload-v2` without an `upload-tag`, and the page has no `sw-upload-listener` with `auto-upload`. The upload gets queued, but nothing ever sends it. Picking an existing file from the media library still worked.

### 2. What does this change do, exactly?

In `sw-settings-document-detail`:

- `sw-media-compact-upload-v2` gets `documentConfig.id` as `upload-tag` and `default-folder="document"`, so new logos are stored in the Document media folder.
- A `sw-upload-listener` with the same tag and `auto-upload` uploads the file as soon as it is picked.
- The new `onCompanyLogoUploadFinish()` sets `documentConfig.logoId` to the `targetId` of the uploaded media.

I checked the other places that use `sw-media-upload-v2` / `sw-media-compact-upload-v2`. The only other one without an upload tag and listener is inside `sw-media-list-selection-v2`, and the CMS components using it render the listener themselves.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open Settings > Shop > Documents and pick a document type, e.g. "invoice".
2. In the "Company settings" card, click "Upload file" next to "Company logo" and choose a PNG or SVG.
3. Click "Save".

Before: the notification stays at "Uploading file (0%)", no logo is assigned, and the media library has an empty media entity.

After: the file uploads right away and the preview shows it. Saving stores the `logoId`, and the media file sits in the Document folder.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #20870

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

Screenshots (Settings > Documents > invoice, "Company logo" in the company settings card, PNG picked with "Upload file"):
- Before (local thumbnail only, notification stuck at "Uploading file (0%)", `logoId` stays null, empty media entity): /home/thinkpad/claude-scratchpad/shopware/screenshots/20870-before-logo-upload.jpg
- After (uploaded right away, preview served from the Document folder, remove button shown): /home/thinkpad/claude-scratchpad/shopware/screenshots/20870-after-logo-upload.jpg
- Full pages: /home/thinkpad/claude-scratchpad/shopware/screenshots/20870-before-full.jpg, /home/thinkpad/claude-scratchpad/shopware/screenshots/20870-after-full.jpg

<a id="pr-text-20920"></a>

### #20920 Documents card: after deleting the last document, the empty state shows a non-functional icon-only button

Commit message:
```
fix(administration): offer document creation after deleting the last document

- closes #20920
```

Release notes: Not needed. This is an Administration bug fix and no external contract changes.

PR text:
````markdown
<!--
Thank you for contributing to Shopware! Please fill out this description template to help us process your pull request.

Please make sure to fulfil our contribution guidelines (https://developer.shopware.com/docs/resources/guidelines/code/contribution?category=shopware-platform-dev-en/contribution).

Do your changes need to be documented?
Please create a second pull request at https://github.com/shopware/docs
-->

### 1. Why is this change necessary?

After the last document of an order is deleted, the documents card still behaves as if the order had documents. The issue reports a label-less button in the empty state that does nothing. #20266 already removed that button, but on trunk the card still shows the search bar, the title "No documents found" and no "Create new document" button. Only a page reload brings the regular empty state back.

`showCreateDocumentButton`, `showCardFilter` and `emptyStateTitle` read `order.documents`. The order is not reloaded when a document is deleted in the card, so it still lists the deleted document.

### 2. What does this change do, exactly?

`sw-order-document-card` gets a computed `orderHasDocuments`:

- Until the card has loaded its document list, it falls back to `order.documents`.
- Once `getList()` has loaded the list (new `documentsLoaded` flag), the order counts as having documents when the list is not empty or a search term is set.

`showCardFilter`, `showCreateDocumentButton` and `emptyStateTitle` use `orderHasDocuments` instead of `order.documents`. A search without hits still keeps the search bar and shows "No documents found".

Without the `DOCUMENT_GENERATION_REWORK` flag, the context menu deletes through the `sw-entity-listing` delete, which reloads only the listing. The card now listens to the listing's `delete-item-finish` event and reloads its document list with `getList()`, so the empty state appears right after the deletion.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open an order with exactly one document, e.g. a delivery note.
2. Go to the "Documents" tab.
3. Delete the document from its context menu.

Before: right after the deletion the card shows an empty table with only its column headers. After switching to another tab and back, the empty state says "No documents found", the search bar stays, and the empty state has no create button.

After: right after the deletion the card shows the empty-order title and the "Create new document" button without a search bar, the same as for an order that never had a document.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #20920

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

Screenshots (Test order with one invoice, invoice deleted in the Documents card, then Details tab and back (issue steps)):
- Before ("No documents found", search bar, no create button in the empty state): /home/thinkpad/claude-scratchpad/shopware/screenshots/20920-before-empty-state.jpg
- After ("No documents created yet" with "Create new document"): /home/thinkpad/claude-scratchpad/shopware/screenshots/20920-after-empty-state.jpg
- After, right after the deletion without a tab switch (follow-up commit): /home/thinkpad/claude-scratchpad/shopware/screenshots/20920-after-immediately-after-delete.jpg

<a id="pr-text-20342"></a>

### #20342 `Uuid::isValid()` accepts a trailing newline

Commit message:
```
fix(core): reject uuids with a trailing newline
```

Release notes: Not needed. `Uuid::isValid()` keeps its signature and now rejects only input it was always meant to reject.

PR text:
````markdown
<!--
Thank you for contributing to Shopware! Please fill out this description template to help us process your pull request.

Please make sure to fulfil our contribution guidelines (https://developer.shopware.com/docs/resources/guidelines/code/contribution?category=shopware-platform-dev-en/contribution).

Do your changes need to be documented?
Please create a second pull request at https://github.com/shopware/docs
-->

### 1. Why is this change necessary?

`Uuid::isValid()` accepts 32 hex characters followed by one `\n`. It matches `Uuid::VALID_PATTERN` without the PCRE `D` modifier, so `$` also matches before a final newline.

Most callers pass the value on to `Uuid::fromHexToBytes()`, which rejects it. Some keep it as it is, though. `UuidValidator`, for example, lets such an id into `rule_condition.value`, and `LineItemWithQuantityRule` compares it with `!==`. The rule then never matches, while the Administration shows it as configured.

### 2. What does this change do, exactly?

`Uuid::isValid()` adds the `D` modifier to its `preg_match()` call, so `$` only matches at the very end of the string.

`Uuid::VALID_PATTERN` stays unchanged, because routes also use it as a route requirement.

### 3. Describe each step to reproduce the issue or behaviour.

```php
Uuid::isValid('0123456789abcdef0123456789abcdef');   // true before and after
Uuid::isValid("0123456789abcdef0123456789abcdef\n"); // true before, false after
```

### 4. Please link to the relevant issues (if any).

- closes #20342

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

<a id="pr-text-8029"></a>

### #8029 Readded default Margin in CMS Blocks

Commit message:
```
fix(administration): keep cleared cms block margins empty
```

Release notes: Not needed. This is an Administration bug fix and no external contract changes.

PR text:
````markdown
<!--
Thank you for contributing to Shopware! Please fill out this description template to help us process your pull request.

Please make sure to fulfil our contribution guidelines (https://developer.shopware.com/docs/resources/guidelines/code/contribution?category=shopware-platform-dev-en/contribution).

Do your changes need to be documented?
Please create a second pull request at https://github.com/shopware/docs
-->

### 1. Why is this change necessary?

When you clear the margins of a block in an existing layout and save, the editor fills them with the default 20px again after the reload.

Since 1353986200b, `initBlockConfig()` in `cmsDataResolverService` fills every empty block setting with the block's default config each time a layout loads. That also refills margins the user cleared on purpose.

### 2. What does this change do, exactly?

`initBlockConfig()` now skips `marginTop`, `marginBottom`, `marginLeft` and `marginRight` (the new `CLEARABLE_BLOCK_CONFIG_KEYS`). New blocks still get their default margins when they are created. The other defaults, such as the text-on-image background, are still filled when a layout loads.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a layout in Shopping Experiences and select a block.
2. Open "Block settings" and the "Layout" section.
3. Clear the top and bottom margins.
4. Save the layout.

Before: after the reload the cleared fields show the default margin again.

After: the fields stay empty in the editor and after saving, and `cms_block` stores `NULL` for them.

Before:
<!-- screenshot -->

After:
<!-- screenshot -->

### 4. Please link to the relevant issues (if any).

- closes #8029

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

<a id="pr-text-20974"></a>

### #20974 DAL: exact total is wrong when the criteria limit is 1

Commit message:
```
fix(core): keep grouping for limit 1 when a total count is requested

- closes #20974
```

Release notes: not needed, a bug fix without API or behaviour contract change for extensions.

PR text:
````markdown
### 1. Why is this change necessary?

With `Criteria::setLimit(1)` and a total count mode, the total is wrong whenever the query needs grouping. A filter over a to-many association counts joined rows instead of entities (a product with two matching tags counts twice), and a search term collapses the total to `1`. With a limit of 2 or more the total is correct.

`CriteriaQueryBuilder::build()` removes the `HAS_TO_MANY_JOIN` state for a limit of 1, so the ID query is built without `GROUP BY`. That shortcut is fine for fetching a single row, but `EntitySearcher` reuses the same query for the total: `TOTAL_COUNT_MODE_EXACT` wraps it in `COUNT(*)`, and `TOTAL_COUNT_MODE_NEXT_PAGES` counts the rows of the next pages. Both then count joined rows.

### 2. What does this change do, exactly?

`CriteriaQueryBuilder::build()` only drops the grouping for a limit of 1 when no total is requested (`TOTAL_COUNT_MODE_NONE`, the default). With `TOTAL_COUNT_MODE_EXACT` or `TOTAL_COUNT_MODE_NEXT_PAGES`, the query keeps its `GROUP BY`, so the total counts entities.

Single-row lookups without a total, the common case, keep the shortcut.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create two products with two tags each whose names contain `limit-one`.
2. Search product IDs with a `ContainsFilter` on `product.tags.name` = `limit-one`, `setLimit(1)` and `TOTAL_COUNT_MODE_EXACT`.
   - Before: `getTotal()` returns `4`.
   - After: `getTotal()` returns `2`, the same as with a limit of 2.
3. Search the same products with `setTerm('limit one total')`, `setLimit(1)` and `TOTAL_COUNT_MODE_EXACT`.
   - Before: `getTotal()` returns `1`.
   - After: `getTotal()` returns `2`.
4. The to-many filter with `TOTAL_COUNT_MODE_NEXT_PAGES` and `setLimit(1)` returned `4` as well and now returns `2`.

### 4. Please link to the relevant issues (if any).

- closes #20974

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

Screenshots: none (DAL change, no UI)

<a id="pr-text-14902"></a>

### #14902 UninstallContext->keepUserData comment incorrectly explains actual logic

Commit message:
```
docs(core): correct the keepUserData description of the uninstall context

- closes #14902
```

Release notes: not needed, docblock only.

PR text:
````markdown
### 1. Why is this change necessary?

The docblock of `UninstallContext::keepUserData()` says "If true is returned, migrations of the plugin will also be removed". `PluginLifecycleService::uninstallPlugin()` does the opposite: it cleans up only when `keepUserData()` returns `false`. The docblock also never says what the flag means for the plugin itself.

### 2. What does this change do, exactly?

The docblock now describes the flag as the user's choice to keep the plugin's data. When it is `false`, the plugin should remove its data (e.g. its tables) in `uninstall()`. It also lists what Shopware removes in that case, matching `PluginLifecycleService::uninstallPlugin()` and the Storefront `PluginLifecycleSubscriber`:

- the plugin's entries in the `migration` table
- its system config
- its custom entities and custom fields
- its theme

No code changes.

### 3. Describe each step to reproduce the issue or behaviour.

1. Read `UninstallContext::keepUserData()` and `PluginLifecycleService::uninstallPlugin()`.
2. Uninstall a plugin with "Keep user data" disabled (or `plugin:uninstall` without `--keep-user-data`): its `migration` entries, system config, custom entities, custom fields and theme are removed.
3. Uninstall it with "Keep user data" enabled: all of them are kept.

### 4. Please link to the relevant issues (if any).

- closes #14902

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

Screenshots: none (docblock only)

<a id="pr-text-19100"></a>

### #19100 Administration: Theme compilation completed notification is sent twice

Commit message:
```
fix(storefront): notify the async theme compilation completion only once

- closes #19100
```

Release notes: RELEASE_INFO-6.7.md Storefront entry and UPGRADE-6.8.md entry for the new optional `ThemeService::compileTheme()` parameter.

PR text:
````markdown
### 1. Why is this change necessary?

With asynchronous theme compilation enabled, saving a theme in the Administration shows "The theme compilation has been completed." once per sales channel, and once more per sales channel of each child theme. `ThemeService::compileThemeById()` dispatches one `CompileThemeMessage` per theme/sales channel mapping, and `CompileThemeHandler` creates the completion notification for every message. The "started" notification is only sent once per request.

These notifications used to name the sales channel ("Compilation for sales channel X completed"). Since #17732 they use one translated snippet, so a theme with two sales channels now produces two identical notifications.

### 2. What does this change do, exactly?

Saving a theme, or activating or deactivating an extension with storefront code, now shows the "theme compilation completed" notification once, after the last sales channel is compiled, instead of once per sales channel. Extensions calling `ThemeService::compileTheme()` themselves can suppress the notification with the new optional parameter `$notifyOnAsyncCompletion` (see the release notes).

### 3. Describe each step to reproduce the issue or behaviour.

1. Enable "Compile theme in the background" (`core.storefrontSettings.asyncThemeCompilation`).
2. Assign the Shopware default theme to two storefront sales channels.
3. Change a theme setting in the Administration and save.
4. Run the message consumer.
5. Before: two "The theme compilation has been completed." notifications. After: one.
6. The same happens when activating or deactivating an extension with storefront bundles in the Administration.

### 4. Please link to the relevant issues (if any).

- closes #19100

### 5. Checklist

- [x] I have written tests and verified that they fail without my change
- [x] I have updated developer-facing release notes if this change is **relevant** for external developers:
  - Add a short entry to `RELEASE_INFO-6.<major>.md` under “Upcoming” for informational changes, including the consequences of the change and how it affects external developers.
  - Add an `UPGRADE` section in `UPGRADE-6.<next-major>.md` for breaking changes (what/why/impact/how to adapt).
  - See the [Documenting a Release Process](https://github.com/shopware/shopware/blob/trunk/delivery-process/documenting-a-release.md) for details.
- [ ] I have written or adjusted the documentation and agent skills according to my changes
- [x] This change has comments for package types, values, functions, and non-obvious lines of code
- [ ] I have read the contribution requirements and fulfilled them
````

Screenshots: none (needs async compilation enabled and a message worker; covered by unit tests)

<a id="pr-text-20316"></a>

### #20316 [Admin] In the "Create new global rule" modal, update the input field's step value from 0.01 to 1.

Commit message:
```
fix(administration): step the rule modal priority by whole numbers

- closes #20316
```

Release notes: not needed, UI fix.

PR text:
````markdown
### 1. Why is this change necessary?

In the "Create new global rule" modal (`sw-rule-modal`, opened via "Create new rule..." in any rule select, e.g. promotion conditions or shipping availability), the priority arrows change the value by 0.01. The field is a float `mt-number-field` without a step, while `rule.priority` is an integer. The rule detail page (`sw-settings-rule-detail-base`) already uses `:step="1" :min="0" number-type="int"`.

The payment method position field has the same issue: `payment_method.position` is an integer, but the arrows change it by 0.01.

### 2. What does this change do, exactly?

- `sw-rule-modal`: the priority field gets `:step="1"`, `:min="0"` and `number-type="int"`, the same as the rule detail page.
- `sw-settings-payment-detail`: the position field gets `:step="1"` and `number-type="int"`, like the shipping method position.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a shipping method, type a name into "Availability" and click "Create new rule...".
2. In "Create new global rule", click the up arrow of "Priority" three times.
3. Before: `0.03`. After: `3`.
4. Open a payment method and click the up arrow of "Position": before `+0.01`, after `+1`.

### 4. Please link to the relevant issues (if any).

- closes #20316

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/20316-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/20316-after.png`

<a id="pr-text-21108"></a>

### #21108 Order detail page change to twig block breaks <div> closure

Commit message:
```
fix(administration): keep order detail header blocks properly nested

- closes #21108
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

Since #20959, overriding `sw_order_detail_header_label_manual_order` or `sw_order_detail_header_title` breaks the order detail page: it renders blank. #20959 wrapped the title in a new `div.sw-order-detail__header`, but its closing `</div>` ended up inside `sw_order_detail_header_label_manual_order`, and that block is nested inside `sw_order_detail_header_title`. An override that replaces either block without repeating the `</div>` leaves the element unclosed.

### 2. What does this change do, exactly?

Overriding the order detail header blocks `sw_order_detail_header_title` or `sw_order_detail_header_label_manual_order` in an extension no longer leaves the header element unclosed. Without an override, the page looks the same as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. Override the block in a plugin:
   ```twig
   {% block sw_order_detail_header_label_manual_order %}
       <mt-badge v-if="order.createdById">Manual</mt-badge>
   {% endblock %}
   ```
2. Open an order in the Administration.
   - Before: the order detail page is blank.
   - After: the page renders, with the override in the header.

### 4. Please link to the relevant issues (if any).

- closes #21108

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

<a id="pr-text-21134"></a>

### #21134 Storefront: Mixed usage of legal terms Datenschutz

Commit message:
```
fix(storefront): use one German term for the privacy notice

- closes #21134
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

The German Storefront snippets use two terms for the same page: "Datenschutzbestimmungen" (nine times) and "Datenschutzhinweise" (twice).

### 2. What does this change do, exactly?

The German Storefront now calls the privacy page "Datenschutzhinweise" everywhere (registration, checkout, newsletter and video consent) instead of mixing in "Datenschutzbestimmungen".

### 3. Describe each step to reproduce the issue or behaviour.

1. Open the registration or the checkout in a German Storefront.
   - Before: the privacy checkbox says "Datenschutzbestimmungen", the password notice "Datenschutzhinweise".
   - After: both say "Datenschutzhinweise".

### 4. Please link to the relevant issues (if any).

- closes #21134

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

<a id="pr-text-17747"></a>

### #17747 Plugin refresh does one transaction per plugin and N+1 language lookups in PluginService

Commit message:
```
perf(core): look up each locale once per plugin refresh

- relates #17747
```

Release notes: not needed, an internal performance change.

PR text:
````markdown
### 1. Why is this change necessary?

`PluginService::refreshPlugins()` resolves the language id of every locale in every plugin's `composer.json` labels and descriptions with its own DAL search. With two plugins that each ship an en-GB and a de-DE label and description, one refresh runs eight identical language searches for two locales.

### 2. What does this change do, exactly?

A plugin refresh now looks up each language once instead of once per plugin label and description. The one-transaction-per-plugin part of the issue is not part of this change.

### 3. Describe each step to reproduce the issue or behaviour.

1. Have two plugins whose `composer.json` has `extra.label` and `extra.description` in en-GB and de-DE.
2. Run `bin/console plugin:refresh` and count the searches on the language repository.
   - Before: 8 searches.
   - After: 2 searches, one per locale.

### 4. Please link to the relevant issues (if any).

- relates #17747

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

<a id="pr-text-21141"></a>

### #21141 ZUGFeRD/XRechnung cancellation invoice with a promotion is rejected (BR-CL-20)

Commit message:
```
fix(core): omit the allowance reason code on ZUGFeRD discount charges

- closes #21141
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

A ZUGFeRD/XRechnung cancellation invoice for an order with a promotion is rejected by the KoSIT validator with BR-CL-20. The cancellation inverts all prices, so the promotion becomes a document-level charge, but `ZugferdDocument::withDiscountItem()` still sends the allowance reason code `95` ("Discount"). That code belongs to UNCL 5189; charge reason codes must come from UNCL 7161.

### 2. What does this change do, exactly?

ZUGFeRD and XRechnung documents in which a promotion becomes a charge, such as the cancellation invoice of an order with a promotion, now pass the KoSIT validation: the charge keeps the promotion name as its reason but no longer carries the discount code 95. Discounts on regular invoices keep the code 95.

### 3. Describe each step to reproduce the issue or behaviour.

1. Place an order with a product and an absolute promotion, e.g. -5.00 EUR.
2. Create an invoice, then a ZUGFeRD cancellation invoice.
3. Validate the XML with the KoSIT validator (XRechnung 3.0.2 / EN16931 CII).
   - Before: `[BR-CL-20] Coded charge reasons MUST belong to the UNCL 7161 code list`, the charge has `<ram:ReasonCode>95</ram:ReasonCode>`.
   - After: the charge has no `ReasonCode`, only the `Reason` text.

### 4. Please link to the relevant issues (if any).

- closes #21141

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

<a id="pr-text-20343"></a>

### #20343 ApiController::deleteVersion route requirements name no placeholder

Commit message:
```
fix(core): key the version route requirements to their placeholders

- closes #20343
```

Release notes: not needed, a bug fix; malformed ids were already rejected, now at routing.

PR text:
````markdown
### 1. Why is this change necessary?

The `api.deleteVersion` route declares the placeholders `{versionId}`, `{entity}` and `{entityId}`, but its requirements are keyed `version`, `entity` and `id`. Symfony ignores requirement keys that name no placeholder, so both id segments fall back to the default `[^/]+` and accept any value.

### 2. What does this change do, exactly?

`POST /api/_action/version/{versionId}/{entity}/{entityId}` now only matches when both ids are valid UUIDs, so a malformed id gets a 404 at routing instead of a 400 from the controller. Requests with valid ids behave as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. Read the `#[Route]` attribute of `ApiController::deleteVersion()`.
   - Before: the `version` and `id` requirement keys match no placeholder of the path.
   - After: every requirement key names a placeholder of its path, asserted by a unit test for `ApiController` and `CustomerGroupRegistrationActionController`.

### 4. Please link to the relevant issues (if any).

- closes #20343

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

<a id="pr-text-19024"></a>

### #19024 Administration: rented extension deactivation modal never opens on single card toggle

Commit message:
```
fix(administration): confirm the deactivation of a rented extension

- closes #19024
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

Deactivating a rented extension with the toggle on its card never shows the confirmation that the subscription fees continue. The extension is deactivated at once, like a free one. `changeExtensionStatus()` checks `this.license`, which the component has not had since the license moved to `extension.storeLicense`, so the check always takes the early return. The modal bindings `label` and `license` point to nothing as well.

### 2. What does this change do, exactly?

Switching off a rented extension with the toggle on its card now asks for confirmation that the subscription fees continue. Other extensions are still deactivated right away.

### 3. Describe each step to reproduce the issue or behaviour.

1. Install and activate a rented extension from the Shopware Store.
2. Go to Extensions > My extensions and switch the extension off with the toggle on its card.
   - Before: the extension is deactivated without any confirmation.
   - After: the deactivation modal opens and says the fees continue; the extension is deactivated only after confirming.

### 4. Please link to the relevant issues (if any).

- closes #19024

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/19024-before.jpg` (old build: the rented extension is switched off at once, no modal), `/home/thinkpad/claude-scratchpad/shopware/screenshots/19024-after.png` (fix: the deactivation modal with the fee warning). Taken with `MyPlugin` and a rent license set on its card in the browser, since the local shop has no rented store extension; the deactivate call was stubbed, nothing was deactivated.

<a id="pr-text-21253"></a>

### #21253 CMS video element always uses preload="auto", even when a cover is shown

Commit message:
```
fix(storefront): preload the CMS video only when it autoplays

- closes #21253
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

The Storefront CMS video element always renders `preload="auto"`. With a cover image and no autoplay, the browser still downloads the whole video on page load, although the visitor only sees the poster until they click play. For large hero videos this costs bandwidth and page speed. The shared `utilities/video.html.twig` already uses `preload="none"` with a cover and `metadata` otherwise; the CMS element never followed it.

### 2. What does this change do, exactly?

A CMS video with a cover image no longer loads anything beyond the poster until the visitor starts it. Without a cover only the metadata and first frame are loaded, and only an autoplaying video is still preloaded in full.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create a CMS layout with a video element, upload an mp4, enable "Show cover" with a cover image and leave autoplay off.
2. Open the page in the Storefront with the network tab open and don't click the video.
   - Before: the mp4 is requested and downloads; the `<video>` tag has `preload="auto"`.
   - After: only the poster image is loaded; the `<video>` tag has `preload="none"`.
3. Disable "Show cover": the tag has `preload="metadata"`. Enable autoplay without a cover: `preload="auto"`, as before.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #21253

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/21253-before.jpg` (trunk: `preload="auto"`, mp4 downloaded without a click), `/home/thinkpad/claude-scratchpad/shopware/screenshots/21253-after.jpg` (fix: `preload="none"`, only the cover requested). The box at the top right is an overlay injected for the screenshot, listing the `<video>` attributes, the buffered time and the media requests of the page load.

<a id="pr-text-20273"></a>

### #20273 Administration: Advanced Pricing select button can be toggled even if inheritance is active

Commit message:
```
fix(administration): lock the inherit switch while a variant inherits

- closes #20273
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

On a variant without own advanced prices, the "Use advanced prices from parent product" switch can be toggled while the variant still inherits. Everywhere else in the product detail, an inherited field is locked until the inheritance is removed with the chain icon, and the rule select right below the switch already follows that. The cross-selling tab has the same switch with the same problem.

### 2. What does this change do, exactly?

While a variant inherits its advanced prices or cross-sellings, the "Use … from parent product" switch is locked. It becomes usable once the inheritance is removed with the chain icon, like the other inherited fields.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a variant without own advanced prices and go to the Advanced pricing tab.
   - Before: the switch next to "Use advanced prices from parent product" can be toggled while the chain icon shows inheritance.
   - After: the switch is disabled; clicking the chain icon removes the inheritance and enables it.
2. Repeat on the Cross Selling tab of a variant without own cross-sellings: same before and after.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #20273

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/20273-before.png` (old build: inherited, switch enabled), `/home/thinkpad/claude-scratchpad/shopware/screenshots/20273-after.png` (build of this branch: inherited, switch disabled). The framed box below the select is an overlay injected for the screenshot, listing the measured states. The issue's own screenshot is at `/home/thinkpad/claude-scratchpad/shopware/screenshots/20273-issue.png`.

<a id="pr-text-clone-variant-canonical"></a>

### (no issue) Duplicating a product keeps a variant's own canonical product

Commit message:
```
fix(administration): reset the canonical product of duplicated variants
```

Release notes: not needed, a bug fix with no change for external developers.

PR text:
````markdown
### 1. Why is this change necessary?

When a product is duplicated in the Administration, a variant that stores its own canonical product keeps it, so the copy's variant page names the original product's variant as its canonical URL. Search engines are then told that the copy is a duplicate of the original. #13292 resets `canonicalProductId` when the parent is cloned, but the variants are cloned one by one afterwards and only get a new `parentId` and product number.

### 2. What does this change do, exactly?

Duplicated variants no longer keep a canonical product of their own. They inherit the canonical of the new parent product, which the duplicate already resets, so no page of the copy points to the original product.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create a product with two variants, A and B, and set the canonical product of variant A itself to variant B (via the Admin API, e.g. `PATCH /api/product/<A>` with `{"canonicalProductId": "<B>"}`).
2. Open the parent in the Administration and use "Save and duplicate".
3. Check the copy's variant A (`canonicalProductId` in the Admin API, or `<link rel="canonical">` on its storefront page).
   - Before: it points to variant B of the original product.
   - After: it is empty, and the page uses its own URL as canonical.

### 4. Please link to the relevant issues (if any).

none

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

Screenshots: none (before-state observed on 2026-09-25: `<link rel="canonical" href="https://shopware.ddev.site/Canonical-Test/CANON-P.2">` on the copy's variant `SW10001.1`).

<a id="pr-text-21174"></a>

### #21174 Advanced Pricing matrix has to small input fields

Commit message:
```
fix(administration): hide the currency suffix in product price grids

- closes #21174
```

Release notes: not needed, a style-only bug fix.

PR text:
````markdown
### 1. Why is this change necessary?

With compact mode switched off, the price inputs in the advanced pricing matrix are too narrow to show the prices: 267.35 shows as "26", for example. In non-compact mode each price field renders the currency as a suffix, and the page hides it in grid cells with a rule on `.sw-field__addition`. Since the price fields became `mt-number-field` (#7015), the suffix has the class `.mt-field__addition`, so the rule no longer matches and the suffix takes half of every input. The inline edit of the variants list has the same dead rule.

### 2. What does this change do, exactly?

In non-compact mode, the advanced pricing matrix and the variants list show the price inputs without the currency suffix again, as before 6.7, so the inputs are about twice as wide and the prices are fully visible. The column header still names the currency.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open a product, go to Advanced pricing and select a rule.
2. Open the list settings (☰) and switch off "Use compact view".
   - Before: each price input has a currency suffix, and longer prices such as 267.35 are cut off.
   - After: no suffix; the inputs use the full width and show the whole price.
3. Open the Variants tab of a product with variants, switch off compact view and double-click a variant to edit it inline: same before and after for the price inputs.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #21174

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/21174-before.png` and `/home/thinkpad/claude-scratchpad/shopware/screenshots/21174-after-injected.png` (advanced pricing, compact view off), `/home/thinkpad/claude-scratchpad/shopware/screenshots/21174-variants-before.png` and `/home/thinkpad/claude-scratchpad/shopware/screenshots/21174-variants-after-injected.png` (variant inline edit). The "after" images use the fix's selectors injected into the current build, not a rebuilt Admin.

<a id="pr-text-21057"></a>

### #21057 Import/Export Activity: Content Is Cut Off

Commit message:
```
fix(administration): keep the import/export activity grid inside its card

- closes #21057
```

Release notes: not needed, a style-only bug fix.

PR text:
````markdown
### 1. Why is this change necessary?

When an import or export activity has long content, such as a long profile name, the activity card shows only the first columns. The status, records, size and the ⋯ menu disappear, and there is no scrollbar to reach them. The card lays out its content as a CSS grid, and `sw-import-export-activity` wraps the listing in a plain `div`. As a grid item with the default `min-width: auto`, that `div` grows to the full table width instead of letting the data grid scroll, so the sticky actions column ends up outside the card.

### 2. What does this change do, exactly?

The import and export activity lists stay inside their card: long content scrolls horizontally within the list, and the actions column with the ⋯ menu stays visible on the right, as in other listings.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create an import/export profile with a long name and run an export with it.
2. Look at the export activity list.
   - Before: only Date and Profile are visible; status, records, size and the ⋯ menu are cut off.
   - After: the list scrolls horizontally inside the card and the ⋯ menu is visible.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #21057
- closes #21257

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/21057-before.png`, `/home/thinkpad/claude-scratchpad/shopware/screenshots/21057-after-injected.png` (export activity with the profile text lengthened in the DOM; "after" uses the fix's rule injected into the current build, not a rebuilt Admin).

<a id="pr-text-20362"></a>

### #20362 Header icon number text misaligned/insufficient contrast

Commit message:
```
fix(storefront): let badges grow with their text

- closes #20362
```

Release notes: not needed, a style-only bug fix.

PR text:
````markdown
### 1. Why is this change necessary?

With enlarged text (e.g. 200% text-only zoom at 320px), the numbers in the cart and wishlist badges in the header spill out of the badge: the badge keeps its fixed 20px height while the text grows, so the white number sits half outside the coloured badge and becomes unreadable. Shopware's badge skin sets `height: 20px; line-height: 20px` on `.badge` (and 28px on `.badge-lg`, used for the order status), which locks the text into a fixed pixel box.

### 2. What does this change do, exactly?

Badges, including the cart and wishlist counters and the order status badges, now grow with their text, so enlarged numbers stay inside the badge and readable. At the default text size they look exactly as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, enable "Zoom text only" and set the text zoom to 200%; set the viewport to 320px.
2. Add a product to the cart (and to the wishlist, if enabled) and look at the header icons.
   - Before: the badge numbers stick out of the badge at the top and bottom and are hard to read.
   - After: the badge grows with the number and the number is fully inside it.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #20362
- relates #20371 (the status badge part)

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/20362-before.png` (compiled trunk CSS: the "12" spills out of the cart badge), `/home/thinkpad/claude-scratchpad/shopware/screenshots/20362-after-injected.png` (the fix's CSS injected: the badge grows and contains the number). 320px popup, root font size 200%, badge markup injected, rendered with html2canvas at 2x; the scrambled text at the top left is html2canvas drawing the visually hidden skip links.

<a id="pr-text-20380"></a>

### #20380 Product Reviews causes horizontal scrolling

Commit message:
```
fix(storefront): let the review rating filter labels wrap

- closes #20380
```

Release notes: not needed, a template-only bug fix.

PR text:
````markdown
### 1. Why is this change necessary?

With enlarged text on a small screen (e.g. 320px wide with 200% text zoom), the reviews offcanvas on the product page scrolls horizontally, which fails WCAG 1.4.10 (Reflow). The rating filter labels ("Excellent (1)", "Very good (0)", …) have `text-nowrap`, so at large text sizes they are wider than the offcanvas and push its whole content sideways. The filter is shown above the review list, the review form and the login form, so every state of the reviews offcanvas is affected, even for products without reviews.

### 2. What does this change do, exactly?

The rating filter labels in the reviews section now wrap when they don't fit, so the reviews offcanvas no longer scrolls horizontally with enlarged text. At normal text sizes they look the same as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, enable "Zoom text only", set the text zoom to 200% and the viewport to 320px.
2. Open a product detail page and open the reviews.
   - Before: the offcanvas content can be scrolled sideways; the checkboxes and percentages are cut off on the left when scrolled.
   - After: no horizontal scrolling; long rating labels wrap.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #20380

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/20380-before.png` (trunk: reviews offcanvas scrolled 22px to the right, checkboxes and percentages cut off), `/home/thinkpad/claude-scratchpad/shopware/screenshots/20380-after.png` (fix: no horizontal scroll). Taken in a 320px popup with the root font size at 200% and rendered with html2canvas, since the popup is outside the screenshot tool; the content above the rating filter was hidden for the capture so the filter is in view.

<a id="pr-text-20378"></a>

### #20378 Product description causes horizontal scrolling

Commit message:
```
fix(storefront): wrap long words in the product description

- closes #20378
```

Release notes: not needed, a style-only bug fix.

PR text:
````markdown
### 1. Why is this change necessary?

With enlarged text on a small screen (e.g. 320px wide with 200% text zoom), the product description scrolls horizontally, which fails WCAG 1.4.10 (Reflow), and the properties stay cut off even when scrolled. Long words in the product name, the description or the property values cannot break, so the properties table and the title grow wider than the description offcanvas.

### 2. What does this change do, exactly?

Long words in the product description, its title and the properties table now wrap instead of pushing the content sideways, so the description no longer scrolls horizontally with enlarged text. At normal text sizes nothing changes.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, enable "Zoom text only", set the text zoom to 200% and the viewport to 320px.
2. Open a product with a description and properties (e.g. from the demo data) and open the description.
   - Before: the description can be scrolled sideways and long property values are cut off.
   - After: long words wrap and there is no horizontal scrolling.

<!-- screenshot -->
Before / After

### 4. Please link to the relevant issues (if any).

- closes #20378

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

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/screenshots/20378-before.png` and `/home/thinkpad/claude-scratchpad/shopware/screenshots/20378-after-injected.png` (title and text, before scrolled 97px to the right), `/home/thinkpad/claude-scratchpad/shopware/screenshots/20378-table-before.png` and `/home/thinkpad/claude-scratchpad/shopware/screenshots/20378-table-after-injected.png` (properties table, before scrolled 82px to the right). 320px popup, root font size 200%, the issue's demo texts injected into the real offcanvas markup, rendered with html2canvas; the "after" uses the fix's rule injected, not a recompiled theme.

<a id="pr-text-sync-deleted-product"></a>

### (no issue) Sync request reports a product deleted earlier in the request as updated

Commit message:
```
fix(core): report products deleted earlier in a sync request as deleted
```

Release notes: entry added to `RELEASE_INFO-6.7.md` (6.7.16.0, Core).

PR text:
````markdown
### 1. Why is this change necessary?

A sync request that deletes a product and then one of its prices, media or cross-sellings reports the product as updated, although it is deleted. The second delete queues an update for the product, because the product's inherited data or its cover reference (`product.product_media_id`) would have to change. That update is added to the queue after the product's own delete, and the write result keeps the last command per row. So the product ends up under `data` instead of `deleted` in the sync response, `product.written` is dispatched instead of `product.deleted`, and consumers that react to deletes, such as the Admin search index, keep the product.

### 2. What does this change do, exactly?

Products deleted earlier in a sync request stay reported as deleted when a later operation of the same request deletes their prices, media, cross-sellings, manufacturer or other related entities: they appear in `deleted` of the sync response and trigger `product.deleted`.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create a product with an advanced price.
2. Send `POST /api/_action/sync` with
   `[{"action":"delete","entity":"product","payload":[{"id":"<product id>"}]},{"action":"delete","entity":"product_price","payload":[{"id":"<price id>"}]}]`
   - Before: the product id is listed under `data.product`, and a `product.written` webhook is sent.
   - After: the product id is listed under `deleted.product`, and `product.deleted` is sent.
3. The same applies when the second operation deletes the product's cover `product_media`.

### 4. Please link to the relevant issues (if any).

none
````

Screenshots: none (API behaviour; the sync response and webhook are the evidence).

<a id="pr-text-21619"></a>

### #21619 Order detail: documents card keeps showing the documents of the previous order after switching to another order

Commit message:
```
fix(administration): reload order documents when the order changes

- closes #21619
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21619/pr-text-21619.md`):
````markdown
### 1. Why is this change necessary?

When one order detail page is replaced by another without going back to the list (e.g. by changing the order id in the URL), the header shows the new order but the documents card keeps listing the previous order's documents until a full reload. "Send document" then mails the previous order's PDF to the customer of the current order.

Vue Router keeps the page and its child components mounted when only the `:id` changes. `sw-order-detail` reloads the order, but `sw-order-document-card` loaded its documents only on creation and on query changes of the listing mixin, and the latter still ran with the old order.

### 2. What does this change do, exactly?

The documents card reloads its list when the order changes, so it always shows the documents of the open order. A response for the previous order that arrives after the switch is ignored, so it can't overwrite the new list.

### 3. Describe each step to reproduce the issue or behaviour.

1. Have two orders A and B with one document each.
2. Open `/admin#/sw/order/detail/<id-A>/documents` and wait until the document is listed.
3. Without reloading, change the URL to `/admin#/sw/order/detail/<id-B>/documents`.
   - Before: the header shows order B, the card still lists the document of order A.
   - After: the card lists the document of order B.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #21619
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21619/21619-before.jpg`, `/home/thinkpad/claude-scratchpad/shopware/issue-21619/21619-after.jpg`.

<a id="pr-text-21625"></a>

### #21625 Sitemap omits out-of-stock variants that inherit "Clearance sale" from their parent

Commit message:
```
fix(core): keep out-of-stock variants inheriting clearance sale in the sitemap

- closes #21625
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21625/pr-text-21625.md`):
````markdown
### 1. Why is this change necessary?

With "Hide products after clearance" disabled, out-of-stock clearance products stay in the sitemap, but only when "Clearance sale" is set on the variant itself. A variant that inherits the flag from its parent is dropped. If that variant is the parent's canonical variant, the whole product disappears from the sitemap, because the other variants are excluded by the canonical and the parent by having children.

`ProductUrlProvider::getProducts()` checked `product.is_closeout`, which is `NULL` for an inheriting variant, while `available` is computed from the inherited value (`COALESCE(product.is_closeout, parent.is_closeout, 0)` in `StockStorage`).

### 2. What does this change do, exactly?

Out-of-stock variants that inherit "Clearance sale" from their parent are now kept in the sitemap when "Hide products after clearance" is disabled, the same as variants that set the flag themselves. With the setting enabled they are still left out.

### 3. Describe each step to reproduce the issue or behaviour.

1. Disable "Settings > Shop > Products > Hide products after clearance".
2. Create a product with two variants visible in the storefront sales channel, enable "Clearance sale" on the parent and leave it inherited on the variants.
3. Set the stock of variant A to 0 and run `bin/console sitemap:generate --force`.
   - Before: variant A is missing from the product sitemap.
   - After: variant A is listed.
4. Optional: make variant A the canonical variant of the parent and generate again.
   - Before: no URL of the product is in the sitemap.
   - After: variant A is listed.

### 4. Please link to the relevant issues (if any).

- closes #21625
````

Screenshots: none (sitemap generated by CLI).

<a id="pr-text-21633"></a>

### #21633 Admin: Profile Search Settings: Wrong Input Matching

Commit message:
```
fix(administration): give each search preference checkbox its own id

- closes #21633
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21633/pr-text-21633.md`):
````markdown
### 1. Why is this change necessary?

In the profile's search preferences every module checkbox has the `name` and `id` `sw-field--searchPreference-_searchable`, and every field checkbox `sw-field--field-_searchable`. Clicking any label toggles the first checkbox on the page, not the one next to the label.

`mt-checkbox` uses the `name` as the input id (`name || mt-field--<unique id>`), so the static name repeated in the `v-for` gave all 78 checkboxes two ids. The snippet detail page has the same problem: one translation field per snippet set, all named `sw-field--snippet-value`, so the label of the second set focuses the first set's input.

### 2. What does this change do, exactly?

Each checkbox in the search preferences and each translation field on the snippet detail page now has its own id, so clicking a label toggles or focuses the field next to it.

### 3. Describe each step to reproduce the issue or behaviour.

1. Open `/admin#/sw/profile/index/search-preferences`.
2. Click the label "Customers".
   - Before: "Orders", the first checkbox, is unchecked and the page jumps to it; "Customers" stays checked.
   - After: "Customers" is unchecked.
3. Open `/admin#/sw/settings/snippet/detail/account.addressCreateBtn`, remove the inheritance of both translations and click the label of the second snippet set.
   - Before: the first snippet set's input gets the focus.
   - After: the second snippet set's input gets the focus.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #21633
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21633/21633-before.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21633/21633-after.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21633/21633-sibling-snippet-before.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21633/21633-sibling-snippet-after.png`.

<a id="pr-text-21415"></a>

### #21415 Profile form: account type falls back to "Private" after a validation error, hiding company/VAT ID fields and their error messages

Commit message:
```
fix(storefront): keep the submitted account type and company on profile errors

- closes #21415
```

Follow-up commit (subject only): `fix(storefront): keep all submitted personal data on profile errors`

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21415/pr-text-21415.md`):
````markdown
### 1. Why is this change necessary?

When a private customer switches the profile to account type "Business" and the save fails server-side (e.g. an invalid VAT ID), the page comes back with account type "Private". The company block is hidden again, including the company name, the VAT ID and its error message, so the customer sees no error and the change is silently not saved.

`AccountProfileController::saveProfile()` forwards to the profile page with the violations, and the page renders `address-personal.html.twig` with the stored customer (`data: context.customer`). Unlike every other caller of that template (registration, address book, address manager), the profile page didn't pass the submitted `accountType`, and all other fields (salutation, title, first and last name, company, birthday) were filled from the stored customer. Only the VAT ID field already fell back to the submitted input, so a changed name or birthday also reverted silently and was lost with the next save.

### 2. What does this change do, exactly?

After a failed save of the personal data on the profile page, every field keeps the value the customer submitted: account type, salutation, title, first and last name, company, VAT ID and birthday. The company fields and the VAT ID error therefore stay visible. Errors from the e-mail or password forms still show the stored values, and the registration and address forms are unchanged.

### 3. Describe each step to reproduce the issue or behaviour.

Setup: enable "Show selection between company and customer account", and "Check VAT ID format" for the country of the customer's default billing address.

1. Log in as a customer with account type "Private" and open `/account/profile`.
2. Set the account type to "Commercial", enter a company name and the invalid VAT ID `DE123`, change the first name, and click "Save changes".
   - Before: the page shows account type "Private", the stored first name, no company fields and no error.
   - After: the page shows account type "Commercial", the new first name, the entered company name, `DE123` and "The VAT Reg.No. you have entered does not have the correct format."

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #21415
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-21415/21415-before.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21415/21415-after.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21415/21415-other-fields-before.png`, `/home/thinkpad/claude-scratchpad/shopware/issue-21415/21415-other-fields-after.png`.

<a id="pr-text-21688"></a>

### #21688 RefreshHttpCacheMessage serializes the complete server parameter bag

Commit message:
```
fix(core): keep environment variables out of HTTP cache refresh messages

- closes #21688
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21688/pr-text-21688.md`):
````markdown
### 1. Why is this change necessary?

With HTTP cache soft purge enabled, loading an invalidated cached page dispatches a `RefreshHttpCacheMessage` that contains `$request->server->all()`. Depending on the PHP setup, the server bag also holds the process environment, e.g. `DATABASE_URL` or `APP_SECRET`. These values end up in the serialized message and, with the Doctrine transport, are stored in the `messenger_messages` table.

### 2. What does this change do, exactly?

The refresh message now only carries the server parameters needed to rebuild the request: the HTTP headers (`HTTP_*`, except `Authorization`) and the request keys such as `REQUEST_URI`, `REQUEST_METHOD`, `QUERY_STRING`, `SERVER_NAME`, `SERVER_PORT`, `HTTPS`, `SCRIPT_NAME`/`SCRIPT_FILENAME` and `REMOTE_ADDR`. Environment variables and credentials are no longer serialized or stored, and the regenerated request has the same URL, host and scheme as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. Use the Doctrine messenger transport and enable `shopware.http_cache.soft_purge`.
2. Add an identifiable environment variable to the PHP process, e.g. `MY_SECRET=leak-test`.
3. Warm a cacheable Storefront page, invalidate a tag of it (e.g. save the product), and load the page again.
4. Look at the `RefreshHttpCacheMessage` in `messenger_messages`.
   - Before: the body contains `MY_SECRET`, `DATABASE_URL`, `APP_SECRET` and the rest of the environment.
   - After: the body only contains the HTTP headers and request keys.

### 4. Please link to the relevant issues (if any).

- closes #21688
````

Screenshots: none (message payload).

<a id="pr-text-21657"></a>

### #21657 Null error when migrating orders

Commit message:
```
fix(core): skip product line items without a product in stock updates

- closes #21657
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21657/pr-text-21657.md`):
````markdown
### 1. Why is this change necessary?

Orders can contain product line items without a product reference, for example when SwagMigrationAssistant migrates an order whose product doesn't exist in the target shop: the line item has `type = product` but `referenced_id = NULL`. `OrderStockSubscriber` passes `referenced_id` to `changeset(string $productId)` without checking it, so writing such a line item, removing the product from a line item, or cancelling the order fails with:

```
OrderStockSubscriber::changeset(): Argument #2 ($productId) must be of type string, null given
```

### 2. What does this change do, exactly?

Product line items without a product reference no longer change any stock, so orders containing them can be written, edited and cancelled. When the product reference of a line item is removed, the stock of the previously referenced product is given back, as if the line item had been deleted.

### 3. Describe each step to reproduce the issue or behaviour.

1. Create an order with a product line item whose `referencedId` and `productId` are `null`, e.g. by migrating a Shopware 5 order whose product wasn't migrated, or via the Admin API.
   - Before: the write fails with the `TypeError` above.
   - After: the order is written, no stock changes.
2. Cancel an order that contains such a line item.
   - Before: the state transition fails with the same `TypeError`.
   - After: the order is cancelled.

### 4. Please link to the relevant issues (if any).

- closes #21657
````

Screenshots: none (backend).

<a id="pr-text-20384"></a>

### #20384 Quantity input number cutoff

Commit message:
```
fix(storefront): keep quantity inputs readable on narrow screens

- closes #20384
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-20384/pr-text-20384.md`):
````markdown
### 1. Why is this change necessary?

On narrow screens, and especially with enlarged text (320px wide, 200% text zoom as in WCAG reflow), the quantity selector can't show the quantity. The +/- buttons grow with the text, the input in between shrinks to almost nothing, and the plus button wraps onto its own line. On the product page the selector sits in a `col-4` next to the buy button; at 320px even without zoom the input is only 2px wide. In the cart, the offcanvas cart and on the confirm page the selector sits in a half-width column; at 200% the plus button wraps and the cart scrolls horizontally.

`.input-group` may wrap, so its min-content is a single button, and the surrounding columns never grow beyond their fixed share.

### 2. What does this change do, exactly?

The quantity input keeps at least room for two digits, and the +/- buttons stay on the same row. Where the column is too narrow for that, the quantity takes the room it needs: on the product page the buy button moves below the selector, and in line items the selector moves below the "Quantity" label, which then uses the full row. At the default text size the layout stays the same from 375px up (only the input on the product page gets a little wider at 375px), and on wider screens nothing changes.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, set Zoom to 100% and enable "Zoom text only", set the viewport to 320px and zoom the text to 200%.
2. Open a product page and enter a quantity of 12, then add the product to the cart and open the offcanvas cart, the cart page and the checkout confirm page.
   - Before: "12" is cut off or hidden, the plus button wraps below the input, the cart pages scroll horizontally.
   - After: "12" is fully visible with both buttons next to it; the buy button and the "Quantity" label move to their own rows where needed.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #20384
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-20384/20384-pdp-320-200pct-before-after.jpg`, `/home/thinkpad/claude-scratchpad/shopware/issue-20384/20384-cart-320-200pct-before-after.jpg`.

<a id="pr-text-20382"></a>

### #20382 Change Address modal triggers horizontal scrolling

Commit message:
```
fix(storefront): keep the address manager modal within narrow screens

- closes #20382
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-20382/pr-text-20382.md`):
````markdown
### 1. Why is this change necessary?

With 200% text zoom on a 320px viewport, the address manager modal ("Change shipping address" on the checkout confirm page) scrolls horizontally, which fails WCAG 1.4.10 (Reflow). At 200% the modal content is 483px wide in a 273px body:

- the "Shipping address"/"Billing address" toggle buttons can't fit side by side,
- the "Add new address" button has `flex-shrink-0` and never wraps its label,
- long words in an address (e.g. "Pennsylvania") can't break, and the address box can't shrink below them,
- the "Default" badge keeps 1.5rem padding on each side and doesn't fit the box.

### 2. What does this change do, exactly?

The address manager modal fits narrow screens with enlarged text: the toggle buttons stack when they don't fit next to each other, the "Add new address" label wraps, long words in addresses break, and the "Default" badge uses less padding on small screens. The same address boxes in the account address book get the same wrapping. At the default text size the modal looks the same, except that both toggle buttons now have the same width.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, set Zoom to 100% and enable "Zoom text only", set the viewport to 320px and zoom the text to 200%.
2. Put a product in the cart, go to the checkout confirm page as a logged-in customer and click "Change shipping address".
   - Before: the modal body scrolls horizontally; the toggle buttons, the address and the "Default" badge are cut off.
   - After: everything fits the modal width, nothing scrolls horizontally.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #20382
````

Screenshots: `/home/thinkpad/claude-scratchpad/shopware/issue-20382/20382-modal-320-200pct-before-after.jpg`.

<a id="pr-text-20366"></a>

### #20366 Ellipsis menu options are cutoff

Commit message:
```
fix(storefront): keep account context menus within narrow screens

- closes #20366
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-20366/pr-text-20366.md`):
````markdown
### 1. Why is this change necessary?

With 200% text zoom on a 320px viewport, the ellipsis menus in the account area are wider than the screen and their options are cut off: the address options ("Edit", "Use as default billing address") in the address book and the address manager, and the order options ("Change payment method", "Repeat order") in the order history. Bootstrap's `.dropdown-item` doesn't wrap (`white-space: nowrap`), so at 200% the order menu is 448px and the address menu 512px wide.

### 2. What does this change do, exactly?

These menus are now at most as wide as the screen (minus a small margin), and their options wrap onto several lines when they don't fit. At the default text size and on wider screens they keep their current width.

### 3. Describe each step to reproduce the issue or behaviour.

1. In Firefox, set Zoom to 100% and enable "Zoom text only", set the viewport to 320px and zoom the text to 200%.
2. Log in, open Account > Addresses and click the ellipsis menu of an address; open Account > Orders and click the ellipsis menu of an order.
   - Before: the menus extend beyond the screen and their options are cut off.
   - After: the menus fit the screen and the options wrap.

<!-- screenshot: Before -->
<!-- screenshot: After -->

### 4. Please link to the relevant issues (if any).

- closes #20366
````

<a id="pr-text-21580"></a>

### #21580 Admin search exhausts memory: EntityScoreQueryBuilder recurses forever on circular SearchRanking associations

Commit message:
```
fix(core): stop search score queries at circular associations

- closes #21580
```

Release notes: none needed (plain bug fix).

PR text (also in `/home/thinkpad/claude-scratchpad/shopware/issue-21580/pr-text-21580.md`):
````markdown
### 1. Why is this change necessary?

Since the Administration search falls back to the DAL for entities without an admin Elasticsearch indexer (#19399), it also builds term score queries for extension entities. `EntityScoreQueryBuilder::buildScoreQueries()` follows every association flagged with `SearchRanking` and never checks for cycles. When two entities point at each other with `SearchRanking` associations (for example a blog entry → author → entries), the recursion never ends. Every `/api/_admin/es-search` request that includes such an entity runs until it hits `memory_limit`, and with the Administration open several PHP workers are blocked at the same time.

### 2. What does this change do, exactly?

Search score queries no longer follow an association back to an entity that is already on the current path, so entities with circular `SearchRanking` associations can be searched again. An entity that is reached twice through different associations (e.g. `entry.author` and `entry.editor`) is still searched on both paths, and searches without such cycles build the same queries as before.

### 3. Describe each step to reproduce the issue or behaviour.

1. Enable the admin Elasticsearch/OpenSearch search (`SHOPWARE_ADMIN_ES_ENABLED=1`).
2. Install an extension whose entities have circular `SearchRanking` associations and no admin indexer (e.g. OpenBlogware 5.3).
3. Search in the Administration, or send `POST /api/_admin/es-search` with `{"term": "test", "entities": ["werkl_blog_entry"], "limit": 5}`.
   - Before: the request never completes and exhausts PHP memory.
   - After: the request returns the matching entries.

### 4. Please link to the relevant issues (if any).

- closes #21580
````

Screenshots: none (API behaviour).
