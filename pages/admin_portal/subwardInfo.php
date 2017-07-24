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
                        Save Candidate Information
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="addpcbwardInfo()" name="pcbwardInfoFrom">

                        <label for="email_address"><h2>Select Ward <span style="color:rgb(255,0,0)">*</span></h2>
                        </label>

                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick selectpicker" data-live-search="true" ng-model="pcbNews.type">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <!--<option ng-repeat='news in newsType' value="{{news.id}}">{{news.display_name}}</option>-->

                                </select>
                            </div>
                        </div>


                        <label for="password"><h4>Enter अ</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="cname" ng-model="pcbwardInfo.wname" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Ward Area</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="area" ng-model="pcbwardInfo.area" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Ward Population</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="population" ng-model="pcbwardInfo.population" class="form-control"
                                       placeholder="Enter here">
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
    