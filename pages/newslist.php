  
    <div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="newsListing">
					<ul  id="easyPaginate"  class="list-unstyled clean" style="margin-top: 5px !important">
						<li class="nlRow clearfix" ng-repeat="news in newslist">
							<div class="nlImg"><a href="NewsDetail/{{news.collection_id}}"><img ng-src="{{'uploads/'+news.newsType_id+'/'+news.image}}"></a></div>
							<div class="nlDetails">
								<a href="#" class="nlTitle">{{news.title}}</a>
								<div class="nlDesc" ng-bind-html="news.description | renderHTMLCorrectly"></div>
								<div class="nlDate">{{news.created_date}}</div>
								<div class="nlBot clearfix" >
									<a href="NewsDetail/{{news.collection_id}}" class="btn blackBtn pull-left">Read more</a>
									<div class="nlShareBtns pull-right" style="display:none"> 
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=Facebook&utm_medium=social") ?>" target="_blank"  class="ndShareBtn fb"><i class="fa fa-facebook"></i></a>
									<a  href="https://plus.google.com/share?url=<?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=googleplus&utm_medium=social")?>" target="_blank"  class="ndShareBtn gplus"><i class="fa fa-google-plus"></i></a>
										<a  href="http://twitter.com/share?text=PCBToday new: <?php echo $data['title']?> <?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=twitter&utm_medium=social");?>" class="ndShareBtn lnkd"><i class="fa fa-linkedin"></i></a>
										<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=linkedin&utm_medium=social")?>"  target="_blank"  class="ndShareBtn twt"><i class="fa fa-twitter"></i></a>
										<a href="#" class="ndShareBtn email"><i class="fa fa-envelope"></i></a>
									</div>
								</div>
							</div>
						</li>
						
					</ul>
					
					<!--<ul class="pagination">
						<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
					</ul>-->
				</div>	
			
	</div>
       	<div style="clear:both"></div>
    </div>

    
