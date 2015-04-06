<?php $url = base_url().'index.php/'; ?>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb text-left">
                            <?php
                            echo '
                            <li>
                                <a href="'.$url.'forum/category/'.$category->id.'">'.$category->name.'</a>
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
                <?php
                if ($required_type) {
                    echo '
                <div class="row">
                    <div class="col-md-12">';
                        echo validation_errors();
                        echo form_open($url.'forum/post/'.$thread_id);
                        echo '
                            <div class="form-group has-feedback">
                                <label class="control-label" for="newPostText">New Post</label>
                                <textarea class="form-control" name="newPostText">Type your post here.</textarea>
                                <input type="hidden" name="test" value="test" />
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>';
                }
                ?>
            </div>
        </div>
