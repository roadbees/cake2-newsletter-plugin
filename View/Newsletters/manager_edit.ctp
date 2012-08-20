<div id="managers-edit-view">

	
	<?php
		echo $this->Form->create("Newsletter",array('url' => array('controller' => 'newsletters', 'action' =>'edit', 'manager' => true)));
	?>
	
	<p>
		<label for="name">Name:</label>
		<?php echo $this->Form->input('title',array('label' => false)) ?>
	</p>
	
	
	<p>
		<p>
		<label for="content">inhalt:</label>
		<p>
			<textarea id ="NewsletterContent" name="data[Newsletter][content]" cols="50" rows="20"><?php echo $this->data['Newsletter']['content'] ?></textarea>
		</p>
	</p>
	</p>

	<p>
		<?php 
		//echo $this->Form->input('Campaign');
		?>
<!-- 		<select type="select" multiple="multiple" name="data[Newsletter][campaigns][]">
			<?php /* forEach($campaigns as $campaign){
				if(in_array($campaign['Campaign']['_id'],$this->data['Newsletter']['campaigns']))
					$selected = ' selected="selected"';
				else
					$selected = '';
				echo '<option value="'.$campaign['Campaign']['_id'].'"'.$selected.'>'.$campaign['Campaign']['name'].'</option>';
			} */
			?>
		</select> -->
	</p>
	
	<p>		
		<?php echo $this->Form->button('save',array('type' => "submit")) ?>
	</p>
	
	<?php
		echo $this->Form->end();
	?>
	
</div>