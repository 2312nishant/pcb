    <div class="col-sm-12 col-md-12">
	
   </div>
	<div style="clear:both"></div>
	
<div class="pcbappSliderDiv"><!-- PCB App Slider Start -->
	<div class="container12">
		<h1 class="heading"><span>PCB App</span></h1>
		<div id="pcbappSlider" class="owl-carousel owl-theme">
			<div class="item" ng-repeat="news in notificationNews">
				<div class="newsThumb">
					<div class="newsImg"><img ng-src="{{'uploads/'+news.newsType_id+'/'+news.image}}"><a href="<?php echo base_url('Welcome');?>" class="btn whtBtn">Read more</a></div>
					<div class="newsInfo">
						<div class="niTop clearfix">
							<div class="newsDate pull-left">{{news.created_date}}</div>
							
						</div>
						<div class="newsTitle">{{news.title}}</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</div><!-- PCB App Slider End -->

	<div class="col-sm-12 col-md-12">
	<div ui-view="mainContent"></div>
        
    </div>
    <div style="clear:both"></div>
    
    <div>
	<div ui-view="columnOne" class="col-xs-12 col-sm-12 col-md-8"></div>
        <div ui-view="columnTwo" class="col-xs-12 col-sm-12 col-md-4"></div>
		<div style="clear:both"></div>
    </div>

    
