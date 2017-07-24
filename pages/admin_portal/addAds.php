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
                        Add Advertisement 
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="addPcbAds()" name="pcbNewsFrom">
					
					<label ><h4>Website or APP <span style="color:rgb(255,0,0)">*</span></h4></label>
						<div class="demo-radio-button">
                               <input name="adType" type="radio" id="radio_1"  value="WEB" ng-model="pcbadd.adType" checked />
                               <label for="radio_1">Website</label>
                               <input name="adType" type="radio" id="radio_2" value="APP" ng-model="pcbadd.adType" />
                               <label for="radio_2">APP</label>
						</div>
                        <label ><h4>Select News to Add <span style="color:rgb(255,0,0)">*</span></h4>
                        </label>

                        <div class="form-group hideDiv">
                            <div class="form-line">
							
                                <select class="form-control show-tick selectpicker" data-live-search="true" ng-model="pcbadd.type">
                                    <option></option>
                                    <option ng-repeat='(key, value) in adsType' value="{{key}}">{{value}}</option>

                                </select>
                            </div>
                        </div>

                        <label><h4>Advertisement Image <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" id="newsImage" ngf-select="uploadFiles($file, $invalidFiles)"
                                        accept="image/*" ngf-max-height="1000" ngf-max-size="1MB">
                                    </input>
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        <button type="button" class="btn btn-primary m-t-15 waves-effect" ng-click="resetForm()">Clear</button>
                        <a href="#/" class="btn btn-primary m-t-15 waves-effect">Cancel</a>
                    </form>
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
	