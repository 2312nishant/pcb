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
                        Update News
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="updateNews()" name="updatepcbNewsFrom">
                   <div ng-show="!update_news">
                       <label for="email_address"><h2>Saved News Section Type</h2>
                           <p ng-bind="updateNewsData.type_text"></p>
                   </div>


                    <label for="email_address"><h2>Select News section to Update </h2>
                    </label>

                    <div class="form-group">
                        <div class="form-line">
                            <select id="update_type" class="form-control show-tick selectpicker" data-live-search="true" ng-model="updateNewsData.type" ng-change="setFilter()">
                                <option value=""></option>
                                <option value="All">All</option>
                                <option ng-repeat='news in newsType' value="{{news.id}}">{{news.display_name}}</option>

                            </select>
                        </div>
                    </div>
                        
                        <div class="row clearfix" ng-show="update_news">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 ng-if="updateNewsData.type=='All'">{{ALL}}</h2>
                            <h2>
                                {{newsType[updateNewsData.type-1].display_name}}
                            </h2>

                        </div>
                        <div class="body">
                            <table id='updateTable' class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                       <th>News</th>
                                       <th>Area</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>News</th>
                                        <th>Area</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </tfoot>
                                <tbody>

                                <tr role="row" ng-repeat='news in newsList | filter:filter_text'>
                                       <td>{{news.title}}</td>
                                       <td>{{news.display_name}}</td>
                                      <td>
                                        <a title="Edit" class="Edit" ng-click="setupdateNews(news.collection_id)">&nbsp;</a>
                                        <a title="Remove" class="Remove" href="" ng-click="deleteNews(news.collection_id);">&nbsp;
                                        </a></td>

                                </tr>
</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
						<div ng-show="!update_news">
                        <label for=""><h4>Enter News Title</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="tag" ng-model="updateNewsData.title" class="form-control"
                                       placeholder="Enter your News Title">
                            </div>
                        </div>



                        <div class="form-group">

                            <div class="col-md-3">
                                <label for="email_address"><h4>Uploaded Image </h4></label>
                                <img ng-src="{{uploadImg}}" style="width: 100%">
                            </div>
                            <div class="col-md-9">
                                <label for="email_address"><h4>News Image </h4></label>
                                <input type="file" id="newsImage" ngf-select="uploadFiles($file, $invalidFiles)"
                                       accept="image/*" ngf-max-height="1000" ngf-max-size="1MB">
                            </div>
                            <div style="clear: both"></div>
                        </div>

                        <label for="email_address"><h4>News Description <span style="color:rgb(255,0,0)">*</span></h4>
                        </label>

                        <div id="editor">
                            <textarea id='edit' ng-model="description" name="edit" style="margin-top: 30px;">
                            </textarea>
                        </div>
                        <br/>
                        <label for="password"><h4>Enter News Tag</h4></label>

                        <div class="form-group">


                            <div class="form-line">
                                <input type="text" id="tag" ng-model="updateNewsData.tag" class="form-control"
                                       placeholder="Enter your Hash Tag here">
                            </div>
                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save
                        </button>
                        <button type="button" class="btn btn-primary m-t-15 waves-effect" ng-click="cancelUpdateForm()">Cancel</button>
                        
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