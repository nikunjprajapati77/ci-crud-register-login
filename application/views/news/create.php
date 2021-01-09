<div class="container">
<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open_multipart('news/create'); ?>    
 
    <table class="table">        
        <tr>
            <td><label for="title">Title</label></td>
            <td><input class="form-control" type="input" name="title" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">Text</label></td>
            <td><textarea class="form-control" name="text" rows="10" cols="40"></textarea></td>
        </tr>        
        <tr>
            <td></td>
            <td><input class="btn btn-success" type="submit" name="submit" value="Create news item" /></td>
        </tr>
    </table>
    
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />    
</form>
</div>