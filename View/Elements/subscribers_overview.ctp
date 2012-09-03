<h2>Subscriber Übersicht</h2>

<table>
     <?php echo $this->Html->tableHeaders(array('Email','Erstellt am', 'Aktionen')); ?>
     <?php
     foreach($subscribers as $subscriber):
        echo $this->Html->tableCells(array($this->Html->link($subscriber['Subscriber']['email'],array('manager' => true, 'controller' => 'subscribers', 'action' => 'view',$subscriber['Subscriber']['_id'])),$this->Time->niceShort($subscriber['Subscriber']['created']->sec),$this->Html->link('edit',array('manager' => true, 'controller' => 'subscribers', 'action' => 'edit',$subscriber['Subscriber']['_id']))));
    endforeach;
    ?>
</table>