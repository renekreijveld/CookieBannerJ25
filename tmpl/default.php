<?php

/**
 * @version 1.0.0 stable
 * @package RKR Cookie Banner
 * @copyright Copyright (C) 2012 ReneKreijveld.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://www.renekreijveld.nl
 * @author email email@renekreijveld.nl
 * @developer René Kreijveld
 *
 * RKR Cookie Banner is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version. See <http://www.gnu.org/licenses/>.
 *
 * RKR Cookie Banner is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if (!isset($_COOKIE['cb_accept_cookies'])) {

	$document =& JFactory::getDocument();
	$document->addStyleSheet('/modules/mod_rkr_cookiebanner/assets/rkr_cookiebanner.css');
	if ($params->get('cbjQuery') == '1') {
		$document->addScript(JURI::root(true).'/modules/mod_rkr_cookiebanner/assets/jquery-1.7.2.min.js');
	}
	
	?>
	<div id="cookie-message" class="<?php echo $params->get('cbColor').' '.$params->get('cbPos');?>">
		<div class="content">
			<?php echo $params->get('cbText');?>
		</div>
		<div class="buttons">
			<a id="set-cookie" class="<?php echo $params->get('cbAcceptColor');?>" href="#"><?php echo $params->get('cbAccept');?></a>
			<a id="remove-cookie-message" class="<?php echo $params->get('cbDenyColor');?>" href="#"><?php echo $params->get('cbDeny');?></a>
		</div>
		<div style="clear:both;"></div>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function ($) {
		// Set cookies
		function SetCookie(c_name, value, expiredays) {
			var exdate = new Date();
			exdate.setDate(exdate.getDate() + expiredays);
			var c_value = escape(value) + ";path=/" + ((expiredays==null) ? "" : ";expires=" + exdate.toGMTString());
			document.cookie=c_name + "=" + c_value;
		}
		$("#set-cookie").click(function() {
			SetCookie('cb_accept_cookies', 'yes', 365 * 10);
			$("#cookie-message").remove();
			<?php if ($params->get('cbRedirect')=="yes") { ?>
			window.location = "<?php echo $params->get('cbRedirectURL'); ?>";
			<?php } else { ?>
			window.location.reload();
			<?php } ?>
		});
		$("#remove-cookie-message").click(function() {
			SetCookie('cb_accept_cookies', 'no', 365 * 10);
			$("#cookie-message").remove();
			<?php if ($params->get('cbRedirect')=="yes") { ?>
			window.location = "<?php echo $params->get('cbRedirectURL'); ?>";
			<?php } else { ?>
			window.location.reload();
			<?php } ?>
		});
	});
	</script>

<?php } ?>