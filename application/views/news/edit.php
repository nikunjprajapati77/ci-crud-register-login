<div class="container">
<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('news/edit/'.$news_item['id']); ?>
    <table class="table">
        <tr>
            <td><label for="title">Title</label></td>
            <td><input class="form-control" type="input" name="title" size="50" value="<?php echo $news_item['title'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="text">Text</label></td>
            <td><textarea class="form-control" name="text" rows="10" cols="40"><?php echo $news_item['text'] ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input class="btn btn-success" type="submit" name="submit" value="Edit news item" /></td>
        </tr>
    </table>
    
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />    
</form>
<div>