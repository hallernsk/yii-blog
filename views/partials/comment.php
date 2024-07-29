                <?php if(!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>

                            <div class="bottom-comment"><!--bottom comment-->
                                <div class="comment-img">
                                    <img width="50" class="img-circle" src="<?= $comment->user->image ?>" alt="">
                                </div>

                                <div class="comment-text">
                                    <h5><?= $comment->user->name ?></h5>
                                    <p class="comment-date">
                                        <?= $comment->getDate() ?>
                                    </p>
                                    <p class="para"><?= $comment->text ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>

                <?php endif; ?>


                <div class="top-comment"><!--top comment-->
                    <img src="/public/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div><!--top comment end-->
                <div class="row"><!--blog next previous-->
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>
                                    </div>
                                </div>


                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">
                                    <div class="promo-text">
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!--blog next previous end-->
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                        <div class="single-item">
                            <a href="#">
                                <img src="/public/images/related-post-1.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <img src="/public/images/related-post-2.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <img src="/public/images/related-post-3.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <img src="/public/images/related-post-1.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>

                        <div class="single-item">
                            <a href="#">
                                <img src="/public/images/related-post-2.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <img src="/public/images/related-post-3.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>
                    </div>
                </div><!--related post carousel-->
                <div class="bottom-comment"><!--bottom comment-->
                    <h4>3 comments</h4>

                    <div class="comment-img">
                        <img class="img-circle" src="/public/images/comment-img.jpg" alt="">
                    </div>

                    <div class="comment-text">
                        <a href="#" class="replay btn pull-right"> Replay</a>
                        <h5>Rubel Miah</h5>

                        <p class="comment-date">
                            December, 02, 2015 at 5:57 PM
                        </p>


                        <p class="para">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                            voluptua. At vero eos et cusam et justo duo dolores et ea rebum.</p>
                    </div>
                </div>
                <!-- end bottom comment-->

                <?php if (!Yii::$app->user->isGuest): ?>    
                           
                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>

                    <?php if(Yii::$app->session->hasFlash('comment')): ?>

                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('comment') ?>
                        </div>

                    <?php endif; ?>

                    <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['site/comment', 'id' => $article->id],
                    'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']]); ?>              
             
                        <div class="form-group">
                            <div class="col-md-12">

                                <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write Message'])->label(false) ?>

                            </div>
                        </div>
                        <button class="btn send-btn">Post Comment</button>
                    <?php \yii\widgets\ActiveForm::end(); ?>


                </div><!--end leave comment-->

                <?php endif; ?>