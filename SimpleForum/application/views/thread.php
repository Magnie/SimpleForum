        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb text-left">
                            <?php
                            echo '
                            <li>
                                <a href="../category/'.$category->id.'">'.$category->name.'</a>
                            </li>';
                            ?>
                            <li class="active"><?php echo $thread->title ?></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        foreach ($posts as $p) {
                            echo '
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">'.$p->author.'</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>'.$p->post.'</p>
                                    </div>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('/forum/post/'.$thread_id) ?>
                            <div class="form-group has-feedback">
                                <label class="control-label" for="newPostText">New Post</label>
                                <textarea class="form-control" name="newPostText">Type your post here.</textarea>
                                <input type="hidden" name="test" value="test" />
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
