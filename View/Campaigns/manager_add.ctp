<div class="newsletter-plugin" id="campaigns-manager-add">
<?php echo $this->Html->link('Übersicht',array('action' => 'index', 'manager' => true,'controller' => 'campaigns', 'plugin' => 'newsletter')) ?>
<h1>Kampagne erstellen</h1>
	<?php
		echo $this->Form->create("Campaign",array('url' => array(
																		'controller' => 'campaigns',
																		'action' =>'add',
																		'manager' => true,
																		'plugin' => "news_letter")));
	?>
	
	<p>
		<label for="name">Name:</label>
		<?php echo $this->Form->input('name',array('label' => false)) ?>
	</p>
	
	
	<p>
		<label for="content">Beschreibung:</label>
		<?php echo $this->Markitup->editor('Campaign.description',array('skin' => 'simple','set' => 'markdown','parser' => 'markdown')); ?> 
	</p>

	<p>
		<label for="tags">Aktive:</label>
		<?php echo $this->Form->input('active',array('label' => false,'type' => 'checkbox')) ?>
	</p>
	
	<p>		
		<?php echo $this->Form->button('save',array('type' => "submit")) ?>
	</p>
	
	<?php
		echo $this->Form->end();
	?>
</div>