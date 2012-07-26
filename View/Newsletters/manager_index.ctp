<h1>Newsletters Übersicht</h1>

<?php echo $this->Html->link('Add newsletter',array('manager' => true, 'controller' => 'newsletters', 'action' => 'add'))?>
	
	<?php
		foreach($newsletters as $new):
		
	?>
	<div class="news-item">
		<h2>Name: <?php echo $this->Html->link($new['Newsletter']['title'],array('manager' => true, 'controller' => 'newsletters', 'action' => 'view',$new['Newsletter']['_id']))?></h2>		
		<p>ViewsCount: <? echo $new['Newsletter']['viewCounter']?> </p>
		<p>publishCount: <? echo $new['Newsletter']['publishCounter']?> </p>
		<p>published: <? echo $new['Newsletter']['published']?> </p>
		<?php echo $this->Html->link('edit',array('manager' => true, 'controller' => 'newsletters', 'action' => 'edit',$new['Newsletter']['_id']))?>
        <?php echo $this->Html->link('delete',array('manager' => true, 'controller' => 'newsletters', 'action' => 'delete',$new['Newsletter']['_id']))?>
		<?php echo $this->Html->link('publish',array('manager' => true, 'controller' => 'newsletters', 'action' => 'publish',$new['Newsletter']['_id']))?>
		<p><?php echo $new['Newsletter']['content'] ?></p>
		<p>Erstellt am: <?php echo $this->Time->niceShort($new['Newsletter']['created']->sec) ?> </p>
		<p>Bearbeitet am: <?php echo $this->Time->niceShort($new['Newsletter']['modified']->sec) ?> </p>
		
	</div>
	<?php
		endforeach;
	?>