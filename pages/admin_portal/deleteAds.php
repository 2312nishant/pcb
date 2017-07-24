<div class="container-fluid">
    <div class="block-header" style="display:none">
        <h2>FORM EXAMPLES</h2>
    </div>

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Delete Advertisement
                    </h2>

                </div>
                <div class="body">

                    <div class="col-xs-12 col-sm-6 col-md-3" ng-repeat="ad in ads">

                        <img src="uploads/{{ad.adv_type}}/{{ad.image}}" style="width: 100%;height: 200px;    border: 3px solid #000;">
                        <a ng-click="deleteAd(ad.adv_type,ad.image,ad.id)" style="cursor: pointer;padding: 5px;text-align: center;display: block"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="font-size: 24px;color: red"></span></a>
                    </div>
<div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
    
	<script type="text/javascript">
	$(document).ready(function(){
    $('#radio_2').change(function(){
        if(this.checked)
            $('.hideDiv').hide();
    });
	$('#radio_1').change(function(){
        if(this.checked)
            $('.hideDiv').show();
		         
    });
	
    
});
	</script>
	