<?php include('header.php'); ?>
<?php
$flag = false;
if(isset($_POST['search'])){
    $flag=true;
    $term=$_POST['search'];
}
$page = $_GET['page'];
$page = substr($page, 1);
$tab = $_GET['tab'];
if ($tab==NULL){
    $tab = 'all';
}
if ($page==NULL){
    $page = 0;
}
$pageAll = 0;
$pageR = 0;
$pageP = 0;
$pageE = 0;
$pageO = 0;
$pageD = 0;
$pageA = 0;
switch($tab){
    case 'all': $pageAll=$page;break;
    case 'review': $pageR=$page;break;
    case 'process': $pageP=$page;break;
    case 'exam': $pageE=$page;break;
    case 'obstacle': $pageO=$page;break;
    case 'approved': $pageA=$page;break;
    case 'decline': $pageD=$page;break;
}

?>
    <div class="wrapper">
        <div class="container request-list">
            <form action="<?php echo home_url()?>/lista-seguimientos" method="POST" class="pull-right">
                <div class="input-group">
                    <input class="form-control" type="text" onchange="fillTables" name="search" id="search">
                    <span class="input-group-btn">
                        <input class="btn btn-secondary" type="submit" value="">
                    </span>
                </div>
            </form>
            <ul class="nav nav-tabs" role="tablist">
                <li<?php if($tab=='all'){echo (" class='active'");} ?>><a href = "#all" aria-controls="all" role="tab" data-toggle="tab">Todas</a></li>
                <li<?php if($tab=='review'){echo (" class='active'");} ?>><a class="blue" href = "#review" aria-controls="review" role="tab" data-toggle="tab">En Revisión</a></li>
                <li<?php if($tab=='process'){echo (" class='active'");} ?>><a class="blue" href = "#process" aria-controls="process" role="tab" data-toggle="tab">En Proceso</a></li>
                <li<?php if($tab=='exam'){echo (" class='active'");} ?>><a class="blue" href = "#exam" aria-controls="exam" role="tab" data-toggle="tab">En Examen</a></li>
                <li<?php if($tab=='obstacle'){echo (" class='active'");} ?>><a class="blue" href = "#obstacle" aria-controls="obstacle" role="tab" data-toggle="tab">En Obstáculo</a></li>
                <li<?php if($tab=='approved'){echo (" class='active'");} ?>><a class="blue" href = "#approved" aria-controls="approved" role="tab" data-toggle="tab">Aprobadas</a></li>
                <li<?php if($tab=='decline'){echo (" class='active'");} ?>><a class="blue" href = "#decline" aria-controls="decline" role="tab" data-toggle="tab">Denegadas</a></li>
            </ul>
            <?php
            if($flag){
                $brandsAll = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageAll.", 15");
                $brandsAllCount = $wpdb->get_results("SELECT COUNT(brand_id) as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
                $brandsReview = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id < 3 AND post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageR.", 15");
                $brandsReviewCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id < 3 AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
                $brandsInProcess = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 3 AND post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageP.", 15");
                $brandsInProcessCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 3 AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
                $brandsInExam = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 4 AND post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageP.", 15");
                $brandsInExamCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 4 AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
                $brandsInObstacle = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 5 AND post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageP.", 15");
                $brandsInObstacleCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 5 AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
                $brandsDenied = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 6 AND post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageD.", 15");
                $brandsDeniedCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 6 AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
                $brandsApproved = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 7 AND post_status = 'wc-completed' AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%') LIMIT ".$pageA.", 15");
                $brandsApprovedCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 7 AND (last_name LIKE '%".$term."%' OR brands.name LIKE '%".$term."%' OR m_last_name LIKE '%".$term."%' OR social_reason LIKE '%".$term."%' OR text LIKE '%".$term."%')");
            }else{
                $brandsAll = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' LIMIT ".$pageAll.", 15");
                $brandsAllCount = $wpdb->get_results("SELECT COUNT(brand_id) as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed'");
                $brandsReview = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id < 3 AND post_status = 'wc-completed' LIMIT ".$pageR.", 15");
                $brandsReviewCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id < 3");
                $brandsInProcess = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 3 AND post_status = 'wc-completed' LIMIT ".$pageP.", 15");
                $brandsInProcessCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 3");
                $brandsInExam = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 4 AND post_status = 'wc-completed' LIMIT ".$pageP.", 15");
                $brandsInExamCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 4");
                $brandsInObstacle = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 5 AND post_status = 'wc-completed' LIMIT ".$pageP.", 15");
                $brandsInObstacleCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 5");
                $brandsDenied = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 6 AND post_status = 'wc-completed' LIMIT ".$pageD.", 15");
                $brandsDeniedCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 6");
                $brandsApproved = $wpdb->get_results("SELECT brand_id, brands.name, last_name, social_reason,text, statuses.name as status_name FROM brands INNER JOIN statuses on brands.status_id = statuses.status_id INNER JOIN wp_posts on ID = wp_post_id WHERE brands.status_id = 7 AND post_status = 'wc-completed' LIMIT ".$pageA.", 15");
                $brandsApprovedCount = $wpdb->get_results("SELECT COUNT(brand_id)as cont FROM brands INNER JOIN wp_posts on ID = wp_post_id WHERE post_status = 'wc-completed' AND brands.status_id = 7");
            }
            ?>
            <div class="tab-content">
                <div role="tabpanel" id="all" class="tab-pane fade <?php if($tab=='all'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsAll as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsAllCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsAllCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageAll/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=all'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                            <?php } else { ?>
                                    <li>
                                    <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=all'); ?>"><?php echo $i; ?> <span class="sr-only">(página actual)</span></a>
                                    </li>
                               <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
                <div role="tabpanel" id="review" class="tab-pane fade <?php if($tab=='review'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsReview as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsReviewCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsReviewCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageR/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=review'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=review'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
                <div role="tabpanel" id="process" class="tab-pane fade <?php if($tab=='process'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsInProcess as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsInProcessCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsInProcessCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageP/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=process'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=process'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
                <div role="tabpanel" id="exam" class="tab-pane fade <?php if($tab=='exam'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsInExam as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsInExamCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsInExamCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageP/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=exam'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=exam'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
                <div role="tabpanel" id="obstacle" class="tab-pane fade <?php if($tab=='obstacle'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsInObstacle as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsInObstacleCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsInObstacleCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageP/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=obstacle'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=obstacle'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
                <div role="tabpanel" id="approved" class="tab-pane fade <?php if($tab=='approved'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsApproved as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsApprovedCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsApprovedCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageA/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=approved'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=approved'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
                <div role="tabpanel" id="decline" class="tab-pane fade <?php if($tab=='decline'){echo ("in active");} ?>">
                    <table class="admin-table">
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <th>Razón Social</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($brandsDenied as $brand){?>
                            <tr>
                                <td><?php echo ($brand->name." ".$brand->last_name) ?></td>
                                <td><?php echo ($brand->social_reason." ".$brand->text) ?></td>
                                <td><a href="<?php echo home_url().'/actualizar-solicitud?id='.$brand->brand_id?>"><?php echo ($brand->status_name) ?></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    if ($brandsDeniedCount[0]->cont > 15 ) {?>
                        <ul class="pagination">
                            <?php
                            $pages =(int)($brandsDeniedCount[0]->cont/15)+1;
                            for($i=0;$i<$pages; $i++){
                                if($i==$pageD/15){?>
                                    <li class="active">
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=decline'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo (get_permalink().'?page=p'.($i*15).'&tab=decline'); ?>"><?php echo $i; ?> <span class="sr-only"></span></a>
                                    </li>
                                <? }
                            }?>
                        </ul>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>