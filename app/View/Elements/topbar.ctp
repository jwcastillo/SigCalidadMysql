<?php $this->append('script'); ?>

<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<?php echo $this->Html->script('jquery-ui.min', array('once' => true)); ?>
<!-- custom dropdown library -->
<?php echo $this->Html->script('bootstrap', array('once' => true, 'inline' => true)); ?>
<script type="text/javascript">
//<![CDATA[
var topbarAutoData = {
	source: <?php echo json_encode($this->Charisma->controllerLinks()); ?>,
	select: function(event, ui) {
		/* Prevent the input from being populated: */
		event.preventDefault();
		/* Use ui.item.value to access the id */
		window.location.href = ui.item.value;
	},
	autoFocus: true
};

$(document).ready(function() {
	
		$("input#search").autocomplete(topbarAutoData);
});

$(document).ajaxComplete(function() {

	$("input#search").autocomplete(topbarAutoData);

});
//]]>
</script>
<?php $this->end(); ?>

<?php
// Check for username
$username = ($this->Session->read('Auth.User.firstname') && $this->Session->read('Auth.User.lastname')) ?
	$this->Session->read('Auth.User.firstname') . ' ' . $this->Session->read('Auth.User.lastname') : 
	$this->Session->read('Auth.User.username');

$userId = $this->Session->read('Auth.User.id');

?>

<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<?php echo $this->Html->link(
					/*$this->Html->tag('span', 'SIG Calidad IT') .  */
					$this->Html->image('sig_logo_top.png', array('alt' => 'Bancaribe', 'border' => '0')), 
					'/', array('class' => 'brand', 'escape' => false));
				?>
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $username ?></span>

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Profile'), array('plugin' => null, 'controller' => 'users','action' => 'profile', $userId)); ?>
						</li>
						<li class="divider"></li>
						<li>
							<?php echo $this->Html->link(__('Logout'), array('plugin' => null, 'controller' => 'users','action' => 'logout')); ?>
						<li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="#"><?php echo __('Search'); ?></a></li>
						<li>
							<form class="navbar-search pull-left">
								<input id="search" placeholder="<?php echo __('Search'); ?>" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->