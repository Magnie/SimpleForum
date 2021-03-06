<?php $url = base_url().'index.php/'; ?>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb text-left">
                            <?php
                            if ($category_id !== '0') {
                                echo '
                                <li>
                                    <a href="'.$url.'forum/category/'.$parent_id.'">'.$parent.'</a>
                                </li>';
                            }
                            ?>
                            <li class="active"><?php echo $category ?></li>
                        </ul>
                        <div class="section">
                            <div class="container">
                                <h4>Sub-Categories</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group text-muted">
                                        <?php
                                        // Display Categories
                                        if (!$categories) {
                                            echo '<li class="list-group-item">None</li>';
                                        }
                                        
                                        foreach ($categories as $c) {
                                            $name = $c->name;
                                            $id = $c->id;
                                            echo '
                                            <li class="list-group-item">
                                                <a href="'.$url.'forum/category/'.$id.'">Sub-Category: '.$name.'</a>
                                            </li>';
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <h4>Threads</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group text-muted">
                                        <?php
                                        if (!$threads) {
                                            echo '<li class="list-group-item">None</li>';
                                        }
                                        
                                        foreach ($threads as $t) {
                                            $title = $t->title;
                                            $id = $t->id;
                                            echo '
                                            <li class="list-group-item">
                                                <a href="'.$url.'forum/thread/'.$id.'">'.$title.'</a>
                                            </li>';
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php
				                if ($required_type) {
				                    echo '
				                <div class="row">
				                    <div class="col-md-12">';
				                        echo validation_errors();
				                        echo form_open($url.'forum/create/'.$category_id);
				                        echo '
                                            <div class="form-group has-feedback">
                                                <label class="control-label" for="newPostTitle">New Thread</label><br />
                                                <input type="text" name="newPostTitle" id="newPostTitle" placeholder="Thread title here.." /><br />
                                                
                                                <label class="control-label" for="newPostText">New Post</label>
                                                <textarea class="form-control" name="newPostText" id="newPostText">Type your post here.</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                    </div>
                                </div>';
				                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="pager">
                                            <li>
                                                <a href="#">←  Prev</a>
                                            </li>
                                            <li>
                                                <a href="#">Next  →</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
