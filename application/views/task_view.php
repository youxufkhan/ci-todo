<form action="<?php echo base_url().'/todo/edit_task';?>" method="post">
<label for="taskname">Edit Task</label>
<input type="text" name="taskname" value="<?php echo $task[0]->task; ?>">
    <input type="hidden" name="userid" value="<?php echo $userid ;?>">
    <input type="hidden" name="username" value="<?php echo $username ;?>">
<input type="hidden" name="taskid" value="<?php echo $taskid ;?>">
<input type="submit" name="submit" value="submit">
</form>