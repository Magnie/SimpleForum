<?php $url = base_url().'index.php'; ?>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 contenteditable="true" class="text-right">Login</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('/auth/submit') ?>
                            <div class="form-group">
                                <label class="control-label" for="userEmail">Email address</label>
                                <input class="form-control" id="userEmail" name="userEmail"
                                placeholder="Enter email" type="email">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="userPass">Password</label>
                                <input class="form-control" id="userPass" name="userPass"
                                placeholder="Password" type="password">
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                            <a href="<?php echo $url; ?>/auth/register" class="btn btn-default btn-xs">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
