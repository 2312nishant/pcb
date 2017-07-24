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
                        Update Voting Poll
                    </h2>

                </div>
                <div class="body">


                    <div class="row clearfix" ng-show="updateFlag">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">

                                    <h2>
                                        POLL List
                                    </h2>

                                </div>
                                <div class="body">
                                    <table id='pollListTable'
                                           class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Option A</th>
                                            <th>Option B</th>
                                            <th>Option C</th>
                                            <th>Option D</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Question</th>
                                            <th>Option A</th>
                                            <th>Option B</th>
                                            <th>Option C</th>
                                            <th>Option D</th>
                                            <th>Action</th>

                                        </tr>
                                        </tfoot>
                                        <tbody>

                                        <tr role="row" ng-repeat='row in pollList'>
                                            <td>{{row.question}}</td>
                                            <td><p>{{row.option_a}}<span class="badge" style="margin-left: 5px">{{(row.cnt_a/row.total)*100 | number:0}}%</span>
                                                </p></td>
                                            <td><p>{{row.option_b}}<span class="badge" style="margin-left: 5px">{{(row.cnt_b/row.total)*100 | number:0}}%</span>
                                                </p></td>
                                            <td><p>{{row.option_c}}<span class="badge" style="margin-left: 5px">{{(row.cnt_c/row.total)*100 | number:0}}%</span>
                                                </p></td>
                                            <td><p>{{row.option_d}}<span class="badge" style="margin-left: 5px">{{(row.cnt_d/row.total)*100 | number:0}}%</span>
                                                </p></td>
                                            <td>
                                                <a title="Edit" class="Edit" ng-click="setupdatePoll(row.id)">&nbsp;</a>
                                                <a title="Remove" class="Remove" href="" ng-click="deletePoll(row.id);">
                                                    &nbsp;
                                                </a>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form ng-submit="updatePoll()" ng-show="!updateFlag">

                        <label><h4>Poll Question</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" ng-model="updatePollData.que" class="form-control"
                                       placeholder="Enter your Poll Question here">
                            </div>
                        </div>

                        <label><h4>Option A</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" ng-model="updatePollData.A" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>

                        <label><h4>Option B</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" ng-model="updatePollData.B" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>

                        <label><h4>Option C</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" ng-model="updatePollData.C" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>

                        <label><h4>Option D</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" ng-model="updatePollData.D" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect"
                        ">Update
                        </button>
                        <a href="#/" class="btn btn-primary m-t-15 waves-effect">Cancel</a>
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