<div class="container">
    <h2><?php echo $title; ?></h2>

    <table class="table table-bordered">
        <tr>
            <td><strong>Title</strong></td>
            <td><strong>Content</strong></td>
            <td><strong>Action</strong></td>
        </tr>
        <?php
        if (isset($news)) {
            foreach ($news as $news_item) : ?>
                <tr>
                    <td><?php echo $news_item['title']; ?></td>
                    <td><?php echo $news_item['text']; ?></td>
                    <td>
                        <a href="<?php echo site_url('news/' . $news_item['slug']); ?>">View</a>
                        <a class="btn btn-info btn-sm" href="<?php echo site_url('news/edit/' . $news_item['id']); ?>">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url('news/delete/' . $news_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
            <?php
            endforeach;
        } else { ?>
            <tr>
                <td colspan="3" class="text-center">No Records</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php if (isset($links)) { ?>
        <?php echo $links ?>
    <?php } ?>
</div>