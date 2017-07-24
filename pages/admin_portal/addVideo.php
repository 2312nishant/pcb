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
                        Add Video
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="savePcbVideo()" name="pcbVideoFrom">
                       
                         <label><h4>Video Title</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="video.title" class="form-control"
                                       placeholder="Enter your video title here">
                            </div>
                        </div>
                        
                         <label><h4>Video Code</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="video.code" class="form-control"
                                       placeholder="Enter your video code here">
                            </div>
                        </div>
                        
                        <label ><h4>Select Type of Video<span style="color:rgb(255,0,0)">*</span></h4>
                        </label>
                        <div class="form-group hideDiv">
                            <div class="form-line">							
                                <select class="form-control show-tick selectpicker" data-live-search="true" ng-model="video.type">
                                    <option ng-repeat='(key, value) in videoType' value="{{key}}">{{value}}</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save
                        </button>
                        <a href="#/" class="btn btn-primary m-t-15 waves-effect">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
    