<div id="managers-edit-view">
	
	<?php
		echo $this->Form->create("Subscriber",array('url' => array('controller' => 'subscribers', 'action' =>'edit', 'manager' => true)));
	?>
	
	<p>
		<label for="email">Name:</label>
		<?php echo $this->Form->input('email',array('label' => false)) ?>
	</p>
		<label for="email">subscriptions:</label>
		<select name="data[Subscriber][campaigns][]" multiple>
		 	<?php forEach($campaigns as $campaign){
				if(in_array($campaign['Campaign']['_id'],$this->data['Subscriber']['campaigns']))
					$selected = ' selected="selected"';
				else
					$selected = '';
				echo '<option value="'.$campaign['Campaign']['_id'].'"'.$selected.'>'.$campaign['Campaign']['name'].'</option>';
			} 
			?>
		 </select> 
	
	<p>
	
	<p>		
		<?php echo $this->Form->button('save',array('type' => "submit")) ?>
	</p>
	
	<?php
		echo $this->Form->end();
	?>
	
</div>