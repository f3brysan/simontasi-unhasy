<p align="center">
  <img src="https://cdn-icons-png.flaticon.com/512/6295/6295417.png" width="100" />
</p>
<p align="center">
    <h1 align="center">SIMONTASI-UNHASY</h1>
</p>
<p align="center">
    <em>HTTP error 401 for prompt `slogan`</em>
</p>
<p align="center">
	<img src="https://img.shields.io/github/license/f3brysan/simontasi-unhasy?style=flat&color=0080ff" alt="license">
	<img src="https://img.shields.io/github/last-commit/f3brysan/simontasi-unhasy?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
	<img src="https://img.shields.io/github/languages/top/f3brysan/simontasi-unhasy?style=flat&color=0080ff" alt="repo-top-language">
	<img src="https://img.shields.io/github/languages/count/f3brysan/simontasi-unhasy?style=flat&color=0080ff" alt="repo-language-count">
<p>
<p align="center">
		<em>Developed with the software and tools below.</em>
</p>
<p align="center">
	<img src="https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=flat&logo=JavaScript&logoColor=black" alt="JavaScript">
	<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">
	<img src="https://img.shields.io/badge/Vite-646CFF.svg?style=flat&logo=Vite&logoColor=white" alt="Vite">
	<img src="https://img.shields.io/badge/Axios-5A29E4.svg?style=flat&logo=Axios&logoColor=white" alt="Axios">
	<img src="https://img.shields.io/badge/JSON-000000.svg?style=flat&logo=JSON&logoColor=white" alt="JSON">
</p>
<hr>

##  Quick Links

> - [ Overview](#-overview)
> - [ Features](#-features)
> - [ Repository Structure](#-repository-structure)
> - [ Modules](#-modules)
> - [ Getting Started](#-getting-started)
>   - [ Installation](#-installation)
>   - [ Running simontasi-unhasy](#-running-simontasi-unhasy)
>   - [ Tests](#-tests)
> - [ Project Roadmap](#-project-roadmap)
> - [ Contributing](#-contributing)
> - [ License](#-license)
> - [ Acknowledgments](#-acknowledgments)

---

##  Overview

HTTP error 401 for prompt `overview`

---

##  Features

HTTP error 401 for prompt `features`

---

##  Repository Structure

```sh
└── simontasi-unhasy/
    ├── README.md
    ├── app
    │   ├── Console
    │   │   └── Kernel.php
    │   ├── Exceptions
    │   │   └── Handler.php
    │   ├── Http
    │   │   ├── Controllers
    │   │   │   ├── AdminProposalController.php
    │   │   │   ├── AuthController.php
    │   │   │   ├── Controller.php
    │   │   │   ├── DashboardController.php
    │   │   │   ├── GetDataAPISiakad.php
    │   │   │   ├── LogBookController.php
    │   │   │   ├── ProposalController.php
    │   │   │   ├── SyncDataController.php
    │   │   │   └── UserController.php
    │   │   ├── Kernel.php
    │   │   └── Middleware
    │   │       ├── Authenticate.php
    │   │       ├── EncryptCookies.php
    │   │       ├── PreventRequestsDuringMaintenance.php
    │   │       ├── RedirectIfAuthenticated.php
    │   │       ├── TrimStrings.php
    │   │       ├── TrustHosts.php
    │   │       ├── TrustProxies.php
    │   │       ├── ValidateSignature.php
    │   │       └── VerifyCsrfToken.php
    │   ├── Models
    │   │   ├── Permission.php
    │   │   ├── Role.php
    │   │   └── User.php
    │   └── Providers
    │       ├── AppServiceProvider.php
    │       ├── AuthServiceProvider.php
    │       ├── BroadcastServiceProvider.php
    │       ├── EventServiceProvider.php
    │       └── RouteServiceProvider.php
    ├── artisan
    ├── bootstrap
    │   ├── app.php
    │   └── cache
    │       └── .gitignore
    ├── composer.json
    ├── composer.lock
    ├── config
    │   ├── app.php
    │   ├── auth.php
    │   ├── broadcasting.php
    │   ├── cache.php
    │   ├── cors.php
    │   ├── database.php
    │   ├── datatables.php
    │   ├── filesystems.php
    │   ├── hashing.php
    │   ├── logging.php
    │   ├── mail.php
    │   ├── permission.php
    │   ├── queue.php
    │   ├── sanctum.php
    │   ├── services.php
    │   ├── session.php
    │   └── view.php
    ├── database
    │   ├── .gitignore
    │   ├── factories
    │   │   └── UserFactory.php
    │   ├── migrations
    │   │   ├── 2014_10_12_000000_create_users_table.php
    │   │   ├── 2014_10_12_100000_create_password_reset_tokens_table.php
    │   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
    │   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
    │   │   └── 2024_03_29_042453_create_permission_tables.php
    │   └── seeders
    │       └── DatabaseSeeder.php
    ├── package.json
    ├── phpunit.xml
    ├── public
    │   ├── .htaccess
    │   ├── assets
    │   │   ├── brand
    │   │   │   └── coreui.svg
    │   │   ├── favicon
    │   │   │   ├── android-icon-144x144.png
    │   │   │   ├── android-icon-192x192.png
    │   │   │   ├── android-icon-36x36.png
    │   │   │   ├── android-icon-48x48.png
    │   │   │   ├── android-icon-72x72.png
    │   │   │   ├── android-icon-96x96.png
    │   │   │   ├── apple-icon-114x114.png
    │   │   │   ├── apple-icon-120x120.png
    │   │   │   ├── apple-icon-144x144.png
    │   │   │   ├── apple-icon-152x152.png
    │   │   │   ├── apple-icon-180x180.png
    │   │   │   ├── apple-icon-57x57.png
    │   │   │   ├── apple-icon-60x60.png
    │   │   │   ├── apple-icon-72x72.png
    │   │   │   ├── apple-icon-76x76.png
    │   │   │   ├── apple-icon-precomposed.png
    │   │   │   ├── apple-icon.png
    │   │   │   ├── browserconfig.xml
    │   │   │   ├── favicon-16x16.png
    │   │   │   ├── favicon-32x32.png
    │   │   │   ├── favicon-96x96.png
    │   │   │   ├── favicon.ico
    │   │   │   ├── manifest.json
    │   │   │   ├── ms-icon-144x144.png
    │   │   │   ├── ms-icon-150x150.png
    │   │   │   ├── ms-icon-310x310.png
    │   │   │   └── ms-icon-70x70.png
    │   │   ├── icons
    │   │   │   ├── 3d.svg
    │   │   │   ├── 4k.svg
    │   │   │   ├── account-logout.svg
    │   │   │   ├── action-redo.svg
    │   │   │   ├── action-undo.svg
    │   │   │   ├── address-book.svg
    │   │   │   ├── airplane-mode-off.svg
    │   │   │   ├── airplane-mode.svg
    │   │   │   ├── airplay.svg
    │   │   │   ├── alarm.svg
    │   │   │   ├── album.svg
    │   │   │   ├── align-center.svg
    │   │   │   ├── align-left.svg
    │   │   │   ├── align-right.svg
    │   │   │   ├── american-football.svg
    │   │   │   ├── android.svg
    │   │   │   ├── angular.svg
    │   │   │   ├── aperture.svg
    │   │   │   ├── apple.svg
    │   │   │   ├── applications-settings.svg
    │   │   │   ├── applications.svg
    │   │   │   ├── arrow-bottom.svg
    │   │   │   ├── arrow-circle-bottom.svg
    │   │   │   ├── arrow-circle-left.svg
    │   │   │   ├── arrow-circle-right.svg
    │   │   │   ├── arrow-circle-top.svg
    │   │   │   ├── arrow-left.svg
    │   │   │   ├── arrow-right.svg
    │   │   │   ├── arrow-thick-bottom.svg
    │   │   │   ├── arrow-thick-from-bottom.svg
    │   │   │   ├── arrow-thick-from-left.svg
    │   │   │   ├── arrow-thick-from-right.svg
    │   │   │   ├── arrow-thick-from-top.svg
    │   │   │   ├── arrow-thick-left.svg
    │   │   │   ├── arrow-thick-right.svg
    │   │   │   ├── arrow-thick-to-bottom.svg
    │   │   │   ├── arrow-thick-to-left.svg
    │   │   │   ├── arrow-thick-to-right.svg
    │   │   │   ├── arrow-thick-to-top.svg
    │   │   │   ├── arrow-thick-top.svg
    │   │   │   ├── arrow-top.svg
    │   │   │   ├── assistive-listening-system.svg
    │   │   │   ├── asterisk-circle.svg
    │   │   │   ├── asterisk.svg
    │   │   │   ├── at.svg
    │   │   │   ├── audio-description.svg
    │   │   │   ├── audio-spectrum.svg
    │   │   │   ├── audio.svg
    │   │   │   ├── av-timer.svg
    │   │   │   ├── badge.svg
    │   │   │   ├── balance-scale.svg
    │   │   │   ├── ban.svg
    │   │   │   ├── bank.svg
    │   │   │   ├── bar-chart.svg
    │   │   │   ├── barcode.svg
    │   │   │   ├── baseball.svg
    │   │   │   ├── basket.svg
    │   │   │   ├── basketball.svg
    │   │   │   ├── bath.svg
    │   │   │   ├── battery-0.svg
    │   │   │   ├── battery-3.svg
    │   │   │   ├── battery-5.svg
    │   │   │   ├── battery-alert.svg
    │   │   │   ├── battery-slash.svg
    │   │   │   ├── beach-access.svg
    │   │   │   ├── beaker.svg
    │   │   │   ├── bed.svg
    │   │   │   ├── bell.svg
    │   │   │   ├── bike.svg
    │   │   │   ├── birthday-cake.svg
    │   │   │   ├── blind.svg
    │   │   │   ├── bluetooth.svg
    │   │   │   ├── blur-circular.svg
    │   │   │   ├── blur-linear.svg
    │   │   │   ├── blur.svg
    │   │   │   ├── boat-alt.svg
    │   │   │   ├── bold.svg
    │   │   │   ├── bolt.svg
    │   │   │   ├── book.svg
    │   │   │   ├── bookmark.svg
    │   │   │   ├── bootstrap.svg
    │   │   │   ├── border-all.svg
    │   │   │   ├── border-bottom.svg
    │   │   │   ├── border-clear.svg
    │   │   │   ├── border-horizontal.svg
    │   │   │   ├── border-inner.svg
    │   │   │   ├── border-left.svg
    │   │   │   ├── border-outer.svg
    │   │   │   ├── border-right.svg
    │   │   │   ├── border-style.svg
    │   │   │   ├── border-top.svg
    │   │   │   ├── border-vertical.svg
    │   │   │   ├── bowling.svg
    │   │   │   ├── braille.svg
    │   │   │   ├── brands
    │   │   │   │   ├── 500px.svg
    │   │   │   │   ├── accessible-icon.svg
    │   │   │   │   ├── accusoft.svg
    │   │   │   │   ├── acquisitions-incorporated.svg
    │   │   │   │   ├── adn.svg
    │   │   │   │   ├── adobe.svg
    │   │   │   │   ├── adversal.svg
    │   │   │   │   ├── affiliatetheme.svg
    │   │   │   │   ├── airbnb.svg
    │   │   │   │   ├── algolia.svg
    │   │   │   │   ├── alipay.svg
    │   │   │   │   ├── amazon-pay.svg
    │   │   │   │   ├── amazon.svg
    │   │   │   │   ├── amilia.svg
    │   │   │   │   ├── android.svg
    │   │   │   │   ├── angellist.svg
    │   │   │   │   ├── angrycreative.svg
    │   │   │   │   ├── angular.svg
    │   │   │   │   ├── app-store-ios.svg
    │   │   │   │   ├── app-store.svg
    │   │   │   │   ├── apper.svg
    │   │   │   │   ├── apple-pay.svg
    │   │   │   │   ├── apple.svg
    │   │   │   │   ├── artstation.svg
    │   │   │   │   ├── asymmetrik.svg
    │   │   │   │   ├── atlassian.svg
    │   │   │   │   ├── audible.svg
    │   │   │   │   ├── autoprefixer.svg
    │   │   │   │   ├── avianex.svg
    │   │   │   │   ├── aviato.svg
    │   │   │   │   ├── aws.svg
    │   │   │   │   ├── bandcamp.svg
    │   │   │   │   ├── battle-net.svg
    │   │   │   │   ├── behance-square.svg
    │   │   │   │   ├── behance.svg
    │   │   │   │   ├── bimobject.svg
    │   │   │   │   ├── bitbucket.svg
    │   │   │   │   ├── bitcoin.svg
    │   │   │   │   ├── bity.svg
    │   │   │   │   ├── black-tie.svg
    │   │   │   │   ├── blackberry.svg
    │   │   │   │   ├── blogger-b.svg
    │   │   │   │   ├── blogger.svg
    │   │   │   │   ├── bluetooth-b.svg
    │   │   │   │   ├── bluetooth.svg
    │   │   │   │   ├── bootstrap.svg
    │   │   │   │   ├── brands-symbol-defs.svg
    │   │   │   │   ├── btc.svg
    │   │   │   │   ├── buffer.svg
    │   │   │   │   ├── buromobelexperte.svg
    │   │   │   │   ├── buysellads.svg
    │   │   │   │   ├── canadian-maple-leaf.svg
    │   │   │   │   ├── cc-amazon-pay.svg
    │   │   │   │   ├── cc-amex.svg
    │   │   │   │   ├── cc-apple-pay.svg
    │   │   │   │   ├── cc-diners-club.svg
    │   │   │   │   ├── cc-discover.svg
    │   │   │   │   ├── cc-jcb.svg
    │   │   │   │   ├── cc-mastercard.svg
    │   │   │   │   ├── cc-paypal.svg
    │   │   │   │   ├── cc-stripe.svg
    │   │   │   │   ├── cc-visa.svg
    │   │   │   │   ├── centercode.svg
    │   │   │   │   ├── centos.svg
    │   │   │   │   ├── chrome.svg
    │   │   │   │   ├── chromecast.svg
    │   │   │   │   ├── cloudscale.svg
    │   │   │   │   ├── cloudsmith.svg
    │   │   │   │   ├── cloudversify.svg
    │   │   │   │   ├── codepen.svg
    │   │   │   │   ├── codiepie.svg
    │   │   │   │   ├── confluence.svg
    │   │   │   │   ├── connectdevelop.svg
    │   │   │   │   ├── contao.svg
    │   │   │   │   ├── cpanel.svg
    │   │   │   │   ├── creative-commons-by.svg
    │   │   │   │   ├── creative-commons-nc-eu.svg
    │   │   │   │   ├── creative-commons-nc-jp.svg
    │   │   │   │   ├── creative-commons-nc.svg
    │   │   │   │   ├── creative-commons-nd.svg
    │   │   │   │   ├── creative-commons-pd-alt.svg
    │   │   │   │   ├── creative-commons-pd.svg
    │   │   │   │   ├── creative-commons-remix.svg
    │   │   │   │   ├── creative-commons-sa.svg
    │   │   │   │   ├── creative-commons-sampling-plus.svg
    │   │   │   │   ├── creative-commons-sampling.svg
    │   │   │   │   ├── creative-commons-share.svg
    │   │   │   │   ├── creative-commons-zero.svg
    │   │   │   │   ├── creative-commons.svg
    │   │   │   │   ├── critical-role.svg
    │   │   │   │   ├── css3-alt.svg
    │   │   │   │   ├── css3.svg
    │   │   │   │   ├── cuttlefish.svg
    │   │   │   │   ├── d-and-d-beyond.svg
    │   │   │   │   ├── d-and-d.svg
    │   │   │   │   ├── dashcube.svg
    │   │   │   │   ├── delicious.svg
    │   │   │   │   ├── deploydog.svg
    │   │   │   │   ├── deskpro.svg
    │   │   │   │   ├── dev.svg
    │   │   │   │   ├── deviantart.svg
    │   │   │   │   ├── dhl.svg
    │   │   │   │   ├── diaspora.svg
    │   │   │   │   ├── digg.svg
    │   │   │   │   ├── digital-ocean.svg
    │   │   │   │   ├── discord.svg
    │   │   │   │   ├── discourse.svg
    │   │   │   │   ├── dochub.svg
    │   │   │   │   ├── docker.svg
    │   │   │   │   ├── draft2digital.svg
    │   │   │   │   ├── dribbble-square.svg
    │   │   │   │   ├── dribbble.svg
    │   │   │   │   ├── dropbox.svg
    │   │   │   │   ├── drupal.svg
    │   │   │   │   ├── dyalog.svg
    │   │   │   │   ├── earlybirds.svg
    │   │   │   │   ├── ebay.svg
    │   │   │   │   ├── edge.svg
    │   │   │   │   ├── elementor.svg
    │   │   │   │   ├── ello.svg
    │   │   │   │   ├── ember.svg
    │   │   │   │   ├── empire.svg
    │   │   │   │   ├── envira.svg
    │   │   │   │   ├── erlang.svg
    │   │   │   │   ├── ethereum.svg
    │   │   │   │   ├── etsy.svg
    │   │   │   │   ├── evernote.svg
    │   │   │   │   ├── expeditedssl.svg
    │   │   │   │   ├── facebook-f.svg
    │   │   │   │   ├── facebook-messenger.svg
    │   │   │   │   ├── facebook-square.svg
    │   │   │   │   ├── facebook.svg
    │   │   │   │   ├── fantasy-flight-games.svg
    │   │   │   │   ├── fedex.svg
    │   │   │   │   ├── fedora.svg
    │   │   │   │   ├── figma.svg
    │   │   │   │   ├── firefox.svg
    │   │   │   │   ├── first-order-alt.svg
    │   │   │   │   ├── first-order.svg
    │   │   │   │   ├── firstdraft.svg
    │   │   │   │   ├── flickr.svg
    │   │   │   │   ├── flipboard.svg
    │   │   │   │   ├── fly.svg
    │   │   │   │   ├── font-awesome-alt.svg
    │   │   │   │   ├── font-awesome-flag.svg
    │   │   │   │   ├── font-awesome-logo-full.svg
    │   │   │   │   ├── font-awesome.svg
    │   │   │   │   ├── fonticons-fi.svg
    │   │   │   │   ├── fonticons.svg
    │   │   │   │   ├── fort-awesome-alt.svg
    │   │   │   │   ├── fort-awesome.svg
    │   │   │   │   ├── forumbee.svg
    │   │   │   │   ├── foursquare.svg
    │   │   │   │   ├── free-code-camp.svg
    │   │   │   │   ├── freebsd.svg
    │   │   │   │   ├── fulcrum.svg
    │   │   │   │   ├── galactic-republic.svg
    │   │   │   │   ├── galactic-senate.svg
    │   │   │   │   ├── get-pocket.svg
    │   │   │   │   ├── gg-circle.svg
    │   │   │   │   ├── gg.svg
    │   │   │   │   ├── git-alt.svg
    │   │   │   │   ├── git-square.svg
    │   │   │   │   ├── git.svg
    │   │   │   │   ├── github-alt.svg
    │   │   │   │   ├── github-square.svg
    │   │   │   │   ├── github.svg
    │   │   │   │   ├── gitkraken.svg
    │   │   │   │   ├── gitlab.svg
    │   │   │   │   ├── gitter.svg
    │   │   │   │   ├── glide-g.svg
    │   │   │   │   ├── glide.svg
    │   │   │   │   ├── gofore.svg
    │   │   │   │   ├── goodreads-g.svg
    │   │   │   │   ├── goodreads.svg
    │   │   │   │   ├── google-drive.svg
    │   │   │   │   ├── google-play.svg
    │   │   │   │   ├── google-plus-g.svg
    │   │   │   │   ├── google-plus-square.svg
    │   │   │   │   ├── google-plus.svg
    │   │   │   │   ├── google-wallet.svg
    │   │   │   │   ├── google.svg
    │   │   │   │   ├── gratipay.svg
    │   │   │   │   ├── grav.svg
    │   │   │   │   ├── gripfire.svg
    │   │   │   │   ├── grunt.svg
    │   │   │   │   ├── gulp.svg
    │   │   │   │   ├── hacker-news-square.svg
    │   │   │   │   ├── hacker-news.svg
    │   │   │   │   ├── hackerrank.svg
    │   │   │   │   ├── hips.svg
    │   │   │   │   ├── hire-a-helper.svg
    │   │   │   │   ├── hooli.svg
    │   │   │   │   ├── hornbill.svg
    │   │   │   │   ├── hotjar.svg
    │   │   │   │   ├── houzz.svg
    │   │   │   │   ├── html5.svg
    │   │   │   │   ├── hubspot.svg
    │   │   │   │   ├── imdb.svg
    │   │   │   │   ├── instagram.svg
    │   │   │   │   ├── intercom.svg
    │   │   │   │   ├── internet-explorer.svg
    │   │   │   │   ├── invision.svg
    │   │   │   │   ├── ioxhost.svg
    │   │   │   │   ├── itch-io.svg
    │   │   │   │   ├── itunes-note.svg
    │   │   │   │   ├── itunes.svg
    │   │   │   │   ├── java.svg
    │   │   │   │   ├── jedi-order.svg
    │   │   │   │   ├── jenkins.svg
    │   │   │   │   ├── jira.svg
    │   │   │   │   ├── joget.svg
    │   │   │   │   ├── joomla.svg
    │   │   │   │   ├── js-square.svg
    │   │   │   │   ├── js.svg
    │   │   │   │   ├── jsfiddle.svg
    │   │   │   │   ├── kaggle.svg
    │   │   │   │   ├── keybase.svg
    │   │   │   │   ├── keycdn.svg
    │   │   │   │   ├── kickstarter-k.svg
    │   │   │   │   ├── kickstarter.svg
    │   │   │   │   ├── korvue.svg
    │   │   │   │   ├── laravel.svg
    │   │   │   │   ├── lastfm-square.svg
    │   │   │   │   ├── lastfm.svg
    │   │   │   │   ├── leanpub.svg
    │   │   │   │   ├── less.svg
    │   │   │   │   ├── line.svg
    │   │   │   │   ├── linkedin-in.svg
    │   │   │   │   ├── linkedin.svg
    │   │   │   │   ├── linode.svg
    │   │   │   │   ├── linux.svg
    │   │   │   │   ├── lyft.svg
    │   │   │   │   ├── magento.svg
    │   │   │   │   ├── mailchimp.svg
    │   │   │   │   ├── mandalorian.svg
    │   │   │   │   ├── markdown.svg
    │   │   │   │   ├── mastodon.svg
    │   │   │   │   ├── maxcdn.svg
    │   │   │   │   ├── medapps.svg
    │   │   │   │   ├── medium-m.svg
    │   │   │   │   ├── medium.svg
    │   │   │   │   ├── medrt.svg
    │   │   │   │   ├── meetup.svg
    │   │   │   │   ├── megaport.svg
    │   │   │   │   ├── mendeley.svg
    │   │   │   │   ├── microsoft.svg
    │   │   │   │   ├── mix.svg
    │   │   │   │   ├── mixcloud.svg
    │   │   │   │   ├── mizuni.svg
    │   │   │   │   ├── modx.svg
    │   │   │   │   ├── monero.svg
    │   │   │   │   ├── napster.svg
    │   │   │   │   ├── neos.svg
    │   │   │   │   ├── nimblr.svg
    │   │   │   │   ├── node-js.svg
    │   │   │   │   ├── node.svg
    │   │   │   │   ├── npm.svg
    │   │   │   │   ├── ns8.svg
    │   │   │   │   ├── nutritionix.svg
    │   │   │   │   ├── odnoklassniki-square.svg
    │   │   │   │   ├── odnoklassniki.svg
    │   │   │   │   ├── old-republic.svg
    │   │   │   │   ├── opencart.svg
    │   │   │   │   ├── openid.svg
    │   │   │   │   ├── opera.svg
    │   │   │   │   ├── optin-monster.svg
    │   │   │   │   ├── osi.svg
    │   │   │   │   ├── page4.svg
    │   │   │   │   ├── pagelines.svg
    │   │   │   │   ├── palfed.svg
    │   │   │   │   ├── patreon.svg
    │   │   │   │   ├── paypal.svg
    │   │   │   │   ├── penny-arcade.svg
    │   │   │   │   ├── periscope.svg
    │   │   │   │   ├── phabricator.svg
    │   │   │   │   ├── phoenix-framework.svg
    │   │   │   │   ├── phoenix-squadron.svg
    │   │   │   │   ├── php.svg
    │   │   │   │   ├── pied-piper-alt.svg
    │   │   │   │   ├── pied-piper-hat.svg
    │   │   │   │   ├── pied-piper-pp.svg
    │   │   │   │   ├── pied-piper.svg
    │   │   │   │   ├── pinterest-p.svg
    │   │   │   │   ├── pinterest-square.svg
    │   │   │   │   ├── pinterest.svg
    │   │   │   │   ├── playstation.svg
    │   │   │   │   ├── product-hunt.svg
    │   │   │   │   ├── pushed.svg
    │   │   │   │   ├── python.svg
    │   │   │   │   ├── qq.svg
    │   │   │   │   ├── quinscape.svg
    │   │   │   │   ├── quora.svg
    │   │   │   │   ├── r-project.svg
    │   │   │   │   ├── raspberry-pi.svg
    │   │   │   │   ├── ravelry.svg
    │   │   │   │   ├── react.svg
    │   │   │   │   ├── reacteurope.svg
    │   │   │   │   ├── readme.svg
    │   │   │   │   ├── rebel.svg
    │   │   │   │   ├── red-river.svg
    │   │   │   │   ├── reddit-alien.svg
    │   │   │   │   ├── reddit-square.svg
    │   │   │   │   ├── reddit.svg
    │   │   │   │   ├── redhat.svg
    │   │   │   │   ├── renren.svg
    │   │   │   │   ├── replyd.svg
    │   │   │   │   ├── researchgate.svg
    │   │   │   │   ├── resolving.svg
    │   │   │   │   ├── rev.svg
    │   │   │   │   ├── rocketchat.svg
    │   │   │   │   ├── rockrms.svg
    │   │   │   │   ├── safari.svg
    │   │   │   │   ├── salesforce.svg
    │   │   │   │   ├── sass.svg
    │   │   │   │   ├── schlix.svg
    │   │   │   │   ├── scribd.svg
    │   │   │   │   ├── searchengin.svg
    │   │   │   │   ├── sellcast.svg
    │   │   │   │   ├── sellsy.svg
    │   │   │   │   ├── servicestack.svg
    │   │   │   │   ├── shirtsinbulk.svg
    │   │   │   │   ├── shopware.svg
    │   │   │   │   ├── simplybuilt.svg
    │   │   │   │   ├── sistrix.svg
    │   │   │   │   ├── sith.svg
    │   │   │   │   ├── sketch.svg
    │   │   │   │   ├── skyatlas.svg
    │   │   │   │   ├── skype.svg
    │   │   │   │   ├── slack-hash.svg
    │   │   │   │   ├── slack.svg
    │   │   │   │   ├── slideshare.svg
    │   │   │   │   ├── snapchat-ghost.svg
    │   │   │   │   ├── snapchat-square.svg
    │   │   │   │   ├── snapchat.svg
    │   │   │   │   ├── soundcloud.svg
    │   │   │   │   ├── sourcetree.svg
    │   │   │   │   ├── speakap.svg
    │   │   │   │   ├── speaker-deck.svg
    │   │   │   │   ├── spotify.svg
    │   │   │   │   ├── squarespace.svg
    │   │   │   │   ├── stack-exchange.svg
    │   │   │   │   ├── stack-overflow.svg
    │   │   │   │   ├── stackpath.svg
    │   │   │   │   ├── staylinked.svg
    │   │   │   │   ├── steam-square.svg
    │   │   │   │   ├── steam-symbol.svg
    │   │   │   │   ├── steam.svg
    │   │   │   │   ├── sticker-mule.svg
    │   │   │   │   ├── strava.svg
    │   │   │   │   ├── stripe-s.svg
    │   │   │   │   ├── stripe.svg
    │   │   │   │   ├── studiovinari.svg
    │   │   │   │   ├── stumbleupon-circle.svg
    │   │   │   │   ├── stumbleupon.svg
    │   │   │   │   ├── superpowers.svg
    │   │   │   │   ├── supple.svg
    │   │   │   │   ├── suse.svg
    │   │   │   │   ├── symfony.svg
    │   │   │   │   ├── teamspeak.svg
    │   │   │   │   ├── telegram-plane.svg
    │   │   │   │   ├── telegram.svg
    │   │   │   │   ├── tencent-weibo.svg
    │   │   │   │   ├── the-red-yeti.svg
    │   │   │   │   ├── themeco.svg
    │   │   │   │   ├── themeisle.svg
    │   │   │   │   ├── think-peaks.svg
    │   │   │   │   ├── trade-federation.svg
    │   │   │   │   ├── trello.svg
    │   │   │   │   ├── tripadvisor.svg
    │   │   │   │   ├── tumblr-square.svg
    │   │   │   │   ├── tumblr.svg
    │   │   │   │   ├── twitch.svg
    │   │   │   │   ├── twitter-square.svg
    │   │   │   │   ├── twitter.svg
    │   │   │   │   ├── typo3.svg
    │   │   │   │   ├── uber.svg
    │   │   │   │   ├── ubuntu.svg
    │   │   │   │   ├── uikit.svg
    │   │   │   │   ├── uniregistry.svg
    │   │   │   │   ├── untappd.svg
    │   │   │   │   ├── ups.svg
    │   │   │   │   ├── usb.svg
    │   │   │   │   ├── usps.svg
    │   │   │   │   ├── ussunnah.svg
    │   │   │   │   ├── vaadin.svg
    │   │   │   │   ├── viacoin.svg
    │   │   │   │   ├── viadeo-square.svg
    │   │   │   │   ├── viadeo.svg
    │   │   │   │   ├── viber.svg
    │   │   │   │   ├── vimeo-square.svg
    │   │   │   │   ├── vimeo-v.svg
    │   │   │   │   ├── vimeo.svg
    │   │   │   │   ├── vine.svg
    │   │   │   │   ├── vk.svg
    │   │   │   │   ├── vnv.svg
    │   │   │   │   ├── vuejs.svg
    │   │   │   │   ├── waze.svg
    │   │   │   │   ├── weebly.svg
    │   │   │   │   ├── weibo.svg
    │   │   │   │   ├── weixin.svg
    │   │   │   │   ├── whatsapp-square.svg
    │   │   │   │   ├── whatsapp.svg
    │   │   │   │   ├── whmcs.svg
    │   │   │   │   ├── wikipedia-w.svg
    │   │   │   │   ├── windows.svg
    │   │   │   │   ├── wix.svg
    │   │   │   │   ├── wizards-of-the-coast.svg
    │   │   │   │   ├── wolf-pack-battalion.svg
    │   │   │   │   ├── wordpress-simple.svg
    │   │   │   │   ├── wordpress.svg
    │   │   │   │   ├── wpbeginner.svg
    │   │   │   │   ├── wpexplorer.svg
    │   │   │   │   ├── wpforms.svg
    │   │   │   │   ├── wpressr.svg
    │   │   │   │   ├── xbox.svg
    │   │   │   │   ├── xing-square.svg
    │   │   │   │   ├── xing.svg
    │   │   │   │   ├── y-combinator.svg
    │   │   │   │   ├── yahoo.svg
    │   │   │   │   ├── yammer.svg
    │   │   │   │   ├── yandex-international.svg
    │   │   │   │   ├── yandex.svg
    │   │   │   │   ├── yarn.svg
    │   │   │   │   ├── yelp.svg
    │   │   │   │   ├── yoast.svg
    │   │   │   │   ├── youtube-square.svg
    │   │   │   │   ├── youtube.svg
    │   │   │   │   └── zhihu.svg
    │   │   │   ├── briefcase.svg
    │   │   │   ├── brightness.svg
    │   │   │   ├── british-pound.svg
    │   │   │   ├── browser.svg
    │   │   │   ├── brush-alt.svg
    │   │   │   ├── brush.svg
    │   │   │   ├── bug.svg
    │   │   │   ├── building.svg
    │   │   │   ├── bullhorn.svg
    │   │   │   ├── burger.svg
    │   │   │   ├── bus-alt.svg
    │   │   │   ├── calculator.svg
    │   │   │   ├── calendar-check.svg
    │   │   │   ├── calendar.svg
    │   │   │   ├── camera-control.svg
    │   │   │   ├── camera-roll.svg
    │   │   │   ├── camera.svg
    │   │   │   ├── car-alt.svg
    │   │   │   ├── caret-bottom.svg
    │   │   │   ├── caret-left.svg
    │   │   │   ├── caret-right.svg
    │   │   │   ├── caret-top.svg
    │   │   │   ├── cart.svg
    │   │   │   ├── casino.svg
    │   │   │   ├── cast.svg
    │   │   │   ├── cat.svg
    │   │   │   ├── center-focus.svg
    │   │   │   ├── chart-line.svg
    │   │   │   ├── chart-pie.svg
    │   │   │   ├── chart.svg
    │   │   │   ├── chat-bubble.svg
    │   │   │   ├── check.svg
    │   │   │   ├── chevron-bottom.svg
    │   │   │   ├── chevron-circle-down-alt.svg
    │   │   │   ├── chevron-circle-left-alt.svg
    │   │   │   ├── chevron-circle-right-alt.svg
    │   │   │   ├── chevron-circle-up-alt.svg
    │   │   │   ├── chevron-double-down.svg
    │   │   │   ├── chevron-double-left.svg
    │   │   │   ├── chevron-double-right.svg
    │   │   │   ├── chevron-double-up-alt.svg
    │   │   │   ├── chevron-double-up.svg
    │   │   │   ├── chevron-left.svg
    │   │   │   ├── chevron-right.svg
    │   │   │   ├── chevron-top.svg
    │   │   │   ├── child-friendly.svg
    │   │   │   ├── child.svg
    │   │   │   ├── circle.svg
    │   │   │   ├── clear-all.svg
    │   │   │   ├── clipboard.svg
    │   │   │   ├── clock.svg
    │   │   │   ├── clone.svg
    │   │   │   ├── closed-captioning.svg
    │   │   │   ├── cloud-download.svg
    │   │   │   ├── cloud-upload.svg
    │   │   │   ├── cloud.svg
    │   │   │   ├── cloudy.svg
    │   │   │   ├── code.svg
    │   │   │   ├── codepen.svg
    │   │   │   ├── coffee.svg
    │   │   │   ├── color-border.svg
    │   │   │   ├── color-fill.svg
    │   │   │   ├── color-palette.svg
    │   │   │   ├── columns.svg
    │   │   │   ├── comment-bubble.svg
    │   │   │   ├── comment-square.svg
    │   │   │   ├── compass.svg
    │   │   │   ├── compress.svg
    │   │   │   ├── contact.svg
    │   │   │   ├── contrast.svg
    │   │   │   ├── copy.svg
    │   │   │   ├── copyright.svg
    │   │   │   ├── coreui
    │   │   │   │   └── free-symbol-defs.svg
    │   │   │   ├── couch.svg
    │   │   │   ├── credit-card.svg
    │   │   │   ├── crop-rotate.svg
    │   │   │   ├── crop.svg
    │   │   │   ├── cursor-move.svg
    │   │   │   ├── cursor.svg
    │   │   │   ├── cut.svg
    │   │   │   ├── data-transfer-down.svg
    │   │   │   ├── data-transfer-up.svg
    │   │   │   ├── deaf.svg
    │   │   │   ├── delete.svg
    │   │   │   ├── description.svg
    │   │   │   ├── devices.svg
    │   │   │   ├── dialpad.svg
    │   │   │   ├── dinner.svg
    │   │   │   ├── dog.svg
    │   │   │   ├── dollar.svg
    │   │   │   ├── door.svg
    │   │   │   ├── double-quote-sans-left.svg
    │   │   │   ├── double-quote-sans-right.svg
    │   │   │   ├── drink-alcohol.svg
    │   │   │   ├── drink.svg
    │   │   │   ├── drop.svg
    │   │   │   ├── drop1.svg
    │   │   │   ├── elevator.svg
    │   │   │   ├── energy.svg
    │   │   │   ├── envelope-closed.svg
    │   │   │   ├── envelope-letter.svg
    │   │   │   ├── envelope-open.svg
    │   │   │   ├── equalizer.svg
    │   │   │   ├── ethernet.svg
    │   │   │   ├── euro.svg
    │   │   │   ├── excerpt.svg
    │   │   │   ├── exit-to-app.svg
    │   │   │   ├── expand-down.svg
    │   │   │   ├── expand-left.svg
    │   │   │   ├── expand-right.svg
    │   │   │   ├── expand-up.svg
    │   │   │   ├── exposure.svg
    │   │   │   ├── external-link.svg
    │   │   │   ├── eye.svg
    │   │   │   ├── eyedropper.svg
    │   │   │   ├── face-dead.svg
    │   │   │   ├── face.svg
    │   │   │   ├── facebook.svg
    │   │   │   ├── fastfood.svg
    │   │   │   ├── fax.svg
    │   │   │   ├── featured-playlist.svg
    │   │   │   ├── file.svg
    │   │   │   ├── filter-frames.svg
    │   │   │   ├── filter-photo.svg
    │   │   │   ├── filter.svg
    │   │   │   ├── find-in-page.svg
    │   │   │   ├── fingerprint.svg
    │   │   │   ├── fire.svg
    │   │   │   ├── flag-alt.svg
    │   │   │   ├── flight-takeoff.svg
    │   │   │   ├── flip-to-back.svg
    │   │   │   ├── flip-to-front.svg
    │   │   │   ├── flip.svg
    │   │   │   ├── flower.svg
    │   │   │   ├── folder-open.svg
    │   │   │   ├── folder.svg
    │   │   │   ├── font.svg
    │   │   │   ├── football.svg
    │   │   │   ├── fork.svg
    │   │   │   ├── fridge.svg
    │   │   │   ├── frown.svg
    │   │   │   ├── fullscreen-exit.svg
    │   │   │   ├── fullscreen.svg
    │   │   │   ├── functions-alt.svg
    │   │   │   ├── functions.svg
    │   │   │   ├── gamepad.svg
    │   │   │   ├── garage.svg
    │   │   │   ├── gem.svg
    │   │   │   ├── gif.svg
    │   │   │   ├── gift.svg
    │   │   │   ├── git.svg
    │   │   │   ├── github-circle.svg
    │   │   │   ├── github.svg
    │   │   │   ├── gitlab.svg
    │   │   │   ├── globe-alt.svg
    │   │   │   ├── golf-alt.svg
    │   │   │   ├── golf.svg
    │   │   │   ├── gradient.svg
    │   │   │   ├── grain.svg
    │   │   │   ├── graph.svg
    │   │   │   ├── grid-slash.svg
    │   │   │   ├── grid.svg
    │   │   │   ├── hand-point-down.svg
    │   │   │   ├── hand-point-left.svg
    │   │   │   ├── hand-point-right.svg
    │   │   │   ├── hand-point-up.svg
    │   │   │   ├── hd.svg
    │   │   │   ├── hdr.svg
    │   │   │   ├── header.svg
    │   │   │   ├── headphones.svg
    │   │   │   ├── healing.svg
    │   │   │   ├── heart.svg
    │   │   │   ├── highlighter.svg
    │   │   │   ├── highligt.svg
    │   │   │   ├── history.svg
    │   │   │   ├── home.svg
    │   │   │   ├── hospital.svg
    │   │   │   ├── hot-tub.svg
    │   │   │   ├── house.svg
    │   │   │   ├── https.svg
    │   │   │   ├── image-broken.svg
    │   │   │   ├── image-plus.svg
    │   │   │   ├── image1.svg
    │   │   │   ├── inbox.svg
    │   │   │   ├── indent-decrease.svg
    │   │   │   ├── indent-increase.svg
    │   │   │   ├── industry-slash.svg
    │   │   │   ├── industry.svg
    │   │   │   ├── infinity.svg
    │   │   │   ├── info.svg
    │   │   │   ├── input-hdmi.svg
    │   │   │   ├── input-power.svg
    │   │   │   ├── input.svg
    │   │   │   ├── instagram.svg
    │   │   │   ├── institution.svg
    │   │   │   ├── italic.svg
    │   │   │   ├── justify-center.svg
    │   │   │   ├── justify-left.svg
    │   │   │   ├── justify-right.svg
    │   │   │   ├── keyboard.svg
    │   │   │   ├── lan.svg
    │   │   │   ├── language.svg
    │   │   │   ├── laptop.svg
    │   │   │   ├── layers.svg
    │   │   │   ├── leaf.svg
    │   │   │   ├── lemon.svg
    │   │   │   ├── level-down.svg
    │   │   │   ├── level-up.svg
    │   │   │   ├── library-add.svg
    │   │   │   ├── library.svg
    │   │   │   ├── life-ring.svg
    │   │   │   ├── lightbulb.svg
    │   │   │   ├── line-spacing.svg
    │   │   │   ├── line-style.svg
    │   │   │   ├── line-weight.svg
    │   │   │   ├── link-alt.svg
    │   │   │   ├── link-broken.svg
    │   │   │   ├── link.svg
    │   │   │   ├── linkedin.svg
    │   │   │   ├── list-filter.svg
    │   │   │   ├── list-high-priority.svg
    │   │   │   ├── list-low-priority.svg
    │   │   │   ├── list-numbered.svg
    │   │   │   ├── list-rich.svg
    │   │   │   ├── list.svg
    │   │   │   ├── location-pin.svg
    │   │   │   ├── lock-locked.svg
    │   │   │   ├── lock-unlocked.svg
    │   │   │   ├── locomotive.svg
    │   │   │   ├── loop-1.svg
    │   │   │   ├── loop-circular.svg
    │   │   │   ├── loop.svg
    │   │   │   ├── low-vision.svg
    │   │   │   ├── magnifying-glass.svg
    │   │   │   ├── map.svg
    │   │   │   ├── media-eject.svg
    │   │   │   ├── media-pause.svg
    │   │   │   ├── media-play.svg
    │   │   │   ├── media-record.svg
    │   │   │   ├── media-skip-backward.svg
    │   │   │   ├── media-skip-forward.svg
    │   │   │   ├── media-step-backward.svg
    │   │   │   ├── media-step-forward.svg
    │   │   │   ├── media-stop.svg
    │   │   │   ├── medical-cross.svg
    │   │   │   ├── meh.svg
    │   │   │   ├── memory.svg
    │   │   │   ├── menu.svg
    │   │   │   ├── microphone.svg
    │   │   │   ├── minus.svg
    │   │   │   ├── mobile-landscape.svg
    │   │   │   ├── mobile.svg
    │   │   │   ├── money.svg
    │   │   │   ├── monitor.svg
    │   │   │   ├── mood-bad.svg
    │   │   │   ├── mood-good.svg
    │   │   │   ├── mood-very-bad.svg
    │   │   │   ├── mood-very-good.svg
    │   │   │   ├── moon.svg
    │   │   │   ├── mouse.svg
    │   │   │   ├── mouth-slash.svg
    │   │   │   ├── move.svg
    │   │   │   ├── movie.svg
    │   │   │   ├── mug-tea.svg
    │   │   │   ├── mug.svg
    │   │   │   ├── music-note.svg
    │   │   │   ├── newspaper.svg
    │   │   │   ├── notes.svg
    │   │   │   ├── object-group.svg
    │   │   │   ├── object-ungroup.svg
    │   │   │   ├── opacity.svg
    │   │   │   ├── options-horizontal.svg
    │   │   │   ├── options.svg
    │   │   │   ├── paint-bucket.svg
    │   │   │   ├── paint.svg
    │   │   │   ├── paper-plane.svg
    │   │   │   ├── paperclip.svg
    │   │   │   ├── paragraph.svg
    │   │   │   ├── paw.svg
    │   │   │   ├── pen-alt.svg
    │   │   │   ├── pen-nib.svg
    │   │   │   ├── pencil.svg
    │   │   │   ├── people.svg
    │   │   │   ├── phone.svg
    │   │   │   ├── pin.svg
    │   │   │   ├── pizza.svg
    │   │   │   ├── playlist-add.svg
    │   │   │   ├── plus.svg
    │   │   │   ├── polymer.svg
    │   │   │   ├── pool.svg
    │   │   │   ├── power-standby.svg
    │   │   │   ├── pregnant.svg
    │   │   │   ├── print.svg
    │   │   │   ├── puzzle.svg
    │   │   │   ├── qr-code.svg
    │   │   │   ├── rain.svg
    │   │   │   ├── react.svg
    │   │   │   ├── rectangle.svg
    │   │   │   ├── reddit.svg
    │   │   │   ├── registered.svg
    │   │   │   ├── reload.svg
    │   │   │   ├── resize-both.svg
    │   │   │   ├── resize-height.svg
    │   │   │   ├── resize-width.svg
    │   │   │   ├── restaurant.svg
    │   │   │   ├── room.svg
    │   │   │   ├── rowing.svg
    │   │   │   ├── rss.svg
    │   │   │   ├── running.svg
    │   │   │   ├── satelite.svg
    │   │   │   ├── save.svg
    │   │   │   ├── school.svg
    │   │   │   ├── screen-desktop.svg
    │   │   │   ├── screen-smartphone.svg
    │   │   │   ├── scrubber.svg
    │   │   │   ├── settings.svg
    │   │   │   ├── share-all.svg
    │   │   │   ├── share-alt.svg
    │   │   │   ├── share-boxed.svg
    │   │   │   ├── share.svg
    │   │   │   ├── shield-alt.svg
    │   │   │   ├── short-text.svg
    │   │   │   ├── shower.svg
    │   │   │   ├── sign-language.svg
    │   │   │   ├── signal-cellular-0.svg
    │   │   │   ├── signal-cellular-3.svg
    │   │   │   ├── signal-cellular-4.svg
    │   │   │   ├── sim.svg
    │   │   │   ├── sitemap.svg
    │   │   │   ├── skype.svg
    │   │   │   ├── smile-plus.svg
    │   │   │   ├── smile.svg
    │   │   │   ├── smoke-free.svg
    │   │   │   ├── smoking-room.svg
    │   │   │   ├── snowflake.svg
    │   │   │   ├── sort-alpha-down.svg
    │   │   │   ├── sort-alpha-up.svg
    │   │   │   ├── sort-ascending.svg
    │   │   │   ├── sort-descending.svg
    │   │   │   ├── sort-numeric-down.svg
    │   │   │   ├── sort-numeric-up.svg
    │   │   │   ├── spa.svg
    │   │   │   ├── space-bar.svg
    │   │   │   ├── speaker.svg
    │   │   │   ├── speech.svg
    │   │   │   ├── speedometer.svg
    │   │   │   ├── spotify.svg
    │   │   │   ├── spreadsheet.svg
    │   │   │   ├── square.svg
    │   │   │   ├── stackoverflow.svg
    │   │   │   ├── star-half.svg
    │   │   │   ├── star.svg
    │   │   │   ├── storage.svg
    │   │   │   ├── stream.svg
    │   │   │   ├── sun.svg
    │   │   │   ├── swap-horizontal.svg
    │   │   │   ├── swap-vertical.svg
    │   │   │   ├── swimming.svg
    │   │   │   ├── sync.svg
    │   │   │   ├── tablet.svg
    │   │   │   ├── tag.svg
    │   │   │   ├── tags.svg
    │   │   │   ├── task.svg
    │   │   │   ├── taxi.svg
    │   │   │   ├── tennis-ball.svg
    │   │   │   ├── tennis.svg
    │   │   │   ├── terminal.svg
    │   │   │   ├── terrain.svg
    │   │   │   ├── text-shapes.svg
    │   │   │   ├── text-size.svg
    │   │   │   ├── text-square.svg
    │   │   │   ├── text-strike.svg
    │   │   │   ├── text.svg
    │   │   │   ├── thumb-down.svg
    │   │   │   ├── thumb-up.svg
    │   │   │   ├── toggle-off.svg
    │   │   │   ├── toilet.svg
    │   │   │   ├── touch-app.svg
    │   │   │   ├── trademark.svg
    │   │   │   ├── transfer.svg
    │   │   │   ├── translate.svg
    │   │   │   ├── trash.svg
    │   │   │   ├── triangle.svg
    │   │   │   ├── truck.svg
    │   │   │   ├── tv.svg
    │   │   │   ├── twitter.svg
    │   │   │   ├── underline.svg
    │   │   │   ├── user-female.svg
    │   │   │   ├── user-follow.svg
    │   │   │   ├── user-unfollow.svg
    │   │   │   ├── user.svg
    │   │   │   ├── vector.svg
    │   │   │   ├── vertical-align-bottom.svg
    │   │   │   ├── vertical-align-bottom1.svg
    │   │   │   ├── vertical-align-center.svg
    │   │   │   ├── vertical-align-center1.svg
    │   │   │   ├── vertical-align-top.svg
    │   │   │   ├── vertical-align-top1.svg
    │   │   │   ├── video.svg
    │   │   │   ├── view-column.svg
    │   │   │   ├── view-module.svg
    │   │   │   ├── view-quilt.svg
    │   │   │   ├── view-stream.svg
    │   │   │   ├── voice-over-record.svg
    │   │   │   ├── volume-high.svg
    │   │   │   ├── volume-low.svg
    │   │   │   ├── volume-off.svg
    │   │   │   ├── vue.svg
    │   │   │   ├── walk.svg
    │   │   │   ├── wallet.svg
    │   │   │   ├── wallpaper.svg
    │   │   │   ├── warning.svg
    │   │   │   ├── watch.svg
    │   │   │   ├── wc.svg
    │   │   │   ├── weightlifitng.svg
    │   │   │   ├── wheelchair.svg
    │   │   │   ├── wifi-signal-0.svg
    │   │   │   ├── wifi-signal-1.svg
    │   │   │   ├── wifi-signal-2.svg
    │   │   │   ├── wifi-signal-4.svg
    │   │   │   ├── wifi-signal-off.svg
    │   │   │   ├── window-maximize.svg
    │   │   │   ├── window-minimize.svg
    │   │   │   ├── window-restore.svg
    │   │   │   ├── window.svg
    │   │   │   ├── wrap-text.svg
    │   │   │   ├── x-circle.svg
    │   │   │   ├── x.svg
    │   │   │   ├── yen.svg
    │   │   │   ├── zoom-in.svg
    │   │   │   └── zoom-out.svg
    │   │   └── img
    │   │       ├── avatars
    │   │       │   ├── 1.jpg
    │   │       │   ├── 2.jpg
    │   │       │   ├── 3.jpg
    │   │       │   ├── 4.jpg
    │   │       │   ├── 5.jpg
    │   │       │   ├── 6.jpg
    │   │       │   ├── 7.jpg
    │   │       │   ├── 8.jpg
    │   │       │   └── 9.jpg
    │   │       └── full.jpg
    │   ├── css
    │   │   ├── examples.css
    │   │   ├── examples.css.map
    │   │   ├── examples.min.css
    │   │   ├── examples.min.css.map
    │   │   ├── style.css
    │   │   ├── style.css.map
    │   │   ├── style.min.css
    │   │   ├── style.min.css.map
    │   │   └── vendors
    │   │       ├── simplebar.css
    │   │       └── simplebar.css.map
    │   ├── favicon.ico
    │   ├── index.php
    │   ├── js
    │   │   ├── charts.js
    │   │   ├── charts.js.map
    │   │   ├── colors.js
    │   │   ├── colors.js.map
    │   │   ├── main.js
    │   │   ├── main.js.map
    │   │   ├── popovers.js
    │   │   ├── popovers.js.map
    │   │   ├── summernote-ext-rtl.js
    │   │   ├── toasts.js
    │   │   ├── toasts.js.map
    │   │   ├── tooltips.js
    │   │   ├── tooltips.js.map
    │   │   ├── widgets.js
    │   │   └── widgets.js.map
    │   ├── robots.txt
    │   ├── uploads
    │   │   ├── BerkasProposal
    │   │   │   ├── IgZUYVHSuHYVkmkglrk7JLkEYQ6rWLinlQf7V26K.pdf
    │   │   │   ├── MLnm9quQBqTLXL63qhzQXECo22ZCNq6TUMZIH3jg.pdf
    │   │   │   ├── WPSYrUrdJx6ENZ96mp04O0gqTYV2nRC1kVM2d3Ls.pdf
    │   │   │   └── jwFeZTtivJ6Dm2b3gTuEbdoIXaPCFaP0wyDLE2Ex.pdf
    │   │   └── LembarPersetujuan
    │   │       └── nlSi7oSnp7B3Oxgf3L2jE2e5P60VwNRfAJ1PI3N7.pdf
    │   └── vendors
    │       ├── @coreui
    │       │   ├── chartjs
    │       │   │   ├── css
    │       │   │   └── js
    │       │   ├── coreui
    │       │   │   └── js
    │       │   ├── icons
    │       │   │   ├── css
    │       │   │   ├── fonts
    │       │   │   └── svg
    │       │   └── utils
    │       │       └── js
    │       ├── chart.js
    │       │   └── js
    │       │       └── chart.min.js
    │       └── simplebar
    │           ├── css
    │           │   └── simplebar.css
    │           └── js
    │               └── simplebar.min.js
    ├── resources
    │   ├── css
    │   │   └── app.css
    │   ├── js
    │   │   ├── app.js
    │   │   └── bootstrap.js
    │   └── views
    │       ├── admin
    │       │   └── proposal
    │       │       ├── detil.blade.php
    │       │       └── index.blade.php
    │       ├── auth
    │       │   └── login.blade.php
    │       ├── dashboard
    │       │   ├── dosen.blade.php
    │       │   ├── index.blade.php
    │       │   ├── mahasiswa.blade.php
    │       │   └── superadmin.blade.php
    │       ├── layouts
    │       │   ├── header.blade.php
    │       │   ├── main.blade.php
    │       │   └── navbar.blade.php
    │       ├── logbook
    │       │   └── dosen
    │       │       ├── detil-mhs.blade.php
    │       │       └── index.blade.php
    │       ├── proposal
    │       │   └── index.blade.php
    │       ├── user
    │       │   └── index.blade.php
    │       └── welcome.blade.php
    ├── routes
    │   ├── api.php
    │   ├── channels.php
    │   ├── console.php
    │   └── web.php
    ├── storage
    │   ├── app
    │   │   ├── .gitignore
    │   │   └── public
    │   │       └── .gitignore
    │   ├── framework
    │   │   ├── .gitignore
    │   │   ├── cache
    │   │   │   ├── .gitignore
    │   │   │   └── data
    │   │   │       └── .gitignore
    │   │   ├── sessions
    │   │   │   └── .gitignore
    │   │   ├── testing
    │   │   │   └── .gitignore
    │   │   └── views
    │   │       └── .gitignore
    │   └── logs
    │       └── .gitignore
    ├── tests
    │   ├── CreatesApplication.php
    │   ├── Feature
    │   │   └── ExampleTest.php
    │   ├── TestCase.php
    │   └── Unit
    │       └── ExampleTest.php
    └── vite.config.js
```

---

##  Modules

<details closed><summary>.</summary>

| File                                                                                      | Summary                                    |
| ---                                                                                       | ---                                        |
| [composer.lock](https://github.com/f3brysan/simontasi-unhasy/blob/master/composer.lock)   | HTTP error 401 for prompt `composer.lock`  |
| [vite.config.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/vite.config.js) | HTTP error 401 for prompt `vite.config.js` |
| [package.json](https://github.com/f3brysan/simontasi-unhasy/blob/master/package.json)     | HTTP error 401 for prompt `package.json`   |
| [phpunit.xml](https://github.com/f3brysan/simontasi-unhasy/blob/master/phpunit.xml)       | HTTP error 401 for prompt `phpunit.xml`    |
| [artisan](https://github.com/f3brysan/simontasi-unhasy/blob/master/artisan)               | HTTP error 401 for prompt `artisan`        |
| [composer.json](https://github.com/f3brysan/simontasi-unhasy/blob/master/composer.json)   | HTTP error 401 for prompt `composer.json`  |

</details>

<details closed><summary>resources.css</summary>

| File                                                                                      | Summary                                           |
| ---                                                                                       | ---                                               |
| [app.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/css/app.css) | HTTP error 401 for prompt `resources/css/app.css` |

</details>

<details closed><summary>resources.views</summary>

| File                                                                                                            | Summary                                                       |
| ---                                                                                                             | ---                                                           |
| [welcome.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/welcome.blade.php) | HTTP error 401 for prompt `resources/views/welcome.blade.php` |

</details>

<details closed><summary>resources.views.admin.proposal</summary>

| File                                                                                                                       | Summary                                                                    |
| ---                                                                                                                        | ---                                                                        |
| [index.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/admin/proposal/index.blade.php) | HTTP error 401 for prompt `resources/views/admin/proposal/index.blade.php` |
| [detil.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/admin/proposal/detil.blade.php) | HTTP error 401 for prompt `resources/views/admin/proposal/detil.blade.php` |

</details>

<details closed><summary>resources.views.dashboard</summary>

| File                                                                                                                            | Summary                                                                    |
| ---                                                                                                                             | ---                                                                        |
| [superadmin.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/dashboard/superadmin.blade.php) | HTTP error 401 for prompt `resources/views/dashboard/superadmin.blade.php` |
| [mahasiswa.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/dashboard/mahasiswa.blade.php)   | HTTP error 401 for prompt `resources/views/dashboard/mahasiswa.blade.php`  |
| [dosen.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/dashboard/dosen.blade.php)           | HTTP error 401 for prompt `resources/views/dashboard/dosen.blade.php`      |
| [index.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/dashboard/index.blade.php)           | HTTP error 401 for prompt `resources/views/dashboard/index.blade.php`      |

</details>

<details closed><summary>resources.views.layouts</summary>

| File                                                                                                                  | Summary                                                              |
| ---                                                                                                                   | ---                                                                  |
| [header.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/layouts/header.blade.php) | HTTP error 401 for prompt `resources/views/layouts/header.blade.php` |
| [navbar.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/layouts/navbar.blade.php) | HTTP error 401 for prompt `resources/views/layouts/navbar.blade.php` |
| [main.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/layouts/main.blade.php)     | HTTP error 401 for prompt `resources/views/layouts/main.blade.php`   |

</details>

<details closed><summary>resources.views.auth</summary>

| File                                                                                                             | Summary                                                          |
| ---                                                                                                              | ---                                                              |
| [login.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/auth/login.blade.php) | HTTP error 401 for prompt `resources/views/auth/login.blade.php` |

</details>

<details closed><summary>resources.views.logbook.dosen</summary>

| File                                                                                                                              | Summary                                                                       |
| ---                                                                                                                               | ---                                                                           |
| [detil-mhs.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/logbook/dosen/detil-mhs.blade.php) | HTTP error 401 for prompt `resources/views/logbook/dosen/detil-mhs.blade.php` |
| [index.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/logbook/dosen/index.blade.php)         | HTTP error 401 for prompt `resources/views/logbook/dosen/index.blade.php`     |

</details>

<details closed><summary>resources.views.proposal</summary>

| File                                                                                                                 | Summary                                                              |
| ---                                                                                                                  | ---                                                                  |
| [index.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/proposal/index.blade.php) | HTTP error 401 for prompt `resources/views/proposal/index.blade.php` |

</details>

<details closed><summary>resources.views.user</summary>

| File                                                                                                             | Summary                                                          |
| ---                                                                                                              | ---                                                              |
| [index.blade.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/views/user/index.blade.php) | HTTP error 401 for prompt `resources/views/user/index.blade.php` |

</details>

<details closed><summary>resources.js</summary>

| File                                                                                               | Summary                                               |
| ---                                                                                                | ---                                                   |
| [bootstrap.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/js/bootstrap.js) | HTTP error 401 for prompt `resources/js/bootstrap.js` |
| [app.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/resources/js/app.js)             | HTTP error 401 for prompt `resources/js/app.js`       |

</details>

<details closed><summary>public</summary>

| File                                                                                     | Summary                                       |
| ---                                                                                      | ---                                           |
| [.htaccess](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/.htaccess)   | HTTP error 401 for prompt `public/.htaccess`  |
| [index.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/index.php)   | HTTP error 401 for prompt `public/index.php`  |
| [robots.txt](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/robots.txt) | HTTP error 401 for prompt `public/robots.txt` |

</details>

<details closed><summary>public.css</summary>

| File                                                                                                             | Summary                                                     |
| ---                                                                                                              | ---                                                         |
| [examples.min.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/examples.min.css)         | HTTP error 401 for prompt `public/css/examples.min.css`     |
| [style.min.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/style.min.css.map)       | HTTP error 401 for prompt `public/css/style.min.css.map`    |
| [examples.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/examples.css.map)         | HTTP error 401 for prompt `public/css/examples.css.map`     |
| [examples.min.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/examples.min.css.map) | HTTP error 401 for prompt `public/css/examples.min.css.map` |
| [style.min.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/style.min.css)               | HTTP error 401 for prompt `public/css/style.min.css`        |
| [style.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/style.css)                       | HTTP error 401 for prompt `public/css/style.css`            |
| [style.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/style.css.map)               | HTTP error 401 for prompt `public/css/style.css.map`        |
| [examples.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/examples.css)                 | HTTP error 401 for prompt `public/css/examples.css`         |

</details>

<details closed><summary>public.css.vendors</summary>

| File                                                                                                               | Summary                                                          |
| ---                                                                                                                | ---                                                              |
| [simplebar.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/vendors/simplebar.css)         | HTTP error 401 for prompt `public/css/vendors/simplebar.css`     |
| [simplebar.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/css/vendors/simplebar.css.map) | HTTP error 401 for prompt `public/css/vendors/simplebar.css.map` |

</details>

<details closed><summary>public.vendors.simplebar.css</summary>

| File                                                                                                                 | Summary                                                                |
| ---                                                                                                                  | ---                                                                    |
| [simplebar.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/simplebar/css/simplebar.css) | HTTP error 401 for prompt `public/vendors/simplebar/css/simplebar.css` |

</details>

<details closed><summary>public.vendors.simplebar.js</summary>

| File                                                                                                                      | Summary                                                                  |
| ---                                                                                                                       | ---                                                                      |
| [simplebar.min.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/simplebar/js/simplebar.min.js) | HTTP error 401 for prompt `public/vendors/simplebar/js/simplebar.min.js` |

</details>

<details closed><summary>public.vendors.@coreui.icons.css</summary>

| File                                                                                                                             | Summary                                                                        |
| ---                                                                                                                              | ---                                                                            |
| [brand.min.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/icons/css/brand.min.css.map) | HTTP error 401 for prompt `public/vendors/@coreui/icons/css/brand.min.css.map` |
| [brand.min.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/icons/css/brand.min.css)         | HTTP error 401 for prompt `public/vendors/@coreui/icons/css/brand.min.css`     |
| [flag.min.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/icons/css/flag.min.css.map)   | HTTP error 401 for prompt `public/vendors/@coreui/icons/css/flag.min.css.map`  |
| [free.min.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/icons/css/free.min.css)           | HTTP error 401 for prompt `public/vendors/@coreui/icons/css/free.min.css`      |
| [free.min.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/icons/css/free.min.css.map)   | HTTP error 401 for prompt `public/vendors/@coreui/icons/css/free.min.css.map`  |
| [flag.min.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/icons/css/flag.min.css)           | HTTP error 401 for prompt `public/vendors/@coreui/icons/css/flag.min.css`      |

</details>

<details closed><summary>public.vendors.@coreui.utils.js</summary>

| File                                                                                                                        | Summary                                                                     |
| ---                                                                                                                         | ---                                                                         |
| [coreui-utils.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/utils/js/coreui-utils.js) | HTTP error 401 for prompt `public/vendors/@coreui/utils/js/coreui-utils.js` |

</details>

<details closed><summary>public.vendors.@coreui.coreui.js</summary>

| File                                                                                                                                           | Summary                                                                               |
| ---                                                                                                                                            | ---                                                                                   |
| [coreui.bundle.min.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/coreui/js/coreui.bundle.min.js.map) | HTTP error 401 for prompt `public/vendors/@coreui/coreui/js/coreui.bundle.min.js.map` |
| [coreui.bundle.min.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/coreui/js/coreui.bundle.min.js)         | HTTP error 401 for prompt `public/vendors/@coreui/coreui/js/coreui.bundle.min.js`     |

</details>

<details closed><summary>public.vendors.@coreui.chartjs.css</summary>

| File                                                                                                                                         | Summary                                                                               |
| ---                                                                                                                                          | ---                                                                                   |
| [coreui-chartjs.css](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/chartjs/css/coreui-chartjs.css)         | HTTP error 401 for prompt `public/vendors/@coreui/chartjs/css/coreui-chartjs.css`     |
| [coreui-chartjs.css.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/chartjs/css/coreui-chartjs.css.map) | HTTP error 401 for prompt `public/vendors/@coreui/chartjs/css/coreui-chartjs.css.map` |

</details>

<details closed><summary>public.vendors.@coreui.chartjs.js</summary>

| File                                                                                                                                      | Summary                                                                             |
| ---                                                                                                                                       | ---                                                                                 |
| [coreui-chartjs.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/chartjs/js/coreui-chartjs.js.map) | HTTP error 401 for prompt `public/vendors/@coreui/chartjs/js/coreui-chartjs.js.map` |
| [coreui-chartjs.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/@coreui/chartjs/js/coreui-chartjs.js)         | HTTP error 401 for prompt `public/vendors/@coreui/chartjs/js/coreui-chartjs.js`     |

</details>

<details closed><summary>public.vendors.chart.js.js</summary>

| File                                                                                                             | Summary                                                             |
| ---                                                                                                              | ---                                                                 |
| [chart.min.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/vendors/chart.js/js/chart.min.js) | HTTP error 401 for prompt `public/vendors/chart.js/js/chart.min.js` |

</details>

<details closed><summary>public.js</summary>

| File                                                                                                              | Summary                                                     |
| ---                                                                                                               | ---                                                         |
| [charts.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/charts.js.map)                 | HTTP error 401 for prompt `public/js/charts.js.map`         |
| [colors.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/colors.js.map)                 | HTTP error 401 for prompt `public/js/colors.js.map`         |
| [popovers.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/popovers.js.map)             | HTTP error 401 for prompt `public/js/popovers.js.map`       |
| [main.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/main.js.map)                     | HTTP error 401 for prompt `public/js/main.js.map`           |
| [main.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/main.js)                             | HTTP error 401 for prompt `public/js/main.js`               |
| [tooltips.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/tooltips.js)                     | HTTP error 401 for prompt `public/js/tooltips.js`           |
| [popovers.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/popovers.js)                     | HTTP error 401 for prompt `public/js/popovers.js`           |
| [summernote-ext-rtl.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/summernote-ext-rtl.js) | HTTP error 401 for prompt `public/js/summernote-ext-rtl.js` |
| [toasts.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/toasts.js.map)                 | HTTP error 401 for prompt `public/js/toasts.js.map`         |
| [widgets.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/widgets.js)                       | HTTP error 401 for prompt `public/js/widgets.js`            |
| [toasts.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/toasts.js)                         | HTTP error 401 for prompt `public/js/toasts.js`             |
| [colors.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/colors.js)                         | HTTP error 401 for prompt `public/js/colors.js`             |
| [tooltips.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/tooltips.js.map)             | HTTP error 401 for prompt `public/js/tooltips.js.map`       |
| [charts.js](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/charts.js)                         | HTTP error 401 for prompt `public/js/charts.js`             |
| [widgets.js.map](https://github.com/f3brysan/simontasi-unhasy/blob/master/public/js/widgets.js.map)               | HTTP error 401 for prompt `public/js/widgets.js.map`        |

</details>

<details closed><summary>database.factories</summary>

| File                                                                                                           | Summary                                                        |
| ---                                                                                                            | ---                                                            |
| [UserFactory.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/factories/UserFactory.php) | HTTP error 401 for prompt `database/factories/UserFactory.php` |

</details>

<details closed><summary>database.migrations</summary>

| File                                                                                                                                                                                                | Summary                                                                                                   |
| ---                                                                                                                                                                                                 | ---                                                                                                       |
| [2014_10_12_000000_create_users_table.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/migrations/2014_10_12_000000_create_users_table.php)                                   | HTTP error 401 for prompt `database/migrations/2014_10_12_000000_create_users_table.php`                  |
| [2014_10_12_100000_create_password_reset_tokens_table.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php)   | HTTP error 401 for prompt `database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php`  |
| [2019_12_14_000001_create_personal_access_tokens_table.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php) | HTTP error 401 for prompt `database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php` |
| [2019_08_19_000000_create_failed_jobs_table.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/migrations/2019_08_19_000000_create_failed_jobs_table.php)                       | HTTP error 401 for prompt `database/migrations/2019_08_19_000000_create_failed_jobs_table.php`            |
| [2024_03_29_042453_create_permission_tables.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/migrations/2024_03_29_042453_create_permission_tables.php)                       | HTTP error 401 for prompt `database/migrations/2024_03_29_042453_create_permission_tables.php`            |

</details>

<details closed><summary>database.seeders</summary>

| File                                                                                                               | Summary                                                         |
| ---                                                                                                                | ---                                                             |
| [DatabaseSeeder.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/database/seeders/DatabaseSeeder.php) | HTTP error 401 for prompt `database/seeders/DatabaseSeeder.php` |

</details>

<details closed><summary>routes</summary>

| File                                                                                         | Summary                                         |
| ---                                                                                          | ---                                             |
| [api.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/routes/api.php)           | HTTP error 401 for prompt `routes/api.php`      |
| [web.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/routes/web.php)           | HTTP error 401 for prompt `routes/web.php`      |
| [console.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/routes/console.php)   | HTTP error 401 for prompt `routes/console.php`  |
| [channels.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/routes/channels.php) | HTTP error 401 for prompt `routes/channels.php` |

</details>

<details closed><summary>config</summary>

| File                                                                                                 | Summary                                             |
| ---                                                                                                  | ---                                                 |
| [auth.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/auth.php)                 | HTTP error 401 for prompt `config/auth.php`         |
| [database.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/database.php)         | HTTP error 401 for prompt `config/database.php`     |
| [view.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/view.php)                 | HTTP error 401 for prompt `config/view.php`         |
| [mail.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/mail.php)                 | HTTP error 401 for prompt `config/mail.php`         |
| [queue.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/queue.php)               | HTTP error 401 for prompt `config/queue.php`        |
| [sanctum.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/sanctum.php)           | HTTP error 401 for prompt `config/sanctum.php`      |
| [broadcasting.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/broadcasting.php) | HTTP error 401 for prompt `config/broadcasting.php` |
| [app.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/app.php)                   | HTTP error 401 for prompt `config/app.php`          |
| [session.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/session.php)           | HTTP error 401 for prompt `config/session.php`      |
| [services.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/services.php)         | HTTP error 401 for prompt `config/services.php`     |
| [datatables.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/datatables.php)     | HTTP error 401 for prompt `config/datatables.php`   |
| [logging.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/logging.php)           | HTTP error 401 for prompt `config/logging.php`      |
| [cache.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/cache.php)               | HTTP error 401 for prompt `config/cache.php`        |
| [cors.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/cors.php)                 | HTTP error 401 for prompt `config/cors.php`         |
| [permission.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/permission.php)     | HTTP error 401 for prompt `config/permission.php`   |
| [filesystems.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/filesystems.php)   | HTTP error 401 for prompt `config/filesystems.php`  |
| [hashing.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/config/hashing.php)           | HTTP error 401 for prompt `config/hashing.php`      |

</details>

<details closed><summary>bootstrap</summary>

| File                                                                                  | Summary                                       |
| ---                                                                                   | ---                                           |
| [app.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/bootstrap/app.php) | HTTP error 401 for prompt `bootstrap/app.php` |

</details>

<details closed><summary>app.Exceptions</summary>

| File                                                                                               | Summary                                                |
| ---                                                                                                | ---                                                    |
| [Handler.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Exceptions/Handler.php) | HTTP error 401 for prompt `app/Exceptions/Handler.php` |

</details>

<details closed><summary>app.Providers</summary>

| File                                                                                                                                | Summary                                                                |
| ---                                                                                                                                 | ---                                                                    |
| [EventServiceProvider.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Providers/EventServiceProvider.php)         | HTTP error 401 for prompt `app/Providers/EventServiceProvider.php`     |
| [BroadcastServiceProvider.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Providers/BroadcastServiceProvider.php) | HTTP error 401 for prompt `app/Providers/BroadcastServiceProvider.php` |
| [RouteServiceProvider.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Providers/RouteServiceProvider.php)         | HTTP error 401 for prompt `app/Providers/RouteServiceProvider.php`     |
| [AppServiceProvider.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Providers/AppServiceProvider.php)             | HTTP error 401 for prompt `app/Providers/AppServiceProvider.php`       |
| [AuthServiceProvider.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Providers/AuthServiceProvider.php)           | HTTP error 401 for prompt `app/Providers/AuthServiceProvider.php`      |

</details>

<details closed><summary>app.Console</summary>

| File                                                                                          | Summary                                            |
| ---                                                                                           | ---                                                |
| [Kernel.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Console/Kernel.php) | HTTP error 401 for prompt `app/Console/Kernel.php` |

</details>

<details closed><summary>app.Http</summary>

| File                                                                                       | Summary                                         |
| ---                                                                                        | ---                                             |
| [Kernel.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Kernel.php) | HTTP error 401 for prompt `app/Http/Kernel.php` |

</details>

<details closed><summary>app.Http.Middleware</summary>

| File                                                                                                                                                      | Summary                                                                              |
| ---                                                                                                                                                       | ---                                                                                  |
| [Authenticate.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/Authenticate.php)                                         | HTTP error 401 for prompt `app/Http/Middleware/Authenticate.php`                     |
| [TrimStrings.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/TrimStrings.php)                                           | HTTP error 401 for prompt `app/Http/Middleware/TrimStrings.php`                      |
| [TrustProxies.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/TrustProxies.php)                                         | HTTP error 401 for prompt `app/Http/Middleware/TrustProxies.php`                     |
| [ValidateSignature.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/ValidateSignature.php)                               | HTTP error 401 for prompt `app/Http/Middleware/ValidateSignature.php`                |
| [TrustHosts.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/TrustHosts.php)                                             | HTTP error 401 for prompt `app/Http/Middleware/TrustHosts.php`                       |
| [RedirectIfAuthenticated.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/RedirectIfAuthenticated.php)                   | HTTP error 401 for prompt `app/Http/Middleware/RedirectIfAuthenticated.php`          |
| [VerifyCsrfToken.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/VerifyCsrfToken.php)                                   | HTTP error 401 for prompt `app/Http/Middleware/VerifyCsrfToken.php`                  |
| [PreventRequestsDuringMaintenance.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/PreventRequestsDuringMaintenance.php) | HTTP error 401 for prompt `app/Http/Middleware/PreventRequestsDuringMaintenance.php` |
| [EncryptCookies.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Middleware/EncryptCookies.php)                                     | HTTP error 401 for prompt `app/Http/Middleware/EncryptCookies.php`                   |

</details>

<details closed><summary>app.Http.Controllers</summary>

| File                                                                                                                                     | Summary                                                                      |
| ---                                                                                                                                      | ---                                                                          |
| [GetDataAPISiakad.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/GetDataAPISiakad.php)               | HTTP error 401 for prompt `app/Http/Controllers/GetDataAPISiakad.php`        |
| [AuthController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/AuthController.php)                   | HTTP error 401 for prompt `app/Http/Controllers/AuthController.php`          |
| [Controller.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/Controller.php)                           | HTTP error 401 for prompt `app/Http/Controllers/Controller.php`              |
| [LogBookController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/LogBookController.php)             | HTTP error 401 for prompt `app/Http/Controllers/LogBookController.php`       |
| [DashboardController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/DashboardController.php)         | HTTP error 401 for prompt `app/Http/Controllers/DashboardController.php`     |
| [UserController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/UserController.php)                   | HTTP error 401 for prompt `app/Http/Controllers/UserController.php`          |
| [AdminProposalController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/AdminProposalController.php) | HTTP error 401 for prompt `app/Http/Controllers/AdminProposalController.php` |
| [SyncDataController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/SyncDataController.php)           | HTTP error 401 for prompt `app/Http/Controllers/SyncDataController.php`      |
| [ProposalController.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Http/Controllers/ProposalController.php)           | HTTP error 401 for prompt `app/Http/Controllers/ProposalController.php`      |

</details>

<details closed><summary>app.Models</summary>

| File                                                                                                 | Summary                                               |
| ---                                                                                                  | ---                                                   |
| [Role.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Models/Role.php)             | HTTP error 401 for prompt `app/Models/Role.php`       |
| [Permission.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Models/Permission.php) | HTTP error 401 for prompt `app/Models/Permission.php` |
| [User.php](https://github.com/f3brysan/simontasi-unhasy/blob/master/app/Models/User.php)             | HTTP error 401 for prompt `app/Models/User.php`       |

</details>

---

##  Getting Started

***Requirements***

Ensure you have the following dependencies installed on your system:

* **PHP**: `version x.y.z`

###  Installation

1. Clone the simontasi-unhasy repository:

```sh
git clone https://github.com/f3brysan/simontasi-unhasy
```

2. Change to the project directory:

```sh
cd simontasi-unhasy
```

3. Install the dependencies:

```sh
composer install
```

###  Running simontasi-unhasy

Use the following command to run simontasi-unhasy:

```sh
php main.php
```

###  Tests

To execute tests, run:

```sh
vendor/bin/phpunit
```

---

##  Project Roadmap

- [X] `► INSERT-TASK-1`
- [ ] `► INSERT-TASK-2`
- [ ] `► ...`

---

##  Contributing

Contributions are welcome! Here are several ways you can contribute:

- **[Submit Pull Requests](https://github.com/f3brysan/simontasi-unhasy/blob/main/CONTRIBUTING.md)**: Review open PRs, and submit your own PRs.
- **[Join the Discussions](https://github.com/f3brysan/simontasi-unhasy/discussions)**: Share your insights, provide feedback, or ask questions.
- **[Report Issues](https://github.com/f3brysan/simontasi-unhasy/issues)**: Submit bugs found or log feature requests for Simontasi-unhasy.

<details closed>
    <summary>Contributing Guidelines</summary>

1. **Fork the Repository**: Start by forking the project repository to your GitHub account.
2. **Clone Locally**: Clone the forked repository to your local machine using a Git client.
   ```sh
   git clone https://github.com/f3brysan/simontasi-unhasy
   ```
3. **Create a New Branch**: Always work on a new branch, giving it a descriptive name.
   ```sh
   git checkout -b new-feature-x
   ```
4. **Make Your Changes**: Develop and test your changes locally.
5. **Commit Your Changes**: Commit with a clear message describing your updates.
   ```sh
   git commit -m 'Implemented new feature x.'
   ```
6. **Push to GitHub**: Push the changes to your forked repository.
   ```sh
   git push origin new-feature-x
   ```
7. **Submit a Pull Request**: Create a PR against the original project repository. Clearly describe the changes and their motivations.

Once your PR is reviewed and approved, it will be merged into the main branch.

</details>

---

##  License

This project is protected under the [SELECT-A-LICENSE](https://choosealicense.com/licenses) License. For more details, refer to the [LICENSE](https://choosealicense.com/licenses/) file.

---

##  Acknowledgments

- List any resources, contributors, inspiration, etc. here.

[**Return**](#-quick-links)

---