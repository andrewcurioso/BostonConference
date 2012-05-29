<div class="sponsors view">
<h2><?php  echo __('Sponsor');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['organization']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Name'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['contact_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Email'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['contact_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Phone'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['contact_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo Url'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['logo_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approved'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['approved'] ? 'Yes' : 'No'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sponsorship Level'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sponsor['SponsorshipLevel']['label'], array('controller' => 'sponsorship_levels', 'action' => 'view', $sponsor['SponsorshipLevel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php
$this->append('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sponsor'), array('action' => 'edit', $sponsor['Sponsor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sponsor'), array('action' => 'delete', $sponsor['Sponsor']['id']), null, __('Are you sure you want to delete # %s?', $sponsor['Sponsor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Levels'), array('controller' => 'sponsorship_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Level'), array('controller' => 'sponsorship_levels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
