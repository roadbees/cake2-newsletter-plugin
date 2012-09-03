<h2>Newsletters Übersicht</h2>
<table>
<?php echo $this->Html->link('Add newsletter',array('manager' => true, 'controller' => 'newsletters', 'action' => 'add'))?>
	
	<?php
		echo $this->Html->tableHeaders(array('Title','Erstellt am','Bearbeitet am','Published', 'Aktionen'));
		foreach($newsletters as $new):

			echo $this->Html->tableCells(array($this->Html->link($new['Newsletter']['title'],array('manager' => true, 'controller' => 'newsletters', 'action' => 'view',$new['Newsletter']['_id'])),$this->Time->niceShort($new['Newsletter']['created']->sec),$this->Time->niceShort($new['Newsletter']['modified']->sec),$new['Newsletter']['published'],$this->Html->link('edit',array('manager' => true, 'controller' => 'newsletters', 'action' => 'edit',$new['Newsletter']['_id'])).' '.$this->Html->link('delete',array('manager' => true, 'controller' => 'newsletters', 'action' => 'delete',$new['Newsletter']['_id'])).' '.$this->Html->link('publish',array('manager' => true, 'controller' => 'newsletters', 'action' => 'publish',$new['Newsletter']['_id']))));
		
		endforeach;
	?>
</table>