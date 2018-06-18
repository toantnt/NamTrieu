<section class="box_breadcrumb">
      		<div class="container">
      			<div class="title_detail">
      				<h1><?php echo $subtitle;?></h1>
      				<ol class="breadcrumb">
					  <li><a href="<?php echo base_url().$GLOBALS['lang_code'];?>"><?php echo lang('home');?></a></li>
					  <li><a href="<?php echo base_url().$GLOBALS['lang_code'].'/'.$category->cat_url.'-c'.$category->cat_id;?>"><?php echo $category->cat_name;?></a></li>
					</ol>
      			</div>
      		</div>
      	</section>
      	<section class="content_detail">
      		<div class="container">
      			<div class="left_conent">
              <?php 
                if(isset($list) && !empty($list)){
                    foreach ($list as $value) {
                        echo '<div class="item_cate">
                    <div class="box_image">
                        <a href="'.base_url().$GLOBALS['lang_code'].'/'.$value->post_slug.'-a'.$value->post_id.'.html">
                          <img src="'.$value->post_image.'" class="img-responsive" alt="'.$value->post_name.'">
                        </a>
                    </div>
                    <div class="description">
                        <h2><a href="'.base_url().$GLOBALS['lang_code'].'/'.$value->post_slug.'-a'.$value->post_id.'.html">'.$value->post_name.'</a></h2>
                        <p>
                            <span><i class="fa fa-calendar" aria-hidden="true"></i> '.$value->post_created.'</span>
                            <span><i class="fa fa-user" aria-hidden="true"></i> '.$value->post_author.'</span>
                        </p>
                        <p> '.$value->post_summary.'</p>
                    </div>
                </div>';
                    }
                }
              ?>
    			      
               
                
      			</div>
      			<div class="right_conent">
      				<div class="sidebar">
      					<div class="title_sidebar">
      						<h3><?php echo lang('recent'); ?></h3>
      					</div>
      					<div class="list_post">

                  <?php 
                    if(isset($news) && !empty($news)){
                      foreach ($news as $valnews) {
                         echo '<div class="item_post">
                    <div class="box_image">
                      <a href="'.base_url().$GLOBALS['lang_code'].'/'.$valnews->post_url.'-a'.$valnews->post_id.'.html">
                        <img src="'.$valnews->post_image.'" class="img-responsive" alt="'.$valnews->post_name.'">
                      </a>
                    </div>
                    <div class="des_post">
                      <h3><a href="'.base_url().$GLOBALS['lang_code'].'/'.$valnews->post_url.'-a'.$valnews->post_id.'.html">'.$valnews->post_name.'</a></h3>
                      <p><i class="fa fa-calendar" aria-hidden="true"></i> '.$valnews->post_created.'</p>
                    </div>
                  </div>
';
                      }
                    }
                  ?>	
      					</div>
      				</div>
      				<div class="sidebar">
      					<div class="apply_now">
      					</div>
      				</div>
      				<div class="sidebar">
      					<div class="title_sidebar">
      						<h3>Tags</h3>
      					</div>
      					<div class="list_tag">
      						<a href="">Vietnam travel</a>
							<a href="">vietnam travel guide</a>
							<a href="">Vietnam beauty</a>
							<a href="">travel news</a>
							<a href="">travel to Vietnam</a>
							<a href="">Hanoi</a>
							<a href="">Vietnam travel tips</a>
							<a href="">Vietnamese food</a>
							<a href="">Vietnam visa</a>
							<a href="">Hoi An</a>
							<a href="">travel tips</a>
							<a href="">Ho Chi Minh</a>
							<a href="">Da Nang</a>
							<a href="">Nha Trang</a>
      					</div>
      				</div>
      			</div>
      		</div>
      	</section>