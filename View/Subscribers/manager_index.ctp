<h1> Subscribers</h1>

<?php
	foreach($subscribers as $subscriber):
?>

<div>
<p> email: <?php echo $subscriber['Subscriber']['email'] ?></p>
<p> subscriptions: <?php Print_r($subscriber['Subscriber']['campaigns']) ?></p>
<p><?php echo $this->Html->link('view',array('manager' => true, 'controller' => 'subscribers', 'action' => 'view',$subscriber['Subscriber']['_id']))?></p>
<p><?php echo $this->Html->link('edit',array('manager' => true, 'controller' => 'subscribers', 'action' => 'edit',$subscriber['Subscriber']['_id']))?></p>
<p>Erstellt am: <?php echo $this->Time->niceShort($subscriber['Subscriber']['created']->sec) ?> </p>
<p>Bearbeitet am: <?php echo $this->Time->niceShort($subscriber['Subscriber']['modified']->sec) ?> </p>
</div>

<?php
	endforeach;
?>