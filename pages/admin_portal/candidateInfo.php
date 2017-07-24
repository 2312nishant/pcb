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
                    <form ng-submit="addpcbCandidate()" name="pcbCandidateFrom">


                        <label for="password"><h4>Enter Candidate Name</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="cname" ng-model="pcbCandidate.cname" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Candidate Contact</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="contact" ng-model="pcbCandidate.Contact" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Candidate Email</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email" ng-model="pcbCandidate.email" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Candidate Age</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="age" ng-model="pcbCandidate.age" class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Candidate Qualification</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="qualification" ng-model="pcbCandidate.qualification"
                                       class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Candidate Occupetion</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="occupetion" ng-model="pcbCandidate.occupation"
                                       class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>Enter Candidate Party</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbCandidate.party">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="party in electionParties" value="{{party.id}}">{{party.party_name}}({{party.party_full_name}})</option>
                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                        <label><h4>Select Candidate Ward</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbCandidate.ward">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="ward in wards" value="{{ward.ward_id}}">{{ward.prabhag_name}}</option>
                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>

                        <label for="password"><h4>Select Candidate Sub Ward</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbCandidate.sub_ward">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat='(key, value) in sub_wards' value="{{key}}">{{value}}</option>

                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>

                        <label for="password"><h4>Select Candidate Reservation</h4></label>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbCandidate.reservation">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="electionReservation in electionReservations" value="{{electionReservation.id}}">{{electionReservation.reservation_name}}</option>

                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>

                        <label for="email_address"><h4>Candidate Photo <span style="color:rgb(255,0,0)">*</span></h4>
                        </label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" id="photo" ngf-select="uploadFiles($file, $invalidFiles)"
                                       accept="image/*" ngf-max-height="1000" ngf-max-size="1MB">
                                </input>
                            </div>
                        </div>

                        <label for="email_address"><h4>Candidate Brief Information <span
                                    style="color:rgb(255,0,0)">*</span></h4>
                        </label>

                        <div id="editor">
                            <textarea id='edit' ng-model="pcbCandidate.description" name="description"
                                      style="margin-top: 30px;">
                            </textarea>
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
    