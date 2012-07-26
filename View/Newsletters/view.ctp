<h2><?php echo $newsletter['Newsletter']['title']?></h2>		

<p><?php echo $this->Markitup->parse($newsletter['Newsletter']['content'],'markdown') ?></p>
<p>Erstellt am: <?php echo $this->Time->niceShort($newsletter['Newsletter']['created']->sec) ?> </p>
<p>Bearbeitet am: <?php echo $this->Time->niceShort($newsletter['Newsletter']['modified']->sec) ?> </p>