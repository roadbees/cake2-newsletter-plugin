<?php echo $this->element('css') ?> 
<div class="newsletter-plugin" id="campaigns-manager-index">
<h1>Kampagnen Übersicht</h1>
<?php echo $this->Html->link('Kampagne erstellen',array('action' => 'add', 'manager' => true,'controller' => 'campaigns', 'plugin' => 'newsletter')) ?> 
<?php foreach($campaigns as $campaign): ?>
<section class="campaign">
	<h2><?php echo $campaign['Campaign']['name']?></h2>
	<p>Beschreibung</p>
	<p><?php echo $campaign['Campaign']['description']?></p>
	<p>Aktive</p>
	<p><?php echo $campaign['Campaign']['active']?></p>
	<div class="controls">
		<?php echo $this->Html->link('Bearbeiten',array('action' => 'edit', 'manager' => true, $campaign['Campaign']['_id'])) ?>
		<?php echo $this->Html->link('Löschen',array('action' => 'delete', 'manager' => true, $campaign['Campaign']['_id'])) ?>
	</div>
</section>
<?php endforeach; ?>
</div>
