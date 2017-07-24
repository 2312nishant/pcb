 <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    
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
                        Candidate Voting
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="updateNews()" name="updatepcbNewsFrom">


                    <label for="email_address"><h2>Select News section to Update </h2>
                    </label>

                    <div class="form-group">
                        <div class="form-line">
                            <select id="update_ward" class="form-control show-tick selectpicker" data-live-search="true" ng-model="updateCandidateData.ward_id" ng-change="setFilter()">
                                <option value=""></option>
                                <option value="All">All</option>
                                <option ng-repeat='ward in wardInfo' value="{{ward.ward_id}}">{{ward.prabhag_name}}</option>

                            </select>
                        </div>
                    </div>

                        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 ng-if="updateCandidateData.type=='All'">{{ALL}}</h2>
                            <h2>
                                {{wardInfo[updateCandidateData.type-1].prabhag_name}}
                            </h2>

                        </div>
                        <div class="body">
                            <table id='updateTable' class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Party</th>
                                        <th>Prabhag</th>
                                        <th>Vote</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Party</th>
                                        <th>Prabhag</th>
                                        <th>Vote</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                <tr role="row" ng-repeat='candidate in candidateInfo | filter:filter_text'>
                                       <td>{{candidate.name}}</td>
                                       <td>{{candidate.party_name}}</td>
                                       <td>{{candidate.prabhag_no}}</td>
                                       <td><input type="number" id="candidate_{{candidate.candidate_id}}" value="{{candidate.no_votes}}" > </td>
                                      <td>
                                        <a title="Update" class="Edit" ng-click="setupdateCandidate(candidate.candidate_id,vote)">&nbsp;</a>
                                       </td>

                                </tr>
</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
     <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>