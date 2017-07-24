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
                        Save Ward Information
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="addpcbwardInfo()" name="pcbwardInfoFrom">


                        <label for="password"><h4>Enter Ward Name</h4></label>

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
                                <input type="text" id="population" ng-model="pcbwardInfo.population"
                                       class="form-control"
                                       placeholder="Enter here">
                            </div>
                        </div>

                        <label for="password"><h4>A Prabhag Reserved For</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbwardInfo.prabhag_a">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="electionReservation in electionReservations" value="{{electionReservation.id}}">{{electionReservation.reservation_name}}</option>

                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>


                        <label for="password"><h4>B Prabhag Reserved For</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbwardInfo.prabhag_b">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="electionReservation in electionReservations" value="{{electionReservation.id}}">{{electionReservation.reservation_name}}</option>

                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>


                        <label for="password"><h4>C Prabhag Reserved For</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbwardInfo.prabhag_c">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="electionReservation in electionReservations" value="{{electionReservation.id}}">{{electionReservation.reservation_name}}</option>

                                </select>
                            </div>
                            <div style="clear: both"></div>
                        </div>


                        <label for="password"><h4>D Prabhag Reserved For</h4></label>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control show-tick" ng-model="pcbwardInfo.prabhag_d">
                                    <option value="">-- Please select --</option>
                                    <option ng-repeat="electionReservation in electionReservations" value="{{electionReservation.id}}">{{electionReservation.reservation_name}}</option>

                                </select>
                            </div>
                            <div style="clear: both"></div>
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
    