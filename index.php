<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homelab Dashboard</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.1/material.green-red.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }

    </style>
  </head>
  <body>

<?php
function GetServerStatus($site, $port)
{
$status = array("<span class='online'>Online</span>", "<span class='offline'>Offline</span>");
 $fp = @fsockopen($site, $port, $errno, $errstr, 2);
 if (!$fp) {
    return $status[1];
  } else  { return $status[0];}
 }
?>

<?php

/* get disk space free (in bytes) */
$df = disk_free_space("/disk");
/* and get disk space total (in bytes)  */
$dt = disk_total_space("/disk");
/* now we calculate the disk space used (in bytes) */
$du = $dt - $df;
/* percentage of disk used - this will be used to also set the width % of the progress bar */
$dp = sprintf('%.2f',($du / $dt) * 100);

/* and we formate the size from bytes to MB, GB, etc. */
$df = formatSize($df);
$du = formatSize($du);
$dt = formatSize($dt);

function formatSize( $bytes )
{
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
                return( round( $bytes, 2 ) . " " . $types[$i] );
}

?>

<style>

.online {
  padding: 2px 5px 2px 5px;
  margin: 0;
  display: inline;
  background: #2e7d32;
  color: white;
}

.offline {
  padding: 2px 5px 2px 5px;
  margin: 0;
  display: inline;
  background: #c62828;
  color: white;
}

.progress {
        border: 2px solid #2e7d32;
        height: 32px;
        width: 100%;
        margin: 30px auto;
}
.progress .prgbar {
        background: #2e7d32;
        width: <?php echo $dp; ?>%;
        position: relative;
        height: 32px;
        z-index: 999;
}
.progress .prgtext {
        color: #000000;
        text-align: center;
        font-size: 13px;
        padding: 9px 0 0;
        width: 100%;
        position: absolute;
        z-index: 1000;
}
.progress .prginfo {
        margin: 3px 0;
}

</style>

    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--black">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Homelab Dashboard</span>
          <div class="mdl-layout-spacer"></div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <a class="mdl-navigation__link" href="https://github.com/ak-rex/Dashboard" target="_blank"><li class="mdl-menu__item">View Source</li>
            <a class="mdl-navigation__link" href="mailto:xxxx@xxxx.com"><li class="mdl-menu__item">Contact</li>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--grey-200 mdl-color-text--black">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
	<a class="mdl-color-text--white">
            Homelab Dashboard
	</a>
	<a class="mdl-color-text--white">
            Alaska, USA
	</a>
            <div class="mdl-layout-spacer"></div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--grey-100">
          <a class="mdl-navigation__link" href="http://192.168.0.2" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">storage</i>Unraid</a>
          <a class="mdl-navigation__link" href="http://192.168.0.2:32400/web/index.html" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">play_circle_filled</i>Plex</a>
          <a class="mdl-navigation__link" href="http://192.168.0.2:8181" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">visibility</i>PlexPy</a>
          <a class="mdl-navigation__link" href="http://192.168.0.3:8112" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">swap_vertical_circle</i>Deluge</a>
          <a class="mdl-navigation__link" href="http://192.168.0.3:8989" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">fiber_dvr</i>Sonarr</a>
          <a class="mdl-navigation__link" href="http://192.168.0.3:5050" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">weekend</i>CouchPotato</a>
          <a class="mdl-navigation__link" href="https://192.168.0.3:10000" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">settings</i>Webmin</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="https://github.com/ak-rex/Dashboard" target="_blank"><i class="mdl-color-text--black material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--8dp mdl-cell mdl-cell--12-col mdl-grid">
            <div class='progress'>
      		  <div class='prgtext'><?php echo $dp; ?>% Of Storage Array Used
		</div>
      		  <div class='prgbar'></div>
      		  <div class='prginfo'>
		<div class="mdl-card__supporting-text mdl-color-text--black">
		<?php echo "$du Used - $df Free - $dt Total"; ?></div>
                <span style='clear: both;'></span>
	</div>
	</div>
	</div>
          <div class="demo-cards mdl-shadow--8dp mdl-color--white mdl-cell mdl-cell--8-col">
            <div class="demo-separator mdl-cell--1-col"></div>
            <center class="pattern">
             <img src="http://xxxx:xxxx@192.168.0.7/PSIA/Streaming/channels/101/picture" width="49%">
	     <img src="http://xxxx:xxxx@192.168.0.7/PSIA/Streaming/channels/201/picture" width="49%"></center>
            <div class="demo-separator mdl-cell--1-col"></div>
	    <center class="pattern">
	     <img src="http://xxxx:xxxx@192.168.0.7/PSIA/Streaming/channels/301/picture" width="49%">
	     <img src="images/security.jpg" width="49%"></center>
            <div class="demo-separator mdl-cell--1-col"></div>
          </div>
          <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
            <div class="demo-updates mdl-card mdl-shadow--8dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title mdl-card--expand mdl-color--green-800">
                <h2 class="mdl-card__title-text">Services</h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--black">
		 <div>Storage Server:</div>
                 <div>UnRaid -		<?php echo GetServerStatus('192.168.0.2',80); ?></div>
		 <div>Plex -		<?php echo GetServerStatus('192.168.0.2',32400); ?></div>
		 <div>PlexPy -		<?php echo GetServerStatus('192.168.0.2',8181); ?></div>
		 <div>SeedBox:</div>
                 <div>Deluge -		<?php echo GetServerStatus('192.168.0.3',8112); ?></div>
		 <div>Sonarr -		<?php echo GetServerStatus('192.168.0.3',8989); ?></div>
		 <div>CouchPotato -	<?php echo GetServerStatus('192.168.0.3',5050); ?></div>
              </div>
            </div>
            <div class="demo-separator mdl-cell--1-col"></div>
            <div class="demo-updates mdl-card mdl-shadow--8dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title mdl-card--expand mdl-color--red-800">
                <h2 class="mdl-card__title-text">Equipment</h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--black">
		 <div>Network:</div>
                 <div>Router -		<?php echo GetServerStatus('192.168.0.1',80); ?></div>
		 <div>Wireless AP -	<?php echo GetServerStatus('192.168.0.100',80); ?></div>
		 <div>Appliances:</div>
                 <div>Printer -		<?php echo GetServerStatus('192.168.0.5',80); ?></div>
                 <div>Surveillance -	<?php echo GetServerStatus('192.168.0.7',80); ?></div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
      <a href="http://xxxx:xxxx@192.168.0.7/PSIA/Streaming/channels/201/picture" target="_blank" id="view-source" class="mdl-button--fab mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"><i class="material-icons">add</i></a>
    <script src="https://code.getmdl.io/1.1.1/material.min.js"></script>
  </body>
</html>
