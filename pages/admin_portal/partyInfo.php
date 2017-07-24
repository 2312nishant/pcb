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
                        Save Party Information
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="addParty()" name="addPartyFrom">


                        <label for="password"><h4>Enter Party Name</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" ng-model="partyInfo.name" class="form-control"
                                       placeholder="Enter here">
                            </div>


                            <input type="radio" ng-model="partyInfo.name" value="Other">Other
                        </div>


                        <label for="password"><h4>Enter Full Name</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="contact" ng-model="partyInfo.fullname" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>


                        <label for="email_address"><h4>Candidate Party Symbol <span style="color:rgb(255,0,0)">*</span></h4>
                        </label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" id="photo" ngf-select="uploadFiles($file, $invalidFiles)"
                                       accept="image/*" ngf-max-height="1000" ngf-max-size="1MB">
                                </input>
                            </div>
                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        <button type="button" class="btn btn-primary m-t-15 waves-effect" ng-click="resetForm()">Clear
                        </button>
                        <a href="#/" class="btn btn-primary m-t-15 waves-effect">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
    