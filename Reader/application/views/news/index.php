
<?php foreach ($news as $news_item): ?>
	<div class="span7">
              <h2><?php echo $news_item['title'] ?></h2>
              <?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbspTime:".$news_item['newsdate'] ?>
              <p><strong><?php echo "&nbsp&nbsp&nbsp&nbsp".$news_item['text'] ?></strong></p>
              <p><a class="btn" href="http://localhost/Library/CodeIgniter_2.1.2/index.php/news/<?php echo $news_item['slug'] ?>">View details &raquo;</a></p>			  
    </div><!--/span-->
    
	<!--//<h2><?php //echo $news_item['title'] ?></h2>
    //<div id="main">
     //<p> <strong>  <?php //echo $news_item['text'] ?></strong></p>
    //</div>
	<?php //echo "index.php line 7".$news_item['slug'] ?>
    <p><a href="http://localhost/Library/CodeIgniter_2.1.2/index.php/news/<?php //echo $news_item['id'] ?>">View article</a></p>
-->
<?php endforeach ?>