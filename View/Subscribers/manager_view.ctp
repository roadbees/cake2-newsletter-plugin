<h2><?php echo $subscriber['Subscriber']['email']?></h2>		
<p><?php print_r($subscriber['Subscriber']['campaigns']) ?></p>
<p>Erstellt am: <?php echo $this->Time->niceShort($subscriber['Subscriber']['created']->sec) ?> </p>
<p>Bearbeitet am: <?php echo $this->Time->niceShort($subscriber['Subscriber']['modified']->sec) ?> </p>