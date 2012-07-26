<h1> Newsletter abmeldung </h1>


<?php
    echo $this->Form->create(false,array('url' => array('controller' => 'subscribers', 'action' =>'unsubscribe', 'manager' => false)));
?>

<p>
    <label for="name">Email:</label>
    <?php echo $this->Form->input('email',array('label' => false)) ?>
</p>

<p>		
    <?php echo $this->Form->button('abmelden',array('type' => "submit")) ?>
</p>
	
<?php
    echo $this->Form->end();
?>