# OceanWP Changelog

### _2023.07.05_ - 3.4.6
- **Updated**: Breadcrumbs: Functionality enhancement.

### _2023.06.14_ - 3.4.5
- **Updated**: WooCommerce: Templates (mini-cart.php, loop-start.php, content-single-product.php) version number for compatibility to dismiss WooCommerce potential outdated templates notification.

### _2023.05.23_ - 3.4.4
- **New**: Typography: Google fonts: Updated list.
- **Added**: Mobile Header: Search icon and form styling options in the Customizer.
- **Added**: Compatibility: SiteOrigin: Custom templates support.
- **Added**: Compatibility: Ocean eComm Treasure Box: Conditional assets loading for the next OeTB plugin update and feature.
- **Fixed**: WooCommerce: Shop Manager user role accessing the Customizer causes critical error due to Privacy Policy page.
- **Fixed**: Gutenberg: Align Full block layout display with the page Full Width layout.

### _2023.04.05_ - 3.4.3
- **Added**: Compatibility: Elementor Pro: WooCommerce: Checkout styling.
- **Added**: Compatibility: Ocean Popup Login: Google reCaptcha support for upcoming plugin release.
- **Improved**: Accessibility: Header: Search: Dropdown.
- **Improved**: Accessibility: Header: Full Screen: Search.
- **Improved**: Accessibility: Header: Full Screen: Menu toggle button.
- **Improved**: Accessibility: Header: Medium: Search.
- **Improved**: Accessibility: Header: Vertical: Search.
- **Improved**: Accessibility: Header: Vertical: Menu toggle button.
- **Improved**: Accessibility: Header: Mobile: Full Screen: Search.
- **Improved**: Accessibility: Header: Mobile: Header Search: Overlay.
- **Updated**: SEO: Header: Vertical: Menu toggle button: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: SEO: Header: Full Screen: Menu toggle button: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: SEO: Header: Mobile: Header Search: Overlay: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: SEO: Header: Mobile: Full Screen: Menu toggle button: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: SEO: Header: Mobile: Sidebar: Menu close button: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: SEO: Header: Mobile: Menu toggle button: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: SEO: Header: Search: Search Overlay close button: Crawlable icon URL following Google's latest Lighthouse (PSI) changes.
- **Updated**: Template: 404.php
- **Updated**: Template: header.php
- **Updated**: Template: searchform.php
- **Updated**: Template: comments.php
- **Updated**: Template: partials/scroll-top.php
- **Updated**: Template: partials/mobile/mobile-fullscreen-search.php
- **Updated**: Template: partials/mobile/mobile-fullscreen.php
- **Updated**: Template: partials/mobile/mobile-sidr-close.php
- **Updated**: Template: partials/mobile/mobile-search.php
- **Updated**: Template: partials/mobile/mobile-icon.php
- **Updated**: Template: partials/header/style/full-screen-header.php
- **Updated**: Template: partials/header/style/medium-header-search.php
- **Updated**: Template: partials/header/style/vertical-header-search.php
- **Updated**: Template: partials/header/style/vertical-header-toggle.php
- **Updated**: Template: partials/header/search-replace.php
- **Updated**: Template: partials/header/search-overlay.php
- **Updated**: Template: partials/entry/readmore.php
- **Updated**: Template: partials/entry/media/blog-entry-link.php
- **Updated**: Template: partials/single/author-bio.php
- **Updated**: Template: partials/single/next-prev.php
- **Updated**: Template: partials/single/related-posts.php
- **Updated**: Template: partials/single/media/blog-single-link.php
- **Updated**: Template: partials/single/media/blog-single.php
- **Updated**: Template: partials/search/readmore.php
- **Updated**: Language: Theme .pot file.
- **Fixed**: Incorrect oceanwp_theme_strings() function usage throughout the theme.
- **Fixed**: Blog: Archives: Video and audio post formats styling.
- **Fixed**: Compatibility: Events Calendar: Deprecated function tribe_get_view().

### _2023.02.22_ - 3.4.2
- **Improved**: Customizer: Customizer panel scrollbar width for some browsers, like Chrome and Edge.
- **Fixed**: OceanWP Panel: Potential vulnerability patch: Patchstack report #2023-23700.
- **Fixed**: Posts: Link post format: External link option doesn't function.
- **Fixed**: WooCommerce: Option to remove product category description with custom code doesn't function.
- **Fixed**: WooCommerce: Option to remove cart collaterals from the cart with custom code doesn't function.
- **Fixed**: WooCommerce: Option to remove upsell section from the single product page with custom code doesn't function.
- **Fixed**: Customizer: Some controls display incorrect output. Example, instead of a functional link, html is displayed.
- **Fixed**: Customizer: General Options: Performance: SVG icons: Disable / Enable buttons action misconfigured.

### _2023.01.11_ - 3.4.1
- **Fixed**: Customizer: Footer Bottom: Footer copyright text color applied settings do not work.

### _2023.01.10_ - 3.4.0
- **Added**: Customizer: SEO Settings: Quick access link to configure breadcrumb settings.
- **Added**: Customizer: Customizer Control: Info control.
- **Tweak**: Customizer: Enable Schema option moved to General Options > SEO Settings for improved UX (previously General Options > General Settings).
- **Tweak**: Customizer: Opengraph section and options moved to General Options > SEO Settings for improved UX (previously General Options > General Settings).
- **Tweak**: Accessibility: Footer bottom: Default copyright text color changed to white (#fff) for increased contrast.
- **Updated**: SEO: Search Icon URLs following Google's latest Lighthouse (PSI) changes.
- **Updated**: Language: OceanWP .pot file.
- **Fixed**: WooCommerce: Mini Cart: Occassional flashing of the mini cart on various conditions (quick view, single product removal, first product add, etc.).
- **Fixed**: WooCommerce: Login Register option.
- **Fixed**: WooCommerce: Add to Cart Ajax: Change button text when product removed from the cart.
- **Fixed**: Compatibility: Visual Composer: hoverbox link doesn't function.
- **Fixed**: Compatibility: Elementor: Single Post: Full Width Layout: distorted sections and columns configuration settings display on the backend.
- **Fixed**: Compatibility: Elementor: Single Post: Full Width Layout: increased paragraph margins display on the frontend.
- **Fixed**: OceanWP Panel: submenu item links in WP Dashboard don't function if OceanWP Panel already open.
- **Fixed**: Customizer: Header: Medium: Hide menu on hover option conditional logic: Display option only when Ocean Sticky Header active.
- **Fixed**: Customizer: Header: Medium: Stick only the menu option conditional logic: Display option only when Ocean Sticky Header active.

### _2022.11.9_ - 3.3.6
- **Added**: Header: Full Screen Header: Customizer Settings: Icon size for the Hamburger menu.
- **Added**: Filter: Comment Date: ocean_comment_date_format.
- **Added**: Filter: Infinite Scroll: oceanwp_infinite_scroll_output.
- **Added**: Filter: Post date format: ocean_get_post_date_format.
- **Added**: Filter: Post date arguments: ocean_get_post_date_args.
- **Added**: Filter: Modified date format: ocean_get_post_modified_date_format.
- **Added**: WooCommerce: Store Notice: Style and Typography options.
- **Moved**: Customizer: Disable svg icon option from General Options > Theme Icons to General Options > Performance tab.
- **Fixed**: WooCommerce: Product Archive: Product hover style: Products image from the gallery aren't cropped.
- **Fixed**: WooCommerce: Product Archive: Infinite Scroll: Uncaught DOMException: Failed to execute 'querySelectorAll' on 'Document'.
- **Fixed**: WooCommerce: Product Archive: Active color settings not applied for the second view products option.
- **Fixed**: WooCommerce: Multistep Checkout: Next and prev buttons are not working.
- **Fixed**: WooCommerce: Multistep Checkout: On the next step, the page doesn't scroll to top.
- **Fixed**: WooCommerce: Customizer: Star Color: Live preview for star color rating doesn't function.
- **Fixed**: Blog: Single Post: Comment Date: The date format for comments doesn't follow general website settings.
- **Fixed**: Blog: Single Post: Header Style: Screen: Mobile typography settings not applied.
- **Fixed**: Customizer: Typography: Host Google fonts locally options displayed when Ocean Extra not installed.
- **Fixed**: Customizer: Typography: Font subset selection doesn't function.
- **Fixed**: Customizer: Typography: Font subset selection doesn't save.
- **Fixed**: Customizer: Settings not saved in the custom-style.css file when Custom Location option enabled.
- **Fixed**: Compatibility: Germanized for WooCommerce: Shopmarks position and display based on settings.
- **Fixed**: Compatibility: Woo Variation Swatches: Images cropping settings not applied when this plugin is in use.


### _2022.09.14_ - 3.3.5
- **Added**: Filter: Single Post: ocean_single_author_bio_title_tag.
- **Added**: Filter: Single Post: ocean_single_related_post_title_tag.
- **Fixed**: WooCommerce 6.9 compatibility patch: Fatal error: Uncaught TypeError: array_filter(): Argument #1 ($array) must be of type array.
- **Fixed**: WooCommerce: Product Archive: Results Count: Active color settings not applied for the second view option.

### _2022.08.09_ - 3.3.4
- **NEW**: Admin Settings section in OceanWP Panel.
- **Added**: Social Menu for Header and Top Bar: Discord option.
- **Tweak**: Option to install OceanWP Child Theme moved to Ocean Extra plugin.
- **Tweak**: Typography: Host Google Fonts locally option moved to Ocean Extra plugin.
- **Tweak**: Typography: Default OceanWP front-end font changed to Arial following WordPress GDPR recommendations.
- **Fixed**: Mobile Search Icon: Search on tablet and mobile not responding #389
- **Removed**: HTML5 dependencies for IE8.

### _2022.06.14_ - 3.3.3
- **Added**: Accessibility: WooCommerce: Single Product: Aria labels for product navigation.
- **Added**: Accessibility: WooCommerce: Single Product: Related Products: Aria label for product quick view.
- **Added**: Accessibility: WooCommerce: Product Archive: Aria label for product quick view.
- **Fixed**: Blog: Single Post: Page Header: Incorrect author and author avatar url.
- **Fixed**: My Library: Custom Template: dynamic  blocks not rendering in custom template.
- **Fixed**: Compatibility: Visual Composer: tabs and accordion don't function.
- **Fixed**: Shortcode: [oceanwp_icon]: some icons are not appearing when using the icons shortcode.
- **Fixed**: Mobile Header: Mobile Search Icon: Uncaught TypeError when mobile search option is disabled.
- **Fixed**: Customizer: Responsive Buttons Positions.
- **Updated**: Template: woocommerce/owp-archive-hover.php.

### _2022.06.1_ - 3.3.2
- **Fixed**: Custom Templates: Conditional logic for Elementor plugin causing Fatal Error.

### _2022.06.1._ - 3.3.1
- **Fixed**: Notice: "We made changes to our theme panel" cannot be dismissed if child theme in use.
- **Fixed**: Custom Templates: Content display issues when templates used on Elementor pages.
- **Fixed**: Compatibility: Klaviyo: PHP Fatal error: Cannot redeclare get_options().
- **Fixed**: Compatibility: AMP: menu dropdowns do not function.
- **Fixed**: Warning: Cannot modify header information - headers already sent by... oceanwp/inc/helpers.php.4904

### _2022.05.25_ - 3.3.0
- **New**: OceanWP Theme Panel
- **Added**: WooCommerce: Menu Cart: checkout button border color settings in the Customizer.
- **Updated**: OceanWP About URI.
- **Fixed**: Top Bar: extra bottom margin on the wrapper.
- **Fixed**: Header: Minimal Header style padding affecting other header styles (inner padding).
- **Fixed**: Blog: Single Post: Comments: previous comment option not working.
- **Fixed**: My Library: custom template render issues with custom locations.
- **Fixed**: WooCommerce: Product Archive: Add to Wishlist button display issue.
- **Fixed**: WooCommerce: Product Archive: Hover Style: Add to Cart button text not changing after adding the product to the cart.
- **Fixed**: WooCommerce: Off-Canvas Filter: display issues with Transparent Header style.
- **Removed**: WooCommerce: Search Results Page: product number display option.
- **Removed**: Outdated non-standard CSS #349

### _2022.05.02_ - 3.2.2
- **Added**: Accessibility: Buttons: focus option.
- **Added**: Accessibility: Header: Mega Menu.
- **Improved**: Accessibility: Skip to Content functionality.
- **Fixed**: Accessibility: Header: Menu: focus outline missing.
- **Fixed**: PHP 7.2 Compatibility.
- **Fixed**: Blog: Single Post: New Post Title Styles: Double author name in some occasions.
- **Modified**: Template: woocommerce/mini-cart
- **Added**: Filter: Mini Cart: oceanwp_mini_cart_shop_link.
- **Fixed**: Customizer: Typography: Chosen font always displaying the Default option in the select menu after saving changes.

### _2022.03.31_ - 3.2.1
- **Improved**: Accessibility: Mobile icon.
- **Updated**: Templates: partials/mobile/mobile icon.
- **Fixed**: Blog: Single Post: Post Title Cover Style: Featured image not displayed on boxed website layout.
- **Fixed**: Blog: Single Post: New Post Title Styles: Author avatar image not displayed.
- **Added**: Blog: Single Post: Post Title Cover Style: color overlay settings.

### _2022.03.30_ - 3.2.0

- **New**: Blog: Single Post: Page Title Styles: Intro, Cover, Card, Card Invert, Screen and Screen Invert.
- **New**: Blog: Single Post: Comments: Delete comment option. Available on frontend and visible to admins only.
- **New**: Blog: Blog Entries: Edit post button. Visible to admins only.
- **New**: Template: partials/single/headers/header-2
- **New**: Template: partials/single/headers/header-3
- **New**: Template: partials/single/headers/header-4
- **New**: Template: partials/single/headers/header-5
- **New**: Template: partials/single/headers/header-6
- **New**: Template: partials/single/headers/header-7
- **New**: Template: partials/single/metas/meta-2
- **New**: Template: partials/single/metas/meta-3
- **New**: Template: partials/single/metas/meta-4
- **New**: Typography: Host Google fonts locally via Customize > Typography > General. No font upload required.
- **Fixed**: Header: Vertical Style: Dropdown options not displayed.

### _2022.03.07_ - 3.1.4

-   **Fixed** Logo: Retinal Logo: display issue.
-   **Fixed** WooCommerce: Checkout: Multi-Step Checkout: guest checkout issue.
-   **Fixed** Customizer: Color settings missing localize script.
-   **Improved** Script performance

### _2022.02.02_ - 3.1.3

-   **Fixed** Customizer: Missing Typography Class.
-   **Fixed** Customizer: Font assets loading on front end.
-   **Fixed** Customizer: Color settings missing localize script.
-   **Fixed** Header: Mobile Menu link not crawlable.
-   **Fixed** Blog: Meta: Reading time displaying 1min for languages using non-alphabetic characters.
-   **Fixed** WooCommerce: Checkout: Header disabled in full on distraction-free mode.
-   **Fixed** WooCommerce: Checkout: Mandatory fields skipped.
-   **Fixed** Gutenberg: Layout: Full Width Style issue.

### _2021.11.30_ - 3.1.2

-   **Fixed** Some minor issues.

### _2021.11.17_ - 3.1.1

-   **Fixed** Header: submenu display issue.
-   **Fixed** Fatal Error: WP_Customize_Section not found.
-   **Fixed** Some PHP notices.

### _2021.11.10_ - 3.1.0

-   **New** - Customizer: Customizer Search.
-   **Updated** - Customizer: Styling and scripts.
-   **Improved** - Customizer: Loading time and performance.
-   **Fixed** - Header: Menu Dropdown: display on hover issue.
-   **Fixed** - Header: Mobile Menu: Sidebar style: Anchor links issue.
-   **Fixed** - Header: Mobile Menu: Sidebar style: JS issue when menu closing button disabled.
-   **Fixed** - Blog: Single Post: Page width issue.
-   **Fixed** - Blog: Pagination: Infinite scroll on archive pages issue.
-   **Fixed** - WooCommerce: Archives: Quantity buttons not displayed on infinite scroll pagination.
-   **Fixed** - Compatibility: WPML: Currency switcher on WooCommerce product Quick View.
-   **Fixed** - Compatibility: Kadence WooCommerce Email Designer issue.
-   **Fixed** - Compatibility: Elementor Pro: Modal Popup.
-   **Fixed** - Compatibility: Elementor Pro: Floating bar and variable products issue on mobile devices for custom product pages.
-   **Fixed** - Compatibility: Elementor Pro: Smooth Scroll conflict issue.
-   **Fixed** - Compatibility: BuddyPress: Comment box issue.
-   **Fixed** - Compatibility: Woo Variation Swatches Pro: variation button resets on add to cart issue.

### _2021.09.07_ - 3.0.7

-   **Fixed** - Scripts: load issue.

### _2021.09.06_ - 3.0.6

-   **Fixed** - Header: anchor link animation issue on double-click.
-   **Fixed** - Header: Dropdowns and Mega Menu: Flicker on repetitive or longer hover.
-   **Fixed** - Mobile Menu: Full Screen style: custom links navigation issue.
-   **Fixed** - Blog: Entries: page jump on scroll when equal heights condition in use.
-   **Fixed** - WooCommerce: Floating Bar: display on Elementor single product custom templates.
-   **Fixed** - WooCommerce: Floting Bar: scroll to anchor link offset.
-   **Fixed** - WooCommerce: Checkout: Double quantity buttons.
-   **Fixed** - Compatibility: WooCommerce: Categories widget: missing closing span tag.
-   **Fixed** - Compatibility: TI WooCommerce Wishlist: quantity buttons.
-   **Fixed** - Compatibility: Classic Editor: Video responsiveness.
-   **Fixed** - Deprecated PhotoSwipe script: removed redundandt HTML.
-   **Fixed** - Filter links: active style.
-   **Fixed** - Minor issues.

### _2021.08.25_ - 3.0.5

-   **Tweak** - PhotoSwipe replaced with Magnific Popup.
-   **Fixed** - Compatibility: Ocean Sticky Header: Shrink style: logo height on scroll back.
-   **Fixed** - Compatibility: Ocean Stick Anything: Header: offset.
-   **Fixed** - Compatibility: TI WooCommerce Wishlist: qunatity buttons.
-   **Fixed** - WooCommerce: Reduce Ajax requests.

### _2021.08.19_ - 3.0.4

-   **Added** - Performance: Option to disable WordPress emoji script.
-   **Improved** - WooCommerce: Add to Cart option on iPhones: removed the double-click.
-   **Fixed** - Mobile Header: Dropdown Style: transition on open.
-   **Fixed** - Mobile Header: Sidebar Style: fourth-level dropdown doesn't function.
-   **Fixed** - Mobile Header: Mobile menu doesn't function if menu created using the nav shortcode or nav widget from Ocean Elementor Widgets.
-   **Fixed** - Menu: Walker: Warnings related to PHP 8+ version.
-   **Fixed** - Footer: Position: on pages with none or little content, footer doesn't stick to the bottom of the screen.
-   **Fixed** - PhotoSwipe Lightbox: image stretched on full preview.
-   **Fixed** - Scroll to Top: button transition on appear/disappear.
-   **Fixed** - Gutenberg: Blocks: YouTube embed backend and front-end styling issues.
-   **Fixed** - Gutenberg: Blocks: Full Width layout issues.
-   **Fixed** - WooCommerce: Single Product: Ajax Add to Cart issues.
-   **Fixed** - WooCommerce: Cart: changing quantity makes quantity buttons disappear.
-   **Fixed** - WooCommerce: Cart: update + refresh cause increase of the quantity by 2 instead of 1 on new product add.
-   **Fixed** - Compatibility: WooCommerce Product Addons plugin issues.
-   **Fixed** - Compatibility: Variation Swatches for WooCommerce plugin issues.
-   **Fixed** - Compatibility: Elementor: anchor link issues.
-   **Fixed** - Compatibility: Elementor Pro: product widgets: WooCommerce infinite-scroll pagination issues.
-   **Fixed** - Compatibility: WPBakery: tab & accordion shortcodes, anchor link and comment button issues.

### _2021.07.28_ - 3.0.3

-   **Added** - Performance section in Customizer > General Options.
-   **Fixed** - Lightbox issues.
-   **Fixed** - Compatibility issue: Photo Gallery by Supsystic.
-   **Fixed** - Compatibility issue: YITH WooCommerce Zoom Magnifier.
-   **Fixed** - Customizer: Range slider control.
-   **Fixed** - Gutenberg: Embeds widgets issue.
-   **Fixed** - Mobile Menu: Third-level dropdown menu issue.
-   **Fixed** - WooCommerce: Multi-Step checkout display issues in Safari and iPhone.
-   **Fixed** - Pagination: Infinite Scroll issue.
-   **Fixed** - Minor issues.

### _2021.07.22_ - 3.0.2

-   **Fixed** - Gutenberg embeds widgets issue.

### _2021.07.21_ - 3.0.1

-   **Fixed** - PHP errors in admin panel (Widgets page)

### _2021.07.20_ - 3.0.0

-   **Added** - Vanilla JS.
-   **Added** - Mobile Header: search icon, default state disabled. Customize > Header > Mobile Menu, section Mobile Header Search.
-   **Added** - Single Blog Post: 'ocean_single_modified_date_state' filter. Disable display of modifided date if the same as the published date. Default state false.
-   **Added** - Single Blog Post: 'ocean_related_posts_date' filter. Disable display of published date on related post items. Default state true.
-   **Added** - WooCommerce: 'ocean_floating_bar_h_tag' filter. Change Floating Bar heading tag. Default value h2.
-   **Added** - SEO Settings: Customize > General Options > SEO Settings.
-   **Improved** - Accessibility: Mobile menu search form.
-   **Improved** - Accessibility: Scroll to top.
-   **Improved** - Accessibility: Header Replace search form style.
-   **Improved** - Accessibility: Header Overlay search form style.
-   **Improved** - Accessibility: Link Post Format, both entry and single.
-   **Improved** - Accessibility: Blog Entry: Blog post titles.
-   **Improved** - Accessibility: Blog Entry: Featured image.
-   **Improved** - Accessibility: Blog Entry: Continue Reading option.
-   **Improved** - Accessibility: Single Blog Post: Related Posts title.
-   **Improved** - Accessibility: Single Blog Post: Author avatar.
-   **Improved** - Accessibility: Post Categories Mega Menu.
-   **Updated** - Template: partials/entry/readmore.php
-   **Updated** - Template: partials/entry/media/blog-entry.php
-   **Updated** - Template: partials/entry/media/blog-entry-link.php
-   **Updated** - Template: partials/single/media/blog-single.php
-   **Updated** - Template: partials/single/media/blog-single-link.php
-   **Updated** - Template: partials/single/related-posts.php
-   **Updated** - Template: partials/single/author-bio.php
-   **Updated** - Template: partials/single/layout.php
-   **Updated** - Template: partials/single/meta.php
-   **Updated** - Template: partials/header/search-overlay.php
-   **Updated** - Template: partials/header/search-replace.php
-   **Updated** - Template: partials/mobile/mobile-search.php
-   **Updated** - Template: partials/scroll-top.php
-   **Fixed** - Previous item navigation arrow icon class.

### _2021.06.23_ - 2.1.1

-   **Added** - New icons added in theme icon array.
-   **Tweak** - Function 'oceanwp_title' has been renamed to 'oceanwp_has_page_title'.
-   **Fixed** - Header: Full Screen style dropdown icon issue.
-   **Fixed** - PHP Deprecated: Required parameter $output follows optional parameter $depth in menu-walker.

### _2021.06.11_ - 2.1.0

-   **Added** - Check if icon class exist or not from theme icons.
-   **Tweak** - Default Theme Icon settings set to "Simple Line Icons" to prevent issues on websites that did not store any theme icons settings in the past.
-   **Tweak** - Ocean SVG Icons disabled by default. In order to use the new icons, enable them via Customize > General Options > Theme Icons
-   **Fixed** - Icons that require manual selection get deselect on Theme icons change

### _2021.06.09_ - 2.0.9

-   **Added** - OceanWP SVG icons - will be set as default icons on all new installations. Perform icons switch via Customize > General Options > Theme Icons.
-   **Added** - Options for established websites to use the new icon pack via Customize > General Options > Theme Icons.
-   **Added** - New customizer control to support SVG Icons.
-   **Added** - Enable support for SVG logo type.
-   **Added** - Social option: Telegram, Twitch, Line, QQ
-   **Fixed** - WooCommerce: Multistep checkout issue upon using the Create Account option on.
-   **Fixed** - WooCommerce: Number of products displayed between 768px and 959px screen widths.
-   **Fixed** - WooCommerce: Long Variation Names Overflowing #328
-   **Fixed** - WooCommerce: Fixed fatal error on product page #327
-   **Fixed** - Replaced slick-slide class with swiper-slide.
-   **Fixed** - Gutenberg: layout issue with block alignfull and alignwide.

### _2021.04.26_ - 2.0.8

-   **Fixed** - Page title displayed with old setting.

### _2021.04.16_ - 2.0.7

-   **Moved** - Customizer hide page title setting to the visibility setting section.
-   **Fixed** - Multistep checkout undefined error notice.

### _2021.04.14_ - 2.0.6

-   **Fixed** - Gutenberg: cover block layout issue.
-   **Fixed** - Outdated woocommerce template error notice.

### _2021.04.13_ - 2.0.5

-   **Fixed** - Gutenberg: list block backend layout issue.
-   **Fixed** - Youtube short link doesn't work to embed video in post.
-   **Fixed** - Multi-step checkout does not validate fields before clicking next button #315
-   **Fixed** - Block column layout with full-width page layout.
-   **Fixed** - Block editor post title input style.
-   **Fixed** - Call to a member function is_block_editor() on null.

### _2021.03.25_ - 2.0.4

-   **Added** - Added Gutenberg support to match the backend editor with frontend.
-   **Fixed** - Styling for some Gutenberg blocks like table, blockquote etc.

### _2021.03.08_ - 2.0.3

-   **Fixed** - Multistep checkout issue.
-   **Fixed** - WPML translation issue.

### _2020.12.17_ - 2.0.2

-   **Added** - Link underlined style removed from the elementor and woocommerce pages.

### _2020.12.16_ - 2.0.1

-   **Added** - Heading tag option in the Customizer: Sidebar and Footer widget title.
-   **Added** - Content links underlined per WordPress accessibility requirements.
-   **Tweak** - Default Body text color altered for increased contrast & accessibility requirements.
-   **Fixed** - WooCommerce: Menu Icon Cart Count style missing.
-   **Fixed** - WooCommerce: Multistep-checkout form submission error.
-   **Added** - WooCommerce: Filter 'ocean_product_archive_title_tag' to alter the title tag in shop loop.

### _2020.11.17_ - 2.0.0

-   **Added** - Hook: ocean_after_archive_product_price;
-   **Added** - Option to choose default theme icons: General Options > Theme Icons.
-   **Added** - Blog: Post entries & single post meta icons color options - General Options > Theme Icons.
-   **Added** - Blog: Post entries & single post meta separator style - Blog > Blog Entries & Blog > Single Post.
-   **Added** - WooCommerce: Product archive show/hide price and 'Add to Cart' button option.
-   **Added** - WooCommerce: Product archive show/hide price and 'Add to Cart' button message display (optional).
-   **Added** - WooCommerce: Product archive show/hide price and 'Add to Cart' button message typography settings.
-   **Added** - WooCommerce: Product archive show/hide price and 'Add to Cart' button message color styling settings.
-   **Added** - WooCommerce: Product archive - option to include 'My Account' link into the conditional message.
-   **Added** - WooCommerce: Product archive disable/enable image and title links option.
-   **Added** - WooCommerce: Product archive disable/enable image and title links conditional logic.
-   **Added** - WooCommerce: Single product show/hide price and 'Add to Cart' button option.
-   **Added** - WooCommerce: Single product show/hide price and 'Add to Cart' button message display (optional).
-   **Added** - WooCommerce: Single product show/hide price and 'Add to Cart' button message typography settings.
-   **Added** - WooCommerce: Single product show/hide price and 'Add to Cart' button message color styling settings.
-   **Added** - WooCommerce: Single product - option to include 'My Account' link into the conditional message.
-   **Added** - WooCommerce: Product archive title typography settings.
-   **Added** - WooCommerce: Product archive category typography settings.
-   **Added** - WooCommerce: Product archive price typography settings.
-   **Added** - WooCommerce: Single product 'Add to Cart' typography settings.
-   **Added** - WooCommerce: Floating Bar - product title limited to 4 words to avoid responsiveness issues.
-   **Added** - WooCommerce: Floating Bar - display 'Add to Cart' button on 320px width.
-   **Added** - WooCommerce: Improved 'Sales!' badge responsiveness.
-   **Added** - WooCommerce: Cart - product price on mobile devices.
-   **Added** - WooCommerce Germanized: Product archive & single product - product price unit support.
-   **Added** - WooCommerce Germanized: Product archive & single product - product units support.
-   **Added** - WooCommerce Germanized: Product archive & single product - product legal info support.
-   **Added** - WooCommerce Germanized: Product archive & single product - product delivery time info.
-   **Added** - YITH WooCommerce Wishlist plugin support.
-   **Added** - Speed Optimization: Display Swap: Google Fonts, woo star font, Font Awesome 5 icons, Simple Line icons, slick buttons.
-   **Added** - Translation string: Close mobile menu - 'owp-string-close-mobile-menu".
-   **Added** - Translation string: Mobile search - 'owp-string-mobile-search'.
-   **Added** - Translation string: Mobile submit search query - 'owp-string-mobile-submit-search'.
-   **Added** - Social Menu Options: TikTok & Medium.
-   **Tweak** - WooCommerce: Product archive rating separated from price as an individual element.
-   **Tweak** - WooCommerce: SEO Improvement - product title set to H2 tag.
-   **Tweak** - WooCommerce: Improved 'My Account' login page style.
-   **Tweak** - Blog: Post entries & single post meta data styling.
-   **Tweak** - Blog: Sinlge Post Author Bio tag changed to H3 for Accessibility & SEO improvement.
-   **Tweak** - Customizer Loading Optimization: WooCommerce typography live preview scripts separated from main script.
-   **Tweak** - Customizer Loading Optimization: WooCommerce style live preview scripts separated from main script.
-   **Tweak** - Customizer Loading Optimization: EDD style live preview script separated from main script.
-   **Tweak** - Customizer Loading Optimization: LifterLMS style live preview script separated from main script.
-   **Tweak** - Customizer Loading Optimization: LearnDash style live preview script separated from main script.
-   **Fixed** - WooCommerce: Mixed up translation filters for Next/Prev product navigation.
-   **Fixed** - WooCommerce: Incorrect single product Next/Prev nav - next nav displaying previous product & vice versa.
-   **Fixed** - WooCommerce: Floating Bar - blank space below footer on 320px width and less.
-   **Fixed** - WooCommerce: Floating Bar - responsiveness issues.
-   **Fixed** - WooCommerce: Single product missing 'has-product-nav' class when navigation enabled.
-   **Fixed** - WooCommerce: Product archive 'Add to Cart' typography settings declared as single 'Add to Cart' typography settings.
-   **Fixed** - WooCommerce: Single product - next/prev RTL arrows.
-   **Fixed** - WooCommerce: Cart shipping methods layout.
-   **Fixed** - WooCommerce: Checkout shipping methods layout.
-   **Fixed** - WooCommerce: RTL - 'Update Cart' button position.
-   **Fixed** - WooCommerce: RTL - pagination arrows.
-   **Fixed** - WooCommerce: Cart responsiveness.
-   **Fixed** - WooCommerce: Fatal error - Call to a member function get_cart_contents_count () on null
-   **Fixed** - Blog: Post entries - grid layout fit-rows style issue - skipped space even when containers equal height.
-   **Fixed** - Blog: Single post - next/prev RTL arrows.
-   **Fixed** - Minor RTL style issues.
-   **Updated** - Font Awesome 5.15.1 version.

### _2020.09.30_ - 1.9.0

-   **Updated** - Freemius Bundle activation.

### _2020.09.14_ - 1.8.9:

-   **Fixed** - Keyboard navigation improvement for mobile menu.

### _2020.09.09_ - 1.8.8:

-   **Added** - PWA ( Progressive Web App ) support for theme.
-   **Fixed** - Font size for Skip to content text.
-   **Fixed** - Header text color doesn't work.
-   **Fixed** - Adding a custom logo and removing it will make the text logo (and description) disappear aswell.
-   **Fixed** - Accessibility improvement for mobile menu.

### _2020.08.19_ - 1.8.7:

-   **Added** - AMP support for theme.
-   **Fixed** - Blog grid layout issue.
-   **Fixed** - Outdated copies of some WooCommerce template files.

### _2020.07.09_ - 1.8.6:

-   **Fixed** - WooCommerce product gallery slider style image issue.
-   **Fixed** - Single blog post navigation text issue.
-   **Fixed** - WooCommerce list view star rating alignment.
-   **Added** - Separate filters for string translation.
-   **Added** - Skip link text - 'ocean_header_skip_link'
-   **Added** - Search field placeholder - 'ocean_search_text'
-   **Added** - Mobile search field placeholder - 'ocean_mobile_search_text'
-   **Added** - Mobile full screen search placeholder - 'ocean_mobile_fs_search_text'
-   **Added** - Header replace search placeholder - 'ocean_header_replace_search_text'
-   **Added** - Header search overlay placeholder - 'ocean_search_overlay_search_text'
-   **Added** - Vertical header search placeholder - 'ocean_vertical_header_search_text'
-   **Added** - Medium header search placeholder - 'ocean_medium_header_search_text'
-   **Added** - Comment logout - 'ocean_comment_logout_text'
-   **Added** - Comment placeholder - 'ocean_comment_placeholder'
-   **Added** - Comment Profile - 'ocean_comment_profile_edit'
-   **Added** - Comment Post button - 'ocean_comment_post_button'
-   **Added** - Comment name required - 'ocean_comment_name_req'
-   **Added** - Comment email required - 'ocean_comment_email_req'
-   **Added** - Comment name - 'ocean_comment_name'
-   **Added** - Comment email - 'ocean_comment_email'
-   **Added** - Comment website - 'ocean_comment_website'
-   **Added** - Search result page continue reading - 'ocean_search_continue_reading'
-   **Added** - Post continue reading - 'ocean_post_continue_reading'
-   **Added** - Single related post - 'ocean_single_related_posts'
-   **Added** - Single next post - 'ocean_single_next_post'
-   **Added** - Single previous post - 'ocean_single_prev_post'
-   **Added** - Single screen reader Read more text - 'ocean_single_screen_reader_rm'
-   **Added** - Woo quick view text - 'ocean_woo_quick_view_text'
-   **Added** - Woo quick view close text - 'ocean_woo_quick_view_close'
-   **Added** - Woo floating bar button - 'ocean_woo_floating_bar_select_btn'
-   **Added** - Woo flating bar selected - 'ocean_woo_floating_bar_selected'
-   **Added** - Woo floating bar out of stock - 'ocean_woo_floating_bar_out_stock'

### _2020.07.07_ - 1.8.5:

-   **Fixed** - Padding issue on mobile view.
-   **Fixed** - Improved translation.
-   **Added** - filter to handle the translation 'oceanwp_theme_strings'.
-   **Removed** - filter 'ocean_search_text'.
-   **Removed** - filter 'ocean_search_readmore_link_text'.
-   **Removed** - filter 'ocean_post_readmore_link_text'
-   **Removed** - filter 'ocean_mobile_searchform_placeholder'
-   **Removed** - filter 'ocean_header_replace_search_text'
-   **Removed** - filter 'ocean_overlay_search_text'
-   **Removed** - filter 'ocean_related_posts_title'
-   **Removed** - filter 'ocean_floating_bar_select_text'

### _2020.07.06_ - 1.8.4:

-   **Fixed** - Ajax 'add to cart' compatibility with variations, product-addons, composite product etc.
-   **Fixed** - 'Skip to content' link displayed after disabling CSS file.
-   **Fixed** - Coding standards in accordance with WordPress Coding Standards.
-   **Fixed** - Code optimized for speed improvements.
-   **Fixed** - Undefined variable $theme_version on menu settings page.
-   **Fixed** - Undefined variable $vh_width_minus when using vertical header.
-   **Fixed** - Woocommerce product quantity selector bug.
-   **Fixed** - Woocommerce product quantity selector bug on floating cart element.
-   **Fixed** - Woocommerce product quantity selector bug on qucik view.
-   **Fixed** - Get product image ID using product method #280
-   **Fixed** - Comment pingback schema markup error.
-   **Fixed** - Customizer not loading - Uncaught TypeError: data.value.indexOf is not a function.
-   **Fixed** - Woocommerce 'Apply Coupon' button layout issue in mobile view.
-   **Fixed** - Translation issues - translation not reflected on the front end: search widget, related posts title, header search overlay, header replace search, next/previous post.
-   **Fixed** - 404 page #content-wrap syntax error.
-   **Added** - Filters to replace default text (for child theming): search widget/search dropdown, header search overlay, header replace search.
-   **Fixed** - Comment form name and email placeholder text always displaying as required.
-   **Added** - Improved accessibility on the comments section.
-   **Added** - Meta 'Reading Time': single blog post and blog post entries.
-   **Added** - 'Date' taxonomy for Next/Prev single blog post navigation.
-   **Added** - Option to set the comment form position before or after the comment list.

### _2020.05.13_ - 1.8.3:

-   **Fixed** - WooCommerce Grid List button.
-   **Fixed** - cookie.js is not defined when shop page set as home page.
-   **Fixed** - Duplicate custom menu fields with WP5.4.
-   **Fixed** - Missing BuddyPress Icons.
-   **Fixed** - OceanWP javascripts won't execute on fast pages #241
-   **Fixed** - Trying to get property 'post_content' of non-object
-   **Fixed** - Trying to get property 'ID' of non-object
-   **Fixed** - select2.js conflcit with TutorLMS, LearnDash and LearnPress plugin
-   **Added** - Backward compatibility for wp_body_open().

### _2020.04.01_ - 1.8.2:

-   **Fixed** - Mobile Menu doesn't work with sticky header.
-   **Fixed** - Attibute Archives dont work result count #252

### _2020.03.27_ - 1.8.1:

-   **Fixed** - Mobile Menu error.

### _2020.03.26_ - 1.8.0:

-   **Fixed** - Homepage title override #196
-   **Fixed** - Topbar covers the sidebar menu style when open.
-   **Fixed** - Sidebar menu style is not working with other header styles.
-   **Fixed** - Categories shown on product listing grid view not constrained #211
-   **Fixed** - Huge space on Youtube video emabeding

### _2020.03.23_ - 1.7.9:

-   **Added** - Improved keyboard navigation for Accessibility.
-   **Added** - Improved Accessibility - aria labels and screen reader text, especially for Top Bar and Header social menus.
-   **Added** - Modified Date option with Schema Markup: Blog entries & single posts.
-   **Added** - SEO Improvement - comment author link tag changed from H3 to span.
-   **Fixed** - Keyboard navigation for the Mobile Menu.
-   **Fixed** - Default dropdown target for the Mobile Menu set to 'Link' instead of 'Icon'.
-   **Fixed** - Mobile Menu covering the admin bar when logged in.
-   **Fixed** - DOM errors occuring due to default search forms not having unique IDs.
-   **Fixed** - Keyboard navigation for the comment section with screen reader text.
-   **Fixed** - Escaped placeholder text on the comment section.
-   **Updated** - Translation strings.
-   **Updated** - readme.txt file.

### _2020.03.10_ - 1.7.8:

-   **Added** - Improved Accessibility.
-   **Added** - Added hook after site title text in the header.
-   **Added** - Added hook wp_body_open() after the body tag.
-   **Fixed** - Fatal error when using filter woommerce_add_to_cart_redirect.
-   **Fixed** - Customizer Header Text Color setting when Ocean Extra is disabled.
-   **Fixed** - Improved the usage of escaping functions.
-   **Updated** - readme.txt file.

### _2020.02.28_ - 1.7.7:

-   **Added** - Updated credit links for images used in theme screenshot in readme.txt file.

### _2020.02.27_ - 1.7.6:

-   **Added** - Changed theme screesnhot.
-   **Fixed** - Reversed sequence of hierarchical taxonomy breadcrumbs.

### _2020.02.20_ - 1.7.5:

-   **Added** - Filter 'oceanwp_excerpt' to output the excerpt.
-   **Fixed** - Checkout order summary layout for mobile view.
-   **Fixed** - HTML is escaped in featured image caption #210
-   **Fixed** - customSelect dropdown layout error
-   **Fixed** - Fix product quantities syncing incorrectly for Mix and Match products #251
-   **Fixed** - Breadcrumbs.php get_day_links error #191
-   **Fixed** - Fatal error: Uncaught Error: Call to undefined function is_plugin_active() in helper.php #253
-   **Fixed** - WooCommerce Cart Page 'select' width issue on calculate shipping
-   **Fixed** - Gutenberg Code Block Not Within Set Margins
-   **Fixed** - Display site title and tagline issue in the customiser
-   **Added** - Enable theme support for custom background
-   **Added** - Incorrect double slash #255
-   **Added** - Accessibility Improvement - Added 'aria-hidden' labels to: top bar and header social menu; blog single and archive post meta;
-   **Added** - SEO Improvement: Added "noopener noreferrer" tags for top bar and header social menus when links open in a new window.
-   **Added** - Schema Markup Improvement: Schema markup for blog, blog archives and tags, and articles.
-   **Tweak** - Schema Markup: Main itemtype moved to body.
-   **Updated** - Dutch translation, thanks to Annie Bohets
-   **Updated** - README.md file

### _2020.01.06_ - 1.7.4:

-   **Updated** - readme.txt to reflect credit changes.
-   **Fixed** - XFN 1.1 relationships meta data profile.
-   **Fixed** - Wrong Yoast breadcrumbs syntax.
-   **Tweak** - Gutenberg editor: font size increased; default paragraph font color darkened.
-   **Fixed** - Font Awesome 5: issues with check boxes and radio buttons.
-   **Fixed** - Gutenberg editor: table not within assigned page/post margins.
-   **Tweak** - WooCommerce product variations available within the cart.
-   **Tweak** - WooCommerce product variations available on Quick View.
-   **Fixed** - WooCommerce Product Addons with Ajax "Add to Cart" feature for the Single Product Page and Quick View.
-   **Fixed** - WPML Search: compatibility issue.
-   **Fixed** - Gutenberg editor: links having the same style as paragraphs.
-   **Fixed** - WooCommerce "My Account" page responsive design issues: "Order" and "Download" sections.
-   **Fixed** - WooCommerce UL responsive design issues.

### _2019.11.13_ - 1.7.3:

-   **Fixed** - Broken icon issue.

### _2019.10.30_ - 1.7.2:

-   **Fixed** - Use WooCommerce product object functions.
-   **Fixed** - Updated sidr.js to latest version.
-   **Fixed** - Rank Math SEO Breadcrumb issue.
-   **Added** - Updated to FontAwesome-5 to fix the version conflict.
-   **Fixed** - Searchform compatibility with WPML.
-   **Added** - Updated version number and changelog.

### _2019.08.18_ - 1.7.1:

-   **Fixed** - WooCommerce outdated file.

### _2019.08.18_ - 1.7.0:

-   **Added** - Get theme ready for the Freemius switch.

### _2019.08.04_ - 1.6.10:

-   **Added** - Codes for Freemius update.

### _2019.08.04_ - 1.6.9:

-   **Added** - Some codes for the upcoming switch to Freemius.

### _2019.06.07_ - 1.6.8:

-   **Fixed** - WooCommerce issues.

### _2019.04.18_ - 1.6.7:

-   **Fixed** - Single product layout issue.

### _2019.04.17_ - 1.6.6:

-   **Updated** - WooCommerce file.

### _2019.04.17_ - 1.6.5:

-   **Added** - Rank Math breadcrumbs support.
-   **Added** - New Title Tag setting in the Single Product section of the customizer to allow you to choose which title tag you want for the single product titles.
-   **Added** - Farsi language, thanks a lot to Hossein Abedzadeh, from HamyarWP.com.
-   **Tweak** - Now if the Yoast SEO Breadcrumb is not enabled, the default theme breadcrumb is used.
-   **Tweak** - If the Display Cart When Product Added is enabled and you don’t use the Ocean Sticky Header plugin, an animation will go to the top of the page to show the cart.
-   **Fixed** - Issue on the second step of the multi-step checkout page.
-   **Fixed** - Breadcrumb SEO issue with markups.
-   **Fixed** - Undefined word on single related products.
-   **Fixed** - Issue on category product if the Hover Style is selected.
-   **Fixed** - JS issue with the SmoothScroll script.

### _2019.02.15_ - 1.6.4:

-   **Fixed** - Elementor header and footer CSS issue.

### _2019.01.30_ - 1.6.3:

-   **Fixed** - Elementor issue.

### _2019.01.30_ - 1.6.2:

-   **Removed** - Meta tags function, directly added into Ocean Extra.

### _2019.01.14_ - 1.6.1:

-   **Fixed** - Issue with Elementor.

### _2019.01.11_ - 1.6.0:

-   **Added** - New style for the WooCommerce products.
-   **Added** - New settings Mobile Sidebar Order that allow you to add your sidebar before the content on tablet and mobile view.
-   **Added** - New settings to customize the single product Add To Cart button.
-   **Added** - New setting in the WooCommerce section of the customizer to allow you to remove all custom features added in the theme for WooCommerce, so you will be able to add your custom features or to make all WooCommerce plugins compatible with OceanWP.
-   **Added** - New setting for the Scroll Up button to position it.
-   **Added** - Close button for the Off Canvas sidebar feature of Woocommerce.
-   **Tweak** - The breadcrumb has been greatly improved. You can now add your own separator, choose to display a home text instead of the home icon, you can choose to display an item category, tag or parent page for your posts, products and portfolio pages, and more.
-   **Tweak** - WooCommerce categories widget improved, when a sub category is selected, the parent dropdown category is opened.
-   **Fixed** - Reviews link on the Quick View popup.
-   **Fixed** - Issue with the tag cloud widget.
-   **Fixed** - Issue with the position on tablet and mobile for the Custom Header Nav widget.

### _2018.11.21_ - 1.5.32:

-   **Fixed** - White screen on a single product created with Elementor Pro.

### _2018.10.28_ - 1.5.31:

-   **Fixed** - Product quantity on single product issue if the floating bar was activated.
-   **Fixed** - UL and OL lists CSS issue in single post.

### _2018.10.26_ - 1.5.30:

-   **Fixed** - Customizer preview issue.
-   **Tweak** - Don't recommend WPForms if WPForms Pro is activated.

### _2018.10.23_ - 1.5.29:

-   **Added** - LearnDash integration.
-   **Tweak** - Updated WooCommerce mini cart template.
-   **Tweak** - Checkbox CSS issue with Elementor.

### _2018.10.08_ - 1.5.28:

-   **Added** - Filter to allow you to change the heading for the sidebar titles.
-   **Fixed** - Floating bar issue on IOS.
-   **Fixed** - Styling issue with WPForms.

### _2018.09.04_ - 1.5.27:

-   **Tweak** - Taxonomy description added before the content instead as subheading.
-   **Fixed** - Little issue in the elementor editor to make the text bold, italic, add a link, etc.. who was not selectable.
-   **Fixed** - WooCommerce grouped product issue with the quantity buttons when the floating bar is activated.
-   **Fixed** - WooCommerce grouped product issue with the add to cart button if ajax is activated.
-   **Fixed** - WooCommerce grouped product issue in the quick view.

### _2018.08.30_ - 1.5.26:

-   **Fixed** - Breadcrumb issue with the shortcode who was causing a fatal error.

### _2018.08.27_ - 1.5.25:

-   **Fixed** - Slick css issue when Elementor is used.

### _2018.08.27_ - 1.5.24:

-   **Added** - Danish translation, thanks to Henrik Leth.
-   **Fixed** - Slick icons missing when a script or style disabled.

### _2018.08.09_ - 1.5.23:

-   **Added** - Compatibility with YITH WooCommerce Badge Management Premium.
-   **Fixed** - Padding issue on mobile for the Separate layout style.
-   **Fixed** - Sidebar padding issue for the customizer setting.

### _2018.08.02_ - 1.5.22:

-   **Added** - Description for the product categories in List view.
-   **Tweak** - Better theme screenshot added.

### _2018.07.26_ - 1.5.21:

-   **Added** - SEOPRess breadcrumb if enabled.
-   **Added** - New setting for the scroll up button to allow you to place it in left or right.
-   **Added** - New setting to allow you to add the My Account login/register side by side.
-   **Tweak** - Improved style for the rating filter widget of WooCommerce.
-   **Tweak** - Product category description removed from the archive categories.
-   **Tweak** - Breadcrumb displayed on all screens.
-   **Fixed** - Sale badge if product navigation in responsive.
-   **Fixed** - Megamenu issue if the boxed layout is used.

### _2018.07.10_ - 1.5.20:

-   **Fixed** - Class 'Elementor\Plugin' not found in the woocommerce-config.php file.

### _2018.07.10_ - 1.5.19:

-   **Tweak** - The Hide cart if empty feature is improved now it is directly displayed instead of reloading the page.
-   **Tweak** - Scroll to timeline on the multi-step checkout when the next/prev button is clicked.
-   **Fixed** - Ajax issue if single product button disabled.
-   **Fixed** - Percentage issue on WooCommerce.
-   **Fixed** - Next/Previous product text in the wrong arrow for the product navigation.
-   **Fixed** - Issue with WooCommerce shortcodes in the Elementor editor, thanks to Josh Marom from the Elementor team.

### _2018.07.04_ - 1.5.18:

-   **Fixed** - Issue with sans serif fonts.

### _2018.07.04_ - 1.5.17:

-   **Added** - Full integration with LifterLMS.
-   **Added** - Ajax for the Multi-Step checkout fields, so when a required field is not filled in step one or two, it is not possible to go to the next step.
-   **Added** - New Widgets section in the Typography section of the customizer to allow you to change widgets typography.
-   **Tweak** - Better style for the single product reviews stars.
-   **Tweak** - Brackets added in font so no font errors.
-   **Tweak** - Next/Prev text added for the product navigation in responsive to better understanding.
-   **Fixed** - Product image issue with the grid/list view if image slider selected for the shop page.
-   **Fixed** - Quick View issue on mobile.
-   **Fixed** - Mobile menu target link if mobile menu selected.
-   **Fixed** - Ocean Demo Import plugin notice removed if Ocean Pro Demos is activated.
-   **Fixed** - Menu item description.
-   **Fixed** - Issue with the font family select in the customizer wehn The Event Calendar plugin is active.
-   **Fixed** - Tag description not displayed as subheading.
-   **Fixed** - FitVids doesn't work on infinite scroll.
-   **Fixed** - Issue with WooCommerce Stripe Payment Gateway plugin on the multi-step checkout.
-   **Fixed** - Issue with logo if Center or Full Screen header style and if you choose a different header style per page.

### _2018.06.03_ - 1.5.16:

-   **Added** - Easy Digital Downloads integration, check the new demo: https://book.oceanwp.org/
-   **Tweak** - Moved the WooCommerce Checkout settings in the OceanWP WooCommerce section in the customizer.
-   **Tweak** - The "Redirect to the cart page after successful addition" WooCommerce setting work now on the single product Ajax add to cart, the quick view and the floating bar.
-   **Fixed** - Ordered list in the product summary.
-   **Fixed** - Quick view button on the product image entry slider style.

### _2018.05.19_ - 1.5.15:

-   **Fixed** - Blog layout and pagination issue.

### _2018.05.17_ - 1.5.14:

-   **Added** - Text Color setting for the page tittle if the background image style is selected.
-   **Fixed** - Checkbox styling issue for the GDPR consent in the comments form.
-   **Fixed** - Color settings in the customizer that close on input click on the Safari browser.
-   **Fixed** - Quantity input issue on the cart page.

### _2018.04.24_ - 1.5.13:

-   **Fixed** - Quantity input issue with WooCommerce when the floating bar is enabled.
-   **Tweak** - Now the links works if you have sub menu for the Full Screen header style and Full Screen mobile menu style.

### _2018.04.20_ - 1.5.12:

-   **Fixed** - Issue with Elmentor Themer Builder if a page is selected as condition.
-   **Updated** - Isotope script.

### _2018.04.16_ - 1.5.11:

-   **Added** - Chinese translation, thanks to Liu Liu.
-   **Tweak** - Better approch for the header if you create a custom header with Elementor Pro 2.0, now the sticky will automatically work and the top bar too.
-   **Fixed** - Floating bar width on boxed layout.

### _2018.03.29_ - 1.5.10:

-   **Tweak** - Slider control replaced by a text control for the Font Size settings, you can now add a px-em-rem-%.
-   **Fixed** - OpenGraph is disabled by default to avoid any plugin conflict.

### _2018.03.27_ - 1.5.9:

-   **Fixed** - Logo issue on the Medium and Vertical header style if custom mobile header.
-   **Fixed** - Hamburger icon missing on the Vertical header style if a template is used.
-   **Fixed** - Logo and mobile icon missing on the Vertical header style if a template is used.
-   **Fixed** - Hover button background that was not taken into account when general styling hover color was set.

### _2018.03.26_ - 1.5.8:

-   **Fixed** - Add to cart button missing.
-   **Fixed** - Mobile menu with Top header style.
-   **Fixed** - Double cart icon with the Medium header style.

### _2018.03.26_ - 1.5.7:

-   **Fixed** - Blank page on the Medium header style.
-   **Fixed** - Single product image and summary width on mobile view.

### _2018.03.25_ - 1.5.6 (note: after the update don't forget to clear your cache and if you have disabled scripts, go to Theme Panel > Scripts & Styles, click Save Changes, then clear your cache):

-   **Added** - New setting the Header > Mobile Menu section of the customizer to choose where you want to place the logo / cart and mobile link, so now, you will be able to add your cart icon to the left, the logo centered and the mobile icon to the right.
-   **Added** - New cart icon style "Bag Style", it is the same style as the cart icon shortcode.
-   **Added** - New setting in WooCommerce > Single Product to control the image and summary width.
-   **Added** - New setting in WooCommerce > Single Product to put the Add To Cart button bigger to increase conversion.
-   **Added** - New WooCommerce tab layout "Section" to put the description, additional information and reviews as sections.
-   **Added** - Meta tags, so when you will share a link of your site on your social medias, the meta tags will tell them exactly what to take.
-   **Added** - New settings for OpenGraph in the General Options > General Settings section of the customizer.
-   **Added** - Full compatibility for Elementor Pro 2.0.
-   **Added** - Compatibility with WooCommerce Germanized.
-   **Added** - Hooks for single product elements.
-   **Added** - New setting in Typography > General to disable the Google Fonts.
-   **Fixed** - Issue with the customizer color picket on Safari.
-   **Fixed** - Ajax issue on the single product if external product.
-   **Fixed** - Ajax issue on the single product of the quick view if external product.
-   **Fixed** - Quick view button full width on list view.
-   **Fixed** - Double logo on the cart/checkout pages is distraction free is enabled and has sticky logo.
-   **Fixed** - Both Sidebars layout width not taken into account on the categories pages.
-   **Fixed** - Product navigation issue with the thumbnails above the navigation.
-   **Fixed** - Lost password page CSS issue.
-   **Fixed** - Search form in the Medium header style if no search icon in the navigation.

### _2018.03.04_ - 1.5.5

-   **Added** - Integration with TI WooCommerce Wishlist instead of the YITH Wishlist plugin, because the YITH plugin has error with PHP 7.2 and the new Wishlist plugin is much better.
-   **Added** - Compatibility with WooCommerce Social Login for the multi-step checkout.
-   **Added** - New setting in the WooCommerce General section of the customizer to choose between the default or dropdown style for the WooCommerce categories widget.
-   **Tweak** - The archive_product_content() and single_product_content() functions are now in two files in the woocommerce folder so you can easily edit them via a child theme.
-   **Tweak** - The search icon in the navigation can now be added for the Medium header style too.
-   **Fixed** - Off Canvas filter button color in the customizer.
-   **Fixed** - RTL issue on the search results page.
-   **Fixed** - Variations not taken into account if Ajax on single product is enabled.
-   **Fixed** - Variations not taken into account in the WooCommerce quick view form.
-   **Fixed** - Variations images not taken into account in the WooCommerce quick view form.

### _2018.02.19_ - 1.5.4

-   **Fixed** - Issue "Invalid payment method" with the multi-step checkout.

### _2018.02.16_ - 1.5.3

-   **Fixed** - Issue "Invalid payment method" with the multi-step checkout.

### _2018.02.16_ - 1.5.2

-   **Fixed** - Issue to disable the Off Canvas filter button.
-   **Fixed** - Error, using $this when not in object context.

### _2018.02.15_ - 1.5.1

-   **Fixed** - Quantity button issue if the floating bar is enabled.

### _2018.02.15_ - 1.5.0

-   **Added** - Multi-step checkout.
-   **Added** - Floating bar on the single product pages to always have the add to cart button to increase conversion.
-   **Added** - Quick view button on the products that will display a quick view modal.
-   **Added** - Mini cart on mobile view when you click the cart icon.
-   **Added** - Off Canvas filtering, you can enable it via WooCommerce > Archives.
-   **Added** - New option to add ajax to the single product add to cart button so the Ocean Woo Popup extension can work on the single product page too.
-   **Added** - New option to display your cart when a product will be added to it.
-   **Added** - New option to display the single product thumbnails vertically.
-   **Added** - New option to display the single product tabs vertically.
-   **Added** - New option to add a product navigation in single product.
-   **Added** - New option to align the product entries content (left-center-right).
-   **Added** - New option to choose between square or circle for the Sale badge.
-   **Added** - New option to display a sale text or a percentage for the sale badge.
-   **Added** - New option "Distraction Free" for the Cart and Checkout pages to only display your logo and footer bottom to increase conversion.
-   **Added** - New option in WooCommerce > General to display a wishlist icon in the header if the YITH WooCommerce Wishlist plugin is used.
-   **Added** - New textarea option in Header > General to allow you to add what you want after the header so you will be able to add you menu to the left or center and add something to the right side of the header like the cart icon.
-   **Added** - New option to disable the menu cart icon on all devices or only on desktop, so if you use the cart icon shortcode you still can display the cart icon on mobile view.
-   **Added** - New option Image Margin in the Advanced Styling setting for the product entries so you can add a padding with a negative margin in the image.
-   **Added** - Polylang in all template to be able to translate them.
-   **Tweak** - Now, the cart is displayed on the cart icon hover not click.
-   **Tweak** - Better styling for the cart widget.
-   **Tweak** - Better styling for the wishlist button.
-   **Tweak** - Better styling for the categories widget.
-   **Tweak** - Better styling for the filter widget.
-   **Tweak** - Moved default customizer WooCommerce section to the theme WooCommerce section.
-   **Fixed** - Max height for the mobile drop down style.
-   **Fixed** - Toolbar for custom taxonomy.
-   **Fixed** - Pagination positionning issue for WooCommerce pagination.
-   **Fixed** - Page title height if no background image.
-   **Fixed** - Page title fixed become initial to fix the IOS bug.

### _2018.02.07_ - 1.4.16

-   **Fixed** - WooCommerce pagination template.

### _2018.01.31_ - 1.4.15

-   **Updated** - WooCommerce templates.

### _2018.01.28_ - 1.4.14

-   **Fixed** - Little issue in the customizer.

### _2018.01.28_ - 1.4.13

-   **Added** - New options in the WooCommerce > Advanced Styling section of the customizer to add a padding, border width, border radius, background color and border color for the products entries.
-   **Fixed** - Search sidebar issue if Custom Sidebar is not selected on the customizer.
-   **Fixed** - Dropdown mobile menu when click on anchor link.

### _2018.01.16_ - 1.4.12

-   **Added** - New option in General Options > General Styling to choose to add all the customizer styling options in a custom CSS file or in the WP Head.
-   **Tweak** - Better approch to fix the image issue on Safari when Infinite Scroll is enabled.
-   **Fixed** - Sub menu issue with the Top header style when a media is added to the header.
-   **Fixed** - RTL issue on the WooCommerce my account page.

### _2018.01.02_ - 1.4.11

-   **Added** - New field for the Vertical header style to choose when you want to collapse it.
-   **Added** - Category description as subheading.
-   **Added** - Ability to display a custom excerpt for the search result page.
-   **Fixed** - Infinite Scroll image issue on Safari.
-   **Fixed** - Issue with Yoast Breadcrumb.
-   **Fixed** - Blog entries image issue.
-   **Fixed** - Some WooCommerce styling issues.
-   **Fixed** - Undefined mobile_footer_left_padding variable.
-   **Fixed** - Medium header "sticky header" padding issue.
-   **Fixed** - Issue with the Mobile logo if the header is fixed on mobile view.

### _2017.12.10_ - 1.4.10

-   **Fixed** - Boxed layout issue.

### _2017.12.09_ - 1.4.9

-   **Added** - New field in the Mobile Menu section of the customizer to allow you to add a custom header height in tablet and mobile view.
-   **Added** - Ability to add caption for the featured posts images.
-   **Added** - Filter "ocean_default_color_palettes", to allow you to change the default color palettes of the color options in the customizer.
-   **Added** - New checkbox field "Add container" in the Footer Widget section of the customizer to allow you to remove the footer container.
-   **Added** - Compatibility with the new Gutenberg alignment: Align Wide and Align Full.
-   **Added** - New option in the Single Post section of the customizer to control or disable the content max width in full width layout for the new single post style.
-   **Added** - Infinite scrolling for the Shop and taxonomies pages, you just need to select it via the WooCommerce > Archives section of the customizer.
-   **Added** - New section in the Typography section of the customizer to allow you to change the product price typography.
-   **Tweak** - Better styling of the single post when you use the full width layout (same design as Gutenberg).
-   **Fixed** - Issue with the 0 number which is not taken into account in the customizer fields.
-   **Fixed** - Z-index issue with the Full Screen header style.
-   **Fixed** - Issue with the Max Width and Max Height fields in Header > Logo.
-   **Fixed** - Anchor links issue if a custom mobile menu is used.
-   **Fixed** - Mobile logo issue if you use a custom breakpoint.
-   **Fixed** - Issue with a custom background color when using the parallax footer effect.
-   **Fixed** - Issue with anchor links and the medium header style.

### _2017.11.18_ - 1.4.8

-   **Fixed** - Issue with the mobile menu link on IOS 9.
-   **Fixed** - Issue on IOS with the Underline Form Left menu item effect.

### _2017.11.16_ - 1.4.7

-   **Added** - New select template field in Header > Menu to allow you to select a template created in Theme Panel > My Library to replace the navigation. Perfect to use the Nav Menu widget of Elementor Pro with any header styles.
-   **Added** - OceanWP is now 100% WooCommerce compatible, so you can use external plugins as WC Vendors without problems.
-   **Added** - Polish translation, thank you very much to Rafał Stępień.
-   **Tweak** - The product taxonomy description are now above the products instead of under the page title.
-   **Tweak** - Cart icon on mobile view, now the cart will be exactly the same as desktop view.
-   **Fixed** - Top bar menu under header.
-   **Fixed** - Issue on the Checkout if third party plugins add new fields.
-   **Fixed** - WooCommerce gallery images if not shop page.
-   **Fixed** - WooCommerce select issue on the cart page.
-   **Fixed** - WooCommerce table issue on the checkout page.
-   **Fixed** - Social icons on the sidebar mobile menu style.
-   **Fixed** - Color control issue with WordPress 4.9.
-   **Deleted** - Custom JS textarea, moved in Ocean Extra.

### _2017.11.03_ - 1.4.6

-   **Fixed** - Icon issue with the Sidebar mobile menu style.

### _2017.11.03_ - 1.4.5

-   **Fixed** - Issue with the Sidebar mobile menu style.

### _2017.11.02_ - 1.4.4

-   **Fixed** - is_plugin_active fatal error for WordPress Social Login.

### _2017.11.02_ - 1.4.3

-   **Added** - Translation with WPML for the custom theme's parts, see this article: http://docs.oceanwp.org/article/474-translate-custom-parts-of-the-theme-with-wpml
-   **Added** - Compatibility with WooCommerce Enhanced Layered Navigation.
-   **Added** - Compatibility with WordPress Social Login.
-   **Added** - Some CSS fixes for Gutenberg.
-   **Added** - bbPress compatibility.
-   **Added** - BuddyPress compatibility.
-   **Tweak** - Parallax footer code improved.
-   **Updated** - French translation, thanks to freepixel.net.
-   **Fixed** - Mobile menu drop down behind the sale and zoom icon of the single product page.
-   **Fixed** - Add to cart background color hover in the customizer.
-   **Fixed** - Product variables price color.
-   **Fixed** - Product quantity number input on Firefox.
-   **Fixed** - Gallery lightbox issue.
-   **Fixed** - Sidebar issue if full width or full screen layout selected.

### _2017.10.19_ - 1.4.2

-   **Added** - Magnific Popup script instead of Chocolat, better lightbox script.
-   **Fixed** - Styling issue with the Full Screen mobile menu style.
-   **Fixed** - "Latest In" in posts megamenu not translatable.
-   **Updated** - Theme screenshot.

### _2017.10.14_ - 1.4.1

-   **Tweak** - Social menu is now displayed even if there is no main menu.
-   **Fixed** - Responsive top bar social issue.

### _2017.10.13_ - 1.4.0

-   **Added** - New Header Style "Vertical" with many options. You can also put the header transparent with a background when scrolling if you use Ocean Sticky Header.
-   **Added** - New Layout Style "Separate" in General Options > General Settings.
-   **Added** - New layout style "Both Sidebars" with options to choose between "Sidebar / Sidebar / Content - Sidebar / Content / Sidebar - Content / Sidebar / Sidebar" and options to add your own content and sidebars width.
-   **Added** - Parallax Footer effect, you just need to activate it via the Footer Widgets section of the customizer.
-   **Added** - New checkbox field to add the Full Screen, Center and Medium header styles transparent.
-   **Added** - New blog entries style "Thumbnail".
-   **Added** - New field to select a template to replace the header social menu.
-   **Added** - New logo field in Header > Mobile Menu to display a different logo in responsive. You can also choose the media query where you want to display the logo
-   **Added** - New fields in WooCommerce > Advanced Styling to control the background, color, border color, border width and border radius of the Add to Cart button of the shop page and for the Typography in Typography > WooCommerce Product Add To Cart.
-   **Added** - WooCommerce Sensei support.
-   **Added** - Two new options to allow you to add a custom with and height for the blog entries images.
-   **Added** - New select fields to allow you to choose your heading tag your the page title, blog entries title and single post title.
-   **Added** - New field to choose the title and breadcrumb position if you use the Background Image style for the page header.
-   **Added** - Overlay color field in Header > Header Media, now you can add an overlay color when you add a media in the header.
-   **Tweak** - IMPORTANT, big improvement on the Center header style, if you use this header style, read this article: http://docs.oceanwp.org/article/467-improvement-on-the-center-header-style
-   **Tweak** - The lightbox scripts and style are now in seperate files to easily disable them if you can't use the Scripts & Styles panel.
-   **Tweak** - CSS improvement for the WooCommerce cart page in responsive.
-   **Tweak** - Search Source field moved to General Options > General Settings.
-   **Tweak** - Better approach for the retina logo.
-   **Tweak** - Better approach to call the custom hamburgers button, now just the selected style is called.
-   **Updated** - Infinite Scroll script.
-   **Fixed** - Issue with the CSS file for the custom parts of the theme created via Elementor (custom header, custom footer, etc ...).
-   **Fixed** - Issue with the lightbox images when you disable a script or style in Theme Panel > Scripts & Styles.
-   **Fixed** - Issue with the search mobile if you select a search post type.
-   **Fixed** - Disaable link on Sidebar mobile menu style.
-   **Fixed** - Z-index issue with Divi builder.
-   **Fixed** - Bug with overlay in Chrome.
-   **Deleted** - All Deprecated fields.

### _2017.09.18_ - 1.3.9

-   **Fixed** - Undefined $content variable error in the top bar content.

### _2017.09.17_ - 1.3.8

-   **Fixed** - Undefined $get_content variable error in the header.

### _2017.09.17_ - 1.3.7

NOTE: After the theme update, if you have disabled any scripts or styles, go to Theme Panel > Scripts & Styles, and click on Save Changes to update the JS and CSS files.

-   **Added** - New field to select a template created in Theme Panel > My Library for the top bar content.
-   **Added** - New section "404 Error Page" in General Options with two new options, "layout" to select between full width and full screen layout and "Blank Page", if enable this option will remove all the elements (top bar, header, title, footer) to give you full control to create your error page with your page builder.
-   **Added** - New field in Header > Menu to select a post type for the search.
-   **Added** - New field in General Options > General Settings to control the posts per page on the search results page.
-   **Added** - Close mobile menu text for the drop down mobile menu style.
-   **Added** - Custom hamburgers button with effects for the mobile menu.
-   **Added** - Spanish language, thank you to Angel Julian Mena.
-   **Tweak** - All header styles settings added into the Header > General section of the customizer.
-   **Tweak** - Better styling for the search result page.
-   **Tweak** - Names added for the menu links effects, thanks to Verdi.
-   **Fixed** - Error in the Elementor edit mode when WooCommerce was enabled, the cart icon is removed in the edit mode to avoid error.
-   **Fixed** - Issue with the sticky mobile when the "Stick only the menu" is enable on the Medium Header style.
-   **Fixed** - Issue with the first row on the edit mode on Beaver Builder.
-   **Fixed** - Color link in the button of the principal menu.
-   **Fixed** - Comments words not translated.
-   **Fixed** - Side panel button displayed in the drop down and full screen mobile menu styles.
-   **Fixed** - Issue with the cart page url in the cart icon on mobile.
-   **Fixed** - Issue with emoticons in the comments.
-   **Fixed** - Blog archives layout on the tag, date and author pages.
-   **Fixed** - Issue with the close button of the Full Screen mobile menu style.

### _2017.08.25_ - 1.3.6

-   **Fixed** - Issue with the search overlay style.

### _2017.08.24_ - 1.3.5

-   **Added** - 10 menu links effects, go to Header > Menu.
-   **Added** - Brazil Portuguese translation, thanks a lot to Camilla Ribeiro.
-   **Tweak** - Some CSS codes.
-   **Fixed** - "add_to_cart_fragments" replaced by "woocommerce_add_to_cart_fragments".
-   **Fixed** - Text "Type then hit enter to search..." not translatable.
-   **Fixed** - Conflicts between the Transparent header style and the Elementor top section, now the header is hided in the Elementor edit mode.

### _2017.08.16_ - 1.3.4

-   **Fixed** - Values of the OceanWP Settings metabox not saved in the LifterLMS Courses post type.
-   **Fixed** - No menu on the Drop down and Full Screen mobile menu styles when you add a custom mobile menu.
-   **Fixed** - Issue with Divi builder when you select the tablet or mobile view.
-   **Fixed** - Small scroll effect issue with the Modal Window extension.

### _2017.08.04_ - 1.3.3

-   **Fixed** - Issue with the mobile menu breakpoint code.

### _2017.08.04_ - 1.3.2

-   **Fixed** - Fatal issue with the WooCommerce icon in the navigation.

### _2017.08.03_ - 1.3.1

-   **Fixed** - Anchor link in the Full Screen mobile menu style.
-   **Fixed** - Issue with the Navigation widget of Ocean Elementor Widgets.
-   **Fixed** - JS error "$left is not defined".

### _2017.08.02_ - 1.3.0

-   **Added** - Full support for PHP 7.1.
-   **Added** - Drop down mobile menu style.
-   **Added** - Full Screen mobile menu style.
-   **Added** - Breakpoint for the mobile menu, now you can add your own breakpoint to display the mobile menu link.
-   **Added** - Max Height field in the Header > Logo section of the customizer to allow you to add a max height if your logo is too big.
-   **Added** - Top Bar Social Alt. field supports templates created with your page builder.
-   **Added** - Overlay with spinner on the checkout page when the order button is clicked.
-   **Added** - Next/Prev Taxonomy field, now you will be able to display the next/prev single post links by category or tag.
-   **Added** - Related Posts Taxonomy field, now you will be able to display your related post by category or tag.
-   **Added** - Turkish language, partially translated by Selçuk Akkaş.
-   **Added** - New checkbox field in General Options > General Settings to allow you to disable the theme schema markup.
-   **Added** - LifterLMS support.
-   **Added** - Filter in the single post heading to allow you to change the heading tab via your child theme.
-   **Added** - Ability to display blog entry full content.
-   **Added** - New option to only stick the navigation when scrolling for the Medium header style.
-   **Tweak** - Anchor link doesn't have automatically scrolling effect anymore, you will need to add the "local" class to your link to have this effect. This is for avoid any plugins conflict.
-   **Tweak** - WooCommerce error message style improved.
-   **Tweak** - Anchor link in the mobile menu, no need anymore to add the "local-scroll" class.
-   **Fixed** - Anchor menu on the Full Screen header style, now the menu close after the click on the anchor link.
-   **Fixed** - Custom Header and Custom Footer issue in the Elementor edit mode.
-   **Fixed** - Top Bar style when there is no social.
-   **Fixed** - Beaver Builder tabs under the header.
-   **Fixed** - Page header color setting per page.
-   **Fixed** - Current menu color in child child menu.

### _2017.07.07_ - 1.2.9

-   **Added** - New filter in the breadcrumb for the Ocean Porffolio extension.
-   **Added** - Supports WooCommerce Match Box extension, thanks to Sébastien Dumont.
-   **Fixed** - Tabs under the header in the edit mode with the transparent header style.
-   **Updated** - Isotope script.

### _2017.06.29_ - 1.2.8

-   **Fixed** - WooCommerce section disappear when Beaver Themer is enabled.

### _2017.06.29_ - 1.2.7

-   **Added** - New option in WooCommerce > General section of the customizer to allow you to display the categories featured image before the products archives on the categories pages.
-   **Added** - New option in WooCommerce > Single of the customizer to allow you to hide the related products.
-   **Fixed** - Issue with custom header and custom footer when no Elementor widgets were added, thanks to KingYes from the Elementor team.
-   **Fixed** - Issue with Elementor sections links in the editor mode when you have the transparent header style.

### _2017.06.19_ - 1.2.6

-   **Fixed** - Double lighbox icon on the single product images.

### _2017.06.19_ - 1.2.5

-   **Added** - Fully compatible with Beaver Themer.
-   **Tweak** - Page header background image style CSS improved.
-   **Fixed** - Issue with WooCommerce products in list view when you add custom columns in responsive.
-   **Deleted** - Custom scripts for the WooCommerce single products images, too many issues.

### _2017.06.12_ - 1.2.4

-   **Added** - French translation, thank you very much to Jean Lagarrigue.
-   **Fixed** - Number options input issue in the customizer.

### _2017.06.12_ - 1.2.3

-   **Fixed** - Excerpt issue.

### _2017.06.12_ - 1.2.2

-   **Fixed** - Issue with page header opacity options in the customizer.

### _2017.06.11_ - 1.2.1

-   **Fixed** - Issue with top bar content.

### _2017.06.10_ - 1.2.0.1

-   **Added** - All sanitize_callback for the customizer options.
-   **Fixed** - Hiding menu text did not work.

### _2017.06.08_ - 1.2.0

-   **Added** - New menu field "Elementor Template" to allow you to add an Elementor template in your mega menu.
-   **Added** - New select field to choose an elementor template (or a page if you use another page builder) to replace the 404 error page content in General Options > General Settings of the customizer.
-   **Added** - Checkbox field in the Menu Cart customizer section to hide the menu cart if empty.
-   **Added** - New display style in the Menu Cart customizer section for the WooCommerce cart icon, now you can display the count and the cart total at the same time.
-   **Added** - Control in the Menu Cart customizer section to select a different cart icon.
-   **Added** - Text control in the Menu Cart customizer section to add your own cart icon.
-   **Added** - Slider control in the Menu Cart customizer section to allow you to add your own cart icon size, even for the responsive.
-   **Added** - Width field in the WooCommerce customizer section to control the cart dropdown width.
-   **Added** - Slider control for the WooCommerce archives columns field, now you can add a custom column for tablet and mobile.
-   **Added** - Checkbox field in the Mobile Menu customizer section to show/hide the mobile menu opening button text.
-   **Added** - Text field in the Mobile Menu customizer section to add your own text for the mobile menu opening button.
-   **Added** - Text field in the Mobile Menu customizer section to add your own icon class for the mobile menu opening button.
-   **Added** - Checkbox field in the Mobile Menu customizer section to show/hide the mobile menu close button.
-   **Added** - Switch field in the Mobile Menu customizer section to allow you to open your dropdowns with the parent link.
-   **Added** - Text field in the Mobile Menu customizer section to add your own text for the mobile menu close button.
-   **Added** - Text field in the Mobile Menu customizer section to add your own icon class for the mobile menu close button.
-   **Added** - Checkbox field in the Blog Entries customizer section to show/hide the overlay on the image hover on the blog.
-   **Added** - Filter for the blog entries headings, now you can add your own heading tag through this filter.
-   **Fixed** - Search input focus on the icon click.
-   **Fixed** - Comments pagination issue.
-   **Fixed** - Issue with WPML string translation.
-   **Fixed** - Issue with the Apply Coupon button on the checkout page.
-   **Fixed** - Phone and Email input issue on the checkout page.
-   **Fixed** - Textarea height issue with the forms widget of Elementor.
-   **Fixed** - Issue with the search overlay and the center menu, now the close button is directly into the overlay.
-   **Fixed** - Quantity buttons issue in the WooCommerce Cart page.
-   **Fixed** - Avatar issue in the WooCommerce My Account page.
-   **Fixed** - Page header overlay opacity issue for the background image style.
-   **Fixed** - RTL lighbox style issue.

### _2017.04.24_ - 1.1.9.1

-   **Fixed** - Small issue with the category products images.

### _2017.04.23_ - 1.1.9

-   **Added** - Sortable control in the customizer for the catalog products, now you can reorder the elements.
-   **Added** - Mega menu 1 column.
-   **Added** - New menu location"Mobile" for the mobile menu.
-   **Added** - Font subsets in the typography section of the customizer.
-   **Added** - Minification for the Custom CSS output.
-   **Added** - Dutch translation, thank you to Verdi Heinz and its team.
-   **Added** - Now you can add a mega menu to the top bar menu.
-   **Added** - Filter for the meta in the customizer to add your own meta, see this [article](http://docs.oceanwp.org/article/430-add-your-own-meta).
-   **Added** - Font size and padding fields for the top bar social in the customizer.
-   **Added** - Width and height fields in the customizer to add your own size for the related posts images.
-   **Added** - Support for the WooCommerce single product gallery zoom.
-   **Added** - Tabs Position field in the WooCommerce customizer section to choose the positioning of your tabs on single product.
-   **Added** - Color control in the customizer for the placeholder text of the overlay search style.
-   **Added** - Color control for the border widgets titles.
-   **Fixed** - Issue with WooCommerce cart dropdown on RTL.
-   **Fixed** - Skype and Email URL issue for the top bar and social menu.
-   **Fixed** - Hided logo if one column on responsive for the medium header style.
-   **Fixed** - Top bar content preview issue when it has no content.
-   **Fixed** - Title of latest posts in megamenu does not break to second line.
-   **Tweak** - The top bar menu is automatically added to the mobile menu.
-   **Tweak** - The top bar menu is automatically centered horizontally.
-   **Tweak** - Style enhancement for the WooCommerce checkout page.
-   **Tweak** - The next/prev post is entirely clickable.
-   **Deleted** - The "Add Lightbox To Your Images" field is deleted from the theme because it is directly incorporated into Theme Panel > Scripts & Styles.

### _2017.04.05_ - 1.1.8

-   **Added** - New header style "Medium".
-   **Added** - New "Visibility" select field in the customizer to allow you to show/hide some elements on tablets and mobiles like the Top Bar, Page Header, Footer Widgets, Footer Bottom.
-   **Added** - Font Size field added to the Social Menu section.
-   **Added** - New customizer control "Slider", created for fields like font size, line height and letter spacing on the typography section.
-   **Added** - Responsive buttons in multiple fields of the customizer like the font size, line height, letter spacing, etc, to allow you to control your values for desktop, tablets and mobiles.
-   **Added** - Dimensions control in the Social Menu section of the customizer to allow you to add a left and right padding for the icons.
-   **Added** - Font weight 500 and 900 in the typography section of the customizer.
-   **Tweak** - Footer widgets columns, now you define a custom column for tablets and mobiles devices.
-   **Tweak** - Large improvement of the dimensions control of the customizer, now you can define your dimensions for tablets and mobiles screens thanks to Justin Tadlock et Steeve Lefebvre.
-   **Fixed** - Issue with avatar on the author box.
-   **Fixed** - Issue with iframe in responsive.
-   **Fixed** - Issue with WooCommerce 3.0 images variables.
-   **Deleted** - All widgets have been added in the Ocean Extra extension because some things are not allowed in a theme.

### _2017.04.01_ - 1.1.7.4

-   **Fixed** - Search button missing for the top header style.

### _2017.03.24_ - 1.1.7.3

-   **Fixed** - Header issue with the oceanwp_main_schema_markup() function.

### _2017.03.23_ - 1.1.7.2

-   **Fixed** - Issue with the dimensions control.

### _2017.03.23_ - 1.1.7.1

-   **Fixed** - TGM Plugin Activation problem.
-   **Fixed** - Double icons in mobile menu.

### _2017.03.21_ - 1.1.7

IMPORTANT NOTICE: Some fields of the customizer are improved to be more user friendly, you must re-enter your values in the new dimensions controls for the following fields:

-   Padding in General Options > Forms (Input - Textarea)
-   Border Width in General Options > Forms (Input - Textarea)
-   Padding in Theme Button
-   The two Padding fields in Sidebar
-   Padding in Footer Widgets
-   Padding in Footer Bottom

*   **Added** - New checkbox field in the Top Bar section of the customizer to add the top bar in full width.
*   **Added** - New checkbox field in the Header section of the customizer to add the header in full width.
*   **Added** - Norwegian language, thank you very much to Tor-Arne Pettersen‎.
*   **Added** - Short codes in the description for the top bar content and the footer copyright in the customizer.
*   **Added** - New "Fixed Footer" option in the Footer Widgets section of the customizer to add a height to your content to keep your footer at the bottom of your page.
*   **Added** - New option in General Settings of the customizer to activate/desactivate the default lightbox scripts.
*   **Added** - New control for the customizer "Dimensions" to add your top/right/bottom/left dimensions like Elementor.
*   **Tweak** - Increased container max width in the customizer for 4K screens.
*   **Tweak** - Support for WooCommerce 3.0.
*   **Tweak** - Flickr widget moved to Ocean Extra because the script code is not allowed into the theme.
*   **Tweak** - CSS for sub lists improved.

### _2017.03.04_ - 1.1.6

-   **Added** - New customizer section "Header Media" in the Header section to add an image or video (only in front page), to your header.
-   **Added** - New "Excerpt Length" field added in the Blog Entries section of the customizer to control the excerpt length of your posts.
-   **Added** - Swedish language, thank you very much to Christoffer Gisselfeldt.
-   **Added** - Center menu position.
-   **Added** - New options for the background image of the page header.
-   **Added** - Full Screen layout added in customizer.
-   **Updated** - Fonts list in the customizer typography section.
-   **Fixed** - Form (input-textarea) styling issue.
-   **Fixed** - Thumbnails images on WooCommerce variation products.
-   **Fixed** - Issue with retina logo in the Center header style.
-   **Fixed** - Links color hover option in the customizer.
-   **Fixed** - Cart icon removed on mobile if disabled.
-   **Fixed** - Issue with archive products ratings in list mode.
-   **Fixed** - Issue with Woocommerce if single product has no sidebar.
-   **Fixed** - JS error with YITH WooCommerce Quick View.

### _2017.02.15_ - 1.1.5

-   **Fixed** - Sub menus blinking.
-   **Fixed** - Problem double lightbox with Beaver Builder.
-   **Fixed** - Problem with WooCommerce images variation products.

### _2017.02.06_ - 1.1.4

-   **Added** - Register translation string.
-   **Tweak** - All archive product éléments added în separate functions to easily alter them via thé child thème.
-   **Fixed** - Excerpt issue with the Elementor WooStore plugin.
-   **Deleted** - Modal scripts, integrated into the Ocean Modal Window extension.

### _2017.01.27_ - 1.1.3

-   **Added** - New panel in the customizer "Sidebar" to add background, control margin, padding, etc.
-   **Added** - New lightbox script "Chocolat" in replacement of Magnific Popup, lighter, responsive, possibility to add the lightbox in full screen and zoom on the image, more info: http://chocolat.insipi.de/
-   **Fixed** - Logo issue if youv've not set a retina logo, the custom logo not disappear anymore on retina screen.
-   **Fixed** - Problem with the transparent header in the editor mode of Elementor.
-   **Fixed** - Problem with images alignements.
-   **Fixed** - Small issues.

### _2017.01.15_ - 1.1.2

-   **Added** - Script to create modal, check: http://docs.oceanwp.org/article/356-how-to-create-modal/
-   **Added** - New functions for the new settings of the metabox.
-   **Added** - Several hooks through the theme for the Ocean Hooks extension.
-   **Added** - FitVids script to have responsive videos.
-   **Added** - Filter for the style of the header, now you can alter the header style via the child theme.
-   **Tweak** - Improvement of the local scrolling, now the height of the header is taken into account.
-   **Fixed** - Problem of the retina logo on the retina screen.
-   **Fixed** - Background color of the page header.
-   **Fixed** - Small issues.
-   **Deleted** - Responsive.css file, directly integrated into the style.css file.

### _2016.12.30_ - 1.1.1.1

-   **Added** - Category description on the shop page.
-   **Fixed** - Non clickable products images with the gallery style.

### _2016.12.30_ - 1.1.1

-   **Added** - New awesome option to create your own header style.
-   **Added** - Gallery lightbox for the default WordPress gallery.
-   **Added** - Two new widgets Custom Header Logo and Custom Header Nav to use with your page builder for the Custom Header style.
-   **Added** - Custom Menu widget with more options than the default WordPress widget.
-   **Added** - Options to add an image background to the page header (title) for all your pages via the customizer.
-   **Added** - New options in the Blog section of the customizer to add your featured images of your posts directly in the page header (title).
-   **Added** - New option in the Blog section of the customizer to add your post title in the page header (title).
-   **Added** - Grid/list buttons to the catalog products in the shop page.
-   **Added** - Links in the shop page to show the number of products.
-   **Added** - New color options in WooCommerce > Advanced Styling to customize the toolbar of the shop page.
-   **Added** - New color options in WooCommerce > Advanced Styling to customize the title and product description into the tabs.
-   **Added** - German language, thank you very much to Andreas Schu.
-   **Added** - Breadcrumbs in the blog page.
-   **Tweak** - Footer page ID, now you can add a page created with Elementor or Beaver Builder or any other page builder.
-   **Tweak** - All output logo improved.
-   **Fixed** - RTL problem with the carousel of posts galleries and products, I changed the script by Slick.
-   **Fixed** - There was a conflict with the select2 script (used to select a typography in the customizer) when WooCommerce was enabled because their version of the script is older.
-   **Removed** - Unnecessary elements in the front end of Elementor's post-type Library.
-   **Removed** - I deleted "$j( document ).ready( function() {" from the "Custom JS" option so that you can have full control of the code you enter.

### _2016.12.20_ - 1.1.0

Warning: The name of the theme changed to OceanWP because Ocean was already taken, WordPress will see the OceanWP theme as a new theme, so, you need to do a fews steps, look at this video:
https://youtu.be/s5TUYhUMc-8

1. In your WordPress dashboard, go to Theme Panel > Import/Export, and click on the export button, this will generate a json file.
2. Install and activate the Widget Importer & Exporter plugin and go to Tools > Widget Import/Export to export your widgets.
3. Download the new version of the theme on oceanwp.org.
4. Return to your WordPress dashboard and upload the new version.
5. If not already done, update WordPress, then, update all extensions.
6. Go to Theme Panel > Import/Export and import the json file of the step 1.
7. Go to Appearance > Widgets and delete all your widgets to prevent conflicts (optional).
8. Go to Tools > Widget Import/Export and import the .wie file exported to the step 2.
9. Check that everything is ok on your site, if so, go back to Appearance > Themes and delete the old Ocean theme.
10. if you use a child theme, replace "wp_get_theme( 'Ocean' )" by "wp_get_theme( 'OceanWP' )".

Do not worry, all your changes made to the theme will not be affected because I've not modified any filters, action or theme_mods.
I'm really sorry for that, there will never be any changes of this kind again, I want the theme to be available in the WordPress directory, and the name Ocean was already taken in the waiting list, so I had to modify it to OceanWP.

Do not hesitate to contact me via facebook or trough the support page if you have misunderstood or you are having an issue.

-   **Added** - New color option in the customizer to add a background to the transparent header style.
-   **Added** - Select2 script for the typography select.
-   **Added** - Typography for the H1, H2, H3 and H4 headings.
-   **Added** - New panel to add your own JS code directly into the customizer.
-   **Added** - New field in the customizer to add your own padding left/right for the menu items.
-   **Added** - New field in the customizer to add your own width for the dropdrow menu.
-   **Added** - function_exists to all functions in the helpers file, so you can alter them via the child theme.
-   **Tweak** - Large enhancement of the customizer options.
-   **Updated** - Font Awesome icons to 4.7.
-   **Deleted** - Options in the customizer to choose your links color between light and dark for the transparent header, you can choose your own color in the menu section.
-   **Fixed** - Problem to change the font size, font weight, letter spacing, etc, to the center header style.
-   **Fixed** - Problem with the button to open the mobile menu.

### _2016.12.12_ - 1.0.9.1

-   **Fixed** - Problem with the customizer.

### _2016.12.07_ - 1.0.9

-   **Added** - Support WordPress 4.7.
-   **Fixed** - Problem with the menu items in WordPress 4.7.
-   **Tweak** - Migrate the custom CSS of the Theme Panel into the new Additional CSS panel of the customizer.

### _2016.12.01_ - 1.0.8.1

-   **Fixed** - Small issue.

### _2016.12.01_ - 1.0.8

-   **Added** - New fields in the customizer to add a background image.
-   **Added** - Option in the customizer to control the max width of the logo.
-   **Added** - New fields in the customizer to add a padding top and bottom at the header.
-   **Added** - Tagline in the Site Identity section of the customizer.
-   **Added** - Selective refresh to widgets.
-   **Added** - Option to add a color to the overlay page header.
-   **Fixed** - Problem with the overlay of the page header.
-   **Fixed** - Problem to change the font size of the menu items for the Top Menu header style.
-   **Tweak** - Moved Site Icon field to the Site Identity section of the customizer.
-   **Tweak** - Some files improvement.

### _2016.11.26_ - 1.0.7

-   **Added** - New fields in the Blog section of the customizer to show/hide elements in the single post.
-   **Tweak** - Icon search and cart replaced by text for the center header style.
-   **Fixed** - Problem categories posts in megamenu.

### _2016.11.21_ - 1.0.6

-   **Added** - New header style "Center".
-   **Fixed** - Problem anchor links on mobile menu.
-   **Fixed** - Problem megamenu category posts on full screen header style.

### _2016.11.12_ - 1.0.5

-   **Added** - Boxed layout.
-   **Added** - Options in the Customizer to alter the meta in blog entries and single.

### _2016.11.11_ - 1.0.4

-   **Added** - New header style "Full Screen".
-   **Added** - New posts style "Grid".
-   **Added** - New blog pagination "Infinite Scroll".
-   **Added** - Function to add an overlay color to the page header background image style.
-   **Fixed** - Problem breadcrumbs on the home page.
-   **Fixed** - Breadcrumbs position problem on centered page title.
-   **Tweak** - Redirection to the welcome page during the theme activation.

### _2016.11.05_ - 1.0.3

-   **Added** - New fields in the Contact Info widget to add your own titles and icons.
-   **Tweak** - PHP files.

### _2016.11.02_ - 1.0.2

-   **Added** - New header style "Top Menu".
-   **Added** - New widget "Recent Posts".
-   **Added** - New "Shortcode" field in the Ocean Settings metabox to add your slider shortcode below the header.
-   **Added** - Function to add custom fonts.
-   **Added** - Function to delete term data when a term is deleted.
-   **Added** - Option to the categories menu items to add your latest posts in mega menu.
-   **Tweak** - Improvements of the newsletter widget.
-   **Fixed** - Lightbox images into the content.
-   **Fixed** - Problems of tabs in the editor mode of Elementor and Beaver Builder when you set the page in full screen.
-   **Fixed** - Problem posts and related posts image link.
-   **Fixed** - The top bar social alt work perfectly now.

### _2016.10.16_ - 1.0.1

-   **Added** - Options in the customizer to change the colors of WooCommerce pages.

### _2016.10.13_ - 1.0.0

-   Initial release
