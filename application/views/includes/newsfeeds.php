 

      <div class="container">
          
          <h3 class="section-title">News Feeds</h3>

          <div class="carousel-type-3">
                  
            <div class="owl-carousel" data-max-items="6" data-item-margin="30">

              <?php
                foreach ($news_feed as  $news_feeds) {
                  
              ?>
              <!-- Slide -->                  
              <div class="item-carousel" style="color:#000;">
               
                <a href="#" class="brend-item"><img src="<?php echo $news_feeds->image;?>" alt=""></a>
                <?php echo $news_feeds->description; ?>
              
              </div>
              <!-- /Slide -->

            <?php } ?>
            </div>

          </div>

        </div>