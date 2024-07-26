<?php
/**
 * Program Template Module: Calls to Action
 * 
 * Module partial used to display the program calls to action.
 *
 */

$rfi_link   = get_field('request_info_link');
$apply_link = get_field('apply_link');
$form       = get_field('form_embed');

if ( $form ) : ?>
	<div id="sidebar" class="sidebar sidebar--program">
		<!-- whatever goes into this container will go to the top at mobile -->
		<!-- REGION: Sidebar Navigation -->
		<nav class="subnav subnav--form container--purple" aria-label="Request Information Form">
			<?php echo $form; ?>
		</nav>
		<?php if ($rfi_link) : ?>
			<div class="subnav__extra">
				<p><a href="<?php echo $rfi_link['url']; ?>" class="button"><?php echo $rfi_link['title']; ?></a></p>
			</div>
		<?php endif; ?>
		<?php if ($apply_link) : ?>
			<div class="subnav__extra">
				<p><a href="<?php echo $apply_link['url']; ?>" class="button"><?php echo $apply_link['title']; ?></a></p>
			</div>
		<?php endif; ?>
		<!-- /REGION: Sidebar Navigation -->
		<!-- REGION: Sidebar Context Top -->
		<!-- /REGION: Sidebar Context Top -->
	</div>
<?php endif; ?>