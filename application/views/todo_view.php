<?php 
// var_dump($tasks);

?>
<h1>ToDo for <?= $username?></h1>
<h3>Task List</h3>
<?php if(isset($tasks))
{

?>




        <table>
            <tr>
                <th>Task</th>
                <th>Created</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>

            <?php foreach($tasks as $value) { ?>
            <tr>
                <td><?php echo $value->task;?></td>
                <td><?php echo $value->created_at;?></td>
                <td> <form action="<?php echo base_url().'/todo/delete_task';?>" method="post">
                        <input type="hidden" name="taskid" value="<?php echo $value->id;?>">
                        <input type="hidden" name="userid" value="<?php echo $id ;?>">
                        <input type="hidden" name="username" value="<?php echo $username ;?>">
                        <input type="submit" name="submit" value="X">
                    </form>
                </td>
                <td>
                    <form action="<?php echo base_url().'/todo/view_task';?>" method="post">
                        <input type="hidden" name="taskid" value="<?php echo $value->id;?>">
                        <input type="hidden" name="userid" value="<?php echo $id ;?>">
                        <input type="hidden" name="username" value="<?php echo $username ;?>">
                        <input type="submit" name="submit" value="Edit">
                    </form>
                </td>
            </tr>

            <?php } ?>
        </table>






<?php } ?>

<form action="<?php echo base_url().'/todo/add_task';?>" method="post">
    <label for="taskname">Add Task</label>
    <input type="text" name="taskname">
    <input type="hidden" name="userid" value="<?php echo $id ;?>">
    <input type="hidden" name="username" value="<?php echo $username ;?>">
    <input type="submit" name="submit" value="submit">
</form>
